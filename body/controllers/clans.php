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
        } else {
            $school = new School();
            $data['schools'] = $school->getSchoolOfRector($this->session_data->id);
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
            $data['school'] = $obj->School->get();
            $data['academy'] = $obj->School->Academy->get();
            $userdetails = $obj->Userdetail->get();
            if($userdetails->result_count() > 0){
                foreach ($userdetails as $value) {
                    $user = $value->User->get();
                    if(!is_null($user->id)){
                        $data['students'][] = $user->stored;
                    }
                }
            } else {
                $data['students'] = null;
            } 

            if(!isset($data['students'])){
                $data['students'] = null;
            }

            $this->layout->view('clans/view_single', $data);
        }
    }

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
                } else {
                    $data['academies'] = $academy->where('rector_id', $this->session_data->id)->get();
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

    function listTrialLessonRequest($clan_id) {
        $clan = new Clan();
        $data['clan_details'] = $clan->where('id', $clan_id)->get();
        $this->layout->view('clans/trial_lesson_request', $data);
    }

    function changeStatusTrialStudent($clan_id, $student_master_id, $type = null) {
        if ($type == 'notification') {
            Notification::updateNotification('apply_trial_lesson', $this->session_data->id, $student_master_id);
            Notification::updateNotification('trial_lesson_approved', $this->session_data->id, $student_master_id);
            Notification::updateNotification('trial_lesson_unapproved', $this->session_data->id, $student_master_id);
        }

        if (!empty($student_master_id)) {
            $userdetail = new Userdetail();
            $userdetail->where(array('student_master_id' => $student_master_id, 'clan_id' => $clan_id))->get();

            $obj_user = new User();
            $obj_user->where('id', $student_master_id)->get();
            if ($userdetail->result_count() == 1) {
                if ($this->input->post() !== false) {

                    $userdetail->where(array('student_master_id' => $student_master_id, 'clan_id' => $clan_id))->update('status', $this->input->post('status'));
                    $userdetail->where(array('student_master_id' => $student_master_id, 'clan_id' => $clan_id))->update('approved_by', $this->session_data->id);

                    $notification_type = 'trial_lesson_unapproved';
                    $email_type = 'trial_lesson_rejected';

                    if ($this->input->post('status') == 'A') {
                        $attadence = new Attendance();
                        $attadence->clan_date = $userdetail->first_lesson_date;
                        $attadence->student_id = $userdetail->student_master_id;
                        $attadence->user_id = $this->session_data->id;
                        $attadence->save();
                        $notification_type = 'trial_lesson_approved';
                        $email_type = 'trial_lesson_accepted';
                    } else if ($this->input->post('status') == 'U') {
                        $attadence = new Attendance();
                        $attadence->where(array('student_id' => $student_master_id, 'clan_date' => $userdetail->first_lesson_date))->get();
                        $attadence->delete();
                    } else if ($this->input->post('status') == 'AS') {
                        $user = new User();
                        $user->where(array('id' => $student_master_id))->update('status', 'A');
                        $notification_type = 'accept_as_student';
                        $email_type = 'accepted_as_student';
                    }

                    $notification = new Notification();
                    $notification->type = 'N';
                    $notification->notify_type = $notification_type;
                    $notification->from_id = $this->session_data->id;
                    $notification->to_id = $userdetail->student_master_id;
                    $notification->object_id = $userdetail->student_master_id;
                    $notification->data = serialize($this->input->post());
                    $notification->save();


                    $ids = array();
                    $ids[] = User::getAdminIds();

                    $clan = new Clan();
                    $clan->where('id', $this->input->post('clan_id'))->get();
                    $ids[] = array_unique(explode(',', $clan->school->academy->rector_id . ',' . $clan->school->dean_id . ',' . $clan->teacher_id));

                    $final_ids = array_unique(MultiArrayToSinlgeArray($ids));
                    $user = new User();
                    $user->where_in('id', $final_ids);

                    $email = new Email();
                    $email->where('type', $email_type)->get();
                    $message = $email->message;
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
                    } if($email_type == 'accepted_as_student'){
                        $message = str_replace('#accept_date', date('d-m-Y', strtotime(get_current_date_time()->get_date_time_for_db())), $message);
                    }

                    foreach ($user->get() as $value) {
                        if ($value->id == $this->session_data->id) {
                            continue;
                        } else {
                            $notification = new Notification();
                            $notification->type = 'N';
                            $notification->notify_type = $notification_type;
                            $notification->from_id = $this->session_data->id;
                            $notification->to_id = $value->id;
                            $notification->object_id = 0;
                            $notification->data = serialize($this->input->post());
                            $notification->save();

                            $option = array();
                            $option['tomailid'] = $value->email;
                            $option['subject'] = $email->subject;
                            $option['message'] = $message;
                            if (!is_null($email->attachment)) {
                                $option['attachement'] = base_url() . 'assets/email_attachments/' . $email->attachment;
                            }

                            if (send_mail($option)) {
                                //$mail->where('id', $value->id)->update('status', 1);
                            }
                        }
                    }

                    $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                    redirect(base_url() . 'clan/trial_lesson_request/' . $clan_id, 'refresh');
                } else {
                    $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('trial_lesson'));
                    $data['userdetail'] = $userdetail;
                    $data['profile'] = $userdetail->User->get();
                    $data['clan'] = $userdetail->Clan->get();
                    $data['show_approved_button'] = false;
                    $data['show_unapproved_button'] = false;
                    $data['show_accept_button'] = false;

                    if($this->session_data->role == 5){
                        if($userdetail->status == 'P' && $userdetail->approved_by == 0){
                            $data['show_approved_button'] = true;
                            $data['show_accept_button'] = true;                            
                        }else if(($userdetail->status == 'A' || $userdetail->status == 'U') && $userdetail->approved_by == $this->session_data->id){
                            $data['show_unapproved_button'] = true;
                            $data['show_accept_button'] = true;                            
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

    function clanAttendances($clan_id, $date){
        $clan = New Clan();
        $day_numeric = date('N', strtotime($date));
        $details = $clan->getClansByTeacherAndDay($this->session_data->id, $day_numeric);
        $clan->where(array('id'=>$clan_id, 'teacher_id'=>$this->session_data->id))->get();
        $current_date = get_current_date_time()->get_date_for_db();
        $data['current_date'] = $current_date;
        
        if($details && $clan->result_count() == 1){ 
            $data['clan_details'] = $clan;
            $data['date'] = $date;
            $userdetails = $clan->Userdetail->where('status', 'A')->get();
            if($userdetails->result_count() > 0){
                foreach ($userdetails as $value) {
                    $temp = $value->User->get();
                    if(!is_null($temp->id)){
                        $attadence = new Attendance();
                        $attadence->where(array('clan_date'=>$date, 'student_id'=>$temp->id))->get();
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
            } else {
                $data['userdetails'] = null;
            }

            $obj_recover = new Attendancerecover();
            $obj_recover->where(array('clan_date'=>$date, 'clan_id'=>$clan_id))->get();
            foreach ($obj_recover as $student) {
                $userdetail = new Userdetail();
                $userdetail->where('student_master_id', $student->student_id)->get();
                $user = $userdetail->User->get();
                $clan = $userdetail->Clan->get();

                $recover = new Attendancerecover();
                $recover->where(array('clan_date'=>$date, 'clan_id'=>$clan_id, 'student_id'=>$student->student_id))->get();

                if($user->result_count() == 1) {
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

         $this->layout->view('clans/attadence_view', $data);
     }else{
        $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
        redirect(base_url() . 'dashboard', 'refresh'); 
    }
}

function saveClanAttendances($clan_id){
    if (!empty($clan_id)) {
        if ($this->input->post() !== false) {
            if($this->input->post('regular_user_id') !== false) {
                foreach ($this->input->post('regular_user_id') as $regular_key => $regular_value) {
                    $attadence = new Attendance();
                    $attadence->where(array('clan_date'=>$this->input->post('date'), 'student_id'=>$regular_key))->update('attendance', $regular_value);
                }
            }

            if($this->input->post('recover_user_id') !== false) {
                foreach ($this->input->post('recover_user_id') as $recover_key => $recover_value) {
                    $recover = new Attendancerecover();
                    $recover->where(array('clan_id'=>$clan_id,'clan_date'=>$this->input->post('date'), 'student_id'=>$recover_key))->update('attendance', $recover_value);
                }
            }
        }
    }
    redirect(base_url() .'dashboard', 'refresh');
}

function nextWeekAttendances($clan_id){
    $clan = New Clan();
    $clan->where(array('id'=>$clan_id, 'teacher_id'=>$this->session_data->id))->get();

    $current_date = get_current_date_time()->get_date_for_db();
    $start_date = date('Y-m-d', strtotime('+1 day', strtotime($current_date)));
    $end_date = date('Y-m-d', strtotime('+1 week', strtotime($current_date)));

    $days = explode(',', $clan->lesson_day);
    $curr = date('N', strtotime($current_date));
    $days_name = $this->config->item('custom_days');

    if(getArrayNexyValue($days, $curr)){
        $next_day = $days_name[getArrayNexyValue($days, $curr)]['en'];    
    }else{
        $next_day = $days_name[getArrayPreviousValue($days, $curr)]['en'];
    }

    $next_date = getDateByDay($next_day, $start_date, $end_date);
    $next_date = end($next_date);

    if($clan->result_count() == 1){
        $userdetails = $clan->Userdetail->where('status', 'A')->get();
        if($userdetails->result_count() > 0){
            foreach ($userdetails as $value) {
                $temp = $value->User->get();
                if(!is_null($temp->id)){
                    $attadence = new Attendance();
                    $attadence->where(array('clan_date'=>$next_date, 'student_id'=>$temp->id))->get();
                    $attadence->clan_date = $next_date;
                    $attadence->student_id = $temp->id;
                    $attadence->user_id = $this->session_data->id;
                    $attadence->save();
                }
            }
        }
    }
    $this->session->set_flashdata('success', $this->lang->line('attendance_next_week_done'));
    redirect(base_url() . 'dashboard', 'refresh'); 
}

function getSameLevelClans($clan_id)
{
    $obj_clan = new Clan();
    $obj_clan->where('id', $clan_id)->get();
    $check = $obj_clan->getSameLevelClan($obj_clan->city_id, $obj_clan->level_id);
    $str = NULL;
    if ($check !== FALSE) {
        $array = MultiArrayToSinlgeArray($check);
        $clans = $obj_clan->where_in('id', $array)->get();;

        $str .= '<h4 class="text-center text-black">Select Clan</h4>';
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
    }else{
        $str = 'No Clans';
    }

    echo $str;
}

function getDateOfClanForTeacher($clan_id) {
    $clan = new Clan();
    $dates = $clan->getAviableDateFromClan($clan_id, 5, 20);

    $clan->where('id', $clan_id)->get();
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

function changeDateStudentByTeacher(){
    $current_date = get_current_date_time()->get_date_for_db();

    $recover = new Attendancerecover();
    $recover->where(array('clan_date'=>$current_date, 'student_id'=>$this->input->post('student_id'), 'clan_id'=>$this->input->post('current_clan_id')))->get();

    $recover->attendance_id = $this->input->post('attendance_id');
    $recover->clan_date = $this->input->post('date');
    $recover->clan_id = $this->input->post('clan_id');
    $recover->student_id = $this->input->post('student_id');
    $recover->user_id = $this->session_data->id;

    $recover->save();

        /*
        * Send Student Notification and Email ....
        */
        $notification = new Notification();
        $notification->type = 'N';
        $notification->notify_type = 'recovery_assign_by_teacher_student';
        $notification->from_id = $this->session_data->id;
        $notification->to_id = $this->input->post('student_id');
        $notification->object_id = $recover->id;
        $notification->data = serialize($this->input->post());
        $notification->save();

        $clan = new Clan();
        $clan->where('id', $this->input->post('clan_id'))->get();

        $user = new User();
        $user->where('id', $this->input->post('student_id'))->get();

        $email = new Email();
        $email->where('type', 'teacher_recovery_student_for_student')->get();
        $message = $email->message;
        $message = str_replace('#student_name', $user->firstname .' ' . $user->lastname , $message);
        $message = str_replace('#teacher_name', $this->session_data->name, $message);
        $message = str_replace('#recover_clan', $clan->en_class_name, $message);
        $message = str_replace('#date', date('d-m-Y', strtotime($this->input->post('date'))), $message);

        $option = array();
        $option['tomailid'] = $user->email;
        $option['subject'] = $email->subject;
        $option['message'] = $message;
        if (!is_null($email->attachment)) {
            $option['attachement'] = base_url() . 'assets/email_attachments/' . $email->attachment;
        }
        send_mail($option);

        /*******************************/

        /*
        * Send Recover Clan Teacher Notification and Email ....
        */
        $notification = new Notification();
        $notification->type = 'N';
        $notification->notify_type = 'recovery_assign_by_teacher_teacher';
        $notification->from_id = $this->session_data->id;
        $notification->to_id = $clan->teacher_id;
        $notification->object_id = $recover->id;
        $notification->data = serialize($this->input->post());
        $notification->save();

        $teacher = new User();
        $teacher->where('id', $clan->teacher_id)->get();

        $email = new Email();
        $email->where('type', 'teacher_recovery_student_for_teacher')->get();
        $message = $email->message;
        $message = str_replace('#student_name', $user->firstname .' ' . $user->lastname , $message);
        $message = str_replace('#receiver_teacher', $teacher->firstname .' ' . $teacher->lastname, $message);
        $message = str_replace('#sender_teacher', $this->session_data->name, $message);
        $message = str_replace('#recover_clan', $clan->en_class_name, $message);
        $message = str_replace('#date', date('d-m-Y', strtotime($this->input->post('date'))), $message);

        $option = array();
        $option['tomailid'] = $teacher->email;
        $option['subject'] = $email->subject;
        $option['message'] = $message;
        if (!is_null($email->attachment)) {
            $option['attachement'] = base_url() . 'assets/email_attachments/' . $email->attachment;
        }
        send_mail($option);

        /*******************************/

        echo json_encode(array('status'=>true,'student_id'=>$this->input->post('student_id')));
    }

}