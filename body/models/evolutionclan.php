<?php
class Evolutionclan extends DataMapper
{
    
    public $table = 'evolutionclans';
    public $has_one = array('school', 'evolutioncategory', 'evolutionlevel');
    public $has_many = array('evolutionstudent');
    
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }

    function getEvolutionClanforAjax($school_id) {
        $session = get_instance()->session->userdata('user_session');
        $this->db->_protect_identifiers = false;
        $this->db->select('evolutionclans.*');
        $this->db->from('evolutionclans');
        
        if ($session->role == 3) {
            $this->db->join('schools', 'schools.id=evolutionclans.school_id');
            $this->db->join('academies', 'academies.id=schools.academy_id');
            $this->db->where('FIND_IN_SET(' . $session->id . ', academies.rector_id) > 0');
        } else if ($session->role == 4) {
            $this->db->join('schools', 'schools.id=evolutionclans.school_id');
            $this->db->where('FIND_IN_SET(' . $session->id . ', schools.dean_id) > 0');
        } else if ($session->role == 5) {
            $this->db->where('FIND_IN_SET(' . $session->id . ', evolutionclans.teacher_id) > 0');
        }
        
        $this->db->where('evolutionclans.school_id', $school_id);
        $this->db->group_by("evolutionclans.id");
        $res = $this->db->get()->result();
        return $res;
    }
}
?>
