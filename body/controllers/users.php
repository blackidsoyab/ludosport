<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class users extends CI_Controller
{
    
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
                redirect(base_url() . 'profile/view/' . $id, 'refresh');
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
                
                $obj_batch = new Batch();
                $batches_details = $obj_batch->getAssignBatchIds($this->session_data->role);
                $batches_ids = array_column($batches_details, 'id');
                
                $xpr = 0;
                $war = 0;
                $sty = 0;
                
                if ($this->input->post('degree_id') != 0) {
                    if (in_array($this->input->post('degree_id'), $batches_ids)) {
                        $obj_batch_history = new Userbatcheshistory();
                        $obj_batch_history->saveStudentBatchHistory($user->id, 'D', $this->input->post('degree_id'));
                        $user_details->degree_id = $this->input->post('degree_id');
                        if ($batches_details[$this->input->post('degree_id') ]['has_point'] == 1) {
                            $xpr = $xpr + $batches_details[$this->input->post('degree_id') ]['xpr'];
                            $war = $war + $batches_details[$this->input->post('degree_id') ]['war'];
                            $sty = $sty + $batches_details[$this->input->post('degree_id') ]['sty'];
                        }
                    }
                }
                
                if ($this->input->post('honour_id') != 0) {
                    if (in_array($this->input->post('honour_id'), $batches_ids)) {
                        $obj_batch_history = new Userbatcheshistory();
                        $obj_batch_history->saveStudentBatchHistory($user->id, 'H', $this->input->post('honour_id'));
                        $user_details->honour_id = $this->input->post('honour_id');
                        if ($batches_details[$this->input->post('honour_id') ]['has_point'] == 1) {
                            $xpr = $xpr + $batches_details[$this->input->post('honour_id') ]['xpr'];
                            $war = $war + $batches_details[$this->input->post('honour_id') ]['war'];
                            $sty = $sty + $batches_details[$this->input->post('honour_id') ]['sty'];
                        }
                    }
                }
                
                if ($this->input->post('qualification_id') != 0) {
                    if (in_array($this->input->post('qualification_id'), $batches_ids)) {
                        $obj_batch_history = new Userbatcheshistory();
                        $obj_batch_history->saveStudentBatchHistory($user->id, 'Q', $this->input->post('qualification_id'));
                        $user_details->qualification_id = $this->input->post('qualification_id');
                        if ($batches_details[$this->input->post('qualification_id') ]['has_point'] == 1) {
                            $xpr = $xpr + $batches_details[$this->input->post('qualification_id') ]['xpr'];
                            $war = $war + $batches_details[$this->input->post('qualification_id') ]['war'];
                            $sty = $sty + $batches_details[$this->input->post('qualification_id') ]['sty'];
                        }
                    }
                }
                
                if ($this->input->post('security_id') != 0) {
                    if (in_array($this->input->post('security_id'), $batches_ids)) {
                        $obj_batch_history = new Userbatcheshistory();
                        $obj_batch_history->saveStudentBatchHistory($user->id, 'S', $this->input->post('security_id'));
                        $user_details->security_id = $this->input->post('security_id');
                        if ($batches_details[$this->input->post('security_id') ]['has_point'] == 1) {
                            $xpr = $xpr + $batches_details[$this->input->post('security_id') ]['xpr'];
                            $war = $war + $batches_details[$this->input->post('security_id') ]['war'];
                            $sty = $sty + $batches_details[$this->input->post('security_id') ]['sty'];
                        }
                    }
                }
                
                if ($this->input->post('affect_score') === 'Y') {
                    $obj_score_history = new Scorehistory();
                    $obj_score_history->meritStudentScore($user->id, 'xpr', $xpr, 'Assign badge');
                    $obj_score_history->meritStudentScore($user->id, 'war', $war, 'Assign badge');
                    $obj_score_history->meritStudentScore($user->id, 'sty', $sty, 'Assign badge');
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
            if ($this->session_data->id == 1) {
                $data['roles'] = $role->get();
            } else {
                $data['roles'] = $role->where('id >', $this->session_data->role)->get();
            }
            
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
            
            if ($this->session_data->role == 1) {
                $assignments = array('D', 'H', 'Q', 'S');
            } else {
                $obj_batch = new Batch();
                $assignments = $obj_batch->getBatchTypeAssignmentByRole($this->session_data->role);
            }
            
            if (in_array('D', $assignments)) {
                $obj_batch = new Batch();
                $data['degree_batches'] = $obj_batch->getBatchAssignmentByRole('D', $this->session_data->role);
            }
            
            if (in_array('H', $assignments)) {
                $obj_batch = new Batch();
                $data['honour_batches'] = $obj_batch->getBatchAssignmentByRole('H', $this->session_data->role);
            }
            
            if (in_array('Q', $assignments)) {
                $obj_batch = new Batch();
                $data['qualification_batches'] = $obj_batch->getBatchAssignmentByRole('Q', $this->session_data->role);
            }
            
            if (in_array('S', $assignments)) {
                $obj_batch = new Batch();
                $data['security_batches'] = $obj_batch->getBatchAssignmentByRole('S', $this->session_data->role);
            }
            
            $this->layout->view('users/add', $data);
        }
    }
    
    function editUser($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                
                $user = new User();
                $user->where('id', $id)->get();
                $role_ids = explode(',', $user->role_id);
                
                $temp_role = array();
                foreach ($role_ids as $role) {
                    if ($this->session_data->role >= $role) {
                        $temp_role[] = $role;
                    }
                }
                $new_roles = array_unique(array_merge($temp_role, $this->input->post('role_id')));
                
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
                $user->role_id = implode(',', $new_roles);
                
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
                    
                    $obj_batch = new Batch();
                    $batches_details = $obj_batch->getAssignBatchIds($this->session_data->role);
                    $batches_ids = array_column($batches_details, 'id');
                    
                    $xpr = 0;
                    $war = 0;
                    $sty = 0;
                    
                    if ($this->input->post('degree_id') != 0 && $user_details->degree_id != $this->input->post('degree_id')) {
                        if (in_array($this->input->post('degree_id'), $batches_ids)) {
                            $obj_batch_history = new Userbatcheshistory();
                            $obj_batch_history->saveStudentBatchHistory($user->id, 'D', $this->input->post('degree_id'));
                            $user_details->degree_id = $this->input->post('degree_id');
                            if ($batches_details[$this->input->post('degree_id') ]['has_point'] == 1) {
                                $xpr = $xpr + $batches_details[$this->input->post('degree_id') ]['xpr'];
                                $war = $war + $batches_details[$this->input->post('degree_id') ]['war'];
                                $sty = $sty + $batches_details[$this->input->post('degree_id') ]['sty'];
                            }
                        }
                    }
                    
                    if ($this->input->post('honour_id') != 0 && $user_details->honour_id != $this->input->post('honour_id')) {
                        if (in_array($this->input->post('honour_id'), $batches_ids)) {
                            $obj_batch_history = new Userbatcheshistory();
                            $obj_batch_history->saveStudentBatchHistory($user->id, 'H', $this->input->post('honour_id'));
                            $user_details->honour_id = $this->input->post('honour_id');
                            if ($batches_details[$this->input->post('honour_id') ]['has_point'] == 1) {
                                $xpr = $xpr + $batches_details[$this->input->post('honour_id') ]['xpr'];
                                $war = $war + $batches_details[$this->input->post('honour_id') ]['war'];
                                $sty = $sty + $batches_details[$this->input->post('honour_id') ]['sty'];
                            }
                        }
                    }
                    
                    if ($this->input->post('qualification_id') != 0 && $user_details->qualification_id != $this->input->post('qualification_id')) {
                        if (in_array($this->input->post('qualification_id'), $batches_ids)) {
                            $obj_batch_history = new Userbatcheshistory();
                            $obj_batch_history->saveStudentBatchHistory($user->id, 'Q', $this->input->post('qualification_id'));
                            $user_details->qualification_id = $this->input->post('qualification_id');
                            if ($batches_details[$this->input->post('qualification_id') ]['has_point'] == 1) {
                                $xpr = $xpr + $batches_details[$this->input->post('qualification_id') ]['xpr'];
                                $war = $war + $batches_details[$this->input->post('qualification_id') ]['war'];
                                $sty = $sty + $batches_details[$this->input->post('qualification_id') ]['sty'];
                            }
                        }
                    }
                    
                    if ($this->input->post('security_id') != 0 && $user_details->security_id != $this->input->post('security_id')) {
                        if (in_array($this->input->post('security_id'), $batches_ids)) {
                            $obj_batch_history = new Userbatcheshistory();
                            $obj_batch_history->saveStudentBatchHistory($user->id, 'S', $this->input->post('security_id'));
                            $user_details->security_id = $this->input->post('security_id');
                            if ($batches_details[$this->input->post('security_id') ]['has_point'] == 1) {
                                $xpr = $xpr + $batches_details[$this->input->post('security_id') ]['xpr'];
                                $war = $war + $batches_details[$this->input->post('security_id') ]['war'];
                                $sty = $sty + $batches_details[$this->input->post('security_id') ]['sty'];
                            }
                        }
                    }
                    
                    if ($this->input->post('affect_score') === 'Y') {
                        $obj_score_history = new Scorehistory();
                        $obj_score_history->meritStudentScore($user->id, 'xpr', $xpr, 'Assign badge');
                        $obj_score_history->meritStudentScore($user->id, 'war', $war, 'Assign badge');
                        $obj_score_history->meritStudentScore($user->id, 'sty', $sty, 'Assign badge');
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
                    $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('user'));
                    
                    $userdetail = new Userdetail();
                    $data['userdetail'] = $userdetail->where('student_master_id', $id)->get();
                    
                    $class = new Clan();
                    $class->where('id', $userdetail->clan_id)->get();
                    $data['classes'] = $class->getClanforAjax($class->school_id);
                    $data['school_id'] = $class->school_id;
                    
                    $school = new School();
                    $school->where('id', $class->school_id)->get();
                    $data['schools'] = $school->getSchoolforAjax($school->academy_id);
                    $data['academy_id'] = $school->academy_id;
                    
                    $clan = new Clan();
                    $cities_ids = $clan->getCitiesofClans();
                    
                    $city = new City();
                    $data['cities'] = $city->where_in('id', $cities_ids)->get();
                    
                    $role = new Role();
                    if ($this->session_data->id == 1) {
                        $data['roles'] = $role->get();
                    } else {
                        $data['roles'] = $role->where('id >', $this->session_data->role)->get();
                    }
                    
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
                    
                    if (in_array(6, explode(',', $user->role_id))) {
                        if ($this->session_data->role == 1) {
                            $assignments = array('D', 'H', 'Q', 'S');
                        } else {
                            $obj_batch = new Batch();
                            $assignments = $obj_batch->getBatchTypeAssignmentByRole($this->session_data->role);
                        }
                        
                        if (in_array('D', $assignments)) {
                            $obj_batch = new Batch();
                            $data['degree_batches'] = $obj_batch->getBatchAssignmentByRole('D', $this->session_data->role);
                        }
                        
                        if (in_array('H', $assignments)) {
                            $obj_batch = new Batch();
                            $data['honour_batches'] = $obj_batch->getBatchAssignmentByRole('H', $this->session_data->role);
                        }
                        
                        if (in_array('Q', $assignments)) {
                            $obj_batch = new Batch();
                            $data['qualification_batches'] = $obj_batch->getBatchAssignmentByRole('Q', $this->session_data->role);
                        }
                        
                        if (in_array('S', $assignments)) {
                            $obj_batch = new Batch();
                            $data['security_batches'] = $obj_batch->getBatchAssignmentByRole('S', $this->session_data->role);
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
    
    function listStudentBatches($id) {
        $this->layout->setField('page_title', $this->lang->line('batch_history'));
        $data['user'] = new User($id);
        $this->layout->view('users/student_batch_history_view', $data);
    }

    function addStudentBatches($student_id) {
        if ($this->input->post() !== false) {
            $obj_batch = new Batch($this->input->post('batch_id'));
            
            if($obj_batch->result_count() == 1){
                $obj_batch_history = new Userbatcheshistory();
                $obj_batch_history->saveStudentBatchHistory($student_id, $obj_batch->type, $this->input->post('batch_id'), date('Y-m-d', strtotime($this->input->post('date'))));

                if ($this->input->post('affect_score') === 'Y' && $obj_batch->has_point == 1) {
                    $obj_score_history = new Scorehistory();
                    $obj_score_history->meritStudentScore($student_id, 'xpr', $obj_batch->xpr, 'Assign badge history');
                    $obj_score_history->meritStudentScore($student_id, 'war', $obj_batch->war, 'Assign badge history');
                    $obj_score_history->meritStudentScore($student_id, 'sty', $obj_batch->sty, 'Assign badge history');
                }
                $this->session->set_flashdata('success', $this->lang->line('add_data_success'));
            }
            
            redirect(base_url().'user_student/badge_history/' . $student_id, 'refresh');
        }else{
            $this->layout->setField('page_title', $this->lang->line('add').' '.$this->lang->line('batch_history'));
            $data['user'] = new User($student_id);

            $obj_batch = new Batch();
            $data['batches'] = $obj_batch->order_by('type','ASC')->order_by('sequence' , 'ASC')->get();

            $obj_batch_history = new Userbatcheshistory();
            $obj_batch_history->select('batch_id')->where('student_id', $student_id)->get();

            foreach ($obj_batch_history as $batch_detail) {
                $data['assigned_batches'][] = $batch_detail->batch_id;
            }

            if(!isset($data['assigned_batches'])){
                $data['assigned_batches'] = array();   
            }

            $this->layout->view('users/student_batch_history_add', $data);
        }
    }
    
    function editStudentBatches($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $obj_batch_history = new Userbatcheshistory($id);
                $obj_batch_history->assign_date = date('Y-m-d', strtotime($this->input->post('date')));
                $obj_batch_history->save();
                
                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'user_student/badge_history/' . $obj_batch_history->student_id, 'refresh');
            } else {
                $this->layout->setField('page_title', $this->lang->line('edit').' '.$this->lang->line('batch_history'));
                $obj_batch_history = new Userbatcheshistory($id);
                $data['batch_history'] = $obj_batch_history;
                
                $can_perform_action = false;
                if ($obj_batch_history->user_id == $this->session_data->id || $this->session_data->role == 1 || $this->session_data->role == 2) {
                    $can_perform_action = true;
                }
                
                if ($can_perform_action) {
                    $obj_batch = new Batch($obj_batch_history->batch_id);
                    $data['batch'] = $obj_batch;
                    $data['user'] = new User($obj_batch_history->student_id);
                    $data['assing_user'] = userNameAvtar($obj_batch_history->user_id);
                    $this->layout->view('users/student_batch_history_edit', $data);
                } else {
                    $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
                    redirect(base_url() . 'dashboard', 'refresh');
                }
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'user', 'refresh');
        }
    }
    
    function deleteStudentBatches($id) {
        $obj_batch_history = new Userbatcheshistory($id);
        $can_perform_action = false;
        if ($obj_batch_history->user_id == $this->session_data->id || $this->session_data->role == 1 || $this->session_data->role == 2) {
            $can_perform_action = true;
        }
        
        if ($obj_batch_history->result_count() == 1 && $can_perform_action) {
            $obj_batch = new Batch();
            $batches_details = $obj_batch->getAssignBatchIds($this->session_data->role);
            $batches_ids = array_column($batches_details, 'id');
            if (in_array($obj_batch_history->batch_id, $batches_ids)) {
                if ($batches_details[$obj_batch_history->batch_id]['has_point'] == 1) {
                    $obj_score_history = new Scorehistory();
                    $obj_score_history->demeritStudentScore($obj_batch_history->student_id, 'xpr', $batches_details[$obj_batch_history->batch_id]['xpr'], 'Delete badge');
                    $obj_score_history->demeritStudentScore($obj_batch_history->student_id, 'war', $batches_details[$obj_batch_history->batch_id]['war'], 'Delete badge');
                    $obj_score_history->demeritStudentScore($obj_batch_history->student_id, 'sty', $batches_details[$obj_batch_history->batch_id]['sty'], 'Delete badge');
                }
                $obj_batch_history->delete();
            }
        }
    }
    
    function listStudentScore($id) {
        $this->layout->setField('page_title', $this->lang->line('list_score_history'));
        $data['user'] = new User($id);
        $this->layout->view('users/student_score_history_view', $data);
    }
    
    function deleteStudentScore($id) {
        $obj_score_history = new Scorehistory($id);
        $can_perform_action = false;
        
        if ($obj_score_history->user_id == $this->session_data->id || $this->session_data->role == 1 || $this->session_data->role == 2) {
            $can_perform_action = true;
        }
        
        if ($obj_score_history->result_count() == 1 && $can_perform_action) {

            $userdetail = new Userdetail();
            $userdetail->where('student_master_id',$obj_score_history->student_id)->get();
            
            if($obj_score_history->oper == 'M'){
                $userdetail->{$obj_score_history->score_type} = $userdetail->{$obj_score_history->score_type} - $obj_score_history->score;
                $userdetail->total_score = $userdetail->total_score - $obj_score_history->score;
            }else if($obj_score_history->oper == 'D'){
                $userdetail->{$obj_score_history->score_type} = $userdetail->{$obj_score_history->score_type} + $obj_score_history->score;
                $userdetail->total_score = $userdetail->total_score + $obj_score_history->score;
            }

            $userdetail->save();

            $obj_score_history->delete();
        }
    }
}
