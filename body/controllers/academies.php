<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class academies extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('academy'));
        $this->session_data = $this->session->userdata('user_session');
    }

    function viewAcademy() {
        $this->layout->view('academies/view');
    }

    function addAcademy() {
        if ($this->input->post() !== false) {
            $obj = new Academy();
            foreach ($this->config->item('custom_languages') as $key => $value) {
                $temp = $key . '_academy_name';
                if ($this->input->post($temp) != '') {
                    $obj->$temp = $this->input->post($temp);
                } else {
                    $obj->$temp = $this->input->post('en_academy_name');
                }
            }

            $obj->dean_id = $this->input->post('dean_id');
            $obj->type = $this->input->post('type');
            $obj->contact_firstname = $this->input->post('contact_firstname');
            $obj->contact_lastname = $this->input->post('contact_lastname');
            $obj->association_fullname = $this->input->post('association_fullname');
            $obj->address = $this->input->post('address');
            $obj->postal_code = $this->input->post('postal_code');
            $obj->city_id = $this->input->post('city_id');
            $obj->state_id = $this->input->post('state_id');
            $obj->country_id = $this->input->post('country_id');
            $obj->phone_1 = $this->input->post('phone_1');
            $obj->phone_2 = @$this->input->post('phone_2');
            $obj->email = @$this->input->post('email');
            $obj->user_id = $this->session_data->id;
            $obj->save();

            $this->session->set_flashdata('success', $this->lang->line('add_data_success'));
            redirect(base_url() . 'academy', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('add') . ' ' . $this->lang->line('academy'));

            $countries = New Country();
            $data['countries'] = $countries->get();

            $users = New User();
            $data['deans'] = $users->where('id', '3')->get();

            $this->layout->view('academies/add', $data);
        }
    }

    function editAcademy($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $obj = new Academy();
                $obj->where('id', $id)->get();
                foreach ($this->config->item('custom_languages') as $key => $value) {
                    $temp = $key . '_academy_name';
                    if ($this->input->post($temp) != '') {
                        $obj->$temp = $this->input->post($temp);
                    } else {
                        $obj->$temp = $this->input->post('en_academy_name');
                    }
                }

                $obj->dean_id = $this->input->post('dean_id');
                $obj->type = $this->input->post('type');
                $obj->contact_firstname = $this->input->post('contact_firstname');
                $obj->contact_lastname = $this->input->post('contact_lastname');
                $obj->association_fullname = $this->input->post('association_fullname');
                $obj->address = $this->input->post('address');
                $obj->postal_code = $this->input->post('postal_code');
                $obj->city_id = $this->input->post('city_id');
                $obj->state_id = $this->input->post('state_id');
                $obj->country_id = $this->input->post('country_id');
                $obj->phone_1 = $this->input->post('phone_1');
                $obj->phone_2 = @$this->input->post('phone_2');
                $obj->email = @$this->input->post('email');
                $obj->user_id = $this->session_data->id;
                $obj->save();

                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'academy', 'refresh');
            } else {
                $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('academy'));

                $obj = new Academy();
                $data['academy'] = $obj->where('id', $id)->get();

                $countries = New Country();
                $data['countries'] = $countries->get();

                $users = New User();
                $data['deans'] = $users->where('id', '3')->get();

                $states = New State();
                $data['states'] = $states->where('country_id', $obj->country_id)->get();

                $cities = New City();
                $data['cities'] = $cities->where('state_id', $obj->state_id)->get();

                $this->layout->view('academies/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'academy', 'refresh');
        }
    }

    function deleteAcademy($id) {
        if (!empty($id)) {
            $academy = new Academy();
            $academy->where('id', $id)->get();
            /* foreach ($academy->School as $user) {
              $user->User_details->delete_all();
              }
              $academy->School->delete_all(); */
            $academy->delete();

            $this->session->set_flashdata('success', $this->lang->line('delete_data_success'));
            redirect(base_url() . 'academy', 'refresh');
        } else {
            $this->session->set_flashdata('error', $this->lang->line('delete_data_error'));
            redirect(base_url() . 'academy', 'refresh');
        }
    }

}
