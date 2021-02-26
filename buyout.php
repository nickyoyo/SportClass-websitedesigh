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
<?php 
   $pay=filter_input(INPUT_POST, 'pay');
   $creditnumber=filter_input(INPUT_POST, 'creditnumber');
   if($pay=="facetoface"){
      echo "<script>alert('購買成功，請在三天內至櫃臺完成繳費，否則將取消購買')</script>";
      echo '<meta http-equiv=REFRESH CONTENT=0;url=student.php>';
        exit();
   }
   if($pay=="credit"){
        echo "<script>alert('購買成功，請前往個人頁面確認')</script>";
        echo '<meta http-equiv=REFRESH CONTENT=0;url=student.php>';
        exit();
   }
?>
