<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class states extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', 'Manage States');
    }

    function viewstates() {
        $this->layout->view('states/view');
    }

    function addstates() {
        if ($this->input->post() !== false) {
            $c = new State();
            $c->country_id = $this->input->post('country_id');
            foreach ($this->config->item('custom_languages') as $key => $value) {
                $temp = $key . '_name';
                $c->$temp = $this->input->post($temp);
            }
            $c->user_id = '1';
            $c->save();
            $this->session->set_flashdata('success', 'State Added Successfully');
            redirect(base_url() . 'states', 'refresh');
        } else {
            $this->layout->setField('page_title', 'Add State');
            $country = new Country();
            $data['countries'] = $country->get();
            $this->layout->view('states/add', $data);
        }
    }

    function editstates($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $c = new State();
                $c->where('id', $id)->get();
                $c->country_id = $this->input->post('country_id');
                foreach ($this->config->item('custom_languages') as $key => $value) {
                    $temp = $key . '_name';
                    $c->$temp = $this->input->post($temp);
                }
                $c->user_id = '1';
                $c->save();
                $this->session->set_flashdata('success', 'State Updated Successfully');
                redirect(base_url() . 'states', 'refresh');
            } else {
                $this->layout->setField('page_title', 'Edit State');
                $states = new State();
                $data['states'] = $states->where('id', $id)->get();

                $country = new Country();
                $data['countries'] = $country->get();

                $this->layout->view('states/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', 'Not able to Edit State');
            redirect(base_url() . 'states', 'refresh');
        }
    }

    function deletestates($id) {
        if (!empty($id)) {
            $c = new State();
            $c->where('id', $id)->get();
            $c->delete();
            $this->session->set_flashdata('success', 'State Deleted Successfully');
            redirect(base_url() . 'states', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Not able to delete State');
            redirect(base_url() . 'states', 'refresh');
        }
    }

}
