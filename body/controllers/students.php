<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class students extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->config->item('app_name'));
        $this->session_data = $this->session->userdata('user_session');

        if($this->session_data->role != 6){
            $this->session->set_flashdata('error', $this->lang->line('permisson_error'));
            redirect(base_url() . 'denied', 'refresh');
        }
    }

    function markAbsence(){
        if ($this->input->post() !== false) {
            $attadence = new Attendance();
            $attadence->where(array('clan_date'=>$this->input->post('absence_date'), 'student_id'=>$this->session_data->id))->get();
            $attadence->clan_date = $this->input->post('absence_date');
            $attadence->student_id = $this->session_data->id;
            $attadence->attendance = 0;
            $attadence->user_id = $this->session_data->id;
            $attadence->save();

            $userdetail = new Userdetail();
            $userdetail->where('student_master_id', $this->session_data->id)->get();
            $obj_user = $userdetail->User->get();
            $clan = new Clan();
            $clan->where('id', $userdetail->clan_id)->get();

            $notification = new Notification();
            $notification->type = 'N';
            $notification->notify_type = 'student_absent';
            $notification->from_id = $this->session_data->id;
            $notification->to_id = $clan->teacher_id;
            $notification->object_id = $attadence->id;
            $notification->data = serialize($this->input->post());
            $notification->save();

            $check_privacy = unserialize($this->session_data->email_privacy);
            if(is_null($check_privacy) || $check_privacy['student_absent'] == 1){
                $teacher_email = userNameEmail($clan->teacher_id);
                $email = new Email();
                $email->where('type', 'student_absent')->get();
                $message = $email->message;
                $message = str_replace('#firstname', $obj_user->firstname, $message);
                $message = str_replace('#lastname', $obj_user->lastname, $message);
                $message = str_replace('#clan_name', $clan->en_class_name, $message);
                $message = str_replace('#date', date('d-m-Y', strtotime($this->input->post('absence_date'))), $message);

                $option = array();
                $option['tomailid'] = $teacher_email->email;
                $option['subject'] = $email->subject;
                $option['message'] = $message;
                if (!is_null($email->attachment)) {
                    $option['attachement'] = 'assets/email_attachments/' . $email->attachment;
                }
                send_mail($option);
            }

            if($this->input->post('date') != false){
                $recover = new Attendancerecover();
                $recover->where(array('clan_date'=>$this->input->post('date'), 'student_id'=>$this->session_data->id))->get();
                $recover->attendance_id = $attadence->id;
                $recover->clan_date = $this->input->post('date');
                $recover->clan_id = $this->input->post('clan_id');
                $recover->student_id = $this->session_data->id;
                $recover->user_id = $this->session_data->id;
                $recover->save();

                $recover_clan = new Clan();
                $recover_clan->where('id', $this->input->post('clan_id'))->get();

                $notification = new Notification();
                $notification->type = 'N';
                $notification->notify_type = 'recovery_student';
                $notification->from_id = $this->session_data->id;
                $notification->to_id = $recover_clan->teacher_id;
                $notification->object_id = $recover->id;
                $notification->data = serialize($this->input->post());
                $notification->save();

                $recover_teacher_email = userNameEmail($recover_clan->teacher_id);
                $check_privacy = unserialize($recover_teacher_email['email_privacy']);
                if(is_null($check_privacy) || $check_privacy['recovery_student'] == 1){
                    $email = new Email();
                    $email->where('type', 'recovery_student')->get();
                    $message = $email->message;
                    $message = str_replace('#firstname', $obj_user->firstname, $message);
                    $message = str_replace('#lastname', $obj_user->lastname, $message);
                    $message = str_replace('#student_clan', $clan->en_class_name, $message);
                    $message = str_replace('#recover_clan', $recover_clan->en_class_name, $message);
                    $message = str_replace('#date', date('d-m-Y', strtotime($this->input->post('date'))), $message);

                    
                    $option = array();
                    $option['tomailid'] = $recover_teacher_email->email;
                    $option['subject'] = $email->subject;
                    $option['message'] = $message;
                    if (!is_null($email->attachment)) {
                        $option['attachement'] = 'assets/email_attachments/' . $email->attachment;
                    }
                    send_mail($option);
                }
            }

            $this->session->set_flashdata('success', $this->lang->line('communitate_absence_success'));
            redirect(base_url() . 'dashboard', 'refresh');
        }else{
            $user_detail = new Userdetail();
            $user_detail->where('student_master_id', $this->session_data->id)->get();

            $clan  = new Clan();
            $data['next_clans_dates'] = $clan->getAviableDateFromClan($user_detail->clan_id, 4, null);
            $clan->where('id', $user_detail->clan_id)->get();
            $check = $clan->getSameLevelClan($clan->city_id, $clan->level_id);

            if ($check !== FALSE) {
                $array = MultiArrayToSinlgeArray($check);
                if(($key = array_search($clan->id, $array)) !== false) {
                    unset($array[$key]);
                }
                if(count($array) > 0){
                    $data['clans'] = $clan->where_in('id', $array)->get();;
                }else {
                    $data['clans'] = 'No Clans are Avaialbe. Please try after Sometime'; 
                    $data['type'] = 'danger';    
                }
            } else {
                $data['clans'] = 'No Clans are Avaialbe. Please try after Sometime'; 
                $data['type'] = 'danger';
            }

            $this->layout->view('students/student_attendance', $data);
        }
    }

    function viewHistory(){
        $this->layout->setField('page_title', $this->lang->line('history'));

        //Right Hand side Batches Images
        $obj_batch_history = new Userbatcheshistory();
        $batches = $obj_batch_history->getStudentBatchHistory($this->session_data->id);

        foreach ($batches as $batch) {
            if($batch->type == 'D'){
                $data['student_degrees'][]= $batch;
            }

            if($batch->type == 'S'){
                $data['student_securities'][]= $batch;
            }

            if($batch->type == 'Q'){
                $data['student_qualifications'][]= $batch;
            }

            if($batch->type == 'H'){
                $data['student_honours'][]= $batch;
            }
        }

        //For Histroy Data
        $user_detail = new Userdetail();
        $data['user_detail'] = $user_detail->where('student_master_id', $this->session_data->id)->get();
        
        $challenge = new Challenge();
        
        //Total Challenge
        $total_win_defeats = (int)$challenge->countVictories($this->session_data->id) + (int)$challenge->countDefeats($this->session_data->id);
        $data['total_victories'] = (int)$challenge->countVictories($this->session_data->id);
        $data['total_defeats'] = (int)$challenge->countDefeats($this->session_data->id);
        if($total_win_defeats != 0){
            $data['victories_percentage'] = round(($data['total_victories'] * 100 ) / $total_win_defeats, 2);
            $data['defeats_percentage'] = round(($data['total_defeats'] * 100 ) / $total_win_defeats, 2);
        }
        
        $total_challenges = (int)$challenge->CountChallenges($this->session_data->id);
        $data['total_made'] = (int)$challenge->CountChallenges($this->session_data->id, 'made');
        $data['total_received'] = (int)$challenge->CountChallenges($this->session_data->id, 'received');
        $data['total_rejected'] = (int)$challenge->CountChallenges($this->session_data->id, 'received', 'R');
        if($total_challenges != 0){
            $data['made_percentage'] = round(($data['total_made'] * 100 ) / $total_challenges, 2);
            $data['received_percentage'] = round(($data['total_received'] * 100 ) / $total_challenges, 2);
            $data['rejected_percentage'] = round(($data['total_rejected'] * 100 ) / $total_challenges, 2);
        }

        //Student Attendance
        $obj_attendance = new Attendance();
        $total_attendance = (int)$obj_attendance->getTotalAttendance($this->session_data->id);
        $data['total_present'] = (int)$obj_attendance->getTotalAttendance($this->session_data->id, 'present');
        $data['total_absent'] = (int)$obj_attendance->getTotalAttendance($this->session_data->id, 'absent');

        $obj_recover = new Attendancerecover();
        $data['total_recover'] = (int)$obj_recover->getTotalAttendance($this->session_data->id, 'present');
        if($total_attendance != 0){
            $data['attendance_percentage'] = round(($data['total_present'] * 100 ) / $total_attendance, 2);
            $data['missed_percentage'] = round(($data['total_absent'] * 100 ) / $total_attendance, 2);
            $data['recover_percentage'] = round(($data['total_recover'] * 100 ) / $total_attendance, 2);
        }
        
        //For Timeline 
        $obj = new Notification();
        $obj->where('to_id', $this->session_data->id);
        $obj->or_where('from_id', $this->session_data->id);
        $obj->get();
        $data['per_page'] = ceil($obj->result_count() / 10);

        $this->layout->view('students/view_histroy', $data);
    }

    function viewTopRating(){
        $this->layout->setField('page_title', $this->lang->line('top_10_rating'));

        $userdetail = new Userdetail();

        //Top 10 XPR User
        $data['top_ten_xpr'] = $userdetail->topStudents('xpr',null,10);

        //Top 10 WAR User
        $data['top_ten_war'] = $userdetail->topStudents('war',null,10);

        //Top 10 XPR User
        $data['top_ten_sty'] = $userdetail->topStudents('sty',null,10);

        //Top 10 XPR User
        $data['top_ten_academy'] = $userdetail->topStudents('xpr','academy',10);
        
        //Top 10 WAR User
        $data['top_ten_school'] = $userdetail->topStudents('war','school',10);

        //Top 10 XPR User
        $data['top_ten_clan'] = $userdetail->topStudents('sty','clan',10);

        //Top Ten Users
        $data['top_ten_users'] = $userdetail->topStudents(null,null,10);

        $this->layout->view('students/top_ten_rating', $data);
    }

    function viewRatingList($type = null){
        $this->layout->setField('page_title', $this->lang->line('rating_list'));

        $avaialbe_types = array('all','xp', 'war', 'style');

        if(!is_null($type) && !in_array($type, $avaialbe_types)){
            $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
            redirect(base_url() . 'dashboard', 'refresh'); 
        }

        $data['type'] = $type;
        $this->layout->view('students/rating_list', $data);
    }

    function viewDuels(){
        $this->layout->setField('page_title', $this->lang->line('duels'));

        //No 1 User Details
        $userdetail = new Userdetail();

        //Logged In User
        $users = new User();
        $topper[0] = $users->where('id', $this->session_data->id)->get();
        $topper[0]->name = $topper[0]->firstname .' '. $topper[0]->lastname;
        
        //Top student
        //$topper = $userdetail->topStudents(null,null,1);
        
        $data['topper'] = $topper[0];
        $data['topper_userdetail'] = $userdetail->where('student_master_id', $topper[0]->id)->get();

        if($data['topper_userdetail']->degree_id != 0) {
            $degree_batch = new Batch();
            $degree_batch->where('id', $data['topper_userdetail']->degree_id)->get();
            $temp = array();
            $temp['image'] = IMG_URL .'batches/'. $degree_batch->image;
            $temp['name'] = $degree_batch->{$this->session_data->language.'_name'};
            $data['batch_image'][] = $temp;
        }

        if($data['topper_userdetail']->honour_id != 0) {
            $honor_batch = new Batch();
            $honor_batch->where('id', $data['topper_userdetail']->honour_id)->get();
            $temp = array();
            $temp['image'] = IMG_URL .'batches/'. $honor_batch->image;
            $temp['name'] = $honor_batch->{$this->session_data->language.'_name'};
            $data['batch_image'][] = $temp;
        }

        if($data['topper_userdetail']->qualification_id != 0) {
            $qualification_batch = new Batch();
            $qualification_batch->where('id', $data['topper_userdetail']->qualification_id)->get();
            $temp = array();
            $temp['image'] = IMG_URL .'batches/'. $qualification_batch->image;
            $temp['name'] = $qualification_batch->{$this->session_data->language.'_name'};
            $data['batch_image'][] = $temp;
        }

        if($data['topper_userdetail']->security_id != 0) {
            $security_batch = new Batch();
            $security_batch->where('id', $data['topper_userdetail']->security_id)->get();
            $temp = array();
            $temp['image'] = IMG_URL .'batches/'. $security_batch->image;
            $temp['name'] = $security_batch->{$this->session_data->language.'_name'};
            $data['batch_image'][] = $temp;
        }

        $clan = new Clan($data['topper_userdetail']->clan_id);
        $data['topper_ac_sc_clan_name'] = $clan->School->Academy->{$this->session_data->language.'_academy_name'} .'<br />'. $clan->School->{$this->session_data->language.'_school_name'} .'<br />'. $clan->{$this->session_data->language.'_class_name'};

        $challenge = new Challenge();

        //Last 3 Challenge received
        $data['challenge_received'] = $challenge->getChallengeDetails($this->session_data->id, 'received', null, 3);

        //Last 3 Challenge made
        $data['challenge_made'] = $challenge->getChallengeDetails($this->session_data->id, 'made',null, 3);

        //Last 3 Challenge Rejected
        $data['challenge_rejected'] = $challenge->getChallengeDetails($this->session_data->id, 'rejected', null,3);

        //Recommended User
        $data['recommended_user'] = $userdetail->userForChallenge($this->session_data->id, 'academy');

        //Suggested User
        $data['suggested_user'] = $userdetail->userForChallenge($this->session_data->id, 'all');

        //Victories User
        $data['my_victories'] = $challenge->studentVictories($this->session_data->id,3);

        //Duels Logs
        $data['duel_logs'] = $challenge->challengeLogs($this->session_data->id,'academy');

        //Defeats User
        $data['my_defeats'] = $challenge->studentDefeats($this->session_data->id,3);

        $userdetail = new Userdetail();
        $userdetail->where('student_master_id', $this->session_data->id)->get();

        //Before Me
        $data['before_me_users'] = $userdetail->userDetailsBeforeAfterMe($userdetail->student_master_id, $userdetail->total_score, 'before', null, 4);
       
        //After Me
        $data['after_me_users'] = $userdetail->userDetailsBeforeAfterMe($userdetail->student_master_id, $userdetail->total_score, 'after', null, 4);

        //Statistics Challenge
        unset($challenge);
        $obj_userdetail = new Userdetail();
        $obj_userdetail->where('student_master_id', $this->session_data->id)->get();
        $pupil_since = date('Y', strtotime($obj_userdetail->timestamp));
        $current_year = get_current_date_time()->year;
        $graph_data = array();
        for($i=$pupil_since; $i<=$current_year; $i++){
            $challenge = new Challenge();
            $graph_data[] = array(
                'year' => "$i",
                'victories' => $challenge->countVictories($this->session_data->id, $i),
                'defeats' => $challenge->countDefeats($this->session_data->id, $i),
                );
        }
        
        $data['statistics_challenge'] = json_encode($graph_data);

        //Top Five Users
        $data['top_five_users'] = $userdetail->topStudents(null,null,5);

        $this->layout->view('students/duels', $data);
    }

    function challengeStudent(){
        $challenge = new Challenge();
        $challenge->where(array('from_id'=>$this->session_data->id, 'to_id'=>$this->input->post('to_id')))->get();
        $return = false;

        if($challenge->result_count() == 0){
            $challenge->type = $this->input->post('challenge_type');
            $challenge->from_id = $this->session_data->id;
            $challenge->from_status = 'A';
            $challenge->to_id = $this->input->post('to_id');
            $challenge->to_status = 'P';
            $challenge->made_on = get_current_date_time()->get_date_time_for_db();
            if($this->input->post('date') != '' && $this->input->post('time') != ''){
                $challenge->played_on = date('Y-m-d H:i:s', strtotime($this->input->post('date').' '. $this->input->post('time')));    
            }
            $challenge->place = @$this->input->post('place');
            $challenge->user_id = $this->session_data->id;
            $challenge->save();
            $return = true;

            $this->_sendNotificationEmail('challenge_made', $challenge->stored, $challenge->id);
        }

        echo json_encode(array('status'=>$return));
    }

    function duelView($type = null){
        $this->layout->setField('page_title', $this->lang->line('duels_list'));
        $avaialbe_types = array('all','made', 'received', 'rejected', 'accepted', 'wins', 'defeats');

        if(!is_null($type) && !in_array($type, $avaialbe_types)){
            $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
            redirect(base_url() . 'dashboard', 'refresh'); 
        }

        $challenge = new Challenge();
         $data['type'] = null;
         if(!is_null($type)) {
            $data['type'] = $type;
        }

        $this->layout->view('students/duel_list_view', $data);
    }

    function duelSingleView($id, $type_2 = null){
        if ($this->input->post() !== false) {
            if($this->input->post('action') == 'A' || $this->input->post('action') == 'R'){
                $challenge = new Challenge();
                $challenge->where(array('id'=>$id, 'from_id'=>$this->input->post('from_id'),'to_id'=>$this->input->post('to_id')))->get();

                if($challenge->result_count() == 1 && $challenge->to_status == 'P'){
                    $challenge->to_status = $this->input->post('action');
                    $challenge->status_changed_on = get_current_date_time()->get_date_time_for_db();
                    if(is_null($challenge->played_on)){
                        $challenge->played_on = get_current_date_time()->get_date_time_for_db();
                    }
                    $challenge->save();
                }

                if($challenge->result_count() == 1 && $challenge->to_status == 'A'){
                    if($challenge->from_id == $this->session_data->id){
                        $challenge->from_status = $this->input->post('action');
                    }else{
                        $challenge->to_status = $this->input->post('action');
                        $challenge->result = $challenge->from_id;
                    }
                    
                    $challenge->status_changed_on = get_current_date_time()->get_date_time_for_db();
                    $challenge->save();
                }

                if($this->input->post('action') == 'A'){
                    $this->_sendNotificationEmail('challenge_accepted', $challenge->stored, $challenge->id);
                    $message = 'Challenge accepted Successfully';
                }

                if($this->input->post('action') == 'R'){
                    $this->_sendNotificationEmail('challenge_rejected', $challenge->stored, $challenge->id);
                    $message = 'Challenge rejected Successfully';
                }

                $this->session->set_flashdata('success', $message);
            }else{
                $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
            }
            redirect(base_url(). 'duels/single/' . $id, 'refresh');
        }
        else{
            $this->layout->setField('page_title', $this->lang->line('duel'));

            $challenge = new Challenge();
            $single = $challenge->getSingleChallengeDetails($id);

            if($single == false){
                $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
                redirect(base_url() . 'dashboard', 'refresh'); 
            }

            if (!is_null($id) && $type_2 == 'notification') {
                Notification::updateNotification('challenge_made', $this->session_data->id, $id);
                Notification::updateNotification('challenge_accepted', $this->session_data->id, $id);
                Notification::updateNotification('challenge_rejected', $this->session_data->id, $id);
                Notification::updateNotification('challenge_winner', $this->session_data->id, $id);
            }

            $data['show_accept_button'] = false;
            $data['show_reject_button'] = false;
            $data['status'] = false;
            $data['show_result_button'] = false;

            if($this->session_data->id == $single[0]->from_id){
                $user_id = $single[0]->to_id;
                $data['type'] = 'Made';
            }else if($this->session_data->id == $single[0]->to_id){
                $user_id = $single[0]->from_id;
                $data['type'] = 'Received';
                if($single[0]->result_status == 'MNP' && $single[0]->to_status == 'P'){
                    $data['show_accept_button'] = true;
                }
            }

            if($single[0]->result_status == 'MNP') {
                if($single[0]->from_status == 'A' && $single[0]->to_status == 'P'){
                    $data['status'] = '<h2 class="text-white text-center bg-warning">'.$this->lang->line('pending').'</h2>';
                     $data['show_reject_button'] = true;
                } else if($single[0]->from_status == 'A'  && $single[0]->to_status == 'A'){
                    $data['status'] = '<h2 class="text-white text-center bg-success">'.$this->lang->line('accepted').'</h2>';
                    $data['show_reject_button'] = true;

                    //get date after 7 days 
                    $time_1 = strtotime('+7 day', strtotime($single[0]->status_changed_on));
                    //get Current time
                    $time_2 = strtotime(get_current_date_time()->get_date_time_for_db());

                    if($single[0]->result_status == 'MNP' && $time_2 <= $time_1){
                        $data['show_result_button'] = true;
                    }
                } else if($single[0]->from_status == 'R' || $single[0]->to_status == 'R'){
                    $data['status'] = '<h2 class="text-white text-center bg-danger">'.$this->lang->line('rejected').'</h2>';
                }
            } else if($single[0]->result_status == 'MP'){
                if($single[0]->result == $this->session_data->id) {
                    $winner = $this->lang->line('challenge_you');
                }else{
                    $winner = $this->lang->line('challenge_opponent');
                }
                $data['status'] = '<h2 class="text-white text-center bg-success">'.$this->lang->line('winner') .' : '. $winner .'</h2>';
            } else {
                $data['status'] = '<h2 class="text-white text-center bg-danger">Disqualified</h2>';
            }

            $data['single'] = $single[0];
            $challenge_user = new User();
            $data['challenge_user'] = $challenge_user->where('id', $user_id)->get();
            $userdetail = new Userdetail();
            $data['challenge_userdetail'] = $userdetail->where('student_master_id', $user_id)->get();

            if($userdetail->degree_id != 0) {
                $degree_batch = new Batch();
                $degree_batch->where('id', $userdetail->degree_id)->get();
                $temp = array();
                $temp['image'] = IMG_URL .'batches/'. $degree_batch->image;
                $temp['name'] = $degree_batch->{$this->session_data->language.'_name'};
                $data['batch_image'][] = $temp;
            }

            if($userdetail->honour_id != 0) {
                $honor_batch = new Batch();
                $honor_batch->where('id', $userdetail->honour_id)->get();
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
            $data['challenge_user_batch_image'] = $batch->where('id', $userdetail->degree_id)->get();
            $clan = new Clan($data['challenge_userdetail']->clan_id);
            $data['challenge_user_ac_sc_clan_name'] =  $clan->School->Academy->{$this->session_data->language.'_academy_name'}.'<br />'. $clan->School->{$this->session_data->language.'_school_name'}.'<br />'. $clan->{$this->session_data->language.'_class_name'};

            $this->layout->view('students/duel_single', $data);
        }
    }

    function duelResult(){
        $challenge = new Challenge();
        $single = $challenge->getSingleChallengeDetails($this->input->post('id'));
        if($single != false && $single[0]->result_status == 'MNP' && ($single[0]->from_id == $this->session_data->id || $single[0]->to_id == $this->session_data->id)) {
            if($single[0]->to_status == 'A' && $single[0]->from_status == 'A'){
                $obj = new Challenge($this->input->post('id'));
                $obj->result = $this->input->post('winner');
                $obj->result_status = 'MP';
                $obj->save();

                if($single[0]->type == 'R'){
                    $winner_rating_point = systemRatingScore('regular_challenge_win');
                    $defeat_rating_point = systemRatingScore('regular_challenge_defeat');
                } else if($single[0]->type == 'B'){
                    $winner_rating_point = systemRatingScore('blind_challenge_win');
                    $defeat_rating_point = systemRatingScore('blind_challenge_defeat');
                }

                if($single[0]->from_id == $this->input->post('winner')){
                    $obj_score = new Scorehistory();
                    $obj_score->meritStudentScore($single[0]->from_id, $winner_rating_point['type'], $winner_rating_point['score']);                    

                    $obj_score = new Scorehistory();
                    $obj_score->meritStudentScore($single[0]->to_id, $defeat_rating_point['type'], $defeat_rating_point['score']);
                } else{
                    $obj_score = new Scorehistory();
                    $obj_score->meritStudentScore($single[0]->to_id, $winner_rating_point['type'], $winner_rating_point['score']);                    

                    $obj_score = new Scorehistory();
                    $obj_score->meritStudentScore($single[0]->from_id, $defeat_rating_point['type'], $defeat_rating_point['score']);
                }

                $this->_sendNotificationEmail('challenge_winner', $obj->stored, $obj->id);
            }
            $status = true;
        }else{
            $status = false;
        }

        echo json_encode(array('status'=>$status));
    }

    function _sendNotificationEmail($type, $post, $object_id){
        $notification = new Notification();
        $notification->type = 'N';
        $notification->notify_type = $type;
        $notification->from_id = $this->session_data->id;
        if($post->from_id == $this->session_data->id){
            $notification->to_id = $post->to_id;
        } else {
            $notification->to_id = $post->from_id; 
        }
        $notification->object_id = $object_id;
        $notification->data = serialize(objectToArray($post));
        $notification->save();
   

        //get email details
        $email = new Email();
        $email->where('type', $type)->get();
        $message = $email->message;

        $user = new User();
        //replace necessary details
        if($type == 'challenge_made'){
            if($post->from_id == $this->session_data->id){
                $user->where('id', $post->to_id)->get();    
            } else {
                $user->where('id', $post->from_id)->get();    
            }
            $message = str_replace('#to_name', $user->firstname.' '.$user->lastname , $message);
            $message = str_replace('#from_name', $this->session_data->name, $message);
        }

        if($type == 'challenge_accepted'){
            $user->where('id', $post->from_id)->get();  
            $message = str_replace('#from_name', $user->firstname.' '.$user->lastname , $message);
            $message = str_replace('#to_name', $this->session_data->name, $message);
        }

        if($type == 'challenge_rejected'){
            if($post->from_id == $this->session_data->id){
                $user->where('id', $post->to_id)->get();
            } else {
                $user->where('id', $post->from_id)->get();
            }
            $message = str_replace('#from_name', $user->firstname.' '.$user->lastname , $message);
            $message = str_replace('#to_name', $this->session_data->name, $message);
        }

        if($type == 'challenge_winner'){
            if($post->from_id == $this->session_data->id){
                $user->where('id', $post->to_id)->get();
            } else {
                $user->where('id', $post->from_id)->get();
            }
            $message = str_replace('#user_name', $user->firstname.' '.$user->lastname , $message);
            $message = str_replace('#opponent_name', $this->session_data->name, $message);
            $winner = userNameAvtar($post->result);
            $message = str_replace('#winner', $winner['name'], $message);
        }

        if(!is_null($post->played_on)){
            $message = str_replace('#on_date', date('d-m-Y', strtotime($post->played_on)), $message);
            $message = str_replace('#on_time', date('H:i a', strtotime($post->played_on)), $message);
        } else{
            $message = str_replace('#on_date', ' not yet decided', $message);
            $message = str_replace('#on_time', '', $message);
        }

        $check_privacy = unserialize($user->email_privacy);
        if(is_null($check_privacy) || $check_privacy[$type] == 1){
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

        return true;
    }

}
