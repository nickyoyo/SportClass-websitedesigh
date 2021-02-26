<?php  session_start();
  $con =  mysqli_connect("127.0.0.1","root","","imtsystem");
    $conn =  mysqli_connect("127.0.0.1","root","","classhistory");
    mysqli_query($conn, 'SET NAMES utf8');
    
    if($con->connect_error) {
   die("Coneection failed: ".$con_connect_error());
   }  
$account=filter_input(INPUT_POST, 'account');   
$dataclass=filter_input(INPUT_POST, 'dataclass');
$text=filter_input(INPUT_POST, 'text');

 $sqlchangedata="UPDATE `data` SET `email`='$text' WHERE `account` = '$account'"; 
  mysqli_query($conn,$sqlchangedata);   
  
   header("refresh:1;url=historyclassmember.php");
   exit();
?>

