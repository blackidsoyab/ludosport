<?php

class Clan extends DataMapper {

    public $has_one = array('school');
    public $has_many = array('userdetail');

    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }

    public static function getAssignTeacherIds() {
        $obj = new Clan();
        $array = array();
        foreach ($obj->get() as $value) {
            $array[] = explode(',', $value->teacher_id);
        }

        return array_unique(MultiArrayToSinlgeArray($array));
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
        $this->db->join('clans', 'clans.id=userdetails.clan_id');
        $this->db->join('schools', 'schools.id=clans.school_id');
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
        $this->db->join('clans', 'clans.id=userdetails.clan_id');
        $this->db->join('schools', 'schools.id=clans.school_id');
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
        $this->db->join('clans', 'clans.id=userdetails.clan_id');
        $this->db->join('schools', 'schools.id=clans.school_id');
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
        $this->db->join('schools', 'schools.id=clans.school_id');
        $this->db->where("FIND_IN_SET('" . $teacher_id . "', clans.teacher_id) > 0");
        $res = $this->db->get()->result();
        return $res[0]->total;
    }

    function getClanOfRector($rector_id) {
        $where = NULL;
        if (is_array($rector_id)) {
            foreach ($rector_id as $id) {
                $where .= " OR FIND_IN_SET('" . $id . "', rector_id) > 0";
            }
        } else {
            $where .= " OR FIND_IN_SET('" . $rector_id . "', rector_id) > 0";
        }

        $this->db->_protect_identifiers = false;
        $this->db->select('clans.*');
        $this->db->from('clans');
        $this->db->join('schools', 'schools.id=clans.school_id');
        $this->db->join('academies', 'academies.id=schools.academy_id');
        $this->db->where(substr($where, 4));
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
                $where .= " OR FIND_IN_SET('" . $id . "', dean_id) > 0";
            }
        } else {
            $where .= " OR FIND_IN_SET('" . $dean_id . "', dean_id) > 0";
        }

        $this->db->_protect_identifiers = false;
        $this->db->select('clans.*');
        $this->db->from('clans');
        $this->db->join('schools', 'schools.id=clans.school_id');
        $this->db->where(substr($where, 4));
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
                $where .= " OR FIND_IN_SET('" . $teacher_id . "', teacher_id) > 0";
            }
        } else {
            $where .= " OR FIND_IN_SET('" . $teacher_id . "', teacher_id) > 0";
        }

        $this->db->_protect_identifiers = false;
        $this->db->select('*');
        $this->db->from('clans');
        $this->db->where(substr($where, 4));
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
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

    function getAviableTrialClan($city_id, $under_sixteen, $class_limit = 3) {
        $this->db->_protect_identifiers = false;
        $this->db->select('clans.id');
        $this->db->from('clans');
        $this->db->where('city_id', $city_id, null);
        $this->db->join('levels', 'levels.id=clans.level_id');
        $this->db->where('is_basic', "'1'", null);
        $this->db->where('under_sixteen', "$under_sixteen");
        $this->db->limit($class_limit);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result_array();
        } else {
            $city = new City();
            $id = $city->getRandomCityId();
            return $this->getAviableTrialClan($id, $under_sixteen);
        }
    }

    function getAviableDateFromClan($clan_id, $total_dates = 5, $student_limit = 20) {
        $this->db->select('id, lesson_day');
        $this->db->from('clans');
        $this->db->where_in('id', $clan_id, null);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            $results = $query->result();
            $current_date = get_current_date_time()->get_date_for_db();
            $start_date = date('Y-m-d', strtotime("+1 day", strtotime($current_date)));
            $end_date = date('Y-m-d', strtotime("+1 month", strtotime($start_date)));
            $dates = array();
            foreach ($results as $result) {
                $days = explode(',', $result->lesson_day);
                $days_array = $this->config->item('custom_days');
                foreach ($days as $day) {
                    $day = $days_array[$day]['en'];
                    $temp_dates = getDateByDay($day, $start_date, $end_date);
                    foreach ($temp_dates as $value) {
                        if (count($dates) != $total_dates) {
                            if (!in_array($value, $dates)) {
                                $attendance = new Attendance();
                                $total_stud = $attendance->getTotalStudentsForDate($value, $result->id);
                                if ($total_stud < $student_limit) {
                                    $dates[] = $value;
                                }
                            }
                        } else {
                            break;
                        }
                    }
                    if (count($dates) == $total_dates) {
                        break;
                    }
                }
                if (count($dates) == $total_dates) {
                    break;
                }
            }
            sort($dates);
            return array_unique($dates);
        } else {
            return FALSE;
        }
    }

    function getRelatedTeachersByRector($rector_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('teacher_id');
        $this->db->from('clans');
        $this->db->join('schools', 'schools.id=clans.school_id');
        $this->db->join('academies', 'academies.id=schools.academy_id');
        $this->db->where("FIND_IN_SET(" . $rector_id . ", academies.rector_id) > 0");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $temp = $res->result();
            foreach ($temp as $value) {
                $array[] = explode(',', $value->teacher_id);
            }
            return array_unique(MultiArrayToSinlgeArray($array));
        } else {
            return false;
        }
    }

    function getRelatedTeachersByDean($dean_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('teacher_id');
        $this->db->from('clans');
        $this->db->join('schools', 'schools.id=clans.school_id');
        $this->db->where("FIND_IN_SET(" . $dean_id . ", dean_id) > 0");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $temp = $res->result();
            foreach ($temp as $value) {
                $array[] = explode(',', $value->teacher_id);
            }

            return array_unique(MultiArrayToSinlgeArray($array));
        } else {
            return false;
        }
    }

    function getRelatedTeachersByTeacher($teacher_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('c1.teacher_id');
        $this->db->from('clans c1');
        $this->db->join('schools', 'schools.id=c1.school_id');
        $this->db->join('clans c2', 'schools.id=c2.school_id');
        $this->db->where("FIND_IN_SET(" . $teacher_id . ", c2.teacher_id) > 0");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $temp = $res->result();
            foreach ($temp as $value) {
                $array[] = explode(',', $value->teacher_id);
            }

            return array_unique(MultiArrayToSinlgeArray($array));
        } else {
            return false;
        }
    }

    function getRelatedTeachersByStudent($student_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('teacher_id');
        $this->db->from('clans');
        $this->db->join('userdetails', 'clans.id=userdetails.clan_id');
        $this->db->where('student_master_id', $student_id);
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $temp = $res->result();
            foreach ($temp as $value) {
                $array[] = explode(',', $value->teacher_id);
            }

            return array_unique(MultiArrayToSinlgeArray($array));
        } else {
            return false;
        }
    }

}

?>
