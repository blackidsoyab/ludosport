<?php

class Message extends DataMapper {

    var $session_data;

    function __construct($id = NULL) {
        parent::__construct($id);
        $this->session_data = &get_instance()->session->userdata('user_session');
    }

    function coutTrashCount() {
        $message = new Message();
        return $message->query("select * from messages WHERE (from_id = " . $this->session_data->id . " AND messages.from_status='T') OR (to_id=" . $this->session_data->id . "  AND messages.to_status='T')")->result_count();
    }

    function getMessageForReading($id) {
        global $arr;
        $sql = $this->db->query("select messages.id, type, reply_of, from_id, to_id, subject, message, messages.from_status,messages.to_status, CONCAT(users.firstname,' ',users.lastname) as from_person,CONCAT(u1.firstname,' ',u1.lastname) as to_person, messages.timestamp, users.avtar AS from_avtar, u1.avtar AS to_avtar from messages, users, users u1 WHERE users.id=messages.from_id AND u1.id=messages.to_id AND messages.id ='" . $id . "' AND (from_id ='" . $this->session_data->id . "' OR FIND_IN_SET(" . $this->session_data->id . ", to_id) >0)");
        if ($sql->num_rows() > 0) {
            $result = $sql->result();
            $arr[] = $result[0];
            if ($result[0]->reply_of != 0) {
                $this->getMessageForReading($result[0]->reply_of);
            }
        }
        return $arr;
    }

    function getMessageForReplying($id) {
        $sql = $this->db->query("select messages.id, type, reply_of, from_id, to_id, subject, message, messages.from_status,messages.to_status, CONCAT(users.firstname,' ',users.lastname) as from_person,CONCAT(u1.firstname,' ',u1.lastname) as to_person, messages.timestamp, users.avtar AS from_avtar, u1.avtar AS to_avtar from messages, users, users u1 WHERE users.id=messages.from_id AND u1.id=messages.to_id AND messages.id ='" . $id . "' AND (from_id ='" . $this->session_data->id . "' OR FIND_IN_SET(" . $this->session_data->id . ", to_id) >0)");
        if ($sql->num_rows() > 0) {
            $result = $sql->result();
            return $result[0];
        } else {
            return FALSE;
        }
    }

}

?>
