<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class eventcategories extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('eventcategory'));
        $this->session_data = $this->session->userdata('user_session');
    }

    function viewEventcategory() {
        $this->layout->view('eventcategories/view');
    }

    function addEventcategory() {
        if ($this->input->post() !== false) {
            $eventcategory = new Eventcategory();
            foreach ($this->config->item('custom_languages') as $key => $value) {
                $temp = $key . '_name';
                if ($this->input->post($temp) != '') {
                    $eventcategory->$temp = $this->input->post($temp);
                } else {
                    $eventcategory->$temp = $this->input->post('en_name');
                }
            }

            if($this->input->post('has_point') == 1){
                $eventcategory->has_point = 1;
                $eventcategory->xpr = $this->input->post('xpr');
                $eventcategory->war = $this->input->post('war');
                $eventcategory->sty = $this->input->post('sty');
            }else{
                $eventcategory->has_point = 0;
                $eventcategory->xpr = 0;
                $eventcategory->war = 0;
                $eventcategory->sty = 0;
            }

            $eventcategory->user_id = $this->session_data->id;
            $eventcategory->save();
            $this->session->set_flashdata('success', $this->lang->line('add_data_success'));
            redirect(base_url() . 'eventcategory', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('add') . ' ' . $this->lang->line('eventcategory'));
            $this->layout->view('eventcategories/add');
        }
    }

    function editEventcategory($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $eventcategory = new Eventcategory();
                $eventcategory->where('id', $id)->get();
                foreach ($this->config->item('custom_languages') as $key => $value) {
                    $temp = $key . '_name';
                    if ($this->input->post($temp) != '') {
                        $eventcategory->$temp = $this->input->post($temp);
                    } else {
                        $eventcategory->$temp = $this->input->post('en_name');
                    }
                }

                if($this->input->post('has_point') == 1){
                    $eventcategory->has_point = 1;
                    $eventcategory->xpr = $this->input->post('xpr');
                    $eventcategory->war = $this->input->post('war');
                    $eventcategory->sty = $this->input->post('sty');
                }else{
                    $eventcategory->has_point = 0;
                    $eventcategory->xpr = 0;
                    $eventcategory->war = 0;
                    $eventcategory->sty = 0;
                }
                
                $eventcategory->user_id = $this->session_data->id;
                $eventcategory->save();
                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'eventcategory', 'refresh');
            } else {
                $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('eventcategory'));
                $eventcategories = new Eventcategory();
                $data['eventcategory'] = $eventcategories->where('id', $id)->get();

                $this->layout->view('eventcategories/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'eventcategory', 'refresh');
        }
    }

    function deleteEventcategory($id) {
        if (!empty($id)) {
            $c = new Eventcategory();
            $c->where('id', $id)->get();
            $c->delete();
            $this->session->set_flashdata('success', $this->lang->line('delete_data_success'));
            redirect(base_url() . 'eventcategory', 'refresh');
        } else {
            $this->session->set_flashdata('error', $this->lang->line('delete_data_error'));
            redirect(base_url() . 'eventcategory', 'refresh');
        }
    }

}
