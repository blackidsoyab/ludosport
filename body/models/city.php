<?php
class City extends DataMapper
{
    
    public $table = 'cities';
    public $has_one = array('state');
    
    // Optionally, don't include a constructor if you don't need one.
    function __construct($id = NULL) {
        parent::__construct($id);
    }
    
    function getRandomCityId() {
        $this->db->select('id');
        $this->db->from('cities');
        $this->db->order_by('RAND()');
        $this->db->limit(1);
        $result = $this->db->get()->result();
        return $result[0]->id;
    }
}
?>
