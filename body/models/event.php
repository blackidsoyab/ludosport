<?php
class Event extends DataMapper
{
    
    public $has_one = array('eventcategory');
    public $has_many = array('eventinvitation', 'eventattendance');
    
    function __construct($id = NULL) {
        parent::__construct($id);
    }
    
    function getEvents($school_id = null) {
        $session = get_instance()->session->userdata('user_session');
        $where = NULL;
        if (!is_null($school_id)) {
            if (is_array($school_id)) {
                foreach ($school_id as $id) {
                    $where.= " OR FIND_IN_SET('" . $id . "', school_id) > 0";
                }
            } else {
                $where.= " OR FIND_IN_SET('" . $school_id . "', school_id) > 0";
            }
        }
        
        $this->db->_protect_identifiers = false;
        $this->db->select('events.*');
        $this->db->from('events');
        if ($session->role > 2) {
            if (!is_null($where)) {
                $this->db->where(substr($where, 4));
            }
            $this->db->or_where('event_for', 'ALL');
        }
        $this->db->order_by('id', 'desc');
        $res = $this->db->get();
        
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }
    
    function getRunningEventIDS() {
        $current_date = get_current_date_time()->get_date_for_db();
        $res = $this->db->query("SELECT id FROM events WHERE '" . $current_date . "' between date_from and date_to");
        if ($res->num_rows() > 0) {
            return array_unique(MultiArrayToSinlgeArray($res->result_array()));
        } else {
            return array(0);
        }
    }
    
    function getRunningEventAsManager($user_id) {
        $current_date = get_current_date_time()->get_date_for_db();
        $res = $this->db->query("SELECT id FROM events WHERE FIND_IN_SET(" . $user_id . ", manager) AND '" . $current_date . "' between date_from and date_to");
        if ($res->num_rows() > 0) {
            return array_unique(MultiArrayToSinlgeArray($res->result_array()));
        } else {
            return array(0);
        }
    }
}
?>
