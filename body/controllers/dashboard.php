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
                $this->getSuperAdminDashboard();
                break;
            case 2:
                $this->getAdminDashboard();
                break;
            case 3:
                $this->getRectorDashboard();
                break;
            case 4:
                $this->getDeanDashboard();
                break;
            case 5:
                $this->getTeacherDashboard();
                break;
            case 6:
                $this->getStudentDashboard();
                break;
            default :
                $this->getDefaultDashboard();
                break;
        }
    }

    function getDefaultDashboard() {
        $this->layout->view('dashboard/common');
    }

    function getSuperAdminDashboard() {
        $this->layout->view('dashboard/superadmin');
    }

    function getAdminDashboard() {
        $academy = new Academy();
        $data['total_academies'] = $academy->count();

        $school = new School();
        $data['total_schools'] = $school->count();

        $users = new User();
        $data['total_instructors'] = $users->where('role_id', '5')->count();
        $data['total_students'] = $users->where('role_id', '6')->count();

        $this->layout->view('dashboard/admin', $data);
    }

    function getRectorDashboard() {
        $academy = new Academy();
        $data['total_academies'] = $academy->where('dean_id', $this->session_data->id)->count();
        $data['total_schools'] = $academy->include_related_count('school')->count();

        $class = new Clan();
        $data['total_instructors'] = $class->getTotalInstructorOfDean($this->session_data->id);
        $data['total_students'] = $class->getTotalUsersOfDean($this->session_data->id);

        $this->layout->view('dashboard/rector', $data);
    }

    function getDeanDashboard() {
        $this->layout->view('dashboard/dean');
    }

    function getTeacherDashboard() {
        $this->layout->view('dashboard/teacher');
    }

    function getStudentDashboard() {
        if ($this->session_data->status === 'P') {
            $this->layout->setLayout('template/layout_pending');
            $this->layout->setField('page_title', 'User');
            $this->layout->view('dashboard/pending_student');
        } else {
            $this->layout->view('dashboard/student');
        }
    }

}
