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
 $name=filter_input(INPUT_POST, 'name');
 //$account=filter_input(INPUT_POST, 'account');
 //$password=filter_input(INPUT_POST, 'password');
 //$check=filter_input(INPUT_POST, 'check');
 $account=$_SESSION['$changedataaccount'];
 $nickname=filter_input(INPUT_POST, 'nickname');
 $phone=filter_input(INPUT_POST, 'phone');
 $connecter=filter_input(INPUT_POST, 'connecter');
 $gender=filter_input(INPUT_POST, 'gender');
 $address=filter_input(INPUT_POST, 'address');
 $lineID=filter_input(INPUT_POST, 'lineID');
 $extraphone=filter_input(INPUT_POST, 'extraphone');
 $birthday=filter_input(INPUT_POST, 'birthday');
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
   $age = date('Y') - $year;
   if (date('m') < $month || (date('m') == $month && date('d') < $day)) $age--;  
//年齡計算
  $sql1 = "select * from data where account = '$account'";          //檢查帳號
    $result=mysqli_query($con,$sql1);
    $exist=mysqli_num_rows($result);

   /*  if($account &&  $password){
       $small="qwertyuiopasdfghjklzxcvbnm";
           $big="QWERTYUIOPASDFGHJKLZXCVBNM";
           $number="0123456789";
           $scount=0;$ncount=0;$bcount=0;
           for($i=0;$i<strlen($password);$i++){
               if(!strchr($small,$password[$i])){
                   $scount++;
               }
               if(!strchr($big,$password[$i])){
                   $bcount++;
               }
               if(!strchr($number,$password[$i])){
                   $ncount++;
               }
           }
           $pattern = '/[^x00-x80]/';
        if(preg_match($pattern,$account)){
		   echo "<script type='text/javascript'>alert('帳號不可有中文字!!');</script>";
            }
       if($ncount==0||$bcount==0||$scount==0){
                 echo "<script>alert('密碼不合規定');history.go(-1);</script>";
           }*/
     ///  else{
         $sqlchangedata="UPDATE `data` SET `name`='$name',`nickname`='$nickname',`birthday`='$birthday',`gender`='$gender',`phone`='$phone',`age`='$age',`address`='$address',`connecter`='$connecter',`extraphone`='$extraphone',`lineID`='$lineID',`email`='$email' WHERE `account` = '$account'"; 
         mysqli_query($con,$sqlchangedata);
         echo "修改完成";

     header("refresh:1;url=front_office.php");

     //        }
  //  }
   
    $con->close();

?>
