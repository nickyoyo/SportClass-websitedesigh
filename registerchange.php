<?php session_start();

$accountcount=$_SESSION['accountcount'];
$classtime=$_SESSION['classtime'];
$acount=0;
    $name=array();
   $name = $_POST['registeraccount'];

  // $name = filter_input(INPUT_POST, 'registeraccount');
    if($name!==null) {$acount=count($name);}
$con =  mysqli_connect("127.0.0.1","root","","classhistory");
mysqli_query($con, 'SET NAMES utf8');

if($con->connect_error) {
   die("Coneection failed: ".$conn_connect_error());
   }
   
   $sql = "select * from `d$classtime` "; 
    
      $result= mysqli_query($con,$sql);
      if(!$result)
	{   
           echo ("Error: ".mysqli_error($con));
		exit();
	}
while($data = mysqli_fetch_array($result)){            //請假 還沒上課 但付錢了
        $account = $data['account'];
        $register = (int)$data['register'];
           $sqlaccount = "UPDATE `c$account` SET `register` = '0'  WHERE `class` = '$classtime'";
           mysqli_query($con,$sqlaccount);
           $sqlday = "UPDATE `d$classtime` SET `register` = '0'  WHERE `account` = '$account'";  
           mysqli_query($con,$sqlday);

 }  
  for($i=0;$i<$acount;$i++){
           $raccount=$name[$i];
           $sqlaccount = "UPDATE `c$raccount` SET `register` = '1'  WHERE `class` = '$classtime'";
           mysqli_query($con,$sqlaccount);
           $sqlday = "UPDATE `d$classtime` SET `register` = '1'  WHERE `account` = '$raccount'";  
           mysqli_query($con,$sqlday);
 } 
 
 echo '<meta http-equiv=REFRESH CONTENT=0;url=register.php>';



?>

