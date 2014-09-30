<?php

class Challenge extends DataMapper {

    function __construct($id = NULL) {
        parent::__construct($id);
    }

    static public function isRequestedBefore($from_id, $to_id) {
        $ci = & get_instance();
        $reset_date =  date('Y-m-d', strtotime($ci->config->item('reset_app_day_month') .'-'. get_current_date_time()->year +1));
        $ci->db->_protect_identifiers = false;
        $ci->db->select('COUNT(*) AS total');
        $ci->db->from('challenges');
        $ci->db->where('DATE(made_on) <=', $reset_date);
        $ci->db->where('((from_id=' . $from_id . ' AND to_id=' . $to_id . ') OR (to_id=' . $from_id . ' AND from_id=' . $to_id . '))');
        $res = $ci->db->get()->result();
        if ($res[0]->total == 0) {
            return false;
        } else {
            return true;
        }
    }

    function getChallengeDetails($user_id, $type, $type_2 = null, $limit = null) {
        $this->db->_protect_identifiers = false;
        $this->db->select('from_user.id AS from_id, CONCAT(from_user.firstname," ",from_user.lastname) AS from_name, from_user.avtar AS from_avtar, from_userdetail.total_score AS from_total_score, to_user.id AS to_id, CONCAT(to_user.firstname," ",to_user.lastname) as to_name, to_user.avtar AS to_avtar, to_userdetail.total_score AS to_total_score, challenges.*');

        $this->db->from('challenges');
        $this->db->join('users from_user', 'from_user.id= challenges.from_id');
        $this->db->join('userdetails from_userdetail', 'from_userdetail.student_master_id=from_user.id');
        $this->db->join('users to_user', 'to_user.id = challenges.to_id');
        $this->db->join('userdetails to_userdetail', 'to_userdetail.student_master_id=to_user.id');

        if ($type == 'made') {
            $this->db->where('from_id', $user_id);
            $this->db->where('from_status', 'A');
            if (!is_null($type_2)) {
                $this->db->where('to_status', $type_2);
            }
        } else if ($type == 'received') {
            $this->db->where('to_id', $user_id);
            if (!is_null($type_2)) {
                $this->db->where('to_status', $type_2);
            }
        } else if ($type == 'rejected') {
            $this->db->where('(from_id=' . $user_id . ' OR to_id=' . $user_id . ')');
            $this->db->where("(from_status='R' OR to_status='R')");
        } else if ($type == 'accepted') {
            $this->db->where('(from_id=' . $user_id . ' OR to_id=' . $user_id . ')');
            $this->db->where("(from_status='A' AND to_status='A')");
        } else if ($type == 'pending') {
            $this->db->where('(from_id=' . $user_id . ' OR to_id=' . $user_id . ')');
            $this->db->where("(from_status='P' OR to_status='P')");
        }

        if (!is_null($limit)) {
            $this->db->limit($limit);
        }

        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }

    function countChallenges($user_id, $type = null, $type_2 = null) {
        $this->db->_protect_identifiers = false;
        $this->db->select('count(*) as total');
        $this->db->from('challenges');
        if (!is_null($type) && $type == 'made') {
            $this->db->where('from_id', $user_id);
            $this->db->where('from_status', 'A');
        } else if (!is_null($type) && $type == 'received') {
            $this->db->where('to_id', $user_id);
            if (!is_null($type_2)) {
                $this->db->where('to_status', $type_2);
            }
        } else if (!is_null($type) && $type == 'rejected') {
            $this->db->where('(from_id=' . $user_id . ' OR to_id=' . $user_id . ')');
            $this->db->where("(from_status='R' OR to_status='R')");
        } else if (!is_null($type) && $type == 'accepted') {
            $this->db->where('(from_id=' . $user_id . ' OR to_id=' . $user_id . ')');
            $this->db->where("(from_status='A' AND to_status='A')");
        } else if (!is_null($type) && $type == 'pending') {
            $this->db->where('(from_id=' . $user_id . ' OR to_id=' . $user_id . ')');
            $this->db->where("(from_status='P' OR to_status='P')");
        }

        $res = $this->db->get()->result();
        return $res[0]->total;
    }

    function getSingleChallengeDetails($challenge_id) {
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

    function studentVictories($user_id, $limit = null) {
        $this->db->_protect_identifiers = false;
        $this->db->select('from_user.id AS from_id, CONCAT(from_user.firstname," ",from_user.lastname) AS from_name, from_user.avtar AS from_avtar, from_userdetail.total_score AS from_total_score, to_user.id AS to_id, CONCAT(to_user.firstname," ",to_user.lastname) as to_name, to_user.avtar AS to_avtar, to_userdetail.total_score AS to_total_score, challenges.*');
        $this->db->from('challenges');
        $this->db->join('users from_user', 'from_user.id= challenges.from_id');
        $this->db->join('userdetails from_userdetail', 'from_userdetail.student_master_id=from_user.id');
        $this->db->join('users to_user', 'to_user.id = challenges.to_id');
        $this->db->join('userdetails to_userdetail', 'to_userdetail.student_master_id=to_user.id');
        $this->db->where('result', $user_id);

        if (!is_null($limit)) {
            $this->db->limit($limit);
        }

        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $return = $res->result();
            return $return;
        } else {
            return false;
        }
    }

    function studentDefeats($user_id, $limit = null) {
        $this->db->_protect_identifiers = false;
        $this->db->select('from_user.id AS from_id, CONCAT(from_user.firstname," ",from_user.lastname) AS from_name, from_user.avtar AS from_avtar, from_userdetail.total_score AS from_total_score, to_user.id AS to_id, CONCAT(to_user.firstname," ",to_user.lastname) as to_name, to_user.avtar AS to_avtar, to_userdetail.total_score AS to_total_score, challenges.*');
        $this->db->from('challenges');
        $this->db->join('users from_user', 'from_user.id= challenges.from_id');
        $this->db->join('userdetails from_userdetail', 'from_userdetail.student_master_id=from_user.id');
        $this->db->join('users to_user', 'to_user.id = challenges.to_id');
        $this->db->join('userdetails to_userdetail', 'to_userdetail.student_master_id=to_user.id');
        $this->db->where('(from_id=' . $user_id . ' OR to_id=' . $user_id . ')');
        $this->db->where('result !=', $user_id);
        $this->db->where('result_status', 'MP');

        if (!is_null($limit)) {
            $this->db->limit($limit);
        }

        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $return = $res->result();
            return $return;
        } else {
            return false;
        }
    }

    function studentDuelResult($user_id, $type= null, $limit = null) {
        $this->db->_protect_identifiers = false;
        $this->db->select('from_user.id AS from_id, CONCAT(from_user.firstname," ",from_user.lastname) AS from_name, from_user.avtar AS from_avtar, from_userdetail.total_score AS from_total_score, to_user.id AS to_id, CONCAT(to_user.firstname," ",to_user.lastname) as to_name, to_user.avtar AS to_avtar, to_userdetail.total_score AS to_total_score, challenges.*');
        $this->db->from('challenges');
        $this->db->join('users from_user', 'from_user.id= challenges.from_id');
        $this->db->join('userdetails from_userdetail', 'from_userdetail.student_master_id=from_user.id');
        $this->db->join('users to_user', 'to_user.id = challenges.to_id');
        $this->db->join('userdetails to_userdetail', 'to_userdetail.student_master_id=to_user.id');

        if(!is_null($type) && $type == 'winner'){
            $this->db->where('(from_id=' . $user_id . ' OR to_id=' . $user_id . ')');
            $this->db->where('(from_status="A" AND to_status="A")');
            $this->db->where('result', $user_id);
            $this->db->where('result_status', 'MP');
        } else if(!is_null($type) && $type == 'defeat'){
            $this->db->where('(from_id=' . $user_id . ' OR to_id=' . $user_id . ')');
            $this->db->where('(from_status="A" AND to_status="A")');
            $this->db->where('result !=', $user_id);
            $this->db->where('result_status', 'MP');    
        } else if(!is_null($type) && $type == 'failure'){
            $this->db->where('from_status', 'A');
            $this->db->where('to_status', 'A');
            $this->db->where('result', 0);
            $this->db->where('result_status', 'SP');
            $this->db->where('(from_id=' . $user_id . ' OR to_id=' . $user_id . ')');
        }

        if (!is_null($limit)) {
            $this->db->limit($limit);
        }

        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }

    function countVictories($user_id, $year = null) {
        $this->db->_protect_identifiers = false;
        $this->db->select('count(*) as total');
        $this->db->from('challenges');
        if (!is_null($year)) {
            $this->db->where('YEAR(played_on)', $year);
        }
        $this->db->where('(from_status="A" AND to_status="A")');
        $this->db->where('result_status', 'MP');
        $this->db->where('result', $user_id);
        $this->db->where('(from_id=' . $user_id . ' OR to_id=' . $user_id . ')');
        $res = $this->db->get()->result();
        return $res[0]->total;
    }

    function countDefeats($user_id, $year = null) {
        $this->db->_protect_identifiers = false;
        $this->db->select('count(*) as total');
        $this->db->from('challenges');
        if (!is_null($year)) {
            $this->db->where('YEAR(played_on)', $year);
        }
        $this->db->where('(from_status="A" AND to_status="A")');
        $this->db->where('result_status', 'MP');
        $this->db->where('result !=', $user_id);
        $this->db->where('(from_id=' . $user_id . ' OR to_id=' . $user_id . ')');
        $res = $this->db->get()->result();
        return $res[0]->total;
    }

    function challengeLogs($user_id, $type = 'all', $limit = null) {
        $this->db->_protect_identifiers = false;
        $this->db->select('from_user.id AS from_id, CONCAT(from_user.firstname," ",from_user.lastname) AS from_name, from_user.avtar AS from_avtar, to_user.id AS to_id, CONCAT(to_user.firstname," ",to_user.lastname) as to_name, to_user.avtar AS to_avtar,winner.id AS winner_id, CONCAT(winner.firstname," ",winner.lastname) AS winner_name, winner.avtar AS winner_avtar, played_on, made_on');
        $this->db->from('challenges');
        if ($type == 'all') {
            $this->db->join('users from_user', 'from_user.id= challenges.from_id');
            $this->db->join('users to_user', 'to_user.id = challenges.to_id');
            $this->db->join('users winner', 'winner.id = challenges.result', 'left');
        } else if ($type == 'academy') {
            $this->db->join('users from_user', 'from_user.id= challenges.from_id');
            $this->db->join('users to_user', 'to_user.id = challenges.to_id');
            $this->db->join('users winner', 'winner.id = challenges.result', 'left');
            $this->db->join('userdetails', 'from_user.id=userdetails.student_master_id');
            $this->db->join('userdetails s1', 'to_user.id=s1.student_master_id');
            $this->db->join('clans', 'clans.id=userdetails.clan_id');
            $this->db->join('schools', 'schools.id=clans.school_id');
            $this->db->join('academies', 'academies.id=schools.academy_id');
            $this->db->join('schools sc2', 'academies.id=sc2.academy_id');
            $this->db->join('clans c2', 'sc2.id=c2.school_id');
            $this->db->join('userdetails s2', 'c2.id=s2.clan_id');
            $this->db->where('s2.student_master_id ', $user_id);
        } else if ($type == 'school') {
            $this->db->join('users from_user', 'from_user.id= challenges.from_id');
            $this->db->join('users to_user', 'to_user.id = challenges.to_id');
            $this->db->join('users winner', 'winner.id = challenges.result', 'left');
            $this->db->join('userdetails', 'from_user.id=userdetails.student_master_id');
            $this->db->join('userdetails s1', 'to_user.id=s1.student_master_id');
            $this->db->join('clans', 'clans.id=userdetails.clan_id');
            $this->db->join('schools', 'schools.id=clans.school_id');
            $this->db->join('clans c2', 'schools.id=c2.school_id');
            $this->db->join('userdetails s2', 'c2.id=s2.clan_id');
            $this->db->where('s2.student_master_id ', $user_id);
        } if ($type == 'clan') {
            $this->db->join('users from_user', 'from_user.id= challenges.from_id');
            $this->db->join('users to_user', 'to_user.id = challenges.to_id');
            $this->db->join('users winner', 'winner.id = challenges.result', 'left');
            $this->db->join('userdetails', 'from_user.id=userdetails.student_master_id');
            $this->db->join('userdetails s1', 'to_user.id=s1.student_master_id');
            $this->db->join('clans', 'clans.id=userdetails.clan_id');
            $this->db->join('userdetails s2', 'clans.id=s2.clan_id');
            $this->db->where('s2.student_master_id ', $user_id);
        }
        $this->db->order_by('challenges.timestamp ', 'DESC');
        if (!is_null($limit)) {
            $this->db->limit($limit);
        }

        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }

}

?>