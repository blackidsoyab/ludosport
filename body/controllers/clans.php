<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class clans extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('clan'));
        $this->session_data = $this->session->userdata('user_session');
    }

    function viewClan($id = null) {
        if (is_null($id)) {
            $this->layout->view('clans/view');
        } else {
            $obj = new Clan();
            $data['clan'] = $obj->where('id', $id)->get();
            $this->layout->view('clans/view_single', $data);
        }
    }

    function addClan() {
        if ($this->input->post() !== false) {
            $obj = new Clan();
            foreach ($this->config->item('custom_languages') as $key => $value) {
                $temp = $key . '_class_name';
                if ($this->input->post($temp) != '') {
                    $obj->$temp = $this->input->post($temp);
                } else {
                    $obj->$temp = $this->input->post('en_class_name');
                }
            }

            $obj->academy_id = $this->input->post('academy_id');
            $obj->school_id = $this->input->post('school_id');
            $obj->teacher_id = implode(',', $this->input->post('teacher_id'));
            $obj->level_id = $this->input->post('level_id');
            $obj->lesson_day = implode(',', $this->input->post('lesson_day'));
            $obj->lesson_from = strtotime($this->input->post('lesson_from'));
            $obj->lesson_to = strtotime($this->input->post('lesson_to'));

            if ($this->input->post('same_addresss') != '1') {
                $obj->same_address = 0;
                $obj->address = $this->input->post('address');
                $obj->postal_code = $this->input->post('postal_code');
                $obj->city_id = $this->input->post('city_id');
                $obj->state_id = $this->input->post('state_id');
                $obj->country_id = $this->input->post('country_id');
                $obj->phone_1 = $this->input->post('phone_1');
                $obj->phone_2 = @$this->input->post('phone_2');
                $obj->email = $this->input->post('email');
            } else {
                $school = new School();
                $school->where('id', $this->input->post('school_id'))->get();
                $obj->same_address = 1;
                $obj->address = $school->address;
                $obj->postal_code = $school->postal_code;
                $obj->city_id = $school->city_id;
                $obj->state_id = $school->state_id;
                $obj->country_id = $school->country_id;
                $obj->phone_1 = $school->phone_1;
                $obj->phone_2 = $school->phone_2;
                $obj->email = $school->email;
            }

            $obj->user_id = $this->session_data->id;
            $obj->save();

            $this->session->set_flashdata('success', $this->lang->line('add_data_success'));
            redirect(base_url() . 'clan', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('add') . ' ' . $this->lang->line('clan'));

            $users = New User();
            $data['users'] = $users->getUsersByRole(5);

            $countries = New Country();
            $data['countries'] = $countries->get();

            $level = New Level();
            $data['levels'] = $level->get();

            $academy = New Academy();
            if ($this->session_data->role == '1' || $this->session_data->role == '2') {
                $data['academies'] = $academy->get();
            } else {
                $data['academies'] = $academy->where('rector_id', $this->session_data->id)->get();
            }


            $this->layout->view('clans/add', $data);
        }
    }

    function editClan($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $obj = new Clan();
                $obj->where('id', $id)->get();
                foreach ($this->config->item('custom_languages') as $key => $value) {
                    $temp = $key . '_class_name';
                    if ($this->input->post($temp) != '') {
                        $obj->$temp = $this->input->post($temp);
                    } else {
                        $obj->$temp = $this->input->post('en_class_name');
                    }
                }

                $obj->academy_id = $this->input->post('academy_id');
                $obj->school_id = $this->input->post('school_id');
                $obj->teacher_id = implode(',', $this->input->post('teacher_id'));
                $obj->level_id = $this->input->post('level_id');
                $obj->lesson_day = implode(',', $this->input->post('lesson_day'));
                $obj->lesson_from = strtotime($this->input->post('lesson_from'));
                $obj->lesson_to = strtotime($this->input->post('lesson_to'));

                if ($this->input->post('same_addresss') != '1') {
                    $obj->same_address = 0;
                    $obj->address = $this->input->post('address');
                    $obj->postal_code = $this->input->post('postal_code');
                    $obj->city_id = $this->input->post('city_id');
                    $obj->state_id = $this->input->post('state_id');
                    $obj->country_id = $this->input->post('country_id');
                    $obj->phone_1 = $this->input->post('phone_1');
                    $obj->phone_2 = @$this->input->post('phone_2');
                    $obj->email = $this->input->post('email');
                } else {
                    $school = new School();
                    $school->where('id', $this->input->post('school_id'))->get();
                    $obj->same_address = 1;
                    $obj->address = $school->address;
                    $obj->postal_code = $school->postal_code;
                    $obj->city_id = $school->city_id;
                    $obj->state_id = $school->state_id;
                    $obj->country_id = $school->country_id;
                    $obj->phone_1 = $school->phone_1;
                    $obj->phone_2 = $school->phone_2;
                    $obj->email = $school->email;
                }

                $obj->user_id = $this->session_data->id;
                $obj->save();

                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'clan', 'refresh');
            } else {
                $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('clan'));

                $obj = new Clan();
                $data['clan'] = $obj->where('id', $id)->get();

                $users = New User();
                $data['users'] = $users->getUsersByRole(5);

                $academy = New Academy();
                if ($this->session_data->role == '1' || $this->session_data->role == '2') {
                    $data['academies'] = $academy->get();
                } else {
                    $data['academies'] = $academy->where('rector_id', $this->session_data->id)->get();
                }

                $school = new School();
                $data['schools'] = $school->where('academy_id', $obj->academy_id)->get();

                $countries = New Country();
                $data['countries'] = $countries->get();

                $states = New State();
                $data['states'] = $states->where('country_id', $obj->country_id)->get();

                $cities = New City();
                $data['cities'] = $cities->where('state_id', $obj->state_id)->get();

                $level = New Level();
                $data['levels'] = $level->get();

                $this->layout->view('clans/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'clan', 'refresh');
        }
    }

    function deleteClan($id) {
        if (!empty($id)) {
            $clan = new Clan();
            $clan->where('id', $id)->get();
            /* foreach ($clan->School as $user) {
              $user->User_details->delete_all();
              }
              $clan->School->delete_all(); */
            $clan->delete();

            $this->session->set_flashdata('success', $this->lang->line('delete_data_success'));
            redirect(base_url() . 'clan', 'refresh');
        } else {
            $this->session->set_flashdata('error', $this->lang->line('delete_data_error'));
            redirect(base_url() . 'clan', 'refresh');
        }
    }

    function clanTeacherList() {
        $this->layout->setField('page_title', $this->lang->line('list') . ' ' . $this->lang->line('teachers'));
        $this->layout->view('clans/teacher_list');
    }

}
