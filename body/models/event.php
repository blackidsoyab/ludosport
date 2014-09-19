<?php

class Event extends DataMapper {

    public $has_one = array('eventcategory');

    function __construct($id = NULL) {
        parent::__construct($id);
    }

   	function getEventsBySchool($school_id){
   		$where = NULL;
        if (is_array($school_id)) {
            foreach ($school_id as $id) {
                $where .= " OR FIND_IN_SET('" . $id . "', school_id) > 0";
            }
        } else {
            $where .= " OR FIND_IN_SET('" . $school_id . "', school_id) > 0";
        }
   		$this->db->_protect_identifiers = false;
        $this->db->select('events.*');
        $this->db->from('events');
        $this->db->where(substr($where, 4));
        $res = $this->db->get();

        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
   	}

}

?>
