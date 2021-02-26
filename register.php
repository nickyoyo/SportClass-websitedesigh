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

<html>
    <head>
        <title>點名</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
<script type="text/javascript">
        function check_all(obj,cName)
        {
            var checkboxs = document.getElementsByName(cName);
            for(var i=0;i<checkboxs.length;i++){checkboxs[i].checked = obj.checked;}
        }
</script>
    </head>
    <body>
             <div  style="height:50px; padding:20px;" align="center">     
       <img src="topic2.jpg"  width="100" height="100"> <br> <br>  
          <font face="Microsoft JhengHei" color="#4A4E69" size="3" >
<?php
    $con =  mysqli_connect("127.0.0.1","root","","imtsystem");
    $conn =  mysqli_connect("127.0.0.1","root","","classhistory");
    mysqli_query($conn, 'SET NAMES utf8');
   
     
if($conn->connect_error) {
   die("Coneection failed: ".$conn_connect_error());
   } 
   
    date_default_timezone_set('Asia/Taipei');
    $Y=date("Y");
    $M=date("m");
    $D=date("d");
    $hour=date("G");
    $minute=(int)date("i");
    
if(($hour==7 && $minute>=0)||($hour==8 && $minute<=30)){
    $whichclass=1;
}
else if(($hour==9 && $minute>=0)||($hour==10 && $minute<=30)){
     $whichclass=2;
}
else if(($hour==10 && $minute>=30)||($hour==11 && $minute<=59)){
     $whichclass=3;
}
else if(($hour==14 && $minute>=30)||($hour==15 && $minute<=59)){
     $whichclass=4;
}
else if(($hour==17 && $minute>=0)||($hour==18 && $minute<=30)){
     $whichclass=5;
}
else if(($hour==19 && $minute>=0)||($hour==20 && $minute<=30)){
     $whichclass=6;
}
else if(($hour==21 && $minute>=0)||($hour==22 && $minute<=30)){
     $whichclass=7;
}
else{
    $whichclass=0;
}
   $TIME=$Y.$M.$D.$whichclass;
  // $TIME=202006102;
  /*   $resultch= mysqli_query($conn,$sqlc);
     if(!$resultch)
	{   
         echo "<script>alert('現在不是你的上課時間')</script>";
	 echo '<meta http-equiv=REFRESH CONTENT=0;url=teacher.html>';
	exit();
         
        }
*/
?>
</font>
     <font face="Microsoft JhengHei" color="#4A4E69" size="6" >
                 <b>點名</b><br></font>       
<font face="Microsoft JhengHei" color="#4A4E69" size="3" >
<?php 
    $sql = "select * from `d$TIME` ";
     $result= mysqli_query($conn,$sql);
     if(!$result)
	{   
         exit();
        }
   $saveaccount = array();
   $accountcount=0;
   
    while($data = mysqli_fetch_array($result)){            
        $dataaccount = $data['account'];
        $dataname = $data['name'];
        $register = (int)$data['register'];
            $saveaccount[$accountcount][0]=$dataname;  
            $saveaccount[$accountcount][1]=$dataaccount;
            if($register==0){
                $saveaccount[$accountcount][2]=0;
            }
            else if($register==1){
                $saveaccount[$accountcount][2]=1;
            }
            $accountcount++;   
        
        
     }
    ?>
<font face="Microsoft JhengHei" color="#4A4E69" size="4" ><b>
學員 &nbsp; &nbsp; &nbsp; 報到
        <font face="Microsoft JhengHei" color="#4A4E69" size="2" >
            <input type="checkbox" name="all" onclick="check_all(this,'registeraccount[]')" />全選/全不選
        </font>
</b></font>
<?php
$_SESSION['accountcount']=$accountcount;
$_SESSION['classtime']=$TIME;
     for($i=0;$i<$accountcount;$i++){
           
             ?>
 
    <form action="registerchange.php" method="post" style="font-size:16px; line-height:150%;">
        
         <?php  echo $saveaccount[$i][0]."&nbsp&nbsp&nbsp";  ?>
        <?php if($saveaccount[$i][2]==1){  ?>
        <input type="checkbox" name="registeraccount[]" value="<?=$saveaccount[$i][1]?>" checked>&nbsp&nbsp&nbsp&nbsp&nbsp;&nbsp&nbsp&nbsp;&nbsp&nbsp&nbsp;&nbsp&nbsp&nbsp;&nbsp&nbsp&nbsp;&nbsp&nbsp&nbsp;&nbsp&nbsp&nbsp;
                   <br>
        <?php    }  ?>
         <?php if($saveaccount[$i][2]==0){  ?>
        <input type="checkbox" name="registeraccount[]" value="<?=$saveaccount[$i][1]?>" >&nbsp&nbsp&nbsp&nbsp&nbsp;&nbsp&nbsp&nbsp;&nbsp&nbsp&nbsp;&nbsp&nbsp&nbsp;&nbsp&nbsp&nbsp;&nbsp&nbsp&nbsp;&nbsp&nbsp&nbsp;
                   <br>
        <?php    }  ?>
                   
        <?php
     }
    ?>
      <br>
       <input type="submit" value="送出"  name="check" >
    </form>

<?php
   echo '<a href="teacher.php">回首頁</a>  <br> <br>';
?>
</font>

   </body>
</html>