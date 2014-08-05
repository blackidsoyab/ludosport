<?php

class Userdetail extends DataMapper {

    public $table = 'userdetails';
    public $has_one = array(
        'clan' => array(),
        'user' => array(
            'class' => 'user',
            'join_other_as' => 'id')
    );

}

?>
