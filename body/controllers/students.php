<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class students extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', $this->lang->line('user'));
        $this->session_data = $this->session->userdata('user_session');

        if($this->session_data->role != 6){
            $this->session->set_flashdata('error', 'You dont have permission to see it :-/ Please contact Admin');
            redirect(base_url() . 'denied', 'refresh');
        }
    }

    function markAbsence(){
        if ($this->input->post() !== false) {
            echo '<pre>';
            print_r($_POST);
        }else{
            $user_detail = new Userdetail();
            $user_detail->where('student_master_id', $this->session_data->id)->get();

            $clan  = new Clan();
            $data['next_clans_dates'] = $clan->getAviableDateFromClan($user_detail->clan_id, 4, null);
            $clan->where('id', $user_detail->clan_id)->get();
            $check = $clan->getSameLevelClan($clan->city_id, $clan->level_id);

            if ($check !== FALSE) {
                $array = MultiArrayToSinlgeArray($check);
                if(($key = array_search($clan->id, $array)) !== false) {
                    unset($array[$key]);
                }
                $data['clans'] = $clan->where_in('id', $array)->get();;
            } else {
                $data['clans'] = 'No Clans are Avaialbe. Please try after Sometime'; 
                $data['type'] = 'danger';
            }

            $this->layout->view('students/student_attendance', $data);
        }
    }

}
