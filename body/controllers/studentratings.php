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
                    if($oper['xpr'] == 'M' || $oper['xpr'] == 'D'){ 
                        $obj_score = new Scorehistory();
                        $obj_score->student_id = $id;
                        $obj_score->oper = $oper['xpr'];
                        $obj_score->score_type = 'XPR';
                        $obj_score->score = $score['xpr'];
                        $obj_score->score_date = get_current_date_time()->get_date_for_db();
                        $obj_score->description = $description['xpr'];
                        $obj_score->user_id = $this->session_data->id;
                        $obj_score->save();

                        $userdetails = new Userdetail();
                        $userdetails->where('student_master_id', $id)->get();

                        if($oper['xpr'] == 'M'){
                            $userdetails->xpr = (int)$userdetails->xpr + (int)$score['xpr'];
                            $userdetails->total_score = (int)$userdetails->total_score + (int)$score['xpr'];
                        }

                        if($oper['xpr'] == 'D'){
                            $userdetails->xpr = (int)$userdetails->xpr - (int)$score['xpr'];
                            $userdetails->total_score = (int)$userdetails->total_score - (int)$score['xpr'];
                        }

                        $userdetails->save();
                    }
                }

                if($oper['war'] != 'N'){
                    if($oper['war'] == 'M' || $oper['war'] == 'D'){ 
                        $obj_score = new Scorehistory();
                        $obj_score->student_id = $id;
                        $obj_score->oper = $oper['war'];
                        $obj_score->score_type = 'WAR';
                        $obj_score->score = $score['war'];
                        $obj_score->score_date = get_current_date_time()->get_date_for_db();
                        $obj_score->description = $description['war'];
                        $obj_score->user_id = $this->session_data->id;
                        $obj_score->save();

                        $userdetails = new Userdetail();
                        $userdetails->where('student_master_id', $id)->get();

                        if($oper['war'] == 'M'){
                            $userdetails->war = (int)$userdetails->war + (int)$score['war'];
                            $userdetails->total_score = (int)$userdetails->total_score + (int)$score['war'];
                        }

                        if($oper['war'] == 'D'){
                            $userdetails->war = (int)$userdetails->war - (int)$score['war'];
                            $userdetails->total_score = (int)$userdetails->total_score - (int)$score['war'];
                        }

                        $userdetails->save();
                    }
                }

                if($oper['sty'] != 'N'){
                    if($oper['sty'] == 'M' || $oper['sty'] == 'D'){ 
                        $obj_score = new Scorehistory();
                        $obj_score->student_id = $id;
                        $obj_score->oper = $oper['sty'];
                        $obj_score->score_type = 'STY';
                        $obj_score->score = $score['sty'];
                        $obj_score->score_date = get_current_date_time()->get_date_for_db();
                        $obj_score->description = $description['sty'];
                        $obj_score->user_id = $this->session_data->id;
                        $obj_score->save();

                        $userdetails = new Userdetail();
                        $userdetails->where('student_master_id', $id)->get();

                        if($oper['sty'] == 'M'){
                            $userdetails->sty = (int)$userdetails->sty + (int)$score['sty'];
                            $userdetails->total_score = (int)$userdetails->total_score + (int)$score['sty'];
                        }

                        if($oper['sty'] == 'D'){
                            $userdetails->sty = (int)$userdetails->sty - (int)$score['sty'];
                            $userdetails->total_score = (int)$userdetails->total_score - (int)$score['sty'];
                        }

                        $userdetails->save();
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
