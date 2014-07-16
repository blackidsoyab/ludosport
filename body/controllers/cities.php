<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class cities extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', 'Manage Cities');
    }

    function viewcity() {
        $this->layout->view('cities/view');
    }

    function addcity() {
        if ($this->input->post() !== false) {
            $c = new City();
            $c->state_id = $this->input->post('state_id');
            $c->en_name = $this->input->post('en_name');
            $c->it_name = ($this->input->post('it_name') == '') ? $this->input->post('en_name') : $this->input->post('it_name');
            $c->user_id = '1';
            $c->save();
            $this->session->set_flashdata('success', 'City Added Successfully');
            redirect(base_url() . 'city', 'refresh');
        } else {
            $this->layout->setField('page_title', 'Add City');
            $states = new State();
            $data['states'] = $states->get();
            $this->layout->view('cities/add', $data);
        }
    }

    function editcity($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $c = new City();
                $c->where('id', $id)->get();
                $c->state_id = $this->input->post('state_id');
                $c->en_name = $this->input->post('en_name');
                $c->it_name = ($this->input->post('it_name') == '') ? $this->input->post('en_name') : $this->input->post('it_name');
                $c->user_id = '1';
                $c->save();
                $this->session->set_flashdata('success', 'City Updated Successfully');
                redirect(base_url() . 'city', 'refresh');
            } else {
                $this->layout->setField('page_title', 'Edit City');
                $city = new City();
                $data['city'] = $city->where('id', $id)->get();

                $states = new State();
                $data['states'] = $states->get();

                $this->layout->view('cities/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', 'Not able to Edit City');
            redirect(base_url() . 'city', 'refresh');
        }
    }

    function deltecity($id) {
        if (!empty($id)) {
            $c = new City();
            $c->where('id', $id)->get();
            $c->delete();
            $this->session->set_flashdata('success', 'City Deleted Successfully');
            redirect(base_url() . 'city', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Not able to delete City');
            redirect(base_url() . 'city', 'refresh');
        }
    }

}
