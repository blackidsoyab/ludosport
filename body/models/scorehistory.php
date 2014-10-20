<?php
class Scorehistory extends DataMapper
{
    
    public $table = 'score_histories';
    
    function __construct($id = NULL) {
        parent::__construct($id);
    }
    
    function meritStudentScore($student_id, $type, $score, $description = null) {
        if ($score != 0) {
            $session = get_instance()->session->userdata('user_session');
            $obj_score = new Scorehistory();
            $obj_score->student_id = $student_id;
            $obj_score->oper = 'M';
            $obj_score->score_type = $type;
            $obj_score->score = $score;
            $obj_score->score_date = get_current_date_time()->get_date_for_db();
            $obj_score->description = $description;
            if($student_id == $session->id){
                $obj_score->user_id = 0;
            }else{
                $obj_score->user_id = $session->id;
            }
            $obj_score->save();
            
            $obj_merit_user_details = new Userdetail();
            $obj_merit_user_details->where('student_master_id', $student_id)->get();
            $obj_merit_user_details->$type = $obj_merit_user_details->$type + $score;
            $obj_merit_user_details->total_score = $obj_merit_user_details->total_score + $score;
            $obj_merit_user_details->save();
        }
        
        return true;
    }
    
    function demeritStudentScore($student_id, $type, $score, $description = null) {
        if ($score != 0) {
            $session = get_instance()->session->userdata('user_session');
            $obj_score = new Scorehistory();
            $obj_score->student_id = $student_id;
            $obj_score->oper = 'D';
            $obj_score->score_type = $type;
            $obj_score->score = $score;
            $obj_score->score_date = get_current_date_time()->get_date_for_db();
            $obj_score->description = $description;
            if($student_id == $session->id){
                $obj_score->user_id = 0;
            }else{
                $obj_score->user_id = $session->id;
            }
            $obj_score->save();
            
            $obj_demerit_user_details = new Userdetail();
            $obj_demerit_user_details->where('student_master_id', $student_id)->get();
            if ($obj_demerit_user_details->$type - $score > 0) {
                $obj_demerit_user_details->$type = $obj_demerit_user_details->$type - $score;
            } else {
                $obj_demerit_user_details->$type = 0;
            }
            $obj_demerit_user_details->total_score = $obj_demerit_user_details->total_score - $score;
            $obj_demerit_user_details->save();
        }
        
        return true;
    }
}
?>
