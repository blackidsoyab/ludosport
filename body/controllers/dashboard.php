<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class dashboard extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', 'Dashboard');
        $this->session_data = $this->session->userdata('user_session');
    }

    public function index() {
        switch ($this->session_data->role) {
            case 1:
                $this->layout->view('dashboard/superadmin');
                break;
            case 2:
                $this->getAdminDashboard();
                break;
            case 3:
                $this->getDeanDashboard();
                break;
            case 4:
                $this->layout->view('dashboard/principal');
                break;
            case 5:
                $this->layout->view('dashboard/instructor');
                break;
            case 6:
                $this->layout->view('dashboard/student');
                break;
            default :
                $this->layout->view('dashboard/common');
        }
    }

    function getAdminDashboard() {
        $role = new Role();
        $role->where('id', $this->session_data->role)->get();
        $filed = $this->session_data->language . '_role_name';
        $data['role_name'] = $role->$filed;

        $academy = new Academy();
        $data['total_academies'] = $academy->count();

        $school = new School();
        $data['total_schools'] = $school->count();

        $users = new User();
        $data['total_instructors'] = $users->where('role_id', '5')->count();
        $data['total_students'] = $users->where('role_id', '6')->count();
        
        $this->layout->view('dashboard/admin', $data);
    }

    function getDeanDashboard() {
        $role = new Role();
        $role->where('id', $this->session_data->role)->get();
        $filed = $this->session_data->language . '_role_name';
        $data['role_name'] = $role->$filed;

        $academy = new Academy();
        $data['total_academies'] = $academy->where('dean_id', $this->session_data->id)->count();
        $data['total_schools'] = $academy->include_related_count('school')->count();

        $users = new User();
        $data['total_instructors'] = $users->where('role_id', '5')->count();
        $data['total_students'] = $users->where('role_id', '6')->count();
        
        $this->layout->view('dashboard/dean', $data);
    }

}
