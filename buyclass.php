<?php session_start();
if(isset($_SESSION['checkloginout'])==0){
     header("refresh:0;url=topic1.html");
      exit();
}
$con =  mysqli_connect("127.0.0.1","root","","imtsystem");
 $conn =  mysqli_connect("127.0.0.1","root","","classhistory");
 mysqli_query($con, 'SET NAMES utf8');
 
 if($con->connect_error) {
   die("Coneection failed: ".$con_connect_error());
 }
 $sqll = "select * from `buyclass` ORDER BY `account` ASC"; 
 $resulta= mysqli_query($conn,$sqll);
      if(!$resulta)
	{   
           echo ("Error: ".mysqli_error($conn));
		exit();
	}
$savedatabase=array();
$dataname=0;        
      while($data = mysqli_fetch_array($resulta)){         //$savedatabase[$dataname][3] 0還未上課，已繳費 
        $classcount = $data['classcount'];
        $account = $data['account'];
        $savedatabase[$dataname][0]=$account;
        $savedatabase[$dataname][1]=$classcount;
        $dataname++;
        }
?>

<html>
    <head>
        <title>購買清單</title>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
       <div  style="height:50px; padding:20px;" align="center">  
            <img src="topic2.jpg"  width="100" height="100"><br><br>
            <font face="Microsoft JhengHei" color="#4A4E69" size="4" >
      <b>帳號 &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;購買課堂數 &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;</b><br><br>  </font>      
               <font face="Microsoft JhengHei" color="#4A4E69" size="3" >
   
   
             <?php 
        for($i=0;$i<$dataname;$i++){
         echo $savedatabase[$i][0]."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$savedatabase[$i][1]."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
       echo '<a href="classsend1.php?account='.$savedatabase[$i][0].'&classcount='.$savedatabase[$i][1].' " >繳費</a>';
       echo '<br>';
       }
             ?>    
                  <br>  
         <input type ="button" onclick="javascript:location.href='front_office.php'" value="回首頁">
    </div>
 </body>
</html>

