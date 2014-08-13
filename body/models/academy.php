<?php

class Academy extends DataMapper {

    public $table = 'academies';
    public $has_many = array('school');

    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }

    function getTotalAcademyOfRector($dean_id) {
        $where = NULL;
        if (is_array($dean_id)) {
            foreach ($dean_id as $id) {
                $where .= " OR FIND_IN_SET('" . $id . "', rector_id) > 0";
            }
        } else {
            $where .= " OR FIND_IN_SET('" . $dean_id . "', rector_id) > 0";
        }

        $this->db->_protect_identifiers = false;
        $this->db->select('count(*) as total');
        $this->db->from('academies');
        $this->db->where(substr($where, 4));
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $resutl = $res->result();
            return $resutl[0]->total;
        } else {
            return false;
        }
    }

    function getAcademyOfRector($rector_id) {
        $where = NULL;
        if (is_array($rector_id)) {
            foreach ($rector_id as $id) {
                $where .= " OR FIND_IN_SET('" . $id . "', rector_id) > 0";
            }
        } else {
            $where .= " OR FIND_IN_SET('" . $rector_id . "', rector_id) > 0";
        }

        $this->db->_protect_identifiers = false;
        $this->db->select('*');
        $this->db->from('academies');
        $this->db->where(substr($where, 4));
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }

    function getAcademyOfDean($dean_id) {
        $where = NULL;
        if (is_array($dean_id)) {
            foreach ($dean_id as $id) {
                $where .= " OR FIND_IN_SET('" . $id . "', dean_id) > 0";
            }
        } else {
            $where .= " OR FIND_IN_SET('" . $dean_id . "', dean_id) > 0";
        }

        $this->db->_protect_identifiers = false;
        $this->db->select('*');
        $this->db->from('academies');
        $this->db->join('schools', 'academies.id=schools.academy_id');
        $this->db->where(substr($where, 4));
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }

    function getAcademyOfTeacher($teacher_id) {
        $where = NULL;
        if (is_array($teacher_id)) {
            foreach ($teacher_id as $id) {
                $where .= " OR FIND_IN_SET('" . $teacher_id . "', teacher_id) > 0";
            }
        } else {
            $where .= " OR FIND_IN_SET('" . $teacher_id . "', teacher_id) > 0";
        }

        $this->db->_protect_identifiers = false;
        $this->db->select('*');
        $this->db->from('academies');
        $this->db->join('schools', 'academies.id=schools.academy_id');
        $this->db->join('clans', 'schools.id=clans.school_id');
        $this->db->where(substr($where, 4));
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }

    function afterSave($options = array()) {
        foreach (explode(',', $options->rector_id) as $rector) {
            $notify = new Notification();
            $notify->notify_type = 'rector_assign_academy';
            $notify->from_id = $options->user_id;
            $notify->to_id = $rector;
            $notify->object_id = $options->id;
            $notify->save();
        }

        return true;
    }

    public static function getAssignRectorIds() {
        $obj = new Academy();
        $array = array();
        foreach ($obj->get() as $value) {
            $array[] = explode(',', $value->rector_id);
        }

        return array_unique(MultiArrayToSinlgeArray($array));
    }

    function getRelatedRectorsByRector($rector_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('rector_id');
        $this->db->from('academies');
        $this->db->where("FIND_IN_SET(" . $rector_id . ", rector_id) > 0");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $temp = $res->result();
            return $temp[0]->rector_id;
        } else {
            return false;
        }
    }

    function getRelatedRectorsByDean($dean_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('rector_id');
        $this->db->from('academies');
        $this->db->join('schools', 'academies.id=schools.academy_id');
        $this->db->where("FIND_IN_SET(" . $dean_id . ", dean_id) > 0");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $temp = $res->result();
            foreach ($temp as $value) {
                $array[] = explode(',', $value->rector_id);
            }

            return array_unique(MultiArrayToSinlgeArray($array));
        } else {
            return false;
        }
    }

    function getRelatedRectorsByTeacher($teacher_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('rector_id');
        $this->db->from('academies');
        $this->db->join('schools', 'academies.id=schools.academy_id');
        $this->db->join('clans', 'schools.id=clans.school_id');
        $this->db->where("FIND_IN_SET(" . $teacher_id . ", teacher_id) > 0");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $temp = $res->result();
            foreach ($temp as $value) {
                $array[] = explode(',', $value->rector_id);
            }

            return array_unique(MultiArrayToSinlgeArray($array));
        } else {
            return false;
        }
    }

    function getRelatedRectorsByStudent($student_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('rector_id');
        $this->db->from('academies');
        $this->db->join('schools', 'academies.id=schools.academy_id');
        $this->db->join('clans', 'schools.id=clans.school_id');
        $this->db->join('userdetails', 'clans.id=userdetails.clan_id');
        $this->db->where('student_master_id', $student_id);
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $temp = $res->result();
            foreach ($temp as $value) {
                $array[] = explode(',', $value->rector_id);
            }

            return array_unique(MultiArrayToSinlgeArray($array));
        } else {
            return false;
        }
    }

}

?>
