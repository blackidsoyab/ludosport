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

    function viewUser($id = null, $type = null) {
        $role = new Role();
        $data['roles'] = $role->where('id >', $this->session_data->role)->get();

        if (is_null($id)) {
            $this->layout->view('users/view', $data);
        } else if (!is_null($id) && $type == "list_user_role_wise") {
            $data['role_id'] = $id;
            $this->layout->view('users/view', $data);
        } else {
            if ($type == 'notification') {
                Notification::updateNotification('user_register', $this->session_data->id, $id);
            }

            $obj = new User();
            $data['user'] = $obj->where('id', $id)->get();
            $this->layout->view('users/view_single', $data);
        }
    }

    function addUser() {
        if ($this->input->post() !== false) {
            $user = new User();

            $user->firstname = $this->input->post('firstname');
            $user->lastname = $this->input->post('lastname');
            $user->email = $this->input->post('email');
            $user->date_of_birth = strtotime(date('Y-m-d', strtotime($this->input->post('date_of_birth'))));
            $user->city_id = $this->input->post('city_id');
            $city = new City();
            $city->where('id', $this->input->post('city_id'))->get();
            $user->state_id = $city->state->id;
            $user->country_id = $city->state->country->id;
            $user->role_id = implode(',', $this->input->post('role_id'));
            $user->username = $this->input->post('username');
            $user->password = md5($this->input->post('new_password'));
            $user->status = $this->input->post('status');
            $user->user_id = $this->session_data->id;
            $user->save();

            if (in_array('6', $this->input->post('role_id'))) {
                $user_details = new Userdetail();
                $user_details->student_master_id = $user->id;
                $user_details->clan_id = $this->input->post('class_id');
                $user_details->user_id = $this->session_data->id;
                $user_details->save();
            }

            $this->session->set_flashdata('success', $this->lang->line('add_data_success'));
            redirect(base_url() . 'user', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('add') . ' ' . $this->lang->line('user'));

            $city = new City();
            $data['cities'] = $city->get();

            $role = new Role();
            $data['roles'] = $role->where('id >', $this->session_data->id)->get();

            $academy = New Academy();
            if ($this->session_data->role == '1' || $this->session_data->role == '2') {
                $data['academies'] = $academy->get();
            } else {
                $data['academies'] = $academy->getAcademyOfRector($this->session_data->id);
            }

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
                $user->date_of_birth = strtotime(date('Y-m-d', strtotime($this->input->post('date_of_birth'))));
                $user->city_id = $this->input->post('city_id');
                $city = new City();
                $city->where('id', $this->input->post('city_id'))->get();
                $user->state_id = $city->state->id;
                $user->country_id = $city->state->country->id;
                $user->role_id = implode(',', $this->input->post('role_id'));

                if ($this->input->post('username') != '') {
                    $user->username = $this->input->post('username');
                }

                if ($this->input->post('new_password') != '') {
                    $user->password = md5($this->input->post('new_password'));
                }
                $user->status = $this->input->post('status');
                $user->user_id = $this->session_data->id;

                $user->save();
                if (in_array('6', $this->input->post('role_id'))) {
                    $user_details = new Userdetail();
                    $user_details->where('student_master_id', $id)->get();
                    $user_details->student_master_id = $user->id;
                    $user_details->clan_id = $this->input->post('class_id');
                    $user_details->user_id = $this->session_data->id;
                    $user_details->save();
                } else {
                    $user_details = new Userdetail();
                    $user_details->where('student_master_id', $id)->get();
                    $user_details->delete();
                }

                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'user', 'refresh');
            } else {
                $user = new User();
                $data['user'] = $user->where('id', $id)->get();
                if ($user->role_id <= $this->session_data->role) {
                    $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
                    redirect(base_url() . 'user', 'refresh');
                } else {
                    $this->layout->setField('page_title', 'Edit User');

                    $userdetail = new Userdetail();
                    $data['userdetail'] = $userdetail->where('student_master_id', $id)->get();

                    $school = new School();
                    $school->where('id', $userdetail->school_id)->get();
                    $data['schools'] = $school->where('academy_id', $school->academy_id)->get();
                    $data['academy_id'] = $school->academy_id;

                    $class = new Clan();
                    $class->where('id', $userdetail->clan_id)->get();
                    $data['classes'] = $class->where('school_id', $class->school_id)->get();

                    $city = new City();
                    $data['cities'] = $city->get();

                    $role = new Role();
                    $data['roles'] = $role->where_not_in('id', array(1))->get();

                    $academy = New Academy();
                    if ($this->session_data->role == '1' || $this->session_data->role == '2') {
                        $data['academies'] = $academy->get();
                    } else {
                        $data['academies'] = $academy->getAcademyOfRector($this->session_data->id);
                    }

                    $this->layout->view('users/edit', $data);
                }
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
