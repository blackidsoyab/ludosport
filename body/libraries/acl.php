<?php
class acl
{
    
    var $perms = array();
    var $userID;
    var $userRoles = array();
    var $ci;
    
    function __construct($id = null) {
        $this->ci = & get_instance();
        $this->userID = $id;
        $this->userRoles = $this->getUserRoles();
        $this->buildACL();
    }
    
    function buildACL() {
        if (count($this->userRoles) > 0) {
            $this->perms = array_merge($this->perms, $this->getRolePerms($this->userRoles));
        }
        $this->perms = array_merge($this->perms, $this->getUserPerms($this->userID));
    }
    
    function getPermKeyFromID($permID) {
        $this->ci->db->select('controller,method');
        $this->ci->db->where('id', floatval($permID));
        $sql = $this->ci->db->get('permissions', 1);
        $data = $sql->result();
        return strtolower($data[0]->controller . '_' . $data[0]->method);
    }
    
    function getPermNameFromID($permID) {
        $this->ci->db->select('en_perm_name');
        $this->ci->db->where('id', floatval($permID));
        $sql = $this->ci->db->get('permissions', 1);
        $data = $sql->result();
        return $data[0]->en_perm_name;
    }
    
    function getRoleNameFromID($roleID) {
        $this->ci->db->select('role_name');
        $this->ci->db->where('id', floatval($roleID), 1);
        $sql = $this->ci->db->get('roles');
        $data = $sql->result();
        return $data[0]->role_name;
    }
    
    function getUserRoles() {
        $this->ci->db->where(array('id' => floatval($this->userID)));
        $this->ci->db->order_by('id', 'asc');
        $sql = $this->ci->db->get('users');
        $data = $sql->result();
        
        if ($sql->num_rows > 0) {
            return $data[0]->id;
        } else {
            return false;
        }
    }
    
    function getAllRoles($format = 'ids') {
        $format = strtolower($format);
        $this->ci->db->order_by('en_role_name', 'asc');
        $sql = $this->ci->db->get('roles');
        $data = $sql->result();
        
        $resp = array();
        foreach ($data as $row) {
            if ($format == 'full') {
                $resp[] = array("id" => $row->ID, "name" => $row->en_role_name);
            } else {
                $resp[] = $row->id;
            }
        }
        return $resp;
    }
    
    function getAllPerms($format = 'ids') {
        $format = strtolower($format);
        $this->ci->db->order_by('en_perm_name', 'asc');
        $sql = $this->ci->db->get('permissions');
        $data = $sql->result();
        
        $resp = array();
        foreach ($data as $row) {
            if ($format == 'full') {
                $resp[$row->controller . '_' . $row->method] = array('id' => $row->id, 'name' => $row->en_perm_name, 'key' => $this->getPermKeyFromID($row->id));
            } else {
                $resp[] = $row->id;
            }
        }
        return $resp;
    }
    
    function getRolePerms($role) {
        if (is_array($role)) {
            $this->ci->db->where_in('id', $role);
        } else {
            $this->ci->db->where(array('id' => floatval($role)));
        }
        $this->ci->db->order_by('id', 'asc');
        $sql = $this->ci->db->get('roles');
        $data = $sql->result();
        $perms = array();
        if (!empty($data)) {
            $d = unserialize($data[0]->permission);
            if (empty($d)) {
                return array();
            }
            foreach ($d as $k => $v) {
                if ($v !== '0') {
                    $pK = strtolower($this->getPermKeyFromID($k));
                    if ($pK == '') {
                        continue;
                    }
                    if ($v === '1') {
                        $hP = true;
                    } else {
                        $hP = false;
                    }
                    $perms[$pK] = array('perm' => $pK, 'inheritted' => true, 'value' => $hP, 'name' => $this->getPermNameFromID($k));
                }
            }
            return $perms;
        } else {
            return array();
        }
    }
    
    function getUserPerms($userID) {
        $this->ci->db->where('id', floatval($userID));
        $sql = $this->ci->db->get('users');
        $data = $sql->result();
        $perms = array();
        if (!empty($data)) {
            $d = unserialize($data[0]->permission);
            if (empty($d)) {
                return array();
            }
            foreach ($d as $k => $v) {
                $pK = strtolower($this->getPermKeyFromID($k));
                if ($pK == '') {
                    continue;
                }
                if ($v === '1') {
                    $hP = true;
                } else {
                    $hP = false;
                }
                $perms[$pK] = array('perm' => $pK, 'inheritted' => false, 'value' => $hP, 'name' => $this->getPermNameFromID($k));
            }
            return $perms;
        } else {
            return array();
        }
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