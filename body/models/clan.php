<?php
class Clan extends DataMapper
{
    
    public $has_one = array('school');
    public $has_many = array('userdetail');
    
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }
    
    public static function getAssignTeacherIds() {
        $CI =& get_instance();
        $res = $CI->db->query("SELECT users.id FROM users WHERE id IN((SELECT GROUP_CONCAT(teacher_id) FROM clans GROUP BY clans.id)) AND status = 'A'");
        $array = array();
        if ($res->num_rows > 0) {
            $result = $res->result_array();
            $array = MultiArrayToSinlgeArray($result);
        }
        
        return array_unique($array);
    }

    function getClanSchoolAcademyID($clan_id){
        $this->db->_protect_identifiers = false;
        $this->db->select('clans.id AS clan, schools.id AS school, academies.id AS academy');
        $this->db->from('clans');
        $this->db->join('schools', 'schools.id=clans.school_id');
        $this->db->join('academies', 'academies.id=schools.academy_id');
        $this->db->where('clans.id', $clan_id);
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $return  = $res->result_array();
            return $return[0];
        } else {
            return false;
        }
    }
    
    function getTotalTeachers() {
        $this->db->_protect_identifiers = false;
        $this->db->select('teacher_id');
        $this->db->from('clans');
        $this->db->join('users', 'FIND_IN_SET(users.id, clans.teacher_id)');
        $this->db->join('schools', 'schools.id=clans.school_id');
        $this->db->join('academies', 'academies.id=schools.academy_id');
        $this->db->where('users.status', 'A');
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
        $this->db->join('users', 'users.id=userdetails.student_master_id');
        $this->db->join('clans', 'clans.id=userdetails.clan_id');
        $this->db->join('schools', 'schools.id=clans.school_id');
        $this->db->join('academies', 'academies.id=schools.academy_id');
        $this->db->where('userdetails.status', 'A');
        $this->db->where('users.status', 'A');
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
        $this->db->join('users', 'users.id=userdetails.student_master_id');
        $this->db->join('clans', 'clans.id=userdetails.clan_id');
        $this->db->join('schools', 'schools.id=clans.school_id');
        $this->db->join('academies', 'academies.id=schools.academy_id');
        $this->db->where("FIND_IN_SET('" . $rector_id . "', academies.rector_id) > 0");
        $this->db->where('userdetails.status', 'A');
        $this->db->where('users.status', 'A');
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
        $this->db->join('users', 'users.id=userdetails.student_master_id');
        $this->db->join('clans', 'clans.id=userdetails.clan_id');
        $this->db->join('schools', 'schools.id=clans.school_id');
        $this->db->where("FIND_IN_SET('" . $dean_id . "', schools.dean_id) > 0");
        $this->db->where('userdetails.status', 'A');
        $this->db->where('users.status', 'A');
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
        $this->db->join('users', 'users.id=userdetails.student_master_id');
        $this->db->join('clans', 'clans.id=userdetails.clan_id');
        $this->db->where("FIND_IN_SET('" . $teacher_id . "', clans.teacher_id) > 0");
        $this->db->where('userdetails.status', 'A');
        $this->db->where('users.status', 'A');
        $res = $this->db->get()->result();
        return $res[0]->total;
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
        $this->db->select('clans.*');
        $this->db->from('clans');
        $this->db->join('schools', 'schools.id=clans.school_id');
        $this->db->join('academies', 'academies.id=schools.academy_id');
        $this->db->where(substr($where, 4));
        $this->db->group_by("clans.id");
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
        $this->db->select('clans.*');
        $this->db->from('clans');
        $this->db->join('schools', 'schools.id=clans.school_id');
        $this->db->where(substr($where, 4));
        $this->db->group_by("clans.id");
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
        $this->db->select('clans.*');
        $this->db->from('clans');
        $this->db->where(substr($where, 4));
        $this->db->group_by("clans.id");
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
        $this->db->select('clans.*');
        $this->db->from('clans');
        $this->db->join('userdetails', 'clans.id=userdetails.clan_id');
        $this->db->where(substr($where, 4), null, false);
        $this->db->group_by("clans.id");
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
        static $get_aviable_trial_clan = 0;
        $get_aviable_trial_clan++;
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
            if ($get_aviable_trial_clan > 10) {
                return false;
            } else {
                return $this->getAviableTrialClan($id, $under_sixteen);
            }
        }
    }
    
    function getAviableClanForSchool($school_id, $under_sixteen) {
        $session = get_instance()->session->userdata('user_session');
        $this->db->_protect_identifiers = false;
        $this->db->select('clans.*');
        $this->db->from('clans');
        $this->db->where('school_id', $school_id, null);
        $this->db->join('levels', 'levels.id=clans.level_id');
        $this->db->where('is_basic', "'1'", null);
        $this->db->where('under_sixteen', "$under_sixteen");
        $this->db->order_by($session->language . '_class_name', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function getSameLevelClan($city_id, $level_id, $class_limit = 3) {
        static $get_Same_level_clan = 0;
        $get_Same_level_clan++;
        $this->db->_protect_identifiers = false;
        $this->db->select('clans.id');
        $this->db->from('clans');
        $this->db->where('city_id', $city_id, null);
        $this->db->where('level_id', $level_id, null);
        $this->db->limit($class_limit);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result_array();
        } else {
            $city = new City();
            $id = $city->getRandomCityId();
            if ($get_Same_level_clan > 10) {
                return false;
            } else {
                return $this->getSameLevelClan($id, $level_id);
            }
        }
    }
    
    function getAviableDateFromClan($clan_id, $total_dates = 5, $student_limit = null) {
        $this->db->select('id, lesson_day, clan_to');
        $this->db->from('clans');
        $this->db->where_in('id', $clan_id, null);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            $result = $query->result();
            $current_date = get_current_date_time()->get_date_for_db();
            $start_date = date('Y-m-d', strtotime("+1 day", strtotime($current_date)));
            
            //$end_date = date('Y-m-d', strtotime("+1 month", strtotime($start_date)));
            $end_date = $result[0]->clan_to;
            
            $dates = array();
            
            $days = explode(',', $result[0]->lesson_day);
            $days_array = $this->config->item('custom_days');
            foreach ($days as $day) {
                $day = $days_array[$day]['en'];
                $temp_dates[] = getDateByDay($day, $start_date, $end_date);
            }
            
            if (count($temp_dates) > 0) {
                $finals_dates = array_unique(MultiArrayToSinlgeArray($temp_dates));
                
                if (count($finals_dates) > 0) {
                    sort($finals_dates);
                    foreach ($finals_dates as $value) {
                        if (!in_array($value, $dates)) {
                            $attendance = new Attendance();
                            $recover = new Attendancerecover();
                            if (!is_null($student_limit)) {
                                $total_1 = $attendance->getTotalStudentsForDate($value, $result[0]->id);
                                $total_2 = $recover->getTotalStudentsForDate($value, $result[0]->id);
                                $total_stud = (int)$total_1 + (int)$total_2;
                                if ($total_stud < $student_limit) {
                                    $dates[] = $value;
                                }
                            } else {
                                $dates[] = $value;
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
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
    
    function getRelatedTeachersByRector($rector_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('teacher_id, users.id, users.status');
        $this->db->from('clans');
        $this->db->join('schools', 'schools.id=clans.school_id');
        $this->db->join('academies', 'academies.id=schools.academy_id');
        $this->db->join('users', 'FIND_IN_SET(users.id, clans.teacher_id)');
        $this->db->where("FIND_IN_SET(" . $rector_id . ", academies.rector_id) > 0");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $result = $res->result();
            $array = array();
            foreach ($result as $value) {
                $teacher_ids = explode(',', $value->teacher_id);
                foreach ($teacher_ids as  $teacher) {
                    if($teacher == $value->id && $value->status == 'A'){
                        $array[] = $teacher;
                    }
                }   
            }
            return array_unique($array);
        } else {
            return false;
        }
    }
    
    function getRelatedTeachersByDean($dean_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('teacher_id, users.id, users.status');
        $this->db->from('clans');
        $this->db->join('schools', 'schools.id=clans.school_id');
        $this->db->join('users', 'FIND_IN_SET(users.id, clans.teacher_id)');
        $this->db->where("FIND_IN_SET(" . $dean_id . ", dean_id) > 0");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $result = $res->result();
            $array = array();
            foreach ($result as $value) {
                $teacher_ids = explode(',', $value->teacher_id);
                foreach ($teacher_ids as  $teacher) {
                    if($teacher == $value->id && $value->status == 'A'){
                        $array[] = $teacher;
                    }
                }   
            }
            return array_unique($array);
        } else {
            return false;
        }
    }
    
    function getRelatedTeachersByTeacher($teacher_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('c1.teacher_id, users.id, users.status');
        $this->db->from('clans c1');
        $this->db->join('schools', 'schools.id=c1.school_id');
        $this->db->join('clans c2', 'schools.id=c2.school_id');
        $this->db->join('users', 'FIND_IN_SET(users.id, c1.teacher_id)');
        $this->db->where("FIND_IN_SET(" . $teacher_id . ", c2.teacher_id) > 0");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $result = $res->result();
            $array = array();
            foreach ($result as $value) {
                $teacher_ids = explode(',', $value->teacher_id);
                foreach ($teacher_ids as  $teacher) {
                    if($teacher == $value->id && $value->status == 'A'){
                        $array[] = $teacher;
                    }
                }   
            }
            return array_unique($array);
        } else {
            return false;
        }
    }
    
    function getRelatedTeachersByStudent($student_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('teacher_id, users.id, users.status');
        $this->db->from('clans');
        $this->db->join('userdetails', 'clans.id=userdetails.clan_id');
        $this->db->join('users', 'FIND_IN_SET(users.id, clans.teacher_id)');
        $this->db->where('student_master_id', $student_id);
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $result = $res->result();
            $array = array();
            foreach ($result as $value) {
                $teacher_ids = explode(',', $value->teacher_id);
                foreach ($teacher_ids as  $teacher) {
                    if($teacher == $value->id && $value->status == 'A'){
                        $array[] = $teacher;
                    }
                }   
            }
            return array_unique($array);
        } else {
            return false;
        }
    }
    
    function getClansByTeacherAndDay($teacher_id, $day = '1') {
        $session = get_instance()->session->userdata('user_session');
        $this->db->_protect_identifiers = false;
        $this->db->select('clans.id,' . $session->language . '_class_name AS clan,' . $session->language . '_school_name AS school,' . $session->language . '_academy_name AS academy, clans.clan_from, clans.clan_to');
        $this->db->from('clans');
        $this->db->join('schools', 'schools.id=clans.school_id');
        $this->db->join('academies', 'academies.id=schools.academy_id');
        $this->db->where('teacher_id', $teacher_id);
        $this->db->where("FIND_IN_SET('" . $day . "', lesson_day) > 0");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }
    
    function getTeachersByAcademy($academy_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('teacher_id, users.id, users.status');
        $this->db->from('clans');
        $this->db->join('schools', 'schools.id=clans.school_id');
        $this->db->join('academies', 'academies.id=schools.academy_id');
        $this->db->join('users', 'FIND_IN_SET(users.id, clans.teacher_id)');
        $this->db->where('academies.id', $academy_id);
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $result = $res->result();
            $array = array();
            foreach ($result as $value) {
                $teacher_ids = explode(',', $value->teacher_id);
                foreach ($teacher_ids as  $teacher) {
                    if($teacher == $value->id && $value->status == 'A'){
                        $array[] = $teacher;
                    }
                }   
            }
            return array_unique($array);
        } else {
            return false;
        }
    }
    
    function getTeachersBySchool($school_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('teacher_id, users.id, users.status');
        $this->db->from('clans');
        $this->db->join('schools', 'schools.id=clans.school_id');
        $this->db->join('academies', 'academies.id=schools.academy_id');
        $this->db->join('users', 'FIND_IN_SET(users.id, clans.teacher_id)');
        $this->db->where('schools.id', $school_id);
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $result = $res->result();
            $array = array();
            foreach ($result as $value) {
                $teacher_ids = explode(',', $value->teacher_id);
                foreach ($teacher_ids as  $teacher) {
                    if($teacher == $value->id && $value->status == 'A'){
                        $array[] = $teacher;
                    }
                }   
            }
            return array_unique($array);
        } else {
            return false;
        }
    }
    
    function getTeachersByClan($clan_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('teacher_id, users.id, users.status');
        $this->db->from('clans');
        $this->db->join('users', 'FIND_IN_SET(users.id, clans.teacher_id)');
        $this->db->where('clans.id', $clan_id);
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $result = $res->result();
            $array = array();
            foreach ($result as $value) {
                $teacher_ids = explode(',', $value->teacher_id);
                foreach ($teacher_ids as  $teacher) {
                    if($teacher == $value->id && $value->status == 'A'){
                        $array[] = $teacher;
                    }
                }   
            }
            return array_unique($array);
        } else {
            return false;
        }
    }

    function getClansByDay($day = '1') {
        $session = get_instance()->session->userdata('user_session');
        $this->db->_protect_identifiers = false;
        $this->db->select('clans.id,' . $session->language . '_class_name AS clan,' . $session->language . '_school_name AS school,' . $session->language . '_academy_name AS academy, clans.clan_from, clans.clan_to');
        $this->db->from('clans');
        if ($session->role == 1 || $session->role == 2) {
            $this->db->join('schools', 'schools.id=clans.school_id');
            $this->db->join('academies', 'academies.id=schools.academy_id');
        } else if ($session->role == 3) {
            $this->db->join('schools', 'schools.id=clans.school_id');
            $this->db->join('academies', 'academies.id=schools.academy_id');
            $this->db->where("FIND_IN_SET(" . $session->id . ", rector_id) > 0");
        } else if ($session->role == 4) {
            $this->db->join('schools', 'schools.id=clans.school_id');
            $this->db->join('academies', 'academies.id=schools.academy_id');
            $this->db->where("FIND_IN_SET(" . $session->id . ", dean_id) > 0");
        } else if ($session->role == 5) {
            $this->db->join('schools', 'schools.id=clans.school_id');
            $this->db->join('academies', 'academies.id=schools.academy_id');
            $this->db->where("FIND_IN_SET(" . $session->id . ", teacher_id) > 0");
        } else if ($session->role == 6) {
            $this->db->join('schools', 'schools.id=clans.school_id');
            $this->db->join('academies', 'academies.id=schools.academy_id');
            $this->db->join('userdetails', 'clans.id=userdetails.clan_id');
            $this->db->where('student_master_id', $session->id);
        }
        $this->db->where("FIND_IN_SET('" . $day . "', lesson_day) > 0");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }
    
    function getClansByDayForCronJob($day = '1') {
        $this->db->_protect_identifiers = false;
        $this->db->select('clans.id, clans.clan_from, clans.clan_to, teacher_id');
        $this->db->from('clans');
        $this->db->where("FIND_IN_SET('" . $day . "', lesson_day) > 0");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }
    
    function getClansByStudentAndDay($student_id, $day = '1') {
        $this->db->_protect_identifiers = false;
        $this->db->select('clans.*');
        $this->db->from('clans');
        $this->db->join('userdetails', 'clans.id=userdetails.clan_id');
        $this->db->where('student_master_id', $student_id);
        $this->db->where("FIND_IN_SET('" . $day . "', lesson_day) > 0");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }
    
    function getClansDetailsByIdAndDay($clan_id, $day = '1') {
        $this->db->_protect_identifiers = false;
        $this->db->select('clans.*');
        $this->db->from('clans');
        $this->db->where('id', $clan_id);
        $this->db->where("FIND_IN_SET('" . $day . "', lesson_day) > 0");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    function getClansDetailsByDay($clan_id, $day = '1') {
        $this->db->_protect_identifiers = false;
        $this->db->select('clans.*');
        $this->db->from('clans');
        $this->db->where('id', $clan_id);
        $this->db->where("FIND_IN_SET('" . $day . "', lesson_day) > 0");
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    function getCitiesofClans() {
        $this->db->_protect_identifiers = false;
        $this->db->select('city_id');
        $this->db->from('clans');
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $temp = $res->result();
            foreach ($temp as $value) {
                $array[] = explode(',', $value->city_id);
            }
            
            return array_unique(MultiArrayToSinlgeArray($array));
        } else {
            return false;
        }
    }
    
    function getClanforAjax($school_id) {
        $session = get_instance()->session->userdata('user_session');
        $this->db->_protect_identifiers = false;
        $this->db->select('clans.*');
        $this->db->from('clans');
        
        if ($session->role == 3) {
            $this->db->join('schools', 'schools.id=clans.school_id');
            $this->db->join('academies', 'academies.id=schools.academy_id');
            $this->db->where('FIND_IN_SET(' . $session->id . ', academies.rector_id) > 0');
        } else if ($session->role == 4) {
            $this->db->join('schools', 'schools.id=clans.school_id');
            $this->db->where('FIND_IN_SET(' . $session->id . ', schools.dean_id) > 0');
        } else if ($session->role == 5) {
            $this->db->where('FIND_IN_SET(' . $session->id . ', clans.teacher_id) > 0');
        }
        
        $this->db->where('clans.school_id', $school_id);
        $this->db->group_by("clans.id");
        $res = $this->db->get()->result();
        return $res;
    }
}
?>
