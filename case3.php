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
 date_default_timezone_set('Asia/Taipei');                  //現在時間
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
   
 if($TIME>=$database){
     echo "<script>alert('課程預約截止')</script>";
     echo '<meta http-equiv=REFRESH CONTENT=0;url=casechoose.html>';
     exit();
 }
 
    $con =  mysqli_connect("127.0.0.1","root","","imtsystem");
    $conn =  mysqli_connect("127.0.0.1","root","","classhistory");
    mysqli_query($con, 'SET NAMES utf8');
    
if($con->connect_error) {
   die("Coneection failed: ".$con_connect_error());
   }  

 $account = $_SESSION['account'];
 $sql = "select name from data where account = '$account'"; 
 $result= mysqli_query($con,$sql);
 $data = mysqli_fetch_array($result);
 $name = $data['name'];
 
 $sqlll = "select classcount from data where account = '$account'"; 
 $result2= mysqli_query($con,$sqlll);
 $data1 = mysqli_fetch_array($result2);
 $classcount = $data1['classcount'];
 
 mysqli_query($conn, 'SET NAMES utf8');
 if($conn->connect_error) {
   die("Coneection failed: ".$con_connect_error());
   } 
     $exist=0;
    $exist1=0;
     $sqll = "select * from `d$database` "; 
     $result1= mysqli_query($conn,$sqll);
     if($result1){
       $exist1=mysqli_num_rows($result1);
    }
  
    $sqlcheck = "select * from d$database where account = '$account'"; 
     $resultcheck= mysqli_query($conn,$sqlcheck);
    if($resultcheck){
       $exist=mysqli_num_rows($resultcheck);
    }
     if($exist1>=6){
         echo "<script>alert('此課程已額滿')</script>";
          echo '<meta http-equiv=REFRESH CONTENT=0;url=casechoose.html>';
          exit();
     }
    else if($exist<1){                              //還沒預約過
  /*       $sqlteacherdata = "select * from `data` ";
            $resultteacherdata = mysqli_query($conn,$sqlteacherdata);
            while($data = mysqli_fetch_array($resultteacherdata)){
                if($data['identity']==2){
                    $taccount=$data['account'];
                      $sqlteachercheck = "select * from c$taccount where class = '$database'"; 
                    $resultteachercheck= mysqli_query($conn,$sqlteachercheck);
                    if($resultteachercheck){
                        $texist=mysqli_num_rows($resultcheck);
                        if($texist!=0){
                            $teacher=$taccount;
                        }
                     }
                }
            }
       */  
        $classcount-=1;
            $sqlchange ="INSERT INTO `d$database`(`account` , `name` ,  `register`) VALUES ('$account' , '$name', '0' )";
             mysqli_query($conn,$sqlchange);
           $sqllchange ="INSERT INTO `c$account`(`class` ,  `register`) VALUES ('$database' , '0' )";
             mysqli_query($conn,$sqllchange);
           $sqlbuy = "UPDATE `data` SET `classcount`='$classcount' WHERE `account` = '$account'";
             mysqli_query($con,$sqlbuy);
             echo "<script>alert('預約成功')</script>";
        } 
   else{                                          //預約過了
          echo "<script>alert('您已經預約過了')</script>";
      }
     

 echo '<meta http-equiv=REFRESH CONTENT=0;url=checkclasscount.php>';

?>