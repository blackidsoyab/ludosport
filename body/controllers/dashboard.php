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

        $this->layout->view('dashboard/rector', $data);
    }

    function getDeanDashboard() {
        $school = new School();
        $data['total_schools'] = $school->getTotalSchoolOfDean($this->session_data->id);

        $class = new Clan();
        $data['total_instructors'] = $class->getTotalTeacherOfDean($this->session_data->id);
        $data['total_students'] = $class->getTotalStudentsOfDean($this->session_data->id);
        $this->layout->view('dashboard/dean', $data);
    }

    function getTeacherDashboard() {
        $class = new Clan();
        $data['total_classes'] = $class->getTotalClassesOfTeacher($this->session_data->id);
        $data['total_students'] = $class->getTotalStudentsOfTeacher($this->session_data->id);
        $this->layout->view('dashboard/teacher', $data);
    }

    function teacherClassDetails($year, $month){
        $month = $month + 1;
        $current_date = get_current_date_time()->get_date_for_db();        
        $return = array();
        $total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        for($i=1;$i<=$total_days;$i++){
            $date = date('Y-m-d', strtotime($year .'-'. $month .'-'. $i));
            $day_numeric = date('N', strtotime($date));
            $clans = New Clan();
            $details = $clans->getClansByTeacherAndDay($this->session_data->id, $day_numeric);
            if($details){
                foreach ($details as $value) {
                    $temp = array();
                    $temp['title'] = $value->{$this->session_data->language.'_class_name'};
                    $temp['start'] = $date;
                    if(strtotime($date) < strtotime($current_date)){
                        $temp['url'] = base_url() .'clan/clan_attendance/' . $value->id .'/'. $date;
                        $temp['type'] = 'past';
                    }else if(strtotime($date) == strtotime($current_date)){
                        $temp['url'] = base_url() .'clan/clan_attendance/' . $value->id .'/'. $date;
                        $temp['type'] = 'present';
                    } else {
                        $temp['url'] = base_url() .'clan/clan_attendance/' . $value->id .'/'. $date;
                        $temp['type'] = 'future';
                    }
                    $return[] = $temp;
                }
            }
        }

        if(count($return) == 0){
            $temp = array();
            $temp['start'] = $current_date;
            $return[] = $temp;
        }

        echo json_encode($return);
    }

    function getStudentDashboard() {
        if ($this->session_data->status === 'P') {
            $this->getPendingStudentDashboard();
        } else if ($this->session_data->status === 'A') {
            $this->getActiveStudentDashboard();
        } else {
            $this->session->set_flashdata('error', 'Your Status is Neighter ACTIVE nor PENDING. Please Contact Admin.');
            redirect(base_url() . 'denied', 'refresh');
        }
    }

    function getActiveStudentDashboard() {
        $this->layout->view('dashboard/student');
    }

    function studentClassDetails($year, $month){
        $month = $month + 1;
        $current_date = get_current_date_time()->get_date_for_db(); 
        $start_date = date('Y-m-d', strtotime('+1 day', strtotime($current_date)));
        $end_date = date('Y-m-d', strtotime('+2 week', strtotime($current_date)));
        $days_name = $this->config->item('custom_days');
        $curr = date('N', strtotime($current_date));
        $next_day = $days_name[$curr]['en'];    
        $next_date = getDateByDay($next_day, $start_date, $end_date);
        $next_date = end($next_date);

        $return = array();
        $total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        for($i=1;$i<=$total_days;$i++){
            $date = $year .'-'. $month .'-'. $i;
            $day_numeric = date('N', strtotime($date));
            $clans = New Clan();
            $details = $clans->getClansByStudentAndDay($this->session_data->id, $day_numeric);

            if($details){
                foreach ($details as $value) {
                    $temp = array();
                    $temp['title'] =  date('h.i a', $value->lesson_from) . ' : ' . date('h.i a', $value->lesson_to);
                    $temp['start'] = date('Y-m-d', strtotime($date));
                    if(strtotime($date) < strtotime($current_date)){
                        //$temp['url'] = base_url() .'student/clan/' . $value->id .'/'. $date;
                        $temp['type'] = 'past';
                    }else if(strtotime($date) == strtotime($current_date)){
                        //$temp['url'] = base_url() .'student/clan/' . $value->id .'/'. $date;
                        $temp['type'] = 'present';
                    } else {
                        $temp['type'] = 'future';
                    }
                    $return[] = $temp;
                }
            }
        }
        echo json_encode($return);
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
        $time_0 = strtotime(date('H:i', strtotime($userdetail->first_lesson_date . date('H:i',$clan->lesson_from))));
        //get time before 2 hours of clan start
        $time_1 = strtotime('-2 hour', $time_0);
        //get Current time
        $time_2 = strtotime(get_current_date_time()->get_time_for_db());

        //check user Extra Detail exist
        if($userdetail->result_count() == 1){
            //set user extra detail to access in view part
            $data['userdetail'] = $userdetail;

            // if status is Accepted
            if ($userdetail->status == 'A'){
                //get already applied clan name, date, time
                $data['already_applied'] = 'Your request for the clan ' . $clan->{$this->session_data->language . '_class_name'}. '<br /> on '. date("d-m-Y", strtotime($userdetail->first_lesson_date)) . ' : ' . date('h.i a', $clan->lesson_from) . '  - ' . date('h.i a', $clan->lesson_to). ' is accepted';

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
                        $data['clan_error_type'] = 'info'; 
                    }else{
                        //Now if clan started check attadence
                        $attadence = new Attendance();
                        $attadence->where(array('clan_date' =>$userdetail->first_lesson_date, 'student_id'=>$this->session_data->id))->get();

                        //Check Data extis in attandence table
                        if($attadence->result_count() == 1){
                            //check he is present or not
                            if($attadence->attendance == 1){
                                redirect(base_url() .'register/step_2', 'refresh');
                            } else {
                                //get already applied clan name, date, time
                                $data['already_applied'] = 'Your missed the clan ' . $clan->{$this->session_data->language . '_class_name'}. '<br /> on '. date("d-m-Y", strtotime($userdetail->first_lesson_date)) . ' : ' . date('h.i a', $clan->lesson_from) . '  - ' . date('h.i a', $clan->lesson_to);

                                //for div color
                                $data['type'] = 'danger';
                                
                                //Get the Clans details in his location
                                $check = $this->getClanDetails($this->session_data->id);
                                if ($check !== FALSE) {
                                    $data['clans'] = $check;
                                } else {
                                    $data['clans'] = 'No Clans are Avaialbe. Please try after Sometime'; 
                                    $data['clan_error_type'] = 'danger';
                                } 
                            }
                        }else{
                            //get already applied clan name, date, time
                            $data['already_applied'] = 'Your missed the clan ' . $clan->{$this->session_data->language . '_class_name'}. '<br /> on '. date("d-m-Y", strtotime($userdetail->first_lesson_date)) . ' : ' . date('h.i a', $clan->lesson_from) . '  - ' . date('h.i a', $clan->lesson_to);

                            //for div color
                            $data['type'] = 'danger';
                                
                            //Get the Clans details in his location
                            $check = $this->getClanDetails($this->session_data->id);
                            if ($check !== FALSE) {
                                $data['clans'] = $check;
                            } else {
                                $data['clans'] = 'No Clans are Avaialbe. Please try after Sometime'; 
                                $data['clan_error_type'] = 'danger';
                            } 
                        }
                    }
                }
            } else if ($userdetail->status == 'P' || $userdetail->status == 'U'){
                 //get already applied clan name, date, time
                $data['already_applied'] = 'You have already applied for the clan ' . $clan->{$this->session_data->language . '_class_name'}. '<br /> on '. date("d-m-Y", strtotime($userdetail->first_lesson_date)) . ' : ' . date('h.i a', $clan->lesson_from) . '  - ' . date('h.i a', $clan->lesson_to);
                
                //for div color
                $data['type'] = 'info';

                //Get the Clans details in his location
                $check = $this->getClanDetails($this->session_data->id);
                if ($check !== FALSE) {
                    $data['clans'] = $check;
                } else {
                    $data['clans'] = 'No Clans are Avaialbe. Please try after Sometime';
                    $data['clan_error_type'] = 'danger'; 
                }  
            }
        }else{
            //Get the Clans details in his location
            $check = $this->getClanDetails($this->session_data->id);
            if ($check !== FALSE) {
                $data['clans'] = $check;
            } else {
                $data['clans'] = 'No Clans are Avaialbe. Please try after Sometime'; 
                $data['clan_error_type'] = 'danger';
            }
        }

        //Set User Location Details
        $city = new City();
        //City name
        $data['city_name'] = $city->where('id', $user->city_id)->get()->{$this->session_data->language . '_name'};
        //State name
        $data['state_name'] = $city->state->{$this->session_data->language . '_name'};
        //Country name
        $data['country_name'] = $city->state->country->{$this->session_data->language . '_name'};

        //Set Layout view
        $this->layout->view('dashboard/pending_student', $data);
    }

    private function getClanDetails($user_id){
        $user = New User();
        //Get Current Login User details
        $user->where('id', $this->session_data->id)->get();

        //Calculate Age
        $age = explode(' ', time_elapsed_string(date('Y-m-d H:i:s', $user->date_of_birth)));

        //Under 16 or not
        if ($age[1] == 'year' && $age[0] < 16) {
            $under_sixteen = 1;
        } else {
            $under_sixteen = 0;
        }

        $clan = New Clan();
        //get all the Clan in the User city and also check level(based on age).
        $clans_data = $clan->getAviableTrialClan($user->city_id, $under_sixteen);

        //check result
        if ($clans_data !== FALSE) {
            //now the result is in multidimensional data make it single dimensional and the get clans details
            return $clan->where_in('id', MultiArrayToSinlgeArray($clans_data))->get();
        } else {
            return FALSE;
        }
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
        //For Email and Notification get All Admins
        $ids[] = User::getAdminIds();

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
            $option = array();
            $option['tomailid'] = $value->email;
            $option['subject'] = $email->subject;
            $option['message'] = $message;
            if (!is_null($email->attachment)) {
                $option['attachement'] = base_url() . 'assets/email_attachments/' . $email->attachment;
            }
            send_mail($option);
        }

        redirect(base_url(), 'refresh');
    }

    function studentRegistrationSecondPhase(){
        if($this->input->post() !== false){
            $user_details = new Userdetail();
            //Get Current login Student Extra Detail
            $user_details->where('student_master_id', $this->session_data->id)->get();

            //save the data
            $user_details->palce_of_birth = $this->input->post('palce_of_birth');
            $user_details->zip_code = $this->input->post('zip_code');
            $user_details->tax_code = $this->input->post('tax_code');
            $user_details->blood_group = $this->input->post('blood_group');
            $user_details->user_id = $this->session_data->id;
            $user_details->save();
            
            //Make student Active
            $user = new User();
            $user->where(array('id' => $this->session_data->id))->update('status', 'A');

            $session = $this->session->userdata('user_session');
            $session->status = 'A';
            $newdata = array('user_session' => $session);
            $this->session->set_userdata($newdata);

            redirect(base_url() .'dashboard', 'refresh');
        }else {
            $this->layout->setField('page_title', 'Registration Step 2');
            $this->layout->view('authenticate/register_step_2');
        }
    }

    function mailtesting() {
        $option = array();
        $option['tomailid'] = 'soyab@blackidsolutions.com';
        $option['subject'] = 'Hello';
        $option['message'] = 'Hi Testing mail';
        echo '<pre>';
        print_r(send_mail($option));
        echo '</pre>';
        exit();
    }

}
