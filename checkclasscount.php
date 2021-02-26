
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
  
 $con =  mysqli_connect("127.0.0.1","root","","imtsystem");
 $conn =  mysqli_connect("127.0.0.1","root","","classhistory");
 mysqli_query($con, 'SET NAMES utf8');
 
 if($con->connect_error) {
   die("Coneection failed: ".$con_connect_error());
   }
   
$sql = "select * from `data` ";

 $result= mysqli_query($con,$sql);
while ($data = mysqli_fetch_array($result)) {
       $checkaccount=$data['account'] ;   
       $classcount=$data['classcount'];
       if($checkaccount==$account){
           break;
       }
}
if($classcount==0){
     echo "<script>alert('您已無可使用課堂數，請前往個人頁面確認')</script>";
     echo '<meta http-equiv=REFRESH CONTENT=0;url=student.php>';
}
else{
    echo '<meta http-equiv=REFRESH CONTENT=0;url=casechoose.html>';
}
?>
