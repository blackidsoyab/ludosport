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

function hasPermission($controller, $method) {
    $data = get_instance()->session->userdata('user_session');
    if ($data->id == 1) {
        return TRUE;
    } else {
        if (is_array($data->permissions) && array_key_exists($controller, $data->permissions) && in_array($method, $data->permissions[$controller])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

function time_elapsed_string($time) {
    $now = get_current_date_time()->get_date_time_for_db();

    $etime = strtotime($now) - strtotime($time);

    if ($etime < 1) {
        return '0 seconds';
    }

    $a = array(12 * 30 * 24 * 60 * 60 => 'year',
        30 * 24 * 60 * 60 => 'month',
        24 * 60 * 60 => 'day',
        60 * 60 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($a as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
        }
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

function printPermission($key, $array, $parent_key, $given_permission) {
    $str = '';
    if (!is_null($parent_key)) {
        $str .= 'name="perm[' . $parent_key . '][]"';
        if (is_array($given_permission) && array_key_exists($parent_key, $given_permission) && in_array($key, $given_permission[$parent_key])) {
            $str .= ' checked="checked"';
        }
    } else {
        if (is_array($given_permission) && array_key_exists($key, $given_permission)) {
            $str .= ' checked="checked"';
        }
    }

    foreach ($array as $k => $v) {
        if ($k != 'hasChild') {
            return '<li><input type="checkbox" value="' . $key . '"' . $str . '/><span>' . $v . '</span>';
        }
    }
}

function loopPermissionArray($array, $given_permission = null, $parent_key = null) {
    foreach ($array as $key => $value) {
        if (isset($value['hasChild'])) {
            echo printPermission($key, $value, $parent_key, $given_permission), '<ul>';
            loopPermissionArray($value['hasChild'], $given_permission, $key);
            echo '</ul>';
        } else {
            echo printPermission($key, $value, $parent_key, $given_permission);
        }
    }
}

function createPermissionArray() {
    $permission = array(
        'roles' => array(
            'name' => 'Role',
            'hasChild' => array(
                'viewRole' => array('name' => 'List'),
                'addRole' => array('name' => 'Add'),
                'editRole' => array('name' => 'Edit'),
                'deleteRole' => array('name' => 'Delete'),
        )),
        'users' => array(
            'name' => 'User',
            'hasChild' => array(
                'viewUser' => array('name' => 'List'),
                'addUser' => array('name' => 'Add'),
                'editUser' => array('name' => 'Edit'),
                'deleteUser' => array('name' => 'Delete'),
        )),
        'academies' => array(
            'name' => 'Academy',
            'hasChild' => array(
                'viewAcademy' => array('name' => 'List'),
                'addAcademy' => array('name' => 'Add'),
                'editAcademy' => array('name' => 'Edit'),
                'deleteAcademy' => array('name' => 'Delete'),
        )),
        'schools' => array(
            'name' => 'School',
            'hasChild' => array(
                'viewSchool' => array('name' => 'List'),
                'addSchool' => array('name' => 'Add'),
                'editSchool' => array('name' => 'Edit'),
                'deleteSchool' => array('name' => 'Delete'),
        )),
        'levels' => array(
            'name' => 'Level',
            'hasChild' => array(
                'viewLevel' => array('name' => 'List'),
                'addLevel' => array('name' => 'Add'),
                'editLevel' => array('name' => 'Edit'),
                'deleteLevel' => array('name' => 'Delete'),
        )),
        'clans' => array(
            'name' => 'Classes',
            'hasChild' => array(
                'viewClan' => array('name' => 'List'),
                'addClan' => array('name' => 'Add'),
                'editClan' => array('name' => 'Edit'),
                'deleteClan' => array('name' => 'Delete'),
                'clanTeacherList' => array('name' => 'Teacher List'),
        )),
        'countries' => array(
            'name' => 'Country',
            'hasChild' => array(
                'viewCountry' => array('name' => 'List'),
                'addCountry' => array('name' => 'Add'),
                'editCountry' => array('name' => 'Edit'),
                'deleteCountry' => array('name' => 'Delete'),
        )),
        'states' => array(
            'name' => 'State',
            'hasChild' => array(
                'viewStates' => array('name' => 'List'),
                'addStates' => array('name' => 'Add'),
                'editStates' => array('name' => 'Edit'),
                'deleteStates' => array('name' => 'Delete'),
        )),
        'cities' => array(
            'name' => 'City',
            'hasChild' => array(
                'viewCity' => array('name' => 'List'),
                'addCity' => array('name' => 'Add'),
                'editCity' => array('name' => 'Edit'),
                'deleteCity' => array('name' => 'Delete'),
        ))
    );

    return $permission;
}

function userNameAvtar($user_id) {
    $user = new User();
    $user->where('id', $user_id)->limit(1)->get();
    $return['name'] = $user->firstname . ' ' . $user->lastname;
    $return['avtar'] = IMG_URL . 'user_avtar/' . $user->avtar;
    return $return;
}

?>