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
        if(is_null($id)){
            $obj = new Notification();
            $obj->where('to_id', $this->session_data->id)->get();
            $data['per_page'] = ceil($obj->result_count() / 5);
            $this->layout->view('notifications/view', $data);
        }else{
            $obj = new Notification();
            $obj->where(array('to_id'=>$this->session_data->id, 'id'=>$id))->get();
            if($obj->result_count() == 1){
                $obj->where(array('to_id'=>$this->session_data->id, 'id'=>$id))->update('status', 1);

                $options['id'] = $obj->id;
                $options['notify_type'] = $obj->notify_type;
                $options['object_id'] = $obj->object_id;
                $options['from_id'] = $obj->from_id;
                $options['data'] = unserialize($obj->data);

                if ($obj->type == 'N') {
                    $user_info = userNameAvtar($obj->from_id);
                    $message = getMessageTemplate($options);
                    $img = '<img src="' . $user_info['avtar'] . '" class="media-object img-circle" alt="Avatar">';
                } else {
                    $message = getMessageTemplate($options);
                    $img = '<i class="fa fa-3x fa-info-circle"></i>';
                }

                $str = '<div class="col-sm-12"><div class="the-box no-border"><div class="media user-card-sm">';
                $str .= '<a class="pull-left">' . $img . '</a>';
                $str .= '<div class="media-body"><h4 class="media-heading">' . @$message . '</h4>';
                $str .= '<p class="text-primary">' . time_elapsed_string($obj->timestamp) . '</p></div>';
                $str .='</div></div></div>';

                $data['str'] = $str;
                $this->layout->view('notifications/single', $data);       
            }else{
                $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
                redirect(base_url() . 'dashboard', 'refresh'); 
            }
            
        }
    }

}
