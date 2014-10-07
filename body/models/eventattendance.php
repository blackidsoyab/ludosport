<?php
class Eventattendance extends DataMapper
{
    
    public $table = 'eventattendances';
    public $has_many = array('event');
    
    function __construct($id = NULL) {
        parent::__construct($id);
    }
}
?>
