<?php

function getNotifications($user_id) {
    $notification = new Notification();
    $notification->where(array('to_id' => $user_id, 'status' => 0));
    $str = NULL;
    foreach ($notification->get() as $notify) {
        $str .= '<li><i class="fa fa-info-circle icon-rounded icon-xs icon-primary notification-icon"></i><a href="' . makeURL($notify->notify_type, $notify->object_id) . '">';
        $str .= getMessageTemplate($notify->notify_type);
        $str .= '<span class="small-caps">' . time_elapsed_string($notify->timestamp) . '</span>';
        $str .= '</a></li>' . "\n";
    }
    return $str;
}

function countNotifications($user_id) {
    $notification = new Notification();
    $notification->where(array('to_id' => $user_id, 'status' => 0));
    $count = $notification->count();
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
        $url = base_url() . 'academy/view/' . $id;
    }

    if ($type == 'dean_assign_school') {
        $url = base_url() . 'school/view/' . $id;
    }

    if ($type == 'teacher_assign_class') {
        $url = base_url() . 'clan/view/' . $id;
    }

    return $url;
}

function getMessageTemplate($type) {
    $templates = setMessageTemplate();
    $session = & get_instance()->session->userdata('user_session');
    return $templates[$type][$session->language];
}

function setMessageTemplate() {
    $template = array(
        'rector_assign_academy' =>
        array('en' => 'You added as rector in academy', 'it' => 'Aggiunto come rettore in accademia'),
        'dean_assign_school' =>
        array('en' => 'You added as dean in school', 'it' => 'Aggiunto come dean in school'),
        'teacher_assign_class' =>
        array('en' => 'You added as teacher in class', 'it' => 'Aggiunto come teacher in clan'),
    );

    return $template;
}

?>
