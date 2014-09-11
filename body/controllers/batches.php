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

            if ($_FILES['batch_cover_image']['name'] != '') {
                $image = $this->uploadImage('batch_cover_image');
                if (isset($image['error'])) {
                    $this->session->set_flashdata('file_errors_cover', $image['error']);
                    redirect(base_url() . 'batch/add', 'refresh');
                } else if (isset($image['upload_data'])) {
                    $batch->cover_image = $image['upload_data']['file_name'];
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
            $batch->description = $this->input->post('description');
            $batch->user_id = $this->session_data->id;
            $batch->save();
            $this->session->set_flashdata('success', $this->lang->line('add_data_success'));
            redirect(base_url() . 'batch', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('add') . ' ' . $this->lang->line('batch'));
            $this->layout->view('batches/add');
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

                if ($_FILES['batch_cover_image']['name'] != '') {
                    $image = $this->uploadImage('batch_cover_image');
                    if (isset($image['error'])) {
                        $this->session->set_flashdata('file_errors_cover', $image['error']);
                        redirect(base_url() . 'batch/edit/' . $id, 'refresh');
                    } else if (isset($image['upload_data'])) {
                        if (!is_null($batch->cover_image) && file_exists('assets/img/batches/cover_image/' . $batch->cover_image)) {
                            unlink('assets/img/batches/cover_image/' . $batch->cover_image);
                        }
                        $batch->cover_image = $image['upload_data']['file_name'];
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
                $batch->description = $this->input->post('description');
                $batch->user_id = $this->session_data->id;
                $batch->save();
                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'batch', 'refresh');
            } else {
                $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('batch'));
                $batch = new Batch();
                $data['batch'] = $batch->where('id', $id)->get();
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
            if (!is_null($batch->cover_image) && file_exists('assets/img/batches/cover_image/' . $batch->cover_image)) {
                unlink('assets/img/batches/cover_image/' . $batch->cover_image);
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

        if($field == 'batch_cover_image'){
            $this->upload->initialize(array(
                'upload_path'   => "./assets/img/batches/cover_image/",
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

            if ($field == 'batch_cover_image' && $data['upload_data']['file_name'] != '') {
                $image = str_replace(' ', '_', $data['upload_data']['file_name']);
                $this->load->helper('image_manipulation/image_manipulation');
                include_lib_image_manipulation();
                $magicianObj = new imageLib('./assets/img/batches/cover_image/' . $image);
                $magicianObj->resizeImage(675, 280, 'exact');
                $magicianObj->saveImage('./assets/img/batches/cover_image/' . $image, 100);
            }
        }

        return $data;
    }

}
