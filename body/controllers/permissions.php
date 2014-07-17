<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class permissions extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', 'Manage Permissions');
    }

    function viewPermission() {
        $this->layout->view('permissions/view');
    }

    function addPermission() {
        if ($this->input->post() !== false) {
            $permission = new Permission();
            foreach ($this->config->item('custom_languages') as $key => $value) {
                $temp = $key . '_perm_name';
                $permission->$temp = $this->input->post($key . '_perm_name');
            }

            $permission->controller = $this->input->post('controller');
            $permission->method = $this->input->post('method');
            $permission->user_id = '1';
            $permission->save();
            $this->session->set_flashdata('success', 'Permission Added Successfully :-)');
            redirect(base_url() . 'permission', 'refresh');
        } else {
            $this->layout->setField('page_title', 'Add Permissions');
            $data['all_controllers'] = $this->controllerlist->getControllers();
            $this->layout->view('permissions/add', $data);
        }
    }

    function editPermission($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $permission = new Permission();
                $permission->where('id', $id)->get();
                foreach ($this->config->item('custom_languages') as $key => $value) {
                    $temp = $key . '_perm_name';
                    $permission->$temp = $this->input->post($key . '_perm_name');
                }

                $permission->controller = $this->input->post('controller');
                $permission->method = $this->input->post('method');
                $permission->user_id = '1';
                $permission->save();
                $this->session->set_flashdata('success', 'Permission Updated Successfully :)');
                redirect(base_url() . 'permission', 'refresh');
            } else {
                $this->layout->setField('page_title', 'Edit Permission');

                $permission = new Permission();
                $data['permission'] = $permission->where('id', $id)->get();

                $data['all_controllers'] = $this->controllerlist->getControllers();
                $data['all_methods'] = $this->controllerlist->getMethods($data['permission']->controller);

                $this->layout->view('permissions/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', 'Not able to Edit Permission :-S');
            redirect(base_url() . 'permission', 'refresh');
        }
    }

    function deletePermission($id) {
        if (!empty($id)) {
            $permission = new Permission();
            $permission->where('id', $id)->get();
            $permission->delete();
            $this->session->set_flashdata('success', 'Permissions Deleted Successfully :-)');
            redirect(base_url() . 'permission', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Not able to delete Permission :-S');
            redirect(base_url() . 'permission', 'refresh');
        }
    }

}
