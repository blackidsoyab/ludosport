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
        if (!empty($session)) {
            return $role->{$session->language . '_role_name'};
        } else {
            return $role->en_role_name;
        }
    }
}

if (!function_exists('getClanName')) {
    
    function getClanName($id) {
        $clan = new Clan();
        $clan->where('id', $id)->get();
        $ci = & get_instance();
        $session = $ci->session->userdata('user_session');
        if (!empty($session)) {
            return $clan->{$session->language . '_class_name'};
        } else {
            return $clan->en_class_name;
        }
    }
}

if (!function_exists('userNameAvtar')) {
    
    function userNameAvtar($user_id, $link = false) {
        $user = new User();
        $user->where('id', $user_id)->limit(1)->get();
        if ($link) {
            $return['name'] = '<a href="' . base_url() . 'profile/view/' . $user_id . '" class="user-extra-link">' . $user->firstname . ' ' . $user->lastname . '</a>';
        } else {
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
        if ($link) {
            $return['name'] = '<a href="' . base_url() . 'profile/view/' . $user_id . '" class="user-extra-link">' . $user->firstname . ' ' . $user->lastname . '</a>';
        } else {
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
        return ucwords($obj->{$session->language . '_name'});
    }
}

function getFullLocationByCity($city_id) {
    $ci = & get_instance();
    $session = $ci->session->userdata('user_session');
    
    $city = new City();
    $city_name = $city->where('id', $city_id)->get();
    
    return $city->{$session->language . '_name'} . ', ' . $city->State->{$session->language . '_name'} . ', ' . $city->State->Country->{$session->language . '_name'};
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

        //$current_day = get_current_date_time()->day;
        $current_month = get_current_date_time()->month;

        
        if ($age < 16) {
            if($current_month >=1  && $current_month <= 2){
                $array['unique_solution'] = array('file' => 'WhiteCard.pdf', 'en' => 'Unique Solution', 'it' => 'Soluzione Unica');
            }

            if($current_month >=1  && $current_month <= 2){
                $array['two_installments'] = array('file' => 'GrayCard.pdf', 'en' => 'Two Installments', 'it' => 'Due Rate');
            }

            if($current_month >=3  && $current_month <= 6){
                $array['no_choice_1'] = array('file' => 'YellowCard.pdf', 'en' => 'No Choice', 'it' => 'Nessuna Scelta');
            }

            if($current_month >=7  && $current_month <= 12){
                $array['no_choice_2'] = array('file' => 'VioletCard.pdf', 'en' => 'No Choice', 'it' => 'Nessuna Scelta');
            }   
        } else if ($age >= 16 & $age < 18) {
            if($current_month >=1  && $current_month <= 2){
                $array['unique_solution'] = array('file' => 'BlackCard_minore.pdf', 'en' => 'Unique Solution', 'it' => 'Soluzione Unica');
            }

            if($current_month >=1  && $current_month <= 2){
                $array['two_installments'] = array('file' => 'AmberCard_minore.pdf', 'en' => 'Two Installments', 'it' => 'Due Rate');
            }

            if($current_month >=3  && $current_month <= 6){
                $array['no_choice_1'] = array('file' => 'RedCard_minore.pdf', 'en' => 'No Choice', 'it' => 'Nessuna Scelta');
            }

            if($current_month >=7  && $current_month <= 12){
                $array['no_choice_2'] = array('file' => 'BlueCard_minore.pdf', 'en' => 'No Choice', 'it' => 'Nessuna Scelta');
            }

            if($current_month >=1  && $current_month <= 11){
                $array['no_choice_3'] = array('file' => 'BrownCard_minore.pdf', 'en' => 'No Choice', 'it' => 'Nessuna Scelta');
            }
        } else if ($age >= 18) {
            if($current_month >=1  && $current_month <= 2){
                $array['unique_solution'] = array('file' => 'BlackCard.pdf', 'en' => 'Unique Solution', 'it' => 'Soluzione Unica');
            }

            if($current_month >=1  && $current_month <= 2){
                $array['two_installments'] = array('file' => 'AmberCard.pdf', 'en' => 'Two Installments', 'it' => 'Due Rate');
            }

            if($current_month >=3  && $current_month <= 6){
                $array['no_choice_1'] = array('file' => 'RedCard.pdf', 'en' => 'No Choice', 'it' => 'Nessuna Scelta');
            }

            if($current_month >=7  && $current_month <= 12){
                $array['no_choice_2'] = array('file' => 'BlueCard.pdf', 'en' => 'No Choice', 'it' => 'Nessuna Scelta');
            }

            if($current_month >=1  && $current_month <= 11){
                $array['no_choice_3'] = array('file' => 'BrownCard.pdf', 'en' => 'No Choice', 'it' => 'Nessuna Scelta');
            }
            
        }
        
        return $array;
    }
}

if (!function_exists('getSolutionCoursesType1')) {
    function getSolutionCoursesType1($id = null) {
        $array = array();
        $array[]  = array('id'=>1, 'en_name'=>'Under 16', 'it_name' => 'Under 16');
        $array[]  = array('id'=>2, 'en_name'=>'Between 16 to 18', 'it_name' => 'Between 16 to 18');
        $array[]  = array('id'=>3, 'en_name'=>'Above 18', 'it_name' => 'Above 18');

        if(is_null($id)){
            return $array;
        }else{
            $ids = array_column($array,'id');
            if (($key = array_search($id, $ids)) !== false) {
                return $array[$key];
            }else{
                return array();
            }
        }
    }
}

if (!function_exists('getSolutionCoursesType2')) {
    function getSolutionCoursesType2($id = null) {
         $array = array();
        $array[]  = array('id'=>1, 'en_name'=>'Only for first Enrolment', 'it_name' => 'Only for first Enrolment');
        $array[]  = array('id'=>2, 'en_name'=>'Enrolment Members', 'it_name' => 'Enrolment Members');
        $array[]  = array('id'=>3, 'en_name'=>'Other Solutions', 'it_name' => 'Other Solutions');

        if(is_null($id)){
            return $array;
        }else{
            $ids = array_column($array, 'id');
            if (($key = array_search($id, $ids)) !== false) {
                return $array[$key];
            }else{
                return array();
            }
        }
    }
}

if (!function_exists('colorOfBlades')) {
    function colorOfBlades($id = null, $return = null) {
        $array = array();
        $array[1] = array('image' => 'amber_sword.jpg', 'en' => 'Amber', 'it' => 'Amber');
        $array[2] = array('image' => 'blue_sword.jpg', 'en' => 'Blue', 'it' => 'Blue');
        $array[3] = array('image' => 'green_sword.jpg', 'en' => 'Green', 'it' => 'Green');
        $array[4] = array('image' => 'purple_sword.jpg', 'en' => 'Purple', 'it' => 'Purple');
        $array[5] = array('image' => 'red_sword.jpg', 'en' => 'Red', 'it' => 'Red');
        $array[6] = array('image' => 'white_sword.jpg', 'en' => 'White', 'it' => 'White');
        
        if (is_null($id) && is_null($return)) {
            return $array;
        } else {
            if (array_key_exists($id, $array)) {
                if (is_null($return)) {
                    return $array[$id];
                } else {
                    return $array[$id][$return];
                }
            } else {
                if (is_null($return)) {
                    return $array[2];
                } else {
                    return $array[2][$return];
                }
            }
        }
    }
}

if (!function_exists('evolutionMasterLevels')) {
    function evolutionMasterLevels($level = 0, $id = null, $return = null) {

        $array = array();

        $array[0][1] = array('id'=> 1001, 'image' => IMG_URL . 'seven_styles/01_shiicho_base.png' , 'en' => 'Style Master In Shii-Cho', 'it' => 'Style Master In Shii-Cho');
        $array[0][2] = array('id'=> 1002, 'image' => IMG_URL . 'seven_styles/02_makashi_base.png', 'en' => 'Style Master In Makashi', 'it' => 'Style Master In Makashi');
        $array[0][3] = array('id'=> 1003, 'image' => IMG_URL . 'seven_styles/03_soresu_base.png', 'en' => 'Style Master In Soresu', 'it' => 'Style Master In Soresu');
        $array[0][4] = array('id'=> 1004, 'image' => IMG_URL . 'seven_styles/04_ataru_base.png', 'en' => 'Style Master In Ataru', 'it' => 'Style Master In Ataru');
        $array[0][5] = array('id'=> 1005, 'image' => IMG_URL . 'seven_styles/05_djemso_base.png', 'en' => 'Style Master In Djemso', 'it' => 'Style Master In Djemso');
        $array[0][6] = array('id'=> 1006, 'image' => IMG_URL . 'seven_styles/06_niman_base.png', 'en' => 'Style Master In Niman', 'it' => 'Style Master In Niman');
        $array[0][7] = array('id'=> 1007, 'image' => IMG_URL . 'seven_styles/07_vaapad_base.png', 'en' => 'Style Master In Vaapad', 'it' => 'Style Master In Vaapad');

        $array[1][1] = array('id'=> 1008, 'image' => IMG_URL . 'seven_styles/01_shiicho_esamestile.png' , 'en' => 'Style Master In Shii-Cho', 'it' => 'Style Master In Shii-Cho');
        $array[1][2] = array('id'=> 1009, 'image' => IMG_URL . 'seven_styles/02_makashi_esamestile.png', 'en' => 'Style Master In Makashi', 'it' => 'Style Master In Makashi');
        $array[1][3] = array('id'=> 10010, 'image' => IMG_URL . 'seven_styles/03_soresu_esamestile.png', 'en' => 'Style Master In Soresu', 'it' => 'Style Master In Soresu');
        $array[1][4] = array('id'=> 10011, 'image' => IMG_URL . 'seven_styles/04_ataru_esamestile.png', 'en' => 'Style Master In Ataru', 'it' => 'Style Master In Ataru');
        $array[1][5] = array('id'=> 10012, 'image' => IMG_URL . 'seven_styles/05_djemso_esamestile.png', 'en' => 'Style Master In Djemso', 'it' => 'Style Master In Djemso');
        $array[1][6] = array('id'=> 10013, 'image' => IMG_URL . 'seven_styles/06_niman_esamestile.png', 'en' => 'Style Master In Niman', 'it' => 'Style Master In Niman');
        $array[1][7] = array('id'=> 10014, 'image' => IMG_URL . 'seven_styles/07_vaapad_esamestile.png', 'en' => 'Style Master In Vaapad', 'it' => 'Style Master In Vaapad');

        $array[2][1] = array('id'=> 35, 'image' => IMG_URL . 'seven_styles/01_shiicho_esamemaster.png' , 'en' => 'Style Master In Shii-Cho', 'it' => 'Style Master In Shii-Cho');
        $array[2][2] = array('id'=> 36, 'image' => IMG_URL . 'seven_styles/02_makashi_esamemaster.png', 'en' => 'Style Master In Makashi', 'it' => 'Style Master In Makashi');
        $array[2][3] = array('id'=> 37, 'image' => IMG_URL . 'seven_styles/03_soresu_esamemaster.png', 'en' => 'Style Master In Soresu', 'it' => 'Style Master In Soresu');
        $array[2][4] = array('id'=> 38, 'image' => IMG_URL . 'seven_styles/04_ataru_esamemaster.png', 'en' => 'Style Master In Ataru', 'it' => 'Style Master In Ataru');
        $array[2][5] = array('id'=> 39, 'image' => IMG_URL . 'seven_styles/05_djemso_esamemaster.png', 'en' => 'Style Master In Djemso', 'it' => 'Style Master In Djemso');
        $array[2][6] = array('id'=> 40, 'image' => IMG_URL . 'seven_styles/06_niman_esamemaster.png', 'en' => 'Style Master In Niman', 'it' => 'Style Master In Niman');
        $array[2][7] = array('id'=> 41, 'image' => IMG_URL . 'seven_styles/07_vaapad_esamemaster.png', 'en' => 'Style Master In Vaapad', 'it' => 'Style Master In Vaapad');

        

        if (is_null($id) && is_null($return)) {
            return $array[$level];
        } else {
            if (array_key_exists($id, $array[$level])) {
                if (is_null($return)) {
                    return $array[$level][$id];
                } else {
                    return $array[$level][$id][$return];
                }
            }
        }
    }
}

if (!function_exists('getCurrency')) {
    
    function getCurrency($key = '') {
        $ci = & get_instance();
        $currencies = $ci->config->item('custom_currencies');

        if(in_array($key, $currencies)){
            return $currencies[$key];
        } else{
            return $currencies['USD'];
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
    function getArrayNexyValue(&$array, $curr_val) {
        $next = false;
        reset($array);
        do {
            $tmp_val = current($array);
            $res = next($array);
        } while (($tmp_val != $curr_val) && $res);
        if ($res) {
            $next = current($array);
        }
        return $next;
    }
} if (!function_exists('getArrayPreviousValue')) {
    function getArrayPreviousValue(&$array, $curr_val) {
        end($array);
        $prev = current($array);
        do {
            $tmp_val = current($array);
            $res = prev($array);
        } while (($tmp_val != $curr_val) && $res);
        if ($res) {
            $prev = current($array);
        }
        return $prev;
    }
} if (!function_exists('objectToArray')) {
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
    function array_column($array, $column) {
        $col = array();
        if(is_object($array)){
            $array = objectToArray($array);    
        }
        
        foreach ($array as $k => $v) {
            if(is_object($v)){
                $v = objectToArray($v);    
            }
            $col[$k] = $v[$column];
        }
        return $col;
    }
}

/*
 *   Array Function End
*/
?>