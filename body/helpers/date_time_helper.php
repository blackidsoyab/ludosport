<?php
if (!function_exists('get_current_date_time')) {
    
    /*
     * gives the total time worked through out the day.
    */
    
    class MyTime
    {
        
        var $day;
        var $month;
        var $year;
        var $hour;
        var $minute;
        var $second;
        
        function get_time_for_db() {
            return $this->hour . ':' . $this->minute . ':' . $this->second;
        }
        
        function get_date_for_db() {
            return $this->year . '-' . $this->month . '-' . $this->day;
        }
        
        function get_date_time_for_db() {
            return $this->get_date_for_db() . ' ' . $this->get_time_for_db();
        }
        
        function get_date_time() {
            return $this->day . "-" . $this->month . "-" . $this->year . " " . $this->hour . ":" . $this->minute . ":" . $this->second;
        }
    }
    
    function get_current_date_time() {
        $timezone = get_time_zone();
        $daylight = get_daylight_setting();
        $timestamp = strtotime($daylight . ' hour', now());
        
        $mytime = new MyTime();
        
        if ($timezone != '') {
            $mytime->day = date('d', gmt_to_local($timestamp, $timezone));
            $mytime->month = date('m', gmt_to_local($timestamp, $timezone));
            $mytime->year = date('Y', gmt_to_local($timestamp, $timezone));
            $mytime->hour = date('H', gmt_to_local($timestamp, $timezone));
            $mytime->minute = date('i', gmt_to_local($timestamp, $timezone));
            $mytime->second = date('s', gmt_to_local($timestamp, $timezone));
        } else {
            $mytime->day = date('d', gmt_to_local($timestamp));
            $mytime->month = date('m', gmt_to_local($timestamp));
            $mytime->year = date('Y', gmt_to_local($timestamp));
            $mytime->hour = date('H', gmt_to_local($timestamp));
            $mytime->minute = date('i', gmt_to_local($timestamp));
            $mytime->second = date('s', gmt_to_local($timestamp));
        }
        return $mytime;
    }
}

if (!function_exists('get_time_zone')) {
    
    function get_time_zone() {
        $timeZone = 'UTC';
        return $timeZone;
    }
}

if (!function_exists('get_daylight_setting')) {
    
    function get_daylight_setting() {
        $daylight = '0';
        return $daylight;
    }
}

function time_elapsed_string($older_date) {
    $now = get_current_date_time()->get_date_time_for_db();
    
    //current date and time
    $newer_date = $now;
    
    // Setup the strings
    $unknown_text = 'sometime';
    $right_now_text = 'right now';
    $ago_text = '%s ago';
    
    // array of time period chunks
    $chunks = array(YEAR_IN_SECONDS, 30 * DAY_IN_SECONDS, WEEK_IN_SECONDS, DAY_IN_SECONDS, HOUR_IN_SECONDS, MINUTE_IN_SECONDS, 1);
    
    if (!empty($newer_date) && !is_numeric($newer_date)) {
        $time_chunks = explode(':', str_replace(' ', ':', $newer_date));
        $date_chunks = explode('-', str_replace(' ', '-', $newer_date));
        $newer_date = gmmktime((int)$time_chunks[1], (int)$time_chunks[2], (int)$time_chunks[3], (int)$date_chunks[1], (int)$date_chunks[2], (int)$date_chunks[0]);
    }
    
    if (!empty($older_date) && !is_numeric($older_date)) {
        $time_chunks = explode(':', str_replace(' ', ':', $older_date));
        $date_chunks = explode('-', str_replace(' ', '-', $older_date));
        $older_date = gmmktime((int)$time_chunks[1], (int)$time_chunks[2], (int)$time_chunks[3], (int)$date_chunks[1], (int)$date_chunks[2], (int)$date_chunks[0]);
    }
    
    // Difference in seconds
    $since = $newer_date - $older_date;
    
    // Something went wrong with date calculation and we ended up with a negative date.
    if (0 > $since) {
        $output = $unknown_text;
    } else {
        
        // Step one: the first chunk
        for ($i = 0, $j = count($chunks); $i < $j; ++$i) {
            $seconds = $chunks[$i];
            
            // Finding the biggest chunk (if the chunk fits, break)
            $count = floor($since / $seconds);
            if (0 != $count) {
                break;
            }
        }
        
        // If $i iterates all the way to $j, then the event happened 0 seconds ago
        if (!isset($chunks[$i])) {
            $output = $right_now_text;
        } else {
            
            // Set output var
            switch ($seconds) {
                case YEAR_IN_SECONDS:
                    $output = sprintf('%s year', $count);
                    break;

                case 30 * DAY_IN_SECONDS:
                    $output = sprintf('%s month', $count);
                    break;

                case WEEK_IN_SECONDS:
                    $output = sprintf('%s week', $count);
                    break;

                case DAY_IN_SECONDS:
                    $output = sprintf('%s day', $count);
                    break;

                case HOUR_IN_SECONDS:
                    $output = sprintf('%s hour', $count);
                    break;

                case MINUTE_IN_SECONDS:
                    $output = sprintf('%s minute', $count);
                    break;

                default:
                    $output = sprintf('%s second', $count);
            }
            
            // Step two: the second chunk
            // A quirk in the implementation means that this
            // condition fails in the case of minutes and seconds.
            // We've left the quirk in place, since fractions of a
            // minute are not a useful piece of information for our
            // purposes
            if ($i + 2 < $j) {
                $seconds2 = $chunks[$i + 1];
                $count2 = floor(($since - ($seconds * $count)) / $seconds2);
                
                // Add to output var
                if (0 != $count2) {
                    
                    switch ($seconds2) {
                        case 30 * DAY_IN_SECONDS:
                            $output.= sprintf(' %s month', $count2);
                            break;

                        case WEEK_IN_SECONDS:
                            $output.= sprintf(' %s week', $count2);
                            break;

                        case DAY_IN_SECONDS:
                            $output.= sprintf(' %s day', $count2);
                            break;

                        case HOUR_IN_SECONDS:
                            $output.= sprintf(' %s hour', $count2);
                            break;

                        case MINUTE_IN_SECONDS:
                            $output.= sprintf(' %s minute', $count2);
                            break;

                        default:
                            $output.= sprintf(' %s second', $count2);
                    }
                }
            }
            
            // No output, so happened right now
            if (!(int)trim($output)) {
                $output = $right_now_text;
            }
        }
    }
    
    if ($output != $right_now_text) {
        $output = sprintf($ago_text, $output);
    }
    return $output;
}

function getDateByDay($day, $start_date, $end_date) {
    $end_date = strtotime($end_date);
    $dates = array();
    for ($i = strtotime($day, strtotime($start_date)); $i <= $end_date; $i = strtotime('+1 week', $i)) {
        $dates[] = date('Y-m-d', $i);
    }
    return $dates;
}

function generateDates($start_date, $end_date) {
    $end_date = strtotime($end_date);
    $dates = array();
    for ($i = strtotime($start_date); $i <= $end_date; $i = strtotime('+1 day', $i)) {
        $dates[] = date('Y-m-d', $i);
    }
    return $dates;
}
