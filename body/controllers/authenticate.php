<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class authenticate extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->layout->setLayout('template/layout_login');
        $this->layout->setField('page_title', 'User Login');

        setLanguage();
    }

    public function index() {
        $session = $this->session->userdata('user_session');
        if (!empty($session)) {
            $this->session->set_flashdata('info', 'You are already logged in :)');
            redirect(base_url() . 'dashboard', 'refresh');
        } else {
            $this->layout->view('authenticate/login');
        }
    }

    function validateUser() {
        print_r($_POST);
        $user = new User();
        $user->where('username', $this->input->post('username'));
        $user->where('password', md5($this->input->post('password')));
        $user->get();

        if ($user->result_count() === 1) {
            $user_data = new stdClass();
            $user_data->name = $user->firstname . ' ' . $user->lastname;
            $user_data->language = 'en';
            $user_data->role = $user->role_id;
            $newdata = array('user_session' => $user_data);
            $this->session->set_userdata($newdata);
            redirect(base_url() . 'dashboard', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Invalid Username or Password');
            redirect(base_url() . 'login', 'refresh');
        }
    }

    function logout() {
        $this->session->unset_userdata('user_session');
        $this->session->sess_destroy();

        redirect(base_url() . 'login', 'refresh');
    }

    function ChangeLanguage($lang_prefix) {
        $session = $this->session->userdata('user_session');
        $session->language = $lang_prefix;
        $newdata = array('user_session' => $session, 'type' => 'User');
        $this->session->set_userdata($newdata);
        echo TRUE;
    }

    function permission() {
        $this->layout->setLayout('template/layout_permission');
        $this->layout->setField('page_title', 'Permission Denied');
        $this->layout->view('authenticate/permission');
    }

    function register() {
        //$this->layout->view()
    }

}
