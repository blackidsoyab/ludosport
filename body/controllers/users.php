<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class users extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('user'));
        $this->session_data = $this->session->userdata('user_session');
    }

    function viewUser($id = null, $type = null) {
        $role = new Role();
        $data['roles'] = $role->where('id >', $this->session_data->role)->get();    

        if (is_null($id)) {
            $this->layout->view('users/view', $data);
        } else if (!is_null($id) && $type == "list_user_role_wise") {
            $data['role_id'] = $id;
            $this->layout->view('users/view', $data);
        } else {
            if ($type == 'notification') {
                Notification::updateNotification('user_register', $this->session_data->id, $id);
                redirect(base_url() .'profile/view/' . $id, 'refresh');
            }

            $obj = new User();
            $data['user'] = $obj->where('id', $id)->get();
            $this->layout->view('users/view_single', $data);
        }
    }

    function addUser() {
        if ($this->input->post() !== false) {
            $user = new User();

            $user->firstname = $this->input->post('firstname');
            $user->lastname = $this->input->post('lastname');
            $user->email = $this->input->post('email');
            $user->date_of_birth = strtotime(date('Y-m-d', strtotime($this->input->post('date_of_birth'))));
            $user->city_id = $this->input->post('city_id');
            $city = new City();
            $city->where('id', $this->input->post('city_id'))->get();
            $user->state_id = $city->state->id;
            $user->country_id = $city->state->country->id;
            $user->city_of_residence = $this->input->post('city_of_residence');
            $user->role_id = implode(',', $this->input->post('role_id'));
            $user->username = $this->input->post('username');
            $user->password = md5($this->input->post('new_password'));
            $user->status = $this->input->post('status');
            $user->user_id = $this->session_data->id;
            $user->save();

            if (in_array('6', $this->input->post('role_id'))) {
                $user_details = new Userdetail();
                $user_details->student_master_id = $user->id;

                if($this->input->post('degree_id') != 0){
                    $obj_batch = new Batch();
                    $check = $obj_batch->canAssignThisBatch($this->input->post('degree_id'), 'D', $this->session_data->role);
                    if($check) {
                        $obj_batch_history = new Userbatcheshistory();
                        $obj_batch_history->student_id = $user->id;
                        $obj_batch_history->batch_type = 'D';
                        $obj_batch_history->batch_id = $this->input->post('degree_id');
                        $obj_batch_history->assign_date = get_current_date_time()->get_date_for_db();
                        $obj_batch_history->user_id = $this->session_data->id;
                        $obj_batch_history->save();

                        $user_details->degree_id= $this->input->post('degree_id');
                    }
                }

                if($this->input->post('honor_id') != 0){
                    $obj_batch = new Batch();
                    $check = $obj_batch->canAssignThisBatch($this->input->post('honor_id'), 'H', $this->session_data->role);
                    if($check) {
                        $obj_batch_history = new Userbatcheshistory();
                        $obj_batch_history->student_id = $user->id;
                        $obj_batch_history->batch_type = 'H';
                        $obj_batch_history->batch_id = $this->input->post('honor_id');
                        $obj_batch_history->assign_date = get_current_date_time()->get_date_for_db();
                        $obj_batch_history->user_id = $this->session_data->id;
                        $obj_batch_history->save();

                        $user_details->honor_id= $this->input->post('honor_id');
                    }
                }
                
                if($this->input->post('qualification_id') != 0){
                    $obj_batch = new Batch();
                    $check = $obj_batch->canAssignThisBatch($this->input->post('qualification_id'), 'Q', $this->session_data->role);
                    if($check) {
                        $obj_batch_history = new Userbatcheshistory();
                        $obj_batch_history->student_id = $user->id;
                        $obj_batch_history->batch_type = 'Q';
                        $obj_batch_history->batch_id = $this->input->post('qualification_id');
                        $obj_batch_history->assign_date = get_current_date_time()->get_date_for_db();
                        $obj_batch_history->user_id = $this->session_data->id;
                        $obj_batch_history->save();

                        $user_details->qualification_id= $this->input->post('qualification_id');
                    }
                }
                
                if($this->input->post('security_id') != 0){
                    $obj_batch = new Batch();
                    $check = $obj_batch->canAssignThisBatch($this->input->post('security_id'), 'S', $this->session_data->role);
                    if($check) {
                        $obj_batch_history = new Userbatcheshistory();
                        $obj_batch_history->student_id = $user->id;
                        $obj_batch_history->batch_type = 'S';
                        $obj_batch_history->batch_id = $this->input->post('security_id');
                        $obj_batch_history->assign_date = get_current_date_time()->get_date_for_db();
                        $obj_batch_history->user_id = $this->session_data->id;
                        $obj_batch_history->save();

                        $user_details->security_id= $this->input->post('security_id');
                    }
                }

                if($this->input->post('master_id') != 0){
                    $obj_batch = new Batch();
                    $check = $obj_batch->canAssignThisBatch($this->input->post('master_id'), 'M', $this->session_data->role);
                    if($check) {
                        $obj_batch_history = new Userbatcheshistory();
                        $obj_batch_history->student_id = $user->id;
                        $obj_batch_history->batch_type = 'M';
                        $obj_batch_history->batch_id = $this->input->post('master_id');
                        $obj_batch_history->assign_date = get_current_date_time()->get_date_for_db();
                        $obj_batch_history->user_id = $this->session_data->id;
                        $obj_batch_history->save();

                        $user_details->master_id= $this->input->post('master_id');
                    }
                }
                
                $user_details->clan_id = $this->input->post('class_id');
                $user_details->first_lesson_date = get_current_date_time()->get_date_for_db();
                $user_details->status = $this->input->post('status');
                $user_details->user_id = $this->session_data->id;
                $user_details->save();
            }

            $this->session->set_flashdata('success', $this->lang->line('add_data_success'));
            redirect(base_url() . 'user', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('add') . ' ' . $this->lang->line('user'));

            $clan = new Clan();
            $cities_ids = $clan->getCitiesofClans();

            $city = new City();
            $data['cities'] = $city->where_in('id', $cities_ids)->get();

            $role = new Role();
            if($this->session_data->id == 1){
                $data['roles'] = $role->get();
            }else{
                $data['roles'] = $role->where('id >', $this->session_data->role)->get();    
            }

            $academy = New Academy();
            if ($this->session_data->role == '1' || $this->session_data->role == '2') {
                $data['academies'] = $academy->get();
            } else if ($this->session_data->role == '3'){
                $data['academies'] = $academy->getAcademyOfRector($this->session_data->id);
            } else if ($this->session_data->role == '4'){
                $data['academies'] = $academy->getAcademyOfDean($this->session_data->id);
            } else if ($this->session_data->role == '5'){
                $data['academies'] = $academy->getAcademyOfTeacher($this->session_data->id);
            } else if ($this->session_data->role == '6'){
                $data['academies'] = $academy->getAcademyOfStudent($this->session_data->id);
            } else {
                $data['academies'] = NULL;
            }

            if($this->session_data->role == 1){
                $assignments = array('D','H','M','Q','S');
            }else{
                $obj_batch = new Batch();
                $assignments = $obj_batch->getBatchTypeAssignmentByRole($this->session_data->role);
            }
            
            if(in_array('D', $assignments)){
                $obj_batch = new Batch();
                $data['degree_batches'] = $obj_batch->getBatchAssignmentByRole('D',$this->session_data->role);
            }

            if(in_array('H', $assignments)){
                $obj_batch = new Batch();
                $data['honour_batches'] = $obj_batch->getBatchAssignmentByRole('H',$this->session_data->role);
            }

            if(in_array('M', $assignments)){
                $obj_batch = new Batch();
                $data['master_batches'] = $obj_batch->getBatchAssignmentByRole('M',$this->session_data->role);
            }

            if(in_array('Q', $assignments)){
                $obj_batch = new Batch();
                $data['qualification_batches'] = $obj_batch->getBatchAssignmentByRole('Q',$this->session_data->role);
            }

            if(in_array('S', $assignments)){
                $obj_batch = new Batch();
                $data['security_batches'] = $obj_batch->getBatchAssignmentByRole('S',$this->session_data->role);
            }

            $this->layout->view('users/add', $data);
        }
    }

    function editUser($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $user = new User();
                $user->where('id', $id)->get();

                $user->firstname = $this->input->post('firstname');
                $user->lastname = $this->input->post('lastname');
                $user->email = $this->input->post('email');
                $user->date_of_birth = strtotime(date('Y-m-d', strtotime($this->input->post('date_of_birth'))));
                $user->city_id = $this->input->post('city_id');
                $city = new City();
                $city->where('id', $this->input->post('city_id'))->get();
                $user->state_id = $city->state->id;
                $user->country_id = $city->state->country->id;
                $user->city_of_residence = $this->input->post('city_of_residence');
                $user->role_id = implode(',', $this->input->post('role_id'));

                if ($this->input->post('username') != '') {
                    $user->username = $this->input->post('username');
                }

                if ($this->input->post('new_password') != '') {
                    $user->password = md5($this->input->post('new_password'));
                }
                $user->status = $this->input->post('status');
                $user->user_id = $this->session_data->id;

                $user->save();

                if (in_array('6', $this->input->post('role_id'))) {
                    $user_details = new Userdetail();
                    $user_details->where('student_master_id', $id)->get();
                    $user_details->student_master_id = $user->id;

                    if($this->input->post('degree_id') != 0){
                        $obj_batch = new Batch();
                        $check = $obj_batch->canAssignThisBatch($this->input->post('degree_id'), 'D', $this->session_data->role);
                        if($check) {
                            $obj_batch_history = new Userbatcheshistory();
                            $obj_batch_history->where(array('batch_type'=>'D', 'student_id'=>$user->id, 'batch_id'=>$this->input->post('degree_id')))->get();
                            if($obj_batch_history->result_count() == 0){
                                $obj_batch_history->student_id = $user->id;
                                $obj_batch_history->batch_type = 'Q';
                                $obj_batch_history->batch_id = $this->input->post('degree_id');
                                $obj_batch_history->assign_date = get_current_date_time()->get_date_for_db();
                                $obj_batch_history->user_id = $this->session_data->id;
                                $obj_batch_history->save();

                                $user_details->degree_id= $this->input->post('degree_id');
                            }
                        }
                    }

                    if($this->input->post('honor_id') != 0){
                        $obj_batch = new Batch();
                        $check = $obj_batch->canAssignThisBatch($this->input->post('honor_id'), 'H', $this->session_data->role);
                        if($check) {
                            $obj_batch_history = new Userbatcheshistory();
                            $obj_batch_history->where(array('batch_type'=>'H', 'student_id'=>$user->id, 'batch_id'=>$this->input->post('honor_id')))->get();
                            if($obj_batch_history->result_count() == 0){
                                $obj_batch_history->student_id = $user->id;
                                $obj_batch_history->batch_type = 'Q';
                                $obj_batch_history->batch_id = $this->input->post('honor_id');
                                $obj_batch_history->assign_date = get_current_date_time()->get_date_for_db();
                                $obj_batch_history->user_id = $this->session_data->id;
                                $obj_batch_history->save();

                                $user_details->honor_id= $this->input->post('honor_id');
                            }
                        }
                    }
                    
                    if($this->input->post('qualification_id') != 0){
                        $obj_batch = new Batch();
                        $check = $obj_batch->canAssignThisBatch($this->input->post('qualification_id'), 'Q', $this->session_data->role);
                        if($check) {
                            $obj_batch_history = new Userbatcheshistory();
                            $obj_batch_history->where(array('batch_type'=>'Q', 'student_id'=>$user->id, 'batch_id'=>$this->input->post('qualification_id')))->get();
                            if($obj_batch_history->result_count() == 0){
                                $obj_batch_history->student_id = $user->id;
                                $obj_batch_history->batch_type = 'Q';
                                $obj_batch_history->batch_id = $this->input->post('qualification_id');
                                $obj_batch_history->assign_date = get_current_date_time()->get_date_for_db();
                                $obj_batch_history->user_id = $this->session_data->id;
                                $obj_batch_history->save();

                                $user_details->qualification_id= $this->input->post('qualification_id');
                            }
                        }
                    }
                    
                    if($this->input->post('security_id') != 0){
                        $obj_batch = new Batch();
                        $check = $obj_batch->canAssignThisBatch($this->input->post('security_id'), 'S', $this->session_data->role);
                        if($check) {
                            $obj_batch_history = new Userbatcheshistory();
                            $obj_batch_history->where(array('batch_type'=>'S', 'student_id'=>$user->id, 'batch_id'=>$this->input->post('security_id')))->get();
                            if($obj_batch_history->result_count() == 0){
                                $obj_batch_history->student_id = $user->id;
                                $obj_batch_history->batch_type = 'S';
                                $obj_batch_history->batch_id = $this->input->post('security_id');
                                $obj_batch_history->assign_date = get_current_date_time()->get_date_for_db();
                                $obj_batch_history->user_id = $this->session_data->id;
                                $obj_batch_history->save();

                                $user_details->security_id= $this->input->post('security_id');
                            }
                        }
                    }

                    if($this->input->post('master_id') != 0){
                        $obj_batch = new Batch();
                        $check = $obj_batch->canAssignThisBatch($this->input->post('master_id'), 'M', $this->session_data->role);
                        if($check) {
                            $obj_batch_history = new Userbatcheshistory();
                            $obj_batch_history->student_id = $user->id;
                            $obj_batch_history->batch_type = 'M';
                            $obj_batch_history->batch_id = $this->input->post('master_id');
                            $obj_batch_history->assign_date = get_current_date_time()->get_date_for_db();
                            $obj_batch_history->user_id = $this->session_data->id;
                            $obj_batch_history->save();

                            $user_details->master_id= $this->input->post('master_id');
                        }
                    }

                    $user_details->clan_id = $this->input->post('class_id');
                    $user_details->first_lesson_date = get_current_date_time()->get_date_for_db();
                    $user_details->user_id = $this->session_data->id;
                    $user_details->status = $this->input->post('status');
                    $user_details->save();
                } else {
                    $user_details = new Userdetail();
                    $user_details->where('student_master_id', $id)->get();
                    $user_details->delete();
                }

                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'user', 'refresh');
            } else {
                $user = new User();
                $data['user'] = $user->where('id', $id)->get();
                if ($user->role_id <= $this->session_data->role) {
                    $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
                    redirect(base_url() . 'user', 'refresh');
                } else {
                    $this->layout->setField('page_title', 'Edit User');

                    $userdetail = new Userdetail();
                    $data['userdetail'] = $userdetail->where('student_master_id', $id)->get();

                    $class = new Clan();
                    $class->where('id', $userdetail->clan_id)->get();
                    $data['classes'] = $class->where('school_id', $class->school_id)->get();
                    $data['school_id'] = $class->school_id;
                    $school = new School();
                    $school->where('id', $class->school_id)->get();
                    $data['schools'] = $school->where('academy_id', $school->academy_id)->get();
                    $data['academy_id'] = $school->academy_id;

                    $clan = new Clan();
                    $cities_ids = $clan->getCitiesofClans();

                    $city = new City();
                    $data['cities'] = $city->where_in('id', $cities_ids)->get();

                    $role = new Role();
                    if($this->session_data->id == 1){
                        $data['roles'] = $role->get();
                    }else{
                        $data['roles'] = $role->where('id >', $this->session_data->role)->get();    
                    }

                    $academy = New Academy();
                    if ($this->session_data->role == '1' || $this->session_data->role == '2') {
                        $data['academies'] = $academy->get();
                    } else if ($this->session_data->role == '3'){
                        $data['academies'] = $academy->getAcademyOfRector($this->session_data->id);
                    } else if ($this->session_data->role == '4'){
                        $data['academies'] = $academy->getAcademyOfDean($this->session_data->id);
                    } else if ($this->session_data->role == '5'){
                        $data['academies'] = $academy->getAcademyOfTeacher($this->session_data->id);
                    } else if ($this->session_data->role == '6'){
                        $data['academies'] = $academy->getAcademyOfStudent($this->session_data->id);
                    } else {
                        $data['academies'] = NULL;
                    }

                    if(in_array(6, explode(',',$user->role_id))){
                        if($this->session_data->role == 1){
                            $assignments = array('D','H','M','Q','S');
                        }else{
                            $obj_batch = new Batch();
                            $assignments = $obj_batch->getBatchTypeAssignmentByRole($this->session_data->role);
                        }

                        if(in_array('D', $assignments)){
                            $obj_batch = new Batch();
                            $data['degree_batches'] = $obj_batch->getBatchAssignmentByRole('D',$this->session_data->role);
                        }

                        if(in_array('H', $assignments)){
                            $obj_batch = new Batch();
                            $data['honour_batches'] = $obj_batch->getBatchAssignmentByRole('H',$this->session_data->role);
                        }

                        if(in_array('M', $assignments)){
                            $obj_batch = new Batch();
                            $data['master_batches'] = $obj_batch->getBatchAssignmentByRole('M',$this->session_data->role);
                        }

                        if(in_array('Q', $assignments)){
                            $obj_batch = new Batch();
                            $data['qualification_batches'] = $obj_batch->getBatchAssignmentByRole('Q',$this->session_data->role);
                        }

                        if(in_array('S', $assignments)){
                            $obj_batch = new Batch();
                            $data['security_batches'] = $obj_batch->getBatchAssignmentByRole('S',$this->session_data->role);
                        }
                    }

                    $this->layout->view('users/edit', $data);
                }
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'user', 'refresh');
        }
    }

    function deleteUser($id) {
        if (!empty($id)) {
            $user = new User();
            $user->where('id', $id)->get();
            $user->delete();
            $this->session->set_flashdata('success', $this->lang->line('delete_data_success'));
            redirect(base_url() . 'user', 'refresh');
        } else {
            $this->session->set_flashdata('error', $this->lang->line('delete_data_error'));
            redirect(base_url() . 'user', 'refresh');
        }
    }

    function extraPermissionUser($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {

                $user = new User();
                $user->where('id', $id)->update('permission', serialize($this->input->post('perm')));
                $user->delete();
                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'user', 'refresh');
            } else {
                $user = new User();
                $data['user'] = $user->where('id', $id)->get();

                $role = new Role();
                $data['role'] = $role->where('id', $data['user']->role_id)->get();

                $this->layout->view('users/extra_permission', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'user', 'refresh');
        }
    }

}
