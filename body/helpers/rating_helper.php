<?php
if (!function_exists('systemRatingScore')) {
    function systemRatingScore($type) {
        if (is_null($type) || empty($type) || is_integer($type)) {
            return false;
        }
        
        $array = array();
        $array['lesson'] = array('type' => 'xpr', 'score' => RATTING_SCORE_LESSON_ATTENDANCE);
        $array['regular_challenge_win'] = array('type' => 'war', 'score' => REGULAR_CHALLENGE_WIN);
        $array['regular_challenge_defeat'] = array('type' => 'xpr', 'score' => REGULAR_CHALLENGE_DEFEAT);
        $array['blind_challenge_win'] = array('type' => 'war', 'score' => BLIND_CHALLENGE_WIN);
        $array['blind_challenge_defeat'] = array('type' => 'xpr', 'score' => BLIND_CHALLENGE_DEFEAT);
        $array['reject_challenge_launches'] = array('type' => 'xpr', 'score' => REJECT_CHALLENGE_LAUNCHES);
        $array['reject_challenge_accepted'] = array('type' => 'xpr', 'score' => REJECT_CHALLENGE_ACCEPTED);
        $array['challenge_contrast_opinions'] = array('type' => 'xpr', 'score' => CHALLENGE_CONTRAST_OPINIONS);
        $array['challenge_victory_unconfirmed'] = array('type' => 'xpr', 'score' => CHALLENGE_VICTORY_UNCONFIRMED);
        
        if (array_key_exists($type, $array)) {
            return $array[$type];
        } else {
            return false;
        }
    }
}
?>