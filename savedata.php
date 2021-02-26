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
$con =  mysqli_connect("127.0.0.1","root","","imtsystem");
$conn =  mysqli_connect("127.0.0.1","root","","classhistory");
 mysqli_query($con, 'SET NAMES utf8');
 
 if($con->connect_error) {
   die("Coneection failed: ".$con_connect_error());
   }

 $account=$_SESSION['account'];
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

    $sqlaccount = "UPDATE `c$account` SET `pay` = '1'  WHERE `class` = '$dataclass'";
    mysqli_query($conn,$sqlaccount);
    $sqlday = "UPDATE `d$dataclass` SET `pay` = '1'  WHERE `account` = '$account'";  
    mysqli_query($conn,$sqlday);
    echo "<script>alert('繳費成功')</script>";
    echo '<meta http-equiv=REFRESH CONTENT=0;url=payoffice.html>';
?>

