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

                foreach ($this->config->item('custom_languages') as $key => $value) {
                    if ($this->input->post($key . '_description') != '' && $this->input->post($key . '_description') != '<p><br></p>') {
                            $evolutioncategory->{$key . '_description'} = $this->input->post($key . '_description');
                    } else {
                        $evolutioncategory->{$key . '_description'} = $this->input->post('en_description');
                    }
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
