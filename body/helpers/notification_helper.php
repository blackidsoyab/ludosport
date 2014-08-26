<?php

function getNotifications($user_id) {
    $notification = new Notification();
    $notification->where(array('to_id' => $user_id, 'status' => 0));
    $notification->order_by('id', 'desc');
    $notification->limit(5);
    $str = NULL;
    foreach ($notification->get() as $notify) {
        $options['notify_type'] = $notify->notify_type;
        $options['object_id'] = $notify->object_id;
        $options['from_id'] = $notify->from_id;
        $options['data'] = unserialize($notify->data);
        if ($notify->type == 'N') {
            $user_info = userNameAvtar($notify->from_id);
            $options['user_name'] = $user_info['name'];
            $message = getMessageTemplate($options);
            $img = '<img src="' . $user_info['avtar'] . '" class="absolute-left-content img-circle" alt="Avatar">';
        } else {
            $message = getMessageTemplate($options);
            $img = '<i class="fa fa-info-circle icon-rounded icon-xs icon-primary notification-icon"></i>';
        }


        $str .= '<li><a href="' . makeURL($options) . '" data-toggle="tooltip" data-placement="bottom" data-original-title="' . $message . '">';

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

    $options['notify_type'] = $notify->notify_type;
    $options['object_id'] = $notify->object_id;
    $options['from_id'] = $notify->from_id;
    $options['data'] = unserialize($notify->data);
    if ($notify->type == 'N') {
        $user_info = userNameAvtar($notify->from_id);
        $options['user_name'] = $user_info['name'];
        $message = getMessageTemplate($options);
        $img = '<img src="' . $user_info['avtar'] . '" class="absolute-left-content img-circle" alt="Avatar">';
    } else {
        $message = getMessageTemplate($options);
        $img = '<i class="fa fa-info-circle icon-rounded icon-xs icon-primary notification-icon"></i>';
    }


    $str = '<li><a href="' . makeURL($options) . '" data-toggle="tooltip" data-placement="bottom" data-original-title="' . $message . '">';

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

function makeURL($options) {
    $url = '#';

    if ($options['notify_type'] == 'rector_assign_academy') {
        $url = base_url() . 'academy/view/' . $options['object_id'] . '/notification';
    }

    if ($options['notify_type'] == 'dean_assign_school') {
        $url = base_url() . 'school/view/' . $options['object_id'] . '/notification';
    }

    if ($options['notify_type'] == 'teacher_assign_class') {
        $url = base_url() . 'clan/view/' . $options['object_id'] . '/notification';
    }

    if ($options['notify_type'] == 'user_register') {
        $url = base_url() . 'user/view/' . $options['object_id'] . '/notification';
    }

    if ($options['notify_type'] == 'apply_trial_lesson') {
        $url = base_url() . 'clan/change_status_trial_student/' . $options['data']['clan_id'] . '/' . $options['data']['student_id'] . '/notification';
    }

    if ($options['notify_type'] == 'trial_lesson_approved') {
        $url = base_url() . 'clan/change_status_trial_student/' . $options['data']['clan_id'] . '/' . $options['data']['student_id'] . '/notification';
    }

    if ($options['notify_type'] == 'trial_lesson_unapproved') {
        $url = base_url() . 'clan/change_status_trial_student/' . $options['data']['clan_id'] . '/' . $options['data']['student_id'] . '/notification';
    }

    if ($options['notify_type'] == 'accept_as_student') {
        $url = base_url() . 'clan/change_status_trial_student/' . $options['data']['clan_id'] . '/' . $options['data']['student_id'] . '/notification';
    }

    if ($options['notify_type'] == 'student_absent') {
        $url = '#';
    }

    if ($options['notify_type'] == 'recovery_student') {
        $url = '#';
    }



    return $url;
}

function getMessageTemplate($options) {
    $templates = setMessageTemplate($options);
    $session = & get_instance()->session->userdata('user_session');
    $template_edit = false;

    if (
            $options['notify_type'] == 'trial_lesson_approved' ||
            $options['notify_type'] == 'trial_lesson_unapproved' ||
            $options['notify_type'] == 'accept_as_student'
    ) {
        $template_edit = true;
        $user_request = userNameAvtar($options['data']['student_id']);
        $from = userNameAvtar($options['from_id']);
        $new_template = sprintf($templates[$options['notify_type']][$session->language], $user_request['name'], $from['name']);
    }

    if ($options['notify_type'] == 'apply_trial_lesson') {
        $template_edit = true;
        $user_request = userNameAvtar($options['data']['student_id']);
        $new_template = sprintf($templates[$options['notify_type']][$session->language], $user_request['name']);
    }

    if ($options['notify_type'] == 'student_absent') {
        $template_edit = true;
        $user_name = userNameAvtar($options['from_id']);
        
        $userdetail = new Userdetail();
        $userdetail->where('student_master_id', $options['from_id'])->get();
        $clan = $userdetail->Clan->get();

        $new_template = sprintf($templates[$options['notify_type']][$session->language], $user_name['name'], $clan->{$session->language.'_class_name'}, date('d-m-Y', strtotime($options['data']['absence_date'])));
    }


    if ($options['notify_type'] == 'recovery_student') {
        $template_edit = true;
        $user_name = userNameAvtar($options['from_id']);
        
        $userdetail = new Userdetail();
        $userdetail->where('student_master_id', $options['from_id'])->get();
        $stud_clan = $userdetail->Clan->get();

        $recover_clan  = new Clan();
        $recover_clan->where('id',$options['data']['clan_id'])->get();

        $new_template = sprintf($templates[$options['notify_type']][$session->language], $user_name['name'], $stud_clan->{$session->language.'_class_name'},$recover_clan->{$session->language.'_class_name'}, date('d-m-Y', strtotime($options['data']['date'])));
    }   

    if ($template_edit) {
        return $new_template;
    } else {
        return $templates[$options['notify_type']][$session->language];
    }
}

function setMessageTemplate($options) {
    $template = array(
        'rector_assign_academy' =>
        array(
            'en' => @$options['user_name'] . ' added you as rector in academy',
            'it' => @$options['user_name'] . ' hai aggiunto come rettore in accademia'
        ),
        'dean_assign_school' =>
        array(
            'en' => @$options['user_name'] . ' added you as dean in school',
            'it' => @$options['user_name'] . ' hai aggiunto come dean in school'
        ),
        'teacher_assign_class' =>
        array(
            'en' => @$options['user_name'] . ' added you as teacher in class',
            'it' => @$options['user_name'] . ' hai aggiunto come teacher in clan'
        ),
        'user_register' =>
        array(
            'en' => 'New User is register',
            'it' => 'New User is register'
        ),
        'apply_trial_lesson' =>
        array(
            'en' => '%s applied for trial lesson',
            'it' => '%s applied for trial lesson'
        ),
        'trial_lesson_approved' =>
        array(
            'en' => '%s requestd for trial lesson apporved by %s',
            'it' => '%s requestd for trial lesson apporved by %s',
        ),
        'trial_lesson_unapproved' =>
        array(
            'en' => '%s requestd for trial lesson unapporved by %s',
            'it' => '%s requestd for trial lesson unapporved by %s',
        ),
        'accept_as_student' =>
        array(
            'en' => '%s requestd for trial lesson Accept as student by %s',
            'it' => '%s requestd for trial lesson Accept as student by %s',
        ),
        'student_absent' =>
        array(
            'en' => '%s will remain absent for %s on %s',
            'it' => '%s will remain absent for %s on %s',
        ),
        'recovery_student' =>
        array(
            'en' => '%s student of %s will attend recovery Clan of %s on %s',
            'it' => '%s student of %s will attend recovery Clan of %s on %s',
        )
    );

    return $template;
}

?>
