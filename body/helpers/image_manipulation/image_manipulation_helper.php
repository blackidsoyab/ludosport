<?php

//this function just include the PDF libarary
if (!function_exists('include_lib_image_manipulation')) {

    function include_lib_image_manipulation() {
        require_once('php_image_magician.php');
        return true;
    }

}
?>
