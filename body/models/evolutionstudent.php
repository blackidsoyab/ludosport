<?php
class Evolutionstudent extends DataMapper
{
    
    public $table = 'evolutionstudents';
    public $has_one = array('evolutionclan');
    
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }
}
?>
