<?php

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

function currentLanguage() {
    $session = get_instance()->session->userdata('user_session');
    if (!empty($session)) {
        $obj = new language_master_model();
        $data = $obj->getwhere(array('lang_prefix' => $session->language));
        return $data[0]->lang_name;
    } else {
        echo 'English';
    }
}

function getPermmissionID($action) {
    $var = explode('_', $action);
    $obj = new perm_data_model();
    $data = $obj->getWhere(array('controllername' => $var[0], 'methodname' => $var[1]));
    if (!empty($data)) {
        return $data[0]->pid;
    } else {
        return false;
    }
}

function hasPermission($userid, $permissionid) {
    $data = user_data_model::userRoleByID($userid);
    if (array_key_exists($permissionid, $data)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

?>