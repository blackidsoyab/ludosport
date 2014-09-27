<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class batchrequests extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('batch_request'));
        $this->session_data = $this->session->userdata('user_session');
    }

    function viewBatchrequest($id = null, $type = null) {
        $this->layout->view('batchrequests/view');
    }

    function addBatchrequest() {
        if ($this->input->post() !== false) {
            $obj_batch_request = new Batchrequest();
            $obj_batch_request->from_role = $this->session_data->role;
            $obj_batch_request->from_id = $this->session_data->id;
            $obj_batch_request->batch_id = $this->input->post('batch_id');
            $obj_batch_request->student_id = $this->input->post('student_id');
            $obj_batch_request->description = $this->input->post('description');
            $obj_batch_request->user_id = $this->session_data->id;
            $obj_batch_request->save();

            $this->_sendNotificationAndEmail('batch_request', $this->input->post(), $obj_batch_request->id);

            $this->session->set_flashdata('success', $this->lang->line('add_data_success'));
            redirect(base_url() . 'batchrequest', 'refresh');
        } else {
            if($this->session_data->role == 1 || $this->session_data->role == 2){
                $this->session->set_flashdata('info', $this->lang->line('top_most_autority_cannot_request'));
                redirect(base_url() . 'batchrequest', 'refresh'); 
            }

            $this->layout->setField('page_title', $this->lang->line('add') . ' ' . $this->lang->line('batch_request'));

            $userdetails = new Userdetail();
            $obj_batch = new Batch();
            
            if($this->session_data->role == 3) {
                $student_ids = $user_details = $userdetails->getRelatedStudentsByRector($this->session_data->id);
                $data['batches'] = $obj_batch->where('type', 'Q')->order_by('sequence', 'ASC')->get();
            } else if($this->session_data->role == 4) {
                $student_ids = $userdetails->getRelatedStudentsByDean($this->session_data->id);
                $data['batches'] = $obj_batch->where('type', 'Q')->order_by('sequence', 'ASC')->get();
            } else if($this->session_data->role == 5) {
                $student_ids = $userdetails->getRelatedStudentsByTeacher($this->session_data->id);
                $data['batches'] = $obj_batch->where('type', 'H')->order_by('sequence', 'ASC')->get();
            }
            
            $user = new User();
            $data['student_details'] = $user->where_in('id ', $student_ids)->get();

            $this->layout->view('batchrequests/add', $data);
        }
    }

    function editBatchrequest($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $obj_batch_request = new Batchrequest();
                $obj_batch_request->where('id', $id)->get();
                $obj_batch_request->batch_id = $this->input->post('batch_id');
                $obj_batch_request->student_id = $this->input->post('student_id');
                $obj_batch_request->description = $this->input->post('description');
                $obj_batch_request->user_id = $this->session_data->id;
                $obj_batch_request->save();
                $this->session->set_flashdata('success', $this->lang->line('add_data_success'));
                redirect(base_url() . 'batchrequest', 'refresh');
            } else {
                if($this->session_data->role == 1 || $this->session_data->role == 2){
                    $this->session->set_flashdata('info', $this->lang->line('top_most_autority_cannot_request'));
                    redirect(base_url() . 'batchrequest', 'refresh'); 
                }

                $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('batch_request'));

                $obj_batch_request = new Batchrequest();
                $details  = $obj_batch_request->getBatchRequest($id, 'edit');
                if($details == false){
                    $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
                    redirect(base_url() . 'dashboard', 'refresh'); 
                }

                $data['request_details'] =  $details;

                $userdetails = new Userdetail();
                $obj_batch = new Batch();
                
                if($this->session_data->role == 3) {
                    $student_ids = $user_details = $userdetails->getRelatedStudentsByRector($this->session_data->id);
                    $data['batches'] = $obj_batch->where('type', 'Q')->order_by('sequence', 'ASC')->get();
                } else if($this->session_data->role == 4) {
                    $student_ids = $userdetails->getRelatedStudentsByDean($this->session_data->id);
                    $data['batches'] = $obj_batch->where('type', 'Q')->order_by('sequence', 'ASC')->get();
                } else if($this->session_data->role == 5) {
                    $student_ids = $userdetails->getRelatedStudentsByTeacher($this->session_data->id);
                    $data['batches'] = $obj_batch->where('type', 'H')->order_by('sequence', 'ASC')->get();
                }
                
                $user = new User();
                $data['student_details'] = $user->where_in('id ', $student_ids)->get();

                $this->layout->view('batchrequests/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'batchrequest', 'refresh');
        }
    }

    function deleteBatchrequest($id) {
        if (!empty($id)) {
            $obj_batch_request = new Batchrequest($id);
            $details  = $obj_batch_request->getBatchRequest($id, 'delete');
            if($details == false){
                $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
                redirect(base_url() . 'dashboard', 'refresh'); 
            }else{
                $obj_batch_request->delete();
                $this->session->set_flashdata('success', $this->lang->line('delete_data_success'));
                redirect(base_url() . 'batchrequest', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('delete_data_error'));
            redirect(base_url() . 'batchrequest', 'refresh');
        }
    }

    function changeStatusBatchrequest($id, $type= ''){
        $this->layout->setField('page_title', $this->lang->line('change_status') . ' ' . $this->lang->line('batch_request'));
        $obj_batch_request = new Batchrequest();
        $details  = $obj_batch_request->getBatchRequest($id,'change_status');
        if($details == false){
            $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
            redirect(base_url() . 'dashboard', 'refresh'); 
        }

        if ($type == 'notification') {
            Notification::updateNotification('batch_request', $this->session_data->id, $id);
        }

        if ($this->input->post() !== false) {
            $obj_batch_request = new Batchrequest();
            $obj_batch_request->where('id', $id)->get();
            $post = $this->input->post();

            if(isset($post['approved'])){
                $obj_batch_request->status ='A';
                $obj_batch_request->save();
                $this->_sendNotificationAndEmail('batch_request_approved', $post, $id);
                $this->session->set_flashdata('success', $this->lang->line('approved_success'));
            }

            if(isset($post['unapproved'])){
                $obj_batch_request->status = 'U';
                $obj_batch_request->save();
                $this->_sendNotificationAndEmail('batch_request_unapproved', $post, $id);
                $this->session->set_flashdata('success', $this->lang->line('unapproved_success'));
            }

            redirect(base_url() . 'batchrequest', 'refresh');
        }else{
            $data['show_approve_button'] = true;
            $data['show_unapprove_button'] = true;

            if($details->type == 'D'){
                $data['batch_type'] =  $this->lang->line('degree') ;
            } else if($details->type == 'S'){
                $data['batch_type'] =  $this->lang->line('security') ;
            } else if($details->type == 'Q'){
                $data['batch_type'] =  $this->lang->line('qualification') ;
            } else if($details->type == 'H'){
                $data['batch_type'] =  $this->lang->line('honour') ;
            } else {
                $data['batch_type'] = null;
            }

            $data['request_details'] =  $details;
            $this->layout->view('batchrequests/view_single', $data);
        }
    }

    private function _sendNotificationAndEmail($type, $post, $object_id){
        $obj_batch_request = new Batchrequest();
        $details  = $obj_batch_request->getBatchRequest($object_id,'change_status');

        //get email details
        $email = new Email();
        $email->where('type', $type)->get();
        $message = $email->message;

        if($type == 'batch_request' && $this->session_data->role == 5){
            $school = new School();
            $dean_ids = $school->getRelatedDeansByTeacher($this->session_data->id);
            foreach ($dean_ids as $dean) {
                $notification = new Notification();
                $notification->type = 'N';
                $notification->notify_type = $type;
                $notification->from_id = $this->session_data->id;
                $notification->to_id = $dean;
                $notification->object_id = $object_id;
                $notification->data = serialize(objectToArray($post));
                $notification->save();

                $dean_details = userNameEmail($dean);
                $message = str_replace('#user_name', $dean_details['name'] , $message);
                $message = str_replace('#batch_name', $details->batch_name, $message);
                $message = str_replace('#student_name', $details->student , $message);
                $message = str_replace('#request_username', $details->request_user, $message);

                $check_privacy = unserialize($dean_details['email_privacy']);
                if(is_null($check_privacy) || $check_privacy == false || $check_privacy[$type] == 1){
                    //set option for sending mail
                    $option = array();
                    $option['tomailid'] = $dean_details['email'];
                    $option['subject'] = $email->subject;
                    $option['message'] = $message;
                    if (!is_null($email->attachment)) {
                        $option['attachement'] = 'assets/email_attachments/' . $email->attachment;
                    }
                    send_mail($option);
                }
            }
        }

        if($type == 'batch_request' && $this->session_data->role == 4){
            $academies = new Academy();
            $rector_ids = $academies->getRelatedRectorsByDean($this->session_data->id);
            foreach ($rector_ids as $rector) {
                $notification = new Notification();
                $notification->type = 'N';
                $notification->notify_type = $type;
                $notification->from_id = $this->session_data->id;
                $notification->to_id = $rector;
                $notification->object_id = $object_id;
                $notification->data = serialize(objectToArray($post));
                $notification->save();

                $rector_details = userNameEmail($rector);
                $message = str_replace('#user_name', $rector_details['name'] , $message);
                $message = str_replace('#batch_name', $details->batch_name, $message);
                $message = str_replace('#student_name', $details->student , $message);
                $message = str_replace('#request_username', $details->request_user, $message);

                $check_privacy = unserialize($rector_details['email_privacy']);
                if(is_null($check_privacy) || $check_privacy == false || $check_privacy[$type] == 1){
                    //set option for sending mail
                    $option = array();
                    $option['tomailid'] = $rector_details['email'];
                    $option['subject'] = $email->subject;
                    $option['message'] = $message;
                    if (!is_null($email->attachment)) {
                        $option['attachement'] = 'assets/email_attachments/' . $email->attachment;
                    }
                    send_mail($option);
                }
            }
        }

        if($type == 'batch_request' && $this->session_data->role == 3){
            $admin_ids = User::getAdminIds();
            foreach ($admin_ids as $admin) {
                $notification = new Notification();
                $notification->type = 'N';
                $notification->notify_type = $type;
                $notification->from_id = $this->session_data->id;
                $notification->to_id = $admin;
                $notification->object_id = $object_id;
                $notification->data = serialize(objectToArray($post));
                $notification->save();

                $admin_details = userNameEmail($admin);
                $message = str_replace('#user_name', $admin_details['name'] , $message);
                $message = str_replace('#batch_name', $details->batch_name, $message);
                $message = str_replace('#student_name', $details->student , $message);
                $message = str_replace('#request_username', $details->request_user, $message);

                $check_privacy = unserialize($admin_details['email_privacy']);
                if(is_null($check_privacy) || $check_privacy == false || $check_privacy[$type] == 1){
                    //set option for sending mail
                    $option = array();
                    $option['tomailid'] = $admin_details['email'];
                    $option['subject'] = $email->subject;
                    $option['message'] = $message;
                    if (!is_null($email->attachment)) {
                        $option['attachement'] = 'assets/email_attachments/' . $email->attachment;
                    }
                    send_mail($option);
                }
            }
        }

        if($type == 'batch_request_approved' || $type == 'batch_request_unapproved'){
            $notification = new Notification();
            $notification->type = 'N';
            $notification->notify_type = $type;
            $notification->from_id = $this->session_data->id;
            $notification->to_id = $post['from_id'];
            $notification->object_id = $object_id;
            $notification->data = serialize(objectToArray($post));
            $notification->save();

            $user_details = userNameEmail($post['from_id']);
            $message = str_replace('#user_name', $user_details['name'] , $message);
            $message = str_replace('#batch_name', $details->batch_name, $message);
            $message = str_replace('#student_name', $details->student , $message);
            $message = str_replace('#request_username', $details->request_user, $message);
            $message = str_replace('#authorized_username', $this->session_data->name, $message);

            $check_privacy = unserialize($user_details['email_privacy']);
            if(is_null($check_privacy) || $check_privacy == false  || !isset($check_privacy[$type]) || $check_privacy[$type] == 1){
                //set option for sending mail
                $option = array();
                $option['tomailid'] = $user_details['email'];
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
