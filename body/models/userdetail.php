<?php
class Userdetail extends DataMapper
{
    
    public $table = 'userdetails';
    public $has_one = array('clan', 'user' => array('join_other_as' => 'user', 'join_self_as' => 'id'));
    
    function __construct($id = NULL) {
        parent::__construct($id);
    }

    public static function getAssingStudentIds() {
        $CI =& get_instance();
        $CI->db->_protect_identifiers = false;
        $CI->db->select('student_master_id');
        $CI->db->from('userdetails');
        $CI->db->join('users', 'users.id=userdetails.student_master_id');
        $CI->db->where('userdetails.status', 'A');
        $CI->db->where('users.status', 'A');
        $res = $CI->db->get();
        $array = array();
        if ($res->num_rows > 0) {
            $result = $res->result_array();
            $array = MultiArrayToSinlgeArray($result);
        }
        
        return array_unique($array);
    }
    
    public static function getAssignStudentIdsByCaln($clan_id) {
        $CI =& get_instance();
        $CI->db->_protect_identifiers = false;
        $CI->db->select('student_master_id');
        $CI->db->from('userdetails');
        $CI->db->join('users', 'users.id=userdetails.student_master_id');
        $CI->db->where('clan_id', $clan_id);
        $CI->db->where('userdetails.status', 'A');
        $CI->db->where('users.status', 'A');
        $res = $CI->db->get();
        $array = array();
        if ($res->num_rows > 0) {
            $result = $res->result_array();
            $array = MultiArrayToSinlgeArray($result);
        }

        return array_unique($array);
    }
    
    function getRelatedStudentsByRector($rector_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('student_master_id');
        $this->db->from('userdetails');
        $this->db->join('clans', 'clans.id=userdetails.clan_id');
        $this->db->join('schools', 'schools.id=clans.school_id');
        $this->db->join('academies', 'academies.id=schools.academy_id');
        $this->db->join('users', 'users.id=userdetails.student_master_id');
        $this->db->where("FIND_IN_SET(" . $rector_id . ", academies.rector_id) > 0");
        $this->db->where('users.status', 'A');
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $temp = $res->result();
            $array = array();
            foreach ($temp as $value) {
                $array[] = $value->student_master_id;
            }
            return array_unique($array);
        } else {
            return false;
        }
    }
    
    function getRelatedStudentsByDean($dean_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('student_master_id');
        $this->db->from('userdetails');
        $this->db->join('clans', 'clans.id=userdetails.clan_id');
        $this->db->join('schools', 'schools.id=clans.school_id');
        $this->db->join('users', 'users.id=userdetails.student_master_id');
        $this->db->where("FIND_IN_SET(" . $dean_id . ", dean_id) > 0");
        $this->db->where('users.status', 'A');
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $temp = $res->result();
            $array = array();
            foreach ($temp as $value) {
                $array[] = $value->student_master_id;
            }
            return array_unique($array);
        } else {
            return false;
        }
    }
    
    function getRelatedStudentsByTeacher($teacher_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('student_master_id');
        $this->db->from('userdetails');
        $this->db->join('clans', 'clans.id=userdetails.clan_id');
        $this->db->join('users', 'users.id=userdetails.student_master_id');
        $this->db->where("FIND_IN_SET(" . $teacher_id . ", teacher_id) > 0");
        $this->db->where('users.status', 'A');
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $temp = $res->result();
            $array = array();
            foreach ($temp as $value) {
                $array[] = $value->student_master_id;
            }
            return array_unique($array);
        } else {
            return false;
        }
    }
    
    function getRelatedStudentsByStudent($student_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('s1.student_master_id');
        $this->db->from('userdetails s1');
        $this->db->join('clans', 'clans.id=s1.clan_id');
        $this->db->join('userdetails s2', 'clans.id=s2.clan_id');
        $this->db->join('users', 'users.id=s1.student_master_id');
        $this->db->where('s2.student_master_id', $student_id);
        $this->db->where('users.status', 'A');
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $temp = $res->result();
            $array = array();
            foreach ($temp as $value) {
                $array[] = $value->student_master_id;
            }
            return array_unique($array);
        } else {
            return false;
        }
    }
    
    function getStudentsByAcademy($academy_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('student_master_id');
        $this->db->from('userdetails');
        $this->db->join('clans', 'clans.id=userdetails.clan_id');
        $this->db->join('schools', 'schools.id=clans.school_id');
        $this->db->join('academies', 'academies.id=schools.academy_id');
        $this->db->join('users', 'users.id=userdetails.student_master_id');
        $this->db->where('academies.id', $academy_id);
        $this->db->where('users.status', 'A');
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $temp = $res->result();
            $array = array();
            foreach ($temp as $value) {
                $array[] = $value->student_master_id;
            }
            return array_unique($array);
        } else {
            return false;
        }
    }
    
    function getStudentsBySchool($school_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('student_master_id');
        $this->db->from('userdetails');
        $this->db->join('clans', 'clans.id=userdetails.clan_id');
        $this->db->join('schools', 'schools.id=clans.school_id');
        $this->db->join('users', 'users.id=userdetails.student_master_id');
        $this->db->where('schools.id', $school_id);
        $this->db->where('users.status', 'A');
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $temp = $res->result();
            $array = array();
            foreach ($temp as $value) {
                $array[] = $value->student_master_id;
            }
            return array_unique($array);
        } else {
            return false;
        }
    }
    
    function getStudentsByClan($clan_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('student_master_id');
        $this->db->from('userdetails');
        $this->db->join('clans', 'clans.id=userdetails.clan_id');
        $this->db->join('users', 'users.id=userdetails.student_master_id');
        $this->db->where('clans.id', $clan_id);
        $this->db->where('users.status', 'A');
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $temp = $res->result();
            $array = array();
            foreach ($temp as $value) {
                $array[] = $value->student_master_id;
            }
            return array_unique($array);
        } else {
            return false;
        }
    }
    
    function getTotalTrailRequestByClan($clan_id) {
        $this->db->select('count(*) as total');
        $this->db->from('users');
        $this->db->join('userdetails', 'users.id=userdetails.student_master_id');
        $this->db->where('users.status', 'P');
        $this->db->where('userdetails.clan_id', $clan_id);
        $res = $this->db->get()->result();
        return $res[0]->total;
    }
    
    function getTotalTrailRequestByUser($user_id) {
        $session = get_instance()->session->userdata('user_session');
        $this->db->_protect_identifiers = false;
        $this->db->select('count(*) as total');
        $this->db->from('users');
        $this->db->join('userdetails', 'users.id=userdetails.student_master_id');
        $this->db->join('clans c1', 'c1.id=userdetails.clan_id');
        if ($session->role == 3) {
            $this->db->join('clans', 'schools.id=clans.school_id');
            $this->db->join('schools', 'academies.id=schools.academy_id');
            $this->db->where('FIND_IN_SET(' . $user_id . ', academies.rector_id) > 0');
        } else if ($session->role == 4) {
            $this->db->join('clans', 'schools.id=clans.school_id');
            $this->db->where('FIND_IN_SET(' . $user_id . ', schools.dean_id) > 0');
        } else if ($session->role == 5) {
            $this->db->where('FIND_IN_SET(' . $user_id . ', c1.teacher_id) > 0');
        }
        $this->db->where('users.status', 'P');
        $res = $this->db->get()->result();
        return $res[0]->total;
    }
    
    function userDetailsBeforeAfterMe($id, $score, $type, $type_2 = null, $limit = null) {
        $this->db->_protect_identifiers = false;
        $this->db->select('users.id, CONCAT(firstname," ", lastname) as name, avtar, userdetails.total_score');
        $this->db->from('userdetails');
        
        if (is_null($type_2)) {
            $this->db->join('users', 'users.id=userdetails.student_master_id');
            $this->db->join('userdetails s2', 'users.id=s2.student_master_id');
        } else if (!is_null($type_2) && $type_2 == 'academy') {
            $this->db->join('users', 'users.id=userdetails.student_master_id');
            $this->db->join('clans', 'clans.id=userdetails.clan_id');
            $this->db->join('schools', 'schools.id=clans.school_id');
            $this->db->join('academies', 'academies.id=schools.academy_id');
            $this->db->join('schools sc2', 'academies.id=sc2.academy_id');
            $this->db->join('clans c2', 'sc2.id=c2.school_id');
            $this->db->join('userdetails s2', 'c2.id=s2.clan_id');
            $this->db->where('s2.student_master_id ', $id);
        } else if (!is_null($type_2) && $type_2 == 'school') {
            $this->db->join('users', 'users.id=userdetails.student_master_id');
            $this->db->join('clans', 'clans.id=userdetails.clan_id');
            $this->db->join('schools', 'schools.id=clans.school_id');
            $this->db->join('academies', 'academies.id=schools.academy_id');
            $this->db->join('clans c2', 'schools.id=c2.school_id');
            $this->db->join('userdetails s2', 'c2.id=s2.clan_id');
            $this->db->where('s2.student_master_id ', $id);
        }
        if (!is_null($type_2) && $type_2 == 'clan') {
            $this->db->join('users', 'users.id=userdetails.student_master_id');
            $this->db->join('clans', 'clans.id=userdetails.clan_id');
            $this->db->join('schools', 'schools.id=clans.school_id');
            $this->db->join('academies', 'academies.id=schools.academy_id');
            $this->db->join('userdetails s2', 'clans.id=s2.clan_id');
            $this->db->where('s2.student_master_id ', $id);
        }
        
        $this->db->where('users.status', 'A');
        $this->db->where('users.id !=', $id);
        
        if (!is_null($type) && $type == 'before') {
            $this->db->where('userdetails.total_score > ', $score, null, false);
            $this->db->order_by('userdetails.total_score', 'ASC');
        } else if (!is_null($type) && $type == 'after') {
            $this->db->where('userdetails.total_score < ', $score, null, false);
            $this->db->order_by('userdetails.total_score', 'DESC');
        }
        
        if (!is_null($limit)) {
            $this->db->limit($limit);
        }
        
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $return = $res->result();
            return $return;
        } else {
            return false;
        }
    }
    
    function topStudents($type = null, $type_2 = null, $limit = null) {
        $ci = & get_instance();
        $session = $ci->session->userdata('user_session');
        $this->db->_protect_identifiers = false;
        if ($session->role == 6) {
            $reset_date = date('Y-m-d', strtotime($ci->config->item('reset_app_day_month') . '-' . (get_current_date_time()->year + 1)));
            
            $this->db->select('users.id, CONCAT(firstname," ", lastname) as name, avtar, userdetails.xpr, userdetails.war, userdetails.sty, userdetails.total_score, role_id, quote, ' . $session->language . '_academy_name as academy, schools.' . $session->language . '_school_name as school, clans.' . $session->language . '_class_name as clan, (SELECT COUNT(*) FROM challenges WHERE DATE(made_on) <= "' . $reset_date . '" AND ((from_id=' . $session->id . ' AND challenges.to_id=userdetails.student_master_id) OR (to_id=' . $session->id . ' AND challenges.from_id=userdetails.student_master_id))) AS total_challenge');
        } else {
            $this->db->select('users.id, CONCAT(firstname," ", lastname) as name, avtar, userdetails.xpr, userdetails.war, userdetails.sty, userdetails.total_score, role_id, quote, ' . $session->language . '_academy_name as academy, schools.' . $session->language . '_school_name as school, clans.' . $session->language . '_class_name as clan');
        }
        
        $this->db->from('userdetails');
        
        if (is_null($type_2)) {
            $this->db->join('users', 'users.id=userdetails.student_master_id');
            $this->db->join('clans', 'clans.id=userdetails.clan_id');
            $this->db->join('schools', 'schools.id=clans.school_id');
            $this->db->join('academies', 'academies.id=schools.academy_id');
        } else if (!is_null($type_2) && $type_2 == 'academy') {
            $this->db->join('users', 'users.id=userdetails.student_master_id');
            $this->db->join('clans', 'clans.id=userdetails.clan_id');
            $this->db->join('schools', 'schools.id=clans.school_id');
            $this->db->join('academies', 'academies.id=schools.academy_id');
            $this->db->join('schools sc2', 'academies.id=sc2.academy_id');
            $this->db->join('clans c2', 'sc2.id=c2.school_id');
            $this->db->join('userdetails s2', 'c2.id=s2.clan_id');
            $this->db->where('s2.student_master_id ', $session->id);
        } else if (!is_null($type_2) && $type_2 == 'school') {
            $this->db->join('users', 'users.id=userdetails.student_master_id');
            $this->db->join('clans', 'clans.id=userdetails.clan_id');
            $this->db->join('schools', 'schools.id=clans.school_id');
            $this->db->join('academies', 'academies.id=schools.academy_id');
            $this->db->join('clans c2', 'schools.id=c2.school_id');
            $this->db->join('userdetails s2', 'c2.id=s2.clan_id');
            $this->db->where('s2.student_master_id ', $session->id);
        } else if (!is_null($type_2) && $type_2 == 'clan') {
            $this->db->join('users', 'users.id=userdetails.student_master_id');
            $this->db->join('clans', 'clans.id=userdetails.clan_id');
            $this->db->join('schools', 'schools.id=clans.school_id');
            $this->db->join('academies', 'academies.id=schools.academy_id');
            $this->db->join('userdetails s2', 'clans.id=s2.clan_id');
            $this->db->where('s2.student_master_id ', $session->id);
        }
        
        $this->db->where('users.status', 'A');
        
        if (is_null($type)) {
            $this->db->order_by('total_score', 'DESC');
        } else if (!is_null($type) && $type == 'xpr') {
            $this->db->order_by('xpr', 'DESC');
        } else if (!is_null($type) && $type == 'war') {
            $this->db->order_by('war', 'DESC');
        } else if (!is_null($type) && $type == 'sty') {
            $this->db->order_by('sty', 'DESC');
        }
        
        $this->db->order_by('CONCAT(firstname," ", lastname)', 'ASC');
        if (!is_null($limit)) {
            $this->db->limit($limit);
        }
        
        $res = $this->db->get();
        
        if ($res->num_rows > 0) {
            $return = $res->result();
            return $return;
        } else {
            return false;
        }
    }
    
    function getCurrentBatches($student_id) {
    }
}

?>