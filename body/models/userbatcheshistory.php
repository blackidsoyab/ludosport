<?php

class Userbatcheshistory extends DataMapper {

	public $table = 'user_batches_histories';
	
    function __construct($id = NULL) {
        parent::__construct($id);
    }

    function getStudentBatchHistory($student_id){
    	$this->db->_protect_identifiers = false;
        $this->db->select('batches.id, batches.type, batches.en_name, batches.it_name, batches.image, user_batches_histories.assign_date, batches.id');
        $this->db->from('batches');
        $this->db->join('user_batches_histories', 'batches.id=user_batches_histories.batch_id AND student_id='.$student_id, 'left');
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }

}

?>
