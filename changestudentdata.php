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
    $account=filter_input(INPUT_POST, 'account');
    
    $con =  mysqli_connect("127.0.0.1","root","","imtsystem");
    mysqli_query($con, 'SET NAMES utf8');
     if($con->connect_error) {
      die("Coneection failed: ".$con_connect_error());
      }
    
    $sqcheck = "select * from data where account = '$account'";          //檢查帳號
    $resultcheckaccount=mysqli_query($con,$sqcheck);
    $exist=mysqli_num_rows($resultcheckaccount);
    if(!$exist){
         echo "<script>alert('帳號不存在')</script>";
         header("refresh:0;url=changedata.html");
         exit();
    }
    
    $_SESSION['$changedataaccount']=$account;
  

   
  $sqldata = "select * from data"; 
  $resultdata= mysqli_query($con,$sqldata);
      if(!$resultdata)
	{   
           echo ("Error: ".mysqli_error($con));
		exit();
	}  
      while($data = mysqli_fetch_array($resultdata)){ 
          if($account==$data['account']){
            $name=$data['name'];
            $identity=$data['identity'];
            $password=$data['password'];
            $nickname=$data['nickname'];
            $phone=$data['phone'];
            $connecter=$data['connecter'];
            $gender=$data['gender'];
            $address=$data['address'];
            $lineID=$data['lineID'];
            $extraphone=$data['extraphone'];
            $birthday=$data['birthday'];
             $email=$data['email'];
             break;
          }
      }  
      if($identity!=1){
            echo "<script>alert('這不是學生帳號')</script>";
            echo '<meta http-equiv=REFRESH CONTENT=0;url=changedata.html>';
            exit();
      }
?>

<html>
    <head>
        <title>資料修改</title>
           <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel=stylesheet type="text/css" href="signup.css"> 
    </head>
    <body>
         <div  class="leftbord">   
        <form action="sendchangedata.php" method="post" style="font-size:16px; line-height:150%;">
            帳號   : <br>
                 <font size="4px" color="gray"><?php echo $account ?> </font>
            <br>
           姓名 : <br>
                <input type="text" name="name"  value="<?php echo $name ?>">
            <br>
            身份 : <br>
            <input type="radio" value=1 name="identity" checked="true">學生
            <br>
            性別 : <br>
                    <input type="radio" value="M" name="gender" <?php if($gender=='M'){echo'checked'; }?>>男
                    <input type="radio" value="F" name="gender" <?php if($gender=='F'){echo'checked'; }?>>女
                    <input type="radio" value="X" name="gender" <?php if($gender=='X'){echo'checked'; }?>>其他
            <br>
             暱稱 : <br>
               <input type="text" name="nickname" value="<?php echo $nickname ?>" required/>
               <br>
               
               生日 : <br>
                <input type="date" name="birthday" value="<?php echo $birthday ?>" >
         
              <br>
             信箱 : <br>
               <input type="text" name="email" value="<?php echo $email ?>" required/>
               <br>    
             地址 : <br>
               <input type="text" name="address"  value="<?php echo $address ?>" required/>
               <br>
               
             電話 : <br>
               <input type="text" name="phone"  value="<?php echo "0".$phone ?>" required/>
               <br>
               Line ID : <br>
               <input type="text" name="lineID"  value="<?php echo $lineID ?>" required/>
               <br> <br>   
               緊急連絡人 :　<br>
               姓名 :  <input type="text" name="connecter"  value="<?php echo $connecter ?>" required/>
           <br>電話 : <input type="text" name="extraphone"  value="<?php echo "0".$extraphone ?>" required/>
            <br>   <br>         
  <input type="submit" value="提交">
  <input type="reset" value="清除">
  <input type ="button" onclick="javascript:location.href='front_office.php'" value="首頁">
  
        </form>
                </div>
      
           <div  class="rightbord">   
                 <br><br><br><br>  <br><br><br><br>
       <img src="topic2.jpg"  width="150" height="150">
         </div>
    </body>
</html>





