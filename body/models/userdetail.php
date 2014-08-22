<?php

class Userdetail extends DataMapper {

    public $table = 'userdetails';
    public $has_one = array(
        'clan' => array(),
        'user' => array(
            'join_other_as' => 'user',
            'join_self_as' => 'id'
        )
    );

    public static function getAssingStudentIds() {
        $obj = new Userdetail();
        $array = array();
        foreach ($obj->get() as $value) {
            $array[] = $value->student_master_id;
        }

        return array_unique($array);
    }

    public static function getAssignStudentIdsByCaln($clan_id) {
        $obj = new Userdetail();
        $obj->where('clan_id', $clan_id)->get();
        $array = array();
        foreach ($obj as $value) {
            $array[] = $value->student_master_id;
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
        $this->db->where("FIND_IN_SET(" . $rector_id . ", academies.rector_id) > 0");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $temp = $res->result();
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
        $this->db->where("FIND_IN_SET(" . $dean_id . ", dean_id) > 0");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $temp = $res->result();
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
        $this->db->where("FIND_IN_SET(" . $teacher_id . ", teacher_id) > 0");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $temp = $res->result();
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
        $this->db->where("FIND_IN_SET(" . $student_id . ", s2.student_master_id) > 0");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $temp = $res->result();
            foreach ($temp as $value) {
                $array[] = explode(',', $value->student_master_id);
            }

            return array_unique(MultiArrayToSinlgeArray($array));
        } else {
            return false;
        }
    }

}

?>
