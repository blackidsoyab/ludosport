<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class batchrequests extends CI_Controller
{
    
    var $session_data;
    
    //Constructor
    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('batch_request'));
        $this->session_data = $this->session->userdata('user_session');
    }
    
    //List all Badge Request
    function viewBatchrequest($id = null, $type = null) {
        if (is_null($id)) {
            $this->layout->view('batchrequests/view');
        } else {
            $obj_batch_request = new Batchrequest();
            $details = $obj_batch_request->getBatchRequest($id, 'change_status');
            $obj_batch = new Batch($details->batch_id);
            
            if ($details == false) {
                $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
                redirect(base_url() . 'dashboard', 'refresh');
            }
            
            if ($type == 'notification') {
                Notification::updateNotification('batch_request_approved', $this->session_data->id, $id);
                Notification::updateNotification('batch_request_unapproved', $this->session_data->id, $id);
            }
            
            $data['show_approve_button'] = false;
            $data['show_unapprove_button'] = false;
            
            if ($details->type == 'D') {
                $data['batch_type'] = $this->lang->line('degree');
            } else if ($details->type == 'S') {
                $data['batch_type'] = $this->lang->line('security');
            } else if ($details->type == 'Q') {
                $data['batch_type'] = $this->lang->line('qualification');
            } else if ($details->type == 'H') {
                $data['batch_type'] = $this->lang->line('honour');
            } else {
                $data['batch_type'] = null;
            }
            
            if ($details->status != 'P') {
                $data['request_status'] = ($details->status == 'A') ? '<label class="label label-success">' . $this->lang->line('approved_batch_request') . '</label>' : $this->lang->line('unapproved_batch_request');
                $data['request_status_changed_by'] = userNameAvtar($details->status_change_by, true);
            }
            
            $data['request_details'] = $details;
            $this->layout->view('batchrequests/view_single', $data);
        }
    }
    
    //Add the Badge Request
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
            if ($this->session_data->role == 1 || $this->session_data->role == 2) {
                $this->session->set_flashdata('info', $this->lang->line('top_most_autority_cannot_request'));
                redirect(base_url() . 'batchrequest', 'refresh');
            }
            
            $this->layout->setField('page_title', $this->lang->line('add') . ' ' . $this->lang->line('batch_request'));
            
            $userdetails = new Userdetail();
            $obj_batch = new Batch();
            
            if ($this->session_data->role == 3) {
                $student_ids = $user_details = $userdetails->getRelatedStudentsByRector($this->session_data->id);
                $data['batches'] = $obj_batch->where('type', 'Q')->order_by('sequence', 'ASC')->get();
            } else if ($this->session_data->role == 4) {
                $student_ids = $userdetails->getRelatedStudentsByDean($this->session_data->id);
                $data['batches'] = $obj_batch->where('type', 'Q')->order_by('sequence', 'ASC')->get();
            } else if ($this->session_data->role == 5) {
                $student_ids = $userdetails->getRelatedStudentsByTeacher($this->session_data->id);
                $data['batches'] = $obj_batch->where('type', 'H')->order_by('sequence', 'ASC')->get();
            }
            
            $user = new User();
            $data['student_details'] = $user->where_in('id ', $student_ids)->get();
            
            $this->layout->view('batchrequests/add', $data);
        }
    }
    
    /*
     *   Edit the Badge Request
     *   Param1(required) : Badge request id
    */
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
                $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('batch_request'));
                
                $obj_batch_request = new Batchrequest();
                $details = $obj_batch_request->getBatchRequest($id, 'edit');
                if ($details == false) {
                    $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
                    redirect(base_url() . 'dashboard', 'refresh');
                }
                
                $data['request_details'] = $details;
                
                $userdetails = new Userdetail();
                $obj_batch = new Batch();
                
                if ($this->session_data->role == 1 || $this->session_data->role == 2) {
                    $student_ids = $user_details = $userdetails->getRelatedStudentsByStudent($details->student_id);
                    $data['batches'] = $obj_batch->where('type', $details->type)->order_by('sequence', 'ASC')->get();
                } else if ($this->session_data->role == 3) {
                    $student_ids = $user_details = $userdetails->getRelatedStudentsByRector($this->session_data->id);
                    $data['batches'] = $obj_batch->where('type', 'Q')->order_by('sequence', 'ASC')->get();
                } else if ($this->session_data->role == 4) {
                    $student_ids = $userdetails->getRelatedStudentsByDean($this->session_data->id);
                    $data['batches'] = $obj_batch->where('type', 'Q')->order_by('sequence', 'ASC')->get();
                } else if ($this->session_data->role == 5) {
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
    
    /*
     *   Delete the Badge Request
     *   Param1(required) : Badge request id
    */
    function deleteBatchrequest($id) {
        if (!empty($id)) {
            $obj_batch_request = new Batchrequest($id);
            $details = $obj_batch_request->getBatchRequest($id, 'delete');
            if ($details == false) {
                $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
                redirect(base_url() . 'dashboard', 'refresh');
            } else {
                $obj_batch_request->delete();
                $this->session->set_flashdata('success', $this->lang->line('delete_data_success'));
                redirect(base_url() . 'batchrequest', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('delete_data_error'));
            redirect(base_url() . 'batchrequest', 'refresh');
        }
    }
    
    /*
     *   Change the status Badge Request (Approve / Unapprove)
     *   Param1(required) : Badge request id
     *   Param2(optional) : string e.g. notification
    */
    function changeStatusBatchrequest($id, $type = '') {
        $this->layout->setField('page_title', $this->lang->line('change_status') . ' ' . $this->lang->line('batch_request'));
        $obj_batch_request = new Batchrequest();
        $details = $obj_batch_request->getBatchRequest($id, 'change_status');
        $obj_batch = new Batch($details->batch_id);
        
        if ($details == false) {
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
            
            if (isset($post['approved'])) {
                $obj_batch_request->status = 'A';
                $obj_batch_request->status_change_by = $this->session_data->id;
                $obj_batch_request->save();
                
                $obj_batch = new Batch($details->batch_id);
                $obj_batch_history = new Userbatcheshistory();
                $obj_userdetail = new Userdetail();
                $obj_userdetail->where('student_master_id', $details->student_id)->get();
                if ($obj_batch->type == 'D') {
                    $obj_batch_history->saveStudentBatchHistory($details->student_id, 'D', $details->batch_id);
                    $obj_userdetail->degree_id = $details->batch_id;
                }
                
                if ($obj_batch->type == 'H') {
                    $obj_batch_history->saveStudentBatchHistory($details->student_id, 'H', $details->batch_id);
                    $obj_userdetail->honour_id = $details->batch_id;
                }
                
                if ($obj_batch->type == 'Q') {
                    $obj_batch_history->saveStudentBatchHistory($details->student_id, 'Q', $details->batch_id);
                    $obj_userdetail->qualification_id = $details->batch_id;
                }
                
                if ($obj_batch->type == 'S') {
                    $obj_batch_history->saveStudentBatchHistory($details->student_id, 'S', $details->batch_id);
                    $obj_userdetail->qualification_id = $details->batch_id;
                }
                
                $obj_userdetail->save();
                
                if ($obj_batch->has_point == 1) {
                    $obj_score_history = new Scorehistory();
                    $obj_score_history->meritStudentScore($details->student_id, 'xpr', $obj_batch->xpr, 'Badge request approved');
                    $obj_score_history->meritStudentScore($details->student_id, 'war', $obj_batch->war, 'Badge request approved');
                    $obj_score_history->meritStudentScore($details->student_id, 'sty', $obj_batch->sty, 'Badge request approved');
                }
                
                $this->_sendNotificationAndEmail('batch_request_approved', $post, $id);
                $this->session->set_flashdata('success', $this->lang->line('approved_success'));
            }
            
            if (isset($post['unapproved'])) {
                $obj_batch_request->status = 'U';
                $obj_batch_request->status_change_by = $this->session_data->id;
                $obj_batch_request->save();
                
                if ($details->status == 'A') {
                    $new_batch_id = 0;
                    $obj_batch = new Batch($details->batch_id);
                    
                    $obj_userdetail = new Userdetail();
                    $obj_userdetail->where('student_master_id', $details->student_id)->get();
                    
                    $obj_batch_history = new Userbatcheshistory();
                    $obj_batch_history->where(array('student_id' => $details->student_id, 'batch_type' => $obj_batch->type, 'batch_id' => $details->batch_id))->get();
                    if ($obj_batch_history->result_count() == 1) {
                        $obj_batch_history->delete();
                        
                        unset($obj_batch_history);
                        $obj_batch_history = new Userbatcheshistory();
                        $obj_batch_history->where(array('student_id' => $details->student_id, 'batch_type' => $obj_batch->type))->order_by('timestamp', 'DESC')->get(1);
                        if ($obj_batch_history->result_count() == 1) {
                            $new_batch_id = $obj_batch_history->batch_id;
                        }
                    }
                    
                    if ($obj_batch->type == 'D') {
                        $obj_userdetail->degree_id = $new_batch_id;
                    }
                    
                    if ($obj_batch->type == 'H') {
                        $obj_userdetail->honour_id = $new_batch_id;
                    }
                    
                    if ($obj_batch->type == 'Q') {
                        $obj_userdetail->qualification_id = $new_batch_id;
                    }
                    
                    if ($obj_batch->type == 'S') {
                        $obj_userdetail->qualification_id = $new_batch_id;
                    }
                    
                    $obj_userdetail->save();
                    
                    if ($obj_batch->has_point == 1) {
                        $obj_score_history = new Scorehistory();
                        $obj_score_history->demeritStudentScore($details->student_id, 'xpr', $obj_batch->xpr, 'Badge request unapproved after approved');
                        $obj_score_history->demeritStudentScore($details->student_id, 'war', $obj_batch->war, 'Badge request unapproved after approved');
                        $obj_score_history->demeritStudentScore($details->student_id, 'sty', $obj_batch->sty, 'Badge request unapproved after approved');
                    }
                }
                
                $this->_sendNotificationAndEmail('batch_request_unapproved', $post, $id);
                $this->session->set_flashdata('success', $this->lang->line('unapproved_success'));
            }
            
            redirect(base_url() . 'batchrequest', 'refresh');
        } else {
            $data['show_approve_button'] = false;
            $data['show_unapprove_button'] = false;
            
            if ($this->session_data->role == 1 || $this->session_data->role == 2) {
                $data['show_approve_button'] = true;
                $data['show_unapprove_button'] = true;
            } else {
                if ($details->status == 'P' && $this->session_data->role < $details->from_role && hasPermission('batchrequests', 'changeStatusBatchrequest')) {
                    $data['show_approve_button'] = true;
                    $data['show_unapprove_button'] = true;
                }
            }
            
            if ($details->type == 'D') {
                $data['batch_type'] = $this->lang->line('degree');
            } else if ($details->type == 'S') {
                $data['batch_type'] = $this->lang->line('security');
            } else if ($details->type == 'Q') {
                $data['batch_type'] = $this->lang->line('qualification');
            } else if ($details->type == 'H') {
                $data['batch_type'] = $this->lang->line('honour');
            } else {
                $data['batch_type'] = null;
            }
            
            if ($details->status != 'P') {
                $data['request_status'] = ($details->status == 'A') ? '<label class="label label-success">' . $this->lang->line('approved_batch_request') . '</label>' : $this->lang->line('unapproved_batch_request');
                $data['request_status_changed_by'] = userNameAvtar($details->status_change_by, true);
            }
            
            $data['request_details'] = $details;
            $this->layout->view('batchrequests/view_single', $data);
        }
    }
    
    /*
     *   Send the Notification and Email to related Users
     *   Param1(required) : type of notification and Email {batch_request, batch_request_approved, batch_request_unapproved}
     *   Param2(required) : all the data that is post from the GUI
     *   Param3(required) : Badge request id
    */
    private function _sendNotificationAndEmail($type, $post, $object_id) {
        $obj_batch_request = new Batchrequest();
        $details = $obj_batch_request->getBatchRequest($object_id, 'change_status');
        
        //get email details
        $email = new Email();
        $email->where('type', $type)->get();
        $message = $email->message;
        
        if ($type == 'batch_request' && $this->session_data->role == 5) {
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
                $message = str_replace('#user_name', $dean_details['name'], $message);
                $message = str_replace('#batch_name', $details->batch_name, $message);
                $message = str_replace('#student_name', $details->student, $message);
                $message = str_replace('#request_username', $details->request_user, $message);
                
                $check_privacy = unserialize($dean_details['email_privacy']);
                if (is_null($check_privacy) || $check_privacy == false || !isset($check_privacy[$type]) || $check_privacy[$type] == 1) {
                    
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
        
        if ($type == 'batch_request' && $this->session_data->role == 4) {
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
                $message = str_replace('#user_name', $rector_details['name'], $message);
                $message = str_replace('#batch_name', $details->batch_name, $message);
                $message = str_replace('#student_name', $details->student, $message);
                $message = str_replace('#request_username', $details->request_user, $message);
                
                $check_privacy = unserialize($rector_details['email_privacy']);
                if (is_null($check_privacy) || $check_privacy == false || !isset($check_privacy[$type]) || $check_privacy[$type] == 1) {
                    
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
        
        if ($type == 'batch_request' && $this->session_data->role == 3) {
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
                $message = str_replace('#user_name', $admin_details['name'], $message);
                $message = str_replace('#batch_name', $details->batch_name, $message);
                $message = str_replace('#student_name', $details->student, $message);
                $message = str_replace('#request_username', $details->request_user, $message);
                
                $check_privacy = unserialize($admin_details['email_privacy']);
                if (is_null($check_privacy) || $check_privacy == false || !isset($check_privacy[$type]) || $check_privacy[$type] == 1) {
                    
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
        
        if ($type == 'batch_request_approved' || $type == 'batch_request_unapproved') {
            $notification = new Notification();
            $notification->type = 'N';
            $notification->notify_type = $type;
            $notification->from_id = $this->session_data->id;
            $notification->to_id = $post['from_id'];
            $notification->object_id = $object_id;
            $notification->data = serialize(objectToArray($post));
            $notification->save();
            
            $user_details = userNameEmail($post['from_id']);
            $message = str_replace('#user_name', $user_details['name'], $message);
            $message = str_replace('#batch_name', $details->batch_name, $message);
            $message = str_replace('#student_name', $details->student, $message);
            $message = str_replace('#request_username', $details->request_user, $message);
            $message = str_replace('#authorized_username', $this->session_data->name, $message);
            
            $check_privacy = unserialize($user_details['email_privacy']);
            if (is_null($check_privacy) || $check_privacy == false || !isset($check_privacy[$type]) || $check_privacy[$type] == 1) {
                
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
