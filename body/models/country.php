<?php
class Country extends DataMapper
{
    
    public $table = 'countries';
    public $has_many = array('state');
    
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }
}
?>
