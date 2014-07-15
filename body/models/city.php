<?php

class City extends DataMapper {

    public $table = 'cities';
    public $has_one = array('state');

    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }

}

?>
