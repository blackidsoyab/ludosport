<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ajax extends CI_Controller {

    function __construct() {
        parent::__construct();
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
}
