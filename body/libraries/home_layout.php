<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class home_layout {

    var $obj;
    var $layout;
    var $page_title;
    var $keywords;
    var $description;
    var $author;
    var $page_name;
    var $is_index;

    function home_layout($layout = "template/layout_main") {
        $this->obj = & get_instance();
        $this->layout = $layout;
    }

    function setLayout($layout) {
        $this->layout = $layout;
    }

    function setField($key, $val) {
        $this->$key = $val;
    }

    function view($view, $data = null, $return = false) {

        $loadedData = array();
        if (empty($this->page_title)) {
            $loadedData['page_title'] = 'Trad English';
        } else {
            $loadedData['page_title'] = $this->page_title;
        }
        $loadedData['page_name'] = $this->page_name;
        $loadedData['is_index'] = $this->is_index;
        $loadedData['keywords'] = $this->keywords;
        $loadedData['description'] = $this->description;
        $loadedData['author'] = $this->author;
        $loadedData['content_for_layout'] = $this->obj->load->view($view, $data, true);

        if ($return) {
            $output = $this->obj->load->view($this->layout, $loadedData, true);
            return $output;
        } else {
            $this->obj->load->view($this->layout, $loadedData, false);
        }
    }

}

?>