<?php

class AccessControl extends CI_Controller {

    var $allowed_c;
    var $allowed_m;

    public function __construct() {
        parent::__construct();
        $this->__clear_cache();
        $this->setAllowedControllers();
        $this->setAllowedMethod();
    }

    private function __clear_cache() {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }

    private function setAllowedControllers() {
        $this->allowed_c = array('authenticate');
    }

    private function setAllowedMethod() {
        $this->allowed_m = array('');
    }

    function checkPermission() {
        if ($this->router->fetch_directory() == "" && !in_array($this->router->class, $this->allowed_c)) {
            $session = $this->session->userdata('user_session');
            if (isset($session) && !empty($session)) {
                $userACL = new ACL($session->ID);
                if ($userACL->hasPermission($this->router->class . '_' . $this->router->method) === false) {
                    $this->session->set_flashdata('error', 'You dont have permission to see it :-/ Please contact Administrator');
                    redirect(base_url() . 'permission_denied', 'refresh');
                }
            } else {
                echo 'Let me think what to Do';
                exit;
            }
        }
    }

}

?>