<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->layout->setField('page_title', 'Dashboard');

    }

    public function index() {
        $this->layout->view('welcome');
    }

}
