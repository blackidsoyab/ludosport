<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class countries extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', 'Manage Countries');
    }

    function viewcountry() {
        $this->layout->view('countries/view');
    }

    function addcountry() {
        if ($this->input->post() !== false) {
            $c = new Country();
            $c->en_name = $this->input->post('en_name');
            $c->it_name = ($this->input->post('it_name') == '') ? $this->input->post('en_name') : $this->input->post('it_name');
            $c->user_id = '1';
            $c->save();
            $this->session->set_flashdata('success', 'Country Added Successfully');
            redirect(base_url() . 'country', 'refresh');
        } else {
            $this->layout->view('countries/add');
        }
    }

    function editcountry($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $c = new Country();
                $c->where('id', $id)->get();
                $c->en_name = $this->input->post('en_name');
                $c->it_name = ($this->input->post('it_name') == '') ? $this->input->post('en_name') : $this->input->post('it_name');
                $c->user_id = '1';
                $c->save();
                $this->session->set_flashdata('success', 'Country Updated Successfully');
                redirect(base_url() . 'country', 'refresh');
            } else {
                $country = new Country();
                $data['country'] = $country->where('id', $id)->get();
                $this->layout->view('countries/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', 'Not able to Edit Country');
            redirect(base_url() . 'country', 'refresh');
        }
    }

    function deletecountry($id) {
        if (!empty($id)) {
            $c = new Country();
            $c->where('id', $id)->get();
            $c->delete();
            $this->session->set_flashdata('success', 'Country Deleted Successfully');
            redirect(base_url() . 'country', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Not able to delete Country');
            redirect(base_url() . 'country', 'refresh');
        }
    }

}
