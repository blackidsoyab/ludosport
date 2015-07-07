<?php
class User extends DataMapper
{
    
    public $has_one = array(
        'userdetail' => array('join_other_as' => 'userdetail', 'join_self_as' => 'student_master'),
        'evolutionstudent' => array('join_other_as' => 'evolutionstudent', 'join_self_as' => 'student')
        );
    var $session_data;
    
    function __construct($id = NULL) {
        parent::__construct($id);
        $this->session_data = & get_instance()->session->userdata('user_session');
    }
    
    function userRoleByID($user_id, $role_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('roles.permission AS inherit');
        $this->db->from('users');
        $this->db->join('roles', 'FIND_IN_SET(roles.id, users.role_id) > 0');
        $this->db->where('users.id', $user_id);
        $this->db->where('roles.id', $role_id);
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $result = $res->result();
            return unserialize($result[0]->inherit);
        } else {
            return false;
        }
    }
    
    function getUsersByRole($role_id) {
        $where = NULL;
        if (is_array($role_id)) {
            foreach ($role_id as $id) {
                $where.= " OR FIND_IN_SET('" . $id . "', role_id) > 0";
            }
        } else {
            $where.= " OR FIND_IN_SET('" . $role_id . "', role_id) > 0";
        }
        
        $this->db->_protect_identifiers = false;
        $this->db->select('id, firstname, lastname');
        $this->db->from('users');
        $this->db->where(substr($where, 4));
        $this->db->where('status', 'A');
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }
    
    function getUsersDetails($user_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('id, firstname, lastname');
        $this->db->from('users');
        if (is_array($user_id)) {
            $this->db->where_in('id', $user_id);
        } else {
            $this->db->where('id', $user_id);
        }
        
        $this->db->where('status', 'A');
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }
    
    public static function getAdminIds() {
        $CI =& get_instance();
        $CI->db->_protect_identifiers = false;
        $CI->db->select('users.id');
        $CI->db->from('users');
        $CI->db->where('FIND_IN_SET(2, role_id)');
        $CI->db->where('users.status', 'A');
        $res = $CI->db->get();
        $array = array();
        if ($res->num_rows > 0) {
            $result = $res->result_array();
            $array = MultiArrayToSinlgeArray($result);
        }
        
        return array_unique($array);
    }
    
    function getUserBelowRole($user_role_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('users.id, firstname, lastname');
        $this->db->from('users');
        $this->db->join('roles', 'FIND_IN_SET(users.role_id, roles.id) >0');
        $this->db->where('roles.id >', $user_role_id);
        $this->db->where('users.status', 'A');
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }
    
    function getUsersByIdsRole($role_id) {
        $where = NULL;
        if (is_array($role_id)) {
            foreach ($role_id as $id) {
                $where.= " OR FIND_IN_SET('" . $id . "', role_id) > 0";
            }
        } else {
            $where.= " OR FIND_IN_SET('" . $role_id . "', role_id) > 0";
        }
        
        $this->db->_protect_identifiers = false;
        $this->db->select('id');
        $this->db->from('users');
        $this->db->where('users.status', 'A');
        $this->db->where(substr($where, 4));
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return MultiArrayToSinlgeArray($res->result_array());
        } else {
            return false;
        }
    }
}
?>
