<script>
window.alert = function (name) {
  const iframe = document.createElement('IFRAME');
  iframe.style.display = 'none';
  iframe.setAttribute('src', 'data:text/plain,');
  document.documentElement.appendChild(iframe);
  window.frames[0].window.alert(name);
  iframe.parentNode.removeChild(iframe);
};
</script>
<?php session_start();
if(isset($_SESSION['checkloginout'])==0){
     header("refresh:0;url=topic1.html");
      exit();
}
?>

<?php

$month=$_GET['month']+1;
$date=$_GET['date'];
$class=$_GET['class'];
$day=$_GET['day'];
$date=$date+$day;
$month_days  = date("t",strtotime(date("Y-m")."-1"));
$year=date("Y");
if($month_days<$date){
    $month+=1;
    $date-=$month_days;
    if($month>12){
        $month-=12;
        $year=date("Y")-1;
    }
}
if($month<10){                                             //將年.月.日.甚麼時段的課程 的 字串設定好
      if($date>9){
            $database=$year."0".$month.$date.$class;
       }
      else{
            $database=$year."0".$month."0".$date.$class;
     }
 }
 else{
      if($date>9){
            $database=$year.$month.$date.$class;
      }
      else{
            $database=$year.$month."0".$date.$class;
      }
 }  

 date_default_timezone_set('Asia/Taipei');                  //現在時間
    $Y=date("Y");
    $M=date("m");
    $D=date("d");
    $hour=date("G");
    $minute=(int)date("i");
    
if(($hour==7 && $minute>=0)||($hour==8 && $minute<=30)){
    $whichclass=1;
}
else if(($hour==9 && $minute>=0)||($hour==10 && $minute<=30)){
     $whichclass=2;
}
else if(($hour==10 && $minute>=30)||($hour==11 && $minute<=59)){
     $whichclass=3;
}
else if(($hour==14 && $minute>=30)||($hour==15 && $minute<=59)){
     $whichclass=4;
}
else if(($hour==17 && $minute>=0)||($hour==18 && $minute<=30)){
     $whichclass=5;
}
else if(($hour==19 && $minute>=0)||($hour==20 && $minute<=30)){
     $whichclass=6;
}
else if(($hour==21 && $minute>=0)||($hour==22 && $minute<=30)){
     $whichclass=7;
}
else{
    $whichclass=0;
}
   $TIME=$Y.$M.$D.$whichclass;
   
 if($TIME>=$database){
     echo "<script>alert('課程預約截止')</script>";
     echo '<meta http-equiv=REFRESH CONTENT=0;url=casechoose.html>';
     exit();
 }