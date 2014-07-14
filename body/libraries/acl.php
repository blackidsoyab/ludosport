<?php

class acl {

    var $perms = array();  //Array : Stores the permissions for the user
    var $userID;   //Integer : Stores the ID of the current user
    var $userRoles = array(); //Array : Stores the roles of the current user
    var $ci;

    function __construct($id = null) {
        $this->ci = &get_instance();
        $this->userID = $id;
        $this->userRoles = $this->getUserRoles();
        $this->buildACL();
    }

    function buildACL() {
        //first, get the rules for the user's role
        if (count($this->userRoles) > 0) {
            $this->perms = array_merge($this->perms, $this->getRolePerms($this->userRoles));
        }
        //then, get the individual user permissions
        $this->perms = array_merge($this->perms, $this->getUserPerms($this->userID));
    }

    function getPermKeyFromID($permID) {
        //$strSQL = "SELECT `permKey` FROM `".DB_PREFIX."permissions` WHERE `ID` = " . floatval($permID) . " LIMIT 1";
        $this->ci->db->select('controllername,methodname');
        $this->ci->db->where('pid', floatval($permID));
        $sql = $this->ci->db->get('perm_data', 1);
        $data = $sql->result();
        return strtolower($data[0]->controllername . '_' . $data[0]->methodname);
    }

    function getPermNameFromID($permID) {
        //$strSQL = "SELECT `permName` FROM `".DB_PREFIX."permissions` WHERE `ID` = " . floatval($permID) . " LIMIT 1";
        $this->ci->db->select('permission_name');
        $this->ci->db->where('pid', floatval($permID));
        $sql = $this->ci->db->get('perm_data', 1);
        $data = $sql->result();
        return $data[0]->permission_name;
    }

    function getRoleNameFromID($roleID) {
        //$strSQL = "SELECT `roleName` FROM `".DB_PREFIX."roles` WHERE `ID` = " . floatval($roleID) . " LIMIT 1";
        $this->ci->db->select('role_name');
        $this->ci->db->where('rid', floatval($roleID), 1);
        $sql = $this->ci->db->get('role_data');
        $data = $sql->result();
        return $data[0]->role_name;
    }

    function getUserRoles() {
        //$strSQL = "SELECT * FROM `".DB_PREFIX."user_data` WHERE `userID` = " . floatval($this->userID) . " ORDER BY `addDate` ASC";

        $this->ci->db->where(array('ID' => floatval($this->userID)));
        $this->ci->db->order_by('ID', 'asc');
        $sql = $this->ci->db->get('user_data');
        $data = $sql->result();

        if ($sql->num_rows > 0) {
            return $data[0]->rid;
        } else {
            return false;
        }
    }

    function getAllRoles($format = 'ids') {
        $format = strtolower($format);
        //$strSQL = "SELECT * FROM `".DB_PREFIX."roles` ORDER BY `roleName` ASC";
        $this->ci->db->order_by('role_name', 'asc');
        $sql = $this->ci->db->get('role_data');
        $data = $sql->result();

        $resp = array();
        foreach ($data as $row) {
            if ($format == 'full') {
                $resp[] = array("rid" => $row->ID, "name" => $row->role_name);
            } else {
                $resp[] = $row->rid;
            }
        }
        return $resp;
    }

    function getAllPerms($format = 'ids') {
        $format = strtolower($format);
        //$strSQL = "SELECT * FROM `".DB_PREFIX."permissions` ORDER BY `permKey` ASC";

        $this->ci->db->order_by('permission_name', 'asc');
        $sql = $this->ci->db->get('perm_data');
        $data = $sql->result();

        $resp = array();
        foreach ($data as $row) {
            if ($format == 'full') {
                $resp[$row->controllername . '_' . $row->methodname] = array('pid' => $row->pid, 'name' => $row->permission_name, 'key' => $this->getPermKeyFromID($row->pid));
            } else {
                $resp[] = $row->pid;
            }
        }
        return $resp;
    }

    function getRolePerms($role) {
        if (is_array($role)) {
            $this->ci->db->where_in('rid', $role);
        } else {
            $this->ci->db->where(array('rid' => floatval($role)));
        }
        $this->ci->db->order_by('rid', 'asc');
        $sql = $this->ci->db->get('role_perms'); //$this->db->select($roleSQL);
        $data = $sql->result();
        $perms = array();
        foreach ($data as $row) {
            $pK = strtolower($this->getPermKeyFromID($row->pid));
            if ($pK == '') {
                continue;
            }
            if ($row->value === '1') {
                $hP = true;
            } else {
                $hP = false;
            }
            $perms[$pK] = array('perm' => $pK, 'inheritted' => true, 'value' => $hP, 'name' => $this->getPermNameFromID($row->pid));
        }
        return $perms;
    }

    function getUserPerms($userID) {
        //$strSQL = "SELECT * FROM `".DB_PREFIX."user_perms` WHERE `userID` = " . floatval($userID) . " ORDER BY `addDate` ASC";

        $this->ci->db->where('uid', floatval($userID));
        $this->ci->db->order_by('addDate', 'asc');
        $sql = $this->ci->db->get('user_perms');
        $data = $sql->result();

        $perms = array();
        foreach ($data as $row) {
            $pK = strtolower($this->getPermKeyFromID($row->pid));
            if ($pK == '') {
                continue;
            }
            if ($row->value == '1') {
                $hP = true;
            } else {
                $hP = false;
            }
            $perms[$pK] = array('perm' => $pK, 'inheritted' => false, 'value' => $hP, 'name' => $this->getPermNameFromID($row->pid), 'id' => $row->pid);
        }
        return $perms;
    }

    function hasRole($roleID) {
        foreach ($this->userRoles as $k => $v) {
            if (floatval($v) === floatval($roleID)) {
                return true;
            }
        }
        return false;
    }

    function hasPermission($permKey) {
        $permKey = strtolower($permKey);
        if (array_key_exists($permKey, $this->perms)) {
            if ($this->perms[$permKey]['value'] === '1' || $this->perms[$permKey]['value'] === true) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}

?>