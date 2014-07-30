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
        $newdata = array('user_session' => $session,);
        $this->session->set_userdata($newdata);
        echo TRUE;
    }

    function setNewRole($role_id) {
        $session = $this->session->userdata('user_session');
        if (in_array($role_id, $session->all_roles)) {
            $user_data = new stdClass();
            $user_data->id = $session->id;
            $user_data->name = $session->name;
            $user_data->avtar = $session->avtar;
            $user_data->language = $session->language;
            $user_data->all_roles = $session->all_roles;
            $user_data->role = $role_id;
            $user = new User();
            $user_data->permissions = $user->userRoleByID($session->id, $role_id);
            $user_data->status = $session->status;
            $newdata = array('user_session' => $user_data);
            $this->session->unset_userdata('user_session');
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
            $array['notification'] = 'true';
            $temp = array();
            $temp['type'] = 'success';
            $temp['message'] = getMessageTemplate($notify->notify_type);
            $temp['notification'] = getSingleNotification($notify->id);
            $array[] = $temp;
        }
        if (!empty($notification->id)) {
            $array['lastid'] = $notification->id;
            $this->session->set_userdata('last_notification_id', $notification->id);
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
                if ($notify->type == 'N') {
                    $user_info = userNameAvtar($notify->from_id);
                    $message = getMessageTemplate($notify->notify_type, $user_info['name']);
                    $img = '<img src="' . $user_info['avtar'] . '" class="media-object img-circle" alt="Avatar">';
                } else {
                    $message = getMessageTemplate($notify->notify_type);
                    $img = '<i class="fa fa-3x fa-info-circle"></i>';
                }

                $str .= '<div class="col-sm-12"><div class="the-box no-border"><div class="media user-card-sm">';
                $str .= '<a class="pull-left">' . $img . '</a>';
                $str .= '<div class="media-body"><h4 class="media-heading">' . $message . '</h4>';
                $str .= '<p class="text-primary">' . time_elapsed_string($notify->timestamp) . '</p></div>';

                $str .= '<div class="right-button">';
                $str .= '<a href="' . makeURL($notify->notify_type, $notify->object_id) . '" data-toggle="tooltip" data-placement="bottom" data-original-title="' . $message . '" class="btn btn-primary"><i class="fa fa-share"></i></a>';
                $str .='</div></div></div></div>';
            }
            echo $str;
        } else {
            echo FALSE;
        }
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
        echo '<option value="">', $this->lang->line('select'), ' ', $this->lang->line('state'), '</option>';
        foreach ($states->get() as $state) {
            echo '<option value="' . $state->id . '">' . $state->$state_name . '</option>';
        }
    }

    function getAllCitiesOptionsFromState($state_id) {
        $session = $this->session->userdata('user_session');
        $cities = New City();
        $cities->Where('state_id', $state_id);
        $city_name = $session->language . '_name';
        echo '<option value="">', $this->lang->line('select'), ' ', $this->lang->line('city'), '</option>';
        foreach ($cities->get() as $city) {
            echo '<option value="' . $city->id . '">' . $city->$city_name . '</option>';
        }
    }

    function getSchoolsOptionFromAcademy($academy_id) {
        $session = $this->session->userdata('user_session');
        $schools = New School();
        $schools->Where('academy_id', $academy_id);
        $school_name = $session->language . '_school_name';
        echo '<option value="">', $this->lang->line('select'), ' ', $this->lang->line('school'), '</option>';
        foreach ($schools->get() as $school) {
            echo '<option value="' . $school->id . '">' . $school->$school_name . '</option>';
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
}
