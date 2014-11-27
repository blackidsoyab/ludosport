<?php
class Eventinvitation extends DataMapper
{
    
    public $table = 'eventinvitations';
    public $has_one = array('event');
    
    function __construct($id = NULL) {
        parent::__construct($id);
    }
    
    function getStudentsForEvent($event_id, $date) {
        $this->db->_protect_identifiers = false;
        $this->db->distinct();
        $this->db->select('users.id, firstname ,lastname, userdetails.clan_id, eventattendances.event_date, attendance');
        $this->db->from('eventinvitations');
        $this->db->join('users', 'users.id = eventinvitations.to_id AND users.status="A" AND FIND_IN_SET(6, role_id)');
        $this->db->join('userdetails', 'users.id = userdetails.student_master_id');
        $this->db->join('eventattendances', 'users.id = eventattendances.student_id AND eventattendances.event_date="' . $date . '"', 'left');
        $this->db->where('eventinvitations.event_id', $event_id);
        $res = $this->db->get();

        if ($res->num_rows > 0) {
            return $res->result_array();
        } else {
            return false;
        }
    }
}

?>