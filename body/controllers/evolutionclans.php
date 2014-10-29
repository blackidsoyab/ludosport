<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class evolutionclans extends CI_Controller
{
    
    var $session_data;
    
    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('evolution'));
        $this->session_data = $this->session->userdata('user_session');

        if($this->session_data->role == 6){
            $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
            redirect(base_url() . 'dashboard', 'refresh');
        }
    }
    
    /*
     *   List all evolutions if the id is null
     *   Single evolution if id is passed
     *   Param1(optional) : evolution id
     *   Param2(optional) : any text (e.g. : notification)
    */
    public function viewEvolutionclan($id = null, $type = null) {
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
        } else if ($this->session_data->role == '3') {
            $school = new School();
            $data['schools'] = $school->getSchoolOfRector($this->session_data->id);
        } else if ($this->session_data->role == '4') {
            $school = new School();
            $data['schools'] = $school->getSchoolOfDean($this->session_data->id);
        } else if ($this->session_data->role == '5') {
            $school = new School();
            $data['schools'] = $school->getSchoolOfTeacher($this->session_data->id, false);
        }
        
        $this->layout->view('evolutionclans/view', $data);
    }
    
    //Add the Evolution
    public function addEvolutionclan() {
        if ($this->input->post() !== false) {
            $obj = new Evolutionclan();
            foreach ($this->config->item('custom_languages') as $key => $value) {
                $temp = $key . '_class_name';
                if ($this->input->post($temp) != '') {
                    $obj->$temp = $this->input->post($temp);
                } else {
                    $obj->$temp = $this->input->post('en_class_name');
                }
            }
            
            $obj->school_id = $this->input->post('school_id');
            $obj->teacher_id = implode(',', $this->input->post('teacher_id'));
            $obj->evolutioncategory_id = $this->input->post('evolutioncategory_id');
            $obj->evolutionlevel_id = $this->input->post('evolutionlevel_id');
            $obj->max_student = $this->input->post('max_student');
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
            redirect(base_url() . 'evolutionclan', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('add') . ' ' . $this->lang->line('evolution'));
            
            $users = New User();
            $data['users'] = $users->getUsersByRole(5);
            
            $countries = New Country();
            $data['countries'] = $countries->get();
            
            $obj_evolutioncategory = new Evolutioncategory();
            $data['evolution_categories'] = $obj_evolutioncategory->get();
            
            $academy = New Academy();
            if ($this->session_data->role == '1' || $this->session_data->role == '2') {
                $data['academies'] = $academy->get();
            } else if ($this->session_data->role == '3') {
                $data['academies'] = $academy->getAcademyOfRector($this->session_data->id);
            } else if ($this->session_data->role == '4') {
                $data['academies'] = $academy->getAcademyOfDean($this->session_data->id);
            } else if ($this->session_data->role == '5') {
                $data['academies'] = $academy->getAcademyOfTeacher($this->session_data->id);
            } else if ($this->session_data->role == '6') {
                $data['academies'] = $academy->getAcademyOfStudent($this->session_data->id);
            } else {
                $data['academies'] = NULL;
            }
            
            $this->layout->view('evolutionclans/add', $data);
        }
    }
    
    /*
     *   Edit the Evolution
     *   Param1(required) : Evolution id
    */
    public function editEvolutionclan($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $obj = new Evolutionclan();
                $obj->where('id', $id)->get();
                foreach ($this->config->item('custom_languages') as $key => $value) {
                    $temp = $key . '_class_name';
                    if ($this->input->post($temp) != '') {
                        $obj->$temp = $this->input->post($temp);
                    } else {
                        $obj->$temp = $this->input->post('en_class_name');
                    }
                }
                
                $obj->school_id = $this->input->post('school_id');
                $obj->teacher_id = implode(',', $this->input->post('teacher_id'));
                $obj->evolutioncategory_id = $this->input->post('evolutioncategory_id');
                $obj->evolutionlevel_id = $this->input->post('evolutionlevel_id');
                $obj->max_student = $this->input->post('max_student');
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
                redirect(base_url() . 'evolutionclan', 'refresh');
            } else {
                $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('evolution'));
                
                $obj = new Evolutionclan();
                $data['evolutionclan'] = $obj->where('id', $id)->get();
                
                $users = New User();
                $data['users'] = $users->getUsersByRole(5);
                
                $academy = New Academy();
                if ($this->session_data->role == '1' || $this->session_data->role == '2') {
                    $data['academies'] = $academy->get();
                } else if ($this->session_data->role == '3') {
                    $data['academies'] = $academy->getAcademyOfRector($this->session_data->id);
                } else if ($this->session_data->role == '4') {
                    $data['academies'] = $academy->getAcademyOfDean($this->session_data->id);
                } else if ($this->session_data->role == '5') {
                    $data['academies'] = $academy->getAcademyOfTeacher($this->session_data->id);
                } else if ($this->session_data->role == '6') {
                    $data['academies'] = $academy->getAcademyOfStudent($this->session_data->id);
                } else {
                    $data['academies'] = NULL;
                }
                
                $school = new School($obj->school_id);
                $data['academy_id'] = $school->academy_id;
                $data['schools'] = $school->where('academy_id', $school->academy_id)->get();
                
                $countries = New Country();
                $data['countries'] = $countries->get();
                
                $states = New State();
                $data['states'] = $states->where('country_id', $obj->country_id)->get();
                
                $cities = New City();
                $data['cities'] = $cities->where('state_id', $obj->state_id)->get();

                $obj_evolutioncategory = new Evolutioncategory();
                $data['evolution_categories'] = $obj_evolutioncategory->get();

                if($data['evolutionclan']->evolutioncategory_id == 1){
                    $obj_batch = new Batch();
                    $obj_batch->where(array('type' => 'Q'))->order_by('sequence', 'ASC')->get();
                    foreach ($obj_batch as $cat_1) {
                        $std = new stdClass();
                        $std->id = $cat_1->id;
                        $std->en_name = $cat_1->en_name;
                        $std->it_name = $cat_1->it_name;
                        $data['evolution_levels'][] = $std;
                    }
                } else if($data['evolutionclan']->evolutioncategory_id == 2){
                    $obj_evolution = evolutionMasterLevels(2);
                    foreach ($obj_evolution as $cat_2) {
                        $std = new stdClass();
                        $std->id = $cat_2['id'];
                        $std->en_name = $cat_2['en'];
                        $std->it_name = $cat_2['it'];
                        $data['evolution_levels'][] = $std;
                    }
                }
                
                $this->layout->view('evolutionclans/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'evolutionclan', 'refresh');
        }
    }
    
    /*
     *   Delete the Evolution
     *   Param1(required) : Evolution id
    */
    public function deleteEvolutionclan($id) {
        if (!empty($id)) {
            $evolution = new Evolutionclan();
            $evolution->where('id', $id)->get();
            $evolution->delete();
            
            $this->session->set_flashdata('success', $this->lang->line('delete_data_success'));
            redirect(base_url() . 'evolutionclan', 'refresh');
        } else {
            $this->session->set_flashdata('error', $this->lang->line('delete_data_error'));
            redirect(base_url() . 'evolutionclan', 'refresh');
        }
    }

    /*
     *   List the Students of the Clan
     *   Param1(optional) : Clan id
     *   Param2(optional) : all, academy, school, clan
    */
    public function evolutionclanStudentList($id = 0, $type = 'all') {
        $this->layout->setField('page_title', $this->lang->line('list') . ' ' . $this->lang->line('student'));
        
        $academy = new Academy();
        $school = new School();
        $clan = new Evolutionclan();
        
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
            
            $data['academy_id'] = $temp->School->academy_id;
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
        
        $this->layout->view('evolutionclans/student_list', $data);
    }

    /*
     *   List the student who request for trial lesson
     *   Param1(required) : Clan id
    */
    public function listEvolutionClanRequest($clan_id = null) {
        if (!is_null($clan_id)) {
            if (!validAcess($clan_id, 'evolutionclan')) {
                $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
                redirect(base_url() . 'dashboard', 'refresh');
            }
            $clan = new Clan();
            
            //Get the Clan Details
            $data['clan_details'] = $clan->where('id', $clan_id)->get();
        } else {
            $data['clan_details'] = null;
        }
        
        $this->layout->view('evolutionclans/evolution_clan_request', $data);
    }

    /*
    * Check the Evolution clan Request.
    * Param1(Optional) : request id
    */
    public function changeRequestStatus($id, $type= null){
        //check that Data is passed or not
        if (!empty($id)) {
            $userdetail = new Evolutionstudent();
            
            //Get the Student Extra Details
            $userdetail->where(array('id' => $id))->get();
            
            //Student Exit or not
            if ($userdetail->result_count() == 1) {
                //Update the Notifications
                if ($type == 'notification') {
                    Notification::updateNotification('evolution_clan_request', $this->session_data->id, $id);
                    Notification::updateNotification('evolution_clan_request_approved', $this->session_data->id, $id);
                    Notification::updateNotification('evolution_clan_request_unapproved', $this->session_data->id, $id);
                }
                
                //Check Update the data or Render View
                if ($this->input->post() !== false) {
                    $userdetail->where(array('id' => $id))->update(array('status' => $this->input->post('status'), 'approved_by' => $this->session_data->id));
                    
                    //Set notification type
                    $notification_type = 'evolution_clan_request_unapproved';

                    if ($this->input->post('status') == 'A') {
                        $notification_type = 'evolution_clan_request_approved';
                    }

                    $obj = new Evolutionstudent($id);
                    $this->_sendNotificationEmailForEvoltion($notification_type, $obj->stored, $obj->id);
                    
                    $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                    redirect(base_url() . 'evolutionclan/check_request/' . $id, 'refresh');
                } else {
                    $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('trial_lesson'));
                    
                    //Set necessary variables for view
                    $data['request_detail'] = $userdetail;

                    $user = new User($userdetail->student_id);
                    $data['profile'] = $user;

                    $clan = new Evolutionclan($userdetail->evolutionclan_id);
                    $data['clan'] = $clan;

                    $data['show_approved_button'] = false;
                    $data['show_unapproved_button'] = false;
                    
                    if (hasPermission('evolutionclans', 'changeRequestStatus')) {    
                        //check status and Show buttons.
                        if ($userdetail->status == 'P' && $userdetail->approved_by == 0) {
                            $data['show_approved_button'] = true;
                            $data['show_unapproved_button'] = true;
                        } else if ($userdetail->status == 'A' && $userdetail->approved_by == $this->session_data->id) {
                            $data['show_unapproved_button'] = true;
                        } else if ($userdetail->status == 'U' && $userdetail->approved_by == $this->session_data->id) {
                            $data['show_approved_button'] = true;
                        }
                    }
                    
                    $this->layout->view('evolutionclans/approve_trial_request', $data);
                }
            } else {
                $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
                redirect(base_url() . 'evolutionclan', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'evolutionclan', 'refresh');
        }
    }

    /*
     *   List the student of the clan for the attendance
     *   Param1(required) : Clan id
     *   Param2(required) : Date
    */
    public function evolutionClanAttendances($clan_id, $date) {
        if (!validAcess($clan_id, 'evolutionclan')) {
            $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
            redirect(base_url() . 'dashboard', 'refresh');
        }
        
        $clan = New Evolutionclan();
        
        //get the Number of day like Monday : 1 .... Sunday : 7
        $day_numeric = date('N', strtotime($date));
        $details = $clan->getClansDetailsByDay($clan_id, $day_numeric);

        if (!$details) {
            $obj_clan_date = new Clandate();
            $obj_clan_date->where(array('clan_id' => $clan_id, 'clan_date' => $date))->get();
            if ($obj_clan_date->result_count() == 1) {
                $details = true;
            }
        }
        
        //Current Date
        $current_date = get_current_date_time()->get_date_for_db();
        
        //check if recored exits or not
        if ($details) {
            //get the full clan details
            $clan = $clan->where(array('id' => $clan_id))->get();
            
            //Get all the Students of that Clans.
            $userdetails = $clan->Evolutionstudent->where('status', 'A')->get();
            
            //check if students exits or not
            if ($userdetails->result_count() > 0) {
                foreach ($userdetails as $value) {
                    
                    //get the Student full detail
                    $temp = $value->User->get();
                    if ($temp->status == 'A' && strtotime($date) >= strtotime($value->timestamp)) { 
                        if (!is_null($temp->id)) {
                            $attadence = new Evolutionattendance();
                            
                            //get the Student is present or not
                            $attadence->where(array('evolutionclan_id' => $clan_id, 'clan_date' => $date, 'student_id' => $temp->id))->get();
                            
                            //Set an array of user details for view part
                            $data['userdetails'][] = array('id' => $temp->id, 'firstname' => $temp->firstname, 'lastname' => $temp->lastname, 'attadence' => $attadence->attendance, 'attadence_id' => $attadence->id, 'clan' => $clan->{$this->session_data->language . '_class_name'}, 'school' => $clan->School->{$this->session_data->language . '_school_name'}, 'academy' => $clan->School->Academy->{$this->session_data->language . '_academy_name'}, 'type' => 'regular');
                        }
                    }
                }
            }
            
            //Sert null if variable is not set
            if (!isset($data['userdetails'])) {
                $data['userdetails'] = null;
            }
            
            //Set variable for view part
            $data['show_save_button'] = true;
            $data['current_date'] = $current_date;
            $data['clan_details'] = $clan;
            $data['date'] = $date;
            $time_from = strtotime(date('Y-m-d H:i:s', strtotime($date . date('H:i', $clan->lesson_from))));
            $time_to = strtotime(date('Y-m-d H:i:s', strtotime($date . date('H:i', $clan->lesson_to))));
            $time_2 = strtotime(get_current_date_time()->get_date_time_for_db());
            
            if (strtotime(get_current_date_time()->get_date_for_db()) == strtotime($date)) {
                if ($time_2 >= $time_from && $time_2 <= $time_to) {
                    $data['show_save_button'] = true;
                }
            }
            
            $this->layout->view('evolutionclans/attadence_view', $data);
        } else {
            $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
            redirect(base_url() . 'dashboard', 'refresh');
        }
    }
    
    /*
     *   Save the attendance for the clan
     *   Param1(required) : Clan id
    */
    public function saveEvolutionClanAttendances($clan_id) {
        
        //check that clan id is passed or not
        if (!empty($clan_id)) {
            
            //check that data is post or views is to be render
            if ($this->input->post() !== false) {
                
                //get all the regular student and make absent or present
                if ($this->input->post('regular_user_id') !== false) {
                    foreach ($this->input->post('regular_user_id') as $regular_key => $regular_value) {
                        $attadence = new Evolutionattendance();
                        
                        //get the attendance record
                        $attadence->where(array('clan_date' => $this->input->post('date'), 'student_id' => $regular_key))->get();
                        if ($attadence->user_id == 0 && $regular_value == 1) {
                            //$rating_point = systemRatingScore('lesson');
                            //$obj_score = new Scorehistory();
                            //$obj_score->meritStudentScore($regular_key, $rating_point['type'], $rating_point['score'], 'Clan Attendance');
                        }
                        
                        //update the value
                        $attadence->evolutionclan_id = $clan_id;
                        $attadence->clan_date = $this->input->post('date');
                        $attadence->student_id = $regular_key;
                        $attadence->attendance = $regular_value;
                        $attadence->user_id = $this->session_data->id;
                        $attadence->timestamp = get_current_date_time()->get_date_time_for_db();
                        $attadence->save();
                    }
                }
            }
        }
        
        $this->session->set_flashdata('success', $this->lang->line('attendance_save_successfully'));
        redirect(base_url() . 'evolutionclan/clan_attendance/' . $clan_id . '/' . $this->input->post('date'), 'refresh');
    }

    public function resultEvolutionclan(){
        if ($this->input->post() !== false) {
            $obj_student = new Evolutionstudent();
            $obj_student->where(array('evolutionclan_id'=>$this->input->post('evolutionclan_id'), 'student_id'=>$this->input->post('student_id')))->get();
            $obj_clan = $obj_student->Evolutionclan->get();
            if($obj_student->result_count() == 1){
                if($obj_student->status == 'A'){
                    if($this->input->post('result') == 'P'){
                        $obj_student->status = 'C';
                        $obj_student->save();

                        $obj_batch_history = new Userbatcheshistory();

                        if($obj_clan->evolutioncategory_id == 1){
                            $type = 'Q';
                            $obj_userdetails = new Userdetail();
                            $obj_userdetails->where('student_master_id', $this->input->post('student_id'))->update('qualification_id', $obj_clan->evolutionlevel_id);
                        }else{
                            $type = 'S';
                        }

                        $obj_batch_history->saveStudentBatchHistory($this->input->post('student_id'), $type, $obj_clan->evolutionlevel_id);

                        $obj_batch = new Batch($obj_clan->evolutionlevel_id);
                        if ($obj_batch->has_point == 1) {
                            $obj_score_history = new Scorehistory();
                            $obj_score_history->meritStudentScore($this->input->post('student_id'), 'xpr', $obj_batch->xpr, 'Passing Evolution Clan');
                            $obj_score_history->meritStudentScore($this->input->post('student_id'), 'war', $obj_batch->war, 'Passing Evolution Clan');
                            $obj_score_history->meritStudentScore($this->input->post('student_id'), 'sty', $obj_batch->sty, 'Passing Evolution Clan');
                        }
                    }

                    if($this->input->post('result') == 'F'){
                        $obj_student->status = 'F';
                        $obj_student->save();
                    }

                    $obj_student = new Evolutionstudent($obj_student->id);
                    $this->_sendNotificationEmailForEvoltion('evolution_clan_result', $obj_student->stored, $obj_student->id);

                    $array = array('class'=>'alert-success', 'msg'=>'Result declared successfully');
                }
            } else {
                $array = array('class'=>'alert-danger', 'msg'=>'Error in declaring result');
            }

            echo json_encode($array);
        }else{
            $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
            redirect(base_url() . 'dashboard', 'refresh');
        }
    }

    public function _sendNotificationEmailForEvoltion($type, $post, $object_id){
        $clan = new Evolutionclan($post->evolutionclan_id);
        $final_ids = array_unique(array_merge(array($post->student_id), explode(',', $clan->teacher_id), User::getAdminIds()));

        $student_user = userNameEmail($post->student_id);
        foreach ($final_ids as $user_id) {
            if($this->session_data->id == $user_id){
                continue;
            }
            
            $notification = new Notification();
            $notification->type = 'N';
            $notification->notify_type = $type;
            $notification->from_id = $this->session_data->id;
            $notification->to_id = $user_id;
            $notification->object_id = $object_id;
            $notification->data = serialize(objectToArray($post));
            $notification->save();

            $email = new Email();
            $email->where('type', $type)->get();
            $message = $email->message;

            $user = userNameEmail($user_id);

            $message = str_replace('#user_name', $user['name'], $message);
            if($post->student_id == $user_id){
                $message = str_replace('#request_username', 'You', $message);
            }else{
                $message = str_replace('#request_username', $student_user['name'], $message);
            }
            
            $message = str_replace('#clan_name', $clan->en_class_name, $message);
            $message = str_replace('#authorized_username', $this->session_data->name, $message);

            if($type == 'evolution_clan_result'){
                if($post->status == 'C'){
                    $message = str_replace('#result', $this->lang->line('evolution_completed_student') , $message);
                }

                if($post->status == 'F'){
                    $message = str_replace('#result', $this->lang->line('evolution_fail_student') , $message);
                }
            }

            $check_privacy = unserialize($user['email_privacy']);
            if (is_null($check_privacy) || $check_privacy == false || !isset($check_privacy[$type]) || $check_privacy[$type] == 1) {
                //set option for sending mail
                $option = array();
                $option['tomailid'] = $user['email'];
                $option['subject'] = $email->subject;
                $option['message'] = $message;
                if (!is_null($email->attachment)) {
                    $option['attachement'] = 'assets/email_attachments/' . $email->attachment;
                }
                send_mail($option);
            }
        }

        return true;
    }

}