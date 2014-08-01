<?php

class City extends DataMapper {

    public $table = 'cities';
    public $has_one = array('state');
    public $ids;

    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }

    function getUniqueRandomCityId() {
        $this->db->select('id');
        $this->db->from('cities');
        $this->db->order_by('RAND()');
        $this->db->limit(1);
        $result = $this->db->get()->result();
        $this->setId($result[0]->id);

        $cities = new City();
        $count = $cities->count();
        
        if ($count <= count($this->getIds())) {
            if (in_array($result[0]->id, $this->getIds())) {
                return $this->getRandomCityId();
            } else {
                return $result[0]->id;
            }
        } else {
            return FALSE;
        }
    }

    function setId($id) {
        $this->ids[] = $id;
    }

    function getIds() {
        return $this->ids;
    }

}

?>
