<?php

class School extends DataMapper {

    public $has_one = array('academy');
    public $has_many = array('clan');

    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }

    function getTotalSchoolOfRector($rector_id) {
        $this->db->select('count(*) as total');
        $this->db->from('schools');
        $this->db->join('academies', 'academies.id=schools.academy_id');
        $this->db->where('FIND_IN_SET(' . $rector_id . ', academies.rector_id) > 0');
        $res = $this->db->get()->result();
        return $res[0]->total;
    }

    function getTotalSchoolOfDean($dean_id) {
        $this->db->select('count(*) as total');
        $this->db->from('schools');
        $this->db->where('FIND_IN_SET(' . $dean_id . ', schools.dean_id) > 0');
        $res = $this->db->get()->result();
        return $res[0]->total;
    }

    function afterSave($options = array()) {
        foreach (explode(',', $options->dean_id) as $dean) {
            $notify = new Notification();
            $notify->notify_type = 'dean_assign_school';
            $notify->from_id = $options->user_id;
            $notify->to_id = $dean;
            $notify->object_id = $options->id;
            $notify->save();
        }

        return true;
    }

}

?>
