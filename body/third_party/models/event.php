<?php

class Event extends DataMapper {

    public $has_one = array('eventcategory');

    function __construct($id = NULL) {
        parent::__construct($id);
    }

}

?>
