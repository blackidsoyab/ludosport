<?php

class Userdetail extends DataMapper {

    public $table = 'userdetails';
    public $has_one = array('school', 'clan');

}

?>
