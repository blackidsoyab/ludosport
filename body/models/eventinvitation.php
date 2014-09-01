<?php

class Eventinvitation extends DataMapper {

    public $table = 'eventinvitations';
    public $has_many = array('event');

    function __construct($id = NULL) {
        parent::__construct($id);
    }

}

?>
