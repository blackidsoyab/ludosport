<?php
class Evolutionstudent extends DataMapper
{
    
    public $table = 'evolutionstudents';
    public $has_one = array('evolutionclan','user' => array('join_other_as' => 'user', 'join_self_as' => 'id'));
    
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }
}
?>
