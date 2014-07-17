<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class json extends CI_Controller {

    var $session_data;

    function __construct() {
        parent::__construct();
        $this->session_data = $this->session->userdata('user_session');
    }

    public function getCountryJsonData() {
        $this->load->library('datatable');
        $this->datatable->aColumns = array($this->session_data->language . '_name');
        $this->datatable->eColumns = array('id');
        $this->datatable->sIndexColumn = "id";
        $this->datatable->sTable = " countries";
        $this->datatable->datatable_process();

        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = $aRow[$this->session_data->language . '_name'];
            $temp_arr[] = '<a href="' . base_url() . 'country/edit/' . $aRow['id'] . '" title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a> &nbsp;<a href="javascript:;" onclick="UpdateRow(this)" id="' . $aRow['id'] . '" title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';

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
            $temp_arr[] = '<a href="' . base_url() . 'state/edit/' . $aRow['id'] . '" title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a> &nbsp;<a href="javascript:;" onclick="UpdateRow(this)" id="' . $aRow['id'] . '" title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';

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
            $temp_arr[] = '<a href="' . base_url() . 'city/edit/' . $aRow['id'] . '" title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a> &nbsp;<a href="javascript:;" onclick="UpdateRow(this)" id="' . $aRow['id'] . '" title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';

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
            $temp_arr[] = '<a href="' . base_url() . 'permission/edit/' . $aRow['id'] . '" title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a> &nbsp;<a href="javascript:;" onclick="UpdateRow(this)" id="' . $aRow['id'] . '" title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';

            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }

    public function getRolesJsonData() {
        $this->load->library('datatable');
        $this->datatable->aColumns = array($this->session_data->language . '_role_name');
        $this->datatable->eColumns = array('id');
        $this->datatable->sIndexColumn = "id";
        $this->datatable->sTable = " roles";
        $this->datatable->datatable_process();

        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = $aRow[$this->session_data->language . '_role_name'];
            $temp_arr[] = '<a href="' . base_url() . 'role/edit/' . $aRow['id'] . '" title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a> &nbsp;<a href="javascript:;" onclick="UpdateRow(this)" id="' . $aRow['id'] . '" title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';

            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }

}
