<?php

class Announcement extends DataMapper {

    var $session_data;

    function __construct($id = NULL) {
        parent::__construct($id);
        $this->session_data = &get_instance()->session->userdata('user_session');
    }

    function getAnnouncementForReading($id) {
        $sql = $this->db->query("SELECT announcements.id, type, group_id, from_id, to_id, subject, announcement, CONCAT(users.firstname,' ',users.lastname) AS from_person,CONCAT(u1.firstname,' ',u1.lastname) AS to_person, announcements.timestamp, users.avtar AS from_avtar, u1.avtar AS to_avtar FROM announcements, users, users u1 WHERE users.id=announcements.from_id AND u1.id=announcements.to_id AND announcements.id ='" . $id . "' AND (from_id ='" . $this->session_data->id . "' OR FIND_IN_SET(" . $this->session_data->id . ", to_id) >0)");
        if ($sql->num_rows() > 0) {
            $result = $sql->result();
            return $result[0];
        }
    }

    function getAnnouncement($user_id, $limit = null){
        if(is_null($limit)){
            $sql = $this->db->query("SELECT announcements.id, type, group_id, from_id, to_id, subject, announcement, CONCAT(users.firstname,' ',users.lastname) AS from_person, announcements.timestamp, users.avtar AS from_avtar FROM announcements, users WHERE users.id=announcements.from_id AND  FIND_IN_SET(" . $user_id . ", to_id) >0 ORDER By announcements.timestamp desc");    
        } else {
            $sql = $this->db->query("SELECT announcements.id, type, group_id, from_id, to_id, subject, announcement, CONCAT(users.firstname,' ',users.lastname) AS from_person, announcements.timestamp, users.avtar AS from_avtar FROM announcements, users WHERE users.id=announcements.from_id AND FIND_IN_SET(" . $user_id . ", to_id) >0 ORDER By announcements.timestamp desc LIMIT $limit");
        }
        
        if ($sql->num_rows() > 0) {
            return $sql->result();
        }
    }

}

?>
