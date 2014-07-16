<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class roles extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', 'Manage Roles');

        $this->load->library('acl');
    }

    function viewrole() {
        $this->layout->view('roles/view');
    }

    function addrole() {
        if ($this->input->post() !== false) {
            $role = new Role();
            foreach ($this->config->item('custom_languages') as $key => $value) {
                $temp = $key . '_role_name';
                $role->$temp = $this->input->post($key . '_role_name');
            }

            $role->permission = serialize($this->input->post('prem'));
            $role->user_id = '1';
            $role->save();
            $this->session->set_flashdata('success', 'Role Added Successfully :-)');
            redirect(base_url() . 'role', 'refresh');
        } else {
            $this->layout->setField('page_title', 'Add Role');

            $myACL = new ACL();
            $data['aPerms'] = $myACL->getAllPerms('full');
            $this->layout->view('roles/add', $data);
        }
    }

    function editrole($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $role = new Role();
                $role->where('id', $id)->get();
                foreach ($this->config->item('custom_languages') as $key => $value) {
                    $temp = $key . '_role_name';
                    $role->$temp = $this->input->post($key . '_role_name');
                }

                $role->permission = serialize($this->input->post('prem'));
                $role->user_id = '1';
                $role->save();
                $this->session->set_flashdata('success', 'Role Updated Successfully :)');
                redirect(base_url() . 'role', 'refresh');
            } else {
                $this->layout->setField('page_title', 'Edit Role');

                $role = new Role();
                $data['role'] = $role->where('id', $id)->get();

                $myACL = new ACL();
                $data['rPerms'] = $myACL->getRolePerms($id);
                $data['aPerms'] = $myACL->getAllPerms('full');

                $this->layout->view('roles/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', 'Not able to Edit Role :-S');
            redirect(base_url() . 'role', 'refresh');
        }
    }

    function deleterole($id) {
        if (!empty($id)) {
            $role = new Role();
            $role->where('id', $id)->get();
            $role->delete();
            $this->session->set_flashdata('success', 'Role Deleted Successfully :-)');
            redirect(base_url() . 'role', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Not able to delete Role :-S');
            redirect(base_url() . 'role', 'refresh');
        }
    }

}
