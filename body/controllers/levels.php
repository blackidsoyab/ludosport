<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class levels extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('level'));
        $this->session_data = $this->session->userdata('user_session');
    }

    function viewLevel() {
        $this->layout->view('levels/view');
    }

    function addLevel() {
        if ($this->input->post() !== false) {
            $level = new Level();
            foreach ($this->config->item('custom_languages') as $key => $value) {
                $temp = $key . '_level_name';
                if ($this->input->post($temp) != '') {
                    $level->$temp = $this->input->post($temp);
                } else {
                    $level->$temp = $this->input->post('en_level_name');
                }
            }

            if ($this->input->post('is_basic') == '1') {
                $level->is_basic = '1';
            } else {
                $level->is_basic = '0';
            }

            if ($this->input->post('under_sixteen') == '1') {
                $level->under_sixteen = '1';
            } else {
                $level->under_sixteen = '0';
            }

            $level->user_id = $this->session_data->id;
            $level->save();
            $this->session->set_flashdata('success', $this->lang->line('add_data_success'));
            redirect(base_url() . 'level', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('add') . ' ' . $this->lang->line('level'));
            $this->layout->view('levels/add');
        }
    }

    function editLevel($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $level = new Level();
                $level->where('id', $id)->get();
                $level->country_id = $this->input->post('country_id');
                foreach ($this->config->item('custom_languages') as $key => $value) {
                    $temp = $key . '_level_name';
                    if ($this->input->post($temp) != '') {
                        $level->$temp = $this->input->post($temp);
                    } else {
                        $level->$temp = $this->input->post('en_level_name');
                    }
                }

                if ($this->input->post('is_basic') == '1') {
                    $level->is_basic = '1';
                } else {
                    $level->is_basic = '0';
                }

                if ($this->input->post('under_sixteen') == '1') {
                    $level->under_sixteen = '1';
                } else {
                    $level->under_sixteen = '0';
                }

                $level->user_id = $this->session_data->id;
                $level->save();

                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'level', 'refresh');
            } else {
                $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('level'));
                $levels = new Level();
                $data['level'] = $levels->where('id', $id)->get();

                $this->layout->view('levels/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'level', 'refresh');
        }
    }

    function deleteLevel($id) {
        if (!empty($id)) {
            $c = new Level();
            $c->where('id', $id)->get();
            $c->delete();
            $this->session->set_flashdata('success', $this->lang->line('delete_data_success'));
            redirect(base_url() . 'level', 'refresh');
        } else {
            $this->session->set_flashdata('error', $this->lang->line('delete_data_error'));
            redirect(base_url() . 'level', 'refresh');
        }
    }

}
