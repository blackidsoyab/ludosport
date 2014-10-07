<?php
class Mailbox extends DataMapper
{
    
    public $table_name = 'mailboxes';
    
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }
}
?>
