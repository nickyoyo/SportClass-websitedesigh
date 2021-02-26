<?php session_start();
if(isset($_SESSION['checkloginout'])==0){
     header("refresh:0;url=topic1.html");
      exit();
}
?>

<html>
    <title>學生頁面-首頁</title>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel=stylesheet type="text/css" href="student.css?version=20161028" > 
<body>
     

      <div  class="leftbord">  
             <font face="Microsoft JhengHei" color="white" size="5">
             <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Student-page</b></font>       
    
   </div>
   
      <div  class="rightbord">   
       &emsp;&emsp;
       <font face="Microsoft JhengHei" color="white" size="4"> <a href="studentclasssend.php" style="color:#4F4F4F;" >課堂購買</a></font>    
     &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
       <font face="Microsoft JhengHei" color="white" size="4">  <a href="checkclasscount.php" style="color:#4F4F4F;"  >課程預約</a></font> 
    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
       <font face="Microsoft JhengHei" color="white" size="4"> <a href="ownpage.php" style="color:#4F4F4F;"  >個人頁面</a></font> 
         &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
       <font face="Microsoft JhengHei" color="white" size="4"> <a href="classrecord.php" style="color:#4F4F4F;"  >歷史課程紀錄</a></font> 
         &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
       <font face="Microsoft JhengHei" color="white" size="4"> <a href="calender1.html" style="color:#4F4F4F;"  >行事曆</a></font> 
         &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
       <font face="Microsoft JhengHei" color="white" size="4"> <a href="loginout.php" style="color:#4F4F4F;"  >登出</a></font> 
       <br>
      ______________________________________________________________________________________________________________________________
       

  </div>
   </div>
          <div  class="downbord">   
        <font face="Microsoft JhengHei" color="white" size="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;地址:台北市重慶北路二段162號&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;電話:0955305205&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;信箱：a0955305205@hotmail.com</font> 
    </div>

</body>
</html>
