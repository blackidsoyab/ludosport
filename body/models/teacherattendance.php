<?php
class Teacherattendance extends DataMapper
{
    
    public $table = 'teacher_attendances';
    
    function __construct($id = NULL) {
        parent::__construct($id);
    }

    function getTeacherAttendaceCount($teacher_id){
    	$this->db->select('count(*) as total');
        $this->db->from('teacher_attendances');
        $this->db->where('teacher_id', $teacher_id);
        $this->db->where('attendance', 1);
        $regular_res = $this->db->get()->result();
        $regular = $regular_res[0]->total;

        $this->db->select('count(*) as total');
        $this->db->from('teacher_attendances');
        $this->db->where('attendance', 0);
        $this->db->where('recovery_teacher', $teacher_id);
        $recovery_res = $this->db->get()->result();
        $recovery = $recovery_res[0]->total;

        return (int)$regular + (int)$recovery;
    }
}
?>
