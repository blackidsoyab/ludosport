<?php

class User extends DataMapper {

    public $has_one = array('role');

    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }

    public static function userRoleByID($userid) {
        $ci_ins = & get_instance();
        $ci_ins->db->select('users.permission AS extra, roles.permission AS inherit');
        $ci_ins->db->from('users');
        $ci_ins->db->join('roles', 'users.role_id=roles.id');
        $ci_ins->db->where('users.id', $userid);
        $res = $ci_ins->db->get();
        if ($res->num_rows > 0) {
            $result = $res->result();
            return array_diff((array) (!is_null(unserialize($result[0]->extra)) ? unserialize($result[0]->extra) : null) + (array) unserialize($result[0]->inherit), array('0', false));
        } else {
            return false;
        }
    }

}

?>
