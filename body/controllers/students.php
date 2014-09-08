<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class students extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('user'));
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
                $option['attachement'] = base_url() . 'assets/email_attachments/' . $email->attachment;
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
                    $option['attachement'] = base_url() . 'assets/email_attachments/' . $email->attachment;
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
        $this->layout->view('students/view_histroy');
    }

    function viewTopRating(){
        $this->layout->setField('page_title', $this->lang->line('top_10_rating'));
        $this->layout->view('students/top_ten_rating');
    }

    function viewRatingList(){
        $this->layout->setField('page_title', $this->lang->line('rating_list'));
        $this->layout->view('students/rating_list');
    }

    function viewDuelsList(){
        $this->layout->setField('page_title', $this->lang->line('duels_list'));
        $this->layout->view('students/duels_list');
    }

}
