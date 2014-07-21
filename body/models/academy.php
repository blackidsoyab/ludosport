<?php

class Academy extends DataMapper {

    public $table = 'academies';
    //public $has_many = array('school');

    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }

}

?>
