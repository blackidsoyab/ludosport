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
        $this->db->select('users.id, firstname ,lastname, eventattendances.event_date, attendance');
        $this->db->from('users');
        $this->db->join('eventinvitations', 'users.id = eventinvitations.to_id', 'left');
        $this->db->join('eventattendances', 'users.id = eventattendances.student_id AND eventattendances.event_date="' . $date . '" AND eventattendances.event_id=' . $event_id, 'left');
        $this->db->where('FIND_IN_SET(6, role_id)');
        $this->db->where('users.status', 'A');
        $res = $this->db->get();

        if ($res->num_rows > 0) {
            return $res->result_array();
        } else {
            return false;
        }
    }
}
?>