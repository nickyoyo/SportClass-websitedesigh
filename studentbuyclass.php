<?php session_start();
if(isset($_SESSION['checkloginout'])==0){
     header("refresh:0;url=topic1.html");
      exit();
}
?>
<html>
    <head>
        <title>課堂購買</title>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
             <div  style="height:50px; padding:20px;" align="center">     
       <img src="topic2.jpg"  width="100" height="100"> <br>  
         <font face="Microsoft JhengHei" size="5">    堂數選擇  </font> 
         <form action="studentclasssend.php" method="post" style="font-size:16px; line-height:150%;">
             <br>
                    <input type="radio" value=1 name="classcount">單堂-一堂400
                     <br>
                    <input type="radio" value=4 name="classcount">四堂-一堂300
                     <br>
                    <input type="radio" value=8 name="classcount">八堂-一堂200
           
            <br>   <br>         
  <input type="submit" name="submit" value="結帳">
  <input type ="button" onclick="javascript:location.href='student.php'" value="回首頁">
        </form>
  </div>
 </body>
</html>
