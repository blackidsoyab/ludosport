<?php

class Eventcategory extends DataMapper {

    public $table = 'eventcategories';
    public $has_many = array('event');

    function __construct($id = NULL) {
        parent::__construct($id);
    }

}

?>
