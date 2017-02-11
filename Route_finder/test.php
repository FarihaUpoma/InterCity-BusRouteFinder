<?php
// 24-hour time to 12-hour time
$time_in_12_hour_format1  = strtotime("13:30");//date("g:i a", strtotime("13:30"));

$time_in_12_hour_format2  = strtotime("12:30");


// 12-hour time to 24-hour time
$time_in_24_hour_format  = strtotime("1:30 am");

echo $time_in_12_hour_format2 -  $time_in_12_hour_format1. "</br>";
echo $time_in_12_hour_format2 . "</br>";
echo $time_in_24_hour_format . "</br>";