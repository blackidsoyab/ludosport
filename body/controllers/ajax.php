<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ajax extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function getMethodsFromControllers($controlername, $method = null) {
        $methods = $this->controllerlist->getMethods($controlername);
        foreach ($methods as $value) {
            echo '<option value="' . $value . '"' . (($method == $value) ? ' selected="selected"' : '') . '>' . $value . '</option>';
        }
    }

    function checkValidPermision($id = null) {
        $permission = new Permission();
        $permission->where('controller', $this->input->post('controller'));
        $permission->where('method', $this->input->post('method'));
        $permission->get(1, 0);
        if ($id != '0') {
            if (count($permission) && $permission->id != $id) {
                echo 'false';
            } else {
                echo 'true';
            }
        } else {
            if (count($permission)) {
                echo 'false';
            } else {
                echo 'true';
            }
        }
    }

}
