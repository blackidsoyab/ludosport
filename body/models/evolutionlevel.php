<?php
class Evolutionlevel extends DataMapper
{
    
    public $table = 'evolutionlevels';
    public $has_one = array('evolutioncategory');
    public $has_many = array('evolutionclan');
    
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }
}
?>
