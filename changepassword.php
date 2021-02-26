<?php session_start();
if(isset($_SESSION['checkloginout'])==0){
     header("refresh:0;url=topic1.html");
      exit();
}
?>

<?php 

    $con =  mysqli_connect("127.0.0.1","root","","imtsystem");
    mysqli_query($con, 'SET NAMES utf8');
     if($con->connect_error) {
      die("Coneection failed: ".$con_connect_error());
      }
   
$account=$_SESSION['account'];
   
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
?>

<html>
    <head>
        <title>資料修改</title>
           <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
    </head>
    <body>
    <div  style="height:50px; padding:20px;" align="center">     
       <img src="topic2.jpg"  width="100" height="100"> <br>  
         <font face="Microsoft JhengHei" size="5">    修改密碼  </font> 
        <form action="sendchangepas.php" method="post" style="font-size:16px; line-height:150%;">
              <font size="2px" color="red"> 更改密碼請包含英文大寫+英文小寫+數字 </font>
                <?php  echo '<p/>'; ?>
   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp     目前的密碼   :<?php for($i=0;$i<strlen($_SESSION['password']);$i++){ echo "&nbsp•" ;} echo '<p/>'; ?>
         
  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp       新密碼 : 
                <input type="password" name="password" >
            <?php  echo '<p/>'; ?>
             再次輸入新密碼 : 
                <input type="password" name="passwordcheck" >
            <br>
  
        
            <br>          
  <input type="submit" value="提交">
  <input type ="button" onclick="javascript:location.href='ownpage.php'" value="回個人頁面">
  
        </form>
         </div>
    </body>
</html>





