<?php
namespace App\CustomClass;

class Calendar
{
    public static function date_range($first, $last, $step = '+1 day', $output_format = 'd-m-Y' ) 
    {
        $dates = array();
        //Change to day format to not count hour value
        $first = date('d-m-Y', strtotime($first));
        $last = date('d-m-Y', strtotime($last));
        $current = strtotime($first);
        $last = strtotime($last);

        while( $current <= $last ) 
        {
            $dates[] = date($output_format, $current);
            $current = strtotime($step, $current);
        }
    
        return $dates;
    }
}