<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class states extends CI_Controller
{
    
    var $session_data;
    
    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('state'));
        $this->session_data = $this->session->userdata('user_session');
    }
    
    function viewState() {
        $this->layout->view('states/view');
    }
    
    function addState() {
        if ($this->input->post() !== false) {
            $c = new State();
            $c->country_id = $this->input->post('country_id');
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
            redirect(base_url() . 'state', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('add') . ' ' . $this->lang->line('state'));
            $country = new Country();
            $data['countries'] = $country->get();
            $this->layout->view('states/add', $data);
        }
    }
    
    function editState($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $c = new State();
                $c->where('id', $id)->get();
                $c->country_id = $this->input->post('country_id');
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
                redirect(base_url() . 'state', 'refresh');
            } else {
                $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('state'));
                $states = new State();
                $data['states'] = $states->where('id', $id)->get();
                
                $country = new Country();
                $data['countries'] = $country->get();
                
                $this->layout->view('states/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'state', 'refresh');
        }
    }
    
    function deleteState($id) {
        if (!empty($id)) {
            $c = new State();
            $c->where('id', $id)->get();
            $c->City->delete_all();
            $c->delete();
            $this->session->set_flashdata('success', $this->lang->line('delete_data_success'));
            redirect(base_url() . 'state', 'refresh');
        } else {
            $this->session->set_flashdata('error', $this->lang->line('delete_data_error'));
            redirect(base_url() . 'state', 'refresh');
        }
    }
}
