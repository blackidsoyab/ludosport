<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class teachers extends CI_Controller
{
    
    var $session_data;
    
    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('teacher'));
        $this->session_data = $this->session->userdata('user_session');
        
        if ($this->session_data->role != 5) {
            $this->session->set_flashdata('error', $this->lang->line('permisson_error'));
            redirect(base_url() . 'denied', 'refresh');
        }
    }
    
    function markAbsence() {
        if ($this->input->post() !== false) {
            $attadence = new Teacherattendance();
            $attadence->where(array('clan_id' => $this->input->post('clan_id'), 'clan_date' => $this->input->post('date'), 'teacher_id' => $this->session_data->id))->get();
            if($this->input->post('from_message') != ''){
                $attadence->from_message = @$this->input->post('from_message');    
            }
            $attadence->clan_date = $this->input->post('date');
            $attadence->clan_id = $this->input->post('clan_id');
            $attadence->teacher_id = $this->session_data->id;
            $attadence->attendance = 0;
            if($this->input->post('action') == 'recover-teacher'){
                $attadence->recovery_teacher = $this->input->post('teacher_id');
            }else{
                $attadence->recovery_teacher = 0;
            }
            $attadence->status = 'P';            
            $attadence->user_id = $this->session_data->id;
            $attadence->save();
            
            $school = new School();
            $deans = $school->getDeansByClan($this->input->post('clan_id'));

            $clan = new Clan;
            $clan->where('id', $this->input->post('clan_id'))->get();

            $email = new Email();
            //get the mail templates
            $email->where('type', 'teacher_absent')->get();
            $message = $email->message;

            //replace appropriate varaibles
            $message = str_replace('#teacher_name', $this->session_data->name, $message);
            $message = str_replace('#clan_name', $clan->en_class_name, $message);
            $message = str_replace('#date', date('d-m-Y', strtotime($this->input->post('date'))), $message);

            foreach ($deans as  $dean) {
                $notification = new Notification();
                $notification->type = 'N';
                $notification->notify_type = 'teacher_absent';
                $notification->from_id = $this->session_data->id;
                $notification->to_id = $dean;
                $notification->object_id = $attadence->id;
                $notification->data = serialize($this->input->post());
                $notification->save();
                
                $user_details = userNameEmail($dean);
                $check_privacy = unserialize($user_details['email_privacy']);
                if(is_null($check_privacy) || $check_privacy == false  || !isset($check_privacy[$type]) || $check_privacy['teacher_absent'] == 1){
                    $message = str_replace('#user_name', $user_details['name'], $message);

                    $option = array();
                    $option['tomailid'] = $user_details->email;
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
            $this->layout->setField('page_title', $this->lang->line('communicate_absence'));

            $clan = new Clan();
            $data['clans'] = $clan->where('teacher_id', $this->session_data->id)->get();
            
            $this->layout->view('teachers/teacher_attendance', $data);
        }
    }
    
    function teachersReleatedSchool($clan_id) {
        $clan = new Clan();
        $clan->where('id', $clan_id)->get();
        $user_ids = $clan->getTeachersBySchool($clan->school_id);
        
        //remove the current userid from the retun ids.
        if (($key = array_search($this->session_data->id, $user_ids)) !== false) {
            unset($user_ids[$key]);
        }
        $str = NULL;
        if (count($user_ids) > 0) {
            $user_details = new User();
            $user_details->where_in('id', $user_ids)->get();
            foreach ($user_details as $user_key => $user_value) {
                $str.= '<div class="col-lg-4 col-xs-4 clan-date">';
                $str.= '<div class="the-box rounded text-center padding-killer mar-bt-10" data-teacher-id="' . $user_value->id . '">';
                $str.= '<input type="radio" value="' . $user_value->id . '" name="teacher_id" />';
                $str.= '<h4 class="light">' . $user_value->firstname . ' ' . $user_value->lastname . '</h4>';
                $str.= '</div></div>';
                $str.= "\n";
            }
        } else {
            $str.= "No teacher exits in your school";
        }
        
        echo $str;
    }
}
