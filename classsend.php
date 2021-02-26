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
  $account = $_SESSION['account'];
 $classcount = filter_input(INPUT_POST, 'classcount');
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
       if($getaccount==$account){
           $classcount+=$getclasscount;
       }
 }    



if($_SESSION['identity']==1){
    
   $pay=filter_input(INPUT_POST, 'pay');
   $creditnumber=filter_input(INPUT_POST, 'creditnumber');
   if($pay=="facetoface"){
       $sqlbuy = "UPDATE `data` SET `classdeadline`='$date',`classcount`='$classcount' WHERE `account` = '$account'";
        mysqli_query($con,$sqlbuy);
        echo "<script>alert('購買成功，請前往個人頁面確認')</script>";
        echo '<meta http-equiv=REFRESH CONTENT=0;url=student.php>';
        exit();
   }
   if($pay=="credit"){
       $sqlbuy = "UPDATE `data` SET `classdeadline`='$date',`classcount`='$classcount' WHERE `account` = '$account'";
        mysqli_query($con,$sqlbuy);
        echo "<script>alert('購買成功，請前往個人頁面確認')</script>";
        echo '<meta http-equiv=REFRESH CONTENT=0;url=student.php>';
        exit();
   }
}
else if($_SESSION['identity']==3){
    $sqlbuy = "UPDATE `data` SET `classdeadline`='$date',`classcount`='$classcount' WHERE `account` = '$account'";
    mysqli_query($con,$sqlbuy);
    echo "<script>alert('購買成功，請學員前往個人頁面確認')</script>";
  echo '<meta http-equiv=REFRESH CONTENT=0;url=front_office.php>';
}

?>