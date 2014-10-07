<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class cities extends CI_Controller
{
    
    var $session_data;
    
    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('city'));
        $this->session_data = $this->session->userdata('user_session');
    }
    
    function viewCity() {
        $this->layout->view('cities/view');
    }
    
    function addCity() {
        if ($this->input->post() !== false) {
            $c = new City();
            $c->state_id = $this->input->post('state_id');
            foreach ($this->config->item('custom_languages') as $key => $value) {
                $temp = $key . '_name';
                if ($this->input->post($temp) != '') {
                    $c->$temp = $this->input->post($temp);
                } else {
                    $c->$temp = $this->input->post('en_name');
                }
            }
            $c->user_id = $this->session_data->id;
            $c->save();
            $this->session->set_flashdata('success', $this->lang->line('add_data_success'));
            redirect(base_url() . 'city', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('add') . ' ' . $this->lang->line('city'));
            $states = new State();
            $data['states'] = $states->get();
            $this->layout->view('cities/add', $data);
        }
    }
    
    function editCity($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $c = new City();
                $c->where('id', $id)->get();
                $c->state_id = $this->input->post('state_id');
                foreach ($this->config->item('custom_languages') as $key => $value) {
                    $temp = $key . '_name';
                    if ($this->input->post($temp) != '') {
                        $c->$temp = $this->input->post($temp);
                    } else {
                        $c->$temp = $this->input->post('en_name');
                    }
                }
                $c->user_id = $this->session_data->id;
                $c->save();
                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'city', 'refresh');
            } else {
                $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('city'));
                $city = new City();
                $data['city'] = $city->where('id', $id)->get();
                
                $states = new State();
                $data['states'] = $states->get();
                
                $this->layout->view('cities/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'city', 'refresh');
        }
    }
    
    function deleteCity($id) {
        if (!empty($id)) {
            $c = new City();
            $c->where('id', $id)->get();
            $c->delete();
            $this->session->set_flashdata('success', $this->lang->line('delete_data_success'));
            redirect(base_url() . 'city', 'refresh');
        } else {
            $this->session->set_flashdata('error', $this->lang->line('delete_data_error'));
            redirect(base_url() . 'city', 'refresh');
        }
    }
}
