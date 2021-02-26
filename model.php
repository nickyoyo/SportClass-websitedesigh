<?php session_start();
if($_SESSION['checkloginout']==0){
     header("refresh:1;url=topic1.html");
      exit();
}
?>

<?php 
$con =  mysqli_connect("127.0.0.1","root","","imtsystem");
mysqli_query($con, 'SET NAMES utf8');

if($con->connect_error) {
   die("Coneection failed: ".$con_connect_error());
   }       
$i=0;

   $sql = "select * from `allcourse` where course1='1'";
   $result= mysqli_query($con,$sql);
   
while ($data = mysqli_fetch_array($result)) {
    $i=$i+=1;
}
   echo "<p>總學員數 : $i 人";
   if($i<2){
        echo "還有缺額";
   }
   else{
        echo "已經額滿";
   }
?>

<html>
    <head>
        <title>class model</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    <script>
       
      </script>    
    </body>
</html>

<?php
    echo '<br><a href="reservation.html">預約課程</a>  <br>';
    echo '<a href="flower.php">回首頁</a>  <br>';
?>
