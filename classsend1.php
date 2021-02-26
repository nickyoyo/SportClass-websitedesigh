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
 $account3 =  $_GET["account"];
 $classcount3 = $_GET["classcount"];
  $date=date('Y-m-d', strtotime("+30 days"));
//  $date=$year.$month.$day;
  
  
  
   
 $con =  mysqli_connect("127.0.0.1","root","","imtsystem");
 $conn =  mysqli_connect("127.0.0.1","root","","classhistory");
 mysqli_query($con, 'SET NAMES utf8');
 
 if($con->connect_error) {
   die("Coneection failed: ".$con_connect_error());
 }
 
 $sql = "select * from `data` "; 
    
      $result= mysqli_query($con,$sql);
      if(!$result)
	{   
           echo ("Error: ".mysqli_error($con));
		exit();
	}
 while($data = mysqli_fetch_array($result)){           
        $getaccount = $data['account'];
        $getclasscount = (int)$data['classcount'];
       if($getaccount==$account3){
                $classcount3+=$getclasscount;
       }
 }    


if($_SESSION['identity']==3){
    $sqlbuy = "UPDATE `data` SET `classdeadline`='$date',`classcount`='$classcount3' WHERE `account` = '$account3'";
    mysqli_query($con,$sqlbuy);
     $sqldel = "DELETE FROM `buyclass` WHERE `classcount`='$classcount3' AND `account` = '$account3'";
    mysqli_query($conn,$sqldel);
    echo "<script>alert('購買成功，請學員前往個人頁面確認')</script>";
 echo '<meta http-equiv=REFRESH CONTENT=0;url=front_office.php>';
}

?>