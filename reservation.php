<?php session_start();

$_SESSION['course1limit']=5;
$_SESSION['course2limit']=5;
$_SESSION['course3limit']=5;

$account=$_SESSION['account'];
$con =  mysqli_connect("127.0.0.1","root","","imtsystem");
mysqli_query($con, 'SET NAMES utf8');
if($con->connect_error) {
   die("Coneection failed: ".$con_connect_error());
   }
  $sql = "select * from allcourse where account = '$account'"; 
   $result=mysqli_query($con,$sql);
   $exist=mysqli_num_rows($result);

if($exist==1){                                                                                //如果已經有報名其他課程
       if($course==1){
         $sql = "UPDATE `allcourse` SET `course1` = '1'  WHERE `account` = '$account'";
         mysqli_query($con,$sql);
         $i=1;
         while(1){ 
         $sql1 = "select * from allcourse where priority1 = '$i'"; 
         $result=mysqli_query($con,$sql1);
         $exist=mysqli_num_rows($result);   
         if($exist!=1){
             $sql = "UPDATE `allcourse` SET `priority1` = '$i'  WHERE `account` = '$account'";
              mysqli_query($con,$sql);
            break;              
         }
            $i++;
         }
          echo "報名成功<p>";
             if($i<=2){
                echo "正取: $i 位";
            }
            else {
                $i=$i-2;
                echo "備取: $i 位";
            }
            /*
             if($i<=1){                     //若為正取，寄通知信
                $sql3 = "select * from data where account = '$account'";    
                $result=mysqli_query($con,$sql3);
                $box = mysqli_fetch_array($result);
                $to=$box['email'];
                $subject="正取通知";            //標題
                $message="恭喜你獲得IMT 特技課之正取名額，請於第一階段繳費截止前完成付費，否則會被取消資格，感謝您的參與，其他詳情請至官網或來電詢問"; //內文
                $headers = "From: nick0989310427@gmail.com.tw" . "\r\n";     //寄信人
                if(mail("$to", "$subject", "$message", "$headers"))
                  echo "信件已經發送成功。";//寄信成功就會顯示的提示訊息
                else
                   echo "信件發送失敗！";//寄信失敗顯示的錯誤訊息
              }
            */
    }
    if($course==2){
      $sql = "UPDATE `allcourse` SET `course2` = '1'  WHERE `account` = '$account'";  
            mysqli_query($con,$sql);
            $i=1;
         while(1){ 
         $sql1 = "select * from allcourse where priority2 = '$i'"; 
         $result=mysqli_query($con,$sql1);
         $exist=mysqli_num_rows($result);   
         if($exist!=1){
             $sql = "UPDATE `allcourse` SET `priority2` = '$i'  WHERE `account` = '$account'";
              mysqli_query($con,$sql);
            break;
           }
            $i++;
         }
            echo "報名成功<p>";
               if($i<=2){
                echo "正取: $i 位";
            }
            else {
                $i=$i-2;
                echo "備取: $i 位";
            }
    }
    if($course==3){
      $sql = "UPDATE `allcourse` SET `course3` = '1'  WHERE `account` = '$account'";  
            mysqli_query($con,$sql);
            $i=1;
         while(1){ 
         $sql1 = "select * from allcourse where priority3 = '$i'"; 
         $result=mysqli_query($con,$sql1);
         $exist=mysqli_num_rows($result);   
         if($exist!=1){
             $sql = "UPDATE `allcourse` SET `priority3` = '$i'  WHERE `account` = '$account'";
              mysqli_query($con,$sql);
            break;
          }
            $i++;
         }
            echo "報名成功<p>";
               if($i<=2){
                echo "正取: $i 位";
            }
            else {
                $i=$i-2;
                echo "備取: $i 位";
            }
    }
}
else{                                                                                   // //如果還未報名其他課程
    if($course==1){
       $sql = "INSERT INTO `allcourse` (`account` , `course1`) VALUES ('$account', '1')";  
            mysqli_query($con,$sql);
            $i=1;
         while(1){ 
         $sql1 = "select * from allcourse where priority1 = '$i'"; 
         $result=mysqli_query($con,$sql1);
         $exist=mysqli_num_rows($result);   
         if($exist!=1){
             $sql = "UPDATE `allcourse` SET `priority1` = '$i'  WHERE `account` = '$account'";
              mysqli_query($con,$sql);
            break;
          }
            $i++;
         }
            echo "報名成功<p>";
               if($i<=2){
                echo "正取: $i 位";
            }
            else {
                $i=$i-2;
                echo "備取: $i 位";
            }
    }
    if($course==2){
       $sql = "INSERT INTO `allcourse` (`account` , `course2`) VALUES ('$account', '1')"; 
            mysqli_query($con,$sql);
            $i=1;
         while(1){ 
         $sql1 = "select * from allcourse where priority2 = '$i'"; 
         $result=mysqli_query($con,$sql1);
         $exist=mysqli_num_rows($result);   
         if($exist!=1){
             $sql = "UPDATE `allcourse` SET `priority2` = '$i'  WHERE `account` = '$account'";
              mysqli_query($con,$sql);
          break; 
           }
            $i++;
         }
            echo "報名成功<p>";
               if($i<=2){
                echo "正取: $i 位";
            }
            else {
                $i=$i-2;
                echo "備取: $i 位";
            }
    }
    if($course==3){
       $sql = "INSERT INTO `allcourse` (`account` , `course3`) VALUES ('$account', '1')"; 
            mysqli_query($con,$sql);
           $i=1;
         while(1){ 
         $sql1 = "select * from allcourse where priority3 = '$i'"; 
         $result=mysqli_query($con,$sql1);
         $exist=mysqli_num_rows($result);   
         if($exist!=1){
             $sql = "UPDATE `allcourse` SET `priority3` = '$i'  WHERE `account` = '$account'";
              mysqli_query($con,$sql);
            break;
          }
            $i++;
         }
            echo "報名成功<p>";
               if($i<=2){
                echo "正取: $i 位";
            }
            else {
                $i=$i-2;
                echo "備取: $i 位";
            }
    }
}
$con->close();
header("refresh:3;url=reservation.html");
?>