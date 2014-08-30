<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class events extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('event'));
        $this->session_data = $this->session->userdata('user_session');
    }

    function viewEvent($id = null, $type = null) {
        if (is_null($id)) {
            $event = new Event();
            $data['events'] = $event->get();
            $this->layout->view('events/view', $data);
        } else {
            if ($type == 'notification') {
                //update notification status
            }

            $event = new Event();
            $event->where('id', $id)->get();
            if($event->result_count() == 1){
                $data['event_detail'] = $event;
                $this->layout->view('events/view_single', $data);    
            } else {
                redirect(base_url() .'event' ,'refresh');
            }
        }
    }

    function addEvent() {
        if ($this->input->post() !== false) {
            $event = new Event();
            
            if ($_FILES['event_image']['name'] != '') {
                $image = $this->uploadImage();
                if (isset($image['error'])) {
                    $this->session->set_flashdata('file_errors', $image['error']);
                    redirect(base_url() . 'event/add', 'refresh');
                } else if (isset($image['upload_data'])) {
                    $event->image = $image['upload_data']['file_name'];
                }
            }

            foreach ($this->config->item('custom_languages') as $key => $value) {
                $temp = $key . '_name';
                if ($this->input->post($temp) != '') {
                    $event->$temp = $this->input->post($temp);
                } else {
                    $event->$temp = $this->input->post('en_name');
                }
            }
            $event->eventcategory_id = $this->input->post('eventcategory_id');

            if ($this->input->post('event_for') == 'A') {
                $event->event_for = 'AC';
                $school = new School();
                $event->school_id = implode(',', $school->getAllSchoolIdFromAcademy($this->input->post('academy_id')));
            } else if ($this->input->post('event_for') == 'S') {
                $event->event_for = 'SC';
                $event->school_id = implode(',', $this->input->post('school_id'));
            } else {
                $event->event_for = 'ALL';
                $event->school_id = '0';
            }

            $event->city_id = $this->input->post('city_id');
            $event->date_from = date('Y-m-d', strtotime($this->input->post('date_from')));
            $event->date_to = date('Y-m-d', strtotime($this->input->post('date_to')));
            $event->manager = implode(',', array_unique($this->input->post('manager')));
            $event->description = $this->input->post('description');
            $event->user_id = $this->session_data->id;
            $event->save();
            $this->session->set_flashdata('success', $this->lang->line('add_data_success'));
            redirect(base_url() . 'event', 'refresh');
        } else {
            $this->layout->setField('page_title', $this->lang->line('add') . ' ' . $this->lang->line('event'));

            $event_category = new Eventcategory();
            $event_category->order_by($this->session_data->language . '_name', 'ASC');
            $event_category->get();
            $data['event_categories'] = $event_category;

            $city = new City();
            $city->order_by($this->session_data->language . '_name', 'ASC');
            $city->get();
            $data['cities'] = $city;

            $academy = new Academy();
            $academy->order_by($this->session_data->language . '_academy_name', 'ASC');
            $academy->get();
            $data['academies'] = $academy;

            $school = new School();
            $school->order_by($this->session_data->language . '_school_name', 'ASC');
            $school->get();
            $data['schools'] = $school;

            $role = new Role();
            $data['roles'] = $role->where('is_manager', 1)->get();

            $this->layout->view('events/add', $data);
        }
    }

    function editEvent($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $event = new Event();
                $event->where('id', $id)->get();

                if ($_FILES['event_image']['name'] != '') {
                    $image = $this->uploadImage();
                    if (isset($image['error'])) {
                        $this->session->set_flashdata('file_errors', $image['error']);
                        redirect(base_url() . 'event/edit/' . $id, 'refresh');
                    } else if (isset($image['upload_data'])) {
                        if($event->image != 'no-cover.jpg') {
                            if (file_exists('assets/img/event_images/' . $event->image)) {
                                unlink('assets/img/event_images/' . $event->image);
                            }
                        }
                        $event->image = $image['upload_data']['file_name'];
                    }
                }

                foreach ($this->config->item('custom_languages') as $key => $value) {
                    $temp = $key . '_name';
                    if ($this->input->post($temp) != '') {
                        $event->$temp = $this->input->post($temp);
                    } else {
                        $event->$temp = $this->input->post('en_name');
                    }
                }
                $event->eventcategory_id = $this->input->post('eventcategory_id');

                if ($this->input->post('event_for') == 'A') {
                    $event->event_for = 'AC';
                    $school = new School();
                    $event->school_id = implode(',', $school->getAllSchoolIdFromAcademy($this->input->post('academy_id')));
                } else if ($this->input->post('event_for') == 'S') {
                    $event->event_for = 'SC';
                    $event->school_id = implode(',', $this->input->post('school_id'));
                } else {
                    $event->event_for = 'ALL';
                    $event->school_id = '0';
                }

                $event->city_id = $this->input->post('city_id');
                $event->date_from = date('Y-m-d', strtotime($this->input->post('date_from')));
                $event->date_to = date('Y-m-d', strtotime($this->input->post('date_to')));
                $event->manager = implode(',', array_unique($this->input->post('manager')));
                $event->description = $this->input->post('description');
                $event->user_id = $this->session_data->id;
                $event->save();
                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'event', 'refresh');
            } else {
                $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('event'));
                $events = new Event();
                $data['event'] = $events->where('id', $id)->get();

                $event_category = new Eventcategory();
                $event_category->order_by($this->session_data->language . '_name', 'ASC');
                $event_category->get();
                $data['event_categories'] = $event_category;

                $city = new City();
                $city->order_by($this->session_data->language . '_name', 'ASC');
                $city->get();
                $data['cities'] = $city;

                $academy = new Academy();
                $academy->order_by($this->session_data->language . '_academy_name', 'ASC');
                $academy->get();
                $data['academies'] = $academy;

                $school = new School();
                $school->order_by($this->session_data->language . '_school_name', 'ASC');
                $school->get();
                $data['schools'] = $school;


                if ($events->event_for == 'AC') {
                    $school->where_in('id', $events->school_id)->get();
                    $data['academy_id'] = $school->academy_id;
                }

                $role = new Role();
                $data['roles'] = $role->where('is_manager', 1)->get();

                $selected_manager = new User();
                $data['selected_manager'] = $selected_manager->where_in('id', explode(',', $events->manager))->get();

                $this->layout->view('events/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'event', 'refresh');
        }
    }

    function deleteEvent($id) {
        if (!empty($id)) {
            $event = new Event();
            $event->where('id', $id)->get();
                if($event->image != 'no-cover.jpg') {
                    if (file_exists('assets/img/event_images/' . $event->image)) {
                        unlink('assets/img/event_images/' . $event->image);
                    }
                }
            $event->delete();
            $this->session->set_flashdata('success', $this->lang->line('delete_data_success'));
        } else {
            $this->session->set_flashdata('error', $this->lang->line('delete_data_error'));
        }
        redirect(base_url() . 'event', 'refresh');
    }

    function uploadImage() {
        $this->upload->initialize(array(
            'upload_path'   => "./assets/img/event_images/",
            'allowed_types' => 'jpg|jpeg|gif|png|bmp',
            'overwrite' => FALSE,
            'remove_spaces' => TRUE,
            'encrypt_name' => TRUE
        ));

        if (!$this->upload->do_upload('event_image')) {
            $data = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data('event_image'));

            $image = str_replace(' ', '_', $data['upload_data']['file_name']);
            $this->load->helper('image_manipulation/image_manipulation');
            include_lib_image_manipulation();

            $magicianObj = new imageLib('./assets/img/event_images/' . $image);

            $magicianObj->resizeImage(780, 450, 'landscape');
            $magicianObj->saveImage('./assets/img/event_images/' . $image, 100);
        }

        return $data;
    }

    function sendEventInvitation($event_id){
        $this->_getIds('to_academies', 1);
        //check Event it is passed or not
        if(!empty($event_id)){
            $event_detail = new Event();
            $event_detail->where('id', $event_id)->get();

            //Check data exits or not
            if($event_detail->result_count() == 1){
                if($this->input->post() !== false){
                    echo '<pre>';
                    print_r($_POST);
                    echo '<pre>';
                    exit();
                }else{
                    $data['event_detail'] = $event_detail;
                    $data['users'] = $this->_getUsers();
                    $data['academies'] = $this->_getAcademies();
                    $data['schools'] = $this->_getSchools();
                    $data['clans'] = $this->_getClans();
                    $data['students'] = $this->_getStudents();
                   
                    $this->layout->view('events/send_invitation', $data);
                }
            }else{
                $this->session->set_flashdata('error', $this->lang->line('no_data_exit'));
                redirect(base_url() .'dashboard', 'refresh');
            }
        }else{
            $this->session->set_flashdata('error', $this->lang->line('unauthorize_access'));
            redirect(base_url() .'dashboard', 'refresh');
        }
    }

    private function _getUsers(){
        if($this->session_data->role == 1){
            $user = new User();
            return $user->where('status', 'A')->get();
        }

        if($this->session_data->role == 2){
            $user = new User();
            return $user->where(array('role_id <>' =>1,'status'=> 'A'))->get();
        }

        if($this->session_data->role == 3){
            $array = array();

            $academy = new Academy();
            $array[] = $academy->getRelatedRectorsByRector($this->session_data->id);

            $school = new School();
            $array[] = $school->getRelatedDeansByRector($this->session_data->id);

            $class = new Clan();
            $array[] = $class->getRelatedTeachersByRector($this->session_data->id);

            $user_detail = new Userdetail();
            $array[] = $user_detail->getRelatedStudentsByRector($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails(array_unique(MultiArrayToSinlgeArray($array)));
        }

        if($this->session_data->role == 4){
            $array = array();

            $academy = new Academy();
            $array[] = $academy->getRelatedRectorsByDean($this->session_data->id);

            $school = new School();
            $array[] = $school->getRelatedDeansByDean($this->session_data->id);

            $class = new Clan();
            $array[] = $class->getRelatedTeachersByDean($this->session_data->id);

            $user_detail = new Userdetail();
            $array[] = $user_detail->getRelatedStudentsByDean($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails(array_unique(MultiArrayToSinlgeArray($array)));
        }

        if($this->session_data->role == 5){
            $array = array();

            $academy = new Academy();
            $array[] = $academy->getRelatedRectorsByTeacher($this->session_data->id);

            $school = new School();
            $array[] = $school->getRelatedDeansByTeacher($this->session_data->id);

            $class = new Clan();
            $array[] = $class->getRelatedTeachersByTeacher($this->session_data->id);

            $user_detail = new Userdetail();
            $array[] = $user_detail->getRelatedStudentsByTeacher($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails(array_unique(MultiArrayToSinlgeArray($array)));
        }

        if($this->session_data->role == 6){
            $array = array();

            $academy = new Academy();
            $array[] = $academy->getRelatedRectorsByStudent($this->session_data->id);

            $school = new School();
            $array[] = $school->getRelatedDeansByStudent($this->session_data->id);

            $class = new Clan();
            $array[] = $class->getRelatedTeachersByStudent($this->session_data->id);

            $user_detail = new Userdetail();
            $array[] = $user_detail->getRelatedStudentsByStudent($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails(array_unique(MultiArrayToSinlgeArray($array)));
        }
    }

    private function _getAcademies(){
        if($this->session_data->role == 1){
            $academy = new Academy();
            return $academy->get();
        }

        if($this->session_data->role == 2){
            $academy = new Academy();
            return $academy->get();
        }

         if($this->session_data->role == 3){
            $academy = new Academy();
            return $academy->getAcademyOfRector($this->session_data->id);
        }

        if($this->session_data->role == 4){
            $academy = new Academy();
            return $academy->getAcademyOfDean($this->session_data->id);
        }

        if($this->session_data->role == 5){
            $academy = new Academy();
            return $academy->getAcademyOfTeacher($this->session_data->id);
        }

        if($this->session_data->role == 6){
            $academy = new Academy();
            return $academy->getAcademyOfStudent($this->session_data->id);
        }
    }

    private function _getSchools(){
        if($this->session_data->role == 1){
            $school = new School();
            return $school->get();
        }

        if($this->session_data->role == 2){
            $school = new School();
            return $school->get();
        }

        if($this->session_data->role == 3){
            $school = new School();
            return $school->getSchoolOfRector($this->session_data->id);
        }

        if($this->session_data->role == 4){
            $school = new School();
            return $school->getSchoolOfDean($this->session_data->id);
        }

        if($this->session_data->role == 5){
            $school = new School();
            return $school->getSchoolOfTeacher($this->session_data->id);
        }

        if($this->session_data->role == 6){
            $school = new School();
            return $school->getSchoolOfStudent($this->session_data->id);
        }
    }

    private function _getClans(){
        if($this->session_data->role == 1){
            $clan = new Clan();
            return $clan->get();
        }

        if($this->session_data->role == 2){
            $clan = new Clan();
            return $clan->get();
        }

        if($this->session_data->role == 3){
            $clan = new Clan();
            return $clan->getClanOfRector($this->session_data->id);
        }

        if($this->session_data->role == 4){
            $clan = new Clan();
            return $clan->getClanOfDean($this->session_data->id);
        }

        if($this->session_data->role == 5){
            $clan = new Clan();
            return $clan->getClanOfTeacher($this->session_data->id);
        }

        if($this->session_data->role == 6){
            $clan = new Clan();
            return $clan->getClanOfStudent($this->session_data->id);
        }
    }

    private function _getStudents(){
        if($this->session_data->role == 1){
            $student = new User();
            return $student->where('role_id', 6)->get();
        }

        if($this->session_data->role == 2){
            $student = new User();
            return $student->where('role_id', 6)->get();
        }

        if($this->session_data->role == 3){
            $student = new Userdetail();
            $array = $student->getRelatedStudentsByRector($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($array);
        }

        if($this->session_data->role == 4){
            $student = new Userdetail();
            $array = $student->getRelatedStudentsByDean($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($array);
        }

        if($this->session_data->role == 5){
            $student = new Userdetail();
            $array = $student->getRelatedStudentsByTeacher($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($array);
        }

        if($this->session_data->role == 6){
            $student = new Userdetail();
            $array = $student->getRelatedStudentsByStudent($this->session_data->id);

            $user = new User();
            return $user->getUsersDetails($array);
        }
    }

    private function _getIds($type, $id){
        if($type == 'to_academies'){
            $array = array();

            $academy = new Academy();
            $array[] = $academy->getRecotrsByAcademy($id);

            $school = new School();
            $array[] = $school->getDeansByAcademy($id);

            $clan= new Clan();
            $array[] = $clan->getTeachersByAcademy($id);

            $user = new Userdetail();
            $array[] = $user->getStudentsByAcademy($id);

            $array = array_unique(MultiArrayToSinlgeArray($array));
            echo '<pre>';
            print_r($array);
            echo '<pre>';
            exit();
        }

        if($type == 'to_schools'){
            
        }

        if($type == 'to_clans'){
            
        }
    }

}
