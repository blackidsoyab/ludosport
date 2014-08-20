<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class roles extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('role'));
        $this->session_data = $this->session->userdata('user_session');
        $this->load->library('acl');
    }

    function viewRole() {
        $this->layout->view('roles/view');
    }

    function addRole() {
        if ($this->input->post() !== false) {
            $role = new Role();
            foreach ($this->config->item('custom_languages') as $key => $value) {
                $temp = $key . '_role_name';
                if ($this->input->post($temp) != '') {
                    $role->$temp = $this->input->post($temp);
                } else {
                    $role->$temp = $this->input->post('en_role_name');
                }
            }

            if ($this->input->post('is_manager') == '1') {
                $role->is_manager = 1;
            }else{
                $role->is_manager = 0;
            }

            $role->permission = serialize($this->input->post('perm'));
            $role->user_id = $this->session_data->id;
            $role->save();
            $this->session->set_flashdata('success', $this->lang->line('add_data_success'));
            redirect(base_url() . 'role', 'refresh');
        } else {
            $this->layout->setField('page_title', 'Add Role');

            $myACL = new ACL();
            $data['aPerms'] = $myACL->getAllPerms('full');
            $this->layout->view('roles/add', $data);
        }
    }

    function editRole($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $role = new Role();
                $role->where('id', $id)->get();
                foreach ($this->config->item('custom_languages') as $key => $value) {
                    $temp = $key . '_role_name';
                    if ($this->input->post($temp) != '') {
                        $role->$temp = $this->input->post($temp);
                    } else {
                        $role->$temp = $this->input->post('en_role_name');
                    }
                }

                if ($this->input->post('is_manager') == '1') {
                    $role->is_manager = 1;
                }else{
                    $role->is_manager = 0;
                }

                $role->permission = serialize($this->input->post('perm'));
                $role->user_id = $this->session_data->id;
                $role->save();
                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'role', 'refresh');
            } else {
                $this->layout->setField('page_title', 'Edit Role');

                $role = new Role();
                $data['role'] = $role->where('id', $id)->get();

                //$myACL = new ACL();
                //$data['rPerms'] = $myACL->getRolePerms($id);
                //$data['aPerms'] = $myACL->getAllPerms('full');

                $this->layout->view('roles/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'role', 'refresh');
        }
    }

    function deleteRole($id) {
        if (!empty($id)) {
            $role = new Role();
            $role->where('id', $id)->get();
            $role->delete();
            $this->session->set_flashdata('success', $this->lang->line('delete_data_success'));
            redirect(base_url() . 'role', 'refresh');
        } else {
            $this->session->set_flashdata('error', $this->lang->line('delete_data_error'));
            redirect(base_url() . 'role', 'refresh');
        }
    }

}
