<?php session_start();

$priority = $_SESSION['priority'];
$con =  mysqli_connect("127.0.0.1","root","","imtsystem");
mysqli_query($con, 'SET NAMES utf8');
$course=$_SESSION['course'];


if($con->connect_error) {
   die("Coneection failed: ".$con_connect_error());
   }

if($course==1){
     $sql = "select * from allcourse where priority1='0'";
     if($sql==1){
         for($i=1;;$i++){
              $sql = "select * from allcourse where priority1='$i'";
              if($sql!=1){
                  $sql = "UPDATE `allcourse` SET `priority1`=$i WHERE account=$account";  
                  break;
              }
         }
     }
     
}
else if($course==2){
    $sql = "select * from allcourse where priority2='0'";
    if($sql==1){
         for($i=1;;$i++){
              $sql = "select * from allcourse where priority2='$i'";
              if($sql!=1){
                  $sql = "UPDATE `allcourse` SET `priority2`=$i WHERE account=$account";  
                  break;
              }
         }
     }
     
}
else if($course==3){
    $sql = "select * from allcourse where priority3='0'";
      if($sql==1){
         for($i=1;;$i++){
              $sql = "select * from allcourse where priority3='$i'";
              if($sql!=1){
                  $sql = "UPDATE `allcourse` SET `priority3`=$i WHERE account=$account";  
                  break;
              }
         }
     }
     
}

$_SESSION['priority']=$i;

?>