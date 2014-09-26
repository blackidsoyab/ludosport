<?php

class Scorehistory extends DataMapper {

	public $table = 'score_histories';
	
    function __construct($id = NULL) {
        parent::__construct($id);
    }

    function meritStudentScore($student_id, $type, $score, $description = null){
        if($score != 0){
            $session = get_instance()->session->userdata('user_session');
            $obj_score = new Scorehistory();
            $obj_score->student_id = $student_id;
            $obj_score->oper = 'M';
            $obj_score->score_type = $type;
            $obj_score->score = $score;
            $obj_score->score_date = get_current_date_time()->get_date_for_db();
            $obj_score->description = $description;
            $obj_score->user_id = $session->id;
            $obj_score->save();

            $user_details = new Userdetail();
            $user_details->where('student_master_id', $student_id)->get();
            $user_details->$type = $user_details->$type + $score;
            $user_details->total_score = $user_details->total_score + $score;
            $user_details->save();
        }

        return true;
    }

    function demeritStudentScore($student_id, $type, $score, $description = null){
        if($score != 0){
            $session = get_instance()->session->userdata('user_session');
            $obj_score = new Scorehistory();
            $obj_score->student_id = $student_id;
            $obj_score->oper = 'D';
            $obj_score->score_type = $type;
            $obj_score->score = $score;
            $obj_score->score_date = get_current_date_time()->get_date_for_db();
            $obj_score->description = $description;
            $obj_score->user_id = $session->id;
            $obj_score->save();

            $user_details = new Userdetail();
            $user_details->where('student_master_id', $student_id)->get();
            $user_details->$type = $user_details->$type - $score;
            $user_details->total_score = $user_details->total_score - $score;
            $user_details->save();
        }

        return true;
    }

}

?>
