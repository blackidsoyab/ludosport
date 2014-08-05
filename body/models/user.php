<?php

class User extends DataMapper {

    public $has_one = array(
        'userdetail' => array(
            'class' => 'userdetail',
            'join_other_as' => 'student_master_id')
    );

    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }

    function userRoleByID($user_id, $role_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('users.permission AS extra, roles.permission AS inherit');
        $this->db->from('users');
        $this->db->join('roles', 'FIND_IN_SET(roles.id, users.role_id) > 0');
        $this->db->where('users.id', $user_id);
        $this->db->where('roles.id', $role_id);
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $result = $res->result();
            if (!is_null($result[0]->extra)) {
                return unserialize($result[0]->extra);
            } else {
                return unserialize($result[0]->inherit);
            }
        } else {
            return false;
        }
    }

    function getUsersByRole($role_id) {
        $where = NULL;
        if (is_array($role_id)) {
            foreach ($role_id as $id) {
                $where .= " OR FIND_IN_SET('" . $id . "', role_id) > 0";
            }
        } else {
            $where .= " OR FIND_IN_SET('" . $role_id . "', role_id) > 0";
        }

        $this->db->_protect_identifiers = false;
        $this->db->select('id, firstname, lastname');
        $this->db->from('users');
        $this->db->where(substr($where, 4));
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }

    public static function getAdminIds() {
        $obj = new User();
        $obj->where('role_id', 2);
        $array = array();
        foreach ($obj->get() as $value) {
            $array[] = $value->id;
        }

        return array_unique($array);
    }

    function afterSave($options = array()) {
        if ($options->user_id != 1 || $options->user_id != 2) {
            /* foreach (explode(',', $options->rector_id) as $rector) {
              $notify = new Notification();
              $notify->notify_type = 'rector_assign_academy';
              $notify->from_id = $options->user_id;
              $notify->to_id = $rector;
              $notify->object_id = $options->id;
              $notify->save();
              } */
        }

        return true;
    }

}

?>
