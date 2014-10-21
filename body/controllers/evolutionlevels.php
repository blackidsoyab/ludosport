<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class evolutionlevels extends CI_Controller
{
    
    var $session_data;
    
    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('evolutionlevel'));
        $this->session_data = $this->session->userdata('user_session');
    }
    
    function viewEvolutionlevel() {
        $this->layout->view('evolutionlevels/view');
    }
    
    function addEvolutionlevel() {
        if ($this->input->post() !== false) {
            $evolutionlevel = new Evolutionlevel();
            foreach ($this->config->item('custom_languages') as $key => $value) {
                $temp = $key . '_name';
                if ($this->input->post($temp) != '') {
                    $evolutionlevel->$temp = $this->input->post($temp);
                } else {
                    $evolutionlevel->$temp = $this->input->post('en_name');
                }
            }
            $evolutionlevel->evolutioncategory_id = $this->input->post('evolutioncategory_id');
            if($this->input->post('on_passing') != 0){
                $obj_evolutionlevel = new Evolutionlevel($this->input->post('on_passing'));
                $evolutionlevel->depth = (int)$obj_evolutionlevel->depth + 1;
            }else{
                $evolutionlevel->depth = 0;
            }
            $evolutionlevel->on_passing = $this->input->post('on_passing');
            $evolutionlevel->user_id = $this->session_data->id;
            $evolutionlevel->save();
            $this->session->set_flashdata('success', $this->lang->line('add_data_success'));
            redirect(base_url() . 'evolutionlevel', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('add') . ' ' . $this->lang->line('evolutionlevel'));

            $obj_evolutioncategory = new Evolutioncategory();
            $data['evolution_categories'] = $obj_evolutioncategory->get();

            $obj_evolutionlevel = new Evolutionlevel();
            $data['evolution_levels'] = $obj_evolutionlevel->get();

            $this->layout->view('evolutionlevels/add', $data);
        }
    }
    
    function editEvolutionlevel($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $evolutionlevel = new Evolutionlevel();
                $evolutionlevel->where('id', $id)->get();
                foreach ($this->config->item('custom_languages') as $key => $value) {
                    $temp = $key . '_name';
                    if ($this->input->post($temp) != '') {
                        $evolutionlevel->$temp = $this->input->post($temp);
                    } else {
                        $evolutionlevel->$temp = $this->input->post('en_name');
                    }
                }
                $evolutionlevel->evolutioncategory_id = $this->input->post('evolutioncategory_id');
                if($this->input->post('on_passing') != 0){
                    $obj_evolutionlevel = new Evolutionlevel($this->input->post('on_passing'));
                    $evolutionlevel->depth = (int)$obj_evolutionlevel->depth + 1;
                }else{
                    $evolutionlevel->depth = 0;
                }
                $evolutionlevel->on_passing = $this->input->post('on_passing');            
                $evolutionlevel->user_id = $this->session_data->id;
                $evolutionlevel->save();
                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'evolutionlevel', 'refresh');
            } else {
                $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('evolutionlevel'));
                
                $evolutionlevels = new Evolutionlevel();
                $data['evolutionlevel'] = $evolutionlevels->where('id', $id)->get();

                $obj_evolutioncategory = new Evolutioncategory();
                $data['evolution_categories'] = $obj_evolutioncategory->get();

                $obj_evolutionlevel = new Evolutionlevel();
                $data['evolution_levels'] = $obj_evolutionlevel->get();
                
                $this->layout->view('evolutionlevels/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'evolutionlevel', 'refresh');
        }
    }
    
    function deleteEvolutionlevel($id) {
        if (!empty($id)) {
            $obj = new Evolutionlevel();
            $obj->where('id', $id)->get();
            $obj->delete();
            $this->session->set_flashdata('success', $this->lang->line('delete_data_success'));
            redirect(base_url() . 'evolutionlevel', 'refresh');
        } else {
            $this->session->set_flashdata('error', $this->lang->line('delete_data_error'));
            redirect(base_url() . 'evolutionlevel', 'refresh');
        }
    }
}
