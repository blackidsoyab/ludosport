<?php

class Notification extends DataMapper {

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

}

?>
