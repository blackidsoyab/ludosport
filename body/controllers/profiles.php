<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class profiles extends CI_Controller
{
    
    var $session_data;
    
    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('profile'));
        $this->session_data = $this->session->userdata('user_session');
    }
    
    function viewProfile($id = null, $type = null) {
        if (is_null($id)) {
            $id = $this->session_data->id;
        }
        
        $user = new User();
        $data['profile'] = $user->where('id', $id)->get();
        
        if ($user->result_count() != 1) {
            $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
            redirect(base_url() . 'dashboard', 'refresh');
        }
        
        if ($type == 'notification') {
            Notification::updateNotification('user_register', $this->session_data->id, $id);
        }
        
        if (in_array(6, explode(',', $data['profile']->role_id))) {
            $userdetail = new Userdetail();
            $data['userdetail'] = $userdetail->where('student_master_id', $id)->get();
            $batch = new Batch();
            $data['batch_detail'] = $batch->where('id', $userdetail->degree_id)->get();
            if (!is_null($data['batch_detail']->profile_cover)) {
                $data['cover_image'] = IMG_URL . 'batches/profile_cover/' . $data['batch_detail']->profile_cover;
            } else {
                $data['cover_image'] = IMG_URL . 'banner.png';
            }
            
            if ($data['userdetail']->clan_id != 0) {
                $clan = new Clan($data['userdetail']->clan_id);
                $data['ac_sc_clan_name'] = $clan->School->Academy->{$this->session_data->language . '_academy_name'} . ', ' . $clan->School->{$this->session_data->language . '_school_name'} . ', ' . $clan->{$this->session_data->language . '_class_name'};
            } else {
                $data['ac_sc_clan_name'] = null;
            }
            
            $challenge = new Challenge();
            $total_win_defeats = (int)$challenge->countVictories($this->session_data->id) + (int)$challenge->countDefeats($this->session_data->id);
            $data['total_victories'] = (int)$challenge->countVictories($id);
            if ($total_win_defeats != 0) {
                $data['victories_percentage'] = round(($data['total_victories'] * 100) / $total_win_defeats, 2);
            }
            $data['total_defeats'] = (int)$challenge->countDefeats($id);
            $data['total_made'] = (int)$challenge->countChallenges($id, 'made');
            $data['total_received'] = (int)$challenge->countChallenges($id, 'received');
            
            //Student Attendance
            $obj_attendance = new Attendance();
            $total_attendance = (int)$obj_attendance->getTotalAttendance($this->session_data->id);
            if ($total_attendance != 0) {
                $data['attendance_percentage'] = round(((int)$obj_attendance->getTotalAttendance($this->session_data->id, 'present') * 100) / $total_attendance, 2);
            }

            //Right Hand side Batches Images
            $obj_batch_history = new Userbatcheshistory();
            $batches = $obj_batch_history->getStudentBatchHistory($id);
            
            foreach ($batches as $batch) {
                if ($batch->type == 'D') {
                    $data['student_degrees'][] = $batch;
                }
                
                if ($batch->type == 'S') {
                    $data['student_securities'][] = $batch;
                }
                
                if ($batch->type == 'Q') {
                    $data['student_qualifications'][] = $batch;
                }
                
                if ($batch->type == 'H') {
                    $data['student_honours'][] = $batch;
                }
            }

            unset($obj_batch_history);
            $obj_batch_history = new Userbatcheshistory();
            $obj_batch_history->select('batch_id')->where(array('batch_type' => 'S', 'student_id' => $id))->get();
            
            foreach ($obj_batch_history as $batch_detail) {
                $assigned_batches[] = $batch_detail->batch_id;
            }
            
            if (!isset($assigned_batches)) {
                $assigned_batches = array();
            }
            
            for ($i = 0; $i <= 2; $i++) {
                for ($j = 1; $j <= 7; $j++) {
                    $evolution_batch_master = evolutionMasterLevels($i, $j);
                    if (in_array($evolution_batch_master['id'], $assigned_batches)) {
                        $data['evolution_batch_master'][$j] = $evolution_batch_master;
                    } else {
                        if (!isset($data['evolution_batch_master'][$j])) {
                            $evolution_batch_master = evolutionMasterLevels(0, $j);
                            $data['evolution_batch_master'][$j] = $evolution_batch_master;
                        }
                    }
                }
            }
        } else {
            $data['ac_sc_clan_name'] = null;
            $data['batch_detail'] = null;
            $data['cover_image'] = IMG_URL . 'banner.png';
        }

        //For Timeline
        $obj = new Notification();
        $obj->where('to_id', $id);
        $obj->or_where('from_id', $id);
        $obj->get();
        $data['per_page'] = ceil($obj->result_count() / 10);
        
        $this->layout->view('profiles/view', $data);
    }
    
    function editProfile($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $user = new User();
                $user->where('id', $id)->get();
                $session = $this->session->userdata('user_session');
                $user_data = new stdClass();
                if ($_FILES['avtar']['name'] != '') {
                    $avtar = $this->uploadAvtar($id);
                    $user->avtar = $avtar['file_name'];
                    $session->avtar = $user->avtar;
                }
                
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
                $user->username = $this->input->post('username');
                $user->address = $this->input->post('address');
                $user->phone_no_1 = $this->input->post('phone_no_1');
                $user->phone_no_2 = $this->input->post('phone_no_2');
                $user->quote = $this->input->post('quote');
                $user->about_me = $this->input->post('about_me');
                
                $user->user_id = $this->session_data->id;
                $user->save();
                
                if (in_array(6, explode(',', $user->role_id))) {
                    $userdetail = new Userdetail();
                    $userdetail->where('student_master_id', $id)->get();
                    $userdetail->color_of_blade = @$this->input->post('color_of_blade');
                    $userdetail->palce_of_birth = @$this->input->post('palce_of_birth');
                    $userdetail->zip_code = @$this->input->post('zip_code');
                    $userdetail->tax_code = @$this->input->post('tax_code');
                    $userdetail->blood_group = @$this->input->post('blood_group');
                    $userdetail->save();
                }
                
                $session->logged_in_name = $this->input->post('firstname');
                $session->name = $this->input->post('firstname') . ' ' . $this->input->post('lastname');
                $session->email = $this->input->post('email');
                $newdata = array('user_session' => $session);
                $this->session->set_userdata($newdata);
                
                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'profile', 'refresh');
            } else if ($id == $this->session_data->id) {
                $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('profile'));
                $profile = new User();
                $data['profile'] = $profile->where('id', $id)->get();
                
                if (in_array(6, explode(',', $data['profile']->role_id))) {
                    $userdetail = new Userdetail();
                    $data['userdetail'] = $userdetail->where('student_master_id', $id)->get();
                }
                $clan = new Clan();
                $cities_ids = $clan->getCitiesofClans();
                
                $city = new City();
                $data['cities'] = $city->where_in('id', $cities_ids)->get();
                
                $this->layout->view('profiles/edit', $data);
            } else {
                $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
                redirect(base_url() . 'profile', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'profile', 'refresh');
        }
    }
    
    function changePassword() {
        if ($this->input->post() !== false) {
            $obj = new User();
            $obj->where('id', $this->session_data->id);
            $obj->update('password', md5($this->input->post('new_pwd')));
            $this->session->set_flashdata('success', $this->lang->line('password_change_success'));
            redirect(base_url() . 'profile', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('change_password'));
            $this->layout->view('profiles/change_password');
        }
    }
    
    function uploadAvtar($id) {
        $this->upload->initialize(array('upload_path' => "./assets/img/user_avtar/original", 'allowed_types' => 'jpg|jpeg|gif|png|bmp', 'overwrite' => FALSE, 'remove_spaces' => TRUE, 'encrypt_name' => TRUE));
        
        if (!$this->upload->do_upload('avtar')) {
            $data = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data('avtar'));
        }
        
        if (isset($data['upload_data'])) {
            if ($data['upload_data']['file_name'] != '') {
                $obj = new User();
                $obj->where('id', $id)->get();
                if ($obj->avtar != null && $obj->avtar != 'no_avatar.jpg') {
                    if (file_exists('assets/img/user_avtar/40X40/' . $obj->avtar)) {
                        unlink('assets/img/user_avtar/40X40/' . $obj->avtar);
                    }
                    
                    if (file_exists('assets/img/user_avtar/70X70/' . $obj->avtar)) {
                        unlink('assets/img/user_avtar/70X70/' . $obj->avtar);
                    }
                    
                    if (file_exists('assets/img/user_avtar/100X100/' . $obj->avtar)) {
                        unlink('assets/img/user_avtar/100X100/' . $obj->avtar);
                    }
                    
                    if (file_exists('assets/img/user_avtar/original/' . $obj->avtar)) {
                        unlink('assets/img/user_avtar/original/' . $obj->avtar);
                    }
                }
                
                $image = str_replace(' ', '_', $data['upload_data']['file_name']);
                $this->load->helper('image_manipulation/image_manipulation');
                include_lib_image_manipulation();
                
                $magicianObj = new imageLib('./assets/img/user_avtar/original/' . $image);
                
                $magicianObj->resizeImage(40, 40, 'exact');
                $magicianObj->saveImage('./assets/img/user_avtar/40X40/' . $image, 100);
                
                $magicianObj->resizeImage(70, 70, 'exact');
                $magicianObj->saveImage('./assets/img/user_avtar/70X70/' . $image, 100);
                
                $magicianObj->resizeImage(100, 100, 'exact');
                $magicianObj->saveImage('./assets/img/user_avtar/100X100/' . $image, 100);
                
                return $data['upload_data'];
            }
        } else if (isset($data['error'])) {
            $this->session->set_flashdata('file_errors', $data['error']);
            redirect(base_url() . 'profile/edit/' . $id, 'refresh');
        }
    }
    
    function changeEmailPrivacy() {
        if ($this->input->post() !== false) {
            
            $user_details = new User($this->session_data->id);
            $user_details->email_privacy = serialize($this->input->post());
            $user_details->save();
            
            $session = $this->session->userdata('user_session');
            $session->email_privacy = $this->input->post();
            $newdata = array('user_session' => $session);
            $this->session->set_userdata($newdata);
            
            $this->session->set_flashdata('success', $this->lang->line('email_privacy_success'));
            redirect(base_url() . 'change_email_privacy', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('email_privacy'));
            
            $temp = array();
            foreach ($this->session_data->all_roles as $role) {
                $temp[$role] = emailPrivacyArray($role);
            }
            $temp[$this->session_data->role] = emailPrivacyArray($this->session_data->role);
            asort($temp);
            $single_dimensional_array = array();
            foreach ($temp as $key_1 => $val_1) {
                if (is_array($val_1)) {
                    foreach ($val_1 as $key_2 => $val_2) {
                        $single_dimensional_array[$key_2] = $val_2;
                    }
                }
            }
            
            $data['emails'] = $single_dimensional_array;
            
            $this->layout->view('profiles/email_privacy', $data);
        }
    }
}
