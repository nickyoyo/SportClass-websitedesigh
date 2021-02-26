<?php session_start();
if(isset($_SESSION['checkloginout'])==0){
     header("refresh:0;url=topic1.html");
      exit();
}
?>

<?php
  $account = $_SESSION['account'];
  
 $con =  mysqli_connect("127.0.0.1","root","","imtsystem");
 $conn =  mysqli_connect("127.0.0.1","root","","classhistory");
 mysqli_query($con, 'SET NAMES utf8');
 
 if($con->connect_error) {
   die("Coneection failed: ".$con_connect_error());
   }
   
$sql = "select * from `data` ";

 $result= mysqli_query($con,$sql);
 $i=0;
while ($data = mysqli_fetch_array($result)) {
       $mailaccount[$i]=$data['account'] ;   
       $mailmail[$i]=$data['mail'];
       $mailname[$i]=$data['name'];
       $mailclassdeadline[$i]=$data['classdeadline'];
       
}
if($classcount==0){
     echo '<meta http-equiv=REFRESH CONTENT=0;url=student.html>';
}
?>
