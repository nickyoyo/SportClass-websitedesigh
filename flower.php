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
<?php  session_start();
$classdayleft=0;
$account=$_SESSION['account'];
  $con =  mysqli_connect("127.0.0.1","root","","imtsystem");
  mysqli_query($con, 'SET NAMES utf8');
  if($con->connect_error) {
       die("Coneection failed: ".$con_connect_error());
       }
       
if($_SESSION['account'] != null)
{
   if($_SESSION['identity']==1){               //學生帳號
       
    $sql = "select * from `data` ";
    $result= mysqli_query($con,$sql);
  
    while ($data = mysqli_fetch_array($result)) {
       $checkaccount=$data['account'] ;
     if($checkaccount===$account){
         
      (int)$checklessday = date('j', strtotime($data['classdeadline'])-strtotime("now"));
      $classdayleft=$checklessday;
       if(strtotime($data['classdeadline'])<strtotime("now")){
        $checklessday*=-1;
    }
      if($checklessday<0){
      $sqlmailcount = "UPDATE `data` SET `classdeadline`=NULL,`classcount`=0,`mailcount`=0 WHERE `account` = '$checkaccount'";
      mysqli_query($con,$sqlmailcount);
        }
     }
}


if($classdayleft>0&&$classdayleft<4){
     echo "<script>alert('課堂期限即將到期，請至個人頁面確認')</script>";
}

      echo '<meta http-equiv=REFRESH CONTENT=0;url=student.php>';
      exit;
    }
    else if($_SESSION['identity']==2){           //教練帳號
        echo '<meta http-equiv=REFRESH CONTENT=0;url=teacher.php>';
        exit;
    }
    else if($_SESSION['identity']==3){             //前臺帳號   
        echo '<meta http-equiv=REFRESH CONTENT=0;url=front_office.php>';
        exit;
    }
       
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=topic1.html>';
}

?>