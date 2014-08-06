<?php

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
                'clanStudentList' => array('name' => 'Student List'),
                'listTrialLessonRequest' => array('name' => 'List Trial Lesson Request'),
                'changeStatusTrialStudent' => array('name' => 'Approve / Unapprove Request'),
        )),
        'eventcategories' => array(
            'name' => 'Event Categories',
            'hasChild' => array(
                'viewEventcategory' => array('name' => 'List'),
                'addEventcategory' => array('name' => 'Add'),
                'editEventcategory' => array('name' => 'Edit'),
                'deleteEventcategory' => array('name' => 'Delete'),
        )),
        'events' => array(
            'name' => 'Events',
            'hasChild' => array(
                'viewEvent' => array('name' => 'List'),
                'addEvent' => array('name' => 'Add'),
                'editEvent' => array('name' => 'Edit'),
                'deleteEvent' => array('name' => 'Delete'),
        )),
        'batches' => array(
            'name' => 'Batches',
            'hasChild' => array(
                'viewBatch' => array('name' => 'List'),
                'addBatch' => array('name' => 'Add'),
                'editBatch' => array('name' => 'Edit'),
                'deleteBatch' => array('name' => 'Delete'),
        )),
        'profiles' => array(
            'name' => 'Profile',
            'hasChild' => array(
                'viewProfile' => array('name' => 'View'),
                'editProfile' => array('name' => 'Edit'),
                'changePassword' => array('name' => 'Change Password'),
        )),
        'emails' => array(
            'name' => 'Email Templates',
            'hasChild' => array(
                'viewEmail' => array('name' => 'List'),
                'editEmail' => array('name' => 'Edit'),
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
                'viewState' => array('name' => 'List'),
                'addState' => array('name' => 'Add'),
                'editState' => array('name' => 'Edit'),
                'deleteState' => array('name' => 'Delete'),
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

?>
