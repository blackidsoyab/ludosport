<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class countries extends CI_Controller {

    var $session;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('country'));
        $this->session = $this->session->userdata('user_session');
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
            $c->user_id = $this->session->id;
            $c->save();
            $this->session->set_flashdata('success', $this->lang->line('add_data_success'));
            redirect(base_url() . 'country', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('add') . ' ' . $this->lang->line('country'));
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
                $c->user_id = $this->session->id;
                $c->save();
                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'country', 'refresh');
            } else {
                $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('country'));
                $country = new Country();
                $data['country'] = $country->where('id', $id)->get();
                $this->layout->view('countries/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
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
            $this->session->set_flashdata('success', $this->lang->line('delete_data_success'));
            redirect(base_url() . 'country', 'refresh');
        } else {
            $this->session->set_flashdata('error', $this->lang->line('delete_data_error'));
            redirect(base_url() . 'country', 'refresh');
        }
    }

}
