<?php

class Batch extends DataMapper {

    public $table = 'batches';
    
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }

}

?>
