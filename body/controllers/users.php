<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class users extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('user'));
        $this->session_data = $this->session->userdata('user_session');
    }

    function viewUser() {
        $this->layout->view('users/view');
    }

    function addUser() {
        if ($this->input->post() !== false) {
            $user = new User();

            $user->firstname = $this->input->post('firstname');
            $user->lastname = $this->input->post('lastname');
            $user->email = $this->input->post('email');
            $user->date_of_birth = strtotime($this->input->post('date_of_birth'));
            $user->city_id = $this->input->post('city_id');
            $user->role_id = $this->input->post('role_id');
            $user->username = $this->input->post('username');
            $user->password = md5($this->input->post('new_password'));
            $user->user_id = $this->session_data->id;

            $user->save();
            $this->session->set_flashdata('success', $this->lang->line('add_data_success'));
            redirect(base_url() . 'user', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('add') . ' ' . $this->lang->line('user'));

            $city = new City();
            $data['cities'] = $city->get();

            $role = new Role();
            $data['roles'] = $role->where_not_in('id', array(1))->get();

            $this->layout->view('users/add', $data);
        }
    }

    function editUser($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $user = new User();
                $user->where('id', $id)->get();

                $user->firstname = $this->input->post('firstname');
                $user->lastname = $this->input->post('lastname');
                $user->email = $this->input->post('email');
                $user->date_of_birth = strtotime($this->input->post('date_of_birth'));
                $user->city_id = $this->input->post('city_id');
                $user->role_id = $this->input->post('role_id');

                if ($this->input->post('username') != '') {
                    $user->username = $this->input->post('username');
                }

                if ($this->input->post('new_password') != '') {
                    $user->password = md5($this->input->post('new_password'));
                }
                $user->user_id = $this->session_data->id;

                $user->save();
                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'user', 'refresh');
            } else {
                $this->layout->setField('page_title', 'Edit User');

                $user = new User();
                $data['user'] = $user->where('id', $id)->get();

                $city = new City();
                $data['cities'] = $city->get();

                $role = new Role();
                $data['roles'] = $role->where_not_in('id', array(1))->get();

                $this->layout->view('users/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'user', 'refresh');
        }
    }

    function deleteUser($id) {
        if (!empty($id)) {
            $user = new User();
            $user->where('id', $id)->get();
            $user->delete();
            $this->session->set_flashdata('success', $this->lang->line('delete_data_success'));
            redirect(base_url() . 'user', 'refresh');
        } else {
            $this->session->set_flashdata('error', $this->lang->line('delete_data_error'));
            redirect(base_url() . 'user', 'refresh');
        }
    }

    function extraPermissionUser($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
               
                $user = new User();
                $user->where('id', $id)->update('permission', serialize($this->input->post('perm')));
                $user->delete();
                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'user', 'refresh');
            } else {
                $user = new User();
                $data['user'] = $user->where('id', $id)->get();

                $role = new Role();
                $data['role'] = $role->where('id', $data['user']->role_id)->get();

                $this->layout->view('users/extra_permission', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'user', 'refresh');
        }
    }

}
