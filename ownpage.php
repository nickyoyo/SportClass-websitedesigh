<?php session_start();
if(isset($_SESSION['checkloginout'])==0){
     header("refresh:0;url=topic1.html");
}
?>

<html>
    <head>
        <title>個人頁面</title>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    </body>
</html>
<?php 
  $account = $_SESSION['account'];
   
 $con =  mysqli_connect("127.0.0.1","root","","imtsystem");
 $conn =  mysqli_connect("127.0.0.1","root","","classhistory");
 mysqli_query($con, 'SET NAMES utf8');
 
 if($con->connect_error) {
   die("Coneection failed: ".$con_connect_error());
   }
   
 $sqll = "select * from `c$account` ORDER BY `class` ASC"; 
 $resulta= mysqli_query($conn,$sqll);
      if(!$resulta)
	{   
           echo ("Error: ".mysqli_error($conn));
		exit();
	}
$savedatabase=array();
$dataname=0;        

while($data = mysqli_fetch_array($resulta)){         //$savedatabase[$dataname][3] 0還未上課，已繳費 
        $database = $data['class'];
        $register = (int)$data['register'];
   
        
        $yeat = (int)substr("$database", 0, 4); 
        $monthh = (int)substr("$database", 4, 2); 
        $datee = (int)substr("$database", 6, 2);
        $classs = (int)substr("$database", 8, 1);
        $savedatabase[$dataname][4]=$yeat.$monthh.$datee;
        $checktime = $yeat."-".$monthh."-".$datee;
   (int)$checklessday = strtotime($checktime)-strtotime("now");
   if($checklessday>0){  
        if($monthh<10){
            $monthh = "0".$monthh;
        }
        if($datee<10){
            $datee = "0".$datee;
        }
        $database = $yeat."-".$monthh."-".$datee;
         $day = date("D",strtotime(date("$database"))); 
          $savedatabase[$dataname][0]="$database";         //將年月日存進陣列
       
        
         
         $sqlclass1 = "select * from class";
         $result1= mysqli_query($conn,$sqlclass1);
         if(!$result1)
	{
            echo ("Error: ".mysqli_error($conn));
		exit();
	}
         $classpick = 0;
         while($data1 = mysqli_fetch_array($result1)){              
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
          $savedatabase[$dataname][3]=0;  
         $dataname++;
   }
}

 $sqlcount ="select * from `c$account` where register = '1' ORDER BY `class` ASC ";            //記錄總堂數
$resultcount = mysqli_query($conn,$sqlcount);
if(!$resultcount){
           echo ("Error: ".mysqli_error($conn));
           exit();
      }
$count=mysqli_num_rows($resultcount);  
   
 $sql = "select * from `data` ";
 $result= mysqli_query($con,$sql);
while ($data = mysqli_fetch_array($result)) {
       $checkaccount=$data['account'] ;
     if($checkaccount===$account){
         
         ?>
   <div  style="height:50px; padding:20px;" align="center">     
       <img src="topic2.jpg"  width="100" height="100"> <br>  
<font face="Microsoft JhengHei" color="#4A4E69" size="5" ><b>
      <?php  echo $data['name']."&nbsp&nbsp" ;?>
 </b> </font>
 <font face="Microsoft JhengHei" color="#4A4E69" size="4" ><b>  
     剩餘課堂數 :
       </b> </font>  
     <font face="Microsoft JhengHei" color="#4A4E69" size="3" ><b>  
      <?php  echo $data['classcount']."&nbsp&nbsp" ;?>  
        </b> </font>  
 <font face="Microsoft JhengHei" color="#4A4E69" size="4" ><b>  
     課堂使用期限 :
       </b> </font>  
     <font face="Microsoft JhengHei" color="#4A4E69" size="3" ><b>  
      <?php  echo $data['classdeadline']."&nbsp&nbsp" ;
      if($data['classdeadline']==NULL && $savedatabase!=NULL){
          echo "課堂使用期限已到期，請注意現在取消課程將不補充課堂給學員";
      }
      else if($data['classcount']!=0){
      echo "(".date('d', strtotime($data['classdeadline'])-strtotime("now"))."天)";      
      }
      else{
          if($data['classdeadline']!=0||$data['classdeadline']!=null){
             echo "(".date('d', strtotime($data['classdeadline'])-strtotime("now"))."天)"; 
          }
          else{
             echo "目前沒有購買紀錄";  
          }  
      }
      ?>  
        </b> </font>  
      
        <?php
        
         echo '<p>';
         break;
     }    
}
    ?>
     <font face="Microsoft JhengHei" color="#4A4E69" size="4" ><b>  
     帳號 :    <?php  echo $account."&nbsp&nbsp" ;?>  
       </b> </font>   
      <font face="Microsoft JhengHei" color="#4A4E69" size="4" ><b>  
          密碼 :    <?php  for($i=0;$i<strlen($_SESSION['password']);$i++){ echo "•" ;} echo "&nbsp&nbsp" ; ?>  
       </b> </font>   
        <font face="Microsoft JhengHei" color="#4A4E69" size="3" ><b>  
        <?php    echo '<a href="changepassword.php">更改密碼</a>  <br> <br>'; ?>  
       </b> </font>   
     
   <?php    
     echo '<p>';
   
    date_default_timezone_set('Asia/Taipei');
    $Y=(int)date("Y");
    $M=(int)date("m");
    $D=(int)date("d");
    $hour=(int)date("G");
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
   //$TIME=$Y.$M.$D.$whichclass;
   $TIME=$Y.$M.$D;
 //$savedatabase[$dataname][3] 0還未上課，已繳費 1未上課，未繳費 2請假，但繳費 3已上課，已繳費
  
  for($i=0;$i<$dataname;$i++){
      $timecheck=1;
  //    (int)$savedatabase[$i][4]=(int)($savedatabase[$i][4])/10;
      $lessday= ((int)($savedatabase[$i][4]) - (int)($TIME));
      if($savedatabase[$i][1]==1){
          if($lessday<1){
                  $timecheck=0;
          }
          $savedatabase[$i][5]="07:00~08:30";
      }
      if($savedatabase[$i][1]==2){
           if($lessday<1){
                  $timecheck=0;
          }
          $savedatabase[$i][5]="09:00~10:30";
      }
      if($savedatabase[$i][1]==3){
         if($lessday<1){
                  $timecheck=0;
          }
          $savedatabase[$i][5]="10:30~12:00";
      }
      if($savedatabase[$i][1]==4){
            if($lessday<0){
             $timecheck=0;
              }
            if($lessday==0&& $hour>=12 && $minute>0){
                $timecheck=0;
            }
          $savedatabase[$i][5]="14:30~16:00";
      }
      if($savedatabase[$i][1]==5){
          if($lessday<0){
             $timecheck=0;
              }
          if($lessday==0&& $hour>=12 && $minute>0){
                $timecheck=0;
            }
          $savedatabase[$i][5]="17:00~18:30";
      }
      if($savedatabase[$i][1]==6){
          if($lessday<0){
             $timecheck=0;
              }
          if($lessday==0&& $hour>=18 && $minute>0){
                $timecheck=0;
            }
          $savedatabase[$i][5]="19:00~20:30";
      }
      if($savedatabase[$i][1]==7){
          if($lessday<0){
             $timecheck=0;
              }
         if($lessday==0&& $hour>=18 && $minute>0){
                $timecheck=0;
            }
          $savedatabase[$i][5]="21:00~22:30";
      }

   //  $timecheck=$savedatabase[$i][4]-$TIME;
     
     echo $savedatabase[$i][0]."&nbsp&nbsp".$savedatabase[$i][5]."&nbsp&nbsp".$savedatabase[$i][2]."&nbsp&nbsp&nbsp&nbsp";
     if($savedatabase[$i][3]===0){
        if($timecheck===10){
            echo "已超過可取消時間";
        }    
        else{
             echo "<a href=\"ownpageleave.php?dataclass=".$savedatabase[$i][0].$savedatabase[$i][1]."\">取消預約</a>"."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
        }
     }
     if($savedatabase[$i][3]===1){
         echo "課程已結束";
     }
      echo '<br><br>';
  }
  if($dataname==0){
         echo "您尚未預約任何課程";
            echo '<br><br>';
     }
   echo '<a href="student.php">回首頁</a>  <br><br>';
?>

  </div>
</body>
</html>