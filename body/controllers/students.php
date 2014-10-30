<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class students extends CI_Controller
{
    
    var $session_data;
    
    function __construct() {
        parent::__construct();
        
        $this->layout->setField('page_title', $this->config->item('app_name'));
        $this->session_data = $this->session->userdata('user_session');
        
        if ($this->session_data->role != 6) {
            $this->session->set_flashdata('error', $this->lang->line('permisson_error'));
            redirect(base_url() . 'denied', 'refresh');
        }
    }
    
    function markAbsence() {
        if ($this->input->post() !== false) {
            $attadence = new Attendance();
            $attadence->where(array('clan_date' => $this->input->post('absence_date'), 'student_id' => $this->session_data->id))->get();
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
            
            $teacher_email = userNameEmail($clan->teacher_id);
            $check_privacy = unserialize($teacher_email['email_privacy']);
            if (is_null($check_privacy) || $check_privacy == false || !isset($check_privacy['student_absent']) || $check_privacy['student_absent'] == 1) {
                $email = new Email();
                $email->where('type', 'student_absent')->get();
                $message = $email->message;
                $message = str_replace('#firstname', $obj_user->firstname, $message);
                $message = str_replace('#lastname', $obj_user->lastname, $message);
                $message = str_replace('#clan_name', $clan->en_class_name, $message);
                $message = str_replace('#date', date('d-m-Y', strtotime($this->input->post('absence_date'))), $message);
                
                $option = array();
                $option['tomailid'] = $teacher_email['email'];
                $option['subject'] = $email->subject;
                $option['message'] = $message;
                if (!is_null($email->attachment)) {
                    $option['attachement'] = 'assets/email_attachments/' . $email->attachment;
                }
                send_mail($option);
            }
            
            if ($this->input->post('date') != false) {
                $recover = new Attendancerecover();
                $recover->where(array('clan_date' => $this->input->post('date'), 'student_id' => $this->session_data->id))->get();
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
                if (is_null($check_privacy) || $check_privacy == false || $check_privacy['recovery_student'] == 1) {
                    $email = new Email();
                    $email->where('type', 'recovery_student')->get();
                    $message = $email->message;
                    $message = str_replace('#firstname', $obj_user->firstname, $message);
                    $message = str_replace('#lastname', $obj_user->lastname, $message);
                    $message = str_replace('#student_clan', $clan->en_class_name, $message);
                    $message = str_replace('#recover_clan', $recover_clan->en_class_name, $message);
                    $message = str_replace('#date', date('d-m-Y', strtotime($this->input->post('date'))), $message);
                    
                    $option = array();
                    $option['tomailid'] = $recover_teacher_email['email'];
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
        } else {
            $user_detail = new Userdetail();
            $user_detail->where('student_master_id', $this->session_data->id)->get();
            
            $clan = new Clan();
            $data['next_clans_dates'] = $clan->getAviableDateFromClan($user_detail->clan_id, 4, null);
            $clan->where('id', $user_detail->clan_id)->get();
            $check = $clan->getSameLevelClan($clan->city_id, $clan->level_id);
            
            if ($check !== FALSE) {
                $array = MultiArrayToSinlgeArray($check);
                if (($key = array_search($clan->id, $array)) !== false) {
                    unset($array[$key]);
                }
                if (count($array) > 0) {
                    $data['clans'] = $clan->where_in('id', $array)->get();;
                } else {
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
    
    function viewHistory() {
        $this->layout->setField('page_title', $this->lang->line('history'));
        
        //Right Hand side Batches Images
        $obj_batch_history = new Userbatcheshistory();
        $batches = $obj_batch_history->getStudentBatchHistory($this->session_data->id);
        
        foreach ($batches as $batch) {
            if ($batch->type == 'D') {
                $data['student_degrees'][] = $batch;
            }
            
            if ($batch->type == 'S') {
                $data['student_securities'][] = $batch;
            }
            
            if ($batch->type == 'Q') {
                $data['student_qualifications'][] = $batch;
            }
            
            if ($batch->type == 'H') {
                $data['student_honours'][] = $batch;
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
        if ($total_win_defeats != 0) {
            $data['victories_percentage'] = round(($data['total_victories'] * 100) / $total_win_defeats, 2);
            $data['defeats_percentage'] = round(($data['total_defeats'] * 100) / $total_win_defeats, 2);
        }
        
        $total_challenges = (int)$challenge->countChallenges($this->session_data->id);
        $data['total_made'] = (int)$challenge->countChallenges($this->session_data->id, 'made');
        $data['total_received'] = (int)$challenge->countChallenges($this->session_data->id, 'received');
        $data['total_rejected'] = (int)$challenge->countChallenges($this->session_data->id, 'received', 'R');
        if ($total_challenges != 0) {
            $data['made_percentage'] = round(($data['total_made'] * 100) / $total_challenges, 2);
            $data['received_percentage'] = round(($data['total_received'] * 100) / $total_challenges, 2);
            $data['rejected_percentage'] = round(($data['total_rejected'] * 100) / $total_challenges, 2);
        }
        
        //Student Attendance
        $obj_attendance = new Attendance();
        $total_attendance = (int)$obj_attendance->getTotalAttendance($this->session_data->id);
        $data['total_present'] = (int)$obj_attendance->getTotalAttendance($this->session_data->id, 'present');
        $data['total_absent'] = (int)$obj_attendance->getTotalAttendance($this->session_data->id, 'absent');
        
        $obj_recover = new Attendancerecover();
        $data['total_recover'] = (int)$obj_recover->getTotalAttendance($this->session_data->id, 'present');
        if ($total_attendance != 0) {
            $data['attendance_percentage'] = round(($data['total_present'] * 100) / $total_attendance, 2);
            $data['missed_percentage'] = round(($data['total_absent'] * 100) / $total_attendance, 2);
            $data['recover_percentage'] = round(($data['total_recover'] * 100) / $total_attendance, 2);
        }
        
        unset($obj_batch_history);
        $obj_batch_history = new Userbatcheshistory();
        $obj_batch_history->select('batch_id')->where(array('batch_type' => 'S', 'student_id' => $this->session_data->id))->get();
        
        foreach ($obj_batch_history as $batch_detail) {
            $assigned_batches[] = $batch_detail->batch_id;
        }
        
        if (!isset($assigned_batches)) {
            $assigned_batches = array();
        }
        
        for ($i = 0; $i <= 2; $i++) {
            for ($j = 1; $j <= 7; $j++) {
                $evolution_batch_master = evolutionMasterLevels($i, $j);
                if (in_array($evolution_batch_master['id'], $assigned_batches)) {
                    $data['evolution_batch_master'][$j] = $evolution_batch_master;
                } else {
                    if (!isset($data['evolution_batch_master'][$j])) {
                        $evolution_batch_master = evolutionMasterLevels(0, $j);
                        $data['evolution_batch_master'][$j] = $evolution_batch_master;
                    }
                }
            }
        }
        
        //$data['evolution_batch_master'] = evolutionMasterLevels();
        
        //For Timeline
        $obj = new Notification();
        $obj->where('to_id', $this->session_data->id);
        $obj->or_where('from_id', $this->session_data->id);
        $obj->get();
        $data['per_page'] = ceil($obj->result_count() / 10);
        
        $this->layout->view('students/view_histroy', $data);
    }
    
    function viewTopRating() {
        $this->layout->setField('page_title', $this->lang->line('top_10_rating'));
        
        $userdetail = new Userdetail();
        
        //Top 10 XPR User
        $data['top_ten_xpr'] = $userdetail->topStudents('xpr', null, 10);
        
        //Top 10 WAR User
        $data['top_ten_war'] = $userdetail->topStudents('war', null, 10);
        
        //Top 10 XPR User
        $data['top_ten_sty'] = $userdetail->topStudents('sty', null, 10);
        
        //Top 10 XPR User
        $data['top_ten_academy'] = $userdetail->topStudents('xpr', 'academy', 10);
        
        //Top 10 WAR User
        $data['top_ten_school'] = $userdetail->topStudents('war', 'school', 10);
        
        //Top 10 XPR User
        $data['top_ten_clan'] = $userdetail->topStudents('sty', 'clan', 10);
        
        //Top Ten Users
        $data['top_ten_users'] = $userdetail->topStudents(null, null, 10);
        
        $this->layout->view('students/top_ten_rating', $data);
    }
    
    function viewRatingList($type = null) {
        $this->layout->setField('page_title', $this->lang->line('rating_list'));
        
        $avaialbe_types = array('all', 'xp', 'war', 'style');
        
        if (!is_null($type) && !in_array($type, $avaialbe_types)) {
            $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
            redirect(base_url() . 'dashboard', 'refresh');
        }
        
        $data['type'] = $type;
        $this->layout->view('students/rating_list', $data);
    }
    
    function viewDuels() {
        $this->layout->setField('page_title', $this->lang->line('duels'));
        
        //No 1 User Details
        $userdetail = new Userdetail();
        
        //Logged In User
        $users = new User();
        $topper[0] = $users->where('id', $this->session_data->id)->get();
        $topper[0]->name = $topper[0]->firstname . ' ' . $topper[0]->lastname;
        
        //Top student
        //$topper = $userdetail->topStudents(null,null,1);
        
        $data['topper'] = $topper[0];
        $data['topper_userdetail'] = $userdetail->where('student_master_id', $topper[0]->id)->get();
        
        if ($data['topper_userdetail']->degree_id != 0) {
            $degree_batch = new Batch();
            $degree_batch->where('id', $data['topper_userdetail']->degree_id)->get();
            $temp = array();
            $temp['image'] = IMG_URL . 'batches/' . $degree_batch->image;
            $temp['name'] = $degree_batch->{$this->session_data->language . '_name'};
            $data['topper_degree_batch_name'] = $degree_batch->{$this->session_data->language . '_name'};;
            $data['batch_image'][] = $temp;
        }
        
        if ($data['topper_userdetail']->honour_id != 0) {
            $honor_batch = new Batch();
            $honor_batch->where('id', $data['topper_userdetail']->honour_id)->get();
            $temp = array();
            $temp['image'] = IMG_URL . 'batches/' . $honor_batch->image;
            $temp['name'] = $honor_batch->{$this->session_data->language . '_name'};
            $data['batch_image'][] = $temp;
        }
        
        if ($data['topper_userdetail']->qualification_id != 0) {
            $qualification_batch = new Batch();
            $qualification_batch->where('id', $data['topper_userdetail']->qualification_id)->get();
            $temp = array();
            $temp['image'] = IMG_URL . 'batches/' . $qualification_batch->image;
            $temp['name'] = $qualification_batch->{$this->session_data->language . '_name'};
            $data['batch_image'][] = $temp;
        }
        
        if ($data['topper_userdetail']->security_id != 0) {
            $security_batch = new Batch();
            $security_batch->where('id', $data['topper_userdetail']->security_id)->get();
            $temp = array();
            $temp['image'] = IMG_URL . 'batches/' . $security_batch->image;
            $temp['name'] = $security_batch->{$this->session_data->language . '_name'};
            $data['batch_image'][] = $temp;
        }
        
        $clan = new Clan($data['topper_userdetail']->clan_id);
        if ($clan->result_count() > 0) {
            $data['topper_ac_sc_clan_name'] = $clan->School->Academy->{$this->session_data->language . '_academy_name'} . '<br />' . $clan->School->{$this->session_data->language . '_school_name'} . '<br />' . $clan->{$this->session_data->language . '_class_name'};
        }
        
        $challenge = new Challenge();
        
        //Last 3 Challenge received
        $data['challenge_received'] = $challenge->getChallengeDetails($this->session_data->id, 'received', 'P', 3);
        
        //Last 3 Challenge accepted
        $data['challenge_accepted'] = $challenge->getChallengeDetails($this->session_data->id, 'accepted', null, 3);
        
        //Last 3 Challenge Submitted
        $data['challenge_submitted'] = $challenge->getChallengeDetails($this->session_data->id, 'made', 'P', 3);
        
        //Suggested User
        $data['suggested_user'] = $challenge->userForChallenge($this->session_data->id, 'all');
        
        //Recommended User
        $data['recommended_user'] = $challenge->userForChallenge($this->session_data->id, 'academy');
        
        //Duels Logs
        $data['duel_logs'] = $challenge->challengeLogs($this->session_data->id, 'academy');
        
        //Victories User
        $data['my_victories'] = $challenge->studentDuelResult($this->session_data->id, 'winner', null, 5);
        
        //Defeats User
        $data['my_defeats'] = $challenge->studentDuelResult($this->session_data->id, 'defeat', null, 5);
        
        //Failure User
        $data['my_failures'] = $challenge->studentDuelResult($this->session_data->id, 'failure', null, 5);
        
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
        for ($i = $pupil_since; $i <= $current_year; $i++) {
            $challenge = new Challenge();
            $graph_data[] = array('year' => "$i", 'victories' => $challenge->countVictories($this->session_data->id, $i), 'defeats' => $challenge->countDefeats($this->session_data->id, $i),);
        }
        unset($challenge);
        
        $data['statistics_challenge'] = json_encode($graph_data);
        
        //Top Five Users
        $data['top_five_users'] = $userdetail->topStudents(null, null, 5);
        
        $challenge = new Challenge();
        $pending_challenge = $challenge->countChallenges($this->session_data->id, 'received', 'P');
        $data['can_do_challege'] = false;
        if ($pending_challenge < 3) {
            $data['can_do_challege'] = true;
        }
        
        $this->layout->view('students/duels', $data);
    }
    
    function challengeStudent() {
        $challenge = new Challenge();
        $challenge->where(array('from_id' => $this->session_data->id, 'to_id' => $this->input->post('to_id')))->get();
        $return = false;
        
        if ($challenge->result_count() == 0 && $this->input->post('to_id') != 0) {
            $challenge->type = ($this->input->post('challenge_type') == '') ? 'R' : $this->input->post('challenge_type');
            $challenge->from_id = $this->session_data->id;
            $challenge->from_status = 'A';
            $challenge->to_id = $this->input->post('to_id');
            $challenge->to_status = 'P';
            $challenge->made_on = get_current_date_time()->get_date_time_for_db();
            if ($this->input->post('date') != '' && $this->input->post('time') != '') {
                $challenge->played_on = date('Y-m-d H:i:s', strtotime($this->input->post('date') . ' ' . $this->input->post('time')));
            }
            
            $challenge->place = @$this->input->post('place');
            $challenge->user_id = $this->session_data->id;
            $challenge->save();
            $return = true;
            
            $obj = new Challenge($challenge->id);
            $this->_sendNotificationEmail('challenge_made', $obj->stored, $obj->id);
        }
        
        echo json_encode(array('status' => $return));
    }
    
    function duelView($type = null) {
        $this->layout->setField('page_title', $this->lang->line('duels_list'));
        $avaialbe_types = array('all', 'submitted', 'received', 'rejected', 'accepted', 'wins', 'defeats', 'faliure');
        
        if (!is_null($type) && !in_array($type, $avaialbe_types)) {
            $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
            redirect(base_url() . 'dashboard', 'refresh');
        }
        
        $challenge = new Challenge();
        $data['type'] = null;
        if (!is_null($type)) {
            $data['type'] = $type;
        }
        
        $this->layout->view('students/duel_list_view', $data);
    }
    
    function duelSingleView($id, $type_2 = null) {
        if ($this->input->post() !== false) {
            if ($this->input->post('action') == 'A' || $this->input->post('action') == 'R') {
                $challenge = new Challenge();
                $challenge->where(array('id' => $id, 'from_id' => $this->input->post('from_id'), 'to_id' => $this->input->post('to_id')))->get();
                
                if ($challenge->result_count() == 1) {
                    
                    //if Status is Pending and challenge Accepted
                    if ($challenge->to_status == 'P' && $this->input->post('action') == 'A') {
                        $challenge->to_status = 'A';
                        $challenge->status_changed_on = get_current_date_time()->get_date_time_for_db();
                        if (is_null($challenge->played_on)) {
                            $challenge->played_on = get_current_date_time()->get_date_time_for_db();
                        }
                    }
                    
                    //if Status is Pending and challenge Rejected
                    if ($challenge->to_status == 'P' && $this->input->post('action') == 'R') {
                        if ($challenge->from_id == $this->session_data->id) {
                            $challenge->from_stauts = 'R';
                            $challenge->to_stauts = 'A';
                        } else {
                            $challenge->from_stauts = 'A';
                            $challenge->to_stauts = 'R';
                        }
                    }
                    
                    //if Status is Accepted and challenge Rejected
                    if ($challenge->to_status == 'A' && $this->input->post('action') == 'R') {
                        
                        //check who reject the challenge
                        if ($challenge->from_id == $this->session_data->id) {
                            
                            //if yes then challenge rejected by the one who lauched the challenge
                            $challenge->from_status = 'R';
                            $challenge->to_status = 'A';
                            $challenge->result = $challenge->to_id;
                            $challenge->result_status = 'MP';
                            
                            //Demerit the Point from the Rejected Student
                            $reject_challenge_launches = systemRatingScore('reject_challenge_launches');
                            $obj_score = new Scorehistory();
                            $obj_score->demeritStudentScore($challenge->from_id, $reject_challenge_launches['type'], $reject_challenge_launches['score'], 'Rejected own challenge');
                            
                            //Merit the Score to the Winner Student
                            if ($challenge->type == 'R') {
                                $winner_rating_point = systemRatingScore('regular_challenge_win');
                            } else if ($challenge->type == 'B') {
                                $winner_rating_point = systemRatingScore('blind_challenge_win');
                            }
                            $obj_score = new Scorehistory();
                            $obj_score->meritStudentScore($challenge->to_id, $winner_rating_point['type'], $winner_rating_point['score'], 'Challenge winner as challenge owner rejected');
                        } else {
                            
                            //if No then challenge rejected by the opponent
                            $challenge->from_status = 'A';
                            $challenge->to_status = 'R';
                            $challenge->result = $challenge->from_id;
                            $challenge->result_status = 'MP';
                            
                            //Demerit the Point from the Rejected Student
                            $reject_challenge_launches = systemRatingScore('reject_challenge_launches');
                            $obj_score = new Scorehistory();
                            $obj_score->demeritStudentScore($challenge->to_id, $reject_challenge_launches['type'], $reject_challenge_launches['score'], 'Rejected challenge request');
                            
                            //Merit the Score to the Winner Student
                            if ($challenge->type == 'R') {
                                $winner_rating_point = systemRatingScore('regular_challenge_win');
                            } else if ($challenge->type == 'B') {
                                $winner_rating_point = systemRatingScore('blind_challenge_win');
                            }
                            $obj_score = new Scorehistory();
                            $obj_score->meritStudentScore($challenge->from_id, $winner_rating_point['type'], $winner_rating_point['score'], 'Challenge winner as challenge opponet rejected');
                        }
                    }
                    
                    $challenge->save();
                    
                    if ($this->input->post('action') == 'A') {
                        $this->_sendNotificationEmail('challenge_accepted', $challenge->stored, $challenge->id);
                        $message = 'Challenge accepted Successfully';
                    }
                    
                    if ($this->input->post('action') == 'R') {
                        $this->_sendNotificationEmail('challenge_rejected', $challenge->stored, $challenge->id);
                        $message = 'Challenge rejected Successfully';
                    }
                    
                    $this->session->set_flashdata('success', $message);
                } else {
                    $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
                }
            } else {
                $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
            }
            redirect(base_url() . 'duels/single/' . $id, 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('duel'));
            
            $challenge = new Challenge();
            $single = $challenge->getSingleChallengeDetails($id);
            
            if ($single == false) {
                $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
                redirect(base_url() . 'dashboard', 'refresh');
            }
            
            if (!is_null($id) && ($type_2 == null || $type_2 == 'notification')) {
                Notification::updateNotification('challenge_made', $this->session_data->id, $id);
                Notification::updateNotification('challenge_accepted', $this->session_data->id, $id);
                Notification::updateNotification('challenge_rejected', $this->session_data->id, $id);
                Notification::updateNotification('challenge_winner', $this->session_data->id, $id);
                Notification::updateNotification('challenge_winner_confirmation', $this->session_data->id, $id);
                Notification::updateNotification('contrast_opinions_challenge_winner', $this->session_data->id, $id);
            }
            
            $data['show_accept_button'] = false;
            $data['show_reject_button'] = false;
            $data['status'] = false;
            $data['show_result_button'] = false;
            $data['show_result_confirmation_agree_button'] = false;
            $data['show_result_confirmation_disagree_button'] = false;
            
            if ($this->session_data->id == $single[0]->from_id) {
                $user_id = $single[0]->to_id;
                $data['type'] = 'Made';
            } else if ($this->session_data->id == $single[0]->to_id) {
                $user_id = $single[0]->from_id;
                $data['type'] = 'Received';
                if ($single[0]->result_status == 'MNP' && $single[0]->to_status == 'P') {
                    $data['show_accept_button'] = true;
                }
            }
            
            if ($single[0]->result_status == 'MNP') {
                if ($single[0]->from_status == 'A' && $single[0]->to_status == 'P') {
                    $data['status'] = '<h2 class="text-white text-center bg-warning">' . $this->lang->line('pending') . '</h2>';
                    $data['show_reject_button'] = true;
                } else if ($single[0]->from_status == 'A' && $single[0]->to_status == 'A') {
                    $data['status'] = '<h2 class="text-white text-center bg-success">' . $this->lang->line('accepted') . '</h2>';
                    $data['show_reject_button'] = true;
                    
                    //get date after 7 days
                    $time_1 = strtotime('+7 day', strtotime($single[0]->status_changed_on));
                    
                    //get Current time
                    $time_2 = strtotime(get_current_date_time()->get_date_time_for_db());
                    
                    if ($single[0]->result_status == 'MNP') {
                        if ($time_2 <= $time_1) {
                            $data['show_result_button'] = true;
                        } else {
                            $data['error_msg'] = $this->lang->line('7_day_time_over');
                        }
                    }
                } else if ($single[0]->from_status == 'R' || $single[0]->to_status == 'R') {
                    $data['status'] = '<h2 class="text-white text-center bg-danger">' . $this->lang->line('rejected') . '</h2>';
                }
            } else if ($single[0]->result_status == 'CW') {
                if ($single[0]->result == $this->session_data->id) {
                    $winner = $this->lang->line('challenge_you');
                } else if ($single[0]->result != $this->session_data->id) {
                    $winner = $this->lang->line('challenge_opponent');
                }
                $msg = ($single[0]->result_declare_by != $this->session_data->id) ? $this->lang->line('please_confirm') : $this->lang->line('waiting_for_confirm');
                
                $data['status'] = '<h2 class="text-white text-center bg-info">' . $msg . ' ' . $this->lang->line('winner') . ' : ' . $winner . '</h2>';
                
                //get time after 101 min
                $time_1 = strtotime('+101 min', strtotime($single[0]->status_changed_on));
                
                //get Current time
                $time_2 = strtotime(get_current_date_time()->get_date_time_for_db());
                
                if ($single[0]->result_status == 'MNP' && $time_2 <= $time_1) {
                    $data['show_result_button'] = true;
                }
                if ($single[0]->result_declare_by != $this->session_data->id) {
                    if ($time_2 <= $time_1) {
                        $data['show_result_confirmation_agree_button'] = true;
                        $data['show_result_confirmation_disagree_button'] = true;
                    } else {
                        $data['error_msg'] = $this->lang->line('101_min_time_over');
                    }
                }
                
                $data['show_accept_button'] = false;
                $data['show_reject_button'] = false;
                $data['show_result_button'] = false;
            } else if ($single[0]->result_status == 'CO') {
                
                $data['status'] = '<h2 class="text-white text-center bg-danger">' . $this->lang->line('opnion_contrast') . '</h2>';
            } else if ($single[0]->result_status == 'MP') {
                if ($single[0]->result == $this->session_data->id) {
                    $winner = $this->lang->line('challenge_you');
                } else if ($single[0]->result != $this->session_data->id) {
                    $winner = $this->lang->line('challenge_opponent');
                }
                $data['status'] = '<h2 class="text-white text-center bg-success">' . $this->lang->line('winner') . ' : ' . $winner . '</h2>';
            } else {
                
                $data['status'] = '<h2 class="text-white text-center bg-danger">Disqualified</h2>';
            }
            
            $data['single'] = $single[0];
            $challenge_user = new User();
            $data['challenge_user'] = $challenge_user->where('id', $user_id)->get();
            $userdetail = new Userdetail();
            $data['challenge_userdetail'] = $userdetail->where('student_master_id', $user_id)->get();
            
            if ($userdetail->degree_id != 0) {
                $degree_batch = new Batch();
                $degree_batch->where('id', $userdetail->degree_id)->get();
                $temp = array();
                $temp['image'] = IMG_URL . 'batches/' . $degree_batch->image;
                $temp['name'] = $degree_batch->{$this->session_data->language . '_name'};
                $data['batch_image'][] = $temp;
            }
            
            if ($userdetail->honour_id != 0) {
                $honor_batch = new Batch();
                $honor_batch->where('id', $userdetail->honour_id)->get();
                $temp = array();
                $temp['image'] = IMG_URL . 'batches/' . $honor_batch->image;
                $temp['name'] = $honor_batch->{$this->session_data->language . '_name'};
                $data['batch_image'][] = $temp;
            }
            
            if ($userdetail->qualification_id != 0) {
                $qualification_batch = new Batch();
                $qualification_batch->where('id', $userdetail->qualification_id)->get();
                $temp = array();
                $temp['image'] = IMG_URL . 'batches/' . $qualification_batch->image;
                $temp['name'] = $qualification_batch->{$this->session_data->language . '_name'};
                $data['batch_image'][] = $temp;
            }
            
            if ($userdetail->security_id != 0) {
                $security_batch = new Batch();
                $security_batch->where('id', $userdetail->security_id)->get();
                $temp = array();
                $temp['image'] = IMG_URL . 'batches/' . $security_batch->image;
                $temp['name'] = $security_batch->{$this->session_data->language . '_name'};
                $data['batch_image'][] = $temp;
            }
            
            $batch = new Batch();
            $data['challenge_user_batch_image'] = $batch->where('id', $userdetail->degree_id)->get();
            $clan = new Clan($data['challenge_userdetail']->clan_id);
            $data['challenge_user_ac_sc_clan_name'] = $clan->School->Academy->{$this->session_data->language . '_academy_name'} . '<br />' . $clan->School->{$this->session_data->language . '_school_name'} . '<br />' . $clan->{$this->session_data->language . '_class_name'};
            
            $this->layout->view('students/duel_single', $data);
        }
    }
    
    function duelResult() {
        $challenge = new Challenge();
        $single = $challenge->getSingleChallengeDetails($this->input->post('id'));
        if ($single != false && $single[0]->result_status == 'MNP' && ($single[0]->from_id == $this->session_data->id || $single[0]->to_id == $this->session_data->id)) {
            if ($single[0]->to_status == 'A' && $single[0]->from_status == 'A') {
                $obj = new Challenge($this->input->post('id'));
                $obj->result_declare_by = $this->session_data->id;
                $obj->status_changed_on = get_current_date_time()->get_date_time_for_db();
                $obj->result = $this->input->post('winner');
                $obj->result_status = 'CW';
                $obj->save();
                
                $this->_sendNotificationEmail('challenge_winner_confirmation', $obj->stored, $obj->id);
            }
            $status = true;
        } else {
            $status = false;
        }
        
        echo json_encode(array('status' => $status));
    }
    
    function duelResultConfirmation() {
        $challenge = new Challenge();
        $single = $challenge->getSingleChallengeDetails($this->input->post('id'));
        
        if ($single != false && $single[0]->result_status == 'CW' && ($single[0]->from_id == $this->session_data->id || $single[0]->to_id == $this->session_data->id)) {
            
            $obj = new Challenge($this->input->post('id'));
            
            if ($this->input->post('action') == 'A') {
                
                $obj->result_status = 'MP';
                $obj->save();
                
                if ($single[0]->type == 'R') {
                    $winner_rating_point = systemRatingScore('regular_challenge_win');
                    $defeat_rating_point = systemRatingScore('regular_challenge_defeat');
                } else if ($single[0]->type == 'B') {
                    $winner_rating_point = systemRatingScore('blind_challenge_win');
                    $defeat_rating_point = systemRatingScore('blind_challenge_defeat');
                }
                
                if ($single[0]->from_id == $single[0]->result) {
                    $obj_score = new Scorehistory();
                    $obj_score->meritStudentScore($single[0]->from_id, $winner_rating_point['type'], $winner_rating_point['score'], 'Challenge winner');
                    
                    $obj_score = new Scorehistory();
                    $obj_score->meritStudentScore($single[0]->to_id, $defeat_rating_point['type'], $defeat_rating_point['score'], 'Challenge defeat');
                } else {
                    $obj_score = new Scorehistory();
                    $obj_score->meritStudentScore($single[0]->to_id, $winner_rating_point['type'], $winner_rating_point['score'], 'Challenge winner');
                    
                    $obj_score = new Scorehistory();
                    $obj_score->meritStudentScore($single[0]->from_id, $defeat_rating_point['type'], $defeat_rating_point['score'], 'Challenge defeat');
                }
                
                $this->_sendNotificationEmail('challenge_winner', $obj->stored, $obj->id);
            }
            
            if ($this->input->post('action') == 'D') {
                $obj->result_status = 'CO';
                $obj->save();
                
                $contrast_opinions = systemRatingScore('challenge_contrast_opinions');
                
                $obj_score = new Scorehistory();
                $obj_score->demeritStudentScore($single[0]->from_id, $contrast_opinions['type'], $contrast_opinions['score'], 'Contrast of opinions on challenge winner');
                
                $obj_score = new Scorehistory();
                $obj_score->demeritStudentScore($single[0]->to_id, $contrast_opinions['type'], $contrast_opinions['score'], 'Contrast of opinions on challenge winner');
                
                $this->_sendNotificationEmail('contrast_opinions_challenge_winner', $obj->stored, $obj->id);
            }
        }
        
        redirect(base_url() . 'duels/single/' . $this->input->post('id'), 'refresh');
    }
    
    function _sendNotificationEmail($type, $post, $object_id) {
        $notification = new Notification();
        $notification->type = 'N';
        $notification->notify_type = $type;
        $notification->from_id = $this->session_data->id;
        if ($post->from_id == $this->session_data->id) {
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
        if ($type == 'challenge_made') {
            if ($post->from_id == $this->session_data->id) {
                $user->where('id', $post->to_id)->get();
            } else {
                $user->where('id', $post->from_id)->get();
            }
            $message = str_replace('#to_name', $user->firstname . ' ' . $user->lastname, $message);
            $message = str_replace('#from_name', $this->session_data->name, $message);
        }
        
        if ($type == 'challenge_accepted') {
            $user->where('id', $post->from_id)->get();
            $message = str_replace('#from_name', $user->firstname . ' ' . $user->lastname, $message);
            $message = str_replace('#to_name', $this->session_data->name, $message);
        }
        
        if ($type == 'challenge_rejected') {
            if ($post->from_id == $this->session_data->id) {
                $user->where('id', $post->to_id)->get();
            } else {
                $user->where('id', $post->from_id)->get();
            }
            $message = str_replace('#from_name', $user->firstname . ' ' . $user->lastname, $message);
            $message = str_replace('#to_name', $this->session_data->name, $message);
        }
        
        if ($type == 'challenge_winner' || $type == 'challenge_winner_confirmation' || $type == 'contrast_opinions_challenge_winner') {
            if ($post->from_id == $this->session_data->id) {
                $user->where('id', $post->to_id)->get();
            } else {
                $user->where('id', $post->from_id)->get();
            }
            $message = str_replace('#user_name', $user->firstname . ' ' . $user->lastname, $message);
            $message = str_replace('#opponent_name', $this->session_data->name, $message);
            $winner = userNameAvtar($post->result);
            $message = str_replace('#winner', $winner['name'], $message);
        }
        
        if (isset($post->played_on) && $post->played_on != '') {
            $message = str_replace('#on_date', date('d-m-Y', strtotime($post->played_on)), $message);
            $message = str_replace('#on_time', date('H:i a', strtotime($post->played_on)), $message);
        } else {
            $message = str_replace('#on_date', ' not yet decided', $message);
            $message = str_replace('#on_time', '', $message);
        }
        
        $check_privacy = unserialize($user->email_privacy);
        if (is_null($check_privacy) || $check_privacy == false || !isset($check_privacy[$type]) || $check_privacy[$type] == 1) {
            
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
    
    function paymentHistory() {
        $this->layout->setField('page_title', $this->lang->line('payment') . ' ' . $this->lang->line('history'));
        $this->layout->view('students/shop');
    }
    
    function viewInvoice($id) {
        $obj = new Payment();
        $obj->where(array('id' => $id, 'user_id' => $this->session_data->id))->get();
        
        if ($obj->result_count() == 0) {
            $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
            redirect(base_url() . 'dashboard', 'refresh');
        }
        
        $data['payment_details'] = $obj;
        
        $this->layout->setField('page_title', $this->lang->line('view') . ' ' . $this->lang->line('invoice'));
        $this->layout->view('students/view_invoice', $data);
    }
    
    function viewJournal() {
        $this->layout->setField('page_title', $this->lang->line('journal'));
        $this->layout->view('students/journal');
    }
    
    function viewEvolution($id = null, $type = null) {
        $this->layout->setField('page_title', $this->lang->line('evolution'));

         if (!is_null($id) && $type == 'notification') {
            Notification::updateNotification('evolution_clan_result', $this->session_data->id, $id);
            Notification::updateNotification('evolution_clan_request_unapproved', $this->session_data->id, $id);
            Notification::updateNotification('evolution_clan_request_approved', $this->session_data->id, $id);
        }
        
        $obj_batch_history = new Userbatcheshistory();
        $obj_batch_history->select('batch_id');
        $obj_batch_history->where(array('batch_type' => 'S', 'student_id' => $this->session_data->id));
        $obj_batch_history->get();
        
        foreach ($obj_batch_history as $batch_detail) {
            $assigned_batches[] = $batch_detail->batch_id;
        }
        
        if (!isset($assigned_batches)) {
            $assigned_batches = array();
        }
        
        $orange_batch = array();
        for ($i = 0; $i <= 2; $i++) {
            for ($j = 1; $j <= 7; $j++) {
                $evolution_batch_master = evolutionMasterLevels($i, $j);
                if (in_array($evolution_batch_master['id'], $assigned_batches)) {
                    if ($i == 1) {
                        $orange_batch[] = $evolution_batch_master['id'];
                    }
                }
            }
        }
        
        $obj_category = new Evolutioncategory();
        foreach ($obj_category->get() as $category) {
            $data['evolution_categories'][] = $category->stored;
            if ($category->id == 1) {
                $obj = new Batch();
                $obj->where(array('type' => 'Q'))->order_by('sequence', 'ASC')->get();
                $count = 0;
                foreach ($obj as $level) {
                    $std_obj = new stdClass();
                    $std_obj->id = $level->id;
                    if ($count == 0) {
                        $std_obj->on_passing = 0;
                        $count++;
                    } else {
                        $std_obj->on_passing = $previous_id;
                    }
                    
                    $previous_id = $level->id;
                    $std_obj->name = $level->{$this->session_data->language . '_name'};
                    
                    $data['evolution_levels_' . $category->id][] = $std_obj;
                    $obj_clan = new Evolutionclan();
                    $obj_clan->where('evolutionlevel_id', $level->id)->order_by($this->session_data->language . '_class_name', 'ASC')->get();
                    foreach ($obj_clan as $clan) {
                        $data['evolution_clans_' . $level->id][] = $clan->stored;
                    }
                }
            } else if ($category->id == 2) {
                $obj = evolutionMasterLevels(2);
                $count = 0;

                for($i=1; $i<= count($obj); $i++){
                    $std_obj = new stdClass();
                    $std_obj->id = $obj[$i]['id'];
                    if ($count == 0 && empty($orange_batch)) {
                        $std_obj->elegible = true;
                        $count++;
                    } else {
                        $obj_temp = evolutionMasterLevels(1);
                        if (in_array($obj_temp[$i]['id'], $orange_batch)) {
                            $std_obj->elegible = true;
                        } else {
                            $std_obj->elegible = false;
                        }
                    }
                    $std_obj->name = $obj[$i][$this->session_data->language];
                    $data['evolution_levels_' . $category->id][] = $std_obj;

                    $obj_clan = new Evolutionclan();
                    $obj_clan->where('evolutionlevel_id', $obj[$i]['id'])->order_by($this->session_data->language . '_class_name', 'ASC')->get();
                    foreach ($obj_clan as $clan) {
                        $data['evolution_clans_' . $obj[$i]['id']][] = $clan->stored;
                    }
                }
            }
        }
        
        $obj_student_clan_details = new Evolutionstudent();
        $student_clan_details = $obj_student_clan_details->where('student_id', $this->session_data->id)->get();
        if ($student_clan_details->result_count() > 0) {
            foreach ($student_clan_details as $clan_details) {
                if ($clan_details->status == 'P') {
                    $data['evolution_clan_pending'][$clan_details->Evolutionclan->evolutioncategory_id][] = $clan_details->Evolutionclan->evolutionlevel_id;
                }
                
                if ($clan_details->status == 'A') {
                    $data['evolution_clan_active'][$clan_details->Evolutionclan->evolutioncategory_id][] = $clan_details->Evolutionclan->evolutionlevel_id;
                }
                
                if ($clan_details->status == 'C') {
                    $data['evolution_clan_completed'][$clan_details->Evolutionclan->evolutioncategory_id][] = $clan_details->Evolutionclan->evolutionlevel_id;
                }
            }
        }
        
        if (!isset($data['evolution_clan_pending'])) {
            $data['evolution_clan_pending'] = array();
        }
        
        if (!isset($data['evolution_clan_active'])) {
            $data['evolution_clan_active'] = array();
        }
        
        if (!isset($data['evolution_clan_completed'])) {
            $data['evolution_clan_completed'] = array();
        }
        
        $this->layout->view('students/evolution', $data);
    }
    
    function applyEvolutionClan() {
        if ($this->input->post() !== false) {
                
            $obj_student = new Evolutionstudent();
            $obj_student = $obj_student->where(array('student_id' => $this->session_data->id, 'evolutionclan_id' => $this->input->post('clan_id')))->get();
            $obj_student->evolutionclan_id = $this->input->post('clan_id');
            $obj_student->student_id = $this->session_data->id;
            if($obj_student->result_count() == 1){
                $obj_student->histroy = serialize($obj_student->stored);
            }else{
                $obj_student->histroy = null;
            }
            $obj_student->approved_by = 0;
            $obj_student->status = 'P';
            $obj_student->user_id = $this->session_data->id;
            $obj_student->save();
            
            $obj = new Evolutionstudent($obj_student->id);
            $this->_sendNotificationEmailForEvoltion('evolution_clan_request', $obj->stored, $obj->id);
            
            echo json_encode(array('status' => 'success', 'msg' => $this->lang->line('applied_for_clan_successfully')));

        } else {
            $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
            redirect(base_url() . 'dashboard', 'refresh');
        }
    }
    
    function _sendNotificationEmailForEvoltion($type, $post, $object_id) {
        $clan = new Evolutionclan($post->evolutionclan_id);
        $final_ids = array_unique(array_merge(explode(',', $clan->teacher_id), User::getAdminIds()));
        
        foreach ($final_ids as $user_id) {
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
            
            if ($type == 'evolution_clan_request') {
                $message = str_replace('#user_name', $user['name'], $message);
                $message = str_replace('#request_username', $this->session_data->name, $message);
                $message = str_replace('#clan_name', $clan->en_class_name, $message);
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
    
    function viewAdministrationReceived() {
        $this->layout->setField('page_title', $this->lang->line('administrations') . ' ' . $this->lang->line('received'));
        $this->layout->view('students/administration_received');
    }
    
    function viewAdministrationRenewal() {
        $this->layout->setField('page_title', $this->lang->line('administrations') . ' ' . $this->lang->line('renewals'));
        $this->layout->view('students/administration_renewal');
    }
    
    function viewAdministrationCertificate() {
        $this->layout->setField('page_title', $this->lang->line('administrations') . ' ' . $this->lang->line('certificates'));
        $this->layout->view('students/administration_certificate');
    }

    function viewTimline($year = 0){
        //For Timeline
        $obj = new Notification();
        $obj->where('to_id', $this->session_data->id);
        $obj->or_where('from_id', $this->session_data->id);
        $obj->get();
        $data['per_page'] = ceil($obj->result_count() / 10);

        $obj = new Notification();
        $obj->select('DISTINCT(YEAR(TIMESTAMP)) AS year');
        $obj->where('to_id', $this->session_data->id);
        $obj->or_where('from_id', $this->session_data->id);
        $obj->order_by('YEAR(TIMESTAMP)', 'ASC');
        $data['timeline_years'] = $obj->get();
        
        $data['year'] = $year;
        
        $this->layout->view('students/view_timeline', $data);
    }
}
