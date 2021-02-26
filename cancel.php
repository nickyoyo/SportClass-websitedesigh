<?php session_start();
if(isset($_SESSION['checkloginout'])==0){
     header("refresh:0;url=topic1.html");
      exit();
}
?>

<html>
    <head>
        <title>預約/請假</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1 align="left"><font face="Microsoft JhengHei" color="#4A4E69" size="8" ><b>課程清單</b></font></h1>
    </body>
</html>

<?php 
$today=date("Y-m-d",strtotime("+1 day"));
$today=str_replace("-","","$today");


$account=$_SESSION['account'];
$con =  mysqli_connect("127.0.0.1","root","","imtsystem");
$conn =  mysqli_connect("127.0.0.1","root","","classhistory");
mysqli_query($conn, 'SET NAMES utf8');

$savedatabase = array();
$dataname=0;
if($conn->connect_error) {
   die("Coneection failed: ".$conn_connect_error());
   }
   
     $sql = "select * from `c$account`  ORDER BY `class` ASC"; 
    
      $result= mysqli_query($conn,$sql);
      if(!$result)
	{   
           echo ("Error: ".mysqli_error($conn));
		exit();
	}
 while($data = mysqli_fetch_array($result)){            //請假 還沒上課 但付錢了
        $database = $data['class'];
        $register = (int)$data['register'];
        
        if($register==0){
        $savedatabase[$dataname][4]=$database;
        $yeat = (int)substr("$database", 0, 4); 
        $monthh = (int)substr("$database", 4, 2); 
        $datee = (int)substr("$database", 6, 2);
        $classs = (int)substr("$database", 8, 1);
     
        /*  
         echo "&nbsp";
         echo $classs;
         echo "&nbsp";*/
        
        $database = $yeat."-".$monthh."-".$datee;
         $day = date("D",strtotime(date("$database")));
         $sqll = "select * from class";
         
         $savedatabase[$dataname][0]="$database";  //將年月日存進陣列
         
         $result2= mysqli_query($conn,$sqll);
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
            //  echo "武術課";
             $savedatabase[$dataname][1]=$classs;
              $savedatabase[$dataname][2]="武術課";
         }
        else if($classpick==2){
            //  echo "空翻課";
            $savedatabase[$dataname][1]=$classs;
              $savedatabase[$dataname][2]="空翻課";
         }
        else if($classpick==3){
           //   echo "舞蹈課";
            $savedatabase[$dataname][1]=$classs;
              $savedatabase[$dataname][2]="舞蹈課";
         }
    //     echo "&nbsp請假";
         $savedatabase[$dataname][3]=0;   // 0==請假
    //     echo "<br><br>";
         $dataname++;
        }
        
        if($register==2&&$pay==1){
        $savedatabase[$dataname][4]=$database;
        $yeat = (int)substr("$database", 0, 4); 
        $monthh = (int)substr("$database", 4, 2); 
        $datee = (int)substr("$database", 6, 2);
        $classs = (int)substr("$database", 8, 1);
     
        /*  
         echo "&nbsp";
         echo $classs;
         echo "&nbsp";*/
        
        $database = $yeat."-".$monthh."-".$datee;
         $day = date("D",strtotime(date("$database")));
         $sqll = "select * from class";
         
         $savedatabase[$dataname][0]="$database";  //將年月日存進陣列
         
         $result2= mysqli_query($conn,$sqll);
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
            //  echo "武術課";
             $savedatabase[$dataname][1]=$classs;
              $savedatabase[$dataname][2]="武術課";
         }
        else if($classpick==2){
            //  echo "空翻課";
            $savedatabase[$dataname][1]=$classs;
              $savedatabase[$dataname][2]="空翻課";
         }
        else if($classpick==3){
           //   echo "舞蹈課";
            $savedatabase[$dataname][1]=$classs;
              $savedatabase[$dataname][2]="舞蹈課";
         }
    //     echo "&nbsp請假";
   //      $savedatabase[$dataname][3]=1;  
    //     echo "<br><br>";
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
  
  for($i=0;$i<$dataname;$i++){
        if($savedatabase[$i][1]==1){
          $savedatabase[$i][5]=" 7:00~8:30 ";
      }
      if($savedatabase[$i][1]==2){
          $savedatabase[$i][5]=" 9:00~10:30";
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
     echo $savedatabase[$i][0]."&nbsp&nbsp".$savedatabase[$i][5]."&nbsp&nbsp".$savedatabase[$i][2]."&nbsp&nbsp";
  /*   if($savedatabase[$i][3]===0){                                                    // 0==請假
        if($timecheck<=10){
            echo "已超過可請假時間";
        }
        else{
              echo "<a href=\"delete.php?dataclass=".$savedatabase[$i][0].$savedatabase[$i][1]."\">請假</a>";
           }
     }*/
   /*  else */
 //    if($savedatabase[$i][3]===1){                                                    // 1==取消預約
     echo "<a href=\"delete.php?dataclass=".$savedatabase[$i][0].$savedatabase[$i][1]."\">取消預約</a>";
  //   }
  /*   else if($savedatabase[$i][3]===2){                                                    // 1==取消預約
     if((int)$today < (int)$savedatabase[$i][0]) 
        echo "<a href=\"delete.php?dataclass=".$savedatabase[$i][0].$savedatabase[$i][1]."\">取消請假</a>";
        echo "&nbsp";
        echo "<a href=\"takenewclass.php?dataclass=".$savedatabase[$i][0].$savedatabase[$i][1]."\">補課</a>";
     }*/
    
     echo "<br><br>";
  }
   if($dataname==0){
         echo "您尚未預約任何課程";
     }
?>

<html>
    <br>
    <br>
    <br>
    <input type ="button" onclick="javascript:location.href='flower.php'" value="回到首頁">
</html>