<?php

class Message extends DataMapper {

    var $session_data;

    function __construct($id = NULL) {
        parent::__construct($id);
        $this->session_data = &get_instance()->session->userdata('user_session');
    }

    function coutTrashCount() {
        $message = new Message();
        return $message->query("select * from messages WHERE status ='T' AND (from_id ='" . $this->session_data->id . "' OR to_id='" . $this->session_data->id . "')")->result_count();
    }

    function getMessageForReading($id) {
        global $arr;
        $sql = $this->db->query("select messages.id, reply_of, from_id, to_id, subject, message, messages.status, CONCAT(firstname,' ',lastname) as sender, messages.timestamp, avtar from messages, users WHERE users.id=messages.from_id AND messages.id ='" . $id . "' AND (from_id ='" . $this->session_data->id . "' OR to_id='" . $this->session_data->id . "')");
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
        $sql = $this->db->query("select messages.id, reply_of, from_id, to_id, subject, message, messages.status, CONCAT(firstname,' ',lastname) as sender, messages.timestamp, avtar from messages, users WHERE users.id=messages.from_id AND messages.id ='" . $id . "' AND to_id='" . $this->session_data->id . "'");
        if ($sql->num_rows() > 0) {
            $result = $sql->result();
            return $result[0];
        } else {
            return FALSE;
        }
    }

}

?>
