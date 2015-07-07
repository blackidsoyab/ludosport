<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class deans extends CI_Controller
{
    
    var $session_data;
    
    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('dean'));
        $this->session_data = $this->session->userdata('user_session');
        
        if ($this->session_data->role != 4) {
            $this->session->set_flashdata('error', 'You dont have permission to see it :-/ Please contact Admin');
            redirect(base_url() . 'denied', 'refresh');
        }
    }
    
    function teacherAbsenceApproval($id, $type= null) {
        if ($type == 'notification') {
            Notification::updateNotification('teacher_absent', $this->session_data->id, $id);
        }

        if ($this->input->post() !== false) {
            $attendance = new Teacherattendance();
            $attendance->where('id',$id )->get();
            $attendance->status = $this->input->post('status');
            if($this->input->post('status') == 'U'){
                $attendance->attendance = 1;
            }
            if($this->input->post('to_reason') != ''){
                $attendance->to_message = $this->input->post('to_reason');
            }
            $attendance->save();

            if($this->input->post('status') != 'P'){
                $attendance = new Teacherattendance();
                $attendance->where('id',$id)->get();

                if($this->input->post('status') == 'A'){
                    $notify_type = 'holiday_approved';
                }

                if($this->input->post('status') == 'U'){
                    $notify_type = 'holiday_upapproved';
                }

                //Teacher holiday approved or not
                $notification = new Notification();
                $notification->type = 'N';
                $notification->notify_type = $notify_type;
                $notification->from_id = $this->session_data->id;
                $notification->to_id = $attendance->teacher_id;
                $notification->object_id = $attendance->id;
                $notification->data = serialize(objectToArray($attendance->stored));
                $notification->save();

                $email = new Email();
                //get the mail templates
                $email->where('type', $notify_type)->get();
                $message = $email->message;

                //replace appropriate varaibles
                $teacher_details = userNameEmail($attendance->teacher_id);
                $message = str_replace('#user_name', $teacher_details['name'], $message);
                $message = str_replace('#date', date('d-m-Y', strtotime($attendance->clan_date)), $message);
                $message = str_replace('#authorized_user_name',$this->session_data->name, $message);

                $option = array();
                $option['tomailid'] = $teacher_details['email'];
                $option['subject'] = $email->subject;
                $option['message'] = $message;
                if (!is_null($email->attachment)) {
                    $option['attachement'] = base_url() . 'assets/email_attachments/' . $email->attachment;
                }
                send_mail($option);

                //To Recovery Teacher
                if($this->input->post('status') == 'A' && $attendance->recovery_teacher != 0){
                    $notification = new Notification();
                    $notification->type = 'N';
                    $notification->notify_type = 'recovery_teacher';
                    $notification->from_id = $this->session_data->id;
                    $notification->to_id = $attendance->recovery_teacher;
                    $notification->object_id = $attendance->id;
                    $notification->data = serialize(objectToArray($attendance->stored));
                    $notification->save();

                    unset($email);
                    unset($message);
                    $email = new Email();
                    //get the mail templates
                    $email->where('type', 'recovery_teacher')->get();
                    $message = $email->message;

                    //replace appropriate varaibles
                    $recovery_teacher_details = userNameEmail($attendance->recovery_teacher);
                    $message = str_replace('#user_name', $recovery_teacher_details['name'], $message);
                    $message = str_replace('#teacher_name', $teacher_details['name'], $message);
                    $message = str_replace('#clan_date', date('d-m-Y', strtotime($attendance->clan_date)), $message);
                    $message = str_replace('#approved_user_name', $this->session_data->name, $message);

                    $clan = new Clan();
                    $clan->where('id', $attendance->clan_id)->get();
                    $message = str_replace('#clan_name',$ckan->en_class_name, $message);

                    $option = array();
                    $option['tomailid'] = $recovery_teacher_details['email'];
                    $option['subject'] = $email->subject;
                    $option['message'] = $message;
                    if (!is_null($email->attachment)) {
                        $option['attachement'] = base_url() . 'assets/email_attachments/' . $email->attachment;
                    }
                    send_mail($option);
                }
            }
            
            $this->session->set_flashdata('success', 'Communicate Absence Successfully');
            redirect(base_url() . 'dashboard', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('communicate_absence'));

            $attendance = new Teacherattendance();
            $data['attendance'] = $attendance->where('id', $id)->get();
                
            $clan = new Clan();
            $data['clan_details'] = $clan->where('id', $attendance->clan_id)->get();

            $data['teacher_info'] = userNameAvtar($attendance->teacher_id);
            if($attendance->recovery_teacher != 0){
                $data['recovery_teacher'] = userNameAvtar($attendance->recovery_teacher);    
            }
            
            $this->layout->view('deans/teacher_attendance_approval', $data);
        }
    }

    function getSchoolTeachers($id){

        $attendance = new Teacherattendance();
        $attendance->where('id', $id)->get();

        $clan = new Clan();
        $clan->where('id', $attendance->clan_id)->get();
        $user_ids = $clan->getTeachersBySchool($clan->school_id);
        
        //remove the current userid from the retun ids.
        if (($key = array_search($attendance->teacher_id, $user_ids)) !== false) {
            unset($user_ids[$key]);
        }

        if (($key = array_search($attendance->recovery_teacher, $user_ids)) !== false) {
            unset($user_ids[$key]);
        }


        if (count($user_ids) > 0) {
            $user_details = new User();
            $user_details->where_in('id', $user_ids)->get();
            $str = NULL;
            foreach ($user_details as $user) {
                $str .= '<div class="col-lg-6 mar-bt-10">';
                $str .= '<div class="radio padding-left-killer">';
                $str .= '<label>';
                $str .= '<input type="radio" value="'. $user->id .'" class="i-grey-square required" name="teacher_id">';
                $str .= $user->firstname .' '. $user->lastname;
                $str .= '</label>';
                $str .= '</div>';
                $str .= '</div>';
                $str .= "\n";
            }
            $str .= '</div>';
        } else {
            $str = 'No other teacher exits in your school';
        }
        echo $str;
    }

    function UpdateRecoverTeacher(){
        if($this->input->post('teacher_id') != ''){
            $attendance = new Teacherattendance();
            $attendance->where('id', $this->input->post('attendance_id'))->update('recovery_teacher', $this->input->post('teacher_id'));    
        }
        
        echo json_encode(array('status'=>true));
    }

}
