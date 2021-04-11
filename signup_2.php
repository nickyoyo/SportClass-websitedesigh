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
    $name=filter_input(INPUT_POST, 'name');
    $account=filter_input(INPUT_POST, 'account');
    $password1=filter_input(INPUT_POST, 'password');
    $check=filter_input(INPUT_POST, 'check');
    $nickname=0;
    $phone=filter_input(INPUT_POST, 'phone');
    $connecter=0;
    $gender=filter_input(INPUT_POST, 'gender');
    $address=0;
    $lineID=filter_input(INPUT_POST, 'lineID');
    $extraphone=0;
    $birthday=0;
    $identity=filter_input(INPUT_POST, 'identity');
     $email=filter_input(INPUT_POST, 'email');

     $con =  mysqli_connect("127.0.0.1","root","","imtsystem");
     mysqli_query($con, 'SET NAMES utf8');
  if($con->connect_error) {
       die("Coneection failed: ".$con_connect_error());
       }

    //年齡計算
        $year = $month = $day = 0; 
      if (is_array($birthday)) { 
        extract($birthday); 
        } 
      else { 
        if (strpos($birthday, '-') !== false) { 
            list($year, $month, $day) = explode('-', $birthday); 
            }
        } 
        if($birthday!=0){
            $age = date('Y') - $year;     
        }
       if (date('m') < $month || (date('m') == $month && date('d') < $day)) {$age--;  }
       $age="";
    //年齡計算
      $sql1 = "select * from data where account = '$account'";          //檢查帳號
        $result=mysqli_query($con,$sql1);
        $exist=mysqli_num_rows($result);
        //echo $exist;
        if($exist==1){
               echo "<script>alert('帳號已存在');history.go(-1);</script>";
         //    header("refresh:1;url=signup_2.html");
        }
       else{
         if($account &&  $password1){
            if(strcmp($check,$password1)){
                 echo "<script>alert('兩次密碼不同');history.go(-1);</script>";
            //     header("refresh:0;url=signup_2.html");  //兩次密碼不同
                }
           $small="qwertyuiopasdfghjklzxcvbnm";
           $big="QWERTYUIOPASDFGHJKLZXCVBNM";
           $number="0123456789";
           $scount=0;$ncount=0;$bcount=0;
           for($i=0;$i<strlen($password1);$i++){
               if(!strchr($small,$password1[$i])){
                   $scount++;
               }
               if(!strchr($big,$password1[$i])){
                   $bcount++;
               }
               if(!strchr($number,$password1[$i])){
                   $ncount++;
               }
           }
           $pattern = '/[^x00-x80]/';
            if(preg_match($pattern,$account)){
		   echo "<script type='text/javascript'>alert('帳號不可有中文字!!');</script>";
            }
           if($ncount==0||$bcount==0||$scount==0){
                 echo "<script>alert('密碼不合規定');history.go(-1);</script>";
           }
           else{
            $password = sha1($password1);
            $sql ="INSERT INTO `data`(`name` , `account` ,  `password`,  `nickname`,  `phone`,  `connecter`,  `gender`,  `address`,  `extraphone`,  `lineID`,  `birthday`,  `age`,  `identity`,  `email`) VALUES ('$name' , '$account', '$password', '$nickname' , '$phone' , '$connecter' , '$gender' , '$address' , '$extraphone' , '$lineID', '$birthday' , '$age' , '$identity' , '$email' )";
              mysqli_query($con,$sql);
             echo "註冊完成";

         header("refresh:3;url=index.html");

                 }
        }
       }
        $con->close();
?>
