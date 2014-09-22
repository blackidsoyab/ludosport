<?php

class Userbatcheshistory extends DataMapper {

	public $table = 'user_batches_histories';
	
    function __construct($id = NULL) {
        parent::__construct($id);
    }

    function getStudentBatchHistory($batch_type, $student_id){
    	$this->db->_protect_identifiers = false;
        $this->db->select('user_batches_histories.id, user_batches_histories.assign_date, user_batches_histories.user_id,batches.id, batches.en_name, batches.it_name, batches.image');
        $this->db->from('user_batches_histories');
        $this->db->join('batches', 'batches.id=user_batches_histories.batch_id');
        $this->db->where('batch_type', $batch_type);
        $this->db->where('student_id', $student_id);
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }

}

?>
