<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class dashboard extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', 'Dashboard');
        $this->session_data = $this->session->userdata('user_session');
    }

    public function index() {
        switch ($this->session_data->role) {
            case 1:
                $this->getSuperAdminDashboard();
                break;
            case 2:
                $this->getAdminDashboard();
                break;
            case 3:
                $this->getRectorDashboard();
                break;
            case 4:
                $this->getDeanDashboard();
                break;
            case 5:
                $this->getTeacherDashboard();
            break;
            case 6:
                $this->getStudentDashboard();
                break;
            default :
                $this->getDefaultDashboard();
                break;
        }
    }

    function getDefaultDashboard() {
        $this->layout->view('dashboard/common');
    }

    function getSuperAdminDashboard() {
        $academy = new Academy();
        $data['total_academies'] = $academy->count();

        $school = new School();
        $data['total_schools'] = $school->count();

        $class = new Clan();
        $data['total_instructors'] = $class->getTotalTeachers();
        $data['total_students'] = $class->getTotalStudents();

        $data['monthNames'] = array_map(function ($ar) {
            $session = get_instance()->session->userdata('user_session');
            return $ar["$session->language"];
        }, $this->config->item('custom_months'));

        $this->layout->view('dashboard/superadmin', $data);
    }

    function getAdminDashboard() {
        $academy = new Academy();
        $data['total_academies'] = $academy->count();

        $school = new School();
        $data['total_schools'] = $school->count();

        $class = new Clan();
        $data['total_instructors'] = $class->getTotalTeachers();
        $data['total_students'] = $class->getTotalStudents();

        $data['monthNames'] = array_map(function ($ar) {
            $session = get_instance()->session->userdata('user_session');
            return $ar["$session->language"];
        }, $this->config->item('custom_months'));

        $this->layout->view('dashboard/admin', $data);
    }

    function getRectorDashboard() {
        $academy = new Academy();
        $data['total_academies'] = $academy->getTotalAcademyOfRector($this->session_data->id);

        $school = new School();
        $data['total_schools'] = $school->getTotalSchoolOfRector($this->session_data->id);

        $class = new Clan();
        $data['total_instructors'] = $class->getTotalTeacherOfRector($this->session_data->id);
        $data['total_students'] = $class->getTotalStudentsOfRector($this->session_data->id);

        $data['monthNames'] = array_map(function ($ar) {
            $session = get_instance()->session->userdata('user_session');
            return $ar["$session->language"];
        }, $this->config->item('custom_months'));

        $this->layout->view('dashboard/rector', $data);
    }

    function getDeanDashboard() {
        $school = new School();
        $data['total_schools'] = $school->getTotalSchoolOfDean($this->session_data->id);

        $class = new Clan();
        $data['total_instructors'] = $class->getTotalTeacherOfDean($this->session_data->id);
        $data['total_students'] = $class->getTotalStudentsOfDean($this->session_data->id);

        $data['monthNames'] = array_map(function ($ar) {
            $session = get_instance()->session->userdata('user_session');
            return $ar["$session->language"];
        }, $this->config->item('custom_months'));
        
        $this->layout->view('dashboard/dean', $data);
    }

    function getTeacherDashboard() {
        $class = new Clan();
        $data['total_classes'] = $class->getTotalClassesOfTeacher($this->session_data->id);
        $data['total_students'] = $class->getTotalStudentsOfTeacher($this->session_data->id);

        $user_details = new Userdetail();
        $data['total_trail_request'] = $user_details->getTotalTrailRequestByUser($this->session_data->id);

        $data['monthNames'] = array_map(function ($ar) {
            $session = get_instance()->session->userdata('user_session');
            return $ar["$session->language"];
        }, $this->config->item('custom_months'));

        $this->layout->view('dashboard/teacher', $data);
    }

    function getStudentDashboard() {
        if ($this->session_data->status === 'P') {
            $userdetail = new Userdetail();
            //Get the User extra details exit.
            $userdetail->where('student_master_id', $this->session_data->id)->get();

            if($userdetail->result_count() == 1 && $userdetail->status == 'P2'){
                redirect(base_url() .'register/step_2', 'refresh');
            }else{
                $this->getPendingStudentDashboard();
            }
        } else if ($this->session_data->status === 'A') {
            $this->getActiveStudentDashboard();
        } else {
            $this->session->set_flashdata('error', $this->lang->line('status_error'));
            redirect(base_url() . 'denied', 'refresh');
        }
    }

    function getActiveStudentDashboard() {
        $userdetail = new Userdetail();
        
        //Logged In User
        $users = new User();
        $user[0] = $users->where('id', $this->session_data->id)->get();
        $user[0]->name = $user[0]->firstname .' '. $user[0]->lastname;
        
        //Top student
        //$user = $userdetail->topStudents(null,null,1);
        
        $data['user'] = $user[0];
        $data['userdetail'] = $userdetail->where('student_master_id', $user[0]->id)->get();

        if($userdetail->degree_id != 0) {
            $degree_batch = new Batch();
            $degree_batch->where('id', $userdetail->degree_id)->get();
            $temp = array();
            $temp['image'] = IMG_URL .'batches/'. $degree_batch->image;
            $temp['name'] = $degree_batch->{$this->session_data->language.'_name'};
            $data['batch_image'][] = $temp;
        }

        if($userdetail->honor_id != 0) {
            $honor_batch = new Batch();
            $honor_batch->where('id', $userdetail->honor_id)->get();
            $temp = array();
            $temp['image'] = IMG_URL .'batches/'. $honor_batch->image;
            $temp['name'] = $honor_batch->{$this->session_data->language.'_name'};
            $data['batch_image'][] = $temp;
        }

        if($userdetail->qualification_id != 0) {
            $qualification_batch = new Batch();
            $qualification_batch->where('id', $userdetail->qualification_id)->get();
            $temp = array();
            $temp['image'] = IMG_URL .'batches/'. $qualification_batch->image;
            $temp['name'] = $qualification_batch->{$this->session_data->language.'_name'};
            $data['batch_image'][] = $temp;
        }

        if($userdetail->security_id != 0) {
            $security_batch = new Batch();
            $security_batch->where('id', $userdetail->security_id)->get();
            $temp = array();
            $temp['image'] = IMG_URL .'batches/'. $security_batch->image;
            $temp['name'] = $security_batch->{$this->session_data->language.'_name'};
            $data['batch_image'][] = $temp;
        }

        $batch = new Batch();
        $data['batch_detail'] = $batch->where('id', $userdetail->degree_id)->get();
        if(!is_null($data['batch_detail']->dashboard_cover)){
            $data['cover_image'] = IMG_URL .'batches/dashboard_cover/'. $data['batch_detail']->dashboard_cover;
        } else {
            $data['cover_image'] = IMG_URL .'banner.png';
        }

        $clan = new Clan($data['userdetail']->clan_id);
        $data['ac_sc_clan_name'] = $clan->School->Academy->{$this->session_data->language.'_academy_name'} .'<br />'. $clan->School->{$this->session_data->language.'_school_name'} .'<br />'. $clan->{$this->session_data->language.'_class_name'};

        $challenge = new Challenge();
        $data['challenge_received'] = $challenge->getChallengeDetails($this->session_data->id, 'received', 'P', 3);

        $data['top_ten_users'] = $userdetail->topStudents(null,null,10);

        $this->layout->view('dashboard/student', $data);
    }

    function studentClan($clan_id, $date){
        $current_date = get_current_date_time()->get_date_for_db();
        $start_date = date('Y-m-d', strtotime('+1 day', strtotime($current_date)));
        $end_date = date('Y-m-d', strtotime('+2 week', strtotime($current_date)));
        $days_name = $this->config->item('custom_days');
        $curr = date('N', strtotime($current_date));
        $next_day = $days_name[$curr]['en'];    
        $next_date = getDateByDay($next_day, $start_date, $end_date);
        $next_date = end($next_date);
        if(strtotime($date) <= strtotime($next_date)){
            $data['date'] = $date;
            $data['current_date'] = $current_date;
            $data['next_date'] = $next_date;
            $this->layout->view('students/student_attendance', $data); 
        }else{
            $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
            redirect(base_url() . 'dashboard', 'refresh'); 
        }
    }

    function getPendingStudentDashboard() {
        //Set the Page Title
        $this->layout->setField('page_title', 'Test Lesson');

        //user for changing only dates no clan.
        $data['change_only_date'] = false;

        $userdetail = new Userdetail();
        //Get the User extra details exit.
        $userdetail->where('student_master_id', $this->session_data->id)->get();
        //Get User details
        $user  = $userdetail->User->get();
        // Get user Clan details if exits.
        $clan = $userdetail->Clan->get();

        //get Clan time
        $time_0 = strtotime(date('Y-m-d H:i:s', strtotime($userdetail->first_lesson_date . date('H:i',$clan->lesson_from))));
        //get time before 2 hours of clan start
        $time_1 = strtotime('-2 hour', $time_0);
        //get Current time
        $time_2 = strtotime(get_current_date_time()->get_date_time_for_db());

        //check user Extra Detail exist
        if($userdetail->result_count() == 1){
            //set user extra detail to access in view part
            $data['userdetail'] = $userdetail;

            // if status is Accepted
            if ($userdetail->status == 'A'){
                //get already applied clan name, date, time
                $data['already_applied'] = 'Your request for the clan <strong>' . $clan->{$this->session_data->language . '_class_name'}.'</strong> of school <strong>' .  $clan->School->{$this->session_data->language . '_school_name'}.'</strong> at academy <strong>' .  $clan->School->Academy->{$this->session_data->language . '_academy_name'} . '</strong><br /> on '. date("d-m-Y", strtotime($userdetail->first_lesson_date)) . ' : ' . date('h.i a', $clan->lesson_from) . '  - ' . date('h.i a', $clan->lesson_to). ' is accepted';

                //for div color
                $data['type'] = 'success';

                //check that is time left to change dates.
                if($time_2 <= $time_1) {
                        $data['clans'] = $clan;
                        $data['change_only_date'] = true;
                }else{
                    //if time less than 2 hours from stating clan
                    if($time_2 <= $time_0) {
                        $data['clans'] = 'Get ready for the Class';
                        $data['change_only_date'] = true;
                    }else{
                        //Now if clan started check attadence
                        $attadence = new Attendance();
                        $attadence->where(array('clan_date' =>$userdetail->first_lesson_date, 'student_id'=>$this->session_data->id))->get();

                        //Check Data extis in attandence table & check he is present or not
                        if($attadence->result_count() == 1 && $attadence->attendance == 1){
                            redirect(base_url() .'register/step_2', 'refresh');
                        }else{
                            //get already applied clan name, date, time
                            $data['already_applied'] = 'Your missed the clan <strong>' . $clan->{$this->session_data->language . '_class_name'}.'</strong> of school <strong>' .  $clan->School->{$this->session_data->language . '_school_name'}.'</strong> at academy <strong>' .  $clan->School->Academy->{$this->session_data->language . '_academy_name'} . '</strong><br /> on '. date("d-m-Y", strtotime($userdetail->first_lesson_date)) . ' : ' . date('h.i a', $clan->lesson_from) . '  - ' . date('h.i a', $clan->lesson_to);

                            //for div color
                            $data['type'] = 'danger';
                        }
                    }
                }
            } else if ($userdetail->status == 'P' || $userdetail->status == 'U'){
                 //get already applied clan name, date, time
                $data['already_applied'] = 'You have already applied for the clan <strong>' . $clan->{$this->session_data->language . '_class_name'}.'</strong> of school <strong>' .  $clan->School->{$this->session_data->language . '_school_name'}.'</strong> at academy <strong>' .  $clan->School->Academy->{$this->session_data->language . '_academy_name'} . '</strong><br /> on '. date("d-m-Y", strtotime($userdetail->first_lesson_date)) . ' : ' . date('h.i a', $clan->lesson_from) . '  - ' . date('h.i a', $clan->lesson_to);
                
                //for div color
                $data['type'] = 'info'; 
            }
        }

        $user = New User();
        $data['user_details'] = $user->where('id', $this->session_data->id)->get();


        $clan = new Clan();
        $cities_ids = $clan->getCitiesofClans();

        $cities = new City();
        $cities->where_in('id', $cities_ids)->get();
        foreach ($cities as $city) {
            $temp = array();
            $temp['id'] = $city->id;
            $temp['city_name'] = ucwords($city->{$this->session_data->language . '_name'}).', '.ucwords($city->state->{$this->session_data->language . '_name'}).', '.ucwords($city->state->country->{$this->session_data->language . '_name'});
            $data['cities'][] = $temp;
        }

        if(!isset($data['clans'])){
            $data['clans'] = null;
        }

        //Set Layout view
        $this->layout->view('dashboard/pending_student', $data);
    }

    function pendingStudnetSaveTrailLesson() {
        $user_details = new Userdetail();
        //Get Current login Student Extra Detail
        $user_details->where('student_master_id', $this->session_data->id)->get();

        //save the data
        $user_details->student_master_id = $this->session_data->id;
        $user_details->clan_id = $this->input->post('clan_id');
        $user_details->first_lesson_date = $this->input->post('date');
        $user_details->user_id = $this->session_data->id;
        $user_details->timestamp = get_current_date_time()->get_date_time_for_db();
        $user_details->save();

        $obj_user = new User();
        //Get Current login Student All Detail
        $obj_user->where('id', $this->session_data->id)->get();

        $ids = array();

        $clan = new Clan();
        //For Email and Notification get Clan related Rectors, Deans, Teacher
        $clan->where('id', $this->input->post('clan_id'))->get();
        $ids[] = array_unique(explode(',', $clan->school->academy->rector_id . ',' . $clan->school->dean_id . ',' . $clan->teacher_id));

        //Make single array form all ids
        $final_ids = array_unique(MultiArrayToSinlgeArray($ids));


        $user = new User();
        //Fecth all the Admin, Rector, Dean, Teacher details
        $user->where_in('id', $final_ids);

        //Compose message for Trial Lesson Request and replace  necessary things
        $email = new Email();
        $email->where('type', 'trial_lesson_request')->get();
        $message = $email->message;
        $message = str_replace('#firstname', $obj_user->firstname, $message);
        $message = str_replace('#lastname', $obj_user->lastname, $message);
        $message = str_replace('#clan_name', $clan->en_class_name, $message);
        $message = str_replace('#lesson_date', date('d-m-Y', strtotime($this->input->post('date'))), $message);
        $message = str_replace('#apply_date', date('d-m-Y', strtotime(get_current_date_time()->get_date_time_for_db())), $message);
        

        //loop through for notification and mail
        foreach ($user->get() as $value) {

            //Send Notification
            $notification = new Notification();
            $notification->type = 'N';
            $notification->notify_type = 'apply_trial_lesson';
            $notification->from_id = $user_details->student_master_id;
            $notification->to_id = $value->id;
            $notification->object_id = $user_details->student_master_id;
            $notification->data = serialize($this->input->post());
            $notification->save();

            //Send Email
            $check_privacy = unserialize($value->email_privacy);
            if(is_null($check_privacy) || $check_privacy['apply_trial_lesson'] == 1){
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

        redirect(base_url(), 'refresh');
    }

    function studentRegistrationSecondPhase(){
        if($this->input->post() !== false){
            $user_details = new Userdetail();
            //Get Current login Student Extra Detail
            $user_details->where('student_master_id', $this->session_data->id)->get();
            if($user_details->result_count() == 0){
                $this->session->set_flashdata('success', $this->lang->line('register_step2_success'));
            }
            //save the data
            $user_details->student_master_id= $this->session_data->id;
            $user_details->clan_id = $this->input->post('clan_id');
            $user = New User();
            //Get Current Login User details
            $user->where('id', $this->session_data->id)->get();

            //Calculate Age
            $age = explode(' ', time_elapsed_string(date('Y-m-d H:i:s', $user->date_of_birth)));

            //Under 16 or not
            if ($age[1] == 'year' && $age[0] < 16) {
                $user_details->degree_id= $this->config->item('basic_level_under_16');
            } else {
                $user_details->degree_id= $this->config->item('basic_level_above_16');
            }
            
            $user_details->palce_of_birth = $this->input->post('palce_of_birth');
            $user_details->first_lesson_date = get_current_date_time()->get_date_for_db();
            $user_details->zip_code = $this->input->post('zip_code');
            $user_details->tax_code = $this->input->post('tax_code');
            $user_details->blood_group = $this->input->post('blood_group');
            $user_details->status = 'P2';
            $user_details->user_id = $this->session_data->id;
            $user_details->save();

            redirect(base_url() .'register/step_2', 'refresh');
        }else {
            $user = new User($this->session_data->id);

            $user_details = new Userdetail();
            $user_details->where('student_master_id', $this->session_data->id)->get();

            if($user_details->result_count() == 1 && $user_details->status == 'P2'){
                $data['user_details'] = $user_details;

                $clan = new Clan();
                $data['clan_details'] = $clan->where('id', $user_details->clan_id)->get();
                //Calculate Age
                $age = explode(' ', time_elapsed_string(date('Y-m-d H:i:s', $user->date_of_birth)));
                if ($age[1] == 'year' && $age[0] != 0) {
                    $data['download_pdfs'] = attributionCards($age[0]);
                } else {
                    $data['download_pdfs'] = false;
                }    
            }else {
                $data['download_pdfs'] = false;
                $data['user_details'] = false;
            }

            $schools = new School();
            $schools->where('city_id', $user->city_id)->get();
            $data['schools'] = $schools;

            
            $this->layout->setField('page_title', 'Registration Step 2');
            $this->layout->view('authenticate/register_step_2', $data);
        }
    }
    
}
