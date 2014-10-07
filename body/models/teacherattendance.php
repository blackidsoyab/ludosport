<?php
class Teacherattendance extends DataMapper
{
    
    public $table = 'teacher_attendances';
    
    function __construct($id = NULL) {
        parent::__construct($id);
    }
}
?>
