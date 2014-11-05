<?php
class Solutioncourse extends DataMapper
{
    
    public $has_one = array('academy');
    
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }
}
?>
