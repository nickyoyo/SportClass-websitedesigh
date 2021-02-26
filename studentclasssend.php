<?php 
$classcount=0;
 if(filter_input(INPUT_POST, 'submit')=="更改"){
               $classcount=filter_input(INPUT_POST, 'classcount');
          }
?>
<html>
    <head>
        <title>課堂購買</title>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
             <div  style="height:50px; padding:20px; position:absolute;left:30%;top:5%; " align="left" >     
       <img src="topic2.jpg"  width="100" height="100"> <br>  
         <font face="Microsoft JhengHei" size="5">    堂數選擇  </font> 
         <form action="" method="post" style="font-size:16px; line-height:150%;">
             <br>
                    <input type="radio" value=1 name="classcount" <?php if($classcount=='1'){echo'checked'; }?>>單堂-一堂400
                     <br>
                    <input type="radio" value=4 name="classcount"<?php if($classcount=='4'){echo'checked'; }?>>四堂-一堂300
                     <br>
                    <input type="radio" value=8 name="classcount"<?php if($classcount=='8'){echo'checked'; }?>>八堂-一堂200
           
            <br>   <br>         
  <input type="submit" name="submit" value="更改">
  <input type ="button" onclick="javascript:location.href='student.php'" value="回首頁">
        </form>
  </div>
 </body>
</html>
<?php session_start();
    $con =  mysqli_connect("127.0.0.1","root","","imtsystem");
    $conn =  mysqli_connect("127.0.0.1","root","","classhistory");
    mysqli_query($conn, 'SET NAMES utf8');
    mysqli_query($con, 'SET NAMES utf8');
     if($con->connect_error) {
          die("Coneection failed: ".$con_connect_error());
          }
          $account=$_SESSION['account'];       
    ?>
<body>
<div>

 
<table border="0" width="90%" align="center" cellspacing="10"
  cellpadding="2">
    <td align="right" width="30%">
	<font face="Microsoft JhengHei" color="black" size="4"> 
	<?php	
	$sqlname = "select * from `data`"; 
		$resultname= mysqli_query($con,$sqlname);	  
		while($data = mysqli_fetch_array($resultname)){
			if($data['account']==$account){
					$accountname=$data['name'];
					$phone=$data['phone'];
					$address=$data['address'];
			}
		}
	?>
	</font>
  </td>
</table>
<script>
function creditpay(index){
	var check=index;
	if(check===2){
	document.getElementById( 'cardnumber' ).type = 'text';
	}
	else{ 
	document.getElementById( 'cardnumber' ).type = 'hidden';
	} 
}
</script>

 <div style="height:50px; padding:20px;color:black;  position:absolute;left:50%;top:5%; " align="left" >
     <form action="classsend.php" method="post" style="font-size:16px; line-height:150%;">
            姓名   : <br>
                  <font size="4px" color="gray"><?php echo $accountname ?> </font>
            <br>
            帳號   : <br>
                <font size="4px" color="gray"><?php echo $account ?> </font>
            <br>
            電話   : <br>
                <input type="text" name="phone" value="<?php echo "0".$phone;?>">

            <br>
            總金額   : <br>
                <font size="4px" color="gray"><?php 
                if($classcount==1){
                      echo $classcount*400;
                }
                else if($classcount==4){
                     echo $classcount*300;
                }
                else if($classcount==8){
                     echo $classcount*200;
                }
                else{
                    echo $classcount*0;
                }
                ?> </font>
            <br>
            付款方式 : <br>
              <select name="pay" id="payselect" onChange="creditpay(this.selectedIndex);">
			   <option value="">-請選擇付款方式-</option>
			   <option value="facetoface">手機付費</option>
                           <option value="credit">信用卡</option>
               </select> 
			 <br>
		
			 <br>
                <input type="hidden" name="creditnumber" id="cardnumber" placeholder="信用卡卡號">
                 <input type="hidden" name="classcount" value="<?php echo $classcount?>" >
            <br> <br>
               <input type="submit" value="提交">
  </form>

</div>
</div>
</body>
</html>
