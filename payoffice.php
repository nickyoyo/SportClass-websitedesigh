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
$con =  mysqli_connect("127.0.0.1","root","","imtsystem");
mysqli_query($con, 'SET NAMES utf8');
if($con->connect_error) {
   die("Coneection failed: ".$con_connect_error());
   }  
   
  $_SESSION['buyaccount'] = filter_input(INPUT_POST, 'account');
  $account=$_SESSION['buyaccount'];
	$sqacc = "select * from data where account = '$account'";
        $sqldata = "select * from data"; 
        $resultdata= mysqli_query($con,$sqldata);
	$resultacc= mysqli_query($con,$sqacc);
         while($data = mysqli_fetch_array($resultdata)){ 
          if($account==$data['account']){
            $identity=$data['identity'];
             break;
          }
      }  
       $exist=mysqli_num_rows($resultacc);
       if($exist!=1){
              echo "<script>alert('帳號不存在');</script>";
              header("refresh:0;url=payoffice.html");
                exit();
       }
      if($identity!=1){
            echo "<script>alert('這不是學生帳號')</script>";
            echo '<meta http-equiv=REFRESH CONTENT=0;url=payoffice.html>';
              exit();
      }
	
	if($exist==1&&$identity==1){	
?>
<html>
    <head>
        <title>課堂購買</title>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
        <div  style="height:50px; padding:20px;" align="center">     
       <img src="topic2.jpg"  width="100" height="100"> <br>  
         <font face="Microsoft JhengHei" size="5">    堂數選擇  </font>           
        <form action="officebuy.php" method="post" style="font-size:16 px; line-height:150%;">
               <br>
            堂數選擇 : <br>
                    <input type="radio" value=1 name="classcount">單堂-一堂400
                     <br>
                    <input type="radio" value=4 name="classcount">四堂-一堂300
                     <br>
                    <input type="radio" value=8 name="classcount">八堂-一堂200
           
            <br>   <br>         
  <input type="submit" value="提交">
  <input type ="button" onclick="javascript:location.href='payoffice.html'" value="回上頁">
  <input type ="button" onclick="javascript:location.href='front_office.php'" value="回首頁">
  
        </form>

 </body>
</html>
<?php  } 
        
?>