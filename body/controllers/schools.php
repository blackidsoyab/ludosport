<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class schools extends CI_Controller
{
    
    var $session_data;
    
    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('school'));
        $this->session_data = $this->session->userdata('user_session');
    }
    
    function viewSchool($id = null, $type = null) {
        $academy = new Academy();
        if ($this->session_data->role == '1' || $this->session_data->role == '2') {
            $data['academies'] = $academy->get();
        } else if ($this->session_data->role == '3') {
            $data['academies'] = $academy->getAcademyOfRector($this->session_data->id);
        } else if ($this->session_data->role == '4') {
            $data['academies'] = $academy->getAcademyOfDean($this->session_data->id);
        } else if ($this->session_data->role == '5') {
            $data['academies'] = $academy->getAcademyOfTeacher($this->session_data->id);
        }
        
        if (is_null($id)) {
            $this->layout->view('schools/view', $data);
        } else if (!is_null($id) && $type == "list_school_academy_wise") {
            $data['academy_id'] = $id;
            $this->layout->view('schools/view', $data);
        } else {
            if ($type == 'notification') {
                Notification::updateNotification('dean_assign_school', $this->session_data->id, $id);
            }
            
            $obj = new school();
            $data['school'] = $obj->where('id', $id)->get();
            
            if (!validAcess($id, 'school')) {
                $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
                redirect(base_url() . 'dashboard', 'refresh');
            }
            
            $data['academy'] = $obj->Academy->get();
            $clans = $obj->Clan->order_by($this->session_data->language .'_class_name','ASC')->get();
            $data['clans'] = $clans;
            foreach ($clans as $clan) {
                $userdetails = $clan->Userdetail->get();
                if ($userdetails->result_count() > 0) {
                    foreach ($userdetails as $value) {
                        $user = $value->User->get();
                        if (!is_null($user->id)) {
                            $data['students'][] = $user->stored;
                        }
                    }
                }
            }
            
            if (!isset($data['clans'])) {
                $data['clans'] = null;
            }
            
            if (!isset($data['students'])) {
                $data['students'] = null;
            }
            
            $this->layout->view('schools/view_single', $data);
        }
    }
    
    function addSchool() {
        if ($this->input->post() !== false) {
            $obj = new School();
            foreach ($this->config->item('custom_languages') as $key => $value) {
                $temp = $key . '_school_name';
                if ($this->input->post($temp) != '') {
                    $obj->$temp = $this->input->post($temp);
                } else {
                    $obj->$temp = $this->input->post('en_school_name');
                }
            }
            
            $obj->academy_id = $this->input->post('academy_id');
            $obj->dean_id = implode(',', $this->input->post('dean_id'));
            $obj->address = $this->input->post('address');
            $obj->postal_code = $this->input->post('postal_code');
            $obj->city_id = $this->input->post('city_id');
            $obj->state_id = $this->input->post('state_id');
            $obj->country_id = $this->input->post('country_id');
            $obj->phone_1 = $this->input->post('phone_1');
            $obj->phone_2 = @$this->input->post('phone_2');
            $obj->email = @$this->input->post('email');
            $obj->user_id = $this->session_data->id;
            $obj->save();
            
            $this->session->set_flashdata('success', $this->lang->line('add_data_success'));
            redirect(base_url() . 'school', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('add') . ' ' . $this->lang->line('school'));
            
            $academy = new Academy();
            if ($this->session_data->role == '1' || $this->session_data->role == '2') {
                $data['academies'] = $academy->get();
            } else if ($this->session_data->role == '3') {
                $data['academies'] = $academy->getAcademyOfRector($this->session_data->id);
            } else if ($this->session_data->role == '4') {
                $data['academies'] = $academy->getAcademyOfDean($this->session_data->id);
            } else if ($this->session_data->role == '5') {
                $data['academies'] = $academy->getAcademyOfTeacher($this->session_data->id);
            }
            
            $users = New User();
            $data['users'] = $users->getUsersByRole(4);
            
            $countries = New Country();
            $data['countries'] = $countries->get();
            
            $this->layout->view('schools/add', $data);
        }
    }
    
    function editSchool($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $obj = new School();
                $obj->where('id', $id)->get();
                foreach ($this->config->item('custom_languages') as $key => $value) {
                    $temp = $key . '_school_name';
                    if ($this->input->post($temp) != '') {
                        $obj->$temp = $this->input->post($temp);
                    } else {
                        $obj->$temp = $this->input->post('en_school_name');
                    }
                }
                
                $obj->academy_id = $this->input->post('academy_id');
                $obj->dean_id = implode(',', $this->input->post('dean_id'));
                $obj->address = $this->input->post('address');
                $obj->postal_code = $this->input->post('postal_code');
                $obj->city_id = $this->input->post('city_id');
                $obj->state_id = $this->input->post('state_id');
                $obj->country_id = $this->input->post('country_id');
                $obj->phone_1 = $this->input->post('phone_1');
                $obj->phone_2 = @$this->input->post('phone_2');
                $obj->email = @$this->input->post('email');
                $obj->user_id = $this->session_data->id;
                $obj->save();
                
                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'school', 'refresh');
            } else {
                $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('school'));
                
                $obj = new School();
                $data['school'] = $obj->where('id', $id)->get();
                
                $academy = New Academy();
                $data['academies'] = $academy->get();
                
                $users = New User();
                $data['users'] = $users->getUsersByRole(4);
                
                $countries = New Country();
                $data['countries'] = $countries->get();
                
                $states = New State();
                $data['states'] = $states->where('country_id', $obj->country_id)->get();
                
                $cities = New City();
                $data['cities'] = $cities->where('state_id', $obj->state_id)->get();
                
                $this->layout->view('schools/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'school', 'refresh');
        }
    }
    
    function deleteSchool($id) {
        echo 'dsad';
        if (!empty($id)) {
            $school = new School();
            $school->where('id', $id)->get();
            //$school->delete();
            $this->session->set_flashdata('success', $this->lang->line('delete_data_success'));
            redirect(base_url() . 'school', 'refresh');
        } else {
            $this->session->set_flashdata('error', $this->lang->line('delete_data_error'));
            redirect(base_url() . 'school', 'refresh');
        }
    }
}
