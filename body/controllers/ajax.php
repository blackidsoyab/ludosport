<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ajax extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->session_data = $this->session->userdata('user_session');
    }

    /*
     * ------------------------------------------
     *           Methos for the Dashboard
     *                   START
     * ------------------------------------------
     */

    function setNewLanguage($lang_prefix) {
        $session = $this->session->userdata('user_session');
        $session->language = $lang_prefix;
        $newdata = array('user_session' => $session);
        $this->session->set_userdata($newdata);
        echo TRUE;
    }

    function setNewRole($role_id) {
        $session = $this->session->userdata('user_session');
        if (in_array($role_id, $session->all_roles)) {
            $session = $this->session->userdata('user_session');
            $roles = $session->all_roles;
            $roles[] = $session->role;
            if (($key = array_search($role_id, $roles)) !== false) {
                unset($roles[$key]);
            }
            sort($roles);
            $session->all_roles = $roles;
            $session->role = $role_id;
            $session->role_name = getRoleName($role_id);
            $newdata = array('user_session' => $session);
            $this->session->set_userdata($newdata);
            echo TRUE;
        } else {
            echo FALSE;
        }
    }

    function checkNotification($notification_id) {
        $notification = new Notification();
        $notification->where(array('to_id' => $this->session_data->id, 'status' => 0, 'id >' => $notification_id));
        $notification->order_by('id', 'desc');
        $array = array();
        $array['notification'] = 'false';
        foreach ($notification->get() as $notify) {
            $options['notify_type'] = $notify->notify_type;
            $options['object_id'] = $notify->object_id;
            $options['from_id'] = $notify->from_id;
            $options['data'] = unserialize($notify->data);
            $array['notification'] = 'true';
            $temp = array();
            $temp['type'] = 'success';
            $temp['message'] = getMessageTemplate($options);
            $temp['notification'] = getSingleNotification($notify->id);
            $last_id = $notify->id;
            $array[] = $temp;
        }
        if (isset($last_id)) {
            $array['lastid'] = $last_id;
            $this->session->set_userdata('last_notification_id', $last_id);
        } else {
            $array['lastid'] = $notification_id;
            $this->session->set_userdata('last_notification_id', $notification_id);
        }

        $array['notification_count'] = countNotifications($this->session_data->id);
        echo json_encode($array);
    }

    function markAllNotificationRead() {
        $notification = new Notification();
        $notification->where(array('to_id' => $this->session_data->id, 'status' => 0))->get();
        $notification->update_all('status', 1);
        return true;
    }

    function checkMessage($message_id) {
        $obj_message = new Message();
        $getmessage =  $obj_message->getMessages($this->session_data->id, $message_id);
        $array = array();
        $array['message'] = 'false';
        if($getmessage){
            foreach ($getmessage as $message) {
                $array['message'] = 'true';
                $temp = array();
                $temp['type'] = 'success';
                $temp['message_title'] = $message->subject;
                $temp['message'] = getSingleMessage($message->id);
                $last_id = $message->id;
                $array[] = $temp;
            }
        }
        if (isset($last_id)) {
            $array['lastid'] = $last_id;
            $this->session->set_userdata('last_message_id', $last_id);
        } else {
            $array['lastid'] = $message_id;
            $this->session->set_userdata('last_message_id', $message_id);
        }

        $array['message_count'] = countMessage($this->session_data->id);
        echo json_encode($array);
    }

    function markAllMessageRead(){
        $obj_message = new Message();
        $obj_message->where(array('to_id' => $this->session_data->id, 'to_status' => 'U'))->get();
        $obj_message->update_all('to_status', 'R');

        $obj_messagestatus = new Messagestatus();
        $obj_messagestatus->where(array('to_id' => $this->session_data->id, 'status' => 'U'))->get();
        $obj_messagestatus->update_all('status', 'R');

        return true;   
    }

    function notificationPanigate($group_number) {
        $items_per_group = 5;
        //$group_number = filter_var($this->input->post("group_no"), FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
        $position = ($group_number * $items_per_group);

        $obj = new Notification();
        $obj->where('to_id', $this->session_data->id);
        $obj->limit($items_per_group, $position);
        $obj->order_by('id', 'desc');
        $notifications = $obj->get();
        $str = Null;
        if ($obj->result_count() > 0) {
            foreach ($notifications as $notify) {
                $options['id'] = $notify->id;
                $options['notify_type'] = $notify->notify_type;
                $options['object_id'] = $notify->object_id;
                $options['from_id'] = $notify->from_id;
                $options['data'] = unserialize($notify->data);

                if ($notify->type == 'N') {
                    $user_info = userNameAvtar($notify->from_id);
                    $message = getMessageTemplate($options);
                    $img = '<img src="' . $user_info['avtar'] . '" class="media-object img-circle" alt="Avatar">';
                } else {
                    $message = getMessageTemplate($options);
                    $img = '<i class="fa fa-3x fa-info-circle"></i>';
                }

                $str .= '<div class="col-sm-12"><div class="the-box no-border"><div class="media user-card-sm">';
                $str .= '<a class="pull-left">' . $img . '</a>';
                $str .= '<div class="media-body"><h4 class="media-heading">' . @$message . '</h4>';
                $str .= '<p class="text-primary">' . time_elapsed_string($notify->timestamp) . '</p></div>';

                $str .= '<div class="right-button">';
                $str .= '<a href="' . makeURL($options) . '" data-toggle="tooltip" data-placement="bottom" data-original-title="' . @$message . '" class="btn btn-primary"><i class="fa fa-share"></i></a>';
                $str .='</div></div></div></div>';
            }
            echo $str;
        } else {
            echo FALSE;
        }

        exit;
    }

    function getClanDetails($city_id){
        $user = New User();
        //Get Current Login User details
        $user->where('id', $this->session_data->id)->get();

        //Calculate Age
        $age = explode(' ', time_elapsed_string(date('Y-m-d H:i:s', $user->date_of_birth)));

        //Under 16 or not
        if ($age[1] == 'year' && $age[0] < 16) {
            $under_sixteen = 1;
        } else {
            $under_sixteen = 0;
        }

        $clan = New Clan();
        //get all the Clan in the User city and also check level(based on age).
        $clans_data = $clan->getAviableTrialClan($city_id, $under_sixteen);

        //check result
        if ($clans_data !== FALSE) {
            //now the result is in multidimensional data make it single dimensional and the get clans details
            //return $clan->where_in('id', MultiArrayToSinlgeArray($clans_data))->get();
            $clan->where_in('id', MultiArrayToSinlgeArray($clans_data))->get();
            $str = NULL;
            foreach ($clan as $clan_detail) {
                $str .= '<div class="col-lg-4 col-xs-4 clan">';
                $str .= '<div class="the-box rounded text-center padding-killer margin-bottom-killer" data-clan="'.$clan_detail->id.'">';
                $str .= '<input type="radio" value="'.$clan_detail->id.'" name="clan_id" />';
                $str .= '<h4 class="light">'. $clan_detail->{$this->session_data->language . '_class_name'} .'</h4>';
                $str .= '</div>';
                $str .= '</div>';
                $str .= "\n";
            }

            echo $str;
        } else {
            return 'There is no Clan. Please Contact on 123-4567-8900 or mail us at info@myludosport.net';
        }
    }

    function getDateForClan($clan_id) {
        $clan = new Clan();
        $temp_dates = $clan->getAviableDateFromClan($clan_id, 5, 20);
        $dates = array();
        $clan->where('id', $clan_id)->get();
        $str = NULL;

        $str .= '<h4 class="text-center text-black"> Class Timing : ' . date('H.i a', $clan->lesson_from) . '  - ' . date('H.i a', $clan->lesson_to) . '</h4>';

        foreach ($temp_dates as $date) {
            $obj_clan_date = new Clandate();
            $obj_clan_date->where(array('clan_id'=>$clan_id, 'clan_shift_from' => $date))->get();
            if($obj_clan_date->result_count() == 1){
                $dates[] = $obj_clan_date->clan_date;
            }else{
                $dates[] = $date;
            }
        }

        sort($dates);
        foreach ($dates as $date) {
            $str .= '<div class="col-lg-4 col-xs-4 clan-date">';
            $str .= '<div class="the-box rounded text-center padding-killer mar-bt-10" data-clan-date="' . $date . '">';
            $str .= '<input type="radio" value="' . $date . '" name="date" />';
            $str .= '<h4 class="light">' . date('l', strtotime($date)). '<br />' . date('j<\s\u\p>S</\s\u\p> F Y', strtotime($date)) . '</h4>';
            $str .= '</div></div>';
            $str .= "\n";
        }
        echo $str;
    }

    function generateCalendatDates($year, $month){
        $month = $month + 1;
        $current_date = get_current_date_time()->get_date_for_db();        
        $return = array();
        $total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        for($i=1;$i<=$total_days;$i++){
            $date = date('Y-m-d', strtotime($year .'-'. $month .'-'. $i));
            $day_numeric = date('N', strtotime($date));
            $clans = New Clan();
            $details = $clans->getClansByDay($day_numeric);  

            if($details){
               foreach ($details as $value) {
                    if(strtotime($date) >= strtotime($value->clan_from) && strtotime($date) <= strtotime($value->clan_to)){  
                        $obj_clan_date = new Clandate();
                        $check = $obj_clan_date->isClanShifted($value->id, $date);                    

                        if($check != false){
                            if($check->clan_date == $date){
                                $temp = array();
                                $temp['title'] = $value->clan;
                                $temp['start'] = $check->clan_date;
                                $temp['tooltip'] = 'clan shifted of ' . date('d-m-Y', strtotime($check->clan_shift_from)) . ' ' . $value->school .', '. $value->academy;
                                if($this->session_data->role == 1 || $this->session_data->role == 2 || $this->session_data->role == 5) {
                                    $temp['url'] = base_url() .'clan/clan_attendance/' . $value->id .'/'. $date;
                                }
                                if(strtotime($date) < strtotime($current_date)){
                                    $temp['type'] = 'past';
                                    $temp['class'] = 'badge badge-warning-info';
                                }else if(strtotime($date) == strtotime($current_date)){
                                    $temp['type'] = 'present';
                                    $temp['class'] = 'badge badge-warning-success';
                                } else {
                                    $temp['type'] = 'future';
                                    $temp['class'] = 'badge badge-warning-inverse';
                                }
                                $return[] = $temp;
                            }

                            if($check->clan_shift_from == $date){
                                $temp = array();
                                $temp['title'] = $value->clan;
                                $temp['start'] = $date;
                                $temp['tooltip'] = 'clan shifted on ' . date('d-m-Y', strtotime($check->clan_date)) . ' ' . $value->school .', '. $value->academy;
                                if(strtotime($date) < strtotime($current_date)){
                                    $temp['url'] = base_url() .'clan/clan_attendance/' . $value->id .'/'. $date;
                                    $temp['type'] = 'past';
                                    $temp['class'] = 'badge badge-info-danger';
                                }else if(strtotime($date) == strtotime($current_date)){
                                    $temp['url'] = base_url() .'clan/clan_attendance/' . $value->id .'/'. $date;
                                    $temp['type'] = 'present';
                                    $temp['class'] = 'badge badge-success-danger';
                                } else {
                                    $temp['url'] = base_url() .'clan/clan_attendance/' . $value->id .'/'. $date;
                                    $temp['type'] = 'future';
                                    $temp['class'] = 'badge badge-inverse-danger';
                                }
                                $return[] = $temp;   
                            }
                        }else{
                            $temp = array();
                            $temp['title'] = $value->clan;
                            $temp['start'] = $date;
                            $temp['tooltip'] = $value->school .', '. $value->academy;
                            if(strtotime($date) < strtotime($current_date)){
                                $temp['url'] = base_url() .'clan/clan_attendance/' . $value->id .'/'. $date;
                                $temp['type'] = 'past';
                                $temp['class'] = 'badge badge-info';
                            }else if(strtotime($date) == strtotime($current_date)){
                                $temp['url'] = base_url() .'clan/clan_attendance/' . $value->id .'/'. $date;
                                $temp['type'] = 'present';
                                $temp['class'] = 'badge badge-success';
                            } else {
                                $temp['url'] = base_url() .'clan/clan_attendance/' . $value->id .'/'. $date;
                                $temp['type'] = 'future';
                                $temp['class'] = 'badge badge-inverse';
                            }
                            $return[] = $temp;
                        }         
                    }
                }
            }
        }

        if(count($return) == 0){
            $temp = array();
            $temp['start'] = date('Y-m-d', strtotime($year .'-'.$month.'-01'));
            $return[] = $temp;
        }

        echo json_encode($return);
    }

    /*
     * ------------------------------------------
     * ------------------- END ------------------
     * ------------------------------------------
     */

    /*
     * ------------------------------------------
     *    Methos for the Permission Controller
     *                   START
     * ------------------------------------------
     */

    function getMethodsFromControllers($controlername, $method = null) {
        $methods = $this->controllerlist->getMethods($controlername);
        foreach ($methods as $value) {
            echo '<option value="' . $value . '"' . (($method == $value) ? ' selected="selected"' : '') . '>' . $value . '</option>';
        }
    }

    function checkValidPermision($id = null) {
        $permission = new Permission();
        $permission->where('controller', $this->input->post('controller'));
        $permission->where('method', $this->input->post('method'));
        $permission->get();
        if ($id != '0') {
            if ($permission->result_count() == 1 && $permission->id != $id) {
                echo 'false';
            } else {
                echo 'true';
            }
        } else {
            if ($permission->result_count() == 1) {
                echo 'false';
            } else {
                echo 'true';
            }
        }
    }

    /*
     * ------------------------------------------
     * ------------------- END ------------------
     * ------------------------------------------
     */

    /*
     * ------------------------------------------
     *         Methos for the Roles Controller
     *                   START
     * ------------------------------------------
     */

    function checkValidRole($id = null) {
        $role = new Role();
        $role->where('en_role_name', $this->input->post('en_role_name'));
        $role->get();
        if ($id != '0') {
            if ($role->result_count() == 1 && $role->id != $id) {
                echo 'false';
            } else {
                echo 'true';
            }
        } else {
            if ($role->result_count() == 1) {
                echo 'false';
            } else {
                echo 'true';
            }
        }
    }

    /*
     * ------------------------------------------
     * ------------------- END ------------------
     * ------------------------------------------
     */

    function getAllStatesOptionsFromCountry($country_id) {
        $session = $this->session->userdata('user_session');
        $states = New State();
        $states->Where('country_id', $country_id);
        $state_name = $session->language . '_name';
        echo '<option value="0">', $this->lang->line('select'), ' ', $this->lang->line('state'), '</option>';
        foreach ($states->get() as $state) {
            echo '<option value="' . $state->id . '">' . $state->$state_name . '</option>';
        }
    }

    function getAllCitiesOptionsFromState($state_id) {
        $session = $this->session->userdata('user_session');
        $cities = New City();
        $cities->Where('state_id', $state_id);
        $city_name = $session->language . '_name';
        echo '<option value="0">', $this->lang->line('select'), ' ', $this->lang->line('city'), '</option>';
        foreach ($cities->get() as $city) {
            echo '<option value="' . $city->id . '">' . $city->$city_name . '</option>';
        }
    }

    function getSchoolsOptionFromAcademy($academy_id) {
        $session = $this->session->userdata('user_session');
        $schools = New School();
        $schools->Where('academy_id', $academy_id);
        echo '<option value="0">', $this->lang->line('all'), ' ', $this->lang->line('school'), '</option>';
        foreach ($schools->get() as $school) {
            echo '<option value="' . $school->id . '">' . $school->{$session->language . '_school_name'} . '</option>';
        }
    }

    function getClassesOptionFromSchool($school_id) {
        $session = $this->session->userdata('user_session');
        $obj = New Clan();
        $obj->Where('school_id', $school_id);
        echo '<option value="0">', $this->lang->line('all'), ' ', $this->lang->line('clan'), '</option>';
        foreach ($obj->get() as $class) {
            echo '<option value="' . $class->id . '">' . $class->{$session->language . '_class_name'} . '</option>';
        }
    }

    /*
     * ------------------------------------------
     *           Methos for the Edit User
     *                   START
     * ------------------------------------------
     */

    function checkUsernameExit($id = null) {
        $user = new User();
        $user->where('username', $this->input->get('username'))->get();
        if ($id != '0') {
            if ($user->result_count() == 1 && $user->id != $id) {
                echo 'false';
            } else {
                echo 'true';
            }
        } else {
            if ($user->result_count() == 1) {
                echo 'false';
            } else {
                echo 'true';
            }
        }
    }

    function checkEmailExit($id = null) {
        $user = new User();
        $user->where('email', $this->input->get('email'))->get();
        if ($id != '0') {
            if ($user->result_count() == 1 && $user->id != $id) {
                echo 'false';
            } else {
                echo 'true';
            }
        } else {
            if ($user->result_count() == 1) {
                echo 'false';
            } else {
                echo 'true';
            }
        }
    }

    function checkCurrentPassword() {
        $user = new User();
        $user->where(array('id' => $this->session_data->id, 'password' => md5($this->input->get('current_pwd'))));
        $user->get();
        if ($user->result_count() == 1) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    /*
     * ------------------------------------------
     * ------------------- END ------------------
     * ------------------------------------------
     */

    /*
     * ------------------------------------------
     *           Methos for the Events
     *                   START
     * ------------------------------------------
     */
        function gerUserByRoleID($role_id){
            $users = new User();
            $data = $users->getUsersByRole($role_id);

            echo '<option value="">'. $this->lang->line('select'), ' ', $this->lang->line('manager') .'</option>'; 
            
            foreach ($data as $value) {
                echo '<option value="'.$value->id.'">'. $value->firstname .' ' . $value->lastname .'</option>'; 
            }
        }
     /*
     * ------------------------------------------
     * ------------------- END ------------------
     * ------------------------------------------
     */

     /*
     * ------------------------------------------
     *           Methos for the Message
     *                   START
     * ------------------------------------------
     */

     function downloadAttachment($attachment_id) {
        $obj = new Messageattachment();
        $obj->where('id', $attachment_id)->get();
        if($obj->result_count() == 1){
            if (file_exists('assets/message_attachments/' . $obj->file_name)) {
                $path = './assets/message_attachments/' . $obj->file_name;
                downloadFile($path, $obj->original_name);
            }    
        }
    }

     /*
     * ------------------------------------------
     * ------------------- END ------------------
     * ------------------------------------------
     */
}
