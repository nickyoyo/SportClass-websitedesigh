<?php session_start();
if(isset($_SESSION['checkloginout'])==0){
     header("refresh:0;url=topic1.html");
      exit();
}
?>

<html>
    <head>
        <title>前臺</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
             <link rel=stylesheet type="text/css" href="front_office.css?version=20161028"> 
    </head>
    <body>
  <div  class="leftbord">  
             <font face="Microsoft JhengHei" color="white" size="5">
             <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Office-page</b>
             </font>           
   </div>
   
      <div  class="rightbord">   
       &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;
       <font face="Microsoft JhengHei" color="white" size="4"> <a href="payoffice.html" style="color:#4F4F4F;" >繳費</a></font> 
    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
   <font face="Microsoft JhengHei" color="white" size="4"> <a href="changedata.html" style="color:#4F4F4F;" >學員資料修改</a></font>   
       &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
       <font face="Microsoft JhengHei" color="white" size="4"> <a href="loginout.php" style="color:#4F4F4F;"  >登出</a></font> 
       <br>
      ______________________________________________________________________________________________________________________________
   </div>
          <div  class="downbord">   
         <font face="Microsoft JhengHei" color="white" size="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;地址:台北市重慶北路二段162號&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;電話:0955305205&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;信箱：a0955305205@hotmail.com</font> 
    </div>
    </body>
</html>
