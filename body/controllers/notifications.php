<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class notifications extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('notification'));
        $this->session_data = $this->session->userdata('user_session');
    }

    function viewNotification($id = null) {
        $obj = new Notification();
        if (is_null($id)) {
            $obj->where('to_id', $this->session_data->id);
            $obj->order_by('id', 'desc');
            $data['notifications'] = $obj->get();
        } else {
            $data['notifications'] = $obj->where('id', $id)->get();
        }
        $this->layout->view('notifications/view', $data);
    }

}
