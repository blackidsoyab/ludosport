<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class messages extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('message'));
        $this->session_data = $this->session->userdata('user_session');

        if ($this->session_data->status == 'P') {
            $this->session->set_flashdata('error', 'You dont have permission!! :-/ Please contact Admin');
            redirect(base_url() . 'denied', 'refresh');
        }
    }

    private function _sidebarData() {
        $message = new Message();

        $data['count_inbox'] = $message->countInboxUnRead($this->session_data->id);
        unset($message);
        $message = new Message();
        $data['count_sent'] = $message->where('from_id', $this->session_data->id)->where('from_status', 'S')->get()->result_count();
        unset($message);
        $message = new Message();
        $data['count_trash'] = $message->coutTrashCount($this->session_data->id);
        unset($message);
        return $data;
    }

    public function viewMessage() {
        $data = $this->_sidebarData();
        $data['view_title'] = 'Message Inbox';
        $data['message_box'] = 'inbox';
        $data['message_page_layout'] = $this->load->view('messages/list', $data, true);
        $this->layout->view('messages/sidebar', $data);
    }

    public function composeMessage($type = 'single') {
        if ($this->input->post() !== false) {

            if ($this->input->post('message_type') == 'single') {
                $this->_saveSingleMessage();
            } else if ($this->input->post('message_type') == 'group') {
                $this->_saveGroupMessage();
            }

            $this->session->set_flashdata('success', $this->lang->line('message_sent_success'));
            redirect(base_url() . 'message', 'refresh');
        } else {
            $data = $this->_sidebarData();
            $data['view_title'] = 'Compose Message';
            $data['type'] = $type;
            $data['message_all_types'] = $this->_getMessageType();

            if ($type == 'single') {
                $data['users'] = $this->_getUsersForMessage();
            } else if ($type == 'group') {
                $data['groups'] = $this->_getGroupsForMessage();
            }

            $data['message_page_layout'] = $this->load->view('messages/compose', $data, true);
            $this->layout->view('messages/sidebar', $data);
        }
    }

    private function _saveGroupMessage() {
        $user = new User();
        $permissions = $user->userRoleByID($this->session_data->id, $this->session_data->role);
        foreach ($this->input->post('to_id') as $to) {
            $message = new Message();
            $message->type = $this->input->post('message_type');
            $message->reply_of = $this->input->post('reply_of');
            $message->from_id = $this->session_data->id;
            if ($this->input->post('message_type') == 'group') {
                $to_id = explode('_', $to);
                if (isset($permissions['messages']['group_message'][$to_id[1]])) {
                    $what_to_fetch = $permissions['messages']['group_message'][$to_id[1]];
                } else if (isset($permissions['messages']['group_message']['clans'])) {
                    $what_to_fetch = $permissions['messages']['group_message']['clans'];
                }
                $message->group_id = $to . '_' . $what_to_fetch;
                $user_ids = $this->_getIdsForGroup($to_id[1], $to_id[0], $what_to_fetch);
                if (($key = array_search($this->session_data->id, $user_ids)) !== false) {
                    unset($user_ids[$key]);
                }
                $message->to_id = implode(',', $user_ids);
            }
            $message->subject = $this->input->post('subject');
            $message->message = $this->input->post('message');
            if ($this->input->post('action') == 'send') {
                $from_status = 'S';
                $to_status = 'R';
            } else if ($this->input->post('action') == 'draft') {
                $from_status = 'D';
                $to_status = 'D';
            }

            $message->from_status = $from_status;
            $message->to_status = $to_status;
            if (!is_null($message->to_id)) {
                $message->save();
                $message->where('id', $message->id)->update('initial_id', $message->id);
                if (!empty($_FILES['attachments'])) {
                    $this->uploadAttachments($message->id);
                } 

                if(isset($user_ids)) {
                    foreach ($user_ids as $value) {
                        $status = new Messagestatus();
                        $status->message_id = $message->id;
                        $status->status = 'U';
                        $status->to_id = $value;
                        $status->save();
                    }
                }
            }
        }
        return TRUE;
    }

    private function _saveSingleMessage() {
        foreach ($this->input->post('to_id') as $to) {
            $message = new Message();
            $message->type = $this->input->post('message_type');
            $message->reply_of = $this->input->post('reply_of');
            $message->from_id = $this->session_data->id;
            $message->group_id = 0;
            if ($this->input->post('message_type') == 'single') {
                $message->to_id = $to;
            }
            $message->subject = $this->input->post('subject');
            $message->message = $this->input->post('message');
            if ($this->input->post('action') == 'send') {
                $from_status = 'S';
                $to_status = 'U';
            } else if ($this->input->post('action') == 'draft') {
                $from_status = 'D';
                $to_status = 'D';
            }

            $message->from_status = $from_status;
            $message->to_status = $to_status;
            $message->save();
            $message->where('id', $message->id)->update('initial_id', $message->id);

            if (!empty($_FILES['attachments'])) {
                $this->uploadAttachments($message->id);
            }
            
        }

        return TRUE;
    }

    function uploadAttachments($id){
        $attachments = $this->uploadMultiple('attachments');
        foreach ($attachments as $key => $value) {
            $obj_attach = new Messageattachment();
            $obj_attach->message_id = $id;
            $obj_attach->file_name = $value['file_name'];
            $obj_attach->original_name = $value['orig_name'];
            $obj_attach->file_type = $value['file_type'];
            $obj_attach->file_size = $value['file_size'];
            $obj_attach->user_id = $this->session_data->id;
            $obj_attach->save();
        } 
    }

    function uploadMultiple($filed){
        //Configure upload.
        $this->upload->initialize(array(
            'upload_path'   => "./assets/message_attachments/",
            'allowed_types' => 'jpg|jpeg|gif|png|bmp',
            'overwrite' => FALSE,
            'remove_spaces' => TRUE,
            'encrypt_name' => TRUE
        ));

        $this->upload->do_multi_upload($filed);
        return $this->upload->get_multi_upload_data();
    }

    private function _getMessageType() {
        if ($this->session_data->id == 1) {
            return array('single', 'group');
        } else {
            $user = new User();
            $permissions = $user->userRoleByID($this->session_data->id, $this->session_data->role);
            if (!empty($permissions) && isset($permissions['messages'])) {
                $types = array_keys($permissions['messages']);

                if (!is_null($permissions)) {
                    $return = array();
                    foreach ($types as $type) {
                        $temp = explode('_', $type);
                        $return[] = $temp[0];
                    }
                    return $return;
                } else {
                    return array('single');
                }
            }
        }
    }

    private function _getUsersForMessage() {
        if ($this->session_data->id == 1) {
            $users = new User();
            return $users->getUserBelowRole($this->session_data->role);
        } else {
            $user = new User();
            $permissions = $user->userRoleByID($this->session_data->id, $this->session_data->role);
            if (!empty($permissions) && isset($permissions['messages']) && isset($permissions['messages']['single_message'])) {
                $user_roles = array_filter($permissions['messages']['single_message']);
                $array = array();
                foreach ($user_roles as $role_id => $permission) {
                    if ($permission == 1) {
                        $user = new User();
                        $array[$role_id] = $user->getUsersByRole($role_id);
                    } else if ($permission == 2) {
                        $array[$role_id] = $this->_getRelatedUsers($role_id);
                    } else {
                        continue;
                    }
                }

                asort(($array));
                return subvalue_sort(array_map("unserialize", array_unique(array_map("serialize", MultiArrayToSinlgeArray($array)))), 'firstname');
            }
        }
    }

    private function _getRelatedUsers($role_id) {

        if ($this->session_data->role == 1 || $this->session_data->role == 2) {
            $user = new User();
            return $user->getUsersByRole($role_id);
        }

        if ($role_id == 2) {
            $user = new User();
            return $user->getUsersByRole($role_id);
        }

        /* Start Related Users For Rector */

        if ($this->session_data->role == 3 && $role_id == 3) {
            $academy = new Academy();
            $rectors_id = $academy->getRelatedRectorsByRector($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($rectors_id);
        }

        if ($this->session_data->role == 3 && $role_id == 4) {
            $school = new School();
            $dean_ids = $school->getRelatedDeansByRector($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($dean_ids);
        }

        if ($this->session_data->role == 3 && $role_id == 5) {
            $class = new Clan();
            $teachers_id = $class->getRelatedTeachersByRector($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($teachers_id);
        }

        if ($this->session_data->role == 3 && $role_id == 6) {
            $user_detail = new Userdetail();
            $students_id = $user_detail->getRelatedStudentsByRector($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($students_id);
        }

        /* End Related Users For Rector */

        /* Start Related Users For Dean */

        if ($this->session_data->role == 4 && $role_id == 3) {
            $academy = new Academy();
            $rectors_id = $academy->getRelatedRectorsByDean($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($rectors_id);
        }

        if ($this->session_data->role == 4 && $role_id == 4) {
            $school = new School();
            $dean_ids = $school->getRelatedDeansByDean($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($dean_ids);
        }

        if ($this->session_data->role == 4 && $role_id == 5) {
            $class = new Clan();
            $teachers_id = $class->getRelatedTeachersByDean($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($teachers_id);
        }

        if ($this->session_data->role == 4 && $role_id == 6) {
            $user_detail = new Userdetail();
            $students_id = $user_detail->getRelatedStudentsByDean($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($students_id);
        }

        /* End Related Users For Dean */

        /* Start Related Users For Teacher */

        if ($this->session_data->role == 5 && $role_id == 3) {
            $academy = new Academy();
            $rectors_id = $academy->getRelatedRectorsByTeacher($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($rectors_id);
        }

        if ($this->session_data->role == 5 && $role_id == 4) {
            $school = new School();
            $dean_ids = $school->getRelatedDeansByTeacher($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($dean_ids);
        }

        if ($this->session_data->role == 5 && $role_id == 5) {
            $class = new Clan();
            $teachers_id = $class->getRelatedTeachersByTeacher($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($teachers_id);
        }

        if ($this->session_data->role == 5 && $role_id == 6) {
            $user_detail = new Userdetail();
            $students_id = $user_detail->getRelatedStudentsByTeacher($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($students_id);
        }

        /* End Related Users For Teacher */

        /* Start Related Users For Student */

        if ($this->session_data->role == 6 && $role_id == 3) {
            $academy = new Academy();
            $rectors_id = $academy->getRelatedRectorsByStudent($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($rectors_id);
        }

        if ($this->session_data->role == 6 && $role_id == 4) {
            $school = new School();
            $dean_ids = $school->getRelatedDeansByStudent($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($dean_ids);
        }

        if ($this->session_data->role == 5 && $role_id == 6) {
            $class = new Clan();
            $teachers_id = $class->getRelatedTeachersByStudent($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($teachers_id);
        }

        if ($this->session_data->role == 6 && $role_id == 6) {
            $user_detail = new Userdetail();
            $students_id = $user_detail->getRelatedStudentsByStudent($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($students_id);
        }

        /* End Related Users For Student */
    }

    private function _getGroupsForMessage() {
        if ($this->session_data->id == 1) {
            $roles = new Role();
            $array = array();
            $roles->where(array('id >' => '1'))->get();
            foreach ($roles as $value) {
                $temp = new stdClass();
                $temp->name = $value->{$this->session_data->language . '_role_name'};
                $temp->id = strtolower($temp->name) . '_' . $value->id;
                $array[] = $temp;
            }
            return $array;
        } else {
            $user = new User();
            $permissions = $user->userRoleByID($this->session_data->id, $this->session_data->role);
            if (!empty($permissions) && isset($permissions['messages']) && isset($permissions['messages']['group_message'])) {
                $groups = array_filter($permissions['messages']['group_message']);
                $roles = new Role();
                $array = array();
                foreach ($groups as $role_id => $value) {
                    if ($role_id != 'clans') {
                        $roles->where(array('id' => $role_id))->get();
                        $temp = new stdClass();
                        $temp->name = $roles->{$this->session_data->language . '_role_name'};
                        $temp->id = strtolower($temp->name) . '_' . $roles->id;
                        $array[] = $temp;
                    } else if ($role_id == 'clans') {
                        if ($value == 1) {
                            $clan = new Clan();
                            foreach ($clan->get() as $value) {
                                $temp = new stdClass();
                                $temp->name = $value->{$this->session_data->language . '_class_name'};
                                $temp->id = 'clans_' . $value->id;
                                $array[] = $temp;
                            }
                        } else {

                            if ($this->session_data->role == 6) {
                                $user_details = new Userdetail();
                                $user_details->where('student_master_id', $this->session_data->id)->get();
                                $clan = new Clan();
                                $clan->where('id', $user_details->clan_id)->get();
                                foreach ($clan as $value) {
                                    $temp = new stdClass();
                                    $temp->id = 'clans_' . $value->id;
                                    $temp->name = $value->{$this->session_data->language . '_class_name'};
                                    $array[] = $temp;
                                }
                            }

                            if ($this->session_data->role == 5) {
                                $clan = new Clan();
                                $clans = $clan->getClanOfTeacher($this->session_data->id);
                                foreach ($clans as $value) {
                                    $temp = new stdClass();
                                    $temp->id = 'clans_' . $value->id;
                                    $temp->name = $value->{$this->session_data->language . '_class_name'};
                                    $array[] = $temp;
                                }
                            }

                            if ($this->session_data->role == 4) {
                                $clan = new Clan();
                                $clans = $clan->getClanOfDean($this->session_data->id);
                                foreach ($clans as $value) {
                                    $temp = new stdClass();
                                    $temp->id = 'clans_' . $value->id;
                                    $temp->name = $value->{$this->session_data->language . '_class_name'};
                                    $array[] = $temp;
                                }
                            }

                            if ($this->session_data->role == 3) {
                                $clan = new Clan();
                                $clans = $clan->getClanOfRector($this->session_data->id);
                                foreach ($clans as $value) {
                                    $temp = new stdClass();
                                    $temp->id = 'clans_' . $value->id;
                                    $temp->name = $value->{$this->session_data->language . '_class_name'};
                                    $array[] = $temp;
                                }
                            }

                            if ($this->session_data->role == 2) {
                                $clan = new Clan();
                                foreach ($clan->get() as $value) {
                                    $temp = new stdClass();
                                    $temp->id = 'clans_' . $value->id;
                                    $temp->name = $value->{$this->session_data->language . '_class_name'};
                                    $array[] = $temp;
                                }
                            }
                        }
                    }
                }
                return $array;
            }
        }
    }

    private function _getIdsForGroup($group_id, $role, $relation) {
        if ($this->session_data->id == 1) {
            $user = new User();
            return $user->getUsersByIdsRole($group_id);
        } else if ($relation == 1) {
            if ($role == 'admin') {
                return User::getAdminIds();
            }

            if ($role == 'rector') {
                return Academy::getAssignRectorIds();
            }

            if ($role == 'dean') {
                return School::getAssignDeanIds();
            }

            if ($role == 'teacher') {
                return Clan::getAssignTeacherIds();
            }

            if ($role == 'pupil') {
                return Userdetail::getAssingStudentIds();
            }

            if ($role == 'clans') {
                return Userdetail::getAssignStudentIdsByCaln($group_id);
            }
        } else if ($relation == 2) {
            /* Start Related Users For Student */

            if ($this->session_data->role == 6 && $role == 'rector') {
                $academy = new Academy();
                return $academy->getRelatedRectorsByStudent($this->session_data->id);
            }

            if ($this->session_data->role == 6 && $role == 'dean') {
                $school = new School();
                return $school->getRelatedDeansByStudent($this->session_data->id);
            }

            if ($this->session_data->role == 6 && $role == 'teacher') {
                $class = new Clan();
                return $class->getRelatedTeachersByStudent($this->session_data->id);
            }

            if ($this->session_data->role == 6 && $role == 'pupil') {
                $user_detail = new Userdetail();
                return $user_detail->getRelatedStudentsByStudent($this->session_data->id);
            }

            if ($this->session_data->role == 6 && $role == 'clans') {
                return Userdetail::getAssignStudentIdsByCaln($group_id);
            }

            /* End Related Users For Student */

            /* Start Related Users For Teacher */
            if ($this->session_data->role == 5 && $role == 'rector') {
                $academy = new Academy();
                return $academy->getRelatedRectorsByTeacher($this->session_data->id);
            }

            if ($this->session_data->role == 5 && $role == 'dean') {
                $school = new School();
                return $school->getRelatedDeansByTeacher($this->session_data->id);
            }

            if ($this->session_data->role == 5 && $role == 'teacher') {
                $class = new Clan();
                return $class->getRelatedTeachersByTeacher($this->session_data->id);
            }

            if ($this->session_data->role == 5 && $role == 'pupil') {
                $user_detail = new Userdetail();
                return $user_detail->getRelatedStudentsByTeacher($this->session_data->id);
            }

            if ($this->session_data->role == 5 && $role == 'clans') {
                return Userdetail::getAssignStudentIdsByCaln($group_id);
            }

            /* End Related Users For Teacher */

            /* Start Related Users For Dean */
            if ($this->session_data->role == 4 && $role == 'rector') {
                $academy = new Academy();
                return $academy->getRelatedRectorsByDean($this->session_data->id);
            }

            if ($this->session_data->role == 4 && $role == 'dean') {
                $school = new School();
                return $school->getRelatedDeansByDean($this->session_data->id);
            }

            if ($this->session_data->role == 4 && $role == 'teacher') {
                $class = new Clan();
                return $class->getRelatedTeachersByDean($this->session_data->id);
            }

            if ($this->session_data->role == 4 && $role == 'pupil') {
                $user_detail = new Userdetail();
                return $user_detail->getRelatedStudentsByDean($this->session_data->id);
            }

            if ($this->session_data->role == 4 && $role == 'clans') {
                return Userdetail::getAssignStudentIdsByCaln($group_id);
            }

            /* End Related Users For Dean */

            /* Start Related Users For Dean */
            if ($this->session_data->role == 3 && $role == 'rector') {
                $academy = new Academy();
                return $academy->getRelatedRectorsByRector($this->session_data->id);
            }

            if ($this->session_data->role == 3 && $role == 'dean') {
                $school = new School();
                return $school->getRelatedDeansByRector($this->session_data->id);
            }

            if ($this->session_data->role == 3 && $role == 'teacher') {
                $class = new Clan();
                return $class->getRelatedTeachersByRector($this->session_data->id);
            }

            if ($this->session_data->role == 3 && $role == 'pupil') {
                $user_detail = new Userdetail();
                return $user_detail->getRelatedStudentsByRector($this->session_data->id);
            }

            if ($this->session_data->role == 3 && $role == 'clans') {
                return Userdetail::getAssignStudentIdsByCaln($group_id);
            }

            /* End Related Users For Dean */
        } else {
            return FALSE;
        }
    }

    public function readMessage($id) {
        $message = new Message();
        $result = $message->getMessageForReading($id);
        if ($result !== FALSE) {
            $message->where(array('id'=>$id, 'to_id' => $this->session_data->id, 'to_status'  => 'U', 'type' => 'single'))->update('to_status', 'R');

            $messagestatus = new Messagestatus();
            $messagestatus->where(array('message_id'=>$id, 'to_id' => $this->session_data->id, 'status' => 'U'))->update('status', 'R');

            $data = $this->_sidebarData();
            $data['id'] = $id;
            $data['view_title'] = 'Read Message';
            $data['messages_data'] = $result;
            $data['message_page_layout'] = $this->load->view('messages/read', $data, true);
            $this->layout->view('messages/sidebar', $data);
        } else {
            $this->session->set_flashdata('error', $this->lang->line('message_read_error'));
            redirect(base_url() . 'message', 'refresh');
        }
    }

    public function replyMessage($id) {
        $data = $this->_sidebarData();
        $message = new Message();
        $result_1 = $message->getMessageForReading($id);
        $result_2 = $message->getMessageForReplying($id);

        if ($result_1 !== FALSE && $result_2 !== FALSE) {
            if ($this->input->post() !== false) {
                $message = new Message();
                $message->type = $result_2->type;
                $message->initial_id = $result_2->initial_id;
                $message->reply_of = $result_2->id;
                $message->group_id = $result_2->group_id;
                $message->from_id = $this->session_data->id;
                if($result_2->type == 'single'){
                    $message->to_id = $result_2->from_id;
                    $to_status = 'U';
                } else if($result_2->type == 'group'){
                    $to_ids = explode(',', $result_2->to_id);
                    if (($key = array_search($this->session_data->id, $to_ids)) !== false) {
                        unset($to_ids[$key]);
                    }

                    if($this->session_data->id != $result_2->from_id){
                        $to_ids = $result_2->from_id .',' . implode(',', $to_ids);
                    }else {
                        $to_ids = implode(',', $to_ids);
                    }

                    $message->to_id = $to_ids;    
                    $to_status = 'R';
                }
                
                $message->subject = $result_2->subject;
                $message->message = $this->input->post('message');
                if ($this->input->post('action') == 'send') {
                    $from_status = 'S';
                } else if ($this->input->post('action') == 'draft') {
                    $from_status = 'D';
                    $to_status = 'D';
                }

                $message->from_status = $from_status;
                $message->to_status = $to_status;
                if (!is_null($message->to_id)) {
                    $message->save();
                    if (!empty($_FILES['attachments'])) {
                        $this->uploadAttachments($message->id);
                    }
                    if($result_2->type = 'group' && isset($to_ids)) {
                        foreach (explode(',', $to_ids) as $value) {
                            $status = new Messagestatus();
                            $status->message_id = $message->id;
                            $status->status = 'U';
                            $status->to_id = $value;
                            $status->save();
                        }
                    }
                }

                $this->session->set_flashdata('success', $this->lang->line('message_sent_success'));
                redirect(base_url() . 'message', 'refresh');
            } else {
                $data['view_title'] = 'Reply Message';
                $data['reply_id'] = $id;
                $data['messages_data'] = $result_1;
                $data['to_reply_data'] = $result_2;
                $data['message_page_layout'] = $this->load->view('messages/reply', $data, true);
                $this->layout->view('messages/sidebar', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('message_reply_error'));
            redirect(base_url() . 'message', 'refresh');
        }
    }

    public function deleteMessage() {
        if (count($this->input->post('message_id') > 0)) {
            foreach ($this->input->post('message_id') as $message_id) {
                $message_part = explode('_', $message_id);
                $message = new Message();
                if ($message_part[0] == 'inbox') {
                    if($message_part[2] == 'sinlge'){
                        $message->where(array('type' => 'single', 'to_id' => $this->session_data->id, 'id' => $message_part[1]))->update('to_status', 'T');
                    }else if($message_part[2] == 'group'){
                        $message->leaveGroupMessage($message_part[1], $this->session_data->id);
                    }
                } else if ($message_part[0] == 'sent') {
                    $message->where(array('type' => 'single', 'from_id' => $this->session_data->id, 'id' => $message_part[1]))->update('from_status', 'T');

                } else if ($message_part[0] == 'draft') {
                    $message->where(array('type' => 'single', 'from_id' => $this->session_data->id, 'id' => $message_part[1]))->update('from_status', 'T');
                } else if ($message_part[0] == 'trash') {
                    $message->where(array('type' => 'single', 'id' => $message_part[1]))->get();

                    if ($message->from_id == $this->session_data->id && $message->to_status == 'E') {
                        $message->where(array('type' => 'single', 'id' => $message_part[1]))->delete();
                    } else if ($message->to_id == $this->session_data->id && $message->from_status == 'E') {
                        $message->where(array('type' => 'single', 'id' => $message_part[1]))->delete();
                    } else if ($message->to_id == $this->session_data->id) {
                        $message->where(array('type' => 'single', 'id' => $message_part[1]))->update('to_status', 'E');
                    } else if ($message->from_id == $this->session_data->id) {
                        $message->where(array('type' => 'single', 'id' => $message_part[1]))->update('from_status', 'E');
                    }
                }
            }
        }

        echo TRUE;
    }

    public function sentMessage() {
        $data = $this->_sidebarData();
        $data['view_title'] = 'Sent Items';
        $data['message_box'] = 'sent';
        $data['message_page_layout'] = $this->load->view('messages/list', $data, true);
        $this->layout->view('messages/sidebar', $data);
    }

    public function trashMessage() {
        $data = $this->_sidebarData();
        $data['view_title'] = 'Trash';
        $data['message_box'] = 'trash';
        $data['message_page_layout'] = $this->load->view('messages/list', $data, true);
        $this->layout->view('messages/sidebar', $data);
    }

}
