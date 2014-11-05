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

        if($type == 'student'){
            if($session->role == 1 || $session->role == 2){
                return true;
            }

            if($session->role == 3){
                $obj = new Userdetail();
                $ids = $obj->getRelatedStudentsByRector($session->id);
                return in_array($id, $ids);
            }

            if($session->role == 4){
                $obj = new Userdetail();
                $ids = $obj->getRelatedStudentsByDean($session->id);
                return in_array($id, $ids);
            }

            if($session->role == 5){
                $obj = new Userdetail();
                $ids = $obj->getRelatedStudentsByTeacher($session->id);
                return in_array($id, $ids);
            }

            if($session->role == 6){
                $obj = new Userdetail();
                $ids = $obj->getRelatedStudentsByStudent($session->id);
                return in_array($id, $ids);
            }
        }

        if($type == 'evolutionclan'){
            if($session->role == 1 || $session->role == 2){
                return true;
            }

            if($session->role == 3){
                $clan = new Evolutionclan();
                $ids = array_column($clan->getClanofRector($session->id), 'id');
                return in_array($id, $ids);
            }

            if($session->role == 4){
                $clan = new Evolutionclan();
                $ids = array_column($clan->getClanofDean($session->id), 'id');
                return in_array($id, $ids);
            }

            if($session->role == 5){
                $clan = new Evolutionclan();
                $ids = array_column($clan->getClanofTeacher($session->id), 'id');
                return in_array($id, $ids);
            }

            if($session->role == 6){
                $clan = new Evolutionclan();
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
        if ($data->role == 1) {
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
        $CI =& get_instance();
        $permission = array(
            'roles' => array(
                'name' => $CI->lang->line('role'),
                'hasChild' => array(
                    'viewRole' => array('name' => $CI->lang->line('list')),
                    'addRole' => array('name' => $CI->lang->line('add')),
                    'editRole' => array('name' => $CI->lang->line('edit')),
                    'deleteRole' => array('name' => $CI->lang->line('delete')),
                    )),
            'users' => array(
                'name' => $CI->lang->line('user'),
                'hasChild' => array(
                    'viewUser' => array('name' => $CI->lang->line('list')),
                    'addUser' => array('name' => $CI->lang->line('add')),
                    'editUser' => array('name' => $CI->lang->line('edit')),
                    'deleteUser' => array('name' => $CI->lang->line('delete')),
                    'listStudentBatches' => array('name' => 'List Student Badge History'),
                    'addStudentBatches' => array('name' => 'Add Student Badge History'),
                    'editStudentBatches' => array('name' => 'Edit Student Badge History'),
                    'deleteStudentBatches' => array('name' => 'Delete Student Badge History'),
                    'listStudentScore' => array('name' => 'List Student Score History'),
                    'deleteStudentScore' => array('name' => 'Score Student Score History'),
                    'listStudentDocuments' => array('name' => 'List Student Document History'),
                    'deleteStudentDocuments' => array('name' => 'Delte Student Document History'),
                    )),
            'studentratings' => array(
                'name' => $CI->lang->line('rating') . '(Merit/Demerit)',
                'hasChild' => array(
                    'viewStudentrating' => array('name' => $CI->lang->line('list')),
                    'editStudentrating' => array('name' => $CI->lang->line('edit')),
                    )),
            'batches' => array(
                'name' => $CI->lang->line('batch'),
                'hasChild' => array(
                    'viewBatch' => array('name' => $CI->lang->line('list')),
                    'addBatch' => array('name' => $CI->lang->line('add')),
                    'editBatch' => array('name' => $CI->lang->line('edit')),
                    'deleteBatch' => array('name' => $CI->lang->line('delete')),
                    )),
            'batchrequests' => array(
                'name' => $CI->lang->line('batch_request'),
                'hasChild' => array(
                    'viewBatchrequest' => array('name' => $CI->lang->line('list')),
                    'changeStatusBatchrequest' => array('name' => 'Approve / Unapprove Request'),
                    'addBatchrequest' => array('name' => $CI->lang->line('add')),
                    'editBatchrequest' => array('name' => $CI->lang->line('edit')),
                    'deleteBatchrequest' => array('name' => $CI->lang->line('delete')),
                    )),
            'academies' => array(
                'name' => $CI->lang->line('academy'),
                'hasChild' => array(
                    'viewAcademy' => array('name' => $CI->lang->line('list')),
                    'addAcademy' => array('name' => $CI->lang->line('add')),
                    'editAcademy' => array('name' => $CI->lang->line('edit')),
                    'deleteAcademy' => array('name' => $CI->lang->line('delete')),
                    )),
            'schools' => array(
                'name' => $CI->lang->line('school'),
                'hasChild' => array(
                    'viewSchool' => array('name' => $CI->lang->line('list')),
                    'addSchool' => array('name' => $CI->lang->line('add')),
                    'editSchool' => array('name' => $CI->lang->line('edit')),
                    'deleteSchool' => array('name' => $CI->lang->line('delete')),
                    )),
            'levels' => array(
                'name' => $CI->lang->line('level'),
                'hasChild' => array(
                    'viewLevel' => array('name' => $CI->lang->line('list')),
                    'addLevel' => array('name' => $CI->lang->line('add')),
                    'editLevel' => array('name' => $CI->lang->line('edit')),
                    'deleteLevel' => array('name' => $CI->lang->line('delete')),
                    )),
            'clans' => array(
                'name' => $CI->lang->line('clan'),
                'hasChild' => array(
                    'viewClan' => array('name' => $CI->lang->line('list')),
                    'addClan' => array('name' => $CI->lang->line('add')),
                    'editClan' => array('name' => $CI->lang->line('edit')),
                    'deleteClan' => array('name' => $CI->lang->line('delete')),
                    'clanTeacherList' => array('name' => 'Teacher List'),
                    'clanStudentList' => array('name' => 'Student List'),
                    'clanViewAttendance' => array('name' => 'Student Attendance (Register)'),
                    'listTrialLessonRequest' => array('name' => 'List Trial Lesson Request'),
                    'changeStatusTrialStudent' => array('name' => 'Approve / Unapprove Request'),
                    'changeClanDate' => array('name' => 'Change Clan Dates'),
                    )),
            'eventcategories' => array(
                'name' => $CI->lang->line('eventcategory'),
                'hasChild' => array(
                    'viewEventcategory' => array('name' => $CI->lang->line('list')),
                    'addEventcategory' => array('name' => $CI->lang->line('add')),
                    'editEventcategory' => array('name' => $CI->lang->line('edit')),
                    'deleteEventcategory' => array('name' => $CI->lang->line('delete')),
                    )),
            'events' => array(
                'name' => $CI->lang->line('event'),
                'hasChild' => array(
                    'viewEvent' => array('name' => $CI->lang->line('list')),
                    'addEvent' => array('name' => $CI->lang->line('add')),
                    'editEvent' => array('name' => $CI->lang->line('edit')),
                    'deleteEvent' => array('name' => $CI->lang->line('delete')),
                    'sendEventInvitation' => array('name' => 'Send Invitation'),
                    'viewEventInvitation' => array('name' => 'List Invited Member'),
                    'viewEventInvited' => array('name' => 'List events invited in'),
                    'takeEventAttendance' => array('name' => 'Take Event Attendances'),
                    'assignTournamentBatches' => array('name' => 'Tournament badge assignment'),
                    )),
            'evolutioncategories' => array(
                'name' => $CI->lang->line('evolutioncategory'),
                'hasChild' => array(
                    'viewEvolutioncategory' => array('name' => $CI->lang->line('list')),
                    'editEvolutioncategory' => array('name' => $CI->lang->line('edit')),
                    )),
            'evolutionclans' => array(
                'name' => $CI->lang->line('evolutionclan'),
                'hasChild' => array(
                    'viewEvolutionclan' => array('name' => $CI->lang->line('list')),
                    'addEvolutionclan' => array('name' => $CI->lang->line('add')),
                    'editEvolutionclan' => array('name' => $CI->lang->line('edit')),
                    'deleteEvolutionclan' => array('name' => $CI->lang->line('delete')),
                    'listEvolutionClanRequest' => array('name' => 'List Clan Request'),
                    'evolutionclanStudentList' => array('name' => 'Student List'),
                    'changeRequestStatus' => array('name' => 'Approve / Unapprove Clan Request'),
                    'resultEvolutionclan' => array('name' => 'Declare student result'),
                    )),
            'profiles' => array(
                'name' => $CI->lang->line('profile'),
                'hasChild' => array(
                    'viewProfile' => array('name' => 'View'),
                    'editProfile' => array('name' => $CI->lang->line('edit')),
                    'changePassword' => array('name' => 'Change Password'),
                    'changeEmailPrivacy' => array('name' => 'Change Email Privacy'),
                    )),
            'emails' => array(
                'name' => $CI->lang->line('email_template'),
                'hasChild' => array(
                    'viewEmail' => array('name' => $CI->lang->line('list')),
                    'editEmail' => array('name' => $CI->lang->line('edit')),
                    )),
            'countries' => array(
                'name' => $CI->lang->line('country'),
                'hasChild' => array(
                    'viewCountry' => array('name' => $CI->lang->line('list')),
                    'addCountry' => array('name' => $CI->lang->line('add')),
                    'editCountry' => array('name' => $CI->lang->line('edit')),
                    'deleteCountry' => array('name' => $CI->lang->line('delete')),
                    )),
            'states' => array(
                'name' => $CI->lang->line('state'),
                'hasChild' => array(
                    'viewState' => array('name' => $CI->lang->line('list')),
                    'addState' => array('name' => $CI->lang->line('add')),
                    'editState' => array('name' => $CI->lang->line('edit')),
                    'deleteState' => array('name' => $CI->lang->line('delete')),
                    )),
            'cities' => array(
                'name' => $CI->lang->line('city'),
                'hasChild' => array(
                    'viewCity' => array('name' => $CI->lang->line('list')),
                    'addCity' => array('name' => $CI->lang->line('add')),
                    'editCity' => array('name' => $CI->lang->line('edit')),
                    'deleteCity' => array('name' => $CI->lang->line('delete')),
                    )),
            'systemsettings' => array(
                'name' => $CI->lang->line('system_setting'),
                'hasChild' => array(
                    'viewSystemSetting' => array('name' => $CI->lang->line('edit'))
                    )),
            'messages' => array(
                'name' => $CI->lang->line('message'),
                'hasChild' => array(
                    'single' => array(
                        'name' => 'Single',
                        'key' => "['messages']['single_message']",
                        'hasChild' => getRolesForMessage('messages','single_message')
                        ),
                    'group' => array(
                        'name' => 'Group',
                        'key' => "['messages']['group_message']",
                        'hasChild' => getRolesForMessage('messages','group_message')
                        )
                    )
                ),
            'announcements' => array(
                'name' => $CI->lang->line('announcement'),
                'hasChild' => array(
                    'single' => array(
                        'name' => 'Single',
                        'key' => "['announcements']['single_announcement']",
                        'hasChild' => getRolesForMessage('announcements','single_announcement')
                        ),
                    'group' => array(
                        'name' => 'Group',
                        'key' => "['announcements']['group_announcement']",
                        'hasChild' => getRolesForMessage('announcements','group_announcement')
                        )
                    )
                )
        );
        return $permission;
    }
}

if (!function_exists('getRolesForMessage')) {
    function getRolesForMessage($type_1, $type_2) {
        $data = get_instance()->session->userdata('user_session');
        $roles = new Role();
        $roles->where('id >', 1)->get();
        foreach ($roles as $value) {
            $temp[$value->id] = array(
                'name' => $value->{$data->language . '_role_name'},
                'key' => "['$type_1']['$type_2']['$value->id']",
                'hasChild' => array(
                    '0' => array('name' => 'None', 'type' => 'radio', 'key' => "['$type_1']['$type_2']['$value->id']"),
                    '1' => array('name' => 'All', 'type' => 'radio', 'key' => "['$type_1']['$type_2']['$value->id']"),
                    '2' => array('name' => 'Releated', 'type' => 'radio', 'key' => "['$type_1']['$type_2']['$value->id']")
                    )
                );
        }

        if ($type_2 == 'group_message' || $type_2 == 'group_announcement') {
            $temp['clans'] = array(
                'name' => 'Clans',
                'key' => "['$type_1']['$type_2']['clans']",
               'hasChild' => array(
                    '0' => array('name' => 'None', 'type' => 'radio', 'key' => "['$type_1']['$type_2']['clans']"),
                    '1' => array('name' => 'All', 'type' => 'radio', 'key' => "['$type_1']['$type_2']['clans']"),
                    '2' => array('name' => 'Releated', 'type' => 'radio', 'key' => "['$type_1']['$type_2']['clans']")
                    )
                );
        }

        return $temp;
    }
}

if (!function_exists('emailPrivacyArray')) {
    function emailPrivacyArray($role_id){
        if(is_null($role_id) || empty($role_id) || $role_id < 2 || $role_id > 6){
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

        $email_privacy['batch_request'] = array(
            'en'=>'Badge Request',
            'it'=>'Badge Request',
        );

        $email_privacy['batch_request_approved'] = array(
            'en'=>'Badge Request Approved',
            'it'=>'Badge Request Approved',
        );

        $email_privacy['batch_request_unapproved'] = array(
            'en'=>'Badge Request Unapproved',
            'it'=>'Badge Request Unapproved',
        );

        $email_privacy['new_announcement'] = array(
            'en'=>'Announcements',
            'it'=>'Announcements',
        );

        $email_privacy['event_manager'] = array(
            'en'=>'Event Manager',
            'it'=>'Event Manager',
        );

        $email_privacy['evolution_clan_request'] = array(
            'en'=>'Evolution clan request',
            'it'=>'Evolution clan request',
        );

        $email_privacy['evolution_clan_request_approved'] = array(
            'en'=>'Evolution clan request approved',
            'it'=>'Evolution clan request approved',
        );

        $email_privacy['evolution_clan_request_unapproved'] = array(
            'en'=>'Evolution clan request unapproved',
            'it'=>'Evolution clan request unapproved',
        );

        $email_privacy['evolution_clan_result'] = array(
            'en'=>'Evolution clan result',
            'it'=>'Evolution clan result',
        );


        //ADMIN
        $email_role[2] = array(
            'user_registration_notification',
            'event_invitation',
            'batch_request',
            'batch_request_approved',
            'batch_request_unapproved',
            'new_announcement',
            'event_manager',
            'evolution_clan_request',
            'evolution_clan_request_approved',
            'evolution_clan_request_unapproved',
            'evolution_clan_result'
        );

        //RECTOR
        $email_role[3] = array(
            'user_registration_notification',
            'trial_lesson_request',
            'trial_lesson_accepted',
            'trial_lesson_rejected',
            'event_invitation',
            'change_clan_date',
            'batch_request',
            'batch_request_approved',
            'batch_request_unapproved',
            'new_announcement',
            'event_manager',
            'evolution_clan_request',
            'evolution_clan_request_approved',
            'evolution_clan_request_unapproved',
            'evolution_clan_result'
        );

        //DEAN
        $email_role[4] = array(
            'user_registration_notification',
            'trial_lesson_request',
            'trial_lesson_accepted',
            'trial_lesson_rejected',
            'event_invitation',
            'change_clan_date',
            'teacher_absent',
            'batch_request',
            'batch_request_approved',
            'batch_request_unapproved',
            'new_announcement',
            'event_manager',
            'evolution_clan_request',
            'evolution_clan_request_approved',
            'evolution_clan_request_unapproved',
            'evolution_clan_result'
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
            'teacher_recovery_student_for_teacher',
            'recovery_teacher',
            'holiday_approved',
            'holiday_upapproved',
            'batch_request',
            'batch_request_approved',
            'batch_request_unapproved',
            'new_announcement',
            'event_manager',
            'evolution_clan_request',
            'evolution_clan_request_approved',
            'evolution_clan_request_unapproved',
            'evolution_clan_result'
        );

        //PUPIL
        $email_role[6] = array(
            'teacher_recovery_student_for_student',
            'event_invitation',
            'change_clan_date',
            'challenge_made',
            'challenge_accepted',
            'challenge_rejected',
            'challenge_winner',
            'new_announcement',
            'event_manager',
            'evolution_clan_request_approved',
            'evolution_clan_request_unapproved',
            'evolution_clan_result'
        );

        $return = array();
        $session = get_instance()->session->userdata('user_session'); 
        foreach ($email_role[$role_id] as $value) {
            $return[$value] = $email_privacy[$value][$session->language];
        }

        return $return;
    }
}

?>
