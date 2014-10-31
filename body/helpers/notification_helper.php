<?php

function getNotifications($user_id) {
    $notification = new Notification();
    $notification->where(array('to_id' => $user_id, 'status' => 0));
    $notification->order_by('id', 'desc');
    $notification->limit(5);
    $str = NULL;
    foreach ($notification->get() as $notify) {
        $options['id'] = $notify->id;
        $options['notify_type'] = $notify->notify_type;
        $options['object_id'] = $notify->object_id;
        $options['from_id'] = $notify->from_id;
        $options['data'] = unserialize($notify->data);
        if ($notify->type == 'N') {
            $user_info = userNameAvtar($notify->from_id);
            $options['user_name'] = $user_info['name'];
            $message = getNotificationTemplate($options);
            $img = '<img src="' . $user_info['avtar'] . '" class="absolute-left-content img-circle" alt="Avatar" data-toggle="tooltip" data-placement="bottom" data-original-title="' . $options['user_name'] . '">';
        } else {
            $message = getNotificationTemplate($options);
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
    $options['id'] = $notify->id;
    $options['notify_type'] = $notify->notify_type;
    $options['object_id'] = $notify->object_id;
    $options['from_id'] = $notify->from_id;
    $options['data'] = unserialize($notify->data);
    if ($notify->type == 'N') {
        $user_info = userNameAvtar($notify->from_id);
        $options['user_name'] = $user_info['name'];
        $message = getNotificationTemplate($options);
        $img = '<img src="' . $user_info['avtar'] . '" class="absolute-left-content img-circle" alt="Avatar" data-toggle="tooltip" data-placement="bottom" data-original-title="' . $options['user_name'] . '">';
    } else {
        $message = getNotificationTemplate($options);
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
    $url = base_url() . 'notification/view/' . $options['id'];
    $session = & get_instance()->session->userdata('user_session');
    
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
        $url = base_url() . 'profile/view/' . $options['object_id'] . '/notification';
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

    if ($options['notify_type'] == 'event_invitation') {
        $url = base_url() . 'event/view/' . $options['data']['id'] . '/notification';
    }

    if ($options['notify_type'] == 'event_manager') {
        $url = base_url() . 'event/view/' . $options['object_id'] . '/notification';
    }

    if ($options['notify_type'] == 'teacher_absent') {
        $url = base_url() . 'dean/absence_approval/' . $options['object_id'] . '/notification';
    }

    if ($options['notify_type'] == 'challenge_made') {
        $url = base_url() . 'duels/single/' . $options['object_id'] . '/notification';
    }

    if ($options['notify_type'] == 'challenge_accepted') {
        $url = base_url() . 'duels/single/' . $options['object_id'] . '/notification';
    }

    if ($options['notify_type'] == 'challenge_rejected') {
        $url = base_url() . 'duels/single/' . $options['object_id'] . '/notification';
    }

    if ($options['notify_type'] == 'challenge_winner') {
        $url = base_url() . 'duels/single/' . $options['object_id'] . '/notification';
    }

    if ($options['notify_type'] == 'challenge_winner_confirmation') {
        $url = base_url() . 'duels/single/' . $options['object_id'] . '/notification';
    }

    if ($options['notify_type'] == 'contrast_opinions_challenge_winner') {
        $url = base_url() . 'duels/single/' . $options['object_id'] . '/notification';
    }

    if ($options['notify_type'] == 'batch_request') {
        $url = base_url() . 'batchrequest/changestatus/' . $options['object_id'] . '/notification';
    }

    if ($options['notify_type'] == 'new_announcement') {
        $url = base_url() . 'announcement/read/' . $options['object_id'] . '/notification';
    }

    if ($options['notify_type'] == 'evolution_clan_request') {
        $url = base_url() . 'evolutionclan/check_request/' . $options['object_id'] . '/notification';
    }

    if ($session->role != 6 && $options['notify_type'] == 'evolution_clan_request_approved') {
        $url = base_url() . 'evolutionclan/check_request/' . $options['object_id'] . '/notification';
    } else if ($session->role == 6 && $options['notify_type'] == 'evolution_clan_request_approved') {
        $url = base_url() . 'evolution/' . $options['object_id'] . '/notification';
    }

    if ($session->role != 6 && $options['notify_type'] == 'evolution_clan_request_unapproved') {
        $url = base_url() . 'evolutionclan/check_request/' . $options['object_id'] . '/notification';
    } else if ($session->role == 6 && $options['notify_type'] == 'evolution_clan_request_approved') {
        $url = base_url() . 'evolution/' . $options['object_id'] . '/notification';
    }

    if ($session->role != 6 && $options['notify_type'] == 'evolution_clan_result') {
        $url = base_url() . 'evolutionclan/check_request/' . $options['object_id'] . '/notification';
    } else if ($session->role == 6 && $options['notify_type'] == 'evolution_clan_request_approved') {
        $url = base_url() . 'evolution/' . $options['object_id'] . '/notification';
    }

    return $url;
}

function getNotificationTemplate($options, $user_name_link = false) {
    $templates = seNotificationTemplate($options);
    $session = & get_instance()->session->userdata('user_session');
    $template_edit = false;

    if ($options['notify_type'] == 'rector_assign_academy') {
        $template_edit = true;
        $user_name = userNameAvtar($options['from_id'], $user_name_link);
        $new_template = sprintf($templates[$options['notify_type']][$session->language], $user_name['name']);
    }

    if ($options['notify_type'] == 'dean_assign_school') {
        $template_edit = true;
        $user_name = userNameAvtar($options['from_id'], $user_name_link);
        $new_template = sprintf($templates[$options['notify_type']][$session->language], $user_name['name']);
    }

    if ($options['notify_type'] == 'teacher_assign_class') {
        $template_edit = true;
        $user_name = userNameAvtar($options['from_id'], $user_name_link);
        $new_template = sprintf($templates[$options['notify_type']][$session->language], $user_name['name']);
    }

    if ($options['notify_type'] == 'trial_lesson_approved' || $options['notify_type'] == 'trial_lesson_unapproved' || $options['notify_type'] == 'accept_as_student') {
        $template_edit = true;
        $user_request = userNameAvtar($options['data']['student_id']);
        $from = userNameAvtar($options['from_id'], $user_name_link);
        $new_template = sprintf($templates[$options['notify_type']][$session->language], $user_request['name'], $from['name']);
    }

    if ($options['notify_type'] == 'apply_trial_lesson') {
        $template_edit = true;
        $user_request = userNameAvtar($options['data']['student_id'], $user_name_link);
        $new_template = sprintf($templates[$options['notify_type']][$session->language], $user_request['name']);
    }

    if ($options['notify_type'] == 'student_absent') {
        $template_edit = true;
        $user_name = userNameAvtar($options['from_id'], $user_name_link);
        
        $userdetail = new Userdetail();
        $userdetail->where('student_master_id', $options['from_id'])->get();
        $clan = $userdetail->Clan->get();

        $new_template = sprintf($templates[$options['notify_type']][$session->language], $user_name['name'], $clan->{$session->language.'_class_name'}, date('d-m-Y', strtotime($options['data']['absence_date'])));
    }

    if ($options['notify_type'] == 'recovery_student') {
        $template_edit = true;
        $user_name = userNameAvtar($options['from_id'], $user_name_link);
        
        $userdetail = new Userdetail();
        $userdetail->where('student_master_id', $options['from_id'])->get();
        $stud_clan = $userdetail->Clan->get();

        $recover_clan  = new Clan();
        $recover_clan->where('id',$options['data']['clan_id'])->get();

        $new_template = sprintf($templates[$options['notify_type']][$session->language], $user_name['name'], $stud_clan->{$session->language.'_class_name'},$recover_clan->{$session->language.'_class_name'}, date('d-m-Y', strtotime($options['data']['date'])));
    }

    if ($options['notify_type'] == 'recovery_assign_by_teacher_student') {
        $template_edit = true;
        $user_name = userNameAvtar($options['from_id'], $user_name_link);

        $recover_clan  = new Clan();
        $recover_clan->where('id',$options['data']['clan_id'])->get();

        $new_template = sprintf($templates[$options['notify_type']][$session->language], $user_name['name'],$recover_clan->{$session->language.'_class_name'}, date('d-m-Y', strtotime($options['data']['date'])));
    }

    if ($options['notify_type'] == 'recovery_assign_by_teacher_teacher') {
        $template_edit = true;
        $user_name = userNameAvtar($options['from_id'], $user_name_link);
        
        $user = new User();
        $user->where('id', $options['data']['student_id'])->get();

        $recover_clan  = new Clan();
        $recover_clan->where('id',$options['data']['clan_id'])->get();

        $new_template = sprintf($templates[$options['notify_type']][$session->language], $user_name['name'], $user->firstname.' '.$user->lastname ,$recover_clan->{$session->language.'_class_name'}, date('d-m-Y', strtotime($options['data']['date'])));
    }

    if ($options['notify_type'] == 'event_invitation') {
        $template_edit = true;
        $event_field = $session->language .'_name';
        $new_template = sprintf($templates[$options['notify_type']][$session->language], $options['data'][$event_field], getFullLocationByCity( $options['data']['city_id']));
    }

    if ($options['notify_type'] == 'event_manager') {
        $template_edit = true;
        $event_field = $session->language .'_name';
        $new_template = sprintf($templates[$options['notify_type']][$session->language], $options['data'][$event_field], getFullLocationByCity( $options['data']['city_id']));
    }

    if ($options['notify_type'] == 'teacher_absent') {
        $template_edit = true;
        $user_name = userNameAvtar($options['from_id'], $user_name_link);
        
        $clan = new Clan();
        $clan->where('id', $options['data']['clan_id'])->get();
        
        $new_template = sprintf($templates[$options['notify_type']][$session->language], $user_name['name'], $clan->{$session->language . '_class_name'}, date('d-m-Y', strtotime($options['data']['date'])));
    }

    if ($options['notify_type'] == 'recovery_teacher') {
        $template_edit = true;
        $user_name = userNameAvtar($options['from_id'], $user_name_link);
        if($options['data']['recovery_teacher'] ==  $session->id){
            $recover_user_name['name'] = 'You';
        } else{
            $recover_user_name = userNameAvtar($options['data']['recovery_teacher'], $user_name_link);    
        }

        $teacher_user_name = userNameAvtar($options['data']['teacher_id']);  
        
        $clan = new Clan();
        $clan->where('id', $options['data']['clan_id'])->get();

        $new_template = sprintf($templates[$options['notify_type']][$session->language], $recover_user_name['name'], $clan->{$session->language.'_class_name'}, date('d-m-Y', strtotime($options['data']['clan_date'])), $teacher_user_name['name'], $user_name['name']);
    }

    if ($options['notify_type'] == 'holiday_approved' || $options['notify_type'] == 'holiday_upapproved') {
        $template_edit = true;
        $new_template = sprintf($templates[$options['notify_type']][$session->language], date('d-m-Y', strtotime($options['data']['clan_date'])));
    }

    if ($options['notify_type'] == 'change_clan_date') {
        $template_edit = true;

        $clan = new Clan();
        $clan->where('id', $options['data']['clan_id'])->get();

        $new_template = sprintf($templates[$options['notify_type']][$session->language],$clan->{$session->language.'_class_name'}, date('d-m-Y', strtotime($options['data']['clan_shift_from'])), date('d-m-Y', strtotime($options['data']['clan_date'])));
    }

    if ($options['notify_type'] == 'challenge_made') {
        $template_edit = true;
        $user_name = userNameAvtar($options['data']['from_id'], $user_name_link);
        $new_template = sprintf($templates[$options['notify_type']][$session->language],$user_name['name']);
    }

    if ($options['notify_type'] == 'challenge_accepted') {
        $template_edit = true;
        $user_name = userNameAvtar($options['data']['to_id'], $user_name_link);
        $new_template = sprintf($templates[$options['notify_type']][$session->language],$user_name['name']);
    }

    if ($options['notify_type'] == 'challenge_rejected') {
        $template_edit = true;
        if($options['data']['to_status'] == 'R'){
            $user_name = userNameAvtar($options['data']['to_id'], $user_name_link);
        }else{
            $user_name = userNameAvtar($options['data']['from_id'], $user_name_link);
        }
        $new_template = sprintf($templates[$options['notify_type']][$session->language],$user_name['name']);
    }

    if ($options['notify_type'] == 'challenge_winner') {
        $template_edit = true;
        if($options['data']['result'] == $session->id){
            $user_name['name'] = 'You';
        }else{
            $user_name = userNameAvtar($options['data']['result'], $user_name_link);
        }
        $new_template = sprintf($templates[$options['notify_type']][$session->language],$user_name['name']);
    }

    if ($options['notify_type'] == 'challenge_winner_confirmation') {
    }

    if ($options['notify_type'] == 'contrast_opinions_challenge_winner') {
    }

    if ($options['notify_type'] == 'batch_request') {
        $template_edit = true;
        $student = userNameEmail($options['data']['student_id']);
        $obj_batch = new Batch($options['data']['batch_id']);
        $batch = $obj_batch->{$session->language.'_name'};
        $new_template = sprintf($templates[$options['notify_type']][$session->language],$batch, $student['name']);
    }

    if ($options['notify_type'] == 'batch_request_approved' || $options['notify_type'] == 'batch_request_unapproved') {
        $template_edit = true;
        $student = userNameAvtar($options['data']['student_id'], $user_name_link);
        $obj_batch = new Batch($options['data']['batch_id']);
        $batch = $obj_batch->{$session->language.'_name'};
        $new_template = sprintf($templates[$options['notify_type']][$session->language],$batch, $student['name']);
    }

    if ($options['notify_type'] == 'new_announcement') {
        $template_edit = true;
        $new_template = sprintf($templates[$options['notify_type']][$session->language],$options['data']['subject']);
    }

    if($options['notify_type'] == 'evolution_clan_request'){
        $template_edit = true;
        $user_name = userNameAvtar($options['from_id'], $user_name_link);
        $clan = new Evolutionclan($options['data']['evolutionclan_id']);
        $new_template = sprintf($templates[$options['notify_type']][$session->language],$user_name['name'], $clan->{$session->language.'_class_name'});
    }

    if($options['notify_type'] == 'evolution_clan_request_approved'){
        $template_edit = true;
        $user_name = userNameAvtar($options['data']['student_id'], $user_name_link);
        $clan = new Evolutionclan($options['data']['evolutionclan_id']);
        $new_template = sprintf($templates[$options['notify_type']][$session->language],$user_name['name'], $clan->{$session->language.'_class_name'});
    }

    if($options['notify_type'] == 'evolution_clan_request_unapproved'){
        $template_edit = true;
        $user_name = userNameAvtar($options['data']['student_id'], $user_name_link);
        $clan = new Evolutionclan($options['data']['evolutionclan_id']);
        $new_template = sprintf($templates[$options['notify_type']][$session->language],$user_name['name'], $clan->{$session->language.'_class_name'});
    } 

    if($options['notify_type'] == 'evolution_clan_result'){
        $template_edit = true;
        $user_name = userNameAvtar($options['data']['student_id'], $user_name_link);
        $clan = new Evolutionclan($options['data']['evolutionclan_id']);
        if($options['data']['status'] == 'C'){
            $result = & get_instance()->lang->line('evolution_completed_student');
        }

        if($options['data']['status'] == 'F'){
            $result = & get_instance()->lang->line('evolution_fail_student');
        }

        $new_template = sprintf($templates[$options['notify_type']][$session->language], $result ,$user_name['name'], $clan->{$session->language.'_class_name'});
    }     

    if ($template_edit) {
        return $new_template;
    } else {
        return $templates[$options['notify_type']][$session->language];
    }
}

function seNotificationTemplate() {
    $template = array(
        'rector_assign_academy' =>
        array(
            'en' => '%s added you as rector in academy',
            'it' => '%s hai aggiunto come rettore in accademia'
        ),
        'dean_assign_school' =>
        array(
            'en' => '%s added you as dean in school',
            'it' => '%s hai aggiunto come dean in school'
        ),
        'teacher_assign_class' =>
        array(
            'en' => '%s added you as teacher in class',
            'it' => '%s hai aggiunto come teacher in clan'
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
        ),
        'recovery_assign_by_teacher_student' =>
        array(
            'en' => '%s reschedule your clan. The recovery Clan is %s on %s',
            'it' => '%s reschedule your clan. The recovery Clan is %s on %s',
        ),
        'recovery_assign_by_teacher_teacher' =>
        array(
            'en' => '%s reschedule student %s  clan. The recovery Clan is %s on %s',
            'it' => '%s reschedule student %s clan. The recovery Clan is %s on %s',
        ),
        'event_invitation' =>
        array(
            'en' => 'Event : %s at %s',
            'it' => 'Event : %s at %s',
        ),
        'event_manager' =>
        array(
            'en' => 'You are selected as manager of Event %s at %s',
            'it' => 'You are selected as manager of Event %s at %s',
        ),
        'teacher_absent' =>
        array(
            'en' => '%s will remain absent for %s on %s',
            'it' => '%s will remain absent for %s on %s',
        ),
        'recovery_teacher' =>
        array(
            'en' => '%s will take lesson of %s on %s inplace of <strong>%s</strong>. It is approved by <strong>%s</strong>',
            'it' => '%s avrà lezione di %s su %s inplace di <strong>%s</strong>. It is approved by <strong>%s</strong>',
        ),
        'holiday_approved' =>
        array(
            'en' => 'Your request for holiday on %s is approved',
            'it' => 'Your request for holiday on %s is approved',
        ),
        'holiday_upapproved' =>
        array(
            'en' => 'Your request for holiday on %s is unapproved',
            'it' => 'Your request for holiday on %s is unapproved',
        ),
        'change_clan_date' =>
        array(
            'en' => 'Your clan %s has been reschedule from %s to %s',
            'it' => 'Your clan %s has been reschedule from %s to %s',
        ),
        'challenge_made' =>
        array(
            'en' => '%s has challenged you.',
            'it' => '%s has challenged you.',
        ),
        'challenge_accepted' =>
        array(
            'en' => '%s has accepted the challenge.',
            'it' => '%s has accepted the challenge.',
        ),
        'challenge_rejected' =>
        array(
            'en' => '%s has rejected the challenge.',
            'it' => '%s has rejected the challenge.',
        ),
        'challenge_winner' =>
        array(
            'en' => '%s has won the challenge.',
            'it' => '%s has won the challenge.',
        ),
        'challenge_winner_confirmation' =>
        array(
            'en' => 'Please confirm the winner of the challenge.',
            'it' => 'Please confirm the winner of the challenge.',
        ),
        'contrast_opinions_challenge_winner' =>
        array(
            'en' => 'Disagree with the result of the challenge',
            'it' => 'Disagree with the result of the challenge',
        ),
        'batch_request' =>
        array(
            'en' => 'Request for a badge %s to %s.',
            'it' => 'Request for a badge %s to %s.',
        ),
        'batch_request_approved' =>
        array(
            'en' => 'Your request for a badge %s to %s is approved.',
            'it' => 'Your request for a badge %s to %s is approved.',
        ),
        'batch_request_unapproved' =>
        array(
            'en' => 'Your request for a badge %s to %s is unapproved.',
            'it' => 'Your request for a badge %s to %s is unapproved.',
        ),
        'new_announcement' =>
        array(
            'en' => 'Announcement : %s',
            'it' => 'Announcement : %s',
        ),
        'evolution_clan_request' =>
        array(
            'en' => '%s requested for the evolution clan %s',
            'it' => '%s requested for the evolution clan %s',
        ),
        'evolution_clan_request_approved' =>
        array(
            'en' => 'Evolution clan request approved of %s which has requested for the evolution clan %s',
            'it' => 'Evolution clan request approved of %s which has requested for the evolution clan %s',
        ),
        'evolution_clan_request_unapproved' =>
        array(
            'en' => 'Evolution clan request unapproved of %s which has requested for the evolution clan %s',
            'it' => 'Evolution clan request unapproved of %s which has requested for the evolution clan %s',
        ),
        'evolution_clan_result' =>
        array(
            'en' => 'Evolution clan result declared %s for %s of student %s',
            'en' => 'Evolution clan result declared %s for %s of student %s',
        )

    );

    return $template;
}

function getTimelineTemplate($options, $user_name_link = false) {
    $templates = setTimelineTemplate();
    $session = & get_instance()->session->userdata('user_session');
    $template_edit = false;

    if ($options['notify_type'] == 'trial_lesson_approved' || $options['notify_type'] == 'trial_lesson_unapproved' || $options['notify_type'] == 'accept_as_student') {
        $template_edit = true;
        $from = userNameAvtar($options['from_id'], $user_name_link);
        $new_template = sprintf($templates[$options['notify_type']][$session->language], $from['name']);
    }

    if ($options['notify_type'] == 'student_absent') {
        $template_edit = true;
        
        $userdetail = new Userdetail();
        $userdetail->where('student_master_id', $options['from_id'])->get();
        $clan = $userdetail->Clan->get();

        $new_template = sprintf($templates[$options['notify_type']][$session->language], $clan->{$session->language.'_class_name'}, date('d-m-Y', strtotime($options['data']['absence_date'])));
    }

    if ($options['notify_type'] == 'recovery_student') {
        $template_edit = true;
        if($options['from_id'] == $session->id){
            $user_name['name'] = 'You';
        }else{
            $user_name = userNameAvtar($options['from_id'], $user_name_link);
        }
        
        $userdetail = new Userdetail();
        $userdetail->where('student_master_id', $options['from_id'])->get();
        $stud_clan = $userdetail->Clan->get();

        $recover_clan  = new Clan();
        $recover_clan->where('id',$options['data']['clan_id'])->get();

        $new_template = sprintf($templates[$options['notify_type']][$session->language], $user_name['name'], $stud_clan->{$session->language.'_class_name'},$recover_clan->{$session->language.'_class_name'}, date('d-m-Y', strtotime($options['data']['date'])));
    }

    if ($options['notify_type'] == 'recovery_assign_by_teacher_student') {
        $template_edit = true;
        $user_name = userNameAvtar($options['from_id'], $user_name_link);

        $recover_clan  = new Clan();
        $recover_clan->where('id',$options['data']['clan_id'])->get();

        $new_template = sprintf($templates[$options['notify_type']][$session->language], $recover_clan->{$session->language.'_class_name'}, date('d-m-Y', strtotime($options['data']['date'])));
    }

    if ($options['notify_type'] == 'recovery_assign_by_teacher_teacher') {
        $template_edit = true;
        $user_name = userNameAvtar($options['from_id'], $user_name_link);
        
        $user = new User();
        $user->where('id', $options['data']['student_id'])->get();

        $recover_clan  = new Clan();
        $recover_clan->where('id',$options['data']['clan_id'])->get();

        $new_template = sprintf($templates[$options['notify_type']][$session->language], $user_name['name'], $user->firstname.' '.$user->lastname ,$recover_clan->{$session->language.'_class_name'}, date('d-m-Y', strtotime($options['data']['date'])));
    }

    if ($options['notify_type'] == 'event_invitation') {
        $template_edit = true;
        $event_field = $session->language .'_name';
        $new_template = sprintf($templates[$options['notify_type']][$session->language], $options['data'][$event_field], getFullLocationByCity($options['data']['city_id']));
    }

    if ($options['notify_type'] == 'event_manager') {
        $template_edit = true;
        $event_field = $session->language .'_name';
        $new_template = sprintf($templates[$options['notify_type']][$session->language], $options['data'][$event_field], getFullLocationByCity( $options['data']['city_id']));
    }

    if ($options['notify_type'] == 'teacher_absent') {
        $template_edit = true;      
        $clan = new Clan();
        $clan->where('id', $options['data']['clan_id'])->get();
        
        $new_template = sprintf($templates[$options['notify_type']][$session->language], $clan->{$session->language . '_class_name'}, date('d-m-Y', strtotime($options['data']['date'])));
    }

    if ($options['notify_type'] == 'recovery_teacher') {
        $template_edit = true;
        $user_name = userNameAvtar($options['from_id'], $user_name_link);
        if($options['data']['recovery_teacher'] ==  $session->id){
            $recover_user_name['name'] = 'You';
        } else{
            $recover_user_name = userNameAvtar($options['data']['recovery_teacher'], $user_name_link);    
        }

        $teacher_user_name = userNameAvtar($options['data']['teacher_id']);  
        
        $clan = new Clan();
        $clan->where('id', $options['data']['clan_id'])->get();

        $new_template = sprintf($templates[$options['notify_type']][$session->language], $recover_user_name['name'], $clan->{$session->language.'_class_name'}, date('d-m-Y', strtotime($options['data']['clan_date'])), $teacher_user_name['name'], $user_name['name']);
    }

    if ($options['notify_type'] == 'holiday_approved' || $options['notify_type'] == 'holiday_upapproved') {
        $template_edit = true;
        $new_template = sprintf($templates[$options['notify_type']][$session->language], date('d-m-Y', strtotime($options['data']['clan_date'])));
    }

    if ($options['notify_type'] == 'change_clan_date') {
        $template_edit = true;

        $clan = new Clan();
        $clan->where('id', $options['data']['clan_id'])->get();

        $new_template = sprintf($templates[$options['notify_type']][$session->language],$clan->{$session->language.'_class_name'}, date('d-m-Y', strtotime($options['data']['clan_shift_from'])), date('d-m-Y', strtotime($options['data']['clan_date'])));
    }
    
    if ($options['notify_type'] == 'challenge_made') {
        $template_edit = true;
        if($options['data']['from_id'] == $session->id){
            $user_name = userNameAvtar($options['data']['to_id'], $user_name_link);
        }else{
            $user_name['name'] = 'You';
            //$user_name = userNameAvtar($options['data']['result'], $user_name_link);
        }
        $new_template = sprintf($templates[$options['notify_type']][$session->language],$user_name['name']);
    }

    if ($options['notify_type'] == 'challenge_winner') {
        $template_edit = true;
        if($options['data']['result'] == $session->id){
            $user_name['name'] = 'You';
        }else{
            $user_name = userNameAvtar($options['data']['result'], $user_name_link);
        }
        $new_template = sprintf($templates[$options['notify_type']][$session->language],$user_name['name']);
    }

    if ($options['notify_type'] == 'batch_request') {
        $template_edit = true;
        $student = userNameEmail($options['data']['student_id']);
        $obj_batch = new Batch($options['data']['batch_id']);
        $batch = $obj_batch->{$session->language.'_name'};
        $new_template = sprintf($templates[$options['notify_type']][$session->language],$batch, $student['name']);
    }

    if ($options['notify_type'] == 'batch_request_approved' || $options['notify_type'] == 'batch_request_unapproved') {
        $template_edit = true;
        $student = userNameEmail($options['data']['student_id']);
        $obj_batch = new Batch($options['data']['batch_id']);
        $batch = $obj_batch->{$session->language.'_name'};
        $new_template = sprintf($templates[$options['notify_type']][$session->language],$batch, $student['name']);
    }

    if ($options['notify_type'] == 'new_announcement') {
        $template_edit = true;
        $new_template = sprintf($templates[$options['notify_type']][$session->language],$options['data']['subject'] .' '.$options['data']['announcement']);
    }

    if($options['notify_type'] == 'evolution_clan_request'){
        $template_edit = true;
        $user_name = userNameAvtar($options['from_id'], $user_name_link);
        $clan = new Evolutionclan($options['data']['evolutionclan_id']);
        $new_template = sprintf($templates[$options['notify_type']][$session->language],$user_name['name'], $clan->{$session->language.'_class_name'});
    }

    if($options['notify_type'] == 'evolution_clan_request_approved'){
        $template_edit = true;
        $user_name = userNameAvtar($options['data']['student_id'], $user_name_link);
        $clan = new Evolutionclan($options['data']['evolutionclan_id']);
        $new_template = sprintf($templates[$options['notify_type']][$session->language],$user_name['name'], $clan->{$session->language.'_class_name'});
    }

    if($options['notify_type'] == 'evolution_clan_request_unapproved'){
        $template_edit = true;
        $user_name = userNameAvtar($options['data']['student_id'], $user_name_link);
        $clan = new Evolutionclan($options['data']['evolutionclan_id']);
        $new_template = sprintf($templates[$options['notify_type']][$session->language],$user_name['name'], $clan->{$session->language.'_class_name'});
    }   

    if($options['notify_type'] == 'evolution_clan_result'){
        $template_edit = true;
        $user_name = userNameAvtar($options['data']['student_id'], $user_name_link);
        $clan = new Evolutionclan($options['data']['evolutionclan_id']);
        if($options['data']['status'] == 'C'){
            $result = & get_instance()->lang->line('evolution_completed_student');
        }

        if($options['data']['status'] == 'F'){
            $result = & get_instance()->lang->line('evolution_fail_student');
        }

        $new_template = sprintf($templates[$options['notify_type']][$session->language], $result ,$user_name['name'], $clan->{$session->language.'_class_name'});
    }     

    if ($template_edit) {
        return $new_template;
    } else {
        return $templates[$options['notify_type']][$session->language];
    }
}

function setTimelineTemplate() {
    $template = array(
        'rector_assign_academy' =>
        array(
            'en' => 'Added you as rector in academy',
            'it' => 'Aggiunto come rettore in accademia'
        ),
        'dean_assign_school' =>
        array(
            'en' => 'Added you as dean in school',
            'it' => 'Aggiunto come dean in school'
        ),
        'teacher_assign_class' =>
        array(
            'en' => 'Added you as teacher in class',
            'it' => 'Aggiunto come teacher in clan'
        ),
        'user_register' =>
        array(
            'en' => 'New User is register',
            'it' => 'New User is register'
        ),
        'apply_trial_lesson' =>
        array(
            'en' => 'Applied for trial lesson',
            'it' => 'Applied for trial lesson'
        ),
        'trial_lesson_approved' =>
        array(
            'en' => 'Requestd for trial lesson apporved by %s',
            'it' => 'Requestd for trial lesson apporved by %s',
        ),
        'trial_lesson_unapproved' =>
        array(
            'en' => 'Requestd for trial lesson unapporved by %s',
            'it' => 'Requestd for trial lesson unapporved by %s',
        ),
        'accept_as_student' =>
        array(
            'en' => 'Requestd for trial lesson Accept as student by %s',
            'it' => 'Requestd for trial lesson Accept as student by %s',
        ),
        'student_absent' =>
        array(
            'en' => 'Will remain absent for %s on %s',
            'it' => 'Will remain absent for %s on %s',
        ),
        'recovery_student' =>
        array(
            'en' => '%s student of %s will attend recovery Clan of %s on %s',
            'it' => '%s student of %s will attend recovery Clan of %s on %s',
        ),
        'recovery_assign_by_teacher_student' =>
        array(
            'en' => 'Reschedule your clan. The recovery Clan is %s on %s',
            'it' => 'Reschedule your clan. The recovery Clan is %s on %s',
        ),
        'recovery_assign_by_teacher_teacher' =>
        array(
            'en' => '%s reschedule student %s clan. The recovery Clan is %s on %s',
            'it' => '%s reschedule student %s clan. The recovery Clan is %s on %s',
        ),
        'event_invitation' =>
        array(
            'en' => 'Event : %s at %s',
            'it' => 'Event : %s at %s',
        ),
        'event_manager' =>
        array(
            'en' => 'You are selected as manager of Event %s at %s',
            'it' => 'You are selected as manager of Event %s at %s',
        ),
        'teacher_absent' =>
        array(
            'en' => 'Will remain absent for %s on %s',
            'it' => 'Will remain absent for %s on %s',
        ),
        'recovery_teacher' =>
        array(
            'en' => '<strong>%s</strong> will take lesson of %s on %s inplace of <strong>%s</strong>. It is approved by <strong>%s</strong>',
            'it' => '<strong>%s</strong> avrà lezione di %s su %s inplace di <strong>%s</strong>. It is approved by <strong>%s</strong>',
        ),
        'holiday_approved' =>
        array(
            'en' => 'Your request for holiday on %s is approved',
            'it' => 'Your request for holiday on %s is approved',
        ),
        'holiday_upapproved' =>
        array(
            'en' => 'Your request for holiday on %s is unapproved',
            'it' => 'Your request for holiday on %s is unapproved',
        ),
        'change_clan_date' =>
        array(
            'en' => 'Your clan <strong>%s</strong> has been reschedule from %s to %s',
            'it' => 'Your clan <strong>%s</strong> has been reschedule from %s to %s',
        ),
        'challenge_made' =>
        array(
            'en' => 'Has challenged %s.',
            'it' => 'Has challenged %s.',
        ),
        'challenge_accepted' =>
        array(
            'en' => 'Has accepted the challenge.',
            'it' => 'Has accepted the challenge.',
        ),
        'challenge_rejected' =>
        array(
            'en' => 'Has rejected the challenge.',
            'it' => 'Has rejected the challenge.',
        ),
        'challenge_winner' =>
        array(
            'en' => '<strong>%s</strong> won the challenge.',
            'it' => '<strong>%s</strong> won the challenge.',
        ),
        'challenge_winner_confirmation' =>
        array(
            'en' => 'Please confirm the winner of the challenge.',
            'it' => 'Please confirm the winner of the challenge.',
        ),
        'contrast_opinions_challenge_winner' =>
        array(
            'en' => 'Disagree with the result of the challenge',
            'it' => 'Disagree with the result of the challenge',
        ),
        'batch_request' =>
        array(
            'en' => 'Request for a badge <strong>%s</strong> to %s.',
            'it' => 'Request for a badge <strong>%s</strong> to %s.',
        ),
        'batch_request_approved' =>
        array(
            'en' => 'Your request for a badge <strong>%s</strong> to %s is approved.',
            'it' => 'Your request for a badge <strong>%s</strong> to %s is approved.',
        ),
        'batch_request_unapproved' =>
        array(
            'en' => 'Your request for a badge <strong>%s</strong> to %s is unapproved.',
            'it' => 'Your request for a badge <strong>%s</strong> to %s is unapproved.',
        ),
        'new_announcement' =>
        array(
            'en' => 'Announcement : %s',
            'it' => 'Announcement : %s',
        ),
        'evolution_clan_request' =>
        array(
            'en' => '%s requested for the evolution clan %s',
            'it' => '%s requested for the evolution clan %s',
        ),
        'evolution_clan_request_approved' =>
        array(
            'en' => 'Evolution clan request approved of %s whchi has requested for the evolution clan %s',
            'it' => 'Evolution clan request approved of %s whchi has requested for the evolution clan %s',
        ),
        'evolution_clan_request_unapproved' =>
        array(
            'en' => 'Evolution clan request unapproved of %s whchi has requested for the evolution clan %s',
            'it' => 'Evolution clan request unapproved of %s whchi has requested for the evolution clan %s',
        ),
        'evolution_clan_result' =>
        array(
            'en' => 'Evolution clan result declared %s for %s of student %s',
            'en' => 'Evolution clan result declared %s for %s of student %s',
        )
    );

    return $template;
}
?>