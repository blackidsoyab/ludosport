<?php
class Payment extends DataMapper
{
    
    function __construct($id = NULL) {
        parent::__construct($id);
    }
    
    function autoIncrementID($user_id, $clan_id) {
        $last_id = 0;
        $new_id = 0;
        
        $this->db->select('*');
        $this->db->from('payments');
        $this->db->order_by('invoice_id', 'desc');
        $this->db->limit(1);
        $res = $this->db->get();
        $result = $res->result();
        
        $clan = new Clan();
        $csa = implode('', $clan->getClanSchoolAcademyID($clan_id));
        
        $common_string_1 = date('Ymd', strtotime(get_current_date_time()->get_date_for_db())) . '-' . $csa . '-' . $user_id;
        
        if ($res->num_rows > 0) {
            $explode = explode('-', $result[0]->invoice_id);
            $last_id = @$explode[3];
        }
        
        $new_id = $common_string_1 . '-' . str_pad(($last_id + 1), 10, '0', STR_PAD_LEFT);
        
        return $new_id;
    }
}
?>
