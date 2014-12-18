<?php
if (!function_exists('convertNumber2Words')) {
    
    function convertNumber2Words($number) {
        
        $hyphen = '-';
        $conjunction = ' and ';
        $separator = ' ';
        $negative = 'negative ';
        $decimal = ' point ';
        $ci = & get_instance();
        $dictionary = array(
            0 => $ci->lang->line('num_zero'),
            1 => $ci->lang->line('num_one'),
            2 => $ci->lang->line('num_two'),
            3 => $ci->lang->line('num_three'),
            4 => $ci->lang->line('num_four'),
            5 => $ci->lang->line('num_five'),
            6 => $ci->lang->line('num_six'),
            7 => $ci->lang->line('num_seven'),
            8 => $ci->lang->line('num_eight'),
            9 => $ci->lang->line('num_nine'),
            10 => $ci->lang->line('num_ten'),
            11 => $ci->lang->line('num_eleven'),
            12 => $ci->lang->line('num_twelve'),
            13 => $ci->lang->line('num_thirteen'),
            14 => $ci->lang->line('num_fourteen'),
            15 => $ci->lang->line('num_fifteen'),
            16 => $ci->lang->line('num_sixteen'),
            17 => $ci->lang->line('num_seventeen'),
            18 => $ci->lang->line('num_eighteen'),
            19 => $ci->lang->line('num_nineteen'),
            20 => $ci->lang->line('num_twenty'),
            30 => $ci->lang->line('num_thirty'),
            40 => $ci->lang->line('num_fourty'),
            50 => $ci->lang->line('num_fifty'),
            60 => $ci->lang->line('num_sixty'),
            70 => $ci->lang->line('num_seventy'),
            80 => $ci->lang->line('num_eighty'),
            90 => $ci->lang->line('num_ninety'),
            100 => $ci->lang->line('num_hundred'),
            1000 => $ci->lang->line('num_thousand'),
            1000000 => $ci->lang->line('num_million'),
            1000000000 => $ci->lang->line('num_billion'),
            1000000000000 => $ci->lang->line('num_trillion'));
        
        if (!is_numeric($number)) {
            return false;
        }
        
        if (($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX) {
            
            // overflow
            trigger_error('convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING);
            return false;
        }
        
        if ($number < 0) {
            return $negative . convertNumber2Words(abs($number));
        }
        
        $string = $fraction = null;
        
        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }
        
        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;

            case $number < 100:
                $tens = ((int)($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string.= $hyphen . $dictionary[$units];
                }
                break;

            case $number < 1000:
                $hundreds = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string.= $conjunction . convertNumber2Words($remainder);
                }
                break;

            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int)($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = convertNumber2Words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string.= $remainder < 100 ? $conjunction : $separator;
                    $string.= convertNumber2Words($remainder);
                }
                break;
        }
        
        if (null !== $fraction && is_numeric($fraction)) {
            $string.= $decimal;
            $words = array();
            foreach (str_split((string)$fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string.= implode(' ', $words);
        }
        
        return ucwords($string);
    }
}
?>