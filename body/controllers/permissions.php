<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class permissions extends CI_Controller {

    var $session;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('permission'));
        $this->session = $this->session->userdata('user_session');
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
            $permission->user_id = $this->session->id;
            $permission->save();
            $this->session->set_flashdata('success', $this->lang->line('add_data_success'));
            redirect(base_url() . 'permission', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('add') . ' ' . $this->lang->line('permission'));
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
                $permission->user_id = $this->session->id;
                $permission->save();
                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'permission', 'refresh');
            } else {
                $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('permission'));

                $permission = new Permission();
                $data['permission'] = $permission->where('id', $id)->get();

                $data['all_controllers'] = $this->controllerlist->getControllers();
                $data['all_methods'] = $this->controllerlist->getMethods($data['permission']->controller);

                $this->layout->view('permissions/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'permission', 'refresh');
        }
    }

    function deletePermission($id) {
        if (!empty($id)) {
            $permission = new Permission();
            $permission->where('id', $id)->get();
            $permission->delete();
            $this->session->set_flashdata('success', $this->lang->line('delete_data_success'));
            redirect(base_url() . 'permission', 'refresh');
        } else {
            $this->session->set_flashdata('error', $this->lang->line('delete_data_error'));
            redirect(base_url() . 'permission', 'refresh');
        }
    }

}
