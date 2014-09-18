<?php

if (!function_exists('setLanguage')) {

    function setLanguage() {
        $ci = & get_instance();
        $session = $ci->session->userdata('user_session');
        if (!empty($session)) {
            $lang = $session->language;
        } else {
            $lang = 'en';
        }
        $all_langs = $ci->config->item('custom_languages');
        $lang = $all_langs[$lang];
        $ci->config->set_item('language', $lang);
        $file = 'main';
        $ci->lang->load($file, $lang);
    }

}

if (!function_exists('getRoleName')) {

    function getRoleName($id) {
        $role = new Role();
        $role->where('id', $id)->get();
        $ci = & get_instance();
        $session = $ci->session->userdata('user_session');
        if(!empty($session)) {
            return $role->{$session->language . '_role_name'};
        } else {
            return $role->en_role_name;
        }
    }

}

if (!function_exists('userNameAvtar')) {

    function userNameAvtar($user_id, $link = false) {
        $user = new User();
        $user->where('id', $user_id)->limit(1)->get();
        if($link){
            $return['name'] = '<a href="'.base_url() .'profile/view/'. $user_id .'" class="user-extra-link">' . $user->firstname . ' ' . $user->lastname .'</a>';
        }else{
            $return['name'] = $user->firstname . ' ' . $user->lastname;
        }
        $return['avtar'] = IMG_URL . 'user_avtar/100X100/' . $user->avtar;
        unset($user);
        return $return;
    }

}

if (!function_exists('userNameEmail')) {

    function userNameEmail($user_id, $link = false) {
        $user = new User();
        $user->where('id', $user_id)->limit(1)->get();
        if($link){
            $return['name'] = '<a href="'.base_url() .'profile/view/'. $user_id .'" class="user-extra-link">' . $user->firstname . ' ' . $user->lastname .'</a>';
        }else{
            $return['name'] = $user->firstname . ' ' . $user->lastname;
        }
        $return['email'] = $user->email;
        $return['email_privacy'] = $user->email_privacy;
        unset($user);
        return $return;
    }

}


if (!function_exists('getLocationName')) {

    function getLocationName($id, $type) {
        $ci = & get_instance();
        $session = $ci->session->userdata('user_session');
        $obj = new $type();
        $obj->where('id', $id)->limit(1)->get();
        $field = $session->language . '_name';
        return $obj->$field;
    }

}

function getFullLocationByCity($city_id){
    $ci = & get_instance();
    $session = $ci->session->userdata('user_session');

    $city = new City();
    $city_name = $city->where('id', $city_id)->get();

    return $city->{$session->language . '_name'}. ', ' . $city->State->{$session->language . '_name'}. ', ' . $city->State->Country->{$session->language . '_name'};
}

if (!function_exists('getLastReplyOfMessage')) {

    function getLastReplyOfMessage($msg_id) {
        $message = new Message();
        $message->where('reply_of', $msg_id)->get();
        if ($message->result_count() == 1) {
            return getLastReplyOfMessage($message->id);
        } else {
            return $msg_id;
        }
    }

}

if (!function_exists('messageHasAttachments')) {
    function messageHasAttachments($msg_id) {
        $message = new Messageattachment();
        $message->where('message_id', $msg_id)->get();
        if ($message->result_count() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

if (!function_exists('getMessageAttachments')) {
    function getMessageAttachments($msg_id) {
        $message = new Messageattachment();
        $message->where('message_id', $msg_id)->get();
        if ($message->result_count() > 0) {
            return $message;
        }
    }
}

if (!function_exists('downloadFile')) {

    function downloadFile($path, $name) {

        if (file_exists($path)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Length: ' . filesize($path));
            header('Content-Disposition: attachment; filename="' . $name . '"');

            readfile($path);
        }
    }
}

if (!function_exists('attributionCards')) {
    function attributionCards($age) {
        $array = array();

        if($age < 16){
            $array['unique_solution'] = array('file' => '1.pdf','en' => 'Unique Solution', 'it' => 'Soluzione Unica');
            $array['two_installments'] = array('file' => '1.pdf','en' => 'Two Installments', 'it' => 'Due Rate');
            $array['no_choice'] = array('file' => '1.pdf','en' => 'No Choice', 'it' => 'Nessuna Scelta');    
        } else if ($age >= 16 & $age < 18){
            $array['unique_solution'] = array('file' => '1.pdf','en' => 'Unique Solution', 'it' => 'Soluzione Unica');
            $array['two_installments'] = array('file' => '1.pdf','en' => 'Two Installments', 'it' => 'Due Rate');
            $array['no_choice'] = array('file' => '1.pdf','en' => 'No Choice', 'it' => 'Nessuna Scelta');    
        } else if($age >= 18){
            $array['unique_solution'] = array('file' => '1.pdf','en' => 'Unique Solution', 'it' => 'Soluzione Unica');
            $array['two_installments'] = array('file' => '1.pdf','en' => 'Two Installments', 'it' => 'Due Rate');
            $array['no_choice'] = array('file' => '1.pdf','en' => 'No Choice', 'it' => 'Nessuna Scelta');
        }
        
        return $array;
    }
}

if (!function_exists('colorOfBlades')) {
    function colorOfBlades($id = null, $return = null) {
        $array = array();
        $array[1] = array('image' => 'amber_sword.jpg','en' => 'Amber', 'it' => 'Amber');
        $array[2] = array('image' => 'blue_sword.jpg','en' => 'Blue', 'it' => 'Blue');
        $array[3] = array('image' => 'green_sword.jpg','en' => 'Green', 'it' => 'Green');
        $array[4] = array('image' => 'purple_sword.jpg','en' => 'Purple', 'it' => 'Purple');
        $array[5] = array('image' => 'red_sword.jpg','en' => 'Red', 'it' => 'Red');
        $array[6] = array('image' => 'white_sword.jpg','en' => 'White', 'it' => 'White');

        if(is_null($id) && is_null($return)){
            return $array;    
        } else {
            if(array_key_exists($id, $array)){
                if(is_null($return)){
                    return $array[$id];
                }else{
                    return $array[$id][$return];
                }
            }else{
                if(is_null($return)){
                    return $array[2];
                }else{
                    return $array[2][$return];
                }
            }
        }
    }
}

/*
*   Array Function Start
*/

if (!function_exists('MultiArrayToSinlgeArray')) {
    function MultiArrayToSinlgeArray($multi_dimensional_array) {
        $single_dimensional_array = array();
        foreach ($multi_dimensional_array as $val) {
            if (is_array($val)) {
                foreach ($val as $val2) {
                    $single_dimensional_array[] = $val2;
                }
            }
        }
        return $single_dimensional_array;
    }
}

if (!function_exists('subvalue_sort')) {
    function subvalue_sort($a, $subkey) {
        $c = NULL;
        foreach ($a as $k => $v) {
            $b[$k] = strtolower($v->$subkey);
        }
        if (isset($b) && is_array($b)) {
            asort($b);
            foreach ($b as $key => $val) {
                $c[] = $a[$key];
            }
        }
        return $c;
    }
}

if (!function_exists('getArrayNexyValue')) {
    function getArrayNexyValue(&$array, $curr_val){
        $next = false;
        reset($array);
        do{
            $tmp_val = current($array);
            $res = next($array);
        } while ( ($tmp_val != $curr_val) && $res );
        if($res){
            $next = current($array);
        }
        return $next;
    }
}

if (!function_exists('getArrayPreviousValue')) {
    function getArrayPreviousValue(&$array, $curr_val){
        end($array);
        $prev = current($array);
        do{
            $tmp_val = current($array);
            $res = prev($array);
        } while ( ($tmp_val != $curr_val) && $res );
        if($res){
            $prev = current($array);
        }
        return $prev;
    }
}

if (!function_exists('objectToArray')) {
    function objectToArray($array) {
        if (is_object($array)) {
            $array = get_object_vars($array);
        }

        if (is_array($array)) {
            return array_map(__FUNCTION__, $array);
        } else {
            return $array;
        }
    }
}

if (!function_exists('array_column')) {
    function array_column($array,$column) {
    $col = array();
    $array = objectToArray($array);
    foreach ($array as $k => $v) {
        $col[]=$v[$column];
    }
    return $col;
    }
}

/*
*   Array Function End
*/
?>