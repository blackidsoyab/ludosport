<?php
class State extends DataMapper
{
    
    public $has_many = array('city');
    public $has_one = array('country');
    
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }
}
?>
