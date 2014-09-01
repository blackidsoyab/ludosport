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

    //get the side bar details i.e. count of inbox, sent, trash
    private function _sidebarData() {
        $message = new Message();

        //total unread message
        $data['count_inbox'] = $message->countInboxUnRead($this->session_data->id);
        unset($message);
        
        $message = new Message();
        //total sent message
        $data['count_sent'] = $message->where('from_id', $this->session_data->id)->where('from_status', 'S')->get()->result_count();
        unset($message);

        $message = new Message();
        //total trash message
        $data['count_trash'] = $message->coutTrashCount($this->session_data->id);
        unset($message);
        return $data;
    }

    
    //Main method to view the message layout were indox is loaded
    public function viewMessage() {
        $data = $this->_sidebarData();
        $data['view_title'] = 'Message Inbox';
        $data['message_box'] = 'inbox';
        $data['message_page_layout'] = $this->load->view('messages/list', $data, true);
        $this->layout->view('messages/sidebar', $data);
    }

    /*
    *   this method compose the message 
    *   Param1(optional) : single(default) | group
    */
    public function composeMessage($type = 'single') {
        //check the type if not sinlge or group then redirect.
        if($type != 'single' && $type != 'group'){
            redirect(base_url() .'message' ,'refresh');
        }

        //check that send message or compose message
        if ($this->input->post() !== false) {

            //check message type
            if ($this->input->post('message_type') == 'single') {
                //if the message type is single the call private method => _saveSingleMessage()
                $this->_saveSingleMessage();
            } else if ($this->input->post('message_type') == 'group') {
                //if the message type is single the call private method => _saveGroupMessage()
                $this->_saveGroupMessage();
            }

            $this->session->set_flashdata('success', $this->lang->line('message_sent_success'));
            redirect(base_url() . 'message', 'refresh');
        } else {
            //build the sidebar
            $data = $this->_sidebarData();

            //set array for View
            $data['view_title'] = 'Compose Message';
            $data['type'] = $type;

            //get all the types allowed in permission
            $data['message_all_types'] = $this->_getMessageType();

            if ($type == 'single') {
                //get all the users allowed in permission
                $data['users'] = $this->_getUsersForMessage();
            } else if ($type == 'group') {
                //get all the Groups allowed in permission
                $data['groups'] = $this->_getGroupsForMessage();
            }

            //this is view of compose message and pass it to side bar view
            $data['message_page_layout'] = $this->load->view('messages/compose', $data, true);
            $this->layout->view('messages/sidebar', $data);
        }
    }

    //Send the Individual message
    private function _saveSingleMessage() {
        //loop through all the users selected
        foreach ($this->input->post('to_id') as $to) {
            $message = new Message();
            //set the data for saving in DB
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
            }

            $message->from_status = $from_status;
            $message->to_status = $to_status;
            $message->save();
            $message->where('id', $message->id)->update('initial_id', $message->id);

            //check of attachments if there thne upload it.
            if (!empty($_FILES['attachments'])) {
                $this->uploadAttachments($message->id);
            }
        }

        return TRUE;
    }

    //Send the Group message
    private function _saveGroupMessage() {
        // get the permission of the user logged in.
        $permissions= $this->config->item('user_premission');

        //loop through all the Groups selected
        foreach ($this->input->post('to_id') as $to) {
            $message = new Message();
            //set the appropriate vales for saving data in DB
            $message->type = $this->input->post('message_type');
            $message->reply_of = $this->input->post('reply_of');
            $message->from_id = $this->session_data->id;

            /*
            *   Heart of Group Message
            */
            if ($this->input->post('message_type') == 'group') {
                // $to will be like rector_3, dean_4, clan_1, clan_6, clan_23 etc
                $to_id = explode('_', $to);

                //get second part that is 3, 5 etc.
                //check wether key exits in permisson array. 
                if (isset($permissions['messages']['group_message'][$to_id[1]])) {
                    //if key exit the get value => will return : 0(none), 1(all), 2(related)
                    $what_to_fetch = $permissions['messages']['group_message'][$to_id[1]];
                } else if (isset($permissions['messages']['group_message']['clans'])) {
                    //if key does not exit then get clans value => will return : 0(none), 1(all), 2(related)
                    $what_to_fetch = $permissions['messages']['group_message']['clans'];
                }

                if($to_id[0] == 'clans'){
                    $message->group_id = $to . '_' . $what_to_fetch;    
                } else{
                    $message->group_id = strtolower(getRoleName($to_id[0])) .'_'. $to_id[1] . '_' . $what_to_fetch;    
                }
                
                
                /*
                *   get all the users id to send message
                *   Param1(required) : role_id (2,3,4,5,6) | clan_id
                *   Param2(required) : 2, 3, 4, 5, 6, clans
                *   Param3(required) : 0(none) | 1(all) | 2(related)
                *   return all the user ids
                */
                $user_ids = $this->_getIdsForGroup($to_id[1], $to_id[0], $what_to_fetch);

                //remove the current userid from the retun ids.
                if (($key = array_search($this->session_data->id, $user_ids)) !== false) {
                    unset($user_ids[$key]);
                }

                //from array make it String
                $message->to_id = implode(',', $user_ids);
            }
            /********************************************/

            $message->subject = $this->input->post('subject');
            $message->message = $this->input->post('message');
            if ($this->input->post('action') == 'send') {
                $from_status = 'S';
                $to_status = 'R';
            }

            $message->from_status = $from_status;
            $message->to_status = $to_status;
            if (!is_null($message->to_id)) {
                $message->save();
                //set the inital id for grouping the message in inbox
                $message->where('id', $message->id)->update('initial_id', $message->id);

                //check of attachments if there thne upload it.
                if (!empty($_FILES['attachments'])) {
                    $this->uploadAttachments($message->id);
                } 

                //set the status to unread as an individual for group messages.
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

    /*
    *   upload the attachemtns
    *   Param1(required) : message id
    */
    function uploadAttachments($id){
        //Configure upload.
        $this->upload->initialize(array(
            'upload_path'   => "./assets/message_attachments/",
            'allowed_types' => 'jpg|jpeg|gif|png|bmp',
            'overwrite' => FALSE,
            'remove_spaces' => TRUE,
            'encrypt_name' => TRUE
        ));

        $this->upload->do_multi_upload('attachments');
        $attachments =  $this->upload->get_multi_upload_data();

        foreach ($attachments as $key => $value) {
            $obj_attach = new Messageattachment();
            //set the data to save in DB
            $obj_attach->message_id = $id;
            $obj_attach->file_name = $value['file_name'];
            $obj_attach->original_name = $value['orig_name'];
            $obj_attach->file_type = $value['file_type'];
            $obj_attach->file_size = $value['file_size'];
            $obj_attach->user_id = $this->session_data->id;
            $obj_attach->save();
        } 
    }

    //get the message types form the permission
    private function _getMessageType() {
        //Role Super Admin default single , group
        if ($this->session_data->id == 1) {
            return array('single', 'group');
        } else {
            //get permission
            $permissions= $this->config->item('user_premission');
            if (!empty($permissions) && isset($permissions['messages'])) {
                $types = array_keys($permissions['messages']);
                //check message permisson exits
                if (!is_null($permissions)) {
                    $return = array();
                    //loop through all types 
                    foreach ($types as $type) {
                        //filter the array which remove the Zeros
                        $check = array_filter($permissions['messages'][$type]);
                        if(count($check) > 0){
                            $temp = explode('_', $type);
                            $return[] = $temp[0];
                        }
                    }
                    return $return;
                } else {
                    return array('single');
                }
            }
        }
    }

    //Get the users for the type : Single message
    private function _getUsersForMessage() {
        //Role SuperAdmin : get all user below super admin.
        if ($this->session_data->id == 1) {
            $users = new User();
            return $users->getUserBelowRole($this->session_data->role);
        } else {
            //get permission
            $permissions= $this->config->item('user_premission');

            //check permission exits
            if (!empty($permissions) && isset($permissions['messages']) && isset($permissions['messages']['single_message'])) {
                //filter the array which remove the Zeros
                $user_roles = array_filter($permissions['messages']['single_message']);
                $array = array();
                if(count($user_roles) > 0){
                    //loop through all the roles
                    foreach ($user_roles as $role_id => $permission) {
                        if ($permission == 1) {
                            $user = new User();
                            //get all users if permission is 1
                            $array[$role_id] = $user->getUsersByRole($role_id);
                        } else if ($permission == 2) {
                            //get related users if permission is 2
                            $array[$role_id] = $this->_getRelatedUsers($role_id);
                        } else {
                            continue;
                        }
                    }

                    //sort the array simply
                    asort(($array));
                    //again sort the array by first name
                    return subvalue_sort(array_map("unserialize", array_unique(array_map("serialize", MultiArrayToSinlgeArray($array)))), 'firstname');
                }else{
                    return fasle;
                }
            } else{
                return false;
            }
        }
    }

    /*
    *   Get the related users ofa role
    *   Param1(required) : role id
    *   return the user details (id, name)
    */
    private function _getRelatedUsers($role_id) {
        //Role Super Admin get all User of role id given
        if ($this->session_data->role == 1) {
            $user = new User();
            return $user->getUsersByRole($role_id);
        }

        //Role Admin get all User of role id given
        if ($role_id == 2) {
            $user = new User();
            return $user->getUsersByRole($role_id);
        }

        /* Start Related Users For Rector */

        //Logged in is Rector and passed $role_id 3(rector) => Get related Rectors of Rector
        if ($this->session_data->role == 3 && $role_id == 3) {
            $academy = new Academy();
            $rectors_id = $academy->getRelatedRectorsByRector($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($rectors_id);
        }

        //Logged in is Rector and passed $role_id 4(dean) => Get related Deans of Rector
        if ($this->session_data->role == 3 && $role_id == 4) {
            $school = new School();
            $dean_ids = $school->getRelatedDeansByRector($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($dean_ids);
        }

        //Logged in is Rector and passed $role_id 5(teacher) => Get related Teachers of Rector
        if ($this->session_data->role == 3 && $role_id == 5) {
            $class = new Clan();
            $teachers_id = $class->getRelatedTeachersByRector($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($teachers_id);
        }

        //Logged in is Rector and passed $role_id 6(student) => Get related Students of Rector
        if ($this->session_data->role == 3 && $role_id == 6) {
            $user_detail = new Userdetail();
            $students_id = $user_detail->getRelatedStudentsByRector($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($students_id);
        }

        /* End Related Users For Rector */

        /* Start Related Users For Dean */

        //Logged in is Dean and passed $role_id 3(rector) => Get related Rectors of Dean
        if ($this->session_data->role == 4 && $role_id == 3) {
            $academy = new Academy();
            $rectors_id = $academy->getRelatedRectorsByDean($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($rectors_id);
        }

        //Logged in is Dean and passed $role_id 4(dean) => Get related Deans of Dean
        if ($this->session_data->role == 4 && $role_id == 4) {
            $school = new School();
            $dean_ids = $school->getRelatedDeansByDean($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($dean_ids);
        }

        //Logged in is Dean and passed $role_id 5(teacher) => Get related Teachers of Dean
        if ($this->session_data->role == 4 && $role_id == 5) {
            $class = new Clan();
            $teachers_id = $class->getRelatedTeachersByDean($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($teachers_id);
        }

        //Logged in is Dean and passed $role_id 6(student) => Get related Students of Dean
        if ($this->session_data->role == 4 && $role_id == 6) {
            $user_detail = new Userdetail();
            $students_id = $user_detail->getRelatedStudentsByDean($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($students_id);
        }

        /* End Related Users For Dean */

        /* Start Related Users For Teacher */

        //Logged in is Teacher and passed $role_id 3(rector) => Get related Rectors of Teacher
        if ($this->session_data->role == 5 && $role_id == 3) {
            $academy = new Academy();
            $rectors_id = $academy->getRelatedRectorsByTeacher($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($rectors_id);
        }

        //Logged in is Teacher and passed $role_id 4(dean) => Get related Deans of Teacher
        if ($this->session_data->role == 5 && $role_id == 4) {
            $school = new School();
            $dean_ids = $school->getRelatedDeansByTeacher($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($dean_ids);
        }

        //Logged in is Teacher and passed $role_id 5(teacher) => Get related Teachers of Teacher
        if ($this->session_data->role == 5 && $role_id == 5) {
            $class = new Clan();
            $teachers_id = $class->getRelatedTeachersByTeacher($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($teachers_id);
        }

        //Logged in is Teacher and passed $role_id 6(student) => Get related Students of Teacher
        if ($this->session_data->role == 5 && $role_id == 6) {
            $user_detail = new Userdetail();
            $students_id = $user_detail->getRelatedStudentsByTeacher($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($students_id);
        }

        /* End Related Users For Teacher */

        /* Start Related Users For Student */

        //Logged in is Student and passed $role_id 3(rector) => Get related Rectors of Student
        if ($this->session_data->role == 6 && $role_id == 3) {
            $academy = new Academy();
            $rectors_id = $academy->getRelatedRectorsByStudent($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($rectors_id);
        }

        //Logged in is Student and passed $role_id 4(dean) => Get related Deans of Student
        if ($this->session_data->role == 6 && $role_id == 4) {
            $school = new School();
            $dean_ids = $school->getRelatedDeansByStudent($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($dean_ids);
        }

        //Logged in is Student and passed $role_id 5(teacher) => Get related Teachers of Student
        if ($this->session_data->role == 5 && $role_id == 6) {
            $class = new Clan();
            $teachers_id = $class->getRelatedTeachersByStudent($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($teachers_id);
        }

        //Logged in is Student and passed $role_id 6(student) => Get related Students of Student
        if ($this->session_data->role == 6 && $role_id == 6) {
            $user_detail = new Userdetail();
            $students_id = $user_detail->getRelatedStudentsByStudent($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($students_id);
        }

        /* End Related Users For Student */
    }

    //Make the groups for message according to permission
    private function _getGroupsForMessage() {
        //Role Super Admin : Make the Groups of Roles.
        if ($this->session_data->id == 1) {
            $roles = new Role();
            $array = array();
            $roles->where(array('id >' => '1'))->get();
            foreach ($roles as $value) {
                $temp = new stdClass();
                $temp->name = $value->{$this->session_data->language . '_role_name'};
                $temp->id = $value->id . '_' . $value->id;
                $array[] = $temp;
            }
            return $array;
        } else {
            //get permission
            $permissions= $this->config->item('user_premission');

            //check permission exits              
            if (!empty($permissions) && isset($permissions['messages']) && isset($permissions['messages']['group_message'])) {
                //filter the array which remove the Zeros
                $groups = array_filter($permissions['messages']['group_message']);

                //check count after filrt any data is left
                if(count($groups) > 0){
                    $roles = new Role();
                    $array = array();

                    /*
                    *   loop through all the groups in permission after filter
                    *   array will like [role_id] => permission
                    */

                    foreach ($groups as $role_id => $value) {
                        if ($role_id != 'clans') {
                            $roles->where(array('id' => $role_id))->get();
                            $temp = new stdClass();
                            $temp->name = $roles->{$this->session_data->language . '_role_name'};
                            $temp->id = $roles->id . '_' . $roles->id;
                            $array[] = $temp;
                        } else if ($role_id == 'clans') {
                            //if value is 1 then get all clans if value is 2 get related clans
                            if ($value == 1) {
                                $clan = new Clan();
                                //get all clans
                                foreach ($clan->get() as $value) {
                                    $temp = new stdClass();
                                    $temp->name = $value->{$this->session_data->language . '_class_name'};
                                    $temp->id = 'clans_' . $value->id;
                                    $array[] = $temp;
                                }
                            } else if ($value == 2){

                                //Role Student : Get related clans of Student
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

                                //Role Teacher : Get related clans of Teacher
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

                                //Role Dean : Get related clans of Dean
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

                                //Role Rector : Get related clans of Rector
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

                                //Role Admin : Get all clans
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
    }

    /*
    *   get the User id for sending message
    *   Param1(required) : group_id (can be role_id or clan_id)
    *   Param2(required) : role (can be role_id(2,3,4,5,6) or 'clans')
    *   Param3(required) : 0(None) | 1(All) | 2(Related)
    *   return array
    */
    private function _getIdsForGroup($group_id, $role, $relation) {
        //Role Super Admin | Admin : get all user ids 
        if ($this->session_data->id == 1 || $this->session_data->id == 2) {
            //fetch users
            if($role != 'clans'){
                $user = new User();
                //get all the user with role_id given
                return $user->getUsersByIdsRole($group_id);    
            } else {
                //get all the Students with clan_id given
                return Userdetail::getAssignStudentIdsByCaln($group_id);
            }
        } else if ($relation == 1) {
            //get All the Admin Ids
            if ($role == 2) {
                return User::getAdminIds();
            }

            //get All the Rectors who are assign to some Academy
            if ($role == 3) {
                return Academy::getAssignRectorIds();
            }

            //get All the Deans who are assign to some School
            if ($role == 4) {
                return School::getAssignDeanIds();
            }

            //get All the Teachers who are assign to some Clan
            if ($role == 5) {
                return Clan::getAssignTeacherIds();
            }

            //get All the Studetns who are assign to some Clans
            if ($role == 6) {
                return Userdetail::getAssingStudentIds();
            }

            //get All the Student who are assign to given clan_id
            if ($role == 'clans') {
                return Userdetail::getAssignStudentIdsByCaln($group_id);
            }
        } else if ($relation == 2) {
            //get All the Admin Ids
            if ($role == 'admin') {
                return User::getAdminIds();
            }

            //get All Studetns of the Passed $group_id(clan_id)
            if ($role == 'clans') {
                return Userdetail::getAssignStudentIdsByCaln($group_id);
            }

            /* Start Related Users For Student */

            //Logged in is Student and passed $role 3(rector) => Get related Rectors of Student
            if ($this->session_data->role == 6 && $role == 3) {
                $academy = new Academy();
                return $academy->getRelatedRectorsByStudent($this->session_data->id);
            }

            //Logged in is Student and passed $role 4(dean) => Get related Deans of Student
            if ($this->session_data->role == 6 && $role == 4) {
                $school = new School();
                return $school->getRelatedDeansByStudent($this->session_data->id);
            }

            //Logged in is Student and passed $role 5(teacher) => Get related Teachers of Student
            if ($this->session_data->role == 6 && $role == 5) {
                $class = new Clan();
                return $class->getRelatedTeachersByStudent($this->session_data->id);
            }

            //Logged in is Student and passed $role 6(students) => Get related Students of Student
            if ($this->session_data->role == 6 && $role == 6) {
                $user_detail = new Userdetail();
                return $user_detail->getRelatedStudentsByStudent($this->session_data->id);
            }

            /* End Related Users For Student */

            /* Start Related Users For Teacher */

            //Logged in is Teacher and passed $role 3(rector) => Get related Rectors of Teacher
            if ($this->session_data->role == 5 && $role == 3) {
                $academy = new Academy();
                return $academy->getRelatedRectorsByTeacher($this->session_data->id);
            }

            //Logged in is Teacher and passed $role 4(dean) => Get related Deans of Teacher
            if ($this->session_data->role == 5 && $role == 4) {
                $school = new School();
                return $school->getRelatedDeansByTeacher($this->session_data->id);
            }

            //Logged in is Teacher and passed $role 5(teacher) => Get related Teachers of Teacher
            if ($this->session_data->role == 5 && $role == 5) {
                $class = new Clan();
                return $class->getRelatedTeachersByTeacher($this->session_data->id);
            }

            //Logged in is Teacher and passed $role 6(students) => Get related Students of Teacher
            if ($this->session_data->role == 5 && $role == 6) {
                $user_detail = new Userdetail();
                return $user_detail->getRelatedStudentsByTeacher($this->session_data->id);
            }

            /* End Related Users For Teacher */

            /* Start Related Users For Dean */

            //Logged in is Dean and passed $role 3(rector) => Get related Rectors of Dean
            if ($this->session_data->role == 4 && $role == 3) {
                $academy = new Academy();
                return $academy->getRelatedRectorsByDean($this->session_data->id);
            }

            //Logged in is Dean and passed $role 4(dean) => Get related Deans of Dean
            if ($this->session_data->role == 4 && $role == 4) {
                $school = new School();
                return $school->getRelatedDeansByDean($this->session_data->id);
            }

            //Logged in is Dean and passed $role 5(teacher) => Get related Teachers of Dean
            if ($this->session_data->role == 4 && $role == 5) {
                $class = new Clan();
                return $class->getRelatedTeachersByDean($this->session_data->id);
            }

            //Logged in is Dean and passed $role 6(students) => Get related Students of Dean
            if ($this->session_data->role == 4 && $role == 6) {
                $user_detail = new Userdetail();
                return $user_detail->getRelatedStudentsByDean($this->session_data->id);
            }

            /* End Related Users For Dean */

            /* Start Related Users For Rector */

            //Logged in is Rector and passed $role 3(rector) => Get related Rectors of Rector
            if ($this->session_data->role == 3 && $role == 3) {
                $academy = new Academy();
                return $academy->getRelatedRectorsByRector($this->session_data->id);
            }

            //Logged in is Rector and passed $role 6(dean) => Get related Deans of Rector
            if ($this->session_data->role == 3 && $role == 4) {
                $school = new School();
                return $school->getRelatedDeansByRector($this->session_data->id);
            }

            //Logged in is Rector and passed $role 6(teacher) => Get related Teachers of Rector
            if ($this->session_data->role == 3 && $role == 5) {
                $class = new Clan();
                return $class->getRelatedTeachersByRector($this->session_data->id);
            }

            //Logged in is Rector and passed $role 6(student) => Get related Students of Rector
            if ($this->session_data->role == 3 && $role == 6) {
                $user_detail = new Userdetail();
                return $user_detail->getRelatedStudentsByRector($this->session_data->id);
            }

            /* End Related Users For Rector */
        } else {
            return FALSE;
        }
    }

    /*
    *   Dispaly the Message for reading
    *   Param1(required) : message id
    */
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

    /*
    *   Reply the Message
    *   Param1(required) : message id
    */
    public function replyMessage($id) {
        //Build the Side bar
        $data = $this->_sidebarData();
        $message = new Message();

        //get all the message details from the message is initated (return all the message).
        $result_1 = $message->getMessageForReading($id);

        //get the message details of the message click on reply button
        $result_2 = $message->getMessageForReplying($id);

        //check both data exits
        if ($result_1 !== FALSE && $result_2 !== FALSE) {
            //check to send message or dispaly the reply comospe message
            if ($this->input->post() !== false) {
                $message = new Message();
                //set the Appropriate data to save in DB
                $message->type = $result_2->type;
                $message->initial_id = $result_2->initial_id;
                $message->reply_of = $result_2->id;
                $message->group_id = $result_2->group_id;
                $message->from_id = $this->session_data->id;

                //if single message sawp from and to
                if($result_2->type == 'single'){
                    $message->to_id = $result_2->from_id;
                    $to_status = 'U';
                } else if($result_2->type == 'group'){
                    //get the to_ids for last message
                    $to_ids = explode(',', $result_2->to_id);

                    //unset current user
                    if (($key = array_search($this->session_data->id, $to_ids)) !== false) {
                        unset($to_ids[$key]);
                    }

                    //add the from_id to to_id
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
                }

                $message->from_status = $from_status;
                $message->to_status = $to_status;
                if (!is_null($message->to_id)) {
                    $message->save();

                    //check any attachementns, if there upload.
                    if (!empty($_FILES['attachments'])) {
                        $this->uploadAttachments($message->id);
                    }

                    //set the status to unread as an individual for group messages.
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
                //set the array to display in view part
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

    //Send Message to Trash or delete permentaly depend on condition or leave the group message
    public function deleteMessage() {
        //check the Post data
        if (count($this->input->post('message_id') > 0)) {

            //loop through all the ids given which will have 
            //Prefix : inbox, sent, trash || Sufix also  : single or group
            //middle : message id for eg : inbox_3_single , sent_4_group
            foreach ($this->input->post('message_id') as $message_id) {
                //make parts of the message_id passed into array([0]=>'inbox', [2]=>3, [2]=>'single')
                $message_part = explode('_', $message_id);

                $message = new Message();
                
                //Check message prefix
                if ($message_part[0] == 'inbox') {

                    //Check message sufix is single message set status to Trash or if group leave group
                    if($message_part[2] == 'single'){
                        $message->where(array('type' => 'single', 'to_id' => $this->session_data->id, 'id' => $message_part[1]))->update('to_status', 'T');
                    }else if($message_part[2] == 'group'){
                        $message->leaveGroupMessage($message_part[1], $this->session_data->id);
                    }
                } else if ($message_part[0] == 'sent') {
                    //Check message sufix is single message set status to Trash
                    if($message_part[2] == 'single'){
                        $message->where(array('type' => 'single', 'from_id' => $this->session_data->id, 'id' => $message_part[1]))->update('    from_status', 'T');
                    }
                } else if ($message_part[0] == 'trash') {
                    // now deleting permentally
                    $message->where(array('type' => 'single', 'id' => $message_part[1]))->get();

                    //if any one is deleted that is sender or reciver then delted permentaly or else set status to erased 
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

    //Dispaly the list of all the send message
    public function sentMessage() {
        $data = $this->_sidebarData();
        $data['view_title'] = 'Sent Items';
        $data['message_box'] = 'sent';
        $data['message_page_layout'] = $this->load->view('messages/list', $data, true);
        $this->layout->view('messages/sidebar', $data);
    }

    //Dispaly the list of all the trash message
    public function trashMessage() {
        $data = $this->_sidebarData();
        $data['view_title'] = 'Trash';
        $data['message_box'] = 'trash';
        $data['message_page_layout'] = $this->load->view('messages/list', $data, true);
        $this->layout->view('messages/sidebar', $data);
    }

}
