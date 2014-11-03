<?php
class Eventattendance extends DataMapper
{
    
    public $table = 'eventattendances';
    public $has_one = array('event');
    
    function __construct($id = NULL) {
        parent::__construct($id);
    }

    function getStudentDetailsByEvent($event_id, $attendance = null){
    	$this->db->_protect_identifiers = false;
        $this->db->select('student_id, CONCAT(users.firstname," ", users.lastname) as student_name, avtar');
        $this->db->from('eventattendances');
        $this->db->join('users', 'users.id=eventattendances.student_id');
        if(!is_null($attendance)){
        	$this->db->where('eventattendances.attendance', $attendance);	
        }
        $this->db->where('eventattendances.event_id', $event_id);
        $this->db->order_by('CONCAT(users.firstname," ", users.lastname)', 'ASC');
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }

    function getTotalAttendanceByStudent($student_id, $attendance = null){
        $this->db->select('count(*) as total');
        $this->db->from('eventattendances');
        if(!is_null($attendance)){
            $this->db->where('attendance', $attendance);    
        }
        $this->db->where('student_id', $student_id);
        $res = $this->db->get()->result();
        return $res[0]->total;
    }
}
?>
