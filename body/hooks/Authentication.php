<?php

class Authentication extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->__clear_cache();
    }

    private function __clear_cache() {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }

    function checkLogin() {
        if ($this->router->class != 'authenticate') {
            $session = $this->session->userdata('user_session');
            if (empty($session)) {
                redirect(base_url() . 'login', 'refresh');
            }
        }
    }

}

?>