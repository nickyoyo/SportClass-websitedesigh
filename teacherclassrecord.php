<?php session_start();
if(isset($_SESSION['checkloginout'])==0){
     header("refresh:0;url=topic1.html");
      exit();
}
?>
<html>
    <head>
        <title>課程紀錄</title>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
                     <div  style="height:50px; padding:20px;" align="center">     
       <img src="topic2.jpg"  width="100" height="100"> <br>  
        <b><font face="Microsoft JhengHei" size="5">課程紀錄</b></font>   
 <font face="Microsoft JhengHei" color="#4A4E69" size="3" ><b>  
        <?php  echo "&nbsp&nbsp&nbsp&nbsp";  echo '<a href="teacherhistoryclassrecord.php">歷史課程紀錄</a>  <br> <br>'; ?>  
       </b> </font> 
   
<?php 
$count1=0;
echo '<p>';
  $account = $_SESSION['account'];
   
 $con =  mysqli_connect("127.0.0.1","root","","imtsystem");
 $conn =  mysqli_connect("127.0.0.1","root","","classhistory");
 mysqli_query($con, 'SET NAMES utf8');
 
 if($con->connect_error) {
   die("Coneection failed: ".$con_connect_error());
   }

$sqlcount ="select * from `c$account` ORDER BY `class` ASC";            //記錄總堂數
$resultcount = mysqli_query($conn,$sqlcount);
if(!$resultcount){
           echo ("Error: ".mysqli_error($conn));
           exit();
      }
$count=mysqli_num_rows($resultcount);

 $sqll = "select * from `c$account` ORDER BY `class` ASC"; 
 $resulta= mysqli_query($conn,$sqll);
      if(!$resulta)
	{   
           echo ("Error: ".mysqli_error($conn));
		exit();
	}
$savedatabase=array();
$dataname=0;        

while($data = mysqli_fetch_array($resulta)){  
        $database = $data['class'];
         $savedatabase[$dataname][3]=$database;
        $yeat = (int)substr("$database", 0, 4); 
        $monthh = (int)substr("$database", 4, 2); 
        $datee = (int)substr("$database", 6, 2);
        $classs = (int)substr("$database", 8, 1);
         $database = $yeat."-".$monthh."-".$datee;
          $day = date("D",strtotime(date("$database")));
            $checktime = $yeat."-".$monthh."-".$datee;
         (int)$checklessday = strtotime($checktime)-strtotime("now");
          if($checklessday>0){
          if($monthh<10){
             $savedatabase[$dataname][0]=$yeat."-"."0".$monthh."-".$datee;
            if($datee<10){
            $savedatabase[$dataname][0]=$yeat."-"."0".$monthh."-"."0".$datee;
            
            }
         }
         else if($datee<10){
              $savedatabase[$dataname][0]=$yeat."-".$monthh."-"."0".$datee;
         }

     $sqlclasstype = "select * from class";
         $resulttype= mysqli_query($conn,$sqlclasstype);
         if(!$resulttype)
	{
            echo ("Error: ".mysqli_error($conn));
		exit();
	}
         $classpick = 0;
         while($datatype = mysqli_fetch_array($resulttype)){              
             if($datatype['time']==$classs){
             $classpick = $datatype[$day];
             break;
             }
         }
         if($classpick==1){
           //   echo "武術課";
             $savedatabase[$dataname][1]=$classs;
               $savedatabase[$dataname][2]="武術課";
         }
        else if($classpick==2){
           //   echo "空翻課";
            $savedatabase[$dataname][1]=$classs;
              $savedatabase[$dataname][2]="空翻課";
         }
        else if($classpick==3){
           //   echo "舞蹈課";
            $savedatabase[$dataname][1]=$classs;
              $savedatabase[$dataname][2]="舞蹈課";
         }  
          $dataname++; 
          }
}
  
  for($i=0;$i<$dataname;$i++){
      if($savedatabase[$i][1]==1){
          $savedatabase[$i][1]="07:00~08:30";
      }
      if($savedatabase[$i][1]==2){
          $savedatabase[$i][1]="09:00~10:30";
      }
      if($savedatabase[$i][1]==3){
          $savedatabase[$i][1]="10:30~12:00";
      }
      if($savedatabase[$i][1]==4){
          $savedatabase[$i][1]="14:30~16:00";
      }
      if($savedatabase[$i][1]==5){
          $savedatabase[$i][1]="17:00~18:30";
      }
      if($savedatabase[$i][1]==6){
          $savedatabase[$i][1]="19:00~20:30";
      }
      if($savedatabase[$i][1]==7){
          $savedatabase[$i][1]="21:00~22:30";
      }
      //echo strtotime($savedatabase[$i][0])."&nbsp&nbsp".strtotime("now")."&nbsp&nbsp";
      if(strtotime($savedatabase[$i][0])>=strtotime("now")){
          $count1++;
      echo $savedatabase[$i][0]."&nbsp&nbsp".$savedatabase[$i][1]."&nbsp&nbsp".$savedatabase[$i][2]."&nbsp&nbsp&nbsp&nbsp";
      echo "<a href=\"historyclassmember.php?dataclass=".$savedatabase[$i][3]."\">學員名單</a>";
      echo '<br><br>';
      }
  }
  if($count1==0){
         echo "您目前無任何課堂";
            echo '<br><br>';
     }
   echo '<p><a href="teacher.php">回首頁</a>  <br><br>';
?>

    </div>
    </body>
</html>