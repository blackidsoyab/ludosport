<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class announcements extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('announcement'));
        $this->session_data = $this->session->userdata('user_session');

        if ($this->session_data->status == 'P') {
            $this->session->set_flashdata('error', $this->lang->line('permisson_error'));
            redirect(base_url() . 'denied', 'refresh');
        }
    }
    
    //Main method to view the announcement layout were indox is loaded
    public function viewAnnouncement() {
        $data['view_title'] = $this->lang->line('announcement');
        $data['announcement_box'] = 'inbox';
        $data['announcement_page_layout'] = $this->load->view('announcements/list', $data, true);
        $this->layout->view('announcements/sidebar', $data);
    }

    /*
    *   Dispaly the Announcement for reading
    *   Param1(required) : announcement id
    */
    public function readAnnouncement($id, $type = null) {
        $announcement = new Announcement();
        $result = $announcement->getAnnouncementForReading($id);
        if ($result !== false) {
            if ($type == 'notification') {
                Notification::updateNotification('new_announcement', $this->session_data->id, $id);
            }

            $data['id'] = $id;
            $data['view_title'] = $this->lang->line('read').' '.$this->lang->line('announcement');
            $data['announcement_data'] = $result;
            $data['announcement_page_layout'] = $this->load->view('announcements/read', $data, true);
            $this->layout->view('announcements/sidebar', $data);
        } else {
            $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
            redirect(base_url() . 'announcement', 'refresh');
        }
    }

    //Send Announcement to Trash or delete permentaly depend on condition or leave the group announcement
    public function deleteAnnouncement() {
        if($this->session_data->role > 5){
            $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
            redirect(base_url() . 'dashboard', 'refresh'); 
        }
        //check the Post data
        if (count($this->input->post('announcement_id') > 0)) {
            //loop through all the ids given which will have 
            foreach ($this->input->post('announcement_id') as $announcement_id) {
                $announcement = new Announcement();
                $announcement->where('from_id', $this->session_data->id)->get()->delete();
            }
        }

        echo TRUE;
    }

    //Dispaly the list of all the send announcement
    public function sentAnnouncement() {
        if($this->session_data->role > 5){
            $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
            redirect(base_url() . 'dashboard', 'refresh'); 
        }
        //$data = $this->_sidebarData();
        $data['view_title'] = $this->lang->line('sent').' '.$this->lang->line('announcement');
        $data['announcement_box'] = 'sent';
        $data['announcement_page_layout'] = $this->load->view('announcements/list', $data, true);
        $this->layout->view('announcements/sidebar', $data);
    }

    /*
    *   this method compose the announcement 
    *   Param1(optional) : single(default) | group
    */
    public function composeAnnouncement($type = 'single') {
        if($this->session_data->role > 5){
            $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
            redirect(base_url() . 'dashboard', 'refresh'); 
        }

        //check the type if not sinlge or group then redirect.
        if($type != 'single' && $type != 'group'){
            redirect(base_url() .'announcement' ,'refresh');
        }

        //check that send announcement or compose announcement
        if ($this->input->post() !== false) {

            //check announcement type
            if ($this->input->post('announcement_type') == 'single') {
                //if the announcement type is single the call private method => _saveSingleAnnouncement()
                $object_id = $this->_saveSingleAnnouncement();
            } else if ($this->input->post('announcement_type') == 'group') {
                //if the announcement type is single the call private method => _saveGroupAnnouncement()
                $object_id = $this->_saveGroupAnnouncement();
            }

            $this->_sendNotificationAndEmail('new_announcement', $object_id);

            $this->session->set_flashdata('success', $this->lang->line('announcement_sent_success'));
            redirect(base_url() . 'announcement', 'refresh');
        } else {
            //set array for View
            $data['view_title'] = $this->lang->line('new').' '.$this->lang->line('announcement');
            $data['type'] = $type;

            //get all the types allowed in permission
            $data['announcement_all_types'] = $this->_getAnnouncementType();

            if ($type == 'single') {
                //get all the users allowed in permission
                $data['users'] = $this->_getUsersForAnnouncement();
            } else if ($type == 'group') {
                //get all the Groups allowed in permission
                $data['groups'] = $this->_getGroupsForAnnouncement();
            }

            //this is view of compose announcement and pass it to side bar view
            $data['announcement_page_layout'] = $this->load->view('announcements/compose', $data, true);
            $this->layout->view('announcements/sidebar', $data);
        }
    }

    //Send the Individual announcement
    private function _saveSingleAnnouncement() {
        //loop through all the users selected
        foreach ($this->input->post('to_id') as $to) {
            $announcement = new Announcement();
            //set the data for saving in DB
            $announcement->type = $this->input->post('announcement_type');
            $announcement->group_id = 0;
            $announcement->from_id = $this->session_data->id;
            $announcement->to_id = $to;
            $announcement->subject = $this->input->post('subject');
            $announcement->announcement = $this->input->post('announcement');
            $announcement->save();
        }

        return $announcement->id;
    }

    //Send the Group announcement
    private function _saveGroupAnnouncement() {
        // get the permission of the user logged in.
        $permissions= $this->config->item('user_premission');

        //loop through all the Groups selected
        foreach ($this->input->post('to_id') as $to) {
            $announcement = new Announcement();

            /*
            *   Heart of Group Announcement
            */
            if ($this->input->post('announcement_type') == 'group') {
                // $to will be like rector_3, dean_4, clan_1, clan_6, clan_23 etc
                $to_id = explode('_', $to);

                //get second part that is 3, 5 etc.
                //check wether key exits in permisson array. 
                if($this->session_data->role == 1){
                    $what_to_fetch = 1;
                }else{
                    if (isset($permissions['announcements']['group_announcement'][$to_id[1]])) {
                        //if key exit the get value => will return : 0(none), 1(all), 2(related)
                        $what_to_fetch = $permissions['announcements']['group_announcement'][$to_id[1]];
                    } else if (isset($permissions['announcements']['group_announcement']['clans'])) {
                        //if key does not exit then get clans value => will return : 0(none), 1(all), 2(related)
                        $what_to_fetch = $permissions['announcements']['group_announcement']['clans'];
                    }
                }

                if($to_id[0] == 'clans'){
                    $announcement->group_id = $to . '_' . $what_to_fetch;    
                } else{
                    $announcement->group_id = strtolower(getRoleName($to_id[0])) .'_'. $to_id[1] . '_' . $what_to_fetch;    
                }
                
                /*
                *   get all the users id to send announcement
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
            }
            /********************************************/
            //set the appropriate vales for saving data in DB
            $announcement->type = $this->input->post('announcement_type');
            $announcement->from_id = $this->session_data->id;
            $announcement->to_id = implode(',', $user_ids);
            $announcement->subject = $this->input->post('subject');
            $announcement->announcement = $this->input->post('announcement');
            if (!is_null($announcement->to_id)) {
                $announcement->save(); 
            }
        }

        return $announcement->id;
    }

    /*
    *   Send the Notification and Email to related Users
    *   Param1(required) : type of notification and Email
    *   Param2(required) : Announcement id
    */
    private function _sendNotificationAndEmail($type, $object_id){
        $announcement = new Announcement();
        $result = $announcement->getAnnouncementForReading($object_id);

        if($result->type == 'single'){
            $users_ids = array($result->to_id);
        }else if($result->type == 'group'){
            $users_ids = explode(',', $result->to_id);
        } else{
            return true;
        }

        foreach ($users_ids as $id) {
            $notification = new Notification();
            $notification->type = 'N';
            $notification->notify_type = $type;
            $notification->from_id = $this->session_data->id;
            $notification->to_id = $id;
            $notification->object_id = $object_id;
            $notification->data = serialize(objectToArray($result));
            $notification->save();

             //get email details
            $email = new Email();
            $email->where('type', $type)->get();
            $message = $email->message;

            $user_details = userNameEmail($id);
            $message = str_replace('#user_name', $user_details['name'] , $message);
            $message = str_replace('#announcer_name', $result->from_person, $message);
            $message = str_replace('#subject', $result->announcement , $message);
            $message = str_replace('#announcement', $result->announcement, $message);

            $check_privacy = unserialize($user_details['email_privacy']);
            if(is_null($check_privacy) || $check_privacy == false || !isset($check_privacy[$type]) ||  $check_privacy[$type] == 1){
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

    //get the announcement types form the permission
    private function _getAnnouncementType() {
        //Role Super Admin default single , group
        if ($this->session_data->id == 1) {
            return array('single', 'group');
        } else {
            //get permission
            $permissions= $this->config->item('user_premission');
            if (!empty($permissions) && isset($permissions['announcements'])) {
                $types = array_keys($permissions['announcements']);
                //check announcement permisson exits
                if (!is_null($permissions)) {
                    $return = array();
                    //loop through all types 
                    foreach ($types as $type) {
                        //filter the array which remove the Zeros
                        $check = array_filter($permissions['announcements'][$type]);
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

    //Get the users for the type : Single announcement
    private function _getUsersForAnnouncement() {
        //Role SuperAdmin : get all user below super admin.
        if ($this->session_data->id == 1) {
            $users = new User();
            return $users->getUserBelowRole($this->session_data->role);
        } else {
            //get permission
            $permissions= $this->config->item('user_premission');

            //check permission exits
            if (!empty($permissions) && isset($permissions['announcements']) && isset($permissions['announcements']['single_announcement'])) {
                //filter the array which remove the Zeros
                $user_roles = array_filter($permissions['announcements']['single_announcement']);
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
                    return false;
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

    //Make the groups for announcement according to permission
    private function _getGroupsForAnnouncement() {
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

            $clan = new Clan();
            foreach ($clan->get() as $value) {
                $temp = new stdClass();
                $temp->id = 'clans_' . $value->id;
                $temp->name = $value->{$this->session_data->language . '_class_name'};
                $array[] = $temp;
            }
            return $array;
        } else {
            //get permission
            $permissions= $this->config->item('user_premission');

            //check permission exits              
            if (!empty($permissions) && isset($permissions['announcements']) && isset($permissions['announcements']['group_announcement'])) {
                //filter the array which remove the Zeros
                $groups = array_filter($permissions['announcements']['group_announcement']);

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
                                $clans = $clan->get();
                            } else if ($value == 2){
                                //Role Student : Get related clans of Student
                                if ($this->session_data->role == 6) {
                                    $user_details = new Userdetail();
                                    $user_details->where('student_master_id', $this->session_data->id)->get();
                                    $clan = new Clan();
                                    $clan->where('id', $user_details->clan_id)->get();
                                }

                                //Role Teacher : Get related clans of Teacher
                                if ($this->session_data->role == 5) {
                                    $clan = new Clan();
                                    $clans = $clan->getClanOfTeacher($this->session_data->id);
                                }

                                //Role Dean : Get related clans of Dean
                                if ($this->session_data->role == 4) {
                                    $clan = new Clan();
                                    $clans = $clan->getClanOfDean($this->session_data->id);
                                }

                                //Role Rector : Get related clans of Rector
                                if ($this->session_data->role == 3) {
                                    $clan = new Clan();
                                    $clans = $clan->getClanOfRector($this->session_data->id);
                                }

                                //Role Admin : Get all clans
                                if ($this->session_data->role == 2) {
                                    $clan = new Clan();
                                    $clans = $clan->get();
                                }
                            }

                            if($clans){
                                foreach ($clans as $value) {
                                    $temp = new stdClass();
                                    $temp->id = 'clans_' . $value->id;
                                    $temp->name = $value->{$this->session_data->language . '_class_name'};
                                    $array[] = $temp;
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
    *   get the User id for sending announcement
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
}