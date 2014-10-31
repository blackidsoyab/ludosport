<?php
class Clandate extends DataMapper
{
    
    public $table = 'clandates';
    
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }
    
    function isClanShifted($clan_id, $date) {
        $this->db->_protect_identifiers = false;
        $query = $this->db->query('SELECT * FROM clandates WHERE type="S" AND clan_id=' . $clan_id . ' AND ( clan_date = \'' . $date . '\' OR clan_shift_from =\'' . $date . '\')');
        if ($query->num_rows() == 1) {
            $res = $query->result();
            return $res[0];
        } else {
            return false;
        }
    }

    function getClansDateByTypeDate($type, $date) {
        $session = get_instance()->session->userdata('user_session');
        $this->db->_protect_identifiers = false;
        $this->db->select('clans.id,' . $session->language . '_class_name AS clan,' . $session->language . '_school_name AS school,' . $session->language . '_academy_name AS academy, clans.clan_from, clans.clan_to, clandates.*');
        $this->db->from('clans');
        $this->db->join('clandates', 'clans.id=clandates.clan_id');
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

        $this->db->where('clandates.type', $type);
        $this->db->where('clandates.clan_date', $date);
        
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }
}
?>
