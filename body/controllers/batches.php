<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class batches extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('batch'));
        $this->session_data = $this->session->userdata('user_session');
    }

    function viewBatch($id = null, $type = null) {
        if (is_null($id)) {
            $this->layout->view('batches/view');
        } else {
            $batch = new Batch();
            $data['batch'] = $batch->where('id', $id)->get();

            $role = new Role();
            $data['roles'] = $role->where('id >', 1)->get();
            
            $this->layout->view('batches/view_single', $data);
        }
    }

    function addBatch() {
        if ($this->input->post() !== false) {
            $batch = new Batch();

            if ($_FILES['batch_image']['name'] != '') {
                $image = $this->uploadImage('batch_image');
                if (isset($image['error'])) {
                    $this->session->set_flashdata('file_errors', $image['error']);
                    redirect(base_url() . 'batch/add', 'refresh');
                } else if (isset($image['upload_data'])) {
                    $batch->image = $image['upload_data']['file_name'];
                }
            }

            if ($_FILES['batch_dashboard_cover']['name'] != '') {
                $image = $this->uploadImage('batch_dashboard_cover');
                if (isset($image['error'])) {
                    $this->session->set_flashdata('file_errors_dashboard', $image['error']);
                    redirect(base_url() . 'batch/add', 'refresh');
                } else if (isset($image['upload_data'])) {
                    $batch->dashboard_cover = $image['upload_data']['file_name'];
                }
            }

            if ($_FILES['batch_profile_cover']['name'] != '') {
                $image = $this->uploadImage('batch_profile_cover');
                if (isset($image['error'])) {
                    $this->session->set_flashdata('file_errors_profile', $image['error']);
                    redirect(base_url() . 'batch/add', 'refresh');
                } else if (isset($image['upload_data'])) {
                    $batch->profile_cover = $image['upload_data']['file_name'];
                }
            }

            foreach ($this->config->item('custom_languages') as $key => $value) {
                $temp = $key . '_name';
                if ($this->input->post($temp) != '') {
                    $batch->$temp = $this->input->post($temp);
                } else {
                    $batch->$temp = $this->input->post('en_name');
                }
            }

            $batch->type = $this->input->post('type');
            $batch->assign_role = implode(',', $this->input->post('assign_role'));

            if($this->input->post('has_point') == 1){
                $batch->has_point = 1;
                $batch->xpr = $this->input->post('xpr');
                $batch->war = $this->input->post('war');
                $batch->sty = $this->input->post('sty');
            }else{
                $batch->has_point = 0;
                $batch->xpr = 0;
                $batch->war = 0;
                $batch->sty = 0;
            }

            $batch->description = $this->input->post('description');
            $batch->user_id = $this->session_data->id;
            $batch->save();
            $this->session->set_flashdata('success', $this->lang->line('add_data_success'));
            redirect(base_url() . 'batch', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('add') . ' ' . $this->lang->line('batch'));

            $role = new Role();
            $data['roles'] = $role->where('id >', 1)->get();

            $this->layout->view('batches/add', $data);
        }
    }

    function editBatch($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $batch = new Batch();
                $batch->where('id', $id)->get();

                if ($_FILES['batch_image']['name'] != '') {
                    $image = $this->uploadImage('batch_image');
                    if (isset($image['error'])) {
                        $this->session->set_flashdata('file_errors', $image['error']);
                        redirect(base_url() . 'batch/edit/' . $id, 'refresh');
                    } else if (isset($image['upload_data'])) {

                        if (!is_null($batch->image) && file_exists('assets/img/batches/' . $batch->image)) {
                            unlink('assets/img/batches/' . $batch->image);
                        }

                        $batch->image = $image['upload_data']['file_name'];
                    }
                }

                if ($_FILES['batch_dashboard_cover']['name'] != '') {
                    $image = $this->uploadImage('batch_dashboard_cover');
                    if (isset($image['error'])) {
                        $this->session->set_flashdata('file_errors_cover', $image['error']);
                        redirect(base_url() . 'batch/edit/' . $id, 'refresh');
                    } else if (isset($image['upload_data'])) {
                        if (!is_null($batch->dashboard_cover) && file_exists('assets/img/batches/dashboard_cover/' . $batch->dashboard_cover)) {
                            unlink('assets/img/batches/dashboard_cover/' . $batch->dashboard_cover);
                        }
                        $batch->dashboard_cover = $image['upload_data']['file_name'];
                    }
                }

                if ($_FILES['batch_profile_cover']['name'] != '') {
                    $image = $this->uploadImage('batch_profile_cover');
                    if (isset($image['error'])) {
                        $this->session->set_flashdata('file_errors_profile', $image['error']);
                        redirect(base_url() . 'batch/edit/' . $id, 'refresh');
                    } else if (isset($image['upload_data'])) {
                        if (!is_null($batch->profile_cover) && file_exists('assets/img/batches/profile_cover/' . $batch->profile_cover)) {
                            unlink('assets/img/batches/profile_cover/' . $batch->profile_cover);
                        }
                        $batch->profile_cover = $image['upload_data']['file_name'];
                    }
                }

                foreach ($this->config->item('custom_languages') as $key => $value) {
                    $temp = $key . '_name';
                    if ($this->input->post($temp) != '') {
                        $batch->$temp = $this->input->post($temp);
                    } else {
                        $batch->$temp = $this->input->post('en_name');
                    }
                }

                $batch->type = $this->input->post('type');
                $batch->assign_role = implode(',', $this->input->post('assign_role'));

                if($this->input->post('has_point') == 1){
                    $batch->has_point = 1;
                    $batch->xpr = $this->input->post('xpr');
                    $batch->war = $this->input->post('war');
                    $batch->sty = $this->input->post('sty');
                }else{
                    $batch->has_point = 0;
                    $batch->xpr = 0;
                    $batch->war = 0;
                    $batch->sty = 0;
                }

                $batch->description = $this->input->post('description');
                $batch->user_id = $this->session_data->id;
                $batch->save();
                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'batch', 'refresh');
            } else {
                $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('batch'));
                $batch = new Batch();
                $data['batch'] = $batch->where('id', $id)->get();

                $role = new Role();
                $data['roles'] = $role->where('id >', 1)->get();

                $this->layout->view('batches/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'batch', 'refresh');
        }
    }

    function deleteBatch($id) {
        if (!empty($id)) {
            $batch = new Batch();
            $batch->where('id', $id)->get();
            if (file_exists('assets/img/batches/' . $batch->image)) {
                unlink('assets/img/batches/' . $batch->image);
            }
            if (!is_null($batch->dashboard_cover) && file_exists('assets/img/batches/dashboard_cover/' . $batch->dashboard_cover)) {
                unlink('assets/img/batches/dashboard_cover/' . $batch->dashboard_cover);
            }
            if (!is_null($batch->profile_cover) && file_exists('assets/img/batches/profile_cover/' . $batch->profile_cover)) {
                unlink('assets/img/batches/profile_cover/' . $batch->profile_cover);
            }
            $batch->delete();
            $this->session->set_flashdata('success', $this->lang->line('delete_data_success'));
            redirect(base_url() . 'batch', 'refresh');
        } else {
            $this->session->set_flashdata('error', $this->lang->line('delete_data_error'));
            redirect(base_url() . 'batch', 'refresh');
        }
    }

    function uploadImage($field) {
        if($field == 'batch_image'){
            $this->upload->initialize(array(
                'upload_path'   => "./assets/img/batches/",
                'allowed_types' => 'jpg|jpeg|gif|png|bmp',
                'overwrite' => FALSE,
                'remove_spaces' => TRUE,
                'encrypt_name' => TRUE
            ));
        }

        if($field == 'batch_dashboard_cover'){
            $this->upload->initialize(array(
                'upload_path'   => "./assets/img/batches/dashboard_cover/",
                'allowed_types' => 'jpg|jpeg|gif|png|bmp',
                'overwrite' => FALSE,
                'remove_spaces' => TRUE,
                'encrypt_name' => TRUE
            ));
        }

        if($field == 'batch_profile_cover'){
            $this->upload->initialize(array(
                'upload_path'   => "./assets/img/batches/profile_cover/",
                'allowed_types' => 'jpg|jpeg|gif|png|bmp',
                'overwrite' => FALSE,
                'remove_spaces' => TRUE,
                'encrypt_name' => TRUE
            ));
        }
        

        if (!$this->upload->do_upload($field)) {
            $data = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data($field));

            if ($field == 'batch_image' && $data['upload_data']['file_name'] != '') {
                $image = str_replace(' ', '_', $data['upload_data']['file_name']);
                $this->load->helper('image_manipulation/image_manipulation');
                include_lib_image_manipulation();
                $magicianObj = new imageLib('./assets/img/batches/' . $image);
                $magicianObj->resizeImage(120, 120, 'exact');
                $magicianObj->saveImage('./assets/img/batches/' . $image, 100);
            }

            if ($field == 'batch_dashboard_cover' && $data['upload_data']['file_name'] != '') {
                $image = str_replace(' ', '_', $data['upload_data']['file_name']);
                $this->load->helper('image_manipulation/image_manipulation');
                include_lib_image_manipulation();
                $magicianObj = new imageLib('./assets/img/batches/dashboard_cover/' . $image);
                $magicianObj->resizeImage(675, 280, 'exact');
                $magicianObj->saveImage('./assets/img/batches/dashboard_cover/' . $image, 100);
            }

            if ($field == 'batch_profile_cover' && $data['upload_data']['file_name'] != '') {
                $image = str_replace(' ', '_', $data['upload_data']['file_name']);
                $this->load->helper('image_manipulation/image_manipulation');
                include_lib_image_manipulation();
                $magicianObj = new imageLib('./assets/img/batches/profile_cover/' . $image);
                $magicianObj->resizeImage(675, 280, 'exact');
                $magicianObj->saveImage('./assets/img/batches/profile_cover/' . $image, 100);
            }
        }

        return $data;
    }

}
