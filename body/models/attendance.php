<?php

class Attendance extends DataMapper {

    public $has_many = array('user');

    function __construct($id = NULL) {
        parent::__construct($id);
    }

}

?>
