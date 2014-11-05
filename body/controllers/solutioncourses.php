<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class solutioncourses extends CI_Controller
{
    
    var $session_data;
    
    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('solution_course'));
        $this->session_data = $this->session->userdata('user_session');
    }
    
    function viewSolutioncourse($id = null, $type = null) {
        if (is_null($id)) {
            $this->layout->view('solutioncourses/view');
        } else {
            $solutioncourse = new Solutioncourse();
            $data['solutioncourse'] = $solutioncourse->where('id', $id)->get();
            $this->layout->view('solutioncourses/view_single', $data);
        }
    }
    
    function addSolutioncourse() {
        if ($this->input->post() !== false) {
            $solutioncourse = new Solutioncourse();
            
            if ($_FILES['image']['name'] != '') {
                $image = $this->uploadFiles('image');
                if (isset($image['error'])) {
                    $this->session->set_flashdata('file_error_image', $image['error']);
                    redirect(base_url() . 'solutioncourses/add', 'refresh');
                } else if (isset($image['upload_data'])) {
                    $solutioncourse->image = $image['upload_data']['file_name'];
                }
            }
            
            if ($_FILES['form']['name'] != '') {
                $form = $this->uploadFiles('form');
                if (isset($form['error'])) {
                    $this->session->set_flashdata('file_error_form', $form['error']);
                    redirect(base_url() . 'solutioncourses/add', 'refresh');
                } else if (isset($form['upload_data'])) {
                    $solutioncourse->form = $form['upload_data']['file_name'];
                }
            }
            
            foreach ($this->config->item('custom_languages') as $key => $value) {
                $temp = $key . '_name';
                if ($this->input->post($temp) != '') {
                    $solutioncourse->$temp = $this->input->post($temp);
                } else {
                    $solutioncourse->$temp = $this->input->post('en_name');
                }
            }
            
            $solutioncourse->academy_id = $this->input->post('academy_id');
            $solutioncourse->type_1 = $this->input->post('type_1');
            $solutioncourse->type_2 = $this->input->post('type_2');
            $solutioncourse->price = $this->input->post('price');
            $solutioncourse->description = $this->input->post('description');
            $solutioncourse->user_id = $this->session_data->id;
            $solutioncourse->save();
            
            $this->session->set_flashdata('success', $this->lang->line('add_data_success'));
            redirect(base_url() . 'solutioncourse', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('add') . ' ' . $this->lang->line('solutioncourse'));
            
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
            
            $data['solution_type_1'] = getSolutionCoursesType1();
            $data['solution_type_2'] = getSolutionCoursesType2();
            
            $this->layout->view('solutioncourses/add', $data);
        }
    }
    
    function editSolutioncourse($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $solutioncourse = new Solutioncourse();
                $solutioncourse->where('id', $id)->get();
                
                if ($_FILES['image']['name'] != '') {
                    $image = $this->uploadFiles('image');
                    if (isset($image['error'])) {
                        $this->session->set_flashdata('file_error_image', $image['error']);
                        redirect(base_url() . 'solutioncourses/add', 'refresh');
                    } else if (isset($image['upload_data'])) {
                        if (!is_null($solutioncourse->image)) {
                            if (file_exists('assets/img/solution_courses/' . $solutioncourse->image)) {
                                unlink('assets/img/solution_courses/' . $solutioncourse->image);
                            }
                        }
                        $solutioncourse->image = $image['upload_data']['file_name'];
                    }
                }
                
                if ($_FILES['form']['name'] != '') {
                    $form = $this->uploadFiles('form');
                    if (isset($form['error'])) {
                        $this->session->set_flashdata('file_error_form', $form['error']);
                        redirect(base_url() . 'solutioncourses/add', 'refresh');
                    } else if (isset($form['upload_data'])) {
                        if (!is_null($solutioncourse->form)) {
                            if (file_exists('assets/solution_courses_form/' . $solutioncourse->form)) {
                                unlink('assets/solution_courses_form/' . $solutioncourse->form);
                            }
                        }
                        $solutioncourse->form = $form['upload_data']['file_name'];
                    }
                }
                
                foreach ($this->config->item('custom_languages') as $key => $value) {
                    $temp = $key . '_name';
                    if ($this->input->post($temp) != '') {
                        $solutioncourse->$temp = $this->input->post($temp);
                    } else {
                        $solutioncourse->$temp = $this->input->post('en_name');
                    }
                }
                
                $solutioncourse->academy_id = $this->input->post('academy_id');
                $solutioncourse->type_1 = $this->input->post('type_1');
                $solutioncourse->type_2 = $this->input->post('type_2');
                $solutioncourse->price = $this->input->post('price');
                $solutioncourse->description = $this->input->post('description');
                $solutioncourse->user_id = $this->session_data->id;
                $solutioncourse->save();
                
                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'solutioncourse', 'refresh');
            } else {
                $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('solution_course'));
                $solutioncourse = new Solutioncourse();
                $data['solutioncourse'] = $solutioncourse->where('id', $id)->get();
                
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
                
                $data['solution_type_1'] = getSolutionCoursesType1();
                $data['solution_type_2'] = getSolutionCoursesType2();
                $this->layout->view('solutioncourses/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'solutioncourse', 'refresh');
        }
    }
    
    function deleteSolutioncourse($id) {
        if (!empty($id)) {
            $c = new Solutioncourse();
            $c->where('id', $id)->get();
            foreach ($c->State as $v) {
                $v->City->delete_all();
            }
            $c->State->delete_all();
            $c->delete();
            $this->session->set_flashdata('success', $this->lang->line('delete_data_success'));
            redirect(base_url() . 'solutioncourse', 'refresh');
        } else {
            $this->session->set_flashdata('error', $this->lang->line('delete_data_error'));
            redirect(base_url() . 'solutioncourse', 'refresh');
        }
    }
    
    function uploadFiles($field) {
        if ($field == 'image') {
            $this->upload->initialize(array('upload_path' => "./assets/img/solution_courses/", 'allowed_types' => 'jpg|jpeg|gif|png|bmp', 'overwrite' => FALSE, 'remove_spaces' => TRUE, 'encrypt_name' => TRUE));
        }
        
        if ($field == 'form') {
            $this->upload->initialize(array('upload_path' => "./assets/solution_courses_form/", 'allowed_types' => 'pdf|doc|docx', 'overwrite' => FALSE, 'remove_spaces' => TRUE, 'encrypt_name' => TRUE));
        }
        
        if (!$this->upload->do_upload($field)) {
            $data = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data($field));
            
            if ($field == 'form') {
                chmod("./assets/solution_courses_form/" . $data['upload_data']['file_name'], 0755);
            }
        }
        
        return $data;
    }
}
