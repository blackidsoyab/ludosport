<?php
class Systemsetting extends DataMapper
{
    
    function __construct($id = NULL) {
        parent::__construct($id);
    }
    
    public static function getSystemSetting() {
        $ci = & get_instance();
        $ci->db->select('sys_key, sys_value');
        $ci->db->from('systemsettings');
        $res = $ci->db->get();
        return $res->result_array();
    }
}
?>
