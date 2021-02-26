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

$account=$_SESSION['account'];
$day = $_GET["dataclass"]; 
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
 
$con =  mysqli_connect("127.0.0.1","root","","classhistory");
mysqli_query($con, 'SET NAMES utf8');

if($con->connect_error) {
   die("Coneection failed: ".$conn_connect_error());
   }
   $sql = "select * from `c$account` "; 
    
      $result= mysqli_query($con,$sql);
      if(!$result)
	{   
           echo ("Error: ".mysqli_error($conn));
		exit();
	}
 while($data = mysqli_fetch_array($result)){            //請假 還沒上課 但付錢了
        $database = $data['class'];
        $register = (int)$data['register'];
        $pay = (int)$data['pay'];
        if($dataclass==$database&&$pay==1&&$register==2){                       //取消請假    
            $sqlaccount = "UPDATE `c$account` SET `register` = '0'  WHERE `class` = '$database'";
           mysqli_query($con,$sqlaccount);
           $sqlday = "UPDATE `d$database` SET `register` = '0'  WHERE `account` = '$account'";  
           mysqli_query($con,$sqlday);
           echo "<script>alert('已取消請假')</script>";
           break;
        }
        else if($dataclass==$database&&$pay==1&&$register==0){                  //請假
           $sqlaccount = "UPDATE `c$account` SET `register` = '2'  WHERE `class` = '$database'";
           mysqli_query($con,$sqlaccount);
           $sqlday = "UPDATE `d$database` SET `register` = '2'  WHERE `account` = '$account'";  
           mysqli_query($con,$sqlday);
           echo "<script>alert('請假成功')</script>";
           break;
        }
        else if($dataclass==$database&&$pay==1&&$register==0){                      //取消預約
           $sqlaccount = "DELETE FROM c$account where class = '$dataclass'"; 
           mysqli_query($con,$sqlaccount);
           $sqlday = "DELETE FROM d$database where account = '$account'";       
           mysqli_query($con,$sqlday);
             echo "<script>alert('取消成功')</script>";
            break;
        }
 } 
  echo '<meta http-equiv=REFRESH CONTENT=0;url=cancel.php>';
?>