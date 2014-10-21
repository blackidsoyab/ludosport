<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class evolutioncategories extends CI_Controller
{
    
    var $session_data;
    
    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('evolutioncategory'));
        $this->session_data = $this->session->userdata('user_session');
    }
    
    function viewEvolutioncategory() {
        $this->layout->view('evolutioncategories/view');
    }
    
    function addEvolutioncategory() {
        if ($this->input->post() !== false) {
            $evolutioncategory = new Evolutioncategory();

            if ($_FILES['evolution_image']['name'] != '') {
                $image = $this->uploadImage();
                if (isset($image['error'])) {
                    $this->session->set_flashdata('file_errors', $image['error']);
                    redirect(base_url() . 'evolutioncategories/add', 'refresh');
                } else if (isset($image['upload_data'])) {
                    $evolutioncategory->image = $image['upload_data']['file_name'];
                }
            }


            foreach ($this->config->item('custom_languages') as $key => $value) {
                if ($this->input->post($key . '_name') != '') {
                    $evolutioncategory->{$key . '_name'} = $this->input->post($key . '_name');
                } else {
                    $evolutioncategory->{$key . '_name'} = $this->input->post('en_name');
                }
            }

            if($this->input->post('description') != '' && $this->input->post('description') != '<p><br></p>'){
                $evolutioncategory->description = $this->input->post('description');
            }
            
            $evolutioncategory->user_id = $this->session_data->id;
            $evolutioncategory->save();
            $this->session->set_flashdata('success', $this->lang->line('add_data_success'));
            redirect(base_url() . 'evolutioncategory', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('add') . ' ' . $this->lang->line('evolutioncategory'));
            $this->layout->view('evolutioncategories/add');
        }
    }
    
    function editEvolutioncategory($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $evolutioncategory = new Evolutioncategory();
                $evolutioncategory->where('id', $id)->get();

                if ($_FILES['evolution_image']['name'] != '') {
                    $image = $this->uploadImage();
                    if (isset($image['error'])) {
                        $this->session->set_flashdata('file_errors', $image['error']);
                        redirect(base_url() . 'evolutioncategories/edit/' . $id, 'refresh');
                    } else if (isset($image['upload_data'])) {
                        if ($evolutioncategory->image != 'no-cover.jpg') {
                            if (file_exists('assets/img/evolution_images/' . $evolutioncategory->image)) {
                                unlink('assets/img/evolution_images/' . $evolutioncategory->image);
                            }
                        }
                        $evolutioncategory->image = $image['upload_data']['file_name'];
                    }
                }
                

                foreach ($this->config->item('custom_languages') as $key => $value) {
                    if ($this->input->post($key . '_name') != '') {
                        $evolutioncategory->{$key . '_name'} = $this->input->post($key . '_name');
                    } else {
                        $evolutioncategory->{$key . '_name'} = $this->input->post('en_name');
                    }
                }

                if($this->input->post('description') != '' && $this->input->post('description') != '<p><br></p>'){
                    $evolutioncategory->description = $this->input->post('description');
                }
                
                $evolutioncategory->user_id = $this->session_data->id;
                $evolutioncategory->save();
                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'evolutioncategory', 'refresh');
            } else {
                $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('evolutioncategory'));
                $evolutioncategories = new Evolutioncategory();
                $data['evolutioncategory'] = $evolutioncategories->where('id', $id)->get();
                
                $this->layout->view('evolutioncategories/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'evolutioncategory', 'refresh');
        }
    }
    
    function deleteEvolutioncategory($id) {
        if (!empty($id)) {
            $obj = new Evolutioncategory();
            $obj->where('id', $id)->get();

            if ($obj->image != 'no-cover.jpg') {
                if (file_exists('assets/img/evolution_images/' . $obj->image)) {
                    unlink('assets/img/evolution_images/' . $obj->image);
                }
            }

            $obj->delete();
            $this->session->set_flashdata('success', $this->lang->line('delete_data_success'));
        } else {
            $this->session->set_flashdata('error', $this->lang->line('delete_data_error'));
        }
        redirect(base_url() . 'evolutioncategory', 'refresh');
    }

    //upload the evolution image keep the original image and conver the image in 780*450 & 300*200 scale
    function uploadImage() {
        $this->upload->initialize(array('upload_path' => "./assets/img/evolution_images/", 'allowed_types' => 'jpg|jpeg|gif|png|bmp', 'overwrite' => FALSE, 'remove_spaces' => TRUE, 'encrypt_name' => TRUE));
        
        if (!$this->upload->do_upload('evolution_image')) {
            $data = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data('evolution_image'));
            
            $image = str_replace(' ', '_', $data['upload_data']['file_name']);
            $this->load->helper('image_manipulation/image_manipulation');
            include_lib_image_manipulation();
            
            $magicianObj = new imageLib('./assets/img/evolution_images/' . $image);
            
            $magicianObj->resizeImage(1000, 400, 'exact');
            $magicianObj->saveImage('./assets/img/evolution_images/' . $image, 100);

        }
        
        return $data;
    }
}
