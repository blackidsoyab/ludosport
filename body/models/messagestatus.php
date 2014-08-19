<?php

class Messagestatus extends DataMapper {

	public $table = 'messagestatus';
    public $has_one = array('message');

    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }

}

?>
