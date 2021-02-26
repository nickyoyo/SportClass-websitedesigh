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

<?php session_start();

$account=$_SESSION['account'];
$con =  mysqli_connect("127.0.0.1","root","","imtsystem");
$conn =  mysqli_connect("127.0.0.1","root","","classhistory");
mysqli_query($conn, 'SET NAMES utf8');

$savedatabase = array();

if($conn->connect_error) {
   die("Coneection failed: ".$conn_connect_error());
   }
   $i=0;
     $sql = "select * from `c$account` "; 
    
      $result= mysqli_query($conn,$sql);
      if(!$result)
	{   
           echo ("Error: ".mysqli_error($conn));
		exit();
	}
 while($data = mysqli_fetch_array($result)){            //請假 還沒上課 但付錢了
        $database = $data['class'];
        $register = (int)$data['register'];
        $pay = (int)$data['pay'];
        if($register==0&&$pay==1){
        $yeat = (int)substr("$database", 0, 4); 
        $monthh = (int)substr("$database", 4, 2); 
        $datee = (int)substr("$database", 6, 2);
        $classs = (int)substr("$database", 8, 1);
         echo $database = $yeat."-".$monthh."-".$datee;
         echo "&nbsp";
         $day = date("D",strtotime(date("$database")));
         echo $classs;
         echo "&nbsp";
         $sqll = "select * from class";
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
              echo "武術課";
         }
        else if($classpick==2){
              echo "空翻課";
         }
        else if($classpick==3){
              echo "舞蹈課"; 
         }
       
         echo "<br><br>";
        }
  }
  
  
      $result1= mysqli_query($conn,$sql);
       if(!$result1)
	{
            echo ("Error: ".mysqli_error($conn));
		exit();
	}
 while($data = mysqli_fetch_array($result1)){                //取消預約 還沒上課 也還沒付錢
        $database = $data['class'];
        $register = (int)$data['register'];
        $pay = (int)$data['pay'];
        if($register==0&&$pay==0){
        $yeat = (int)substr("$database", 0, 4); 
        $monthh = (int)substr("$database", 4, 2); 
        $datee = (int)substr("$database", 6, 2);
        $classs = (int)substr("$database", 8, 1);
       
         echo $database = $yeat."-".$monthh."-".$datee;
         echo "&nbsp";
         $day = date("D",strtotime(date("$database")));
         echo $classs;
         echo "&nbsp";
         $sqll = "select * from class";
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
              echo "武術課";
         }
        else if($classpick==2){
              echo "空翻課";
         }
        else if($classpick==3){
              echo "舞蹈課";
         }  
        
         echo "<br><br>";
        }
  }
 

?>

<html>
    <br>
    <br>
    <input type ="button" onclick="javascript:location.href='flower.php'" value="回到首頁">
</html>