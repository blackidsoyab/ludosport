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

    function viewEvent() {
        $this->layout->view('events/view');
    }

    function addEvent() {
        if ($this->input->post() !== false) {
            $event = new Event();
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
            $event->manager = implode(',', $this->input->post('manager'));
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

            $user = new User();
            $data['users'] = $user->getUserBelowRole($this->session_data->role);

            $this->layout->view('events/add', $data);
        }
    }

    function editEvent($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {
                $event = new Event();
                $event->where('id', $id)->get();
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
                $event->manager = implode(',', $this->input->post('manager'));
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

                $user = new User();
                $data['users'] = $user->getUserBelowRole($this->session_data->role);

                $this->layout->view('events/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'event', 'refresh');
        }
    }

    function deleteEvent($id) {
        if (!empty($id)) {
            $c = new Event();
            $c->where('id', $id)->get();
            $c->delete();
            $this->session->set_flashdata('success', $this->lang->line('delete_data_success'));
            redirect(base_url() . 'event', 'refresh');
        } else {
            $this->session->set_flashdata('error', $this->lang->line('delete_data_error'));
            redirect(base_url() . 'event', 'refresh');
        }
    }

}
