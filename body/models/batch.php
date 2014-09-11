<?php

class Batch extends DataMapper {

    public $table = 'batches';
    public $has_many = array('userdetail');
    
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }

}

?>
