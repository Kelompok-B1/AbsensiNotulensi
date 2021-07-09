<?php




function format_interval(DateInterval $interval) {
    $result = "";
    
    if ($interval->y) { $result .= $interval->format("%y years "); }
    if ($interval->m) { $result .= $interval->format("%m months "); }
    if ($interval->d) { $result .= $interval->format("%d days "); }
    if ($interval->h) { $result .= $interval->format("%h hours "); }
    if ($interval->i) { $result .= $interval->format("%i minutes "); }
    if ($interval->s) { $result .= $interval->format("%s seconds "); }
    
    echo $interval->i;
    
    //return $result;
}

date_default_timezone_set('Asia/Jakarta');
//$tanggal= mktime(date("m"),date("d"),date("Y"));
$tgl = date("Y-m-d H:i:s");



$first_date = new DateTime($tgl);
$second_date = new DateTime("2021-07-06 12:43:00");

 $difference = $first_date->diff($second_date);


 echo format_interval($difference);



/*if (format_interval($difference) < 50){
    echo "kurang  dari 50";
}else{

    echo "kurang dari 50";
}*/
?>

<input type="time" name="date" > 

