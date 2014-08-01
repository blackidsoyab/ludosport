<?php

class Clan extends DataMapper {

    public $has_one = array('school');

    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }

    function getTotalTeachers() {
        $this->db->select('teacher_id');
        $this->db->from('clans');
        $this->db->join('schools', 'schools.id=clans.school_id');
        $this->db->join('academies', 'academies.id=schools.academy_id');
        $res = $this->db->get()->result();
        $count = array();
        foreach ($res as $r) {
            $count = array_merge($count, explode(',', $r->teacher_id));
        }

        return count(array_unique($count));
    }

    function getTotalStudents() {
        $this->db->select('count(*) as total');
        $this->db->from('userdetails');
        $this->db->join('schools', 'schools.id=userdetails.school_id');
        $this->db->join('academies', 'academies.id=schools.academy_id');
        $res = $this->db->get()->result();
        return $res[0]->total;
    }

    function getTotalTeacherOfRector($rector_id) {
        $this->db->select('teacher_id');
        $this->db->from('clans');
        $this->db->join('schools', 'schools.id=clans.school_id');
        $this->db->join('academies', 'academies.id=schools.academy_id');
        $this->db->where("FIND_IN_SET('" . $rector_id . "', academies.rector_id) > 0");
        $res = $this->db->get()->result();
        $count = array();
        foreach ($res as $r) {
            $count = array_merge($count, explode(',', $r->teacher_id));
        }

        return count(array_unique($count));
    }

    function getTotalStudentsOfRector($rector_id) {
        $this->db->select('count(*) as total');
        $this->db->from('userdetails');
        $this->db->join('schools', 'schools.id=userdetails.school_id');
        $this->db->join('academies', 'academies.id=schools.academy_id');
        $this->db->where("FIND_IN_SET('" . $rector_id . "', academies.rector_id) > 0");
        $res = $this->db->get()->result();
        return $res[0]->total;
    }

    function getTotalTeacherOfDean($dean_id) {
        $this->db->select('teacher_id');
        $this->db->from('clans');
        $this->db->join('schools', 'schools.id=clans.school_id');
        $this->db->where("FIND_IN_SET('" . $dean_id . "', schools.dean_id) > 0");
        $res = $this->db->get()->result();
        $count = array();
        foreach ($res as $r) {
            $count = array_merge($count, explode(',', $r->teacher_id));
        }

        return count(array_unique($count));
    }

    function getTotalStudentsOfDean($dean_id) {
        $this->db->select('count(*) as total');
        $this->db->from('userdetails');
        $this->db->join('schools', 'schools.id=userdetails.school_id');
        $this->db->where("FIND_IN_SET('" . $dean_id . "', schools.dean_id) > 0");
        $res = $this->db->get()->result();
        return $res[0]->total;
    }

    function getTotalClassesOfTeacher($teacher_id) {
        $this->db->select('count(*) as total');
        $this->db->from('clans');
        $this->db->where("FIND_IN_SET('" . $teacher_id . "', clans.teacher_id) > 0");
        $res = $this->db->get()->result();
        return $res[0]->total;
    }

    function getTotalStudentsOfTeacher($teacher_id) {
        $this->db->select('count(*) as total');
        $this->db->from('userdetails');
        $this->db->join('clans', 'clans.id=userdetails.clan_id');
        $this->db->where("FIND_IN_SET('" . $teacher_id . "', clans.teacher_id) > 0");
        $res = $this->db->get()->result();
        return $res[0]->total;
    }

    function afterSave($options = array()) {
        $notify = new Notification();
        $notify->notify_type = 'teacher_assign_class';
        $notify->from_id = $options->user_id;
        $notify->to_id = $options->teacher_id;
        $notify->object_id = $options->id;
        $notify->save();
        return true;
    }

    public static function getAssignTeacherIds() {
        $obj = new Clan();
        $array = array();
        foreach ($obj->get() as $value) {
            $array[] = explode(',', $value->teacher_id);
        }

        return array_unique(MultiArrayToSinlgeArray($array));
    }

    function getAviableTrialClan($city_id, $under_sixteen, $student_limit = 20, $class_limit = 3) {

        $this->db->_protect_identifiers = false;
        $this->db->select('clans.id');
        $this->db->from('clans');
        $this->db->where('city_id', $city_id, null);
        $this->db->join('levels', 'levels.id=clans.level_id');
        $this->db->where('is_basic', "'1'", null);
        $this->db->where('under_sixteen', "$under_sixteen");
        $this->db->where('(select count(*) from userdetails where clans.id=userdetails.clan_id) <', $student_limit, NULL);
        $this->db->limit($class_limit);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result_array();
        } else {
            $city = new City();
            $id = $city->getUniqueRandomCityId();
            if ($id !== FALSE) {
                return $this->getAviableTrialClan($id, $under_sixteen);
            } else {
                return FALSE;
            }
        }
    }

}

?>
