<?php

class Attendancerecover extends DataMapper {

	 public $table = 'attendance_recovers';

    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }

    function getTotalStudentsForDate($date, $clan_id) {
        $this->db->select('count(*) as total');
        $this->db->from('attendance_recovers');
        $this->db->where('clan_date', $date, null);
        $this->db->where('clan_id', $clan_id, null);
        $query = $this->db->get()->result();
        return $query[0]->total;
    }

}

?>
