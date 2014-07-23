<?php

class Academy extends DataMapper {

    public $table = 'academies';
    public $has_many = array('school');

    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }

    function getTotalAcademyOfRector($dean_id) {
        $where = NULL;
        if (is_array($dean_id)) {
            foreach ($dean_id as $id) {
                $where .= " OR FIND_IN_SET('" . $id . "', rector_id) > 0";
            }
        } else {
            $where .= " OR FIND_IN_SET('" . $dean_id . "', rector_id) > 0";
        }

        $this->db->_protect_identifiers = false;
        $this->db->select('count(*) as total');
        $this->db->from('academies');
        $this->db->where(substr($where, 4));
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $resutl = $res->result();
            return $resutl[0]->total;
        } else {
            return false;
        }
    }

}

?>
