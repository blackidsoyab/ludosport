<?php

class Batch extends DataMapper {

    public $table = 'batches';
    
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }

    function getBatchTypeAssignmentByRole($role_id){
    	$this->db->_protect_identifiers = false;
    	$this->db->distinct();
        $this->db->select('type');
        $this->db->from($this->table);
        $this->db->where('FIND_IN_SET(' . $role_id . ', assign_role)');
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return array_column($res->result(), 'type');
        } else {
            return false;
        }
    }

    function getBatchAssignmentByRole($type, $role_id){
        $session = get_instance()->session->userdata('user_session');
    	$this->db->_protect_identifiers = false;
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('type', $type);
        if($role_id != 1){
            $this->db->where('FIND_IN_SET(' . $role_id . ', assign_role)');
        }
        $this->db->order_by($session->language.'_name', 'ASC');
        $res = $this->db->get();
        if ($res->num_rows > 0) {
        	return $res->result();
        } else {
            return false;
        }
    }

    function canAssignThisBatch($batch_id, $type, $role_id){
    	$this->db->_protect_identifiers = false;
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $batch_id);
        $this->db->where('type', $type);
        if($role_id != 1){
            $this->db->where('FIND_IN_SET(' . $role_id . ', assign_role)');
        }
        $res = $this->db->get();
        if ($res->num_rows > 0) {
        	return true;
        } else {
            return false;
        }
    }

}

?>
