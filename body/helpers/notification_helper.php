<?php

function getNotifications($user_id) {
    $notification = new Notification();
    $notification->where(array('to_id' => $user_id, 'status' => 0));
    $notification->order_by('id', 'desc');
    $notification->limit(5);
    $str = NULL;
    foreach ($notification->get() as $notify) {


        if ($notify->type == 'N') {
            $user_info = userNameAvtar($notify->from_id);
            $message = getMessageTemplate($notify->notify_type, $user_info['name']);
            $img = '<img src="' . $user_info['avtar'] . '" class="absolute-left-content img-circle" alt="Avatar">';
        } else {
            $message = getMessageTemplate($notify->notify_type);
            $img = '<i class="fa fa-info-circle icon-rounded icon-xs icon-primary notification-icon"></i>';
        }


        $str .= '<li><a href="' . makeURL($notify->notify_type, $notify->object_id) . '" data-toggle="tooltip" data-placement="bottom" data-original-title="' . $message . '">';

        $str .= $img;
        $str .= $message;
        $str .= '<span class="small-caps">' . time_elapsed_string($notify->timestamp) . '</span>';
        $str .= '</a></li>' . "\n";
    }
    return $str;
}

function getSingleNotification($notification_id) {
    $notify = new Notification();
    $notify->where(array('id' => $notification_id))->get();

    if ($notify->type == 'N') {
        $user_info = userNameAvtar($notify->from_id);
        $message = getMessageTemplate($notify->notify_type, $user_info['name']);
        $img = '<img src="' . $user_info['avtar'] . '" class="absolute-left-content img-circle" alt="Avatar">';
    } else {
        $message = getMessageTemplate($notify->notify_type);
        $img = '<i class="fa fa-info-circle icon-rounded icon-xs icon-primary notification-icon"></i>';
    }


    $str = '<li><a href="' . makeURL($notify->notify_type, $notify->object_id) . '" data-toggle="tooltip" data-placement="bottom" data-original-title="' . $message . '">';

    $str .= $img;
    $str .= $message;
    $str .= '<span class="small-caps">' . time_elapsed_string($notify->timestamp) . '</span>';
    $str .= '</a></li>' . "\n";

    return $str;
}

function countNotifications($user_id) {
    $notification = new Notification();
    $notification->where(array('to_id' => $user_id, 'status' => 0))->get();
    $count = $notification->result_count();
    if ($count <= 0) {
        return FALSE;
    } else if ($count > 0 && $count < 1000) {
        return $count;
    } else {
        return '999+';
    }
}

function makeURL($type, $id) {
    $url = '#';

    if ($type == 'rector_assign_academy') {
        $url = base_url() . 'academy/view/' . $id . '/notification';
    }

    if ($type == 'dean_assign_school') {
        $url = base_url() . 'school/view/' . $id . '/notification';
    }

    if ($type == 'teacher_assign_class') {
        $url = base_url() . 'clan/view/' . $id . '/notification';
    }

    if ($type == 'user_register') {
        $url = base_url() . 'user/view/' . $id . '/notification';
    }

    if ($type == 'apply_trial_lesson') {
        $url = base_url() . 'user/trail_lesson/' . $id . '/notification';
    }



    return $url;
}

function getMessageTemplate($type, $user_name = null) {
    $templates = setMessageTemplate($user_name);
    $session = & get_instance()->session->userdata('user_session');
    return $templates[$type][$session->language];
}

function setMessageTemplate($user_name = null) {
    $template = array(
        'rector_assign_academy' =>
        array(
            'en' => $user_name . ' added you as rector in academy',
            'it' => $user_name . ' hai aggiunto come rettore in accademia'
        ),
        'dean_assign_school' =>
        array(
            'en' => $user_name . ' added you as dean in school',
            'it' => $user_name . ' hai aggiunto come dean in school'
        ),
        'teacher_assign_class' =>
        array(
            'en' => $user_name . ' added you as teacher in class',
            'it' => $user_name . ' hai aggiunto come teacher in clan'
        ),
        'user_register' =>
        array(
            'en' => 'New User is register',
            'it' => 'New User is register'
        ),
        'apply_trial_lesson' =>
        array(
            'en' => 'User applied for trial lesson',
            'it' => 'User applied for trial lesson'
        )
    );

    return $template;
}

?>
