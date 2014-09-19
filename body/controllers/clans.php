<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class clans extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('clan'));
        $this->session_data = $this->session->userdata('user_session');
    }

     /*
    *   List all clans if the id is null
    *   Single clan if id is passed
    *   Param1(optional) : clan id
    *   Param2(optional) : any text (e.g. : notification)
    */
    function viewClan($id = null, $type = null) {
        $academy = New Academy();
        if ($this->session_data->role == '1' || $this->session_data->role == '2') {
            $academy->get();
            $temp = array();
            foreach ($academy as $ac) {
                foreach ($ac->school->get() as $school) {
                    $temp[] = $school;
                }
            }
            $data['schools'] = $temp;
        } else if ($this->session_data->role == '3'){
            $school = new School();
            $data['schools'] = $school->getSchoolOfRector($this->session_data->id);
        } else if ($this->session_data->role == '4'){
            $school = new School();
            $data['schools'] = $school->getSchoolOfDean($this->session_data->id);
        } else if ($this->session_data->role == '5'){
            $school = new School();
            $data['schools'] = $school->getSchoolOfTeacher($this->session_data->id);
        }

        if (is_null($id)) {
            $this->layout->view('clans/view', $data);
        } else if (!is_null($id) && $type == "list_clan_school_wise") {
            $data['school_id'] = $id;
            $this->layout->view('clans/view', $data);
        } else {

            if ($type == 'notification') {
                Notification::updateNotification('teacher_assign_class', $this->session_data->id, $id);
            }

            $obj = new Clan();
            $data['clan'] = $obj->where('id', $id)->get();
            $data['next_clan_dates'] = $obj->getAviableDateFromClan($id, 365);

            if(!validAcess($id, 'clan')){
                $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
                redirect(base_url() . 'dashboard', 'refresh'); 
            }

            $data['school'] = $obj->School->get();
            $data['academy'] = $obj->School->Academy->get();
            $data['teacher'] = userNameAvtar($obj->teacher_id);
            $obj_clan_dates = new Clandate();
            $data['clan_dates'] = $obj_clan_dates->where('clan_id', $id)->order_by('clan_date', 'desc')->get();

            $present = 0;
            $absence = 0;
            $recovery = 0;

            $attadence = new Teacherattendance();
            $attadence->where(array('clan_id' =>$id))->get();
            if($attadence->result_count() > 0){
                foreach ($attadence as $date) {
                    $temp = array();
                    $temp['id'] = $date->stored->id;
                    $temp['date'] = $date->stored->clan_date;
                    $temp['status'] = $date->stored->status;
                    if($date->stored->attendance == 1){
                        if($date->stored->status == 'U' && $date->stored->attendance != 0){
                            $temp['type'] = 'label label-success-danger';
                            $temp['unapproved_reason'] = $date->stored->to_message;
                        } else{
                            $temp['type'] = 'label label-success';    
                        }
                        $present = @$present + 1; 
                    }else{
                        if($date->stored->status == 'P'){
                            $temp['type'] = 'label label-default';
                        } else if($date->stored->status == 'A' && $date->stored->recovery_teacher == 0){
                            $temp['type'] = 'label label-danger';
                            $absence = @$absence+ 1;
                        } else if($date->stored->status == 'A' && $date->stored->recovery_teacher != 0){
                            $temp['type'] = 'label label-danger-warning';
                            $absence = @$absence+ 1;
                            $recovery = $recovery + 1;
                            $temp['recover_teacher'] = userNameAvtar($date->stored->recovery_teacher, false);
                        } else {
                            $temp['type'] = 'label';
                        }
                    }
                    $data['teacher_attendance'][] = $temp;
                }
            }else{
                $data['teacher_attendance'] = null;
            }
            

            $data['present'] = $present;
            $data['absence'] = $absence;
            $data['recovery'] = $recovery;
            $userdetails = $obj->Userdetail->get();
            if($userdetails->result_count() > 0){
                foreach ($userdetails as $value) {
                    $user = $value->User->get();
                    if(!is_null($user->id)){
                        $data['students'][] = $user->stored;
                    }
                }
            } 

            if(!isset($data['students'])){
                $data['students'] = null;
            }

            $this->layout->view('clans/view_single', $data);
        }
    }

    //Add the Clan
    function addClan() {
        if ($this->input->post() !== false) {
            $obj = new Clan();
            foreach ($this->config->item('custom_languages') as $key => $value) {
                $temp = $key . '_class_name';
                if ($this->input->post($temp) != '') {
                    $obj->$temp = $this->input->post($temp);
                } else {
                    $obj->$temp = $this->input->post('en_class_name');
                }
            }

            $obj->academy_id = $this->input->post('academy_id');
            $obj->school_id = $this->input->post('school_id');
            $obj->teacher_id = implode(',', $this->input->post('teacher_id'));
            $obj->level_id = $this->input->post('level_id');
            $obj->clan_from = date('Y-m-d', strtotime($this->input->post('clan_from')));
            $obj->clan_to = date('Y-m-d', strtotime($this->input->post('clan_to')));
            $obj->lesson_day = implode(',', $this->input->post('lesson_day'));
            $obj->lesson_from = strtotime($this->input->post('lesson_from'));
            $obj->lesson_to = strtotime($this->input->post('lesson_to'));

            if ($this->input->post('same_addresss') != '1') {
                $obj->same_address = 0;
                $obj->address = $this->input->post('address');
                $obj->postal_code = $this->input->post('postal_code');
                $obj->city_id = $this->input->post('city_id');
                $obj->state_id = $this->input->post('state_id');
                $obj->country_id = $this->input->post('country_id');
                $obj->phone_1 = $this->input->post('phone_1');
                $obj->phone_2 = @$this->input->post('phone_2');
                $obj->email = $this->input->post('email');
            } else {
                $school = new School();
                $school->where('id', $this->input->post('school_id'))->get();
                $obj->same_address = 1;
                $obj->address = $school->address;
                $obj->postal_code = $school->postal_code;
                $obj->city_id = $school->city_id;
                $obj->state_id = $school->state_id;
                $obj->country_id = $school->country_id;
                $obj->phone_1 = $school->phone_1;
                $obj->phone_2 = $school->phone_2;
                $obj->email = $school->email;
            }

            $obj->user_id = $this->session_data->id;
            $obj->save();

            $this->session->set_flashdata('success', $this->lang->line('add_data_success'));
            redirect(base_url() . 'clan', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('add') . ' ' . $this->lang->line('clan'));

            $users = New User();
            $data['users'] = $users->getUsersByRole(5);

            $countries = New Country();
            $data['countries'] = $countries->get();

            $level = New Level();
            $data['levels'] = $level->get();

            $academy = New Academy();
            if ($this->session_data->role == '1' || $this->session_data->role == '2') {
                $data['academies'] = $academy->get();
            } else {
                $data['academies'] = $academy->getAcademyOfRector($this->session_data->id);
            }


            $this->layout->view('clans/add', $data);
        }
    }

    /*
    *   Edit the Clan
    *   Param1(required) : Clan id
    */
    function editClan($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $obj = new Clan();
                $obj->where('id', $id)->get();
                foreach ($this->config->item('custom_languages') as $key => $value) {
                    $temp = $key . '_class_name';
                    if ($this->input->post($temp) != '') {
                        $obj->$temp = $this->input->post($temp);
                    } else {
                        $obj->$temp = $this->input->post('en_class_name');
                    }
                }

                $obj->academy_id = $this->input->post('academy_id');
                $obj->school_id = $this->input->post('school_id');
                $obj->teacher_id = implode(',', $this->input->post('teacher_id'));
                $obj->level_id = $this->input->post('level_id');
                $obj->clan_from = date('Y-m-d', strtotime($this->input->post('clan_from')));
                $obj->clan_to = date('Y-m-d', strtotime($this->input->post('clan_to')));
                $obj->lesson_day = implode(',', $this->input->post('lesson_day'));
                $obj->lesson_from = strtotime($this->input->post('lesson_from'));
                $obj->lesson_to = strtotime($this->input->post('lesson_to'));

                if ($this->input->post('same_addresss') != '1') {
                    $obj->same_address = 0;
                    $obj->address = $this->input->post('address');
                    $obj->postal_code = $this->input->post('postal_code');
                    $obj->city_id = $this->input->post('city_id');
                    $obj->state_id = $this->input->post('state_id');
                    $obj->country_id = $this->input->post('country_id');
                    $obj->phone_1 = $this->input->post('phone_1');
                    $obj->phone_2 = @$this->input->post('phone_2');
                    $obj->email = $this->input->post('email');
                } else {
                    $school = new School();
                    $school->where('id', $this->input->post('school_id'))->get();
                    $obj->same_address = 1;
                    $obj->address = $school->address;
                    $obj->postal_code = $school->postal_code;
                    $obj->city_id = $school->city_id;
                    $obj->state_id = $school->state_id;
                    $obj->country_id = $school->country_id;
                    $obj->phone_1 = $school->phone_1;
                    $obj->phone_2 = $school->phone_2;
                    $obj->email = $school->email;
                }

                $obj->user_id = $this->session_data->id;
                $obj->save();

                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'clan', 'refresh');
            } else {
                $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('clan'));

                $obj = new Clan();
                $data['clan'] = $obj->where('id', $id)->get();

                $users = New User();
                $data['users'] = $users->getUsersByRole(5);

                $academy = New Academy();
                    if ($this->session_data->role == '1' || $this->session_data->role == '2') {
                        $data['academies'] = $academy->get();
                    } else if ($this->session_data->role == '3'){
                        $data['academies'] = $academy->getAcademyOfRector($this->session_data->id);
                    } else if ($this->session_data->role == '4'){
                        $data['academies'] = $academy->getAcademyOfDean($this->session_data->id);
                    } else if ($this->session_data->role == '5'){
                        $data['academies'] = $academy->getAcademyOfTeacher($this->session_data->id);
                    } else if ($this->session_data->role == '6'){
                        $data['academies'] = $academy->getAcademyOfStudent($this->session_data->id);
                    } else {
                        $data['academies'] = NULL;
                    }


                $school = new School();
                $data['schools'] = $school->where('academy_id', $obj->academy_id)->get();

                $countries = New Country();
                $data['countries'] = $countries->get();

                $states = New State();
                $data['states'] = $states->where('country_id', $obj->country_id)->get();

                $cities = New City();
                $data['cities'] = $cities->where('state_id', $obj->state_id)->get();

                $level = New Level();
                $data['levels'] = $level->get();

                $this->layout->view('clans/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'clan', 'refresh');
        }
    }

    /*
    *   Delete the Clan
    *   Param1(required) : Clan id
    */
    function deleteClan($id) {
        if (!empty($id)) {
            $clan = new Clan();
            $clan->where('id', $id)->get();
            /* foreach ($clan->School as $user) {
              $user->User_details->delete_all();
              }
              $clan->School->delete_all(); */
              $clan->delete();

              $this->session->set_flashdata('success', $this->lang->line('delete_data_success'));
              redirect(base_url() . 'clan', 'refresh');
          } else {
            $this->session->set_flashdata('error', $this->lang->line('delete_data_error'));
            redirect(base_url() . 'clan', 'refresh');
        }
    }

    /*
    *   List the Teachers of the Clan
    *   Param1(optional) : Clan id
    *   Param2(optional) : all, academy, school, clan
    */
    function clanTeacherList($id = 0, $type = 'all') {
        $this->layout->setField('page_title', $this->lang->line('list') . ' ' . $this->lang->line('teachers'));

        $academy = new Academy();
        $school = new School();
        $clan = new Clan();

        if ($id != 0 && $type == 'academy') {
            $data['all_academies'] = $academy->where('id', $id)->get();
            $data['all_schools'] = $academy->school->get();
            $data['all_clans'] = $academy->school->clan->get();

            $data['academy_id'] = $id;
        } else if ($id != 0 && $type == 'school') {
            $temp = $school->where('id', $id)->get();
            $data['all_schools'] = $school->where('academy_id', $temp->academy_id)->get();
            $data['all_academies'] = $school->academy->get();
            $data['all_clans'] = $school->clan->get();

            $data['academy_id'] = $temp->academy_id;
            $data['school_id'] = $id;
        } else if ($id != 0 && $type == 'clan') {
            $temp = $clan->where('id', $id)->get();
            $data['all_clans'] = $clan->where('school_id', $temp->school_id)->get();
            $data['all_schools'] = $clan->school->get();
            $data['all_academies'] = $clan->school->academy->get();

            $data['academy_id'] = $temp->academy_id;
            $data['school_id'] = $temp->school_id;
            $data['clan_id'] = $id;
        } else {
            if ($this->session_data->role == '1' || $this->session_data->role == '2') {
                $data['all_academies'] = $academy->get();
                $data['all_schools'] = $school->get();
                $data['all_clans'] = $clan->get();
            } else if ($this->session_data->role == '3') {
                $data['all_academies'] = $academy->getAcademyOfRector($this->session_data->id);
                $data['all_schools'] = $school->getSchoolOfRector($this->session_data->id);
                $data['all_clans'] = $clan->getClanOfRector($this->session_data->id);
            } else if ($this->session_data->role == '4') {
                $data['all_academies'] = $academy->getAcademyOfDean($this->session_data->id);
                $data['all_schools'] = $school->getSchoolOfDean($this->session_data->id);
                $data['all_clans'] = $clan->getClanOfDean($this->session_data->id);
            } else if ($this->session_data->role == '5') {
                $data['all_academies'] = $academy->getAcademyOfTeacher($this->session_data->id);
                $data['all_schools'] = $school->getSchoolOfTeacher($this->session_data->id);
                $data['all_clans'] = $clan->getClanOfTeacher($this->session_data->id);
            }
        }

        $this->layout->view('clans/teacher_list', $data);
    }

    /*
    *   List the Students of the Clan
    *   Param1(optional) : Clan id
    *   Param2(optional) : all, academy, school, clan
    */
    function clanStudentList($id = 0, $type = 'all') {
        $this->layout->setField('page_title', $this->lang->line('list') . ' ' . $this->lang->line('student'));

        $academy = new Academy();
        $school = new School();
        $clan = new Clan();

        if ($id != 0 && $type == 'academy') {
            $data['all_academies'] = $academy->where('id', $id)->get();
            $data['all_schools'] = $academy->school->get();
            $data['all_clans'] = $academy->school->clan->get();

            $data['academy_id'] = $id;
        } else if ($id != 0 && $type == 'school') {
            $temp = $school->where('id', $id)->get();
            $data['all_schools'] = $school->where('academy_id', $temp->academy_id)->get();
            $data['all_academies'] = $school->academy->get();
            $data['all_clans'] = $school->clan->get();

            $data['academy_id'] = $temp->academy_id;
            $data['school_id'] = $id;
        } else if ($id != 0 && $type == 'clan') {
            $temp = $clan->where('id', $id)->get();
            $data['all_clans'] = $clan->where('school_id', $temp->school_id)->get();
            $data['all_schools'] = $clan->school->get();
            $data['all_academies'] = $clan->school->academy->get();

            $data['academy_id'] = $temp->academy_id;
            $data['school_id'] = $temp->school_id;
            $data['clan_id'] = $id;
        } else {
            if ($this->session_data->role == '1' || $this->session_data->role == '2') {
                $data['all_academies'] = $academy->get();
                $data['all_schools'] = $school->get();
                $data['all_clans'] = $clan->get();
            } else if ($this->session_data->role == '3') {
                $data['all_academies'] = $academy->getAcademyOfRector($this->session_data->id);
                $data['all_schools'] = $school->getSchoolOfRector($this->session_data->id);
                $data['all_clans'] = $clan->getClanOfRector($this->session_data->id);
            } else if ($this->session_data->role == '4') {
                $data['all_academies'] = $academy->getAcademyOfDean($this->session_data->id);
                $data['all_schools'] = $school->getSchoolOfDean($this->session_data->id);
                $data['all_clans'] = $clan->getClanOfDean($this->session_data->id);
            } else if ($this->session_data->role == '5') {
                $data['all_academies'] = $academy->getAcademyOfTeacher($this->session_data->id);
                $data['all_schools'] = $school->getSchoolOfTeacher($this->session_data->id);
                $data['all_clans'] = $clan->getClanOfTeacher($this->session_data->id);
            }
        }

        $this->layout->view('clans/student_list', $data);
    }

    /*
    *   List the student who request for trial lesson
    *   Param1(required) : Clan id
    */
    function listTrialLessonRequest($clan_id = null) {
        if(!is_null($clan_id)){
            if(!validAcess($clan_id, 'clan')){
                $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
                redirect(base_url() . 'dashboard', 'refresh'); 
            }
            $clan = new Clan();
            //Get the Clan Details
            $data['clan_details'] = $clan->where('id', $clan_id)->get();    
        } else{
            $data['clan_details'] = null;
        }
        
        $this->layout->view('clans/trial_lesson_request', $data);
    }

    /*
    *   Change the Status of the student who applied for trail lesson from Pending => Approved or Unapproved
    *   Param1(required) : Clan id
    *   Param2(required) : Student id
    *   Param3(optional) : any text (e.g. : notification)
    */
    function changeStatusTrialStudent($clan_id, $student_master_id, $type = null) {

        //Update the Notifications
        if ($type == 'notification') {
            Notification::updateNotification('apply_trial_lesson', $this->session_data->id, $student_master_id);
            Notification::updateNotification('trial_lesson_approved', $this->session_data->id, $student_master_id);
            Notification::updateNotification('trial_lesson_unapproved', $this->session_data->id, $student_master_id);
        }

        //check that Data is passed or not
        if (!empty($student_master_id)) {
            $userdetail = new Userdetail();
            //Get the Student Extra Details
            $userdetail->where(array('student_master_id' => $student_master_id, 'clan_id' => $clan_id))->get();
            //Get the Student Full Details
            $obj_user = $userdetail->User->get();

            //Student Exit or not
            if ($userdetail->result_count() == 1) {
                //Check Update the data or Render View
                if ($this->input->post() !== false) {

                    //Update the Stauts
                    $userdetail->where(array('student_master_id' => $student_master_id, 'clan_id' => $clan_id))->update('status', $this->input->post('status'));

                    //Udate who approved
                    $userdetail->where(array('student_master_id' => $student_master_id, 'clan_id' => $clan_id))->update('approved_by', $this->session_data->id);

                    //Set notification type
                    $notification_type = 'trial_lesson_unapproved';
                    //Set email type
                    $email_type = 'trial_lesson_rejected';

                    if ($this->input->post('status') == 'A') {
                        $attadence = new Attendance();
                        //update record and set new type of notifications
                        $attadence->clan_date = $userdetail->first_lesson_date;
                        $attadence->student_id = $userdetail->student_master_id;
                        $attadence->user_id = $this->session_data->id;
                        $attadence->save();

                        //Set notification type
                        $notification_type = 'trial_lesson_approved';
                        //Set email type
                        $email_type = 'trial_lesson_accepted';
                    } else if ($this->input->post('status') == 'U') {
                        $attadence = new Attendance();
                        //get details of student
                        $attadence->where(array('student_id' => $student_master_id, 'clan_date' => $userdetail->first_lesson_date))->get();
                        //Delete that record
                        $attadence->delete();
                    }

                    //Send notification to student
                    $notification = new Notification();
                    $notification->type = 'N';
                    $notification->notify_type = $notification_type;
                    $notification->from_id = $this->session_data->id;
                    $notification->to_id = $userdetail->student_master_id;
                    $notification->object_id = $userdetail->student_master_id;
                    $notification->data = serialize($this->input->post());
                    $notification->save();

                    $email = new Email();
                    //get the mail templates
                    $email->where('type', $email_type)->get();
                    $message = $email->message;

                    //replace appropriate varaibles
                    $message = str_replace('#firstname', $obj_user->firstname, $message);
                    $message = str_replace('#lastname', $obj_user->lastname, $message);
                    $message = str_replace('#clan_name', $clan->en_class_name, $message);
                    $message = str_replace('#teacher_name', $this->session_data->name, $message);

                    if($email_type == 'trial_lesson_accepted'){
                        $message = str_replace('#lesson_date', date('d-m-Y', strtotime($userdetail->first_lesson_date)), $message);
                        $message = str_replace('#apply_date', date('d-m-Y', strtotime($userdetail->timestamp)), $message);
                        $message = str_replace('#accept_date', date('d-m-Y', strtotime(get_current_date_time()->get_date_time_for_db())), $message);
                    }else if($email_type == 'trial_lesson_rejected'){
                        $message = str_replace('#lesson_date', date('d-m-Y', strtotime($userdetail->first_lesson_date)), $message);
                        $message = str_replace('#apply_date', date('d-m-Y', strtotime($userdetail->timestamp)), $message);
                        $message = str_replace('#reject_date', date('d-m-Y', strtotime(get_current_date_time()->get_date_time_for_db())), $message);
                    }

                    //get all the ids who's role is ADMIN
                    $ids = array();
                    $ids[] = User::getAdminIds();

                    $clan = new Clan();
                    //get Clan Detail
                    $clan->where('id', $clan_id)->get();
                    //get All ids of the Teacher, Dean, Rector of that Clan
                    $ids[] = array_unique(explode(',', $clan->school->academy->rector_id . ',' . $clan->school->dean_id . ',' . $clan->teacher_id));

                    //form multidimesional array to single array and get all unique values.
                    $final_ids = array_unique(MultiArrayToSinlgeArray($ids));

                    $user = new User();
                    //get all the details of the ids we get.
                    $user->where_in('id', $final_ids)->get();

                    foreach ($user as $value) {
                        if ($value->id != $this->session_data->id) {
                            //Send Notification
                            $notification = new Notification();
                            $notification->type = 'N';
                            $notification->notify_type = $notification_type;
                            $notification->from_id = $this->session_data->id;
                            $notification->to_id = $value->id;
                            $notification->object_id = 0;
                            $notification->data = serialize($this->input->post());
                            $notification->save();

                            //Send Email
                            $check_privacy = unserialize($value->email_privacy);
                            if(is_null($check_privacy) || $check_privacy[$email_type] == 1){
                                $option = array();
                                $option['tomailid'] = $value->email;
                                $option['subject'] = $email->subject;
                                $option['message'] = $message;
                                if (!is_null($email->attachment)) {
                                    $option['attachement'] = 'assets/email_attachments/' . $email->attachment;
                                }
                                send_mail($option);
                            }
                        }
                    }

                    $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                    redirect(base_url() . 'clan/trial_lesson_request/' . $clan_id, 'refresh');
                } else {

                    $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('trial_lesson'));
                    
                    //Set necessary variables for view
                    $data['userdetail'] = $userdetail;
                    $data['profile'] = $userdetail->User->get();
                    $data['clan'] = $userdetail->Clan->get();
                    $data['show_approved_button'] = false;
                    $data['show_unapproved_button'] = false;
                    $data['show_accept_button'] = false;

                    //if the current user is teacher then only show button
                    if($this->session_data->role == 5){
                        //check status and Show buttons.
                        if($userdetail->status == 'P' && $userdetail->approved_by == 0){
                            $data['show_approved_button'] = true;
                            $data['show_unapproved_button'] = true;                            
                        }else if(($userdetail->status == 'A' || $userdetail->status == 'U') && $userdetail->approved_by == $this->session_data->id){
                            $data['show_unapproved_button'] = true;                          
                        }
                    }

                    $this->layout->view('clans/approve_trial_request', $data);
                }
            } else {
                $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
                redirect(base_url() . 'clan/trial_lesson_request/' . $clan_id, 'refresh');
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'clan/trial_lesson_request/' . $clan_id, 'refresh');
        }
    }

    /*
    *   List the student of the clan for the attendance
    *   Param1(required) : Clan id
    *   Param2(required) : Date
    */
    function clanAttendances($clan_id, $date){
        if(!validAcess($clan_id, 'clan')){
            $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
            redirect(base_url() . 'dashboard', 'refresh'); 
        }

        $clan = New Clan();

        //get the Number of day like Monday : 1 .... Sunday : 7
        $day_numeric = date('N', strtotime($date));

        //Role Super Admin or Admin
        if($this->session_data->role == 1 || $this->session_data->role == 2){
            /*
            *   get the Cland details
            *   Param1(required) : Clan ID
            *   Param2(required) : Day in Number like Monday : 1 .... Sunday : 7
            */
            $details = $clan->getClansDetailsByDay($clan_id,$day_numeric);
        }else{
            /*
            *   get the Cland details
            *   Param1(required) : Clan ID
            *   Param3(required) : Day in Number like Monday : 1 .... Sunday : 7
            */
            $details = $clan->getClansDetailsByIdAndDay($clan_id, $day_numeric);    
        }

        if(!$details){
            $obj_clan_date = new Clandate();
            $obj_clan_date->where(array('clan_id'=>$clan_id, 'clan_date' => $date))->get();
            if($obj_clan_date->result_count() == 1){
                $details = true;
            }
        }
        

        //Current Date
        $current_date = get_current_date_time()->get_date_for_db();
        
        //check if recored exits or not
        if($details){ 
            //get the full clan details
            $clan = $clan->where(array('id'=>$clan_id))->get();    

            //Get all the Students of that Clans.
            $userdetails = $clan->Userdetail->where('status', 'A')->get();

            //check if students exits or not
            if($userdetails->result_count() > 0){
                foreach ($userdetails as $value) {
                    //get the Student full detail
                    $temp = $value->User->get();
                    if($temp->status != 'A'){
                        if($value->status == 'A' && strtotime($value->first_lesson_date) == strtotime($date)){
                            $attadence = new Attendance();

                            //get the Student is present or not
                            $attadence->where(array('clan_date'=>$date, 'student_id'=>$temp->id))->get();

                            //Set an array of user details for view part 
                            $data['userdetails'][] = array(
                                'id'=>$temp->id, 
                                'firstname'=>$temp->firstname, 
                                'lastname'=>$temp->lastname,
                                'attadence' => $attadence->attendance,
                                'attadence_id' => $attadence->id,
                                'clan' => $clan->{$this->session_data->language.'_class_name'},
                                'school' => $clan->School->{$this->session_data->language.'_school_name'},
                                'academy' => $clan->School->Academy->{$this->session_data->language.'_academy_name'},
                                'type' => 'trial');
                        }
                    } else {
                        if(!is_null($temp->id)){
                            $attadence = new Attendance();

                            //get the Student is present or not
                            $attadence->where(array('clan_date'=>$date, 'student_id'=>$temp->id))->get();

                            //Set an array of user details for view part 
                            $data['userdetails'][] = array(
                                'id'=>$temp->id, 
                                'firstname'=>$temp->firstname, 
                                'lastname'=>$temp->lastname,
                                'attadence' => $attadence->attendance,
                                'attadence_id' => $attadence->id,
                                'clan' => $clan->{$this->session_data->language.'_class_name'},
                                'school' => $clan->School->{$this->session_data->language.'_school_name'},
                                'academy' => $clan->School->Academy->{$this->session_data->language.'_academy_name'},
                                'type' => 'regular'); 
                        }
                    }
                }
            }

            $obj_recover = new Attendancerecover();
            //Check for any recovery student is there.
            $obj_recover->where(array('clan_date'=>$date, 'clan_id'=>$clan_id))->get();

            //check if students exits or not
            if($obj_recover->result_count() > 0){
                foreach ($obj_recover as $student) {

                    $userdetail = new Userdetail();
                    $userdetail->where('student_master_id', $student->student_id)->get();
                    //get the Student full detail
                    $user = $userdetail->User->get();
                    //get the Student Clan full detail
                    $clan = $userdetail->Clan->get();

                    $recover = new Attendancerecover();
                    //get the recovery record
                    $recover->where(array('clan_date'=>$date, 'clan_id'=>$clan_id, 'student_id'=>$student->student_id))->get();

                    if($user->result_count() == 1){
                         //Set an array of user details for view part 
                        $data['userdetails'][] = array(
                            'id'=>$user->id, 
                            'firstname'=>$user->firstname, 
                            'lastname'=>$user->lastname,
                            'attadence' => $recover->attendance, 
                            'attadence_id' => $recover->attendance_id,
                            'clan' => $clan->{$this->session_data->language.'_class_name'},
                            'school' => $clan->School->{$this->session_data->language.'_school_name'},
                            'academy' => $clan->School->Academy->{$this->session_data->language.'_academy_name'},
                            'type' => 'recover');
                    }
                }
            }

            //Sert null if variable is not set
            if(!isset($data['userdetails'])){
                $data['userdetails'] = null;
            }

            //Set variable for view part
            $data['show_save_button'] = false;
            $data['current_date'] = $current_date;
            $data['clan_details'] = $clan;
            $data['date'] = $date;
            $time_from = strtotime(date('Y-m-d H:i:s', strtotime($date . date('H:i',$clan->lesson_from))));
            $time_to = strtotime(date('Y-m-d H:i:s', strtotime($date . date('H:i',$clan->lesson_to))));
            $time_2 = strtotime(get_current_date_time()->get_date_time_for_db());
            
            if(strtotime(get_current_date_time()->get_date_for_db()) == strtotime($date)){
                if($time_2 >= $time_from && $time_2 <= $time_to){
                    $data['show_save_button'] = true;
                }
            }
            
            $this->layout->view('clans/attadence_view', $data);
        }else{
            $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
            redirect(base_url() . 'dashboard', 'refresh'); 
        }
    }

    /*
    *   Save the attendance for the clan 
    *   Param1(required) : Clan id
    */
    function saveClanAttendances($clan_id){
        //check that clan id is passed or not
        if (!empty($clan_id)) {
            //check that data is post or views is to be render
            if ($this->input->post() !== false) {

                //get all the regular student and make absent or present
                if($this->input->post('regular_user_id') !== false) {
                    foreach ($this->input->post('regular_user_id') as $regular_key => $regular_value) {
                        $attadence = new Attendance();
                        //get the attendance record 
                        $attadence->where(array('clan_date'=>$this->input->post('date'), 'student_id'=>$regular_key))->get();
                        //update the value
                        $attadence->clan_date = $this->input->post('date');
                        $attadence->student_id = $regular_key;
                        $attadence->attendance = $regular_value;
                        //$attadence->user_id = $this->session_data->id;
                        $attadence->save();
                    }
                }

                //get all the recovery student and make absent or present
                if($this->input->post('recover_user_id') !== false) {
                    foreach ($this->input->post('recover_user_id') as $recover_key => $recover_value) {
                        $recover = new Attendancerecover();
                        //get the attendance recovery record 
                        $recover->where(array('clan_id'=>$clan_id,'clan_date'=>$this->input->post('date'),'student_id'=>$recover_key))->get();

                        //update the value
                        $recover->update('attendance', $recover_value);
                    }
                }
            }
        }

        $this->session->set_flashdata('success', $this->lang->line('attendance_save_successfully'));
        redirect(base_url() .'clan/clan_attendance/' . $clan_id .'/'. $this->input->post('date'), 'refresh');
    }

    /*
    *   Make next week attendance of the clan 
    *   Param1(required) : Clan id
    */
    function nextWeekAttendances($clan_id){
        //Check clan id is passed or not
        if(!empty($clan_id)){
            $clan = New Clan();
            //Role Super Admin or Admin => get the clan details
            if($this->session_data->id == 1 || $this->session_data->id == 2){
                $clan = $clan->where(array('id'=>$clan_id))->get();    
            }else {
                $clan = $clan->where(array('id'=>$clan_id, 'teacher_id'=>$this->session_data->id))->get();    
            }

            //check if the clan exits.
            if($clan->result_count() == 1){
                //Current date
                $current_date = get_current_date_time()->get_date_for_db();
                
                //Add 1 day in current date
                $start_date = date('Y-m-d', strtotime('+1 day', strtotime($current_date)));
                
                //Add 1 week in current date
                $end_date = date('Y-m-d', strtotime('+1 week', strtotime($current_date)));

                //get the days on which the clan has lessons.
                $days = explode(',', $clan->lesson_day);

                //get the day number form current date
                $curr = date('N', strtotime($current_date));

                //get the custom array of the days made in config.
                $days_name = $this->config->item('custom_days');

                //get the Next lesson of the clan
                if(getArrayNexyValue($days, $curr)){
                    $next_day = $days_name[getArrayNexyValue($days, $curr)]['en'];    
                }else{
                    $next_day = $days_name[getArrayPreviousValue($days, $curr)]['en'];
                }

                /*
                *   Make dates from the 2 dates
                *   Param1(required) : Day Name ... 1:Monday ..... 7:Sunday
                *   Param2(required) : Start Date
                *   Param2(required) : End Date
                */
                $next_date = getDateByDay($next_day, $start_date, $end_date);
                //Take the last date .. though it will return on 1 date.
                $next_date = end($next_date);

                //Get all the Student in that Clan.
                $userdetails = $clan->Userdetail->where('status', 'A')->get();

                //if Student Exit 
                if($userdetails->result_count() > 0){
                    foreach ($userdetails as $value) {
                        //get the Student full detail
                        $temp = $value->User->get();
                        if(strtotime($value->first_lesson_date) > strtotime($next_date)){
                            continue;
                        } else {
                            $attadence = new Attendance();
                            //Check any record exit for date and student
                            $attadence->where(array('clan_date'=>$next_date, 'student_id'=>$value->student_master_id))->get();
                            if($attadence->result_count() == 1){
                                $attadence->attendance = $attadence->attendance;
                            }else{
                                $attadence->attendance = 1;
                            }
                            $attadence->clan_date = $next_date;
                            $attadence->student_id = $value->student_master_id;
                            $attadence->user_id = $this->session_data->id;
                            $attadence->save();  
                        }
                    }
                    $this->session->set_flashdata('success', $this->lang->line('attendance_next_week_done'));
                } else {
                    $this->session->set_flashdata('info', $this->lang->line('no_student_exit'));
                }
            }else{
                $this->session->set_flashdata('error', $this->lang->line('no_data_exit'));
            }
        }else{
            $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
        }

        redirect(base_url() . 'dashboard', 'refresh'); 
    }

    /*
    *   Get the same level of the clan
    *   Used for the Recovery Class option
    *   Param1(required) : Clan id
    */
    function getSameLevelClans($clan_id) {
        $obj_clan = new Clan();
        //get the details of the clan
        $obj_clan->where('id', $clan_id)->get();

        /*
        *   get the Same Level of the Clan for Recovery Option
        *   Param1(required) : City ID
        *   Param2(required) : Level ID
        */
        $check = $obj_clan->getSameLevelClan($obj_clan->city_id, $obj_clan->level_id);

        //check wether any clan exits.
        $str = NULL;
        if ($check !== FALSE) {
            //the return value is multidimensional convert it to single dimensional
            $array = MultiArrayToSinlgeArray($check);

            //remove the current clan id
            if(($key = array_search($obj_clan->id, $array)) !== false) {
                unset($array[$key]);
            }

            //Again check where return is not empty
            if(count($array) > 0){
                //get all the Clan details and make HTML.
                $clans = $obj_clan->where_in('id', $array)->get();;
                $str .= '<h4 class="text-center text-black">Select Recovery Clan</h4>';
                $str .= '<div class="row">';
                foreach ($clans as $clan) {
                    $str .= '<div class="col-lg-4">';
                    $str .= '<div class="radio padding-left-killer">';
                    $str .= '<label>';
                    $str .= '<input type="radio" value="'. $clan->id .'" class="i-grey-square required" name="clan_id">';
                    $str .= $clan->{$this->session_data->language.'_class_name'};
                    $str .= '</label>';
                    $str .= '</div>';
                    $str .= '</div>';
                    $str .= "\n";
                }
                $str .= '</div>';
                $str .= '<div id="clan-dates-selection"></div>';
            }else {
                $str = 'No Clans';
            }
        }else{
            $str = 'No Clans';
        }

        echo $str;
    }

    /*
    *   Get next dates of the clans
    *   Used for the Recovery Class option
    *   Param1(required) : Clan id
    */
    function getDateOfClanForTeacher($clan_id) {
        $clan = new Clan();
        /*
        *   get the next dates for the clan 
        *   Param1(required) : Clan ID
        *   Param2(required) : Total no of dates to be return
        *   Param2(optional) : Check Student limit in Clan
        */
        $dates = $clan->getAviableDateFromClan($clan_id, 5, 20);

        //Get the Clan details to dispaly Timinig of the Clan.
        $clan->where('id', $clan_id)->get();

        //Make the whole HTML And send to view
        $str = NULL;
        $str .= '<h4 class="text-center text-black"> Class Timing : ' . date('H.i a', $clan->lesson_from) . '  - ' . date('H.i a', $clan->lesson_to) . '</h4>';
        $str .= '<div class="row">';
        $str .= '<label for="absence_date" class="error col-lg-12 text-center" style="display:none"></label>';
        foreach ($dates as $date) {
            $str .= '<div class="col-lg-6">';
            $str .= '<div class="radio padding-left-killer">';
            $str .= '<label>';
            $str .= '<input type="radio" value="'. $date .'" class="i-grey-square required" name="date">';
            $str .= date("l, j<\s\u\p>S</\s\u\p> F Y", strtotime($date));;
            $str .= '</label>';
            $str .= '</div>';
            $str .= '</div>';
            $str .= "\n";
        }
        $str .= '</div>';

        echo $str;
    }

    //save the recovery class for student set by teacher
    function changeDateStudentByTeacher(){
        $recover = new Attendancerecover();
        //check where attendance revoce exits
        $recover->where('attendance_id', $this->input->post('attendance_id'))->get();

        //Set the necessary data
        $recover->attendance_id = $this->input->post('attendance_id');
        $recover->clan_date = $this->input->post('date');
        $recover->clan_id = $this->input->post('clan_id');
        $recover->student_id = $this->input->post('student_id');
        if(!empty($recover->stored->history)){
            $temp = unserialize($recover->stored->history);
            $to_array = objectToArray($recover->stored);
            unset($to_array['history']);
            $temp[$this->input->post('date')] = $to_array;
        } else {
            $to_array = objectToArray($recover->stored);
            unset($to_array['history']);
            $temp[$this->input->post('date')] = $to_array;
        }
        $recover->history = serialize($temp);
        $recover->user_id = $this->session_data->id;
        $recover->timestamp = get_current_date_time()->get_date_time_for_db();
        $recover->save();

        /*
        * Send Student Notification and Email about schedule change...
        */
        $notification = new Notification();
        $notification->type = 'N';
        $notification->notify_type = 'recovery_assign_by_teacher_student';
        $notification->from_id = $this->session_data->id;
        $notification->to_id = $this->input->post('student_id');
        $notification->object_id = $recover->id;
        $notification->data = serialize($this->input->post());
        $notification->save();

        //get selected caln details
        $clan = new Clan();
        $clan->where('id', $this->input->post('clan_id'))->get();

        //get selected User details
        $user = new User();
        $user->where('id', $this->input->post('student_id'))->get();

        $check_privacy = unserialize($user->email_privacy);
        if(is_null($check_privacy) || $check_privacy['teacher_recovery_student_for_student'] == 1){
            //get email details
            $email = new Email();
            $email->where('type', 'teacher_recovery_student_for_student')->get();
            $message = $email->message;

            //replace newcessary details
            $message = str_replace('#student_name', $user->firstname .' ' . $user->lastname , $message);
            $message = str_replace('#teacher_name', $this->session_data->name, $message);
            $message = str_replace('#recover_clan', $clan->en_class_name, $message);
            $message = str_replace('#date', date('d-m-Y', strtotime($this->input->post('date'))), $message);

            //set option for sending mail
            $option = array();
            $option['tomailid'] = $user->email;
            $option['subject'] = $email->subject;
            $option['message'] = $message;
            if (!is_null($email->attachment)) {
                $option['attachement'] = 'assets/email_attachments/' . $email->attachment;
            }
            send_mail($option);
        }

        /*
        * Send Recover Clan Teacher Notification and Email about schedule change...
        */
        $notification = new Notification();
        $notification->type = 'N';
        $notification->notify_type = 'recovery_assign_by_teacher_teacher';
        $notification->from_id = $this->session_data->id;
        $notification->to_id = $clan->teacher_id;
        $notification->object_id = $recover->id;
        $notification->data = serialize($this->input->post());
        $notification->save();

        //get Teacher detail of selected clan
        $teacher = new User();
        $teacher->where('id', $clan->teacher_id)->get();

         $check_privacy = unserialize($teacher->email_privacy);
        if(is_null($check_privacy) || $check_privacy['teacher_recovery_student_for_teacher'] == 1){
            //get email details
            $email = new Email();
            $email->where('type', 'teacher_recovery_student_for_teacher')->get();
            $message = $email->message;

            //replace newcessary details
            $message = str_replace('#student_name', $user->firstname .' ' . $user->lastname , $message);
            $message = str_replace('#receiver_teacher', $teacher->firstname .' ' . $teacher->lastname, $message);
            $message = str_replace('#sender_teacher', $this->session_data->name, $message);
            $message = str_replace('#recover_clan', $clan->en_class_name, $message);
            $message = str_replace('#date', date('d-m-Y', strtotime($this->input->post('date'))), $message);

            //set option for sending mail
            $option = array();
            $option['tomailid'] = $teacher->email;
            $option['subject'] = $email->subject;
            $option['message'] = $message;
            if (!is_null($email->attachment)) {
                $option['attachement'] = 'assets/email_attachments/' . $email->attachment;
            }
            send_mail($option);
        }

        echo json_encode(array('status'=>true,'student_id'=>$this->input->post('student_id')));
    }

    /*
    *   Shift the Clan from one date to another
    *   Param1(required) : Clan id
    */
    function changeClanDate($clan_id){
        $obj_clan_date = new Clandate();
        $obj_clan_date->where('clan_id',$clan_id);
        $obj_clan_date->where('clan_date', $this->input->post('clan_shift_from'));
        $obj_clan_date->or_where('clan_shift_from', $this->input->post('clan_shift_from'));
        $obj_clan_date->get();

        $obj_clan_date->clan_id = $clan_id;
        $obj_clan_date->type = 'S';
        $obj_clan_date->clan_date = date('Y-m-d', strtotime($this->input->post('clan_date')));
        $obj_clan_date->clan_shift_from = $this->input->post('clan_shift_from');
        $obj_clan_date->description = @$this->input->post('description');
        $obj_clan_date->user_id = $this->session_data->id;
        $obj_clan_date->save();

        $ids = Userdetail::getAssignStudentIdsByCaln($clan_id);
        $user = new User();
        $user->where_in('id', $ids);
        foreach ($user->get() as $value) {
            if($value->role_id == 6 && $value->status == 'P'){
                $user_details = new Userdetail();
                $user_details->where(array('clan_id'=>$clan_id,'student_master_id'=>$value->id,'first_lesson_date' =>$this->input->post('clan_shift_from') ,'status'=>'A'))->get();
                $user_details->first_lesson_date = date('Y-m-d', strtotime($this->input->post('clan_date')));
                $user_details->save();
            }
        }

        if($this->input->post('notify') == 1){
            $this->_changeClanDateNofification($obj_clan_date->id, $clan_id, $this->input->post());
        }
        

        redirect(base_url().'clan/view/'. $clan_id, 'refresh');
    }

    function deleteClanDate($id){
        $obj_clan_date = new Clandate();
        $obj_clan_date->where('id', $id)->get();
        $return = false;
        if(strtotime(get_current_date_time()->get_date_for_db()) < strtotime($obj_clan_date->clan_date) && $obj_clan_date->type == 'S'){

            $arr = array();
            $arr['clan_id'] = $obj_clan_date->clan_id;
            $arr['clan_shift_from'] = $obj_clan_date->clan_date;
            $arr['clan_date'] = $obj_clan_date->clan_shift_from;
            $arr['description'] = $obj_clan_date->description;
            $arr['notify'] = $this->input->post('notify');

            $obj_clan_date->type = 'R';
            $obj_clan_date->clan_date = $obj_clan_date->clan_shift_from;
            $obj_clan_date->clan_shift_from = null;
            $obj_clan_date->description = null;
            $obj_clan_date->save();
            $return = true;

            $ids = Userdetail::getAssignStudentIdsByCaln($obj_clan_date->clan_id);
            $user = new User();
            $user->where_in('id', $ids);
            foreach ($user->get() as $value) {
                if($value->role_id == 6 && $value->status == 'P'){
                    $user_details = new Userdetail();
                    $user_details->where(array('clan_id'=>$obj_clan_date->clan_id,'student_master_id'=>$value->id,'first_lesson_date' =>$arr['clan_shift_from'] ,'status'=>'A'))->get();
                    $user_details->first_lesson_date = date('Y-m-d', strtotime($arr['clan_date']));
                    $user_details->save();
                }
            }

            if($this->input->post('notify') == 1){
                $this->_changeClanDateNofification($obj_clan_date->id, $obj_clan_date->clan_id, $arr);
            }
        }

        echo json_encode(array('return'=>$return));
    }

    private function _changeClanDateNofification($id, $clan_id, $post){
        $clan = new Clan();
        //For Email and Notification get Clan related Rectors, Deans, Teacher
        $clan->where('id', $clan_id)->get();
        $ids[] = array_unique(explode(',', $clan->school->academy->rector_id . ',' . $clan->school->dean_id . ',' . $clan->teacher_id));
        $ids[] = Userdetail::getAssignStudentIdsByCaln($clan_id);

        //Make single array form all ids
        $final_ids = array_unique(MultiArrayToSinlgeArray($ids));

        //remove the current userid from the retun ids.
        if (($key = array_search($this->session_data->id, $final_ids)) !== false) {
            unset($final_ids[$key]);
        }

        if(count($final_ids) > 0){
            $user = new User();
            //Fecth all the Rector, Dean, Teacher details
            $user->where_in('id', $final_ids);

            //Compose message for Trial Lesson Request and replace  necessary things
            $email = new Email();
            $email->where('type', 'change_clan_date')->get();
            $message = $email->message;
            
            //loop through for notification and mail
            foreach ($user->get() as $value) {
                //Send Notification
                $notification = new Notification();
                $notification->type = 'N';
                $notification->notify_type = 'change_clan_date';
                $notification->from_id = $this->session_data->id;
                $notification->to_id = $value->id;
                $notification->object_id = $id;
                $notification->data = serialize($post);
                $notification->save();

                $check_privacy = unserialize($value->email_privacy);
                if(is_null($check_privacy) || $check_privacy['change_clan_date'] == 1){
                    //Send Email
                    $option = array();
                    $message = NULL;
                    $message = $email->message;
                    $message = str_replace('#user_name', $value->firstname.' '.$value->lastname, $message);
                    $message = str_replace('#clan_name', $clan->en_class_name, $message);
                    $message = str_replace('#school_name', $clan->school->en_school_name, $message);
                    $message = str_replace('#academy_name', $clan->school->academy->en_academy_name, $message);
                    $message = str_replace('#from_date', date('d-m-Y', strtotime($post['clan_shift_from'])), $message);
                    $message = str_replace('#to_date', date('d-m-Y', strtotime($post['clan_date'])), $message);
                    $message = str_replace('#authorized_user_name', $this->session_data->name, $message);
                    
                    $option['tomailid'] = $value->email;
                    $option['subject'] = $email->subject;
                    $option['message'] = $message;
                    if (!is_null($email->attachment)) {
                        $option['attachement'] = 'assets/email_attachments/' . $email->attachment;
                    }
                    send_mail($option);
                }
            }
        }

        return true;
    }

}