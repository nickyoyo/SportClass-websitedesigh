<?php   session_start();
  
date_default_timezone_set('Asia/Taipei');
        $Y=(int)date("Y");
        $M=(int)date("m");
        $D=(int)date("d");
        $hour=(int)date("G");
        $minute=(int)date("i");

       $TIME=$Y.$M.$D;

 $con =  mysqli_connect("127.0.0.1","root","","imtsystem");
 $conn =  mysqli_connect("127.0.0.1","root","","classhistory");
 mysqli_query($con, 'SET NAMES utf8');
 
 if($con->connect_error) {
   die("Coneection failed: ".$con_connect_error());
   }
   
$sql = "select * from `data` ORDER BY `identity` ASC ";

 $result= mysqli_query($con,$sql);
 $i=0;
while ($data = mysqli_fetch_array($result)) {
       $mailaccount=$data['account'] ;   
       $mailemail=$data['email'];
       $mailname=$data['name'];
       $mailclassdeadline=$data['classdeadline'];
       (int)$mailmailcount=(int)$data['mailcount'];
       $mailidentity=$data['identity'];
       //提醒課程使用期限即將到期

 

       
    if($mailidentity==1){ 
      (int)$checklessday = date('j', strtotime($data['classdeadline'])-strtotime("now"));
 //echo $mailaccount."&nbsp".$checklessday."&nbsp".$mailmailcount.'<br/>';
  //   echo '<meta http-equiv=REFRESH CONTENT=0;url=student.html>';


  if(($checklessday==3&&$mailmailcount==0)||($checklessday==1&&$mailmailcount==1)){

        //phpinfo();
        //設定time out
        set_time_limit(120);
        //echo !extension_loaded('openssl')?"Not Available":"Available";

        require_once("./PHPMailer-5.2.9/PHPMailerAutoload.php"); //記得引入檔案 
        $mail = new PHPMailer;

        //$mail->SMTPDebug = 3; // 開啟偵錯模式
        $mail->CharSet = "utf-8";
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'zxcasdqwe8800@gmail.com'; // SMTP username
        $mail->Password = 'qwertyuiop[]\0123456789'; // SMTP password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587; // TCP port to connect to

        $mail->setFrom('zxcasdqwe8800@gmail.com', '長興極限空間'); //寄件的Gmail
        $mail->addAddress($mailemail, $mailname); // 收件的信箱

        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = "課程使用期限即將到期";
        // 信件標題
        $mail->Body = "這是系統自動信件，不需回復，你的課程使用期限僅剩 $checklessday 天，請盡早使用完畢";
        //信件內容(html版，就是可以有html標籤的如粗體、斜體之類)
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if(!$mail->send()) {
         echo 'Message could not be sent.';
         echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
         echo '';
        }
          $mailmailcount++;
            $sqlmailcount = "UPDATE `data` SET `mailcount`='$mailmailcount' WHERE `account` = '$mailaccount'";
            mysqli_query($con,$sqlmailcount);
          }
          }
  if($mailidentity==2){
      
          $sqlteacher = "select * from `c$mailaccount` ORDER BY `class` ASC"; 
          $resulta= mysqli_query($conn,$sqlteacher);
             if(!$resulta)
               {   
                  echo ("Error: ".mysqli_error($conn));
                       exit();
               }
       while($data = mysqli_fetch_array($resulta)){         
               $database = $data['class'];

               $yeat = (int)substr("$database", 0, 4); 
               $monthh = (int)substr("$database", 4, 2); 
               $datee = (int)substr("$database", 6, 2);
               $classs = (int)substr("$database", 8, 1);
               $classtime=$yeat."-".$monthh."-".$datee;
              (int)$checklessday = date('j', strtotime($classtime)-strtotime("now"));
         //      echo $mailaccount."&nbsp".$checklessday."&nbsp".$mailmailcount.'<br/>';
     //echo $mailname."&nbsp".$classtimeshow."&nbsp".$classtype;       
         //   echo  date('y-m-d', strtotime($classtime))."&nbsp".$checklessday."&nbsp".date('y-m-d',strtotime("now"));
     if($checklessday==2){
            //寄信給老師，提醒明天要上課
            $day = date("D",strtotime(date("$classtime"))); 
           $sqlclass2 = "select * from class";
         $resultb= mysqli_query($conn,$sqlclass2);
         if(!$resultb)
            {
            echo ("Error: ".mysqli_error($conn));
		exit();
            }
          while($data1 = mysqli_fetch_array($resultb)){              
             if($data1['time']==$classs){
             $classpick = $data1[$day];
             break;
             }
         }
         if($classpick==1){
               $classtype="武術課";
         }
        else if($classpick==2){
              $classtype="空翻課";
         }
        else if($classpick==3){
              $classtype="舞蹈課";
         }  
          
        if($classs==1){
            $classtimeshow="7:00~8:30";
        }
        if($classs==2){
            $classtimeshow="9:00~10:30";
        }
        if($classs==3){
            $classtimeshow="10:30~12:00";
        }
        if($classs==4){
            $classtimeshow="14:30~16:00";
        }
        if($classs==5){
            $classtimeshow="17:00~18:30";
        }
        if($classs==6){
            $classtimeshow="19:00~20:30";
        }
        if($classs==7){
            $classtimeshow="21:00~22:30";
        }        

                   //phpinfo();
          //設定time out
          set_time_limit(120);
          //echo !extension_loaded('openssl')?"Not Available":"Available";

          require_once("./PHPMailer-5.2.9/PHPMailerAutoload.php"); //記得引入檔案 
          $mail = new PHPMailer;

          //$mail->SMTPDebug = 3; // 開啟偵錯模式
          $mail->CharSet = "utf-8";
          $mail->isSMTP(); // Set mailer to use SMTP
          $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
          $mail->SMTPAuth = true; // Enable SMTP authentication
          $mail->Username = 'zxcasdqwe8800@gmail.com'; // SMTP username
          $mail->Password = 'qwertyuiop[]\0123456789'; // SMTP password
          $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
          $mail->Port = 587; // TCP port to connect to

          $mail->setFrom('zxcasdqwe8800@gmail.com', '長青極限教室'); //寄件的Gmail
          $mail->addAddress($mailemail, $mailname); // 收件的信箱

          $mail->isHTML(true); // Set email format to HTML
          $mail->Subject = "上課提醒";
          // 信件標題
          $mail->Body = "這是系統自動信件，不需回復，$mailname 老師您明天$classtimeshow 有$classtype ";
          //信件內容(html版，就是可以有html標籤的如粗體、斜體之類)
          $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

              if(!$mail->send()) {
               echo 'Message could not be sent.';
               echo 'Mailer Error: ' . $mail->ErrorInfo;
              }  
              else {
               echo '';
                }
                
                //寄信給學生，提醒明天要上課
          $sqlstudent = "select * from `d$database` "; 
          $results= mysqli_query($conn,$sqlstudent);
             if(!$results)
               {   
                  echo ("Error: ".mysqli_error($conn));
                       exit();
               }     
           while($data2 = mysqli_fetch_array($results)){
                $studentaccount=$data2['account'];
                
               $sqlstudentdata = "select * from `data` "; 
               $resultsd= mysqli_query($con,$sqlstudentdata);
                   if(!$resultsd)
                      {   
                        echo ("Error: ".mysqli_error($conn));
                             exit();
                      }     
                 while($data3 = mysqli_fetch_array($resultsd)){
                    
                     if($studentaccount==$data3['account']){
                         $studentmail=$data3['email'];
                         $studentname=$data3['name'];
                        //設定time out
                        set_time_limit(200);
                        //echo !extension_loaded('openssl')?"Not Available":"Available";

                        require_once("./PHPMailer-5.2.9/PHPMailerAutoload.php"); //記得引入檔案 
                        $mail = new PHPMailer;

                        //$mail->SMTPDebug = 3; // 開啟偵錯模式
                        $mail->CharSet = "utf-8";
                        $mail->isSMTP(); // Set mailer to use SMTP
                        $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
                        $mail->SMTPAuth = true; // Enable SMTP authentication
                        $mail->Username = 'zxcasdqwe8800@gmail.com'; // SMTP username
                        $mail->Password = 'qwertyuiop[]\0123456789'; // SMTP password
                        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
                        $mail->Port = 587; // TCP port to connect to

                        $mail->setFrom('zxcasdqwe8800@gmail.com', '長青極限教室'); //寄件的Gmail
                        $mail->addAddress($studentmail, $studentname); // 收件的信箱

                        $mail->isHTML(true); // Set email format to HTML
                        $mail->Subject = "上課提醒";
                        // 信件標題
                        $mail->Body = "這是系統自動信件，不需回復，$studentname 同學您明天$classtimeshow 有$classtype ";
                        //信件內容(html版，就是可以有html標籤的如粗體、斜體之類)
                        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                        if(!$mail->send()) {
                        echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                       }  
                       else {
                        echo '';
                         }
                         
                         break;
                     }
                 }     
           } 
           
        }
      }
  }    
}


echo '<meta http-equiv=REFRESH CONTENT=0;url=topic1.html>';


?> 
