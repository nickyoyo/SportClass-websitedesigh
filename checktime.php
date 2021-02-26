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

<html>
    <head>
        <title>點名</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
          <font face="Microsoft JhengHei" color="#4A4E69" size="3" >
<?php
$account=$_SESSION['account'];
 //   $account="ttt123";
    $con =  mysqli_connect("127.0.0.1","root","","imtsystem");
    $conn =  mysqli_connect("127.0.0.1","root","","classhistory");
    mysqli_query($conn, 'SET NAMES utf8');
   
    
    
if($conn->connect_error) {
   die("Coneection failed: ".$conn_connect_error());
   } 
   
    date_default_timezone_set('Asia/Taipei');
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
   
  $sql = "select * from `c$account`";
  $result= mysqli_query($conn,$sql);
  $checkteacherclass=0;
  while($data = mysqli_fetch_array($result)){   
      $dataclass = $data['class'];
      if($dataclass==$TIME){
         $checkteacherclass=1;
      }
  }
 if($checkteacherclass==0){
        echo "<script>alert('現在不是你的授課時間')</script>";
       echo '<meta http-equiv=REFRESH CONTENT=0;url=teacher.php>';
	exit();
    } 
   else{
        echo '<meta http-equiv=REFRESH CONTENT=0;url=register.php>';
  }
   
?>