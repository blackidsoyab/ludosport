<?php
class Batchrequest extends DataMapper
{
    
    function __construct($id = NULL) {
        parent::__construct($id);
    }
    
    function getBatchRequest($id, $type = 'change_status') {
        $session = get_instance()->session->userdata('user_session');
        $where = null;
        
        if ($type == 'change_status' && $session->role == 3) {
            $user_detail = new Userdetail();
            $final_ids = $user_detail->getRelatedStudentsByRector($session->id);
            $where = ' batchrequests.student_id IN (' . implode(',', $final_ids) . ') AND from_role IN (3,4)';
        }
        
        if ($type == 'change_status' && $session->role == 4) {
            $user_detail = new Userdetail();
            $final_ids = $user_detail->getRelatedStudentsByDean($session->id);
            $where = ' batchrequests.student_id IN (' . implode(',', $final_ids) . ') AND from_role IN (4,5)';
        }
        
        if ($type == 'change_status' && $session->role == 5) {
            $user_detail = new Userdetail();
            $final_ids = $user_detail->getRelatedStudentsByTeacher($session->id);
            $where = ' batchrequests.student_id IN (' . implode(',', $final_ids) . ') AND from_role=5';
        }
        
        $this->db->_protect_identifiers = false;
        $this->db->select('CONCAT(student.firstname," ",student.lastname) AS student , batches.' . $session->language . '_name AS batch_name, CONCAT(request_user.firstname," ",request_user.lastname) AS request_user, clans.' . $session->language . '_class_name AS clan_name, batches.image AS batch_image, batches.type, student.avtar AS student_image, request_user.avtar AS request_user_image, student_id, from_id, batchrequests.*');
        $this->db->from('batchrequests');
        $this->db->join('batches', 'batchrequests.batch_id=batches.id');
        $this->db->join('users student', 'student.id=batchrequests.student_id');
        $this->db->join(' users request_user', 'batchrequests.from_id = request_user.id');
        $this->db->join('userdetails', 'student.id=userdetails.student_master_id');
        $this->db->join('clans', 'userdetails.clan_id=clans.id');
        
        if ($type == 'change_status' && $session->role > 2) {
            $this->db->where($where, null, false);
        }
        
        if ($type == 'edit' && $session->role > 2) {
            $this->db->where('from_id', $session->id, null, false);
        }
        
        if ($type == 'delete' && $session->role > 2) {
            $this->db->where('from_id', $session->id, null, false);
        }
        
        $this->db->where('batchrequests.id', $id, null, false);
        $res = $this->db->get();
        if ($res->num_rows() > 0) {
            $return = $res->result();
            return $return[0];
        } else {
            return false;
        }
    }
}
?>
