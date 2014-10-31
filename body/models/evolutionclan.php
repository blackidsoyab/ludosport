<?php
class Evolutionclan extends DataMapper
{
    
    public $table = 'evolutionclans';
    public $has_one = array('school', 'evolutioncategory');
    public $has_many = array('evolutionstudent');
    
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }

    function getEvolutionClanforAjax($school_id) {
        $session = get_instance()->session->userdata('user_session');
        $this->db->_protect_identifiers = false;
        $this->db->select('evolutionclans.*');
        $this->db->from('evolutionclans');
        
        if ($session->role == 3) {
            $this->db->join('schools', 'schools.id=evolutionclans.school_id');
            $this->db->join('academies', 'academies.id=schools.academy_id');
            $this->db->where('FIND_IN_SET(' . $session->id . ', academies.rector_id) > 0');
        } else if ($session->role == 4) {
            $this->db->join('schools', 'schools.id=evolutionclans.school_id');
            $this->db->where('FIND_IN_SET(' . $session->id . ', schools.dean_id) > 0');
        } else if ($session->role == 5) {
            $this->db->where('FIND_IN_SET(' . $session->id . ', evolutionclans.teacher_id) > 0');
        }
        
        $this->db->where('evolutionclans.school_id', $school_id);
        $this->db->group_by("evolutionclans.id");
        $res = $this->db->get()->result();
        return $res;
    }

    function getEvolutionClanMonth($month) {
        $session = get_instance()->session->userdata('user_session');
        $this->db->_protect_identifiers = false;
        $this->db->select('evolutionclans.id,' . $session->language . '_class_name AS clan,' . $session->language . '_school_name AS school,' . $session->language . '_academy_name AS academy, evolutionclandates.clan_date');
        $this->db->from('evolutionclans');
        $this->db->join('evolutionclandates', 'evolutionclans.id=evolutionclandates.evolutionclan_id');
        if ($session->role == 1 || $session->role == 2) {
            $this->db->join('schools', 'schools.id=evolutionclans.school_id');
            $this->db->join('academies', 'academies.id=schools.academy_id');
        } else if ($session->role == 3) {
            $this->db->join('schools', 'schools.id=evolutionclans.school_id');
            $this->db->join('academies', 'academies.id=schools.academy_id');
            $this->db->where("FIND_IN_SET(" . $session->id . ", rector_id) > 0");
        } else if ($session->role == 4) {
            $this->db->join('schools', 'schools.id=evolutionclans.school_id');
            $this->db->join('academies', 'academies.id=schools.academy_id');
            $this->db->where("FIND_IN_SET(" . $session->id . ", dean_id) > 0");
        } else if ($session->role == 5) {
            $this->db->join('schools', 'schools.id=evolutionclans.school_id');
            $this->db->join('academies', 'academies.id=schools.academy_id');
            $this->db->where("FIND_IN_SET(" . $session->id . ", teacher_id) > 0");
        } else if($session->role == 6){
            $this->db->join('schools', 'schools.id=evolutionclans.school_id');
            $this->db->join('academies', 'academies.id=schools.academy_id');
            $this->db->join('evolutionstudents', 'evolutionclans.id=evolutionstudents.evolutionclan_id');
            $this->db->where('student_id', $session->id);
        }
        
        $this->db->where('MONTH(evolutionclandates.clan_date)', $month);
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }

    function getClansDetailsByDay($clan_id, $day = '1') {
        $this->db->_protect_identifiers = false;
        $this->db->select('evolutionclans.*');
        $this->db->from('evolutionclans');
        $this->db->where('id', $clan_id);
        $this->db->where("FIND_IN_SET('" . $day . "', lesson_day) > 0");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    function getClanOfRector($rector_id) {
        $where = NULL;
        if (is_array($rector_id)) {
            foreach ($rector_id as $id) {
                $where.= " OR FIND_IN_SET('" . $id . "', rector_id) > 0";
            }
        } else {
            $where.= " OR FIND_IN_SET('" . $rector_id . "', rector_id) > 0";
        }
        
        $this->db->_protect_identifiers = false;
        $this->db->select('evolutionclans.*');
        $this->db->from('evolutionclans');
        $this->db->join('schools', 'schools.id=evolutionclans.school_id');
        $this->db->join('academies', 'academies.id=schools.academy_id');
        $this->db->where(substr($where, 4));
        $this->db->group_by("evolutionclans.id");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }
    
    function getClanOfDean($dean_id) {
        $where = NULL;
        if (is_array($dean_id)) {
            foreach ($dean_id as $id) {
                $where.= " OR FIND_IN_SET('" . $id . "', dean_id) > 0";
            }
        } else {
            $where.= " OR FIND_IN_SET('" . $dean_id . "', dean_id) > 0";
        }
        
        $this->db->_protect_identifiers = false;
        $this->db->select('evolutionclans.*');
        $this->db->from('evolutionclans');
        $this->db->join('schools', 'schools.id=evolutionclans.school_id');
        $this->db->where(substr($where, 4));
        $this->db->group_by("evolutionclans.id");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }
    
    function getClanOfTeacher($teacher_id) {
        $where = NULL;
        if (is_array($teacher_id)) {
            foreach ($teacher_id as $id) {
                $where.= " OR FIND_IN_SET('" . $teacher_id . "', teacher_id) > 0";
            }
        } else {
            $where.= " OR FIND_IN_SET('" . $teacher_id . "', teacher_id) > 0";
        }
        
        $this->db->_protect_identifiers = false;
        $this->db->select('evolutionclans.*');
        $this->db->from('evolutionclans');
        $this->db->where(substr($where, 4));
        $this->db->group_by("evolutionclans.id");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }
    
    function getClanOfStudent($student_id) {
        $where = NULL;
        if (is_array($student_id)) {
            foreach ($student_id as $id) {
                $where.= " OR student_master_id='" . $id . "'";
            }
        } else {
            $where.= " OR student_master_id='" . $student_id . "'";
        }
        
        $this->db->_protect_identifiers = false;
        $this->db->select('evolutionclans.*');
        $this->db->from('evolutionclans');
        $this->db->join('userdetails', 'evolutionclans.id=userdetails.clan_id');
        $this->db->where(substr($where, 4), null, false);
        $this->db->group_by("evolutionclans.id");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }

    function getClansByDateForCronJob($date) {
        $this->db->_protect_identifiers = false;
        $this->db->select('evolutionclans.id, teacher_id, evolutionclandates.clan_date');
        $this->db->from('evolutionclans');
        $this->db->join('evolutionclandates', 'evolutionclans.id=evolutionclandates.evolutionclan_id');
        $this->db->where('evolutionclandates.clan_date', $date);
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }
}
?>
