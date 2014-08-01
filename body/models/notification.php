<?php

class Notification extends DataMapper {

    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }

    public static function updateNotification($notify_type, $to_id, $object_id) {
        $obj = new Notification();
        $obj->where(array('notify_type' => $notify_type, 'to_id' => $to_id, 'object_id' => $object_id, 'status' => 0))->update('status', 1);
        return true;;
    }

}

?>
