<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class students extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('duel'));
        $this->session_data = $this->session->userdata('user_session');

        if($this->session_data->role != 6){
            $this->session->set_flashdata('error', 'You dont have permission to see it :-/ Please contact Admin');
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

            $email = new Email();
            $email->where('type', 'student_absent')->get();
            $message = $email->message;
            $message = str_replace('#firstname', $obj_user->firstname, $message);
            $message = str_replace('#lastname', $obj_user->lastname, $message);
            $message = str_replace('#clan_name', $clan->en_class_name, $message);
            $message = str_replace('#date', date('d-m-Y', strtotime($this->input->post('absence_date'))), $message);

            $option = array();
            $option['tomailid'] = $this->session_data->email;
            $option['subject'] = $email->subject;
            $option['message'] = $message;
            if (!is_null($email->attachment)) {
                $option['attachement'] = 'assets/email_attachments/' . $email->attachment;
            }
            send_mail($option);

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

                $email = new Email();
                $email->where('type', 'recovery_student')->get();
                $message = $email->message;
                $message = str_replace('#firstname', $obj_user->firstname, $message);
                $message = str_replace('#lastname', $obj_user->lastname, $message);
                $message = str_replace('#student_clan', $clan->en_class_name, $message);
                $message = str_replace('#recover_clan', $recover_clan->en_class_name, $message);
                $message = str_replace('#date', date('d-m-Y', strtotime($this->input->post('date'))), $message);

                $option = array();
                $option['tomailid'] = $this->session_data->email;
                $option['subject'] = $email->subject;
                $option['message'] = $message;
                if (!is_null($email->attachment)) {
                    $option['attachement'] = 'assets/email_attachments/' . $email->attachment;
                }
                send_mail($option);
            }

            $this->session->set_flashdata('success', 'Absence Mark Successfully');
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
        $batch = new Batch();
        $data['student_degrees'] = $batch->where('type', 'D')->get(4);

        $batch = new Batch();
        $data['student_honours'] = $batch->where('type', 'H')->get(4);

        $batch = new Batch();
        $data['student_qualifications'] = $batch->where('type', 'Q')->get(4);

        $batch = new Batch();
        $data['student_securities'] = $batch->where('type', 'S')->get(4);
        
        //For Histroy Data
        $user_detail = new Userdetail();
        $data['user_detail'] = $user_detail->where('student_master_id', $this->session_data->id)->get();
        
        $challenge = new Challenge();
        
        //Total Challenge
        $total_win_defeats = (int)$challenge->countVictories($this->session_data->id) + (int)$challenge->countDefeats($this->session_data->id);
        $data['total_victories'] = (int)$challenge->countVictories($this->session_data->id);
        $data['total_defeats'] = (int)$challenge->countDefeats($this->session_data->id);
        if($total_win_defeats != 0){
            $data['victories_percentage'] = ($data['total_victories'] * 100 ) / $total_win_defeats;
            $data['defeats_percentage'] = ($data['total_defeats'] * 100 ) / $total_win_defeats;
        }
        
        $total_challenges = (int)$challenge->CountChallenges($this->session_data->id);
        $data['total_made'] = (int)$challenge->CountChallenges($this->session_data->id, 'made');
        $data['total_received'] = (int)$challenge->CountChallenges($this->session_data->id, 'received');
        $data['total_rejected'] = (int)$challenge->CountChallenges($this->session_data->id, 'received', 'R');
        if($total_challenges != 0){
            $data['made_percentage'] = ($data['total_made'] * 100 ) / $total_challenges;
            $data['received_percentage'] = ($data['total_received'] * 100 ) / $total_challenges;
            $data['rejected_percentage'] = ($data['total_rejected'] * 100 ) / $total_challenges;
        }
        
        //For Timeline 
        $obj = new Notification();
        $obj->where('to_id', $this->session_data->id);
        $obj->or_where('from_id', $this->session_data->id);
        $obj->get();
        $data['per_page'] = ceil($obj->result_count() / 1);

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
        $topper = $userdetail->topStudents(null,null,1);
        $data['topper'] = $topper[0];
        $data['topper_userdetail'] = $userdetail->where('student_master_id', $topper[0]->id)->get();
        $data['topper_batch_detail'] = $userdetail->Batch;
        $data['topper_batch_image'] = IMG_URL .'batches/'. $data['topper_batch_detail']->image;
        $clan = new Clan($data['topper_userdetail']->clan_id);
        $data['topper_ac_sc_clan_name'] = $clan->School->Academy->{$this->session_data->language.'_academy_name'} .', '. $clan->School->{$this->session_data->language.'_school_name'} .', '. $clan->{$this->session_data->language.'_class_name'};

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

        //Four Before Me
        $data['four_before_me_users'] = $userdetail->beforeMeUserDetails($this->session_data->id, 4);

        //Four After Me
        $data['four_after_me_users'] = $userdetail->afterMeUserDetails($this->session_data->id, 4);

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
            //25 K -> 20 D
            if($post->from_id == $this->session_data->id){
                $user->where('id', $post->to_id)->get();    
            } else {
                $user->where('id', $post->from_id)->get();    
            }
            $message = str_replace('#to_name', $user->firstname.' '.$user->lastname , $message);
            $message = str_replace('#from_name', $this->session_data->name, $message);
            $message = str_replace('#on_date', date('d-m-Y', strtotime($post->played_on)), $message);
            $message = str_replace('#on_time', date('H:i a', strtotime($post->played_on)), $message);
        }

        if($type == 'challenge_made'){
            //25 K -> 20 D
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
            //25 K -> 20 D
            if($post->from_id == $this->session_data->id){
                $user->where('id', $post->to_id)->get();
            } else {
                $user->where('id', $post->from_id)->get();
            }
            $message = str_replace('#from_name', $user->firstname.' '.$user->lastname , $message);
            $message = str_replace('#to_name', $this->session_data->name, $message);
        }

        if($type == 'challenge_winner'){
            //25 K -> 20 D
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

        //set option for sending mail
        $option = array();
        $option['tomailid'] = $user->email;
        $option['subject'] = $email->subject;
        $option['message'] = $message;
        if (!is_null($email->attachment)) {
            $option['attachement'] = 'assets/email_attachments/' . $email->attachment;
        }
        send_mail($option);

        return true;
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
                    $winner = 'You';
                }else{
                    $winner = 'Opponent';
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
            $data['challenge_user_batch_detail'] = $userdetail->Batch;
            $data['challenge_user_batch_image'] = IMG_URL .'batches/'. $data['challenge_user_batch_detail']->image;
            $clan = new Clan($data['challenge_userdetail']->clan_id);
            $data['challenge_user_ac_sc_clan_name'] =  $clan->{$this->session_data->language.'_class_name'}.', '. $clan->School->{$this->session_data->language.'_school_name'}.', '. $clan->School->Academy->{$this->session_data->language.'_academy_name'}; 

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

                $this->_sendNotificationEmail('challenge_winner', $obj->stored, $obj->id);
            }
            $status = true;
        }else{
            $status = false;
        }

        echo json_encode(array('status'=>$status));
    }

}
