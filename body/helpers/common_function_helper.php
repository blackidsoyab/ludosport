<?php

if (!function_exists('getAllLanguages')) {

    function getAllLanguages() {
        $obj = new language_master_model();
        $data = $obj->getAll(null, 'lang_name', 'ASC');
        if (!empty($data)) {
            return $data;
        } else {
            return false;
        }
    }

}

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
        $field = $session->language . '_role_name';
        return $role->$field;
    }

}

if (!function_exists('getSystemConfiguration')) {

    function getSystemConfiguration($key) {
        $obj = new system_configuration_model();
        $data = $obj->getWhere(array('system_key' => $key));
        if (!empty($data)) {
            return $data[0]->system_value;
        } else {
            return false;
        }
    }

}

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



if (!function_exists('userNameAvtar')) {

    function userNameAvtar($user_id) {
        $user = new User();
        $user->where('id', $user_id)->limit(1)->get();
        $return['name'] = $user->firstname . ' ' . $user->lastname;
        $return['avtar'] = IMG_URL . 'user_avtar/40X40/' . $user->avtar;
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
?>