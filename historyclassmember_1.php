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
          <div  style="height:50px; padding:20px;" align="center">     
       <img src="topic2.jpg"  width="100" height="100"> <br> <br>  
       
<?php 
$account=$_SESSION['account'];
$database = filter_input(INPUT_GET, 'dataclass'); 

  $con =  mysqli_connect("127.0.0.1","root","","imtsystem");
    $conn =  mysqli_connect("127.0.0.1","root","","classhistory");
    mysqli_query($conn, 'SET NAMES utf8');
    
    if($con->connect_error) {
   die("Coneection failed: ".$con_connect_error());
   }  
   $saveaccount = array();
   $accountcount=0;
   $savedatabase=array();
   $database1=$database;
        $yeat = (int)substr("$database", 0, 4); 
        $monthh = (int)substr("$database", 4, 2); 
        $datee = (int)substr("$database", 6, 2);
        $classs = (int)substr("$database", 8, 1);
         $database = $yeat."-".$monthh."-".$datee;
          $day = date("D",strtotime(date("$database"))); 
         $savedatabase[0][0]=$database;
         if($classs==1){
          $savedatabase[0][1]="07:00~08:30";
      }
      if($classs==2){
          $savedatabase[0][1]="09:00~10:30";
      }
      if($classs==3){
          $savedatabase[0][1]="10:30~12:00";
      }
      if($classs==4){
          $savedatabase[0][1]="14:30~16:00";
      }
      if($classs==5){
          $savedatabase[0][1]="17:00~18:30";
      }
      if($classs==6){
          $savedatabase[0][1]="19:00~20:30";
      }
      if($classs==7){
          $savedatabase[0][1]="21:00~22:30";
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
               $savedatabase[0][2]="武術課";
         }
        else if($classpick==2){
              $savedatabase[0][2]="空翻課";
         }
        else if($classpick==3){
              $savedatabase[0][2]="舞蹈課";
         }  
    ?>
       
         
                     <font face="Microsoft JhengHei" color="#4A4E69" size="4" >
                 <b><?php    echo $savedatabase[0][0]."&nbsp&nbsp".$savedatabase[0][1]."&nbsp&nbsp".$savedatabase[0][2];  ?></b><br><br>  </font>            
               
                 <font face="Microsoft JhengHei" color="#4A4E69" size="3" >
    <?php    
    $sqlmember = "select * from `d$database1` ";
     $resultmember= mysqli_query($conn,$sqlmember);
    while($data = mysqli_fetch_array($resultmember)){          
        $dataaccount = $data['account'];
        $dataname = $data['name'];
        $register = (int)$data['register'];
            $saveaccount[$accountcount][0]=$dataname;  
            $saveaccount[$accountcount][1]=$dataaccount;
              $saveaccount[$accountcount][2]=$register;
            $accountcount++;   
     }
     
    
     ?>
      <font face="Microsoft JhengHei" color="#4A4E69" size="4" >
      <b>學員名字 &nbsp;&nbsp;&nbsp;&nbsp;報到&nbsp;&nbsp;&nbsp;</b><br><br>  </font>              
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
                            $saveaccount[$i][3]= $dataaccount ;
                           break;
                       }           
                    }
             $namelength=strlen($saveaccount[$i][0]);
             echo  $saveaccount[$i][0];
             for($j=0;$j<20-$namelength;$j++){
                 echo "&nbsp";
             }   
               if($saveaccount[$i][2]==1){
                 echo "到課"."&nbsp&nbsp&nbsp&nbsp".'<br>'.'<br>';
             }
             else{
                  echo "未到課".'<br>'.'<br>';
             }
        //      echo $saveaccount[$i][2];
     }
echo '<a href="teacherhistoryclassrecord.php">回歷史課程紀錄</a>  <br> <br>';
     ?>
</font>       
          </div>
    </body>
</html>