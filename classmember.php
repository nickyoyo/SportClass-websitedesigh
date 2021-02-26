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
        <title>學員名單</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
      
       
<?php 
$account=$_SESSION['account'];
//$account="ttt123";
$month=$_GET['month']+1;
$date=$_GET['date'];
$class=$_GET['class'];
$day=$_GET['day'];
$date=$date+$day;
$month_days  = date("t",strtotime(date("Y-m")."-1"));
$year=date("Y");
if($month_days<$date){
    $month+=1;
    $date-=$month_days;
    if($month>12){
        $month-=12;
        $year=date("Y")-1;
    }
}
if($month<10){                                             //將年.月.日.甚麼時段的課程 的 字串設定好
      if($date>9){
            $database=$year."0".$month.$date.$class;
       }
      else{
            $database=$year."0".$month."0".$date.$class;
     }
 }
 else{
      if($date>9){
            $database=$year.$month.$date.$class;
      }
      else{
            $database=$year.$month."0".$date.$class;
      }
 }    

  $con =  mysqli_connect("127.0.0.1","root","","imtsystem");
    $conn =  mysqli_connect("127.0.0.1","root","","classhistory");
    mysqli_query($conn, 'SET NAMES utf8');
    
    if($con->connect_error) {
   die("Coneection failed: ".$con_connect_error());
   }  
   $saveaccount = array();
   $accountcount=0;
   
     $sql = "select * from `c$account` where class = '$database'";
     $result= mysqli_query($conn,$sql);
     $nums=mysqli_fetch_array($result);
      if($nums<1){
         echo "<script>alert('這不是你的課堂')</script>";
	 echo '<meta http-equiv=REFRESH CONTENT=0;url=calendar.html>';
	exit();
    }
    ?>
          <font face="Microsoft JhengHei" color="#4A4E69" size="6" >
                 <b>學員名單</b><br><br>  </font>            
               <font face="Microsoft JhengHei" color="#4A4E69" size="3" >
    <?php    
    $sqlmember = "select * from `d$database` ";
     $resultmember= mysqli_query($conn,$sqlmember);
    while($data = mysqli_fetch_array($resultmember)){          
        $dataaccount = $data['account'];
        $dataname = $data['name'];
        $register = (int)$data['register'];
            $saveaccount[$accountcount][0]=$dataname;  
            $saveaccount[$accountcount][1]=$dataaccount;
            $accountcount++;   
     }
     
    
     ?>
      <font face="Microsoft JhengHei" color="#4A4E69" size="4" >
      <b>學員名字 &nbsp;&nbsp; 電話</b><br><br>  </font>            
               <font face="Microsoft JhengHei" color="#4A4E69" size="3" >
    <?php
          for($i=0;$i<$accountcount;$i++){
                $sql = "select * from `data` ";
                    $result1= mysqli_query($con,$sql);
                   if(!$result1){
                       exit();
                   }
                    while($data = mysqli_fetch_array($result1)){          
                       $dataaccount = $data['account'];
                       $dataphone = $data['phone'];
                       if($dataaccount==$saveaccount[$i][1]){
                           $saveaccount[$i][2]=$dataphone;
                           break;
                       }           
                    }
             $namelength=strlen($saveaccount[$i][0]);
             echo $saveaccount[$i][0];
             for($j=0;$j<20-$namelength;$j++){
                 echo "&nbsp";
             }   
             echo "0".$saveaccount[$i][2].'<br>'.'<br>';
     }
echo '<a href="calendar.html">回課表</a>  &nbsp&nbsp';
echo '<a href="teacher.html">回首頁</a>  <br> <br>';
     ?>
</font>       
     
    </body>
</html>