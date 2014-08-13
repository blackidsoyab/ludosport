<?php

class School extends DataMapper {

    public $has_one = array('academy');
    public $has_many = array('clan');

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
        $res = $this->db->get()->result();
        return $res;
    }

    function getTotalSchoolOfDean($dean_id) {
        $this->db->select('count(*) as total');
        $this->db->from('schools');
        $this->db->where('FIND_IN_SET(' . $dean_id . ', schools.dean_id) > 0');
        $res = $this->db->get()->result();
        return $res[0]->total;
    }

    function getSchoolOfDean($dean_id) {
        $this->db->select('*');
        $this->db->from('schools');
        $this->db->where('FIND_IN_SET(' . $dean_id . ', schools.dean_id) > 0');
        $res = $this->db->get()->result();
        return $res;
    }

    function getTotalSchoolOfTeacher($teacher_id) {
        $this->db->select('count(schools.*) as total');
        $this->db->from('schools');
        $this->db->join('clans', 'schools.id=clans.school_id');
        $this->db->where('FIND_IN_SET(' . $teacher_id . ', clans.teacher_id) > 0');
        $res = $this->db->get()->result();
        return $res[0]->total;
    }

    function getSchoolOfTeacher($teacher_id) {
        $this->db->select('schools.*');
        $this->db->from('schools');
        $this->db->join('clans', 'schools.id=clans.school_id');
        $this->db->where('FIND_IN_SET(' . $teacher_id . ', clans.teacher_id) > 0');
        $res = $this->db->get()->result();
        return $res;
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
        return MultiArrayToSinlgeArray($res->result());
    }

    public static function getAssignDeanIds() {
        $obj = new School();
        $array = array();
        foreach ($obj->get() as $value) {
            $array[] = explode(',', $value->dean_id);
        }

        return array_unique(MultiArrayToSinlgeArray($array));
    }

    function getRelatedDeansByRector($rector_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('dean_id');
        $this->db->from('schools');
        $this->db->join('academies', 'academies.id=schools.academy_id');
        $this->db->where("FIND_IN_SET(" . $rector_id . ", academies.rector_id) > 0");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $temp = $res->result();
            foreach ($temp as $value) {
                $array[] = explode(',', $value->dean_id);
            }

            return array_unique(MultiArrayToSinlgeArray($array));
        } else {
            return false;
        }
    }

    function getRelatedDeansByDean($dean_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('s1.dean_id');
        $this->db->from('schools s1');
        $this->db->join('academies', 'academies.id=s1.academy_id');
        $this->db->join('schools s2', 'academies.id=s2.academy_id');
        $this->db->where("FIND_IN_SET(" . $dean_id . ", s2.dean_id) > 0");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $temp = $res->result();
            foreach ($temp as $value) {
                $array[] = explode(',', $value->dean_id);
            }

            return array_unique(MultiArrayToSinlgeArray($array));
        } else {
            return false;
        }
    }

    function getRelatedDeansByTeacher($teacher_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('dean_id');
        $this->db->from('schools');
        $this->db->join('academies', 'academies.id=schools.academy_id');
        $this->db->join('clans', 'schools.id=clans.school_id');
        $this->db->where("FIND_IN_SET(" . $teacher_id . ", teacher_id) > 0");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $temp = $res->result();
            foreach ($temp as $value) {
                $array[] = explode(',', $value->dean_id);
            }

            return array_unique(MultiArrayToSinlgeArray($array));
        } else {
            return false;
        }
    }

    function getRelatedDeansByStudent($student_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('dean_id');
        $this->db->from('schools');
        $this->db->join('clans', 'schools.id=clans.school_id');
        $this->db->join('userdetails', 'clans.id=userdetails.clan_id');
        $this->db->where('student_master_id', $student_id);
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $temp = $res->result();
            foreach ($temp as $value) {
                $array[] = explode(',', $value->dean_id);
            }

            return array_unique(MultiArrayToSinlgeArray($array));
        } else {
            return false;
        }
    }

}

?>
