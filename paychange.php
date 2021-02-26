<?php session_start();
if(isset($_SESSION['checkloginout'])==0){
     header("refresh:0;url=topic1.html");
      exit();
}
?>

<?php 
$account=$_SESSION['payaccount'];
$classcount=$_SESSION['classcount'];
$classdate = $_POST['paydate']; 

$con =  mysqli_connect("127.0.0.1","root","","classhistory");
mysqli_query($con, 'SET NAMES utf8');

if($con->connect_error) {
   die("Coneection failed: ".$conn_connect_error());
   }
   
   $sql = "select * from `c$account` "; 
    
      $result= mysqli_query($con,$sql);
      if(!$result)
	{   
           echo ("Error: ".mysqli_error($con));
		exit();
	}
 while($data = mysqli_fetch_array($result)){            //請假 還沒上課 但付錢了
        $class = $data['class'];
        $pay = (int)$data['pay'];              
        $sqlaccount = "UPDATE `c$account` SET `pay` = '1'  WHERE 1";
        mysqli_query($con,$sqlaccount);
        $sqlday = "UPDATE `d$class` SET `pay` = '1'  WHERE `account` = '$account'";  
        mysqli_query($con,$sqlday);
       
 }  
    
 echo '<meta http-equiv=REFRESH CONTENT=0;url=payoffice.html>';



?>

