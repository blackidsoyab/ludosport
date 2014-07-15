<?php

class Lanugage_Change {

    public static function setLanguage() {
        $ci = & get_instance();
        $ci->language = strtolower(currentLanguage());
        $ci->config->set_item('language', $ci->language);
        $file = 'main';
        $ci->lang->load($file, $ci->language);
    }

}

?>