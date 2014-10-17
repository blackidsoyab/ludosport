<?php
class Message extends DataMapper
{
    
    var $session_data;
    public $has_many = array('messagestatus', 'messageattachment');
    
    function __construct($id = NULL) {
        parent::__construct($id);
        $this->session_data = & get_instance()->session->userdata('user_session');
    }
    
    function countInboxUnRead($user_id) {
        $this->db->_protect_identifiers = false;
        $query = $this->db->query('SELECT messages.subject, messages.id, messages.reply_of, messages.from_id, messages.to_id, messages.from_status, messages.to_status, messages.timestamp, messages.type, messages.group_id FROM messages WHERE messages.id IN (select MAX(m1.id) from messages m1 where CASE WHEN m1.type = "group" THEN (select messagestatus.status from messagestatus where m1.id=messagestatus.message_id AND messagestatus.to_id=' . $user_id . ') ELSE m1.to_status END = "U" AND FIND_IN_SET(' . $user_id . ', m1.to_id) >0 GROUP BY m1.initial_id) ORDER BY messages.id DESC');
        
        return $query->num_rows();
    }
    
    function coutTrashCount($user_id) {
        $message = new Message();
        return $message->query("select * from messages WHERE (from_id = " . $user_id . " AND messages.from_status='T') OR (to_id=" . $user_id . "  AND messages.to_status='T')")->result_count();
    }
    
    function getLastMessageID($user_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('id');
        $this->db->from('messages');
        $this->db->where("FIND_IN_SET($user_id, to_id)");
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $res = $query->result();
            return $res[0]->id;
        } else {
            return 0;
        }
    }
    
    function getMessages($user_id, $message_id, $limit = NULL) {
        if (!is_null($limit)) {
            $str = ' LIMIT ' . $limit;
        } else {
            $str = NULL;
        }
        
        $this->db->_protect_identifiers = false;
        $query = $this->db->query('SELECT messages.subject, messages.id, messages.reply_of, messages.from_id, messages.to_id, messages.from_status, messages.to_status, messages.timestamp, messages.type, messages.group_id FROM messages WHERE messages.id > ' . $message_id . ' AND messages.id IN (select MAX(m1.id) from messages m1 where CASE WHEN m1.type = "group" THEN (select messagestatus.status from messagestatus where m1.id=messagestatus.message_id AND messagestatus.to_id=' . $user_id . ') ELSE m1.to_status END = "U" AND FIND_IN_SET(' . $user_id . ', m1.to_id) >0 GROUP BY m1.initial_id) ORDER BY messages.id DESC' . $str);
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    
    function getMessageForReading($id) {
        global $global_arr;
        $sql = $this->db->query("select messages.id, type, initial_id, reply_of, group_id, from_id, to_id, subject, message, messages.from_status,messages.to_status, CONCAT(users.firstname,' ',users.lastname) as from_person,CONCAT(u1.firstname,' ',u1.lastname) as to_person, messages.timestamp, users.avtar AS from_avtar, u1.avtar AS to_avtar from messages, users, users u1 WHERE users.id=messages.from_id AND u1.id=messages.to_id AND messages.id ='" . $id . "' AND (from_id ='" . $this->session_data->id . "' OR FIND_IN_SET(" . $this->session_data->id . ", to_id) >0)");
        if ($sql->num_rows() > 0) {
            $result = $sql->result();
            $global_arr[] = $result[0];
            if ($result[0]->reply_of != 0) {
                $this->getMessageForReading($result[0]->reply_of);
            }
        }
        return $global_arr;
    }
    
    function getMessageChain($id) {
        global $global_chain;
        $sql = $this->db->query("select id, reply_of from messages WHERE id ='" . $id . "' AND (from_id ='" . $this->session_data->id . "' OR FIND_IN_SET(" . $this->session_data->id . ", to_id) >0)");
        if ($sql->num_rows() > 0) {
            $result = $sql->result();
            $global_chain[] = $result[0]->id;
            if ($result[0]->reply_of != 0) {
                $this->getMessageChain($result[0]->reply_of);
            }
        }
        sort($global_chain);
        return $global_chain;
    }
    
    function getMessageForReplying($id) {
        $sql = $this->db->query("select messages.id, type, initial_id, reply_of, group_id, from_id, to_id, subject, message, messages.from_status,messages.to_status, CONCAT(users.firstname,' ',users.lastname) as from_person,CONCAT(u1.firstname,' ',u1.lastname) as to_person, messages.timestamp, users.avtar AS from_avtar, u1.avtar AS to_avtar from messages, users, users u1 WHERE users.id=messages.from_id AND u1.id=messages.to_id AND messages.id ='" . $id . "' AND (from_id ='" . $this->session_data->id . "' OR FIND_IN_SET(" . $this->session_data->id . ", to_id) >0)");
        if ($sql->num_rows() > 0) {
            $result = $sql->result();
            return $result[0];
        } else {
            return FALSE;
        }
    }
    
    function leaveGroupMessage($message_id, $user_id) {
        $message = new Message();
        $message->where(array('type' => 'group', 'id' => $message_id))->get();
        $to_ids = explode(',', $message->to_id);
        if (($key = array_search($user_id, $to_ids)) !== false) {
            unset($to_ids[$key]);
        }
        $message->where(array('id' => $message_id))->update('to_id', implode(',', $to_ids));
        $message->where(array('id' => $message_id, 'from_id' => $user_id))->update('from_status', 'E');
        if ($message->reply_of != 0) {
            $this->leaveGroupMessage($message->reply_of, $user_id);
        } else {
            return true;
        }
    }
    
    function trashMessage($type, $message_id, $user_id) {
        $message = new Message();
        
        if ($type == 'inbox') {
            $message->where(array('type' => 'single',  'id' => $message_id))->get();
            if($message->to_id == $user_id){
                $message->where(array('type' => 'single', 'id' => $message_id))->update('to_status', 'T');
            }
        } else if ($type == 'sent') {
            $message->where(array('type' => 'single',  'id' => $message_id))->get();
            if($message->from_id == $user_id){
                $message->where(array('type' => 'single', 'id' => $message_id))->update('from_status', 'T');
            }
        } else if($type == 'trash'){
            $message->where(array('type' => 'single',  'id' => $message_id))->get();
            if ($message->from_id == $user_id && $message->to_status == 'E') {
                $message->where(array('type' => 'single', 'id' => $message_id))->delete();
            } else if ($message->to_id == $user_id && $message->from_status == 'E') {
                $message->where(array('type' => 'single', 'id' => $message_id))->delete();
            } else if ($message->to_id == $user_id) {
                $message->where(array('type' => 'single', 'id' => $message_id))->update('to_status', 'E');
            } else if ($message->from_id == $user_id) {
                $message->where(array('type' => 'single', 'id' => $message_id))->update('from_status', 'E');
            }
        }
        
        if ($message->reply_of != 0) {
            $this->trashMessage($type, $message->reply_of, $user_id);
        } else {
            return true;
        }
    }
}
?>
