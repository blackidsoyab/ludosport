<?php

class Challenge extends DataMapper {

    function __construct($id = NULL) {
        parent::__construct($id);
    }

    function getChallengeDetails($user_id, $type, $limit = null){
    	$this->db->_protect_identifiers = false;
        $this->db->select('from_user.id AS from_id, CONCAT(from_user.firstname," ",from_user.lastname) AS from_name, from_user.avtar AS from_avtar, from_userdetail.total_score AS from_total_score, to_user.id AS to_id, CONCAT(to_user.firstname," ",to_user.lastname) as to_name, to_user.avtar AS to_avtar, to_userdetail.total_score AS to_total_score, challenges.*');

        $this->db->from('challenges');
        $this->db->join('users from_user', 'from_user.id= challenges.from_id');
        $this->db->join('userdetails from_userdetail', 'from_userdetail.student_master_id=from_user.id');
        $this->db->join('users to_user', 'to_user.id = challenges.to_id');
        $this->db->join('userdetails to_userdetail', 'to_userdetail.student_master_id=to_user.id');

        if($type == 'made'){
          $this->db->where('from_id', $user_id);
          $this->db->where('from_status', 'A');
        } else if($type == 'received'){
          $this->db->where('to_id', $user_id);
        } else if($type == 'rejected'){
          $this->db->where('to_id', $user_id);
          $this->db->where('to_status', 'R');
        } else if($type == 'accepted'){
          $this->db->where('to_id', $user_id);
          $this->db->where('to_status', 'A');
        } else if($type == 'pending'){
          $this->db->where('to_id', $user_id);
          $this->db->where('to_status', 'P');
        }

       	if(!is_null($limit)){
       		$this->db->limit($limit);
       	}

        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }

    function getSingleChallengeDetails($challenge_id){
      $this->db->_protect_identifiers = false;
      $this->db->select('from_user.id AS from_id, CONCAT(from_user.firstname," ",from_user.lastname) AS from_name, from_user.avtar AS from_avtar, from_userdetail.total_score AS from_total_score, to_user.id AS to_id, CONCAT(to_user.firstname," ",to_user.lastname) as to_name, to_user.avtar AS to_avtar, to_userdetail.total_score AS to_total_score, challenges.*');
      $this->db->from('challenges');
      $this->db->join('users from_user', 'from_user.id=challenges.from_id');
      $this->db->join('userdetails from_userdetail', 'from_userdetail.student_master_id=from_user.id');
      $this->db->join('users to_user', 'to_user.id=challenges.to_id');
      $this->db->join('userdetails to_userdetail', 'to_userdetail.student_master_id=to_user.id');
      $this->db->where('challenges.id', $challenge_id);
      $res = $this->db->get();
      if ($res->num_rows > 0) {
        return $res->result();
      } else {
        return false;
    }
}
}

?>
