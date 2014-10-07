<?php
if (!function_exists('systemRatingScore')) {
    function systemRatingScore($type) {
        if (is_null($type) || empty($type) || is_integer($type)) {
            return false;
        }
        
        $array = array();
        $array['lesson'] = array('type' => 'xpr', 'score' => 2);
        $array['regular_challenge_win'] = array('type' => 'sty', 'score' => 3);
        $array['regular_challenge_defeat'] = array('type' => 'xpr', 'score' => 2);
        $array['blind_challenge_win'] = array('type' => 'sty', 'score' => 8);
        $array['blind_challenge_defeat'] = array('type' => 'xpr', 'score' => 3);
        
        if (array_key_exists($type, $array)) {
            return $array[$type];
        } else {
            return false;
        }
    }
}
?>