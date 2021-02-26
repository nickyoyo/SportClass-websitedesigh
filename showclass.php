<?php session_start();
if(isset($_SESSION['checkloginout'])==0){
     header("refresh:0;url=topic1.html");
      exit();
}
?>

<?php 
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
   $datasave=array();
    $con =  mysqli_connect("127.0.0.1","root","","imtsystem");
    $conn =  mysqli_connect("127.0.0.1","root","","classhistory");
    mysqli_query($con, 'SET NAMES utf8');
    mysqli_query($conn, 'SET NAMES utf8');
      $count=0; 
if($con->connect_error) {
   die("Coneection failed: ".$con_connect_error());
   }  
 if($conn->connect_error) {
   die("Coneection failed: ".$con_connect_error());
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
     $sql = "select * from d$database "; 
     $result1= mysqli_query($conn,$sql);
 if($result1)    
    while($data = mysqli_fetch_array($result1)){         //$savedatabase[$dataname][3] 0還未上課，已繳費
        @$name = $data['name'];
        @$pay = (int)$data['pay'];
        @$account = $data['account'];
        if($pay==1){
            $datasave[$count][0]=$name;
            $datasave[$count][1]="已繳費";
            $datasave[$count][2]=$account;
            $count++;
        }
    }   

 $sqll = "select * from d$database "; 
     $result2= mysqli_query($conn,$sqll);
  if($result2)
    while($data = mysqli_fetch_array($result2)){         //$savedatabase[$dataname][3] 0還未上課，已繳費
        @$name = $data['name'];
        @$pay = (int)$data['pay'];
        @$account = $data['account'];
        if($pay==0){
            $datasave[$count][0]=$name;
            $datasave[$count][1]="尚未繳費";
            $datasave[$count][2]=$account;
            $count++;
        }
        
}
?>
<html>
    <font face="微軟正黑體" size="5"><?php echo "學員名單 <br>   "; ?></font>
</html>
<?php
if($count>0){
for($i=0;$i<$count;$i++){
    echo $datasave[$i][0]."&nbsp&nbsp".$datasave[$i][1]."&nbsp&nbsp";
     $saccount = "SELECT * FROM `data`"; 
     $result2= mysqli_query($con,$saccount);
    while($data = mysqli_fetch_array($result2)){
        
        if($data['account']==$datasave[$i][2]){
            echo "0".$data['phone'].'<br>';
            break;
        }
    }
 }
}
else{
    echo "目前此課程無學員";
    echo '<br>';
}
echo '<br><a href="classcheck.html">回課表</a> &nbsp&nbsp';
echo '<a href="front_office.html">回首頁</a>  <br> <br>';

?>