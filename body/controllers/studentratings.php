<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class studentratings extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('rating'));
        $this->session_data = $this->session->userdata('user_session');
    }

    function viewStudentrating($id = null, $type = null) {
        $academy = new Academy();
        $school = new School();
        $clan = new Clan();

        if ($id != 0 && $type == 'academy') {
            $data['all_academies'] = $academy->where('id', $id)->get();
            $data['all_schools'] = $academy->school->get();
            $data['all_clans'] = $academy->school->clan->get();

            $data['academy_id'] = $id;
        } else if ($id != 0 && $type == 'school') {
            $temp = $school->where('id', $id)->get();
            $data['all_schools'] = $school->where('academy_id', $temp->academy_id)->get();
            $data['all_academies'] = $school->academy->get();
            $data['all_clans'] = $school->clan->get();

            $data['academy_id'] = $temp->academy_id;
            $data['school_id'] = $id;
        } else if ($id != 0 && $type == 'clan') {
            $temp = $clan->where('id', $id)->get();
            $data['all_clans'] = $clan->where('school_id', $temp->school_id)->get();
            $data['all_schools'] = $clan->school->get();
            $data['all_academies'] = $clan->school->academy->get();

            $data['academy_id'] = $temp->academy_id;
            $data['school_id'] = $temp->school_id;
            $data['clan_id'] = $id;
        } else {
            if ($this->session_data->role == '1' || $this->session_data->role == '2') {
                $data['all_academies'] = $academy->get();
                $data['all_schools'] = $school->get();
                $data['all_clans'] = $clan->get();
            } else if ($this->session_data->role == '3') {
                $data['all_academies'] = $academy->getAcademyOfRector($this->session_data->id);
                $data['all_schools'] = $school->getSchoolOfRector($this->session_data->id);
                $data['all_clans'] = $clan->getClanOfRector($this->session_data->id);
            } else if ($this->session_data->role == '4') {
                $data['all_academies'] = $academy->getAcademyOfDean($this->session_data->id);
                $data['all_schools'] = $school->getSchoolOfDean($this->session_data->id);
                $data['all_clans'] = $clan->getClanOfDean($this->session_data->id);
            } else if ($this->session_data->role == '5') {
                $data['all_academies'] = $academy->getAcademyOfTeacher($this->session_data->id);
                $data['all_schools'] = $school->getSchoolOfTeacher($this->session_data->id);
                $data['all_clans'] = $clan->getClanOfTeacher($this->session_data->id);
            }
        }

        $this->layout->view('studentratings/view', $data);
    }

    function editStudentrating($id) {
        if (!empty($id)) {
            if ($this->input->post() !== false) {

                $oper = $this->input->post('oper');
                $score = $this->input->post('score');
                $description = $this->input->post('description');
               
                if($oper['xpr'] != 'N'){
                    $obj_score = new Scorehistory();
                    if($oper['xpr'] == 'M'){
                        $obj_score->meritStudentScore($id,'xpr', $score['xpr'], $description['xpr']);     
                    }

                    if($oper['xpr'] == 'D'){
                       $obj_score->demeritStudentScore($id,'xpr', $score['xpr'], $description['xpr']);
                    }
                }

                if($oper['war'] != 'N'){
                    if($oper['war'] == 'M'){
                        $obj_score->meritStudentScore($id,'war', $score['war'], $description['war']);   
                    }

                    if($oper['war'] == 'D'){
                        $obj_score->demeritStudentScore($id,'war', $score['war'], $description['war']);   
                    }
                }

                if($oper['sty'] != 'N'){
                    if($oper['sty'] == 'M'){
                        $obj_score->meritStudentScore($id,'sty', $score['sty'], $description['sty']);   
                    }

                    if($oper['sty'] == 'D'){
                        $obj_score->demeritStudentScore($id,'sty', $score['sty'], $description['sty']);   
                    }
                }
                
                $this->session->set_flashdata('success', $this->lang->line('edit_data_success'));
                redirect(base_url() . 'studentrating', 'refresh');
            } else {
                $this->layout->setField('page_title', $this->lang->line('edit') . ' ' . $this->lang->line('rating'));

                $user = new User($id);
                $data['user'] = $user;

                $userdetails = new Userdetail();
                $data['userdetails'] = $userdetails->where('student_master_id', $id)->get();

                $this->layout->view('studentratings/edit', $data);
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('edit_data_error'));
            redirect(base_url() . 'studentrating', 'refresh');
        }
    }

}
