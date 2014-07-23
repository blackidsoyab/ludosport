<?php

class Clan extends DataMapper {

    public $has_one = array('school');

    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }

    function getTotalTeacherOfRector($rector_id) {
        $this->db->select('teacher_id');
        $this->db->from('clans');
        $this->db->join('schools', 'schools.id=clans.school_id');
        $this->db->join('academies', 'academies.id=schools.academy_id');
        $this->db->where('academies.rector_id', $rector_id);
        $res = $this->db->get()->result();
        $count = 0;
        foreach ($res as $r) {
            $count = $count + count(explode(',', $r->teacher_id));
        }
        
        return $count;
    }

    function getTotalStudentsOfRector($rector_id) {
        $this->db->select('count(*) as total');
        $this->db->from('userdetails');
        $this->db->join('schools', 'schools.id=userdetails.school_id');
        $this->db->join('academies', 'academies.id=schools.academy_id');
        $this->db->where('academies.rector_id', $rector_id);
        $res = $this->db->get()->result();
        return $res[0]->total;
    }

}

?>
