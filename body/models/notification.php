<?php
class Notification extends DataMapper
{
    
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }
    
    public static function updateNotification($notify_type, $to_id, $object_id = null) {
        $obj = new Notification();
        if (is_null($object_id)) {
            $object_id = 0;
        }
        
        $obj->where(array('notify_type' => $notify_type, 'to_id' => $to_id, 'object_id' => $object_id, 'status' => 0))->update('status', 1);
        return true;
    }
    
    function notificationLogs($user_id, $year, $limit = null, $offset = null) {
        $this->db->_protect_identifiers = false;
        $this->db->select('from_user.id AS from_id, CONCAT(from_user.firstname," ",from_user.lastname) AS from_name, from_user.avtar AS from_avtar, to_user.id AS to_id, CONCAT(to_user.firstname," ",to_user.lastname) as to_name, to_user.avtar AS to_avtar, notifications.*');
        $this->db->from('notifications');
        $this->db->join('users from_user', 'from_user.id= notifications.from_id');
        $this->db->join('users to_user', 'to_user.id = notifications.to_id');
        $this->db->where('(from_id=' . $user_id . ' OR to_id=' . $user_id . ')');
        if($year != 0){
            $this->db->where('YEAR(notifications.timestamp)', $year);    
        }
        $this->db->group_by(array('notifications.notify_type', 'notifications.from_id', 'notifications.object_id'));
        $this->db->order_by('notifications.timestamp ', 'DESC');
        if (!is_null($limit) && !is_null($offset)) {
            $this->db->limit($limit, $offset);
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
