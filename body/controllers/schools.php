<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class schools extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('school'));
        $this->session_data = $this->session->userdata('user_session');
    }

    function viewSchool() {
        $this->layout->view('schools/view');
    }

    function addSchool() {
        if ($this->input->post() !== false) {
            $obj = new School();
            foreach ($this->config->item('custom_languages') as $key => $value) {
                $temp = $key . '_school_name';
                if ($this->input->post($temp) != '') {
                    $obj->$temp = $this->input->post($temp);
                } else {
                    $obj->$temp = $this->input->post('en_school_name');
                }
            }

            $obj->academy_id = $this->input->post('academy_id');
            $obj->principal_id = $this->input->post('principal_id');
            $obj->range = @$this->input->post('range');
            $obj->postal_code = $this->input->post('postal_code');
            $obj->city_id = $this->input->post('city_id');
            $obj->address = $this->input->post('address');
            $obj->mobile = $this->input->post('mobile');
            $obj->phone = @$this->input->post('phone');
            $obj->email = $this->input->post('email');
            $obj->information = $this->input->post('information');
            $obj->user_id = $this->session_data->id;
            $obj->save();

            $this->session->set_flashdata('success', $this->lang->line('add_data_success'));
            redirect(base_url() . 'school', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('add') . ' ' . $this->lang->line('school'));

            $academy = New Academy();
            $data['academies'] = $academy->get();

            $users = New User();
            $data['principals'] = $users->where('id', '4')->get();

            $city = New City();
            $data['cities'] = $city->get();


            $this->layout->view('schools/add', $data);
        }
    }

    function editSchool($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $obj = new School();
                $obj->where('id', $id)->get();
                foreach ($this->config->item('custom_languages') as $key => $value) {
                    $temp = $key . '_school_name';
                    if ($this->input->post($temp) != '') {
                        $obj->$temp = $this->input->post($temp);
                    } else {
                        $obj->$temp = $this->input->post('en_school_name');
                    }
                }

                $obj->academy_id = $this->input->post('academy_id');
                $obj->principal_id = $this->input->post('principal_id');
                $obj->range = @$this->input->post('range');
                $obj->postal_code = $this->input->post('postal_code');
                $obj->city_id = $this->input->post('city_id');
                $obj->address = $this->input->post('address');
                $obj->mobile = $this->input->post('mobile');
                $obj->phone = @$this->input->post('phone');
                $obj->email = $this->input->post('email');
                $obj->information = $this->input->post('information');
                $obj->user_id = $this->session_data->id;
                $obj->save();

                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'school', 'refresh');
            } else {
                $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('school'));

                $obj = new School();
                $data['school'] = $obj->where('id', $id)->get();

                $academy = New Academy();
                $data['academies'] = $academy->get();

                $users = New User();
                $data['principals'] = $users->where('id', '4')->get();

                $city = New City();
                $data['cities'] = $city->get();

                $this->layout->view('schools/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'school', 'refresh');
        }
    }

    function deleteSchool($id) {
        if (!empty($id)) {
            $school = new School();
            $school->where('id', $id)->get();
            /* foreach ($school->School as $user) {
              $user->User_details->delete_all();
              }
             */
            $school->delete();

            $this->session->set_flashdata('success', $this->lang->line('delete_data_success'));
            redirect(base_url() . 'school', 'refresh');
        } else {
            $this->session->set_flashdata('error', $this->lang->line('delete_data_error'));
            redirect(base_url() . 'school', 'refresh');
        }
    }

}
