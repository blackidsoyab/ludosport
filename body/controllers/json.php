<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class json extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->session_data = $this->session->userdata('user_session');
    }

    public function getCountriesJsonData() {
        $this->load->library('datatable');
        $this->datatable->aColumns = array($this->session_data->language . '_name');
        $this->datatable->eColumns = array('id');
        $this->datatable->sIndexColumn = "id";
        $this->datatable->sTable = " countries";
        $this->datatable->datatable_process();

        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = $aRow[$this->session_data->language . '_name'];

            $str = NULL;
            if (hasPermission('countries', 'editCountry')) {
                $str .= '<a href="' . base_url() . 'country/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }

            if (hasPermission('countries', 'deleteCountry')) {
                $str .= '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
            }
            $temp_arr[] = $str;

            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }

    public function getStatesJsonData() {
        $this->load->library('datatable');
        $this->datatable->aColumns = array('states.' . $this->session_data->language . '_name AS states', 'countries.' . $this->session_data->language . '_name AS country');
        $this->datatable->eColumns = array('states.id');
        $this->datatable->sIndexColumn = "states.id";
        $this->datatable->sTable = " states, countries";
        $this->datatable->myWhere = 'WHERE countries.id=states.country_id';
        $this->datatable->datatable_process();

        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = $aRow['states'];
            $temp_arr[] = $aRow['country'];

            $str = NULL;
            if (hasPermission('states', 'editState')) {
                $str .= '<a href="' . base_url() . 'state/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }

            if (hasPermission('states', 'deleteState')) {
                $str .= '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
            }
            $temp_arr[] = $str;

            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }

    public function getCitiesJsonData() {
        $this->load->library('datatable');
        $this->datatable->aColumns = array('states.' . $this->session_data->language . '_name AS states', 'countries.' . $this->session_data->language . '_name AS country', 'states.' . $this->session_data->language . '_name AS city');
        $this->datatable->eColumns = array('cities.id');
        $this->datatable->sIndexColumn = "cities.id";
        $this->datatable->sTable = " states, cities, countries";
        $this->datatable->myWhere = 'WHERE states.id=cities.state_id AND countries.id=states.country_id';
        $this->datatable->datatable_process();

        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = $aRow['city'];
            $temp_arr[] = $aRow['states'];
            $temp_arr[] = $aRow['country'];

            $str = NULL;
            if (hasPermission('cities', 'editCity')) {
                $str .= '<a href="' . base_url() . 'city/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }

            if (hasPermission('cities', 'deleteCity')) {
                $str .= '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
            }
            $temp_arr[] = $str;

            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }

    public function getPermissionsJsonData() {
        $this->load->library('datatable');
        $this->datatable->aColumns = array($this->session_data->language . '_perm_name', 'controller', 'method');
        $this->datatable->eColumns = array('id');
        $this->datatable->sIndexColumn = "id";
        $this->datatable->sTable = " permissions";
        $this->datatable->datatable_process();

        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = $aRow[$this->session_data->language . '_perm_name'];
            $temp_arr[] = $aRow['controller'];
            $temp_arr[] = $aRow['method'];

            $str = NULL;
            if (hasPermission('permissions', 'deletePermission')) {
                $str .= '<a href="' . base_url() . 'permission/edit/' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '" class="actions"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }

            if (hasPermission('permissions', 'deletePermission')) {
                $str .= '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
            }
            $temp_arr[] = $str;

            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }

    public function getRolesJsonData() {
        $this->load->library('datatable');
        $this->datatable->aColumns = array($this->session_data->language . '_role_name');
        $this->datatable->eColumns = array('id', 'is_delete');
        $this->datatable->sIndexColumn = "id";
        $this->datatable->sTable = " roles";
        $this->datatable->myWhere = 'WHERE id != 1';
        $this->datatable->datatable_process();

        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = $aRow[$this->session_data->language . '_role_name'];

            $str = NULL;
            if (hasPermission('roles', 'editRole')) {
                $str .= '<a href="' . base_url() . 'role/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }

            if (hasPermission('roles', 'deleteRole')) {
                if ($aRow['is_delete'] == '1') {
                    $str .= '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
                } else {
                    $str .= '&nbsp;';
                }
            }
            $temp_arr[] = $str;

            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }

    function getUsersJsonData() {
        $this->load->library('datatable');
        $this->datatable->aColumns = array('firstname', 'lastname', 'status');
        $this->datatable->eColumns = array('users.id', 'role_id');
        $this->datatable->sIndexColumn = "users.id";
        $this->datatable->sTable = " users, roles";
        $this->datatable->myWhere = 'WHERE users.id !=  1 AND users.role_id=roles.id AND roles.id >' . $this->session_data->role;
        $this->datatable->datatable_process();

        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = $aRow['firstname'] . ' ' . $aRow['lastname'];
            $tmp = NULL;
            foreach (explode(',', $aRow['role_id']) as $role_id) {
                $tmp .= getRoleName($role_id) . '<br />';
            }
            $temp_arr[] = $tmp;

            if ($aRow['status'] == 'A') {
                $temp_arr[] = '<lable class="label label-success">' . $this->lang->line('active') . '</label>';
            } else if ($aRow['status'] == 'D') {
                $temp_arr[] = '<lable class="label label-danger">' . $this->lang->line('deactive') . '</label>';
            } else if ($aRow['status'] == 'P') {
                $temp_arr[] = '<lable class="label label-warning">' . $this->lang->line('pending') . '</label>';
            }

            /* if (hasPermission('users', 'extraPermissionUser')) {
              $temp_arr[] = '<a href="' . base_url() . 'user/extrapermission/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('extra_permission') . '"><label class="label label-primary">' . $this->lang->line('extra_permission') . '</label></a>';
              } else {
              $temp_arr[] = '&nbsp;';
              } */

            $str = NULL;
            if (hasPermission('users', 'editUser')) {
                $str .= '<a href="' . base_url() . 'user/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }

            if (hasPermission('users', 'deleteUser')) {
                $str .= '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('change_status') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
            }
            $temp_arr[] = $str;

            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }

    public function getAcademiesJsonData() {
        $this->load->library('datatable');
        $this->datatable->aColumns = array('distinct(academies.id)', 'academies.' . $this->session_data->language . '_academy_name AS academy_name', 'states.' . $this->session_data->language . '_name AS states', 'cities.' . $this->session_data->language . '_name AS city', '(SELECT count(*) from schools where schools.academy_id=academies.id) AS total_schools', '(SELECT count(*) from userdetails, schools, academies where schools.academy_id=academies.id AND userdetails.school_id=schools.id) AS total_students');
        $this->datatable->eColumns = array('academies.id');
        $this->datatable->sIndexColumn = "academies.id";
        if ($this->session_data->role == '1' || $this->session_data->role == '2') {
            $this->datatable->sTable = " academies, cities, states";
            $this->datatable->myWhere = 'WHERE states.id=academies.state_id AND cities.id=academies.city_id';
        } else if ($this->session_data->role == '3') {
            $this->datatable->sTable = " academies, cities, states";
            $this->datatable->myWhere = 'WHERE states.id=academies.state_id AND cities.id=academies.city_id AND FIND_IN_SET(' . $this->session_data->id . ', rector_id) > 0';
        } else if ($this->session_data->role == '4') {
            $this->datatable->sTable = " academies, cities, states, schools";
            $this->datatable->myWhere = 'WHERE states.id=academies.state_id AND cities.id=academies.city_id AND schools.academy_id=academies.id AND FIND_IN_SET(' . $this->session_data->id . ', schools.dean_id) > 0';
        } else if ($this->session_data->role == '5') {
            $this->datatable->sTable = " academies, cities, states, clans";
            $this->datatable->myWhere = 'WHERE states.id=academies.state_id AND cities.id=academies.city_id AND clans.academy_id=academies.id AND FIND_IN_SET(' . $this->session_data->id . ', clans.teacher_id) > 0';
        }

        $this->datatable->datatable_process();

        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = $aRow['academy_name'];
            $temp_arr[] = $aRow['city'] . ',' . $aRow['states'];
            $temp_arr[] = $aRow['total_schools'];
            $temp_arr[] = $aRow['total_students'];

            $str = NULL;
            if (hasPermission('academies', 'editAcademy')) {
                $str .= '<a href="' . base_url() . 'academy/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }

            if (hasPermission('academies', 'deleteAcademy')) {
                $str .= '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
            }
            $temp_arr[] = $str;

            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }

    public function getSchoolsJsonData() {
        $this->load->library('datatable');
        $this->datatable->aColumns = array('schools.' . $this->session_data->language . '_school_name AS school_name', '(SELECT count(*) from userdetails, schools where  userdetails.school_id=schools.id) AS total_students', 'academies.' . $this->session_data->language . '_academy_name AS academy_name');
        $this->datatable->eColumns = array('schools.id');
        $this->datatable->sIndexColumn = "schools.id";
        $this->datatable->sTable = " schools, academies";
        if ($this->session_data->role == '1' || $this->session_data->role == '2') {
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id';
        } else {
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id AND FIND_IN_SET(' . $this->session_data->id . ', academies.rector_id) > 0';
        }

        $this->datatable->datatable_process();

        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = $aRow['school_name'];
            $temp_arr[] = $aRow['academy_name'];
            $temp_arr[] = $aRow['total_students'];

            $str = NULL;
            if (hasPermission('schools', 'editSchool')) {
                $str .= '<a href="' . base_url() . 'school/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }

            if (hasPermission('schools', 'deleteSchool')) {
                $str .= '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
            }
            $temp_arr[] = $str;

            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }

    function getClansJsonData() {
        $this->load->library('datatable');
        $this->datatable->aColumns = array('clans.' . $this->session_data->language . '_class_name AS class_name', '(SELECT count(*) from userdetails, schools where  userdetails.school_id=schools.id) AS total_students', 'CONCAT(users.firstname," ", users.lastname) as instructor', 'schools.' . $this->session_data->language . '_school_name AS school_name', 'academies.' . $this->session_data->language . '_academy_name AS academy_name');
        $this->datatable->eColumns = array('clans.id');
        $this->datatable->sIndexColumn = "clans.id";
        $this->datatable->sTable = " clans, users, schools, academies";

        if ($this->session_data->role == '1' || $this->session_data->role == '2') {
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id AND schools.id=clans.school_id AND clans.teacher_id=users.id';
        } else {
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id AND schools.id=clans.school_id AND clans.teacher_id=users.id AND FIND_IN_SET(' . $this->session_data->id . ', academies.rector_id) > 0';
        }
        $this->datatable->datatable_process();

        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = $aRow['class_name'];
            $temp_arr[] = $aRow['instructor'];
            $temp_arr[] = $aRow['school_name'] . ', ' . $aRow['academy_name'];
            $temp_arr[] = $aRow['total_students'];

            $str = NULL;
            if (hasPermission('schools', 'editSchool')) {
                $str .= '<a href="' . base_url() . 'clan/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }

            if (hasPermission('schools', 'deleteSchool')) {
                $str .= '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
            }
            $temp_arr[] = $str;

            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }

    function getTeachersJsonData() {
        $this->load->library('datatable');
        $this->datatable->aColumns = array('clans.' . $this->session_data->language . '_class_name AS class_name', 'schools.' . $this->session_data->language . '_school_name AS school_name', 'academies.' . $this->session_data->language . '_academy_name AS academy_name', 'CONCAT(firstname," ", lastname) as teacher_name');
        $this->datatable->eColumns = array('academies.id');
        $this->datatable->sIndexColumn = "academies.id";
        $this->datatable->sTable = " clans, users, schools, academies";

        if ($this->session_data->role == '1' || $this->session_data->role == '2') {
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id AND schools.id=clans.school_id AND FIND_IN_SET(users.id,clans.teacher_id) > 0';
        } else if ($this->session_data->role == '3') {
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id AND schools.id=clans.school_id AND clans.teacher_id=users.id AND FIND_IN_SET(' . $this->session_data->id . ', academies.rector_id) > 0';
        } else if ($this->session_data->role == '4') {
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id AND schools.id=clans.school_id AND clans.teacher_id=users.id AND FIND_IN_SET(' . $this->session_data->id . ', schools.dean_id) > 0';
        } else if ($this->session_data->role == '5') {
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id AND schools.id=clans.school_id AND clans.teacher_id=users.id AND FIND_IN_SET(' . $this->session_data->id . ', clans.teacher_id) > 0';
        }
        $this->datatable->datatable_process();

        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = $aRow['teacher_name'];
            $temp_arr[] = $aRow['class_name'];
            $temp_arr[] = $aRow['school_name'];
            $temp_arr[] = $aRow['academy_name'];

            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }

    public function getLevelsJsonData() {
        $this->load->library('datatable');
        $this->datatable->aColumns = array($this->session_data->language . '_level_name', 'is_basic', 'under_sixteen');
        $this->datatable->eColumns = array('id');
        $this->datatable->sIndexColumn = "id";
        $this->datatable->sTable = " levels";
        $this->datatable->datatable_process();

        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = $aRow[$this->session_data->language . '_level_name'];

            if ($aRow['is_basic'] == '1') {
                $temp_arr[] = '<i class="fa fa-check"></i>';
            } else {
                $temp_arr[] = '&nbsp;';
            }

            if ($aRow['under_sixteen'] == '1') {
                $temp_arr[] = '<i class="fa fa-check"></i>';
            } else {
                $temp_arr[] = '&nbsp;';
            }

            $str = NULL;
            if (hasPermission('levels', 'editLevel')) {
                $str .= '<a href="' . base_url() . 'level/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }

            if (hasPermission('levels', 'deleteLevel')) {
                $str .= '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
            }

            $temp_arr[] = $str;

            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }

    public function getEmailsJsonData() {
        $this->load->library('datatable');
        $this->datatable->aColumns = array('subject');
        $this->datatable->eColumns = array('id');
        $this->datatable->sIndexColumn = "id";
        $this->datatable->sTable = " emails";
        $this->datatable->datatable_process();

        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = $aRow['subject'];

            $str = NULL;
            if (hasPermission('emails', 'editEmail')) {
                $str .= '<a href="' . base_url() . 'email/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }

            $temp_arr[] = $str;

            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }

}
