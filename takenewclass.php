<?php session_start();
 $day =$_GET["dataclass"];
 $class =substr($day, -1);
 $day = substr($day,0,-1);
 $day = $str_sec = explode("-",$day);
 $year=$day[0];
 $month=$day[1];
 $date=$day[2];
 if($day[1]<10){
    $month="0"."$day[1]";
 }
 if($day[2]<10){
     $date="0"."$day[2]";
 }
 
$dataclass=$year.$month.$date.$class;
$_SESSION['oldclass']=$dataclass;
    $_SESSION['newclass']=1;
    $_SESSION['change']=1;
    echo '<meta http-equiv=REFRESH CONTENT=0;url=casechoose.html>';
?>
