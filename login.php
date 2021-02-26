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
<?php  session_start();
$_SESSION['checkloginout']=1;
$_SESSION['change']=0;

$account=filter_input(INPUT_POST, 'account');
$password1=filter_input(INPUT_POST, 'password');
$checkvercode=filter_input(INPUT_POST, 'checkvercode');
$exist=2;
$con =  mysqli_connect("127.0.0.1","root","","imtsystem");
mysqli_query($con, 'SET NAMES utf8');
$_SESSION['password']=$password1;

if($con->connect_error) {
   die("Coneection failed: ".$con_connect_error());
   }    
   
if((!empty($_SESSION['checkvercode'])) && (!empty(filter_input(INPUT_POST, 'checkvercode')))){  //判斷此兩個變數是否為空
    
     if($_SESSION['checkvercode'] != filter_input(INPUT_POST, 'checkvercode')){
         
          $_SESSION['checkvercode'] = ''; //比對正確後，清空將check_word值
         echo "<script>alert('驗證碼輸入有誤');</script>";
           header("refresh:0;url=login.html");
         exit();
     }

}
else{
    echo "<script>alert('請輸入驗證碼');</script>";
           header("refresh:0;url=login.html");
            exit();
}
   
if($account && $password1){
    $sqa = "select * from data where account = '$account'";          //檢查帳號
    $result=mysqli_query($con,$sqa);
    $exist=mysqli_num_rows($result);
    if($exist==1){
      $password = sha1($password1);
      $sql = "select * from data where account = '$account' and password='$password'";
      $result=mysqli_query($con,$sql);
      $exist=mysqli_num_rows($result);
      if($exist==1){
     //  echo "登入成功";
        $_SESSION['account'] = $account;
        
      $sqll = "select * from `data` "; 
      $result1= mysqli_query($con,$sqll);
      if(!$result1)
	{   
           echo ("Error: ".mysqli_error($conn));
		exit();
	}
    while($data = mysqli_fetch_array($result1)){            //請假 還沒上課 但付錢了
           $accountcheck = $data['account'];
         if($accountcheck==$account){
           $_SESSION['identity'] = $data['identity'];
           break;
         }  
        }
   header("refresh:1;url=flower.php");
  }
    else if($exist==0){                                      //密碼錯
        echo "<script>alert('密碼錯誤');</script>";
        header("refresh:1;url=login.html");
    }
  }
  else{                                                      
         echo "<script>alert('帳號不存在');</script>";
       header("refresh:1;url=login.html");
  }     
}
else if(!$account || !$password){
          echo "<script>alert('帳密有誤');</script>";
        header("refresh:1;url=login.html");
   }
   
   $con->close();

   ?>