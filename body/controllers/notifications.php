<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class notifications extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('notifications'));
        $this->session_data = $this->session->userdata('user_session');
    }

    function viewNotification($id = null) {
        $obj = new Notification();
        $obj->where('to_id', $this->session_data->id)->get();
        $data['per_page'] = ceil($obj->result_count() / 5);
        $this->layout->view('notifications/view', $data);
    }

}
