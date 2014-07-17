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

function getAllLanguages() {
    $obj = new language_master_model();
    $data = $obj->getAll(null, 'lang_name', 'ASC');
    if (!empty($data)) {
        return $data;
    } else {
        return false;
    }
}

function getPermmissionID($action) {
    $var = explode('_', $action);
    $obj = new Permission();
    $obj->where('controller', $var[0]);
    $obj->where('method', $var[1]);
    $obj->get();
    if ($obj->result_count() == 1) {
        return $obj->id;
    } else {
        return 0;
    }
}

function hasPermission($userid, $permissionid) {
    $data = User::userRoleByID($userid);
    if (array_key_exists($permissionid, $data)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function printMenu($k, $array, $round, $parrent_id) {
    foreach ($array as $key => $value) {
        if ($key != 'child') {
            $str = ($k == $parrent_id) ? 'selected' : '';
            echo '<option value="' . $k . ' "' . $str . '>' . repeater("&nbsp;", $round) . $value . '</option>';
        }
    }
}

function loopMenuArray($array, $round, $parrent_id) {
    foreach ($array as $key => $value) {
        if (isset($value['child'])) {
            printMenu($key, $value, $round, $parrent_id);
            loopMenuArray($value['child'], $round + 8);
        } else {
            printMenu($key, $value, $round, $parrent_id);
        }
    }
}

?>