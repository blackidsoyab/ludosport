<?php

class Userbatcheshistory extends DataMapper {

	public $table = 'user_batches_histories';
	
    function __construct($id = NULL) {
        parent::__construct($id);
    }

    function saveStudentBatchHistory($student_id, $type, $batch_id){
        $session = get_instance()->session->userdata('user_session');
        $obj_batch_history = new Userbatcheshistory();
        $obj_batch_history->where(array('batch_type'=>$type, 'batch_id'=>$batch_id, 'student_id'=>$student_id))->get();
        $obj_batch_history->student_id = $student_id;
        $obj_batch_history->batch_type = $type;
        $obj_batch_history->batch_id = $batch_id;
        $obj_batch_history->assign_date = get_current_date_time()->get_date_for_db();
        $obj_batch_history->user_id = $session->id;
        $obj_batch_history->save();
        return true;
    }

    function getStudentBatchHistory($student_id){
    	$this->db->_protect_identifiers = false;
        $this->db->select('batches.id, batches.type, batches.en_name, batches.it_name, batches.image, user_batches_histories.assign_date, batches.id');
        $this->db->from('batches');
        $this->db->join('user_batches_histories', 'batches.id=user_batches_histories.batch_id AND student_id='.$student_id, 'left');
        $this->db->order_by('sequence', 'ASC');
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }

}

?>
