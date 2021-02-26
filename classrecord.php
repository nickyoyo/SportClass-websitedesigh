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
         <font face="Microsoft JhengHei" size="5">    歷史課程紀錄  </font> 

<?php
echo '<p>';

  $account = $_SESSION['account'];
   
 $con =  mysqli_connect("127.0.0.1","root","","imtsystem");
 $conn =  mysqli_connect("127.0.0.1","root","","classhistory");
 mysqli_query($con, 'SET NAMES utf8');
 
 if($con->connect_error) {
   die("Coneection failed: ".$con_connect_error());
   }

$sqlcount ="select * from `c$account` ORDER BY `class` DESC";            //記錄總堂數
$resultcount = mysqli_query($conn,$sqlcount);
if(!$resultcount){
           echo ("Error: ".mysqli_error($conn));
           exit();
      }
$count=mysqli_num_rows($resultcount);

 $sqll = "select * from `c$account` ORDER BY `class` DESC"; 
 $resulta= mysqli_query($conn,$sqll);
      if(!$resulta)
	{   
           echo ("Error: ".mysqli_error($conn));
		exit();
	}

$dataname=0;        

while($data = mysqli_fetch_array($resulta)){         //$savedatabase[$dataname][3] 0還未上課，已繳費
        if($dataname>$count)break;   
        $database = $data['class'];
        $register = $data['register'];
        
        $savedatabase[$dataname][4]=$database;
        $yeat = (int)substr("$database", 0, 4); 
        $monthh = (int)substr("$database", 4, 2); 
        $datee = (int)substr("$database", 6, 2);
        $classs = (int)substr("$database", 8, 1);
         $checktime = $yeat."-".$monthh."-".$datee;
    (int)$checklessday = strtotime($checktime)-strtotime("now");
   if($checklessday<0){
        $savedatabase[$dataname][6]=(int)$register;
       if($monthh<10){
            $monthh = "0".$monthh;
        }
        if($datee<10){
            $datee = "0".$datee;
        }
        $database = $yeat."-".$monthh."-".$datee;
         $day = date("D",strtotime(date("$database"))); 
          $savedatabase[$dataname][0]="$database";         //將年月日存進陣列
        
        
         
         $sqlclass2 = "select * from class";
         $result2= mysqli_query($conn,$sqlclass2);
         if(!$result2)
	{
            echo ("Error: ".mysqli_error($conn));
		exit();
	}
         $classpick = 0;
         while($data1 = mysqli_fetch_array($result2)){              
             if($data1['time']==$classs){
             $classpick = $data1[$day];
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
          $savedatabase[$dataname][3]=1;  
         $dataname++;
   }    
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
   
 //$savedatabase[$dataname][3] 0還未上課，已繳費 1未上課，未繳費 2請假，但繳費 3已上課，已繳費
  
  for($i=0;$i<$dataname;$i++){
      if($savedatabase[$i][1]==1){
          $savedatabase[$i][5]="07:00~08:30";
      }
      if($savedatabase[$i][1]==2){
          $savedatabase[$i][5]="09:00~10:30";
      }
      if($savedatabase[$i][1]==3){
          $savedatabase[$i][5]="10:30~12:00";
      }
      if($savedatabase[$i][1]==4){
          $savedatabase[$i][5]="14:30~16:00";
      }
      if($savedatabase[$i][1]==5){
          $savedatabase[$i][5]="17:00~18:30";
      }
      if($savedatabase[$i][1]==6){
          $savedatabase[$i][5]="19:00~20:30";
      }
      if($savedatabase[$i][1]==7){
          $savedatabase[$i][5]="21:00~22:30";
      }

     $timecheck=$savedatabase[$i][4]-$TIME;
     
     echo $savedatabase[$i][0]."&nbsp&nbsp".$savedatabase[$i][5]."&nbsp&nbsp".$savedatabase[$i][2]."&nbsp&nbsp&nbsp&nbsp";
    if($savedatabase[$i][6]==1){
        echo "到課"."&nbsp&nbsp&nbsp&nbsp";
    }
    else{
        echo "未到課";
    }
      echo '<br><br>';
  }
  if($dataname==0){
         echo "您尚未上過任何課程";
            echo '<br><br>';
     }
   echo '<a href="student.php">回首頁</a>  <br><br>';
?>

        </div>
    </body>
</html>