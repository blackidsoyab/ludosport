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

    /*
     * ------------------------------------------
     * ------------------- END ------------------
     * ------------------------------------------
     */

    /*
     * ------------------------------------------
     *           Methos for the Register
     *                   START
     * ------------------------------------------
     */

    function registerCheckUsername() {
        $user = new User();
        $user->where('username', $this->input->get('username'));
        $user->get();
        if ($user->result_count() == 1) {
            echo 'false';
        } else {
            echo 'true';
        }
    }

    function registerCheckEmail() {
        $user = new User();
        $user->where('email', $this->input->get('email'));
        $user->get();
        if ($user->result_count() == 1) {
            echo 'false';
        } else {
            echo 'true';
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
            $array[] = $temp;
        }
        if (!empty($notification->id)) {
            $array['lastid'] = $notification->id;
        } else {
            $array['lastid'] = $notification_id;
        }
        echo json_encode($array);
    }

}
