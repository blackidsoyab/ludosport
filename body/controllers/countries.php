<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class countries extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', 'Manage Countries');
    }

    function viewCountry() {
        $this->layout->view('countries/view');
    }

    function addCountry() {
        if ($this->input->post() !== false) {
            $c = new Country();
            foreach ($this->config->item('custom_languages') as $key => $value) {
                $temp = $key . '_name';
                $c->$temp = $this->input->post($temp);
            }
            $c->user_id = '1';
            $c->save();
            $this->session->set_flashdata('success', 'Country Added Successfully');
            redirect(base_url() . 'country', 'refresh');
        } else {
            $this->layout->setField('page_title', 'Add Country');
            $this->layout->view('countries/add');
        }
    }

    function editCountry($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $c = new Country();
                $c->where('id', $id)->get();
                foreach ($this->config->item('custom_languages') as $key => $value) {
                    $temp = $key . '_name';
                    $c->$temp = $this->input->post($temp);
                }
                $c->user_id = '1';
                $c->save();
                $this->session->set_flashdata('success', 'Country Updated Successfully');
                redirect(base_url() . 'country', 'refresh');
            } else {
                $this->layout->setField('page_title', 'Edit Country');
                $country = new Country();
                $data['country'] = $country->where('id', $id)->get();
                $this->layout->view('countries/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', 'Not able to Edit Country');
            redirect(base_url() . 'country', 'refresh');
        }
    }

    function deleteCountry($id) {
        if (!empty($id)) {
            $c = new Country();
            $c->where('id', $id)->get();
            foreach ($c->State as $v) {
                $v->City->delete_all();
            }
            $c->State->delete_all();
            $c->delete();
            $this->session->set_flashdata('success', 'Country Deleted Successfully');
            redirect(base_url() . 'country', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Not able to delete Country');
            redirect(base_url() . 'country', 'refresh');
        }
    }

}
