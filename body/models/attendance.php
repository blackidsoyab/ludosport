<?php
class Attendance extends DataMapper
{
    
    function __construct($id = NULL) {
        parent::__construct($id);
    }
    
    function getTotalStudentsForDate($date, $clan_id) {
        $this->db->select('count(*) as total');
        $this->db->from('attendances');
        $this->db->join('userdetails', 'userdetails.student_master_id=attendances.student_id');
        $this->db->where('clan_date', $date, null);
        $this->db->where('attendances.attendance', 1, null);
        $this->db->where('userdetails.clan_id', $clan_id, null);
        $query = $this->db->get()->result();
        return $query[0]->total;
    }
    
    function getTotalAttendance($student_id, $type = null) {
        $this->db->select('count(*) as total');
        $this->db->from('attendances');
        $this->db->where('student_id', $student_id, null);
        
        if (!is_null($type) && $type == 'present') {
            $this->db->where('attendances.attendance', 1, null);
        } else if (!is_null($type) && $type == 'absent') {
            $this->db->where('attendances.attendance', 0, null);
        }
        
        $query = $this->db->get()->result();
        return $query[0]->total;
    }
}
?>
