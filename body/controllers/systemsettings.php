<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class systemsettings extends CI_Controller
{
    
    var $session_data;
    
    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('system_setting'));
        $this->session_data = $this->session->userdata('user_session');
    }
    
    function viewSystemSetting($type) {
        if (is_null($type) || is_integer($type)) {
            $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
            redirect(base_url() . 'dashboard', 'refresh');
        }
        
        $setting = new Systemsetting();
        $data['setting'] = $setting->where('type', $type)->order_by('sequence', 'ASC')->get();
        if ($type == 'general') {
            $role = new Role();
            $data['roles'] = $role->where('id >', '1')->get();
            
            $batch = new Batch();
            $data['batches'] = $batch->where('type', 'D')->get();
            $this->layout->view('systemsettings/general_setting', $data);
        }
        
        if ($type == 'update_general') {
            $this->_updateGeneralSetting();
            redirect(base_url() . 'system_setting/general', 'refresh');
        }
        
        if ($type == 'mail') {
            $this->layout->view('systemsettings/mail_setting', $data);
        }
        
        if ($type == 'update_mail') {
            $this->_updateMailSetting();
            redirect(base_url() . 'system_setting/mail', 'refresh');
        }
    }
    
    private function _updateGeneralSetting() {
        $setting = new Systemsetting();
        $setting->where('type', 'general')->get();
        foreach ($setting as $value) {
            
            if ($value->sys_key == 'login_logo' || $value->sys_key == 'main_logo') {
                if ($_FILES[$value->sys_key]['name'] != '') {
                    $avtar = $this->_uploadAvtar($value->sys_key);
                    $setting->where('sys_key', $value->sys_key)->update('sys_value', $avtar['file_name']);
                }
            } else {
                $setting->where('sys_key', $value->sys_key)->update('sys_value', $this->input->post($value->sys_key));
            }
        }
        return TRUE;
    }
    
    private function _updateMailSetting() {
        $setting = new Systemsetting();
        $setting->where('type', 'mail')->get();
        foreach ($setting as $value) {
            $setting->where('sys_key', $value->sys_key)->update('sys_value', $this->input->post($value->sys_key));
        }
        
        return TRUE;
    }
    
    private function _uploadAvtar($sys_key) {
        $this->upload->initialize(array('upload_path' => "./assets/img", 'allowed_types' => 'jpg|jpeg|gif|png|bmp', 'overwrite' => FALSE, 'remove_spaces' => TRUE, 'encrypt_name' => TRUE));
        
        $setting = new Systemsetting();
        $setting->where('sys_key', $sys_key)->get();
        
        if (!$this->upload->do_upload($sys_key)) {
            $data = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data($sys_key));
        }
        
        if (isset($data['upload_data'])) {
            if ($data['upload_data']['file_name'] != '') {
                
                if ($setting->sys_value != null && $setting->sys_value != 'no_avatar.jpg') {
                    if (file_exists('assets/img/' . $setting->sys_value)) {
                        unlink('assets/img/' . $setting->sys_value);
                    }
                }
                
                $image = str_replace(' ', '_', $data['upload_data']['file_name']);
                
                if ($sys_key == 'main_logo' && $data['upload_data']['image_width'] > 250) {
                    $this->load->helper('image_manipulation/image_manipulation');
                    include_lib_image_manipulation();
                    
                    $magicianObj = new imageLib('./assets/img/' . $image);
                    $magicianObj->resizeImage(250, 70, 'landscape');
                    $magicianObj->saveImage('./assets/img/' . $image, 100);
                } else if ($sys_key == 'login_logo' && $data['upload_data']['image_height'] > 120) {
                    $this->load->helper('image_manipulation/image_manipulation');
                    include_lib_image_manipulation();
                    
                    $magicianObj = new imageLib('./assets/img/' . $image);
                    $magicianObj->resizeImage(320, 120, 'portrait');
                    $magicianObj->saveImage('./assets/img/' . $image, 100);
                }
                
                return $data['upload_data'];
            }
        } else if (isset($data['error'])) {
            $this->session->set_flashdata($sys_key, $data['error']);
            redirect(base_url() . 'system_setting/' . $setting->type, 'refresh');
        }
    }
}
