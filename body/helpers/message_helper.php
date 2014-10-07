<?php
function getMessages($user_id) {
    $obj_message = new Message();
    $getmessage = $obj_message->getMessages($user_id, 0, 5);
    
    $str = NULL;
    if ($getmessage) {
        foreach ($getmessage as $message) {
            if ($message->type == 'single') {
                $user_info = userNameAvtar($message->from_id);
                $type_label = '';
                $img = '<img src="' . $user_info['avtar'] . '" class="absolute-left-content img-circle" alt="Avatar">';
                $name = ucwords($user_info['name']);
            } else {
                $type_label = '<span class="label label-warning pull-right">Group</span>';;
                $group = explode('_', $message->group_id);
                $img = '<i class="group-avtar-icon-notification absolute-left-content img-circle fa fa-users icon-circle icon-primary"></i>';
                $name = ucwords($group[0]);
            }
            
            $str.= '<li>';
            $str.= '<a href="' . base_url() . 'message/read/' . $message->id . '">';
            $str.= $img;
            $str.= $message->subject . ' ' . $type_label;
            $str.= '<span class="small-caps">' . time_elapsed_string($message->timestamp) . '</span>';
            $str.= '</a></li>' . "\n";
        }
    }
    
    return $str;
}

function getSingleMessage($msg_id) {
    $obj = new Message();
    $obj->where('id', $msg_id)->get();
    
    if ($obj->type == 'single') {
        $type_label = '';
        $user_info = userNameAvtar($obj->from_id);
        $img = '<img src="' . $user_info['avtar'] . '" class="absolute-left-content img-circle" alt="Avatar">';
        $name = ucwords($user_info['name']);
    } else {
        $type_label = '<span class="label label-warning pull-right">Group</span>';;
        $group = explode('_', $obj->group_id);
        $img = '<i class="group-avtar-icon-notification absolute-left-content img-circle fa fa-users icon-circle icon-primary"></i>';
        $name = ucwords($group[0]);
    }
    $str = NULL;
    
    $str.= '<li>';
    $str.= '<a href="' . base_url() . 'message/read/' . $obj->id . '">';
    $str.= $img;
    $str.= $obj->subject . ' ' . $type_label;
    $str.= '<span class="small-caps">' . time_elapsed_string($obj->timestamp) . '</span>';
    $str.= '</a>';
    $str.= '</li>';
    
    return $str;
}

function countMessage($user_id) {
    $message = new Message();
    $count = $message->countInboxUnRead($user_id);
    if ($count <= 0) {
        return FALSE;
    } else if ($count > 0 && $count < 1000) {
        return $count;
    } else {
        return '999+';
    }
}
?>
