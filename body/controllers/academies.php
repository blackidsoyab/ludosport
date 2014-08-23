<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class academies extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('academy'));
        $this->session_data = $this->session->userdata('user_session');
    }

    function viewAcademy($id = null, $type = null) {
        if (is_null($id)) {
            $this->layout->view('academies/view');
        } else {
            if ($type == 'notification') {
                Notification::updateNotification('rector_assign_academy', $this->session_data->id, $id);
            }

            $academy = new Academy();
            $data['academy'] = $academy->where('id', $id)->get();
            $schools =  $academy->School->get();
            $data['schools'] = $schools;
            foreach ($schools as $school) {
                $temp = $school->Clan->get();
                if(!empty($temp->all)) {
                    foreach ($temp->all as $value) {
                        $data['clans'][] = $value->stored;
                        $userdetails = $value->Userdetail->get();
                        if($userdetails->result_count() > 0){
                            foreach ($userdetails as $value) {
                                $user = $value->User->get();
                                if(!is_null($user->id)){
                                    $data['students'][] = $user->stored;
                                }
                            }
                        } else {
                            $data['students'] = null;
                        }
                    }
                }else{
                    $data['clans'][] = null;
                    $data['students'][] = null;
                }
            }

            $this->layout->view('academies/view_single', $data);
        }
    }

    function addAcademy() {
        if ($this->input->post() !== false) {
            $obj = new Academy();
            foreach ($this->config->item('custom_languages') as $key => $value) {
                $temp = $key . '_academy_name';
                if ($this->input->post($temp) != '') {
                    $obj->$temp = $this->input->post($temp);
                } else {
                    $obj->$temp = $this->input->post('en_academy_name');
                }
            }

            $obj->rector_id = implode(',', $this->input->post('rector_id'));
            $obj->type = $this->input->post('type');
            $obj->contact_firstname = $this->input->post('contact_firstname');
            $obj->contact_lastname = $this->input->post('contact_lastname');
            $obj->association_fullname = $this->input->post('association_fullname');
            $obj->role_referent = $this->input->post('role_referent');
            $obj->address = $this->input->post('address');
            $obj->postal_code = $this->input->post('postal_code');
            $obj->city_id = $this->input->post('city_id');
            $obj->state_id = $this->input->post('state_id');
            $obj->country_id = $this->input->post('country_id');
            $obj->phone_1 = $this->input->post('phone_1');
            $obj->phone_2 = @$this->input->post('phone_2');
            $obj->email = @$this->input->post('email');
            $obj->fee1 = @$this->input->post('fee1');
            $obj->fee2 = @$this->input->post('fee2');
            $obj->user_id = $this->session_data->id;
            $obj->save();

            $this->session->set_flashdata('success', $this->lang->line('add_data_success'));
            redirect(base_url() . 'academy', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('add') . ' ' . $this->lang->line('academy'));

            $countries = New Country();
            $data['countries'] = $countries->get();

            $users = New User();
            $data['users'] = $users->getUsersByRole(3);

            $this->layout->view('academies/add', $data);
        }
    }

    function editAcademy($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $obj = new Academy();
                $obj->where('id', $id)->get();
                foreach ($this->config->item('custom_languages') as $key => $value) {
                    $temp = $key . '_academy_name';
                    if ($this->input->post($temp) != '') {
                        $obj->$temp = $this->input->post($temp);
                    } else {
                        $obj->$temp = $this->input->post('en_academy_name');
                    }
                }

                $obj->rector_id = implode(',', $this->input->post('rector_id'));
                $obj->type = $this->input->post('type');
                $obj->contact_firstname = $this->input->post('contact_firstname');
                $obj->contact_lastname = $this->input->post('contact_lastname');
                $obj->association_fullname = $this->input->post('association_fullname');
                $obj->role_referent = $this->input->post('role_referent');
                $obj->address = $this->input->post('address');
                $obj->postal_code = $this->input->post('postal_code');
                $obj->city_id = $this->input->post('city_id');
                $obj->state_id = $this->input->post('state_id');
                $obj->country_id = $this->input->post('country_id');
                $obj->phone_1 = $this->input->post('phone_1');
                $obj->phone_2 = @$this->input->post('phone_2');
                $obj->fee1 = @$this->input->post('fee1');
                $obj->fee2 = @$this->input->post('fee2');
                $obj->email = @$this->input->post('email');
                $obj->user_id = $this->session_data->id;
                $obj->save();

                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'academy', 'refresh');
            } else {
                $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('academy'));

                $obj = new Academy();
                $data['academy'] = $obj->where('id', $id)->get();

                $countries = New Country();
                $data['countries'] = $countries->get();

                $users = New User();
                $data['users'] = $users->getUsersByRole(3);

                $states = New State();
                $data['states'] = $states->where('country_id', $obj->country_id)->get();

                $cities = New City();
                $data['cities'] = $cities->where('state_id', $obj->state_id)->get();

                $this->layout->view('academies/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'academy', 'refresh');
        }
    }

    function deleteAcademy($id) {
        if (!empty($id)) {
            $academy = new Academy();
            $academy->where('id', $id)->get();
            /* foreach ($academy->School as $user) {
              $user->User_details->delete_all();
              }
              $academy->School->delete_all(); */
            $academy->delete();

            $this->session->set_flashdata('success', $this->lang->line('delete_data_success'));
            redirect(base_url() . 'academy', 'refresh');
        } else {
            $this->session->set_flashdata('error', $this->lang->line('delete_data_error'));
            redirect(base_url() . 'academy', 'refresh');
        }
    }

}
