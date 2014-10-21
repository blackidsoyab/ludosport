<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class evolutionclans extends CI_Controller
{
    
    var $session_data;
    
    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('evolution'));
        $this->session_data = $this->session->userdata('user_session');
    }
    
    /*
     *   List all evolutions if the id is null
     *   Single evolution if id is passed
     *   Param1(optional) : evolution id
     *   Param2(optional) : any text (e.g. : notification)
    */
    public function viewEvolutionclan($id = null, $type = null) {
        $academy = New Academy();
        if ($this->session_data->role == '1' || $this->session_data->role == '2') {
            $academy->get();
            $temp = array();
            foreach ($academy as $ac) {
                foreach ($ac->school->get() as $school) {
                    $temp[] = $school;
                }
            }
            $data['schools'] = $temp;
        } else if ($this->session_data->role == '3') {
            $school = new School();
            $data['schools'] = $school->getSchoolOfRector($this->session_data->id);
        } else if ($this->session_data->role == '4') {
            $school = new School();
            $data['schools'] = $school->getSchoolOfDean($this->session_data->id);
        } else if ($this->session_data->role == '5') {
            $school = new School();
            $data['schools'] = $school->getSchoolOfTeacher($this->session_data->id);
        }
        
        $this->layout->view('evolutionclans/view', $data);
    }
    
    //Add the Evolution
    public function addEvolutionclan() {
        if ($this->input->post() !== false) {
            $obj = new Evolutionclan();
            foreach ($this->config->item('custom_languages') as $key => $value) {
                $temp = $key . '_class_name';
                if ($this->input->post($temp) != '') {
                    $obj->$temp = $this->input->post($temp);
                } else {
                    $obj->$temp = $this->input->post('en_class_name');
                }
            }
            
            $obj->school_id = $this->input->post('school_id');
            $obj->teacher_id = implode(',', $this->input->post('teacher_id'));
            $obj->evolutioncategory_id = $this->input->post('evolutioncategory_id');
            $obj->evolutionlevel_id = $this->input->post('evolutionlevel_id');
            $obj->max_student = $this->input->post('max_student');
            $obj->clan_from = date('Y-m-d', strtotime($this->input->post('clan_from')));
            $obj->clan_to = date('Y-m-d', strtotime($this->input->post('clan_to')));
            $obj->lesson_day = implode(',', $this->input->post('lesson_day'));
            $obj->lesson_from = strtotime($this->input->post('lesson_from'));
            $obj->lesson_to = strtotime($this->input->post('lesson_to'));
            
            if ($this->input->post('same_addresss') != '1') {
                $obj->same_address = 0;
                $obj->address = $this->input->post('address');
                $obj->postal_code = $this->input->post('postal_code');
                $obj->city_id = $this->input->post('city_id');
                $obj->state_id = $this->input->post('state_id');
                $obj->country_id = $this->input->post('country_id');
                $obj->phone_1 = $this->input->post('phone_1');
                $obj->phone_2 = @$this->input->post('phone_2');
                $obj->email = $this->input->post('email');
            } else {
                $school = new School();
                $school->where('id', $this->input->post('school_id'))->get();
                $obj->same_address = 1;
                $obj->address = $school->address;
                $obj->postal_code = $school->postal_code;
                $obj->city_id = $school->city_id;
                $obj->state_id = $school->state_id;
                $obj->country_id = $school->country_id;
                $obj->phone_1 = $school->phone_1;
                $obj->phone_2 = $school->phone_2;
                $obj->email = $school->email;
            }
            
            $obj->user_id = $this->session_data->id;
            $obj->save();
            
            $this->session->set_flashdata('success', $this->lang->line('add_data_success'));
            redirect(base_url() . 'evolutionclan', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('add') . ' ' . $this->lang->line('evolution'));
            
            $users = New User();
            $data['users'] = $users->getUsersByRole(5);
            
            $countries = New Country();
            $data['countries'] = $countries->get();
            
            $obj_evolutioncategory = new Evolutioncategory();
            $data['evolution_categories'] = $obj_evolutioncategory->get();
            
            $academy = New Academy();
            if ($this->session_data->role == '1' || $this->session_data->role == '2') {
                $data['academies'] = $academy->get();
            } else if ($this->session_data->role == '3') {
                $data['academies'] = $academy->getAcademyOfRector($this->session_data->id);
            } else if ($this->session_data->role == '4') {
                $data['academies'] = $academy->getAcademyOfDean($this->session_data->id);
            } else if ($this->session_data->role == '5') {
                $data['academies'] = $academy->getAcademyOfTeacher($this->session_data->id);
            } else if ($this->session_data->role == '6') {
                $data['academies'] = $academy->getAcademyOfStudent($this->session_data->id);
            } else {
                $data['academies'] = NULL;
            }
            
            $this->layout->view('evolutionclans/add', $data);
        }
    }
    
    /*
     *   Edit the Evolution
     *   Param1(required) : Evolution id
    */
    public function editEvolutionclan($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $obj = new Evolutionclan();
                $obj->where('id', $id)->get();
                foreach ($this->config->item('custom_languages') as $key => $value) {
                    $temp = $key . '_class_name';
                    if ($this->input->post($temp) != '') {
                        $obj->$temp = $this->input->post($temp);
                    } else {
                        $obj->$temp = $this->input->post('en_class_name');
                    }
                }
                
                $obj->school_id = $this->input->post('school_id');
                $obj->teacher_id = implode(',', $this->input->post('teacher_id'));
                $obj->evolutioncategory_id = $this->input->post('evolutioncategory_id');
                $obj->evolutionlevel_id = $this->input->post('evolutionlevel_id');
                $obj->max_student = $this->input->post('max_student');
                $obj->clan_from = date('Y-m-d', strtotime($this->input->post('clan_from')));
                $obj->clan_to = date('Y-m-d', strtotime($this->input->post('clan_to')));
                $obj->lesson_day = implode(',', $this->input->post('lesson_day'));
                $obj->lesson_from = strtotime($this->input->post('lesson_from'));
                $obj->lesson_to = strtotime($this->input->post('lesson_to'));
                
                if ($this->input->post('same_addresss') != '1') {
                    $obj->same_address = 0;
                    $obj->address = $this->input->post('address');
                    $obj->postal_code = $this->input->post('postal_code');
                    $obj->city_id = $this->input->post('city_id');
                    $obj->state_id = $this->input->post('state_id');
                    $obj->country_id = $this->input->post('country_id');
                    $obj->phone_1 = $this->input->post('phone_1');
                    $obj->phone_2 = @$this->input->post('phone_2');
                    $obj->email = $this->input->post('email');
                } else {
                    $school = new School();
                    $school->where('id', $this->input->post('school_id'))->get();
                    $obj->same_address = 1;
                    $obj->address = $school->address;
                    $obj->postal_code = $school->postal_code;
                    $obj->city_id = $school->city_id;
                    $obj->state_id = $school->state_id;
                    $obj->country_id = $school->country_id;
                    $obj->phone_1 = $school->phone_1;
                    $obj->phone_2 = $school->phone_2;
                    $obj->email = $school->email;
                }
                
                $obj->user_id = $this->session_data->id;
                $obj->save();
                
                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'evolutionclan', 'refresh');
            } else {
                $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('evolution'));
                
                $obj = new Evolutionclan();
                $data['evolutionclan'] = $obj->where('id', $id)->get();
                
                $users = New User();
                $data['users'] = $users->getUsersByRole(5);
                
                $academy = New Academy();
                if ($this->session_data->role == '1' || $this->session_data->role == '2') {
                    $data['academies'] = $academy->get();
                } else if ($this->session_data->role == '3') {
                    $data['academies'] = $academy->getAcademyOfRector($this->session_data->id);
                } else if ($this->session_data->role == '4') {
                    $data['academies'] = $academy->getAcademyOfDean($this->session_data->id);
                } else if ($this->session_data->role == '5') {
                    $data['academies'] = $academy->getAcademyOfTeacher($this->session_data->id);
                } else if ($this->session_data->role == '6') {
                    $data['academies'] = $academy->getAcademyOfStudent($this->session_data->id);
                } else {
                    $data['academies'] = NULL;
                }
                
                $school = new School($obj->school_id);
                $data['academy_id'] = $school->academy_id;
                $data['schools'] = $school->where('academy_id', $school->academy_id)->get();
                
                $countries = New Country();
                $data['countries'] = $countries->get();
                
                $states = New State();
                $data['states'] = $states->where('country_id', $obj->country_id)->get();
                
                $cities = New City();
                $data['cities'] = $cities->where('state_id', $obj->state_id)->get();

                $obj_evolutioncategory = new Evolutioncategory();
                $data['evolution_categories'] = $obj_evolutioncategory->get();
                
                $level = New Evolutionlevel();
                $data['evolution_levels'] = $level->get();
                
                $this->layout->view('evolutionclans/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'evolutionclan', 'refresh');
        }
    }
    
    /*
     *   Delete the Evolution
     *   Param1(required) : Evolution id
    */
    public function deleteEvolutionclan($id) {
        if (!empty($id)) {
            $evolution = new Evolutionclan();
            $evolution->where('id', $id)->get();
            $evolution->delete();
            
            $this->session->set_flashdata('success', $this->lang->line('delete_data_success'));
            redirect(base_url() . 'evolutionclan', 'refresh');
        } else {
            $this->session->set_flashdata('error', $this->lang->line('delete_data_error'));
            redirect(base_url() . 'evolutionclan', 'refresh');
        }
    }

    /*
     *   List the Students of the Clan
     *   Param1(optional) : Clan id
     *   Param2(optional) : all, academy, school, clan
    */
    public function evolutionclanStudentList($id = 0, $type = 'all') {
        $this->layout->setField('page_title', $this->lang->line('list') . ' ' . $this->lang->line('student'));
        
        $academy = new Academy();
        $school = new School();
        $clan = new Evolutionclan();
        
        if ($id != 0 && $type == 'academy') {
            $data['all_academies'] = $academy->where('id', $id)->get();
            $data['all_schools'] = $academy->school->get();
            $data['all_clans'] = $academy->school->clan->get();
            
            $data['academy_id'] = $id;
        } else if ($id != 0 && $type == 'school') {
            $temp = $school->where('id', $id)->get();
            $data['all_schools'] = $school->where('academy_id', $temp->academy_id)->get();
            $data['all_academies'] = $school->academy->get();
            $data['all_clans'] = $school->clan->get();
            
            $data['academy_id'] = $temp->academy_id;
            $data['school_id'] = $id;
        } else if ($id != 0 && $type == 'clan') {
            $temp = $clan->where('id', $id)->get();
            $data['all_clans'] = $clan->where('school_id', $temp->school_id)->get();
            $data['all_schools'] = $clan->school->get();
            $data['all_academies'] = $clan->school->academy->get();
            
            $data['academy_id'] = $temp->academy_id;
            $data['school_id'] = $temp->school_id;
            $data['clan_id'] = $id;
        } else {
            if ($this->session_data->role == '1' || $this->session_data->role == '2') {
                $data['all_academies'] = $academy->get();
                $data['all_schools'] = $school->get();
                $data['all_clans'] = $clan->get();
            } else if ($this->session_data->role == '3') {
                $data['all_academies'] = $academy->getAcademyOfRector($this->session_data->id);
                $data['all_schools'] = $school->getSchoolOfRector($this->session_data->id);
                $data['all_clans'] = $clan->getClanOfRector($this->session_data->id);
            } else if ($this->session_data->role == '4') {
                $data['all_academies'] = $academy->getAcademyOfDean($this->session_data->id);
                $data['all_schools'] = $school->getSchoolOfDean($this->session_data->id);
                $data['all_clans'] = $clan->getClanOfDean($this->session_data->id);
            } else if ($this->session_data->role == '5') {
                $data['all_academies'] = $academy->getAcademyOfTeacher($this->session_data->id);
                $data['all_schools'] = $school->getSchoolOfTeacher($this->session_data->id);
                $data['all_clans'] = $clan->getClanOfTeacher($this->session_data->id);
            }
        }
        
        $this->layout->view('evolutionclans/student_list', $data);
    }

}
