<?php

if (!function_exists('validAcess')) {
    function validAcess($id, $type) {
        $ci = & get_instance();
        $session = $ci->session->userdata('user_session');
        
        if($type == 'academy'){
            if($session->role == 1 || $session->role == 2){
                return true;
            }

            if($session->role == 3){
                $academy = new Academy();
                $ids = array_column($academy->getAcademyOfRector($session->id), 'id');
                return in_array($id, $ids);
            }

            if($session->role == 4){
                $academy = new Academy();
                $ids = array_column($academy->getAcademyOfDean($session->id), 'id');
                return in_array($id, $ids);
            }

            if($session->role == 5){
                $academy = new Academy();
                $ids = array_column($academy->getAcademyOfTeacher($session->id), 'id');
                return in_array($id, $ids);
            }

            if($session->role == 6){
                $academy = new Academy();
                $ids = array_column($academy->getAcademyOfStudent($session->id), 'id');
                return in_array($id, $ids);
            }
        }

        if($type == 'school'){
            if($session->role == 1 || $session->role == 2){
                return true;
            }

            if($session->role == 3){
                $school = new School();
                $ids = array_column($school->getSchoolofRector($session->id), 'id');
                return in_array($id, $ids);
            }

            if($session->role == 4){
                $school = new School();
                $ids = array_column($school->getSchoolofDean($session->id), 'id');
                return in_array($id, $ids);
            }

            if($session->role == 5){
                $school = new School();
                $ids = array_column($school->getSchoolofTeacher($session->id), 'id');
                return in_array($id, $ids);
            }

            if($session->role == 6){
                $school = new School();
                $ids = array_column($school->getSchoolofStudent($session->id), 'id');
                return in_array($id, $ids);
            }
        }

        if($type == 'clan'){
            if($session->role == 1 || $session->role == 2){
                return true;
            }

            if($session->role == 3){
                $clan = new Clan();
                $ids = array_column($clan->getClanofRector($session->id), 'id');
                return in_array($id, $ids);
            }

            if($session->role == 4){
                $clan = new Clan();
                $ids = array_column($clan->getClanofDean($session->id), 'id');
                return in_array($id, $ids);
            }

            if($session->role == 5){
                $clan = new Clan();
                $ids = array_column($clan->getClanofTeacher($session->id), 'id');
                return in_array($id, $ids);
            }

            if($session->role == 6){
                $clan = new Clan();
                $ids = array_column($clan->getClanofStudent($session->id), 'id');
                return in_array($id, $ids);
            }
        }
    }
}

if (!function_exists('getPermmissionID')) {
    function getPermmissionID($action) {
        $var = explode('_', $action);
        $obj = new Permission();
        $obj->where('controller', $var[0]);
        $obj->where('method', $var[1]);
        $obj->get();
        if ($obj->result_count() == 1) {
            return $obj->id;
        } else {
            return 0;
        }
    }
}

if (!function_exists('hasPermission')) {
    function hasPermission($controller, $method) {
        $data = get_instance()->session->userdata('user_session');
        if ($data->id == 1) {
            return TRUE;
        } else {
            $permissions= get_instance()->config->item('user_premission');
            if (is_array($permissions) && array_key_exists($controller, $permissions) && in_array($method, $permissions[$controller])) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
}

if (!function_exists('printPermission')) {
    function printPermission($key, $array, $parent_key, $given_permission) {
        $str = '';
        $name = NULL;
        if (!is_null($parent_key)) {
            $name = 'name="perm[' . $parent_key . '][]"';
            if (is_array($given_permission) && array_key_exists($parent_key, $given_permission) && in_array($key, $given_permission[$parent_key])) {
                $str = ' checked="checked"';
            }
        } else {
            if (is_array($given_permission) && array_key_exists($key, $given_permission)) {
                $str = ' checked="checked"';
            }
        }


        foreach ($array as $k => $v) {
            if ($k != 'hasChild') {
                if (array_key_exists('type', $array)) {
                    $type = $array['type'];
                } else {
                    $type = 'checkbox';
                }



                if (array_key_exists('key', $array)) {
                    $name = 'name = "perm' . strip_quotes($array['key']) . '" ';

                    $v3 = 'given_permission' . $array['key'];
                    $check = eval('return isset($' . $v3 . ');');

                    if ($check) {
                        if ($type == 'checkbox') {
                            $str = ' checked="checked"';
                        } else {
                            if (eval('return $' . $v3 . ';') == $key) {
                                $str = ' checked="checked"';
                            }
                        }
                    }
                }

                if($type == 'checkbox'){
                    $class = 'class="icheckbox_square-grey"';
                } else {
                    $class = 'class="iradio_square-grey"';
                }


                return '<li><input type="' . $type . '" value="' . $key . '"' . $name . $str . $class . '/><span>' . $v . '</span>';
            } else {
                break;
            }
        }
    }
}

if (!function_exists('loopPermissionArray')) {
    function loopPermissionArray($array, $given_permission = null, $parent_key = null) {
        foreach ($array as $key => $value) {
            if (isset($value['hasChild'])) {
                echo printPermission($key, $value, $parent_key, $given_permission), '<ul>';
                $key = array_key_exists('key', $value['hasChild']) ? $value['hasChild']['key'] : $key;
                loopPermissionArray($value['hasChild'], $given_permission, $key);
                echo '</ul>';
            } else {
                echo printPermission($key, $value, $parent_key, $given_permission);
            }
        }
    }
}

if (!function_exists('createPermissionArray')) {
    function createPermissionArray() {
        $permission = array(
            'roles' => array(
                'name' => 'Role',
                'hasChild' => array(
                    'viewRole' => array('name' => 'List'),
                    'addRole' => array('name' => 'Add'),
                    'editRole' => array('name' => 'Edit'),
                    'deleteRole' => array('name' => 'Delete'),
                    )),
            'users' => array(
                'name' => 'User',
                'hasChild' => array(
                    'viewUser' => array('name' => 'List'),
                    'addUser' => array('name' => 'Add'),
                    'editUser' => array('name' => 'Edit'),
                    'deleteUser' => array('name' => 'Delete'),
                    )),
            'academies' => array(
                'name' => 'Academy',
                'hasChild' => array(
                    'viewAcademy' => array('name' => 'List'),
                    'addAcademy' => array('name' => 'Add'),
                    'editAcademy' => array('name' => 'Edit'),
                    'deleteAcademy' => array('name' => 'Delete'),
                    )),
            'schools' => array(
                'name' => 'School',
                'hasChild' => array(
                    'viewSchool' => array('name' => 'List'),
                    'addSchool' => array('name' => 'Add'),
                    'editSchool' => array('name' => 'Edit'),
                    'deleteSchool' => array('name' => 'Delete'),
                    )),
            'levels' => array(
                'name' => 'Level',
                'hasChild' => array(
                    'viewLevel' => array('name' => 'List'),
                    'addLevel' => array('name' => 'Add'),
                    'editLevel' => array('name' => 'Edit'),
                    'deleteLevel' => array('name' => 'Delete'),
                    )),
            'clans' => array(
                'name' => 'Classes',
                'hasChild' => array(
                    'viewClan' => array('name' => 'List'),
                    'addClan' => array('name' => 'Add'),
                    'editClan' => array('name' => 'Edit'),
                    'deleteClan' => array('name' => 'Delete'),
                    'clanTeacherList' => array('name' => 'Teacher List'),
                    'clanStudentList' => array('name' => 'Student List'),
                    'listTrialLessonRequest' => array('name' => 'List Trial Lesson Request'),
                    'changeStatusTrialStudent' => array('name' => 'Approve / Unapprove Request'),
                    'changeClanDate' => array('name' => 'Change Clan Dates'),
                    )),
            'eventcategories' => array(
                'name' => 'Event Categories',
                'hasChild' => array(
                    'viewEventcategory' => array('name' => 'List'),
                    'addEventcategory' => array('name' => 'Add'),
                    'editEventcategory' => array('name' => 'Edit'),
                    'deleteEventcategory' => array('name' => 'Delete'),
                    )),
            'events' => array(
                'name' => 'Events',
                'hasChild' => array(
                    'viewEvent' => array('name' => 'List'),
                    'addEvent' => array('name' => 'Add'),
                    'editEvent' => array('name' => 'Edit'),
                    'deleteEvent' => array('name' => 'Delete'),
                    'sendEventInvitation' => array('name' => 'Send Invitation'),
                    )),
            'batches' => array(
                'name' => 'Batches',
                'hasChild' => array(
                    'viewBatch' => array('name' => 'List'),
                    'addBatch' => array('name' => 'Add'),
                    'editBatch' => array('name' => 'Edit'),
                    'deleteBatch' => array('name' => 'Delete'),
                    )),
            'profiles' => array(
                'name' => 'Profile',
                'hasChild' => array(
                    'viewProfile' => array('name' => 'View'),
                    'editProfile' => array('name' => 'Edit'),
                    'changePassword' => array('name' => 'Change Password'),
                    'changeEmailPrivacy' => array('name' => 'Change Email Privacy'),
                    )),
            'emails' => array(
                'name' => 'Email Templates',
                'hasChild' => array(
                    'viewEmail' => array('name' => 'List'),
                    'editEmail' => array('name' => 'Edit'),
                    )),
            'countries' => array(
                'name' => 'Country',
                'hasChild' => array(
                    'viewCountry' => array('name' => 'List'),
                    'addCountry' => array('name' => 'Add'),
                    'editCountry' => array('name' => 'Edit'),
                    'deleteCountry' => array('name' => 'Delete'),
                    )),
            'states' => array(
                'name' => 'State',
                'hasChild' => array(
                    'viewState' => array('name' => 'List'),
                    'addState' => array('name' => 'Add'),
                    'editState' => array('name' => 'Edit'),
                    'deleteState' => array('name' => 'Delete'),
                    )),
            'cities' => array(
                'name' => 'City',
                'hasChild' => array(
                    'viewCity' => array('name' => 'List'),
                    'addCity' => array('name' => 'Add'),
                    'editCity' => array('name' => 'Edit'),
                    'deleteCity' => array('name' => 'Delete'),
                    )),
            'systemsettings' => array(
                'name' => 'System Setting',
                'hasChild' => array(
                    'viewSystemSetting' => array('name' => 'Edit')
                    )),
            'messages' => array(
                'name' => 'Message',
                'hasChild' => array(
                    'single' => array(
                        'name' => 'Single',
                        'key' => "['messages']['single_message']",
                        'hasChild' => getRolesForMessage('single_message')
                        ),
                    'group' => array(
                        'name' => 'Group',
                        'key' => "['messages']['group_message']",
                        'hasChild' => getRolesForMessage('group_message')
                        )
                    )
                )
            );
        return $permission;
    }
}

if (!function_exists('getRolesForMessage')) {
    function getRolesForMessage($type) {
        $data = get_instance()->session->userdata('user_session');
        $roles = new Role();
        $roles->where('id >', 1)->get();
        foreach ($roles as $value) {
            $temp[$value->id] = array(
                'name' => $value->{$data->language . '_role_name'},
                'key' => "['messages']['$type']['$value->id']",
                'hasChild' => array(
                    '0' => array('name' => 'None', 'type' => 'radio', 'key' => "['messages']['$type']['$value->id']"),
                    '1' => array('name' => 'All', 'type' => 'radio', 'key' => "['messages']['$type']['$value->id']"),
                    '2' => array('name' => 'Releated', 'type' => 'radio', 'key' => "['messages']['$type']['$value->id']")
                    )
                );
        }

        if ($type == 'group_message') {
            $temp['clans'] = array(
                'name' => 'Clans',
                'key' => "['messages']['$type']['clans']",
                'hasChild' => array(
                    '0' => array('name' => 'None', 'type' => 'radio', 'key' => "['messages']['$type']['clans']"),
                    '1' => array('name' => 'All', 'type' => 'radio', 'key' => "['messages']['$type']['clans']"),
                    '2' => array('name' => 'Releated', 'type' => 'radio', 'key' => "['messages']['$type']['clans']")
                    )
                );
        }

        return $temp;
    }
}

if (!function_exists('emailPrivacyArray')) {
    function emailPrivacyArray($id){
        if(is_null($id) || empty($id) || $id < 2 || $id > 6){
            return false;
        }

        $email_privacy = array();
        
        $email_privacy['user_registration_notification'] = array(
            'en'=>'User Registration Notification',
            'it'=>'Notifica Registrazione Utente',
        );
        $email_privacy['event_invitation'] = array(
            'en'=>'Event Invitation',
            'it'=>'Event Invitation',
        );
        $email_privacy['trial_lesson_request'] = array(
            'en'=>'Trial Lesson Request',
            'it'=>'Trial Lesson Request',
        );
        $email_privacy['trial_lesson_accepted'] = array(
            'en'=>'Trial Lesson Accepted',
            'it'=>'Trial Lesson Accepted',
        );
        $email_privacy['trial_lesson_rejected'] = array(
            'en'=>'Trial Lesson Rejected',
            'it'=>'Trial Lesson Rejected',
        );
        $email_privacy['change_clan_date'] = array(
            'en'=>'Change Clan Date',
            'it'=>'Change Clan Date',
        );
        $email_privacy['teacher_absent'] = array(
            'en'=>'Teacher Absent',
            'it'=>'Teacher Absent',
        );
        $email_privacy['student_absent'] = array(
            'en'=>'Student Absent',
            'it'=>'Student Absent',
        );
        $email_privacy['recovery_student'] =  array(
            'en'=>'Recovery Student',
            'it'=>'Recovery Student',
        );
        $email_privacy['teacher_recovery_student_for_student'] =  array(
            'en'=>'Teacher Recovery Student For Student',
            'it'=>'Teacher Recovery Student For Student',
        );
        $email_privacy['teacher_recovery_student_for_teacher'] =  array(
            'en'=>'Teacher Recovery Student For Teacher',
            'it'=>'Teacher Recovery Student For Teacher',
        );
        $email_privacy['recovery_teacher'] = array(
            'en'=>'Recovery Teacher',
            'it'=>'Recovery Teacher',
        );
        $email_privacy['holiday_approved'] =  array(
            'en'=>'Holiday Approved',
            'it'=>'Holiday Approved',
        );
        $email_privacy['holiday_upapproved'] =  array(
            'en'=>'Holiday Unapproved',
            'it'=>'Holiday Unapproved',
        );
        $email_privacy['challenge_made'] = array(
            'en'=>'Challenge Made',
            'it'=>'Challenge Made',
        );
        $email_privacy['challenge_accepted'] = array(
            'en'=>'Challenge Accepted',
            'it'=>'Challenge Accepted',
        );
        $email_privacy['challenge_rejected'] = array(
            'en'=>'Challenge Rejected',
            'it'=>'Challenge Rejected',
        );
        $email_privacy['challenge_winner'] = array(
            'en'=>'Challenge Winner',
            'it'=>'Challenge Winner',
        );

        //ADMIN
        $email_role[2] = array(
            'user_registration_notification',
            'event_invitation'
        );

        //RECTOR
        $email_role[3] = array(
            'user_registration_notification',
            'trial_lesson_request',
            'trial_lesson_accepted',
            'trial_lesson_rejected',
            'event_invitation',
            'change_clan_date'
        );

        //DEAN
        $email_role[4] = array(
            'user_registration_notification',
            'trial_lesson_request',
            'trial_lesson_accepted',
            'trial_lesson_rejected',
            'event_invitation',
            'change_clan_date',
            'teacher_absent'
        );

        //TEACHER
        $email_role[5] = array(
            'user_registration_notification',
            'trial_lesson_request',
            'trial_lesson_accepted',
            'trial_lesson_rejected',
            'event_invitation',
            'student_absent',
            'change_clan_date',
            'recovery_student',
            'teacher_recovery_student_for_student',
            'teacher_recovery_student_for_teacher',
            'recovery_teacher',
            'holiday_approved',
            'holiday_upapproved'
        );

        //PUPIL
        $email_role[6] = array(
            'event_invitation',
            'change_clan_date',
            'challenge_made',
            'challenge_accepted',
            'challenge_rejected',
            'challenge_winner'
        );

        $return = array();
        $session = get_instance()->session->userdata('user_session'); 
        foreach ($email_role[$id] as $value) {
            $return[$value] = $email_privacy[$value][$session->language];
        }

        return $return;
    }
}

?>
