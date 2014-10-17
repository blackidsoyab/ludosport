<?php
if (!function_exists('systemRatingScore')) {
    function systemRatingScore($type) {
        if (is_null($type) || empty($type) || is_integer($type)) {
            return false;
        }
        
        $array = array();
        $array['lesson'] = array('type' => 'xpr', 'score' => 2);
        $array['regular_challenge_win'] = array('type' => 'war', 'score' => 3);
        $array['regular_challenge_defeat'] = array('type' => 'xpr', 'score' => 1);
        $array['blind_challenge_win'] = array('type' => 'war', 'score' => 5);
        $array['blind_challenge_defeat'] = array('type' => 'xpr', 'score' => 2);
        $array['reject_challenge_launches'] = array('type' => 'xpr', 'score' => 2);
        $array['reject_challenge_accepted'] = array('type' => 'xpr', 'score' => 1);
        $array['challenge_contrast_opinions'] = array('type' => 'xpr', 'score' => 3);
        $array['challenge_victory_unconfirmed'] = array('type' => 'xpr', 'score' => 5);
        
        if (array_key_exists($type, $array)) {
            return $array[$type];
        } else {
            return false;
        }
    }
}
?>