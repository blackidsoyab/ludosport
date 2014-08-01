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

        $class = new Clan();
        $data['total_instructors'] = $class->getTotalTeachers();
        $data['total_students'] = $class->getTotalStudents();

        $this->layout->view('dashboard/admin', $data);
    }

    function getRectorDashboard() {
        $academy = new Academy();
        $data['total_academies'] = $academy->getTotalAcademyOfRector($this->session_data->id);

        $school = new School();
        $data['total_schools'] = $school->getTotalSchoolOfRector($this->session_data->id);

        $class = new Clan();
        $data['total_instructors'] = $class->getTotalTeacherOfRector($this->session_data->id);
        $data['total_students'] = $class->getTotalStudentsOfRector($this->session_data->id);

        $this->layout->view('dashboard/rector', $data);
    }

    function getDeanDashboard() {
        $school = new School();
        $data['total_schools'] = $school->getTotalSchoolOfDean($this->session_data->id);

        $class = new Clan();
        $data['total_instructors'] = $class->getTotalTeacherOfDean($this->session_data->id);
        $data['total_students'] = $class->getTotalStudentsOfDean($this->session_data->id);
        $this->layout->view('dashboard/dean', $data);
    }

    function getTeacherDashboard() {
        $class = new Clan();
        $data['total_classes'] = $class->getTotalClassesOfTeacher($this->session_data->id);
        $data['total_students'] = $class->getTotalStudentsOfTeacher($this->session_data->id);
        $this->layout->view('dashboard/teacher', $data);
    }

    function getStudentDashboard() {
        if ($this->session_data->status === 'P') {
            $this->getPendingStudentDashboard();
        } else if ($this->session_data->status === 'A') {
            $this->getActiveStudentDashboard();
        } else {
            $this->session->set_flashdata('error', 'Your Status is Neighter ACTIVE nor PENDING. Please Contact Admin.');
            redirect(base_url() . 'denied', 'refresh');
        }
    }

    function getPendingStudentDashboard() {
        $this->layout->setField('page_title', 'Test Lesson');

        $user = New User();
        $user->where('id', $this->session_data->id)->get();
        $data['user'] = $user;
        $age = explode(' ', time_elapsed_string(date('Y-m-d H:i:s', $user->date_of_birth)));
        if ($age[1] == 'year' && $age[0] < 16) {
            $under_sixteen = 1;
        } else {
            $under_sixteen = 0;
        }

        $clan = New Clan();
        $clans_data = $clan->getAviableTrialClan($user->city_id, $under_sixteen);

        if ($clans_data !== FALSE) {
            $data['clans'] = $clan->where_in('id', MultiArrayToSinlgeArray($clans_data))->get();
        } else {
            $data['clans'] = 'Sorry';
        }

        $city = new City();
        $data['city_name'] = $city->where('id', $user->city_id)->get()->{$this->session_data->language . '_name'};
        $data['state_name'] = $city->state->{$this->session_data->language . '_name'};
        $data['country_name'] = $city->state->country->{$this->session_data->language . '_name'};

        $this->layout->view('dashboard/pending_student', $data);
    }

    function getActiveStudentDashboard() {
        $this->layout->view('dashboard/student');
    }

}
