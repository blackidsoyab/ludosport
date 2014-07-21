<?php

class Clan extends DataMapper {

    public $has_one = array('school');

    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }

}

?>
