<?php
$identity=filter_input(INPUT_POST, 'identity');

if($identity==1){
    header("refresh:0;url=signup.html");
}
else if($identity==2){
       header("refresh:0;url=teachercheckcode.html");
}
else if($identity==3){
    header("refresh:0;url=frontcheckcode.html");
}
?>

