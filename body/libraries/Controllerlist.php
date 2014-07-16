<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ControllerList {

    private $CI;
    private $controllers;
    private $controllers_methods;

    function __construct() {
        $this->CI = get_instance();
        $this->setControllers();
    }

    public function getControllersAndMethods() {
        return $this->controllers_methods;
    }

    public function getControllers() {
        return $this->controllers;
    }

    public function getMethods($controlername) {
        return $this->setMethodsFromController($controlername);
    }

    public function setControllerMethods($ControllerName, $ControllerMethods, $Folder = 'root') {
        $not_display_controller = array(
            'json', 'ajax', 'dashboard'
        );
        if (!in_array($ControllerName, $not_display_controller)) {
            $this->controllers[$Folder . '_folder'][] = $ControllerName;
            $this->controllers_methods[$ControllerName] = $ControllerMethods;
        }
    }

    private function setControllers() {
        foreach (glob(APPPATH . 'controllers/*') as $controller) {
            if (is_dir($controller)) {
                $dirname = basename($controller, EXT);
                foreach (glob(APPPATH . 'controllers/' . $dirname . '/*') as $subdircontroller) {
                    $subdircontrollername = basename($subdircontroller, EXT);
                    if (!class_exists($subdircontrollername)) {
                        $this->CI->load->file($subdircontroller);
                    }

                    $aMethods = get_class_methods($subdircontrollername);
                    $aUserMethods = array();
                    foreach ($aMethods as $method) {
                        if ($method != '__construct' && $method != 'get_instance' && $method != $subdircontrollername) {
                            $aUserMethods[] = $method;
                        }
                    }
                    $this->setControllerMethods($subdircontrollername, $aUserMethods, $dirname);
                }
            } else if (pathinfo($controller, PATHINFO_EXTENSION) == "php") {
                $controllername = basename($controller, EXT);
                if (!class_exists($controllername)) {
                    $this->CI->load->file($controller);
                }

                $aMethods = get_class_methods($controllername);
                $aUserMethods = array();
                if (is_array($aMethods)) {
                    foreach ($aMethods as $method) {
                        if ($method != '__construct' && $method != 'get_instance' && $method != $controllername) {
                            $aUserMethods[] = $method;
                        }
                    }
                }

                $this->setControllerMethods($controllername, $aUserMethods);
            }
        }
    }

    public function setMethodsFromController($controller) {
        $controllername = basename($controller, EXT);

        if (!class_exists($controllername)) {
            $this->CI->load->file($controller);
        }

        $aMethods = get_class_methods($controllername);
        $aUserMethods = array();
        if (is_array($aMethods)) {
            foreach ($aMethods as $method) {
                if ($method != '__construct' && $method != 'get_instance' && $method != $controllername) {
                    $aUserMethods[] = $method;
                }
            }
        }

        return $aUserMethods;
    }

}

// EOF