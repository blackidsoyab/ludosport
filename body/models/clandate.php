<?php

class Clandate extends DataMapper {

    public $table = 'clandates';
    
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }

    function isClanShifted($clan_id, $date){
    	$this->db->_protect_identifiers = false;
        $query = $this->db->query('SELECT * FROM clandates WHERE clan_id=' . $clan_id .' AND ( clan_date = \'' . $date .'\' OR clan_shift_from =\'' . $date .'\')');
        if($query->num_rows() == 1 ){
            $res = $query->result();
            return $res[0];
        } else {
            return false;
        }
    }

}

?>
