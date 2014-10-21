<?php
class School extends DataMapper
{
    
    public $has_one = array('academy');
    public $has_many = array('clan','evolutionclan');
    
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }
    
    function getTotalSchoolOfRector($rector_id) {
        $this->db->select('count(*) as total');
        $this->db->from('schools');
        $this->db->join('academies', 'academies.id=schools.academy_id');
        $this->db->where('FIND_IN_SET(' . $rector_id . ', academies.rector_id) > 0');
        $res = $this->db->get()->result();
        return $res[0]->total;
    }
    
    function getSchoolOfRector($rector_id) {
        $this->db->select('schools.*');
        $this->db->from('schools');
        $this->db->join('academies', 'academies.id=schools.academy_id');
        $this->db->where('FIND_IN_SET(' . $rector_id . ', academies.rector_id) > 0');
        $this->db->group_by("schools.id");
        $res = $this->db->get()->result();
        return $res;
    }
    
    function getTotalSchoolOfDean($dean_id) {
        $this->db->select('count(*) as total');
        $this->db->from('schools');
        $this->db->where('FIND_IN_SET(' . $dean_id . ', schools.dean_id) > 0');
        $this->db->group_by("schools.id");
        $res = $this->db->get()->result();
        return $res[0]->total;
    }
    
    function getSchoolOfDean($dean_id) {
        $this->db->select('schools.*');
        $this->db->from('schools');
        $this->db->where('FIND_IN_SET(' . $dean_id . ', schools.dean_id) > 0');
        $this->db->group_by("schools.id");
        $res = $this->db->get()->result();
        return $res;
    }
    
    function getTotalSchoolOfTeacher($teacher_id) {
        $this->db->select('count(schools.*) as total');
        $this->db->from('schools');
        $this->db->join('clans', 'schools.id=clans.school_id');
        $this->db->where('FIND_IN_SET(' . $teacher_id . ', clans.teacher_id) > 0');
        $this->db->group_by("schools.id");
        $res = $this->db->get()->result();
        return $res[0]->total;
    }
    
    function getSchoolOfTeacher($teacher_id) {
        $this->db->select('schools.*');
        $this->db->from('schools');
        $this->db->join('clans', 'schools.id=clans.school_id');
        $this->db->where('FIND_IN_SET(' . $teacher_id . ', clans.teacher_id) > 0');
        $this->db->group_by("schools.id");
        $res = $this->db->get()->result();
        return $res;
    }
    
    function getSchoolOfStudent($student_id) {
        $where = NULL;
        if (is_array($student_id)) {
            foreach ($student_id as $id) {
                $where.= " OR student_master_id='" . $id . "'";
            }
        } else {
            $where.= " OR student_master_id='" . $student_id . "'";
        }
        
        $this->db->_protect_identifiers = false;
        $this->db->select('schools.*');
        $this->db->from('schools');
        $this->db->join('clans', 'schools.id=clans.school_id');
        $this->db->join('userdetails', 'clans.id=userdetails.clan_id');
        $this->db->where(substr($where, 4), null, false);
        $this->db->group_by("schools.id");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }
    
    function afterSave($options = array()) {
        foreach (explode(',', $options->dean_id) as $dean) {
            $notify = new Notification();
            $notify->notify_type = 'dean_assign_school';
            $notify->from_id = $options->user_id;
            $notify->to_id = $dean;
            $notify->object_id = $options->id;
            $notify->save();
        }
        
        return true;
    }
    
    function getAllSchoolIdFromAcademy($academy_id) {
        $this->db->select('id');
        $this->db->from('schools');
        $this->db->where('academy_id', $academy_id);
        $res = $this->db->get();
        return MultiArrayToSinlgeArray($res->result_array());
    }
    
    public static function getAssignDeanIds() {
        $CI =& get_instance();
        $res = $CI->db->query("SELECT users.id FROM users WHERE id IN((SELECT GROUP_CONCAT(dean_id) FROM schools GROUP BY schools.id)) AND status = 'A'");
        $array = array();
        if ($res->num_rows > 0) {
            $result = $res->result_array();
            $array = MultiArrayToSinlgeArray($result);
        }
        
        return array_unique($array);
    }
    
    function getRelatedDeansByRector($rector_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('dean_id, users.id, users.status');
        $this->db->from('schools');
        $this->db->join('academies', 'academies.id=schools.academy_id');
        $this->db->join('users', 'FIND_IN_SET(users.id, schools.dean_id)');
        $this->db->where("FIND_IN_SET(" . $rector_id . ", academies.rector_id) > 0");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $result = $res->result();
            $array = array();
            foreach ($result as $value) {
                $dean_ids = explode(',', $value->dean_id);
                foreach ($dean_ids as  $dean) {
                    if($dean == $value->id && $value->status == 'A'){
                        $array[] = $dean;
                    }
                }   
            }
            return array_unique($array);
        } else {
            return false;
        }
    }
    
    function getRelatedDeansByDean($dean_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('s1.dean_id, users.id, users.status');
        $this->db->from('schools s1');
        $this->db->join('academies', 'academies.id=s1.academy_id');
        $this->db->join('schools s2', 'academies.id=s2.academy_id');
        $this->db->join('users', 'FIND_IN_SET(users.id, s1.dean_id)');
        $this->db->where("FIND_IN_SET(" . $dean_id . ", s2.dean_id) > 0");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $result = $res->result();
            $array = array();
            foreach ($result as $value) {
                $dean_ids = explode(',', $value->dean_id);
                foreach ($dean_ids as  $dean) {
                    if($dean == $value->id && $value->status == 'A'){
                        $array[] = $dean;
                    }
                }   
            }
            return array_unique($array);
        } else {
            return false;
        }
    }
    
    function getRelatedDeansByTeacher($teacher_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('s1.dean_id, users.id, users.status');
        $this->db->from('schools');
        $this->db->join('schools s1', 's1.academy_id = schools.academy_id');
        $this->db->join('clans', 'schools.id=clans.school_id');
        $this->db->join('users', 'FIND_IN_SET(users.id, s1.dean_id)');
        $this->db->where("FIND_IN_SET(" . $teacher_id . ", clans.teacher_id) > 0");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $result = $res->result();
            $array = array();
            foreach ($result as $value) {
                $dean_ids = explode(',', $value->dean_id);
                foreach ($dean_ids as  $dean) {
                    if($dean == $value->id && $value->status == 'A'){
                        $array[] = $dean;
                    }
                }   
            }
            return array_unique($array);
        } else {
            return false;
        }
    }
    
    function getRelatedDeansByStudent($student_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('dean_id, users.id, users.status');
        $this->db->from('schools');
        $this->db->join('clans', 'schools.id=clans.school_id');
        $this->db->join('userdetails', 'clans.id=userdetails.clan_id');
        $this->db->join('users', 'FIND_IN_SET(users.id, schools.dean_id)');
        $this->db->where('student_master_id', $student_id);
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $result = $res->result();
            $array = array();
            foreach ($result as $value) {
                $dean_ids = explode(',', $value->dean_id);
                foreach ($dean_ids as  $dean) {
                    if($dean == $value->id && $value->status == 'A'){
                        $array[] = $dean;
                    }
                }   
            }
            return array_unique($array);
        } else {
            return false;
        }
    }
    
    function getDeansByAcademy($academy_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('dean_id, users.id, users.status');
        $this->db->from('schools');
        $this->db->join('academies', 'academies.id=schools.academy_id');
        $this->db->join('users', 'FIND_IN_SET(users.id, schools.dean_id)');
        $this->db->where('academies.id', $academy_id);
        $res = $this->db->get();
         if ($res->num_rows > 0) {
            $result = $res->result();
            $array = array();
            foreach ($result as $value) {
                $dean_ids = explode(',', $value->dean_id);
                foreach ($dean_ids as  $dean) {
                    if($dean == $value->id && $value->status == 'A'){
                        $array[] = $dean;
                    }
                }   
            }
            return array_unique($array);
        } else {
            return false;
        }
    }
    
    function getDeansBySchool($school_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('dean_id, users.id, users.status');
        $this->db->from('schools');
        $this->db->join('users', 'FIND_IN_SET(users.id, schools.dean_id)');
        $this->db->where('schools.id', $school_id);
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $result = $res->result();
            $array = array();
            foreach ($result as $value) {
                $dean_ids = explode(',', $value->dean_id);
                foreach ($dean_ids as  $dean) {
                    if($dean == $value->id && $value->status == 'A'){
                        $array[] = $dean;
                    }
                }   
            }
            return array_unique($array);
        } else {
            return false;
        }
    }
    
    function getDeansByClan($clan_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('dean_id, users.id, users.status');
        $this->db->from('schools');
        $this->db->join('clans', 'schools.id=clans.school_id');
        $this->db->join('users', 'FIND_IN_SET(users.id, schools.dean_id)');
        $this->db->where('clans.id', $clan_id);
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $result = $res->result();
            $array = array();
            foreach ($result as $value) {
                $dean_ids = explode(',', $value->dean_id);
                foreach ($dean_ids as  $dean) {
                    if($dean == $value->id && $value->status == 'A'){
                        $array[] = $dean;
                    }
                }   
            }
            return array_unique($array);
        } else {
            return false;
        }
    }
    
    function getSchoolforAjax($academy_id) {
        $session = get_instance()->session->userdata('user_session');
        $this->db->_protect_identifiers = false;
        $this->db->select('schools.*');
        $this->db->from('schools');
        
        if ($session->role == 3) {
            $this->db->join('academies', 'academies.id=schools.academy_id');
            $this->db->where('FIND_IN_SET(' . $session->id . ', academies.rector_id) > 0');
        } else if ($session->role == 4) {
            $this->db->where('FIND_IN_SET(' . $session->id . ', schools.dean_id) > 0');
        } else if ($session->role == 5) {
            $this->db->join('clans', 'schools.id=clans.school_id');
            $this->db->where('FIND_IN_SET(' . $session->id . ', clans.teacher_id) > 0');
        }
        $this->db->where('schools.academy_id', $academy_id);
        $this->db->group_by("schools.id");
        $res = $this->db->get()->result();
        return $res;
    }
}
?>
