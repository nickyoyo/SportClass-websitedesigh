
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

<?php
$identity=filter_input(INPUT_POST, 'checkcode');
  $con =  mysqli_connect("127.0.0.1","root","","imtsystem");
     mysqli_query($con, 'SET NAMES utf8');
        if($con->connect_error) {
        die("Coneection failed: ".$con_connect_error());
        }
        $sqlcheck = "select * from teachercheck where checkcode = '$identity'";          //檢查帳號
        $result=mysqli_query($con,$sqlcheck);
        $exist=mysqli_num_rows($result);
    if($exist!=1){
        echo "<script>alert('驗證碼錯誤');</script>";
        header("refresh:0;url=chooseidentity.html");
    }
    else{
         header("refresh:0;url=signup_1.html");
    }
?>
