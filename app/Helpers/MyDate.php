<?php namespace App\Helpers;

class MyDate {

    protected static $months = ['ene','feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic'];

    public static function getMonth($date){
        $month = explode('-', $date);
        $month = $month[1] - 1;
        return MyDate::$months[$month];
    }

    public static function getDay($date){
        $month = explode('-', $date);
        $month = $month[2];
        $month = explode(" ", $month);
        return $month[0];
    }

    public static function getSpentDays($date){
        $now = time(); // or your date as well
        $your_date = strtotime($date);
        $datediff = $now - $your_date;
        $days = floor($datediff/(60*60*24));
        $hours = floor(($datediff%(60*60*24))/(60*60));
        $stringDate = "";

        if($days == 0 && $hours == 0)
            $stringDate = "now";

        if($days == 1)
            $stringDate = $days.' día, ';
        else if($days > 1)
            $stringDate = $days.' días, ';

        if($hours == 1)
            $stringDate .= $hours.' hora';
        else if($hours > 1)
            $stringDate .= $hours. ' horas';

        return $stringDate;
    }
}