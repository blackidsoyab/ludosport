<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class json extends CI_Controller
{
    
    var $session_data;
    
    public function __construct() {
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
                $str.= '<a href="' . base_url() . 'country/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }
            
            if (hasPermission('countries', 'deleteCountry')) {
                $str.= '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
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
                $str.= '<a href="' . base_url() . 'state/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }
            
            if (hasPermission('states', 'deleteState')) {
                $str.= '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
            }
            $temp_arr[] = $str;
            
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }
    
    public function getCitiesJsonData() {
        $this->load->library('datatable');
        $this->datatable->aColumns = array('cities.' . $this->session_data->language . '_name AS city', 'states.' . $this->session_data->language . '_name AS states', 'countries.' . $this->session_data->language . '_name AS country');
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
                $str.= '<a href="' . base_url() . 'city/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }
            
            if (hasPermission('cities', 'deleteCity')) {
                $str.= '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
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
                $str.= '<a href="' . base_url() . 'permission/edit/' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '" class="actions"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }
            
            if (hasPermission('permissions', 'deletePermission')) {
                $str.= '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
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
        $this->datatable->myWhere = 'WHERE id > ' . $this->session_data->role;
        $this->datatable->datatable_process();
        
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = $aRow[$this->session_data->language . '_role_name'];
            
            $str = NULL;
            if (hasPermission('roles', 'editRole')) {
                $str.= '<a href="' . base_url() . 'role/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }
            
            if (hasPermission('roles', 'deleteRole')) {
                if ($aRow['is_delete'] == '1') {
                    $str.= '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
                } else {
                    $str.= '&nbsp;';
                }
            }
            $temp_arr[] = $str;
            
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }
    
    public function getUsersJsonData($role_id) {
        $where = null;
        
        if ($this->session_data->role == 1 || $this->session_data->role == 2) {
            if ($role_id != 0) {
                $where = ' AND FIND_IN_SET(' . $role_id . ', users.role_id) > 0';
                if ($role_id == 2) {
                    $ids = User::getAdminIds();
                }
                
                if ($role_id == 3) {
                    $ids = Academy::getAssignRectorIds();
                }
                
                if ($role_id == 4) {
                    $ids = School::getAssignDeanIds();
                }
                
                if ($role_id == 5) {
                    $ids = Clan::getAssignTeacherIds();
                }
                
                if ($role_id == 6) {
                    $ids = Userdetail::getAssingStudentIds();
                }
                
                $where.= ' AND users.id IN (' . implode(',', $ids) . ')';
            }
        } else if ($this->session_data->role == 3) {
            if ($role_id == 0) {
                $school = new School();
                $ids[] = $school->getRelatedDeansByRector($this->session_data->id);
                
                $class = new Clan();
                $ids[] = $class->getRelatedTeachersByRector($this->session_data->id);
                
                $user_detail = new Userdetail();
                $ids[] = $user_detail->getRelatedStudentsByRector($this->session_data->id);
                
                $final_ids = array_unique(MultiArrayToSinlgeArray($ids));
                
                if (count($final_ids) == 0) {
                    $final_ids = array(0);
                }
                $where.= ' AND users.id IN (' . implode(',', $final_ids) . ')';
            } else {
                $where = ' AND FIND_IN_SET(' . $role_id . ', users.role_id) > 0';
                
                if ($role_id == 4) {
                    $school = new School();
                    $ids = $school->getRelatedDeansByRector($this->session_data->id);
                }
                
                if ($role_id == 5) {
                    $class = new Clan();
                    $ids = $class->getRelatedTeachersByRector($this->session_data->id);
                }
                
                if ($role_id == 6) {
                    $user_detail = new Userdetail();
                    $ids = $user_detail->getRelatedStudentsByRector($this->session_data->id);
                }
                
                if ($ids === false) {
                    $ids = array(0);
                }
                
                $where.= ' AND users.id IN (' . implode(',', $ids) . ')';
            }
        } else if ($this->session_data->role == 4) {
            if ($role_id == 0) {
                
                $class = new Clan();
                $ids[] = $class->getRelatedTeachersByDean($this->session_data->id);
                
                $user_detail = new Userdetail();
                $ids[] = $user_detail->getRelatedStudentsByDean($this->session_data->id);
                
                $final_ids = array_unique(MultiArrayToSinlgeArray($ids));
                
                if (count($final_ids) == 0) {
                    $final_ids = array(0);
                }
                
                $where.= ' AND users.id IN (' . implode(',', $final_ids) . ')';
            } else {
                $where = ' AND FIND_IN_SET(' . $role_id . ', users.role_id) > 0';
                
                if ($role_id == 5) {
                    $class = new Clan();
                    $ids = $class->getRelatedTeachersByDean($this->session_data->id);
                }
                
                if ($role_id == 6) {
                    $user_detail = new Userdetail();
                    $ids = $user_detail->getRelatedStudentsByDean($this->session_data->id);
                }
                
                if ($ids === false) {
                    $ids = array(0);
                }
                
                $where.= ' AND users.id IN (' . implode(',', $ids) . ')';
            }
        } else if ($this->session_data->role == 5) {
            if ($role_id != 0) {
                $where = ' AND FIND_IN_SET(' . $role_id . ', users.role_id) > 0';
            }
            
            $user_detail = new Userdetail();
            $ids = $user_detail->getRelatedStudentsByTeacher($this->session_data->id);
            if ($ids === false) {
                $ids = array(0);
            }
            $where.= ' AND users.id IN (' . implode(',', $ids) . ')';
        }
        
        $this->load->library('datatable');
        $this->datatable->aColumns = array('CONCAT(firstname," ", lastname) AS name', 'username', 'role_id', 'status');
        $this->datatable->eColumns = array('users.id', 'avtar');
        $this->datatable->sIndexColumn = "users.id";
        $this->datatable->sTable = " users";
        $this->datatable->myWhere = 'WHERE id != 1 ' . $where;
        $this->datatable->datatable_process();
        
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = '<img src="' . IMG_URL . 'user_avtar/40X40/' . $aRow['avtar'] . '" class="avatar img-circle" alt="avatar"><a href="' . base_url() . 'profile/view/' . $aRow['id'] . '" class="text-black">' . $aRow['name'] . '</a>';
            $temp_arr[] = $aRow['username'];
            $tmp = NULL;
            foreach (explode(',', $aRow['role_id']) as $role_id) {
                $tmp.= getRoleName($role_id) . '<br />';
            }
            $temp_arr[] = $tmp;
            
            if ($aRow['status'] == 'A') {
                $temp_arr[] = '<lable class="label label-success">' . $this->lang->line('active') . '</label>';
            } else if ($aRow['status'] == 'D') {
                $temp_arr[] = '<lable class="label label-danger">' . $this->lang->line('deactive') . '</label>';
            } else if ($aRow['status'] == 'P') {
                $temp_arr[] = '<lable class="label label-warning">' . $this->lang->line('pending') . '</label>';
            }
            
            $str = NULL;
            if (in_array(6, explode(',', $aRow['role_id'])) && $aRow['status'] == 'A' && hasPermission('users', 'listStudentScore')) {
                $str.= '<a href="' . base_url() . 'user_student/score_history/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('list_score_history') . '"><i class="fa fa-star icon-circle icon-xs icon-info"></i></a>';
            }
            
            if (in_array(6, explode(',', $aRow['role_id'])) && $aRow['status'] == 'A' && hasPermission('users', 'listStudentBatches')) {
                $str.= '<a href="' . base_url() . 'user_student/badge_history/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('list_badge_history') . '"><i class="fa fa-graduation-cap icon-circle icon-xs icon-warning"></i></a>';
            }
            
            if (hasPermission('users', 'editUser')) {
                $str.= '<a href="' . base_url() . 'user/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }
            
            if (hasPermission('users', 'deleteUser')) {
                $str.= '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('change_status') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
            }
            $temp_arr[] = $str;
            
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }
    
    public function getAcademiesJsonData() {
        $this->load->library('datatable');
        $this->datatable->aColumns = array('academies.' . $this->session_data->language . '_academy_name AS academy_name', 'academies.rector_id', 'cities.' . $this->session_data->language . '_name AS city', 'states.' . $this->session_data->language . '_name AS states', '(SELECT count(*) from schools where schools.academy_id=academies.id) AS total_schools', '(SELECT count(*) from userdetails, clans, schools, academies temp_ac, users where schools.academy_id=academies.id AND userdetails.clan_id=clans.id AND schools.id=clans.school_id AND users.id=userdetails.student_master_id AND temp_ac.id=academies.id) AS total_students');
        $this->datatable->eColumns = array('academies.id', 'fee1', 'fee2');
        $this->datatable->sIndexColumn = "distinct(academies.id)";
        $this->datatable->groupBy = ' GROUP BY academies.id';
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
            $this->datatable->sTable = " academies, schools, cities, states, clans";
            $this->datatable->myWhere = 'WHERE states.id=academies.state_id AND cities.id=academies.city_id AND schools.academy_id=academies.id AND clans.school_id=schools.id AND FIND_IN_SET(' . $this->session_data->id . ', clans.teacher_id) > 0';
        }
        
        $this->datatable->datatable_process();
        
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = '<a href="' . base_url() . 'academy/view/' . $aRow['id'] . '" class="text-black" data-toggle="tooltip" data-placement="bottom" data-original-title="' . $this->lang->line('view') . ' ' . $this->lang->line('academy') . '">' . $aRow['academy_name'] . '</a>';
            
            $str = null;
            $cnt = 0;
            foreach (explode(',', $aRow['rector_id']) as $rector_id) {
                $temp = userNameEmail($rector_id, true);
                if ($cnt == 0) {
                    $str.= $temp['name'];
                } else {
                    $str.= ',<br />' . $temp['name'];
                }
                $cnt++;
            }
            
            $temp_arr[] = $str;
            $temp_arr[] = $aRow['city'] . ',' . $aRow['states'];
            $temp_arr[] = $aRow['total_schools'];
            
            if ($aRow['total_students'] > 0) {
                $temp_arr[] = '<a href="' . base_url() . 'clan/studentlist/' . $aRow['id'] . '/academy" class="text-black" data-toggle="tooltip" data-placement="bottom" data-original-title="' . $this->lang->line('view_all') . ' ' . $this->lang->line('student') . '">' . $aRow['total_students'] . '</a>';
            } else {
                $temp_arr[] = $aRow['total_students'];
            }
            
            $temp_arr[] = (float)$aRow['fee1'] + ((int)$aRow['total_students'] * (float)$aRow['fee2']);
            
            $str = NULL;
            if (hasPermission('academies', 'editAcademy')) {
                $str.= '<a href="' . base_url() . 'academy/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }
            
            if (hasPermission('academies', 'deleteAcademy')) {
                $str.= '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
            }
            $temp_arr[] = $str;
            
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }
    
    public function getSchoolsJsonData($academy_id) {
        $where = Null;
        
        if ($academy_id != 0) {
            $where = ' AND schools.academy_id = ' . $academy_id;
        }
        
        $this->load->library('datatable');
        $this->datatable->aColumns = array('schools.' . $this->session_data->language . '_school_name AS school_name', 'academies.' . $this->session_data->language . '_academy_name AS academy_name', '(SELECT count(*) from userdetails, clans, schools temp_sc where temp_sc.id=schools.id AND userdetails.clan_id=clans.id AND temp_sc.id=clans.school_id) AS total_students');
        $this->datatable->eColumns = array('schools.id');
        $this->datatable->sIndexColumn = "schools.id";
        if ($this->session_data->role == '1' || $this->session_data->role == '2') {
            $this->datatable->sTable = " schools, academies";
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id' . $where;
        } else if ($this->session_data->role == '3') {
            $this->datatable->sTable = " schools, academies";
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id AND FIND_IN_SET(' . $this->session_data->id . ', academies.rector_id) > 0' . $where;
        } else if ($this->session_data->role == '4') {
            $this->datatable->sTable = " schools, academies";
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id AND FIND_IN_SET(' . $this->session_data->id . ', dean_id) > 0' . $where;
        } else if ($this->session_data->role == '5') {
            $this->datatable->sTable = " schools, academies, clans";
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id AND schools.id=clans.school_id AND FIND_IN_SET(' . $this->session_data->id . ', teacher_id) > 0' . $where;
        }
        
        $this->datatable->groupBy = ' GROUP BY schools.id';
        $this->datatable->datatable_process();
        
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = '<a href="' . base_url() . 'school/view/' . $aRow['id'] . '" class="text-black" data-toggle="tooltip" data-placement="bottom" data-original-title="' . $this->lang->line('view') . ' ' . $this->lang->line('school') . '">' . $aRow['school_name'] . '</a>';
            $temp_arr[] = $aRow['academy_name'];
            if ($aRow['total_students'] > 0) {
                $temp_arr[] = '<a href="' . base_url() . 'clan/studentlist/' . $aRow['id'] . '/school" class="text-black" data-toggle="tooltip" data-placement="bottom" data-original-title="' . $this->lang->line('view_all') . ' ' . $this->lang->line('student') . '">' . $aRow['total_students'] . '</a>';
            } else {
                $temp_arr[] = $aRow['total_students'];
            }
            
            $str = NULL;
            if (hasPermission('schools', 'editSchool')) {
                $str.= '<a href="' . base_url() . 'school/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }
            
            if (hasPermission('schools', 'deleteSchool')) {
                $str.= '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
            }
            
            $temp_arr[] = $str;
            
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }
    
    public function getClansJsonData($school_id) {
        $where = Null;
        
        if ($school_id != 0) {
            $where = ' AND school_id = ' . $school_id;
        }
        
        $this->load->library('datatable');
        $this->datatable->aColumns = array('clans.' . $this->session_data->language . '_class_name AS class_name', 'CONCAT(users.firstname," ", users.lastname) AS instructor', 'levels.' . $this->session_data->language . '_level_name AS level', 'schools.' . $this->session_data->language . '_school_name AS school_name', 'academies.' . $this->session_data->language . '_academy_name AS academy_name', '(SELECT count(*) from userdetails, clans temp_clan where  userdetails.clan_id=temp_clan.id AND temp_clan.id=clans.id) AS total_students');
        $this->datatable->eColumns = array('clans.id');
        $this->datatable->sIndexColumn = "clans.id";
        $this->datatable->sTable = " clans, users, schools, academies, levels";
        
        if ($this->session_data->role == '1' || $this->session_data->role == '2') {
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id AND schools.id=clans.school_id AND clans.teacher_id=users.id AND clans.level_id=levels.id' . $where;
        } else if ($this->session_data->role == '3') {
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id AND schools.id=clans.school_id AND clans.teacher_id=users.id AND FIND_IN_SET(' . $this->session_data->id . ', academies.rector_id) > 0 AND clans.level_id=levels.id' . $where;
        } else if ($this->session_data->role == '4') {
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id AND schools.id=clans.school_id AND clans.teacher_id=users.id AND FIND_IN_SET(' . $this->session_data->id . ', dean_id) > 0 AND clans.level_id=levels.id' . $where;
        } else if ($this->session_data->role == '5') {
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id AND schools.id=clans.school_id AND clans.teacher_id=users.id AND FIND_IN_SET(' . $this->session_data->id . ', teacher_id) > 0 AND clans.level_id=levels.id' . $where;
        }
        
        $this->datatable->groupBy = ' GROUP BY clans.id';
        $this->datatable->datatable_process();
        
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = '<a href="' . base_url() . 'clan/view/' . $aRow['id'] . '" class="text-black" data-toggle="tooltip" data-placement="bottom" data-original-title="' . $this->lang->line('view_') . ' ' . $this->lang->line('clan') . '">' . $aRow['class_name'] . '</a>';
            
            $temp_arr[] = $aRow['instructor'];
            $temp_arr[] = $aRow['level'];
            $temp_arr[] = $aRow['school_name'] . ', ' . $aRow['academy_name'];
            if ($aRow['total_students'] > 0) {
                $temp_arr[] = '<a href="' . base_url() . 'clan/studentlist/' . $aRow['id'] . '/clan" class="text-black" data-toggle="tooltip" data-placement="bottom" data-original-title="' . $this->lang->line('view_all') . ' ' . $this->lang->line('student') . '">' . $aRow['total_students'] . '</a>';
            } else {
                $temp_arr[] = $aRow['total_students'];
            }
            
            if (hasPermission('clans', 'listTrialLessonRequest')) {
                $temp_arr[] = '<a href="' . base_url() . 'clan/trial_lesson_request/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('view') . '">' . $this->lang->line('view') . '</a>';
            } else {
                $temp_arr[] = '&nbsp;';
            }
            
            $str = NULL;
            if (hasPermission('clans', 'editClan')) {
                $str.= '<a href="' . base_url() . 'clan/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }
            
            if (hasPermission('clans', 'deleteClan')) {
                $str.= '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
            }
            $temp_arr[] = $str;
            
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }
    
    public function getTeachersJsonData($academy_id = 0, $school_id = 0, $clan_id = 0) {
        $where = NULL;
        
        if ($academy_id != 0) {
            $where.= ' AND academies.id=' . $academy_id;
        }
        
        if ($school_id != 0) {
            $where.= ' AND schools.id=' . $school_id;
        }
        
        if ($clan_id != 0) {
            $where.= ' AND clans.id=' . $clan_id;
        }
        
        $this->load->library('datatable');
        $this->datatable->aColumns = array('CONCAT(firstname," ", lastname) AS teacher_name', 'clans.' . $this->session_data->language . '_class_name AS class_name', 'schools.' . $this->session_data->language . '_school_name AS school_name', 'academies.' . $this->session_data->language . '_academy_name AS academy_name');
        $this->datatable->eColumns = array('users.id', 'clans.teacher_id', 'avtar');
        $this->datatable->sIndexColumn = "users.id";
        $this->datatable->sTable = " clans, users, schools, academies";
        
        if ($this->session_data->role == '1' || $this->session_data->role == '2') {
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id AND schools.id=clans.school_id AND FIND_IN_SET(users.id,clans.teacher_id) > 0 AND users.status = "A" ' . $where;
        } else if ($this->session_data->role == '3') {
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id AND schools.id=clans.school_id AND clans.teacher_id=users.id AND FIND_IN_SET(' . $this->session_data->id . ', academies.rector_id) > 0 AND users.status = "A" ' . $where;
        } else if ($this->session_data->role == '4') {
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id AND schools.id=clans.school_id AND clans.teacher_id=users.id AND FIND_IN_SET(' . $this->session_data->id . ', schools.dean_id) > 0 AND users.status = "A" ' . $where;
        } else if ($this->session_data->role == '5') {
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id AND schools.id=clans.school_id AND clans.teacher_id=users.id AND FIND_IN_SET(' . $this->session_data->id . ', clans.teacher_id) > 0 AND users.status = "A" ' . $where;
        }
        
        $this->datatable->groupBy = ' GROUP BY users.id';
        
        $this->datatable->datatable_process();
        
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = '<img src="' . IMG_URL . 'user_avtar/40X40/' . $aRow['avtar'] . '" class="avatar img-circle" alt="avatar"><a href="' . base_url() . 'profile/view/' . $aRow['teacher_id'] . '" class="text-black">' . $aRow['teacher_name'] . '</a>';
            $temp_arr[] = $aRow['class_name'];
            $temp_arr[] = $aRow['school_name'];
            $temp_arr[] = $aRow['academy_name'];
            
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }
    
    public function getStudentsJsonData($academy_id = 0, $school_id = 0, $clan_id = 0) {
        $where = NULL;
        
        if ($academy_id != 0) {
            $where.= ' AND academies.id=' . $academy_id;
        }
        
        if ($school_id != 0) {
            $where.= ' AND schools.id=' . $school_id;
        }
        
        if ($clan_id != 0) {
            $where.= ' AND clans.id=' . $clan_id;
        }
        
        $this->load->library('datatable');
        $this->datatable->aColumns = array('CONCAT(firstname, " ", lastname) AS student_name', 'batches.id', 'clans.' . $this->session_data->language . '_class_name AS class_name', 'schools.' . $this->session_data->language . '_school_name AS school_name', 'academies.' . $this->session_data->language . '_academy_name AS academy_name');
        $this->datatable->eColumns = array('users.id', 'avtar', $this->session_data->language . '_name AS batch_name', 'batches.image');
        $this->datatable->sIndexColumn = "users.id";
        $this->datatable->sTable = " users, userdetails";
        
        if ($this->session_data->role == '1' || $this->session_data->role == '2') {
            $this->datatable->myWhere = ' JOIN clans ON clans.id=userdetails.clan_id JOIN schools ON schools.id=clans.school_id JOIN academies ON academies.id=schools.academy_id LEFT JOIN batches ON batches.id=userdetails.degree_id WHERE userdetails.student_master_id=users.id AND users.status="A" AND userdetails.status="A" ' . $where;
        } else if ($this->session_data->role == '3') {
            $this->datatable->myWhere = ' JOIN clans ON clans.id=userdetails.clan_id JOIN schools ON schools.id=clans.school_id JOIN academies ON academies.id=schools.academy_id  AND FIND_IN_SET(' . $this->session_data->id . ', academies.rector_id) > 0 LEFT JOIN batches ON batches.id=userdetails.degree_id WHERE userdetails.student_master_id=users.id AND users.status="A" AND userdetails.status="A" ' . $where;
        } else if ($this->session_data->role == '4') {
            $this->datatable->myWhere = ' JOIN clans ON clans.id=userdetails.clan_id JOIN schools ON schools.id=clans.school_id  AND FIND_IN_SET(' . $this->session_data->id . ', schools.dean_id) > 0 JOIN academies ON academies.id=schools.academy_id LEFT JOIN batches ON batches.id=userdetails.degree_id WHERE userdetails.student_master_id=users.id AND users.status="A" AND userdetails.status="A" ' . $where;
        } else if ($this->session_data->role == '5') {
            $this->datatable->myWhere = ' JOIN clans ON clans.id=userdetails.clan_id AND FIND_IN_SET(' . $this->session_data->id . ', clans.teacher_id) > 0 JOIN schools ON schools.id=clans.school_id JOIN academies ON academies.id=schools.academy_id LEFT JOIN batches ON batches.id=userdetails.degree_id WHERE userdetails.student_master_id=users.id AND users.status="A" AND userdetails.status="A" ' . $where;
        }
        $this->datatable->datatable_process();
        
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = '<img src="' . IMG_URL . 'user_avtar/40X40/' . $aRow['avtar'] . '" class="avatar img-circle" alt="avatar"><a href="' . base_url() . 'profile/view/' . $aRow['id'] . '" class="text-black">' . $aRow['student_name'] . '</a>';
            if (!is_null($aRow['image'])) {
                $temp_arr[] = '<img src="' . IMG_URL . 'batches/' . $aRow['image'] . '" class="avatar img-circle" alt="avatar" data-toggle="tooltip" data-original-title="' . $aRow['batch_name'] . '">';
            } else {
                $temp_arr[] = null;
            }
            
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
                $str.= '<a href="' . base_url() . 'level/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }
            
            if (hasPermission('levels', 'deleteLevel')) {
                $str.= '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
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
                $str.= '<a href="' . base_url() . 'email/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }
            
            $temp_arr[] = $str;
            
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }
    
    public function getTrialLessonRequestJsonData($clan_id = null) {
        $this->load->library('datatable');
        $this->datatable->aColumns = array('CONCAT(users.firstname," ", users.lastname) AS student_name', 'clans.' . $this->session_data->language . '_class_name AS class_name', 'userdetails.first_lesson_date', 'userdetails.status');
        $this->datatable->eColumns = array('userdetails.id', 'student_master_id', 'clan_id');
        $this->datatable->sIndexColumn = "userdetails.id";
        
        if (!is_null($clan_id)) {
            $this->datatable->sTable = "clans, users, userdetails";
            $this->datatable->myWhere = 'WHERE userdetails.clan_id=clans.id AND userdetails.student_master_id=users.id AND users.status= "P" AND userdetails.status!="P2" AND clans.id=' . $clan_id;
        } else {
            if ($this->session_data->role == 1 || $this->session_data->role == 2) {
                $this->datatable->sTable = " clans, users, userdetails";
                $this->datatable->myWhere = 'WHERE userdetails.clan_id=clans.id AND userdetails.student_master_id=users.id AND users.status= "P" AND userdetails.status!="P2" ';
            } else if ($this->session_data->role == 3) {
                $this->datatable->sTable = " users, userdetails, academies, schools, clans";
                $this->datatable->myWhere = 'WHERE userdetails.student_master_id=users.id AND users.status= "P" AND userdetails.status!="P2" AND academies.id=schools.academy_id AND schools.id=clans.school_id AND clans.id=userdetails.clan_id AND FIND_IN_SET(' . $this->session_data->id . ', academies.rector_id) > 0';
            } else if ($this->session_data->role == 4) {
                $this->datatable->sTable = " users, userdetails, schools, clans";
                $this->datatable->myWhere = 'WHERE userdetails.student_master_id=users.id AND users.status= "P" AND userdetails.status!="P2" AND  schools.id=clans.school_id AND clans.id=userdetails.clan_id AND FIND_IN_SET(' . $this->session_data->id . ', schools.dean_id) > 0';
            } else if ($this->session_data->role == 5) {
                $this->datatable->sTable = " users, userdetails, clans";
                $this->datatable->myWhere = 'WHERE userdetails.student_master_id=users.id AND users.status= "P" AND userdetails.status!="P2" AND   clans.id=userdetails.clan_id AND FIND_IN_SET(' . $this->session_data->id . ', clans.teacher_id) > 0';
            }
        }
        
        $this->datatable->datatable_process();
        
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = $aRow['student_name'];
            $temp_arr[] = $aRow['class_name'];
            if($aRow['first_lesson_date'] != ''){
                $temp_arr[] = date('d-m-Y', strtotime($aRow['first_lesson_date']));     
            } else {
                $temp_arr[] = '';
            }
            
            if ($aRow['status'] == 'A') {
                $temp_arr[] = '<label class="label label-success">' . $this->lang->line('approved') . '</label>';
            } else if ($aRow['status'] == 'U') {
                $temp_arr[] = '<label class="label label-danger">' . $this->lang->line('unapproved') . '</label>';
            } else if ($aRow['status'] == 'P') {
                $temp_arr[] = '<label class="label label-warning">' . $this->lang->line('pending') . '</label>';
            } else {
                $temp_arr[] = null;
            }
            if (hasPermission('clans', 'changeStatusTrialStudent')) {
                $temp_arr[] = '<a href="' . base_url() . 'clan/change_status_trial_student/' . $aRow['clan_id'] . '/' . $aRow['student_master_id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('change_status') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            } else {
                $temp_arr[] = '&nbsp;';
            }
            
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }
    
    public function getEventcategoriesJsonData() {
        $this->load->library('datatable');
        $this->datatable->aColumns = array($this->session_data->language . '_name');
        $this->datatable->eColumns = array('id');
        $this->datatable->sIndexColumn = "id";
        $this->datatable->sTable = " eventcategories";
        $this->datatable->datatable_process();
        
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = $aRow[$this->session_data->language . '_name'];
            
            $str = NULL;
            if (hasPermission('eventcategories', 'editEventcategory')) {
                $str.= '<a href="' . base_url() . 'eventcategory/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }
            
            if (hasPermission('eventcategories', 'deleteEventcategory')) {
                $str.= '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
            }
            $temp_arr[] = $str;
            
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }
    
    public function getEventsJsonData() {
        $this->load->library('datatable');
        $this->datatable->aColumns = array('eventcategories.' . $this->session_data->language . '_name AS category', 'events.' . $this->session_data->language . '_name AS event');
        $this->datatable->eColumns = array('events.id');
        $this->datatable->sIndexColumn = "events.id";
        $this->datatable->sTable = " eventcategories, events";
        $this->datatable->myWhere = 'WHERE eventcategories.id=events.eventcategory_id';
        $this->datatable->datatable_process();
        
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = $aRow['event'];
            $temp_arr[] = $aRow['category'];
            
            if (hasPermission('events', 'viewEvent')) {
                $temp_arr[] = '<a href="' . base_url() . 'event/view/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('view') . '">' . $this->lang->line('view') . '</a>';
            } else {
                $temp_arr[] = NULL;
            }
            
            $str = NULL;
            if (hasPermission('events', 'editEvent')) {
                $str.= '<a href="' . base_url() . 'event/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }
            
            if (hasPermission('events', 'deleteEvent')) {
                $str.= '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
            }
            $temp_arr[] = $str;
            
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }
    
    public function getBatchesJsonData($type = 'all') {
        $this->load->library('datatable');
        $this->datatable->aColumns = array($this->session_data->language . '_name', 'type', 'image');
        $this->datatable->eColumns = array('id');
        $this->datatable->sIndexColumn = "id";
        $this->datatable->sTable = " batches";
        if ($type != 'all') {
            $this->datatable->myWhere = ' WHERE type=\'' . strtoupper($type) . '\'';
        }
        $this->datatable->sOrder = " ORDER BY batches.sequence ASC";
        $this->datatable->datatable_process();
        
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = ucwords($aRow[$this->session_data->language . '_name']);
            
            if ($aRow['type'] == 'D') {
                $temp_arr[] = '<span class="label label-info">' . $this->lang->line('degree') . '</span>';
            }
            
            if ($aRow['type'] == 'H') {
                $temp_arr[] = '<span class="label label-success">' . $this->lang->line('honour') . '</span>';
            }
            
            if ($aRow['type'] == 'Q') {
                $temp_arr[] = '<span class="label label-warning">' . $this->lang->line('qualification') . '</span>';
            }
            
            if ($aRow['type'] == 'S') {
                $temp_arr[] = '<span class="label label-danger">' . $this->lang->line('security') . '</span>';
            }
            
            $temp_arr[] = '<img src="' . IMG_URL . 'batches/' . $aRow['image'] . '" class="avatar" alt="Batch">';
            
            $str = NULL;
            if (hasPermission('batches', 'editBatch')) {
                $str.= '<a href="' . base_url() . 'batch/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }
            
            if (hasPermission('batches', 'deleteBatch')) {
                $str.= '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
            }
            $temp_arr[] = $str;
            
            $temp_arr[] = 'batch_id_' . $aRow['type'] . '_' . $aRow['id'];
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }
    
    public function getBatchrequestsJsonData() {
        $where = null;
        
        if ($this->session_data->role == 3) {
            $user_detail = new Userdetail();
            $final_ids = $user_detail->getRelatedStudentsByRector($this->session_data->id);
            if ($final_ids == false) {
                $final_ids = array(0);
            }
            $where.= ' AND batchrequests.student_id IN (' . implode(',', $final_ids) . ') AND from_role IN (3,4)';
        }
        
        if ($this->session_data->role == 4) {
            $user_detail = new Userdetail();
            $final_ids = $user_detail->getRelatedStudentsByDean($this->session_data->id);
            if ($final_ids == false) {
                $final_ids = array(0);
            }
            $where.= ' AND batchrequests.student_id IN (' . implode(',', $final_ids) . ') AND from_role IN (4,5)';
        }
        
        if ($this->session_data->role == 5) {
            $user_detail = new Userdetail();
            $final_ids = $user_detail->getRelatedStudentsByTeacher($this->session_data->id);
            if ($final_ids == false) {
                $final_ids = array(0);
            }
            $where.= ' AND batchrequests.student_id IN (' . implode(',', $final_ids) . ') AND from_role=5';
        }
        
        $this->load->library('datatable');
        $this->datatable->aColumns = array('CONCAT(student.firstname," ",student.lastname) AS student', 'batches.' . $this->session_data->language . '_name AS batch_name', 'CONCAT(request_user.firstname," ",request_user.lastname) AS request_user', 'clans.' . $this->session_data->language . '_class_name AS clan_name', 'batchrequests.status');
        $this->datatable->eColumns = array('batchrequests.id', 'batches.image AS batch_image', 'student.avtar AS student_image', 'request_user.avtar AS request_user_image', 'student_id', 'from_id', 'from_role');
        $this->datatable->sIndexColumn = "batchrequests.id";
        $this->datatable->sTable = " batchrequests, batches, users student, users request_user, userdetails, clans";
        $this->datatable->myWhere = 'WHERE student.id=userdetails.student_master_id AND userdetails.clan_id=clans.id AND student.id=batchrequests.student_id AND batchrequests.from_id = request_user.id AND batchrequests.batch_id=batches.id ' . $where;
        $this->datatable->datatable_process();
        
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = '<img src="' . IMG_URL . 'user_avtar/100X100/' . $aRow['student_image'] . '" class="avatar img-circle margin-left-killer" alt="avatar"><a href="' . base_url() . 'profile/view/' . $aRow['student_id'] . '" class="text-black">' . $aRow['student'] . '</a>';
            
            $temp_arr[] = '<img src="' . IMG_URL . 'batches/' . $aRow['batch_image'] . '" class="avatar img-circle margin-left-killer" alt="avatar" data-toggle="tooltip" data-original-title="' . $aRow['batch_name'] . '">' . $aRow['batch_name'];
            
            if ($this->session_data->id == $aRow['from_id']) {
                $temp_arr[] = 'You';
            } else {
                $temp_arr[] = '<a href="' . base_url() . 'profile/view/' . $aRow['from_id'] . '" class="text-black">' . $aRow['request_user'] . '</a>';
            }
            
            $temp_arr[] = $aRow['clan_name'];
            
            if ($aRow['status'] == 'A') {
                $temp_arr[] = '<lable class="label label-success">' . $this->lang->line('approved_batch_request') . '</label>';
            } else if ($aRow['status'] == 'U') {
                $temp_arr[] = '<lable class="label label-danger">' . $this->lang->line('unapproved_batch_request') . '</label>';
            } else if ($aRow['status'] == 'P') {
                $temp_arr[] = '<lable class="label label-warning">' . $this->lang->line('pending') . '</label>';
            }
            
            $str = NULL;
            
            $perform_action = false;
            if ($this->session_data->role == 1 || $this->session_data->role == 2 || ($this->session_data->id == $aRow['from_id'] && $aRow['status'] == 'P')) {
                $perform_action = true;
            }
            
            if ($this->session_data->role < $aRow['from_role'] && hasPermission('batchrequests', 'changeStatusBatchrequest')) {
                $str.= '<a href="' . base_url() . 'batchrequest/changestatus/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('change_status') . '"><i class="fa fa-info icon-circle icon-xs icon-default"></i></a>';
            } else {
                $str.= '<a href="' . base_url() . 'batchrequest/view/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('view') . '"><i class="fa fa-info icon-circle icon-xs icon-default"></i></a>';
            }
            
            if ($perform_action && hasPermission('batchrequests', 'editBatchrequest')) {
                $str.= '<a href="' . base_url() . 'batchrequest/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }
            
            if ($perform_action && hasPermission('batchrequests', 'deleteBatchrequest')) {
                $str.= '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
            }
            $temp_arr[] = $str;
            
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }
    
    public function getMessagesJsonData($type = 'inbox') {
        $this->load->library('datatable');
        $this->datatable->aColumns = array('CONCAT (messages.subject,"&", messages.message) AS mess');
        $this->datatable->eColumns = array('messages.id', 'messages.reply_of', 'messages.from_id', 'messages.to_id', 'messages.from_status', 'messages.to_status', 'messages.timestamp', 'messages.type', 'messages.group_id');
        $this->datatable->sIndexColumn = "messages.id";
        $this->datatable->sTable = " messages";
        if ($type == 'inbox') {
            $this->datatable->myWhere = ' WHERE  messages.id IN (select MAX(m1.id) from messages m1 where FIND_IN_SET(' . $this->session_data->id . ', m1.to_id) >0 AND m1.to_status IN ("U", "R") GROUP BY m1.initial_id)';
        } else if ($type == 'sent') {
            $this->datatable->myWhere = ' WHERE from_id=' . $this->session_data->id . ' AND from_status IN ("S")';
        } else if ($type == 'trash') {
            $this->datatable->myWhere = ' WHERE ((messages.from_id = ' . $this->session_data->id . ' AND messages.from_status="T") OR (messages.to_id=' . $this->session_data->id . ' AND messages.to_status="T"))';
        }
        
        $this->datatable->sOrder = " ORDER BY messages.timestamp DESC";
        
        $this->datatable->datatable_process();
        
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $status = '';
            $mess = explode('&', $aRow['mess']);
            if ($type == 'inbox' && $aRow['type'] == 'single' && $aRow['to_status'] == 'U') {
                $status = 'read';
            } else if ($type == 'inbox' && $aRow['type'] == 'group') {
                $messagestatus = new Messagestatus();
                $messagestatus->where(array('message_id' => $aRow['id'], 'to_id' => $this->session_data->id))->get();
                if ($messagestatus->status == 'U') {
                    $status = 'read';
                }
            }
            
            if ($type == 'inbox') {
                $user_info = userNameAvtar($aRow['from_id']);
            } else if ($type == 'sent') {
                $user_info = userNameAvtar($aRow['to_id']);
            } else if ($aRow['type'] == 'single' && $type == 'trash') {
                if ($this->session_data->id == $aRow['from_id']) {
                    $user_info = userNameAvtar($aRow['to_id']);
                } else {
                    $user_info = userNameAvtar($aRow['from_id']);
                }
            }
            
            if ($aRow['type'] == 'single') {
                $type_label = '<span class="label label-info">Single</span>';
                $delete_msg = $this->lang->line('delete');
                $img = '<img src="' . $user_info['avtar'] . '" class="avatar img-circle" alt="Avatar">';
                $name = ucwords($user_info['name']);
            } else {
                $type_label = '<span class="label label-warning">Group</span>';
                $delete_msg = $this->lang->line('leave_group');
                $group = explode('_', $aRow['group_id']);
                $img = '<i class="group-avtar-icon fa fa-users icon-circle icon-primary"></i>';
                $name = ucwords($group[0]);
            }
            
            if (messageHasAttachments($aRow['id'])) {
                $attachments = '<span class="attachment"><i class="fa fa-paperclip"></i></span>';
            } else {
                $attachments = NULL;
            }
            
            $message_id = $aRow['id'];
            
            //getLastReplyOfMessage($aRow['id']);
            $message = NULL;
            
            $message.= '<a class="list-group-item message-delete-checkbox pull-left ' . $status . '" data-toggle="tooltip" data-placement="right" data-original-title="' . $delete_msg . '"><input type="checkbox" value="' . $type . '_' . $message_id . '_' . $aRow['type'] . '" name="message_id[]"></a><a href="' . base_url() . 'message/read/' . $message_id . '" class="list-group-item mail-list ' . $status . '">' . $img . '<span class="name">' . $name . '</span><span class="subject">' . $type_label . character_limiter($mess[0], 50) . '</span>' . $attachments . '<span class="time">' . date('d-m-Y', strtotime($aRow['timestamp'])) . '</span></a>';
            
            $temp_arr[] = $message;
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }
    
    public function getDuelJsonData($user_id, $type = 'all', $type_2 = null) {
        $where = null;
        
        if ($type == 'all') {
            $where = ' AND (to_id=' . $user_id . ' OR from_id=' . $user_id . ')';
        } else if ($type == 'made') {
            if (is_null($type_2) || $type_2 == 'null') {
                $where = ' AND from_id=' . $user_id;
            } else {
                $where = ' AND from_id=' . $user_id . ' AND to_status ="' . $type_2 . '"';
            }
        } else if ($type == 'received') {
            if (is_null($type_2) || $type_2 == 'null') {
                $where = ' AND to_id=' . $user_id;
            } else {
                $where = ' AND to_id=' . $user_id . ' AND to_status ="' . $type_2 . '"';
            }
        } else if ($type == 'rejected') {
            $where = ' AND (to_id=' . $user_id . ' OR from_id=' . $user_id . ') AND (to_status ="R" OR from_status ="R")';
        } else if ($type == 'accepted') {
            $where = ' AND (to_id=' . $user_id . ' OR from_id=' . $user_id . ') AND (to_status ="A" AND from_status ="A")';
        } else if ($type == 'pending') {
            $where = ' AND (to_id=' . $user_id . ' OR from_id=' . $user_id . ') AND (to_status ="P" OR from_status ="P")';
        } else if ($type == 'wins') {
            $where = ' AND (to_id=' . $user_id . ' OR from_id=' . $user_id . ') AND to_status ="A" AND from_status ="A" AND result_status="MP" AND result=' . $user_id;
        } else if ($type == 'defeats') {
            $where = ' AND (to_id=' . $user_id . ' OR from_id=' . $user_id . ') AND to_status ="A" AND from_status ="A" AND result_status="MP" AND result!=' . $user_id;
        } else if ($type == 'submitted') {
            $where = ' AND (from_id=' . $user_id . ') AND (to_status ="P")';
        } else if ($type == 'faliure') {
            $where = ' AND (to_id=' . $user_id . ' OR from_id=' . $user_id . ') AND to_status ="A" AND from_status ="A" AND result=0 AND result_status="SP"';
        }
        
        $this->load->library('datatable');
        $this->datatable->aColumns = array('CONCAT(from_user.firstname," ",from_user.lastname) AS from_name', 'from_user.avtar AS from_avtar', 'from_userdetail.total_score AS from_total_score', 'CONCAT(to_user.firstname," ",to_user.lastname) AS to_name', 'to_user.avtar AS to_avtar', 'to_userdetail.total_score AS to_total_score');
        $this->datatable->eColumns = array('challenges.from_id', 'challenges.to_id', 'challenges.id', 'challenges.from_status', 'challenges.to_status', 'challenges.made_on', 'challenges.status_changed_on', 'challenges.played_on', 'challenges.result', 'challenges.result_status');
        $this->datatable->sIndexColumn = "challenges.id";
        $this->datatable->sTable = " challenges, users from_user, users to_user, userdetails from_userdetail, userdetails to_userdetail";
        $this->datatable->myWhere = ' WHERE from_user.id= challenges.from_id AND to_user.id = challenges.to_id AND from_userdetail.student_master_id=from_user.id AND to_userdetail.student_master_id=to_user.id' . $where;
        
        $this->datatable->datatable_process();
        
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $link_type = null;
            if ($aRow['from_id'] == $user_id) {
                $temp_arr[] = '<img src="' . IMG_URL . 'user_avtar/40X40/' . $aRow['to_avtar'] . '" class="avatar img-circle" alt="avatar"><a href="' . base_url() . 'profile/view/' . $aRow['to_id'] . '">' . $aRow['to_name'] . '</a>';
                $temp_arr[] = $aRow['to_total_score'];
                
                if ($aRow['to_status'] == 'P') {
                    $temp_arr[] = '<span class="label label-default-warning">' . $this->lang->line('pending') . '</span>';
                } else if ($aRow['to_status'] == 'A') {
                    $temp_arr[] = '<span class="label label-default-success">' . $this->lang->line('accepted') . '</span>';
                } else if ($aRow['to_status'] == 'R') {
                    $temp_arr[] = '<span class="label label-default-danger">' . $this->lang->line('rejected') . '</span>';
                }
            } else if ($aRow['to_id'] == $user_id) {
                $temp_arr[] = '<img src="' . IMG_URL . 'user_avtar/40X40/' . $aRow['from_avtar'] . '" class="avatar img-circle" alt="avatar"><a href="' . base_url() . 'profile/view/' . $aRow['from_id'] . '">' . $aRow['from_name'] . '</a>';
                $temp_arr[] = $aRow['from_total_score'];
                
                if ($aRow['to_status'] == 'P') {
                    $temp_arr[] = '<span class="label label-info-warning">' . $this->lang->line('pending') . '</span>';
                } else if ($aRow['to_status'] == 'A') {
                    $temp_arr[] = '<span class="label label-info-success">' . $this->lang->line('accepted') . '</span>';
                } else if ($aRow['to_status'] == 'R') {
                    $temp_arr[] = '<span class="label label-info-danger">' . $this->lang->line('rejected') . '</span>';
                }
            }
            if(isset($aRow['played_on']) && $aRow['played_on'] != ''){
                $str = (date('d-m-Y', strtotime($aRow['played_on'])) != '01-01-1970') ? date('d-m-Y', strtotime($aRow['played_on'])) : '-- ';
                $str .= (date('H:i', strtotime($aRow['played_on'])) != '00:00') ? date('H:i a', strtotime($aRow['played_on'])) : ' --';
                $temp_arr[] = $str;
            } else {
                $temp_arr[] = '&nbsp;';
            }
            
            $temp_arr[] = '<a href="' . base_url() . 'duels/single/' . $aRow['id'] . '" data-toggle="tooltip" data-placement="bottom" data-original-title="detail view" class="btn btn-default btn-xs"><i class="fa fa-share"></i></a>';
            
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }
    
    public function getRattingListJsonData($type = null) {
        $this->load->library('datatable');
        $this->datatable->aColumns = array('CONCAT(firstname, " ", lastname) AS name', 'userdetails.total_score', 'en_academy_name AS academy', 'schools.en_school_name AS school', 'clans.en_class_name AS clan');
        $this->datatable->eColumns = array('users.id', 'avtar', 'userdetails.xpr', 'userdetails.war', 'userdetails.sty', '(SELECT COUNT(*) FROM challenges WHERE to_id=' . $this->session_data->id . ' AND to_status="P") AS total_pending_challenge');
        $this->datatable->sIndexColumn = "users.id";
        $this->datatable->sTable = "userdetails";
        $this->datatable->myWhere = 'JOIN users ON users.id=userdetails.student_master_id JOIN clans ON clans.id=userdetails.clan_id JOIN schools ON schools.id=clans.school_id JOIN academies ON academies.id=schools.academy_id WHERE users.status="A"';
        
        if (is_null($type) || $type == 'all') {
            $this->datatable->sOrder = " ORDER BY userdetails.total_score DESC, CONCAT(firstname, ' ', lastname) ASC";
        } else if (!is_null($type) && $type == 'xpr') {
            $this->datatable->sOrder = " ORDER BY userdetails.xpr DESC, CONCAT(firstname, ' ', lastname) ASC";
        } else if (!is_null($type) && $type == 'war') {
            $this->datatable->sOrder = " ORDER BY userdetails.war DESC, CONCAT(firstname, ' ', lastname) ASC";
        } else if (!is_null($type) && $type == 'sty') {
            $this->datatable->sOrder = " ORDER BY userdetails.sty DESC, CONCAT(firstname, ' ', lastname) ASC";
        }
        
        $this->datatable->datatable_process();
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = '<img src="' . IMG_URL . 'user_avtar/40X40/' . $aRow['avtar'] . '" class="avatar img-circle" alt="avatar"><a href="' . base_url() . 'profile/view/' . $aRow['id'] . '" class="text-black">' . $aRow['name'] . '</a>';
            $temp_arr[] = '<span  data-toggle="tooltip" data-original-title="' . $this->lang->line('xpr') . ': ' . $aRow['xpr'] . ', ' . $this->lang->line('war') . ': ' . $aRow['war'] . ', ' . $this->lang->line('sty') . ': ' . $aRow['sty'] . '">' . $aRow['total_score'] . '</span>';
            $temp_arr[] = $aRow['academy'];
            $temp_arr[] = $aRow['school'];
            $temp_arr[] = $aRow['clan'];
            $check = Challenge::isRequestedBefore($this->session_data->id, $aRow['id']);
            if (!$check && $aRow['id'] != $this->session_data->id) {
                $box_type = ($aRow['total_pending_challenge'] > 3) ? 'cannot_do_duel_box' : 'do_duel_box';
                $temp_arr[] = '<button class="btn btn-warning" data-toggle="modal" data-target="#' . $box_type . '" data-userid="' . $aRow['id'] . '">Challenge!</button>';
            } else {
                $temp_arr[] = '&nbsp';
            }
            
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        
        echo json_encode($this->datatable->output);
        exit();
    }
    
    public function getStudentRattingJsonData($academy_id = 0, $school_id = 0, $clan_id = 0) {
        $where = NULL;
        
        if ($academy_id != 0) {
            $where.= ' AND academies.id=' . $academy_id;
        }
        
        if ($school_id != 0) {
            $where.= ' AND schools.id=' . $school_id;
        }
        
        if ($clan_id != 0) {
            $where.= ' AND clans.id=' . $clan_id;
        }
        
        $this->load->library('datatable');
        $this->datatable->aColumns = array('CONCAT(firstname, " ", lastname) AS student_name', 'total_score', 'clans.' . $this->session_data->language . '_class_name AS class_name', 'schools.' . $this->session_data->language . '_school_name AS school_name', 'academies.' . $this->session_data->language . '_academy_name AS academy_name');
        $this->datatable->eColumns = array('users.id', 'avtar');
        $this->datatable->sIndexColumn = "users.id";
        $this->datatable->sTable = " clans, users, schools, academies, userdetails";
        
        if ($this->session_data->role == '1' || $this->session_data->role == '2') {
            $this->datatable->myWhere = 'WHERE users.status="A" AND academies.id=schools.academy_id AND schools.id=clans.school_id AND userdetails.student_master_id=users.id AND clans.id=userdetails.clan_id ' . $where;
        } else if ($this->session_data->role == '3') {
            $this->datatable->myWhere = 'WHERE users.status="A" AND academies.id=schools.academy_id AND schools.id=clans.school_id AND FIND_IN_SET(' . $this->session_data->id . ', academies.rector_id) > 0 AND userdetails.student_master_id=users.id AND clans.id=userdetails.clan_id ' . $where;
        } else if ($this->session_data->role == '4') {
            $this->datatable->myWhere = 'WHERE users.status="A" AND academies.id=schools.academy_id AND schools.id=clans.school_id AND FIND_IN_SET(' . $this->session_data->id . ', schools.dean_id) > 0 AND userdetails.student_master_id=users.id AND clans.id=userdetails.clan_id ' . $where;
        } else if ($this->session_data->role == '5') {
            $this->datatable->myWhere = 'WHERE users.status="A" AND academies.id=schools.academy_id AND schools.id=clans.school_id AND FIND_IN_SET(' . $this->session_data->id . ', clans.teacher_id) > 0 AND userdetails.student_master_id=users.id AND clans.id=userdetails.clan_id ' . $where;
        }
        $this->datatable->datatable_process();
        
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = '<img src="' . IMG_URL . 'user_avtar/40X40/' . $aRow['avtar'] . '" class="avatar img-circle" alt="avatar"><a href="' . base_url() . 'profile/view/' . $aRow['id'] . '" class="text-black">' . $aRow['student_name'] . '</a>';
            $temp_arr[] = $aRow['total_score'];
            $temp_arr[] = $aRow['class_name'];
            $temp_arr[] = $aRow['school_name'];
            $temp_arr[] = $aRow['academy_name'];
            
            if (hasPermission('studentratings', 'editStudentrating')) {
                $temp_arr[] = '<a href="' . base_url() . 'studentrating/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            } else {
                $temp_arr[] = '&nbsp;';
            }
            
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }
    
    public function getStudentBatchHistoryJsonData($student_id, $type = 'all') {
        $where = null;
        if ($type != 'all') {
            $where = ' AND batch_type=\'' . strtoupper($type) . '\'';
        }
        
        $this->load->library('datatable');
        $this->datatable->aColumns = array($this->session_data->language . '_name', 'batch_type', 'assign_date', 'CONCAT(firstname, " ", lastname) AS assign_user');
        $this->datatable->eColumns = array('user_batches_histories.id', 'image', 'user_batches_histories.user_id');
        $this->datatable->sIndexColumn = "user_batches_histories.id";
        $this->datatable->sTable = " user_batches_histories, batches, users";
        $this->datatable->myWhere = ' WHERE batches.id=user_batches_histories.batch_id AND user_batches_histories.user_id=users.id AND user_batches_histories.student_id = ' . $student_id . $where;
        $this->datatable->datatable_process();
        
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            
            $temp_arr[] = '<img src="' . IMG_URL . 'batches/' . $aRow['image'] . '" class="avatar img-circle" alt="avatar"><a href="#" class="text-black">' . ucwords($aRow[$this->session_data->language . '_name']) . '</a>';
            
            if ($aRow['batch_type'] == 'D') {
                $temp_arr[] = '<span class="label label-info">' . $this->lang->line('degree') . '</span>';
            } else if ($aRow['batch_type'] == 'H') {
                $temp_arr[] = '<span class="label label-success">' . $this->lang->line('honour') . '</span>';
            } else if ($aRow['batch_type'] == 'Q') {
                $temp_arr[] = '<span class="label label-warning">' . $this->lang->line('qualification') . '</span>';
            } else if ($aRow['batch_type'] == 'S') {
                $temp_arr[] = '<span class="label label-danger">' . $this->lang->line('security') . '</span>';
            } else {
                $temp_arr[] = '&nbsp;';
            }
            
            if($aRow['assign_date'] != ''){
                $temp_arr[] = date('d-m-Y', strtotime($aRow['assign_date']));
            }else{
                $temp_arr[] = '';
            }
            
            $temp_arr[] = $aRow['assign_user'];
            
            $str = NULL;
            $perform_action = false;
            
            if ($this->session_data->role == 1 || $this->session_data->role == 2 || $this->session_data->id == $aRow['user_id']) {
                $perform_action = true;
            }
            if ($perform_action && hasPermission('users', 'editStudentBatches')) {
                $str.= '<a href="' . base_url() . 'user_student/badge_history/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }
            
            if ($perform_action && hasPermission('users', 'deleteStudentBatches')) {
                $str.= '<a href="javascript:;" onclick="deleteRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
            }
            $temp_arr[] = $str;
            
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }
    
    public function getStudentScoreHistroyJsonData($student_id, $type = 'all') {
        $where = null;
        if ($type != 'all') {
            $where = ' AND score_type=\'' . strtolower($type) . '\'';
        }
        
        $this->load->library('datatable');
        $this->datatable->aColumns = array('score_type', 'score', 'score_date', 'CONCAT(firstname, " ", lastname) AS assign_user', 'description');
        $this->datatable->eColumns = array('score_histories.id', 'oper', 'score_histories.user_id');
        $this->datatable->sIndexColumn = "score_histories.id";
        $this->datatable->sTable = " score_histories, users";
        $this->datatable->myWhere = ' WHERE score_histories.user_id=users.id AND score_histories.student_id = ' . $student_id . $where;
        $this->datatable->datatable_process();
        
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            
            if ($aRow['score_type'] == 'xpr') {
                $temp_arr[] = '<span class="label label-info">' . $this->lang->line('xpr') . '</span>';
            } else if ($aRow['score_type'] == 'war') {
                $temp_arr[] = '<span class="label label-warning">' . $this->lang->line('war') . '</span>';
            } else if ($aRow['score_type'] == 'sty') {
                $temp_arr[] = '<span class="label label-default">' . $this->lang->line('sty') . '</span>';
            } else {
                $temp_arr[] = '&nbsp;';
            }
            
            if ($aRow['oper'] == 'M') {
                $temp_arr[] = '<span class="label label-success">' . $aRow['score'] . '</span>';
            } else if ($aRow['oper'] == 'D') {
                $temp_arr[] = '<span class="label label-danger">' . $aRow['score'] . '</span>';
            } else {
                $temp_arr[] = '&nbsp;';
            }
            
            $temp_arr[] = date('d-m-Y', strtotime($aRow['score_date']));
            $temp_arr[] = $aRow['assign_user'];
            $temp_arr[] = @$aRow['description'];
            
            $perform_action = false;
            
            if ($this->session_data->role == 1 || $this->session_data->role == 2 || $this->session_data->id == $aRow['user_id']) {
                $perform_action = true;
            }
            
            if ($perform_action && hasPermission('users', 'deleteStudentScore')) {
                $temp_arr[] = '<a href="javascript:;" onclick="deleteRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
            } else {
                $temp_arr[] = null;
            }
            
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }
    
    public function getClanViewAttendanceJsonData() {
        $this->load->library('datatable');
        $this->datatable->aColumns = array('clans.' . $this->session_data->language . '_class_name AS class_name', '(SELECT count(*) from userdetails, clans temp_clan where  userdetails.clan_id=temp_clan.id AND temp_clan.id=clans.id) AS total_students');
        $this->datatable->eColumns = array('clans.id');
        $this->datatable->sIndexColumn = "clans.id";
        $this->datatable->sTable = " clans, users, schools, academies, levels";
        
        if ($this->session_data->role == '1' || $this->session_data->role == '2') {
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id AND schools.id=clans.school_id AND clans.teacher_id=users.id AND clans.level_id=levels.id';
        } else if ($this->session_data->role == '3') {
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id AND schools.id=clans.school_id AND clans.teacher_id=users.id AND FIND_IN_SET(' . $this->session_data->id . ', academies.rector_id) > 0 AND clans.level_id=levels.id';
        } else if ($this->session_data->role == '4') {
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id AND schools.id=clans.school_id AND clans.teacher_id=users.id AND FIND_IN_SET(' . $this->session_data->id . ', dean_id) > 0 AND clans.level_id=levels.id';
        } else if ($this->session_data->role == '5') {
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id AND schools.id=clans.school_id AND clans.teacher_id=users.id AND FIND_IN_SET(' . $this->session_data->id . ', teacher_id) > 0 AND clans.level_id=levels.id';
        }
        
        $this->datatable->groupBy = ' GROUP BY clans.id';
        $this->datatable->datatable_process();
        
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = '<a href="' . base_url() . 'clan/view_clan_attendance/' . $aRow['id'] . '" class="text-black" data-toggle="tooltip" data-placement="bottom" data-original-title="' . $this->lang->line('view_') . ' ' . $this->lang->line('clan') . '">' . $aRow['class_name'] . '</a>';
            
            $temp_arr[] = $aRow['total_students'];
            
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }
    
    public function getViewClanAttendanceJsonData($clan_id) {
        $this->load->library('datatable');
        $this->datatable->aColumns = array('CONCAT(firstname, " ", lastname) AS student_name', '(SELECT count(*) FROM attendances presence WHERE presence.student_id = users.id AND presence.attendance=1) AS total_presence', '(SELECT count(*) FROM attendances absence WHERE absence.student_id = users.id AND absence.attendance=0) AS total_absence', '(SELECT count(*) FROM attendance_recovers recover WHERE recover.student_id = users.id AND recover.attendance=1) AS total_recovery');
        $this->datatable->eColumns = array('users.id', 'avtar');
        $this->datatable->sIndexColumn = "users.id";
        $this->datatable->sTable = " clans, users, userdetails";
        
        if ($this->session_data->role == '1' || $this->session_data->role == '2') {
            $this->datatable->myWhere = 'WHERE userdetails.student_master_id=users.id AND clans.id=userdetails.clan_id AND clans.id=' . $clan_id;
        } else if ($this->session_data->role == '3') {
            $this->datatable->myWhere = 'WHERE userdetails.student_master_id=users.id AND clans.id=userdetails.clan_id AND clans.id=' . $clan_id;
        } else if ($this->session_data->role == '4') {
            $this->datatable->myWhere = 'WHERE userdetails.student_master_id=users.id AND clans.id=userdetails.clan_id AND clans.id=' . $clan_id;
        } else if ($this->session_data->role == '5') {
            $this->datatable->myWhere = 'WHERE userdetails.student_master_id=users.id AND clans.id=userdetails.clan_id AND clans.id=' . $clan_id;
        }
        
        $this->datatable->datatable_process();
        
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = '<img src="' . IMG_URL . 'user_avtar/40X40/' . $aRow['avtar'] . '" class="avatar img-circle" alt="avatar"><a href="' . base_url() . 'clan/view_student_attendance/' . $aRow['id'] . '" class="text-black">' . $aRow['student_name'] . '</a>';
            
            $temp_arr[] = '<span class="badge badge-success">' . $aRow['total_presence'] . '</span>';
            $temp_arr[] = '<span class="badge badge-danger">' . $aRow['total_absence'] . '</span>';;
            $temp_arr[] = '<span class="badge badge-warning">' . $aRow['total_recovery'] . '</span>';;
            
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }
    
    public function getViewStudentAttendanceJsonData($student_id) {
        $this->load->library('datatable');
        $this->datatable->aColumns = array('clan_date');
        $this->datatable->eColumns = array('attendances.id', 'attendance', '(SELECT count(*) FROM attendance_recovers WHERE attendance_recovers.attendance_id=attendances.id) AS recovery');
        $this->datatable->sIndexColumn = "attendances.id";
        $this->datatable->sTable = " attendances";
        $this->datatable->myWhere = 'WHERE student_id=' . $student_id;
        
        $this->datatable->datatable_process();
        
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = date('d-m-Y', strtotime($aRow['clan_date']));
            
            if ($aRow['attendance'] == 1) {
                $temp_arr[] = '<label class="label label-success">P</label>';
            } else if ($aRow['attendance'] == 0 && $aRow['recovery'] == 0) {
                $temp_arr[] = '<label class="label label-danger">A</label>';
            } else if ($aRow['attendance'] == 0 && $aRow['recovery'] == 1) {
                $temp_arr[] = '<label class="label label-warning">R</label>';
            }
            
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }
    
    public function getAnnouncementsJsonData($type = 'inbox') {
        $this->load->library('datatable');
        $this->datatable->aColumns = array('subject');
        $this->datatable->eColumns = array('id', 'from_id', 'to_id', 'timestamp', 'type', 'group_id');
        $this->datatable->sIndexColumn = "id";
        $this->datatable->sTable = " announcements";
        if ($type == 'inbox') {
            $this->datatable->myWhere = ' WHERE FIND_IN_SET(' . $this->session_data->id . ',to_id) >0';
        } else if ($type == 'sent') {
            $this->datatable->myWhere = ' WHERE from_id=' . $this->session_data->id;
        }
        
        $this->datatable->sOrder = " ORDER BY timestamp DESC";
        
        $this->datatable->datatable_process();
        
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            
            if ($type == 'inbox') {
                $user_info = userNameAvtar($aRow['from_id']);
            } else if ($type == 'sent') {
                $user_info = userNameAvtar($aRow['to_id']);
            }
            
            if ($aRow['type'] == 'single') {
                
                //$type_label = '<span class="label label-info">Single</span>';
                $delete_msg = $this->lang->line('delete');
                $img = '<img src="' . $user_info['avtar'] . '" class="avatar img-circle" alt="Avatar">';
                $name = ucwords($user_info['name']);
            } else {
                
                //$type_label = '<span class="label label-warning">Group</span>';
                $delete_msg = $this->lang->line('leave_group');
                $group = explode('_', $aRow['group_id']);
                $img = '<i class="group-avtar-icon fa fa-users icon-circle icon-primary"></i>';
                $name = ucwords($group[0]);
            }
            
            $announcement_id = $aRow['id'];
            
            if ($type == 'sent') {
                $delete = '<a class="list-group-item announcement-delete-checkbox pull-left" data-toggle="tooltip" data-placement="right" data-original-title="' . $delete_msg . '"><input type="checkbox" value="' . $announcement_id . '" name="announcement_id[]"></a>';
            } else {
                $delete = null;
            }
            
            if (strtotime(date('Y-m-d', strtotime($aRow['timestamp']))) == strtotime(get_current_date_time()->get_date_for_db())) {
                $time = date('h:i a', strtotime($aRow['timestamp']));
            } else {
                $time = date('d-m-Y', strtotime($aRow['timestamp']));
            }
            
            $temp_arr[] = $delete . '<a href="' . base_url() . 'announcement/read/' . $announcement_id . '" class="list-group-item mail-list">' . $img . '<span class="name">' . $name . '</span><span class="subject">' . character_limiter($aRow['subject'], 50) . '</span><span class="time">' . $time . '</span></a>';
            
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }
    
    public function getStudentPaymentHistoryJsonData($user_id = null) {
        if (is_null($user_id)) {
            $user_id = $this->session_data->id;
        }
        
        $this->load->library('datatable');
        $this->datatable->aColumns = array('description', 'amount', 'timestamp');
        $this->datatable->eColumns = array('id');
        $this->datatable->sIndexColumn = "id";
        $this->datatable->sTable = " payments";
        $this->datatable->myWhere = 'WHERE user_id=' . $user_id;
        $this->datatable->sOrder = " ORDER BY timestamp DESC";
        $this->datatable->datatable_process();
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = getClanName($aRow['description']);
            $temp_arr[] = '<i class="fa fa-dollar"></i>&nbsp;' . $aRow['amount'];
            $temp_arr[] = date('d-m-Y', strtotime($aRow['timestamp']));
            $temp_arr[] = '<a href="' . base_url() . 'shop/invoice/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('view') . ' ' . $this->lang->line('invoice') . '"><i class="fa fa-file-pdf-o icon-circle icon-xs icon-primary"></i></a>';
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        
        echo json_encode($this->datatable->output);
        exit();
    }

    public function getEvolutioncategoriesJsonData() {
        $this->load->library('datatable');
        $this->datatable->aColumns = array($this->session_data->language . '_name');
        $this->datatable->eColumns = array('id');
        $this->datatable->sIndexColumn = "id";
        $this->datatable->sTable = " evolutioncategories";
        $this->datatable->datatable_process();
        
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = $aRow[$this->session_data->language . '_name'];
            
            $str = NULL;
            if (hasPermission('evolutioncategories', 'editEvolutioncategory')) {
                $str.= '<a href="' . base_url() . 'evolutioncategory/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }
            
            if (hasPermission('evolutioncategories', 'deleteEvolutioncategory')) {
                $str.= '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
            }
            $temp_arr[] = $str;
            
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }

    public function getEvolutionlevelsJsonData() {
        $this->load->library('datatable');
        $this->datatable->aColumns = array('evolutionlevels.' . $this->session_data->language . '_name AS evolutionlevel', 'evolutioncategories.' . $this->session_data->language . '_name AS evolutioncategory', 'el.' . $this->session_data->language . '_name AS criteria');
        $this->datatable->eColumns = array('evolutionlevels.id');
        $this->datatable->sIndexColumn = "evolutionlevels.id";
        $this->datatable->sTable = " evolutionlevels";
        $this->datatable->myWhere = ' LEFT JOIN evolutionlevels el ON evolutionlevels.on_passing=el.id LEFT JOIN evolutioncategories ON evolutioncategories.id=evolutionlevels.evolutioncategory_id';
        $this->datatable->datatable_process();
        
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = $aRow['evolutionlevel'];
            $temp_arr[] = $aRow['evolutioncategory'];
            $temp_arr[] = (!is_null($aRow['criteria'])) ? $aRow['criteria'] : $this->lang->line('basic_evolution_level');
            
            $str = NULL;
            if (hasPermission('evolutionlevels', 'editEvolutionlevel')) {
                $str.= '<a href="' . base_url() . 'evolutionlevel/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }
            
            if (hasPermission('evolutionlevels', 'deleteEvolutionlevel')) {
                $str.= '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
            }
            $temp_arr[] = $str;
            
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }

    public function getEvolutionClansJsonData($school_id) {
        $where = Null;
        
        if ($school_id != 0) {
            $where = ' AND school_id = ' . $school_id;
        }
        
        $this->load->library('datatable');
        $this->datatable->aColumns = array('evolutionclans.' . $this->session_data->language . '_class_name AS class_name', 'CONCAT(users.firstname," ", users.lastname) AS instructor', 'evolutionlevels.' . $this->session_data->language . '_name AS level', 'schools.' . $this->session_data->language . '_school_name AS school_name', 'academies.' . $this->session_data->language . '_academy_name AS academy_name', '(SELECT count(*) from evolutionstudents, evolutionclans temp_clan where evolutionstudents.evolutionclan_id=temp_clan.id AND temp_clan.id=evolutionclans.id) AS total_students');
        $this->datatable->eColumns = array('evolutionclans.id');
        $this->datatable->sIndexColumn = "evolutionclans.id";
        $this->datatable->sTable = " evolutionclans, users, schools, academies, evolutionlevels";
        
        if ($this->session_data->role == '1' || $this->session_data->role == '2') {
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id AND schools.id=evolutionclans.school_id AND evolutionclans.teacher_id=users.id AND evolutionclans.evolutionlevel_id=evolutionlevels.id' . $where;
        } else if ($this->session_data->role == '3') {
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id AND schools.id=evolutionclans.school_id AND evolutionclans.teacher_id=users.id AND FIND_IN_SET(' . $this->session_data->id . ', academies.rector_id) > 0 AND evolutionclans.evolutionlevel_id=evolutionlevels.id' . $where;
        } else if ($this->session_data->role == '4') {
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id AND schools.id=evolutionclans.school_id AND evolutionclans.teacher_id=users.id AND FIND_IN_SET(' . $this->session_data->id . ', dean_id) > 0 AND evolutionclans.evolutionlevel_id=evolutionlevels.id' . $where;
        } else if ($this->session_data->role == '5') {
            $this->datatable->myWhere = 'WHERE academies.id=schools.academy_id AND schools.id=evolutionclans.school_id AND evolutionclans.teacher_id=users.id AND FIND_IN_SET(' . $this->session_data->id . ', evolutionclans.teacher_id) > 0 AND evolutionclans.evolutionlevel_id=evolutionlevels.id' . $where;
        }
        
        $this->datatable->groupBy = ' GROUP BY evolutionclans.id';
        $this->datatable->datatable_process();
        
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = '<a href="' . base_url() . 'evolutionclan/view/' . $aRow['id'] . '" class="text-black" data-toggle="tooltip" data-placement="bottom" data-original-title="' . $this->lang->line('view_') . ' ' . $this->lang->line('clan') . '">' . $aRow['class_name'] . '</a>';
            
            $temp_arr[] = $aRow['instructor'];
            $temp_arr[] = $aRow['level'];
            $temp_arr[] = $aRow['school_name'] . ', ' . $aRow['academy_name'];
            if ($aRow['total_students'] > 0) {
                $temp_arr[] = '<a href="' . base_url() . 'evolutionclan/studentlist/' . $aRow['id'] . '/clan" class="text-black" data-toggle="tooltip" data-placement="bottom" data-original-title="' . $this->lang->line('view_all') . ' ' . $this->lang->line('student') . '">' . $aRow['total_students'] . '</a>';
            } else {
                $temp_arr[] = $aRow['total_students'];
            }
            
            $str = NULL;
            if (hasPermission('evolutionclans', 'editEvolutionclan')) {
                $str.= '<a href="' . base_url() . 'evolutionclan/edit/' . $aRow['id'] . '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            }
            
            if (hasPermission('evolutionclans', 'deleteEvolutionclan')) {
                $str.= '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
            }
            $temp_arr[] = $str;
            
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }

    public function getEvolutionClanRequestJsonData($clan_id = null) {
        $this->load->library('datatable');
        $this->datatable->aColumns = array('CONCAT(users.firstname," ", users.lastname) AS student_name', 'evolutionclans.' . $this->session_data->language . '_class_name AS class_name', 'evolutionstudents.timestamp', 'evolutionstudents.status');
        $this->datatable->eColumns = array('evolutionstudents.id', 'student_id', 'evolutionclan_id');
        $this->datatable->sIndexColumn = "evolutionstudents.id";
        
        if (!is_null($clan_id)) {
            $this->datatable->sTable = "evolutionclans, users, evolutionstudents";
            $this->datatable->myWhere = 'WHERE evolutionstudents.evolutionclan_id=evolutionclans.id AND evolutionstudents.student_id=users.id AND evolutionstudents.status= "P" AND evolutionclans.id=' . $clan_id;
        } else {
            if ($this->session_data->role == 1 || $this->session_data->role == 2) {
                $this->datatable->sTable = " evolutionclans, users, evolutionstudents";
                $this->datatable->myWhere = 'WHERE evolutionstudents.evolutionclan_id=evolutionclans.id AND evolutionstudents.student_id=users.id AND evolutionstudents.status= "P"';
            } else if ($this->session_data->role == 3) {
                $this->datatable->sTable = " users, evolutionstudents, academies, schools, evolutionclans";
                $this->datatable->myWhere = 'WHERE evolutionstudents.student_id=users.id AND evolutionstudents.status= "P" AND academies.id=schools.academy_id AND schools.id=evolutionclans.school_id AND evolutionclans.id=evolutionstudents.evolutionclan_id AND FIND_IN_SET(' . $this->session_data->id . ', academies.rector_id) > 0';
            } else if ($this->session_data->role == 4) {
                $this->datatable->sTable = " users, evolutionstudents, schools, evolutionclans";
                $this->datatable->myWhere = 'WHERE evolutionstudents.student_id=users.id AND evolutionstudents.status= "P" AND  schools.id=evolutionclans.school_id AND evolutionclans.id=evolutionstudents.evolutionclan_id AND FIND_IN_SET(' . $this->session_data->id . ', schools.dean_id) > 0';
            } else if ($this->session_data->role == 5) {
                $this->datatable->sTable = " users, evolutionstudents, evolutionclans";
                $this->datatable->myWhere = 'WHERE evolutionstudents.student_id=users.id AND evolutionstudents.status ="P" AND evolutionclans.id=evolutionstudents.evolutionclan_id AND FIND_IN_SET(' . $this->session_data->id . ', evolutionclans.teacher_id) > 0';
            }
        }
        
        $this->datatable->datatable_process();
        
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = $aRow['student_name'];
            $temp_arr[] = $aRow['class_name'];
            $temp_arr[] = date('d-m-Y', strtotime($aRow['timestamp']));     
            
            if ($aRow['status'] == 'A') {
                $temp_arr[] = '<label class="label label-success">' . $this->lang->line('approved') . '</label>';
            } else if ($aRow['status'] == 'U') {
                $temp_arr[] = '<label class="label label-danger">' . $this->lang->line('unapproved') . '</label>';
            } else if ($aRow['status'] == 'P') {
                $temp_arr[] = '<label class="label label-warning">' . $this->lang->line('pending') . '</label>';
            } else {
                $temp_arr[] = null;
            }
            if (hasPermission('evolutionclans', 'changeRequestStatus')) {
                $temp_arr[] = '<a href="' . base_url() . 'evolutionclan/check_request/' . $aRow['id'] . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('change_status') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
            } else {
                $temp_arr[] = '&nbsp;';
            }
            
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }

    public function getEvolutionClanStudentsJsonData($academy_id = 0, $school_id = 0, $evolutionclan_id = 0) {
        $where = NULL;
        
        if ($academy_id != 0) {
            $where.= ' AND academies.id=' . $academy_id;
        }
        
        if ($school_id != 0) {
            $where.= ' AND schools.id=' . $school_id;
        }
        
        if ($evolutionclan_id != 0) {
            $where.= ' AND evolutionclans.id=' . $evolutionclan_id;
        }
        
        $this->load->library('datatable');
        $this->datatable->aColumns = array('CONCAT(firstname, " ", lastname) AS student_name', 'evolutionclans.' . $this->session_data->language . '_class_name AS class_name', 'schools.' . $this->session_data->language . '_school_name AS school_name', 'academies.' . $this->session_data->language . '_academy_name AS academy_name');
        $this->datatable->eColumns = array('users.id', 'avtar');
        $this->datatable->sIndexColumn = "users.id";
        $this->datatable->sTable = " users, evolutionstudents";
        
        if ($this->session_data->role == '1' || $this->session_data->role == '2') {
            $this->datatable->myWhere = ' JOIN evolutionclans ON evolutionclans.id=evolutionstudents.evolutionclan_id JOIN schools ON schools.id=evolutionclans.school_id JOIN academies ON academies.id=schools.academy_id WHERE evolutionstudents.student_id=users.id AND users.status="A" ' . $where;
        } else if ($this->session_data->role == '3') {
            $this->datatable->myWhere = ' JOIN evolutionclans ON evolutionclans.id=userdetails.evolutionclan_id JOIN schools ON schools.id=evolutionclans.school_id JOIN academies ON academies.id=schools.academy_id  AND FIND_IN_SET(' . $this->session_data->id . ', academies.rector_id) > 0 WHERE evolutionstudents.student_id=users.id AND users.status="A" ' . $where;
        } else if ($this->session_data->role == '4') {
            $this->datatable->myWhere = ' JOIN evolutionclans ON evolutionclans.id=userdetails.evolutionclan_id JOIN schools ON schools.id=evolutionclans.school_id  AND FIND_IN_SET(' . $this->session_data->id . ', schools.dean_id) > 0 JOIN academies ON academies.id=schools.academy_id WHERE evolutionstudents.student_id=users.id AND users.status="A" ' . $where;
        } else if ($this->session_data->role == '5') {
            $this->datatable->myWhere = ' JOIN evolutionclans ON evolutionclans.id=userdetails.evolutionclan_id AND FIND_IN_SET(' . $this->session_data->id . ', evolutionclans.teacher_id) > 0 JOIN schools ON schools.id=evolutionclans.school_id JOIN academies ON academies.id=schools.academy_id WHERE evolutionstudents.student_id=users.id AND users.status="A" ' . $where;
        }
        $this->datatable->datatable_process();
        
        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();
            $temp_arr[] = '<img src="' . IMG_URL . 'user_avtar/40X40/' . $aRow['avtar'] . '" class="avatar img-circle" alt="avatar"><a href="' . base_url() . 'profile/view/' . $aRow['id'] . '" class="text-black">' . $aRow['student_name'] . '</a>';

            $temp_arr[] = $aRow['class_name'];
            $temp_arr[] = $aRow['school_name'];
            $temp_arr[] = $aRow['academy_name'];
            
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }
}