<?php
 session_start();
 $id=$_SESSION['program_id'];
 //echo'<script>alert('.$id.');</script>';
 if($_SESSION['logged_in']===true && $_SESSION['type'] ==='member' && $_SESSION['id'] ==1){
    require 'layout/AdminHeader.php'; 
 }
 elseif($_SESSION['logged_in']===true && $_SESSION['type'] ==='member' && $_SESSION['id'] !=1){
    require 'layout/loggedHeader.php'; 
 }elseif($_SESSION['logged_in']===true && $_SESSION['type'] ==='volunteer'){
   require'layout/loggedHeader.php';
 }else{
  require'layout/header.php';   
 }
//calling database conennction
require 'config.php';
//header 

// change title name
echo "<script> document.title='لوحة التحكم' </script>";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['send']))
{   
   $id1 = $_POST['joinid'];
   $status = $_POST['status'];
   $member_id = 1;
   $email_address = $_POST['email_address'];

   $sql_update = "UPDATE enroll SET status='$status', member_id='$member_id' WHERE id='$id1'";
     $results = mysqli_query($connection, $sql_update);
if ( false===$results ) {
    echo "<p style='text-align: right; margin-top:120px;'>". "نعتذر ، حدث خطأ"."</p>";
    echo "Error: " . $sql_update . "" . mysqli_error($connection);
                    }
 else {
       //echo success adding member
          echo "<script>

Swal.fire({
     icon: 'success',
     title: 'لقد تم تحديث الحال بنجاح',
     text: '',
     showConfirmButton: true,
     confirmButtonText:'إغلاق ',
     closeOnConfirm: false

     }).then((result) => {
         location.replace('volenteerProgram.php'); 
         })

 </script>";
//send an auto email including the email and password if the member is added
//Create instance of PHPMailer
$mail = new PHPMailer();
//Set mailer to use smtp
$mail->isSMTP();
//Define smtp host
$mail->Host = "smtp.gmail.com";
//Enable smtp authentication
$mail->SMTPAuth = true;
//Set smtp encryption type (ssl/tls)
$mail->SMTPSecure = "tls";
//Port to connect smtp
$mail->Port = "587";
//Set gmail username
$mail->Username = "tajclubvolunteer@gmail.com";
//Set gmail password
$mail->Password = "X@87hri21";
//Email subject
$mail->Subject = "=?UTF-8?B?" . base64_encode('نادي تاج التطوعي') . "?="; 
//Set sender email
$mail->setFrom('tajclubvolunteer@gmail.com',"=?UTF-8?B?" . base64_encode('نادي تاج التطوعي') . "?=");
//Enable HTML
$mail->isHTML(true);
//Email body
if ($_POST['status'] == 'accepted') {
    $mail->Body = "مرحبا ".","."<br>"."  لقد تمت الموافقة على طلب انضمامك بنجاح"."<br>".
"! تهانينا لقد تم الموافقة على طلب انضمامك  ";
} else {
    $mail->Body = "مرحبا ".","."<br>"."  نعتذر لقد تم رفض طلب الإنضمام"."<br>".
"! نؤسفكم علما بأنه تم رفض طلب انضمامك للبرنامج ";
}


//Add recipient
$mail->addAddress("$email_address");
//Finally send email
if ( $mail->send() ) {
echo "Email Sent..!";
}else{
echo "Message could not be sent. Mailer Error: "{$mail->ErrorInfo};
}
//Closing smtp connection
$mail->smtpClose();
        }

}
?>
<element dir="rtl">
  
        
    <!-- <div id="responsecontainer">
        <div class="above-table">
            
        <div class="dropdown">
            <button class="dropbtn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
  <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
</svg> الأعضاء </button>

<div class="dropdown-content">
      <button id="displayM" class="display" type="button">الأعضاء</button>
      <button id="displayV" class="display" type="button">المتطوعين</button>
      <button id="displayS" class="display" type="button">الرعاة</button>
  </div>
</div> 
           
            <a href="add.php" id="addB" <button class="button" type="button">إضافة عضو</button></a>
            
        </div> -->
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="divtable">
        <table class="table">
            <thead class="table-head">
            <tr class="row1">
                  <td class="column1">#</td>
                  <?php
   //member infomation will appear first
            echo
      '<td class="column1">اسم المتطوع </td>'
           .'<td class="column2">البريد الإلكتروني</td>'.'<td class="column3">التخصص</td>'.
            '<td class="column4">الجنس</td>'.
                '<td class="column4">عدد البرامج المشترك بها</td>'.
                '<td class="column4">التقييم</td>'.
                '<td class="column4">عرض</td>'.
                '<td class="column4">إضافة</td>'.'
                 </tr>  
            </thead>';

    $data= $_GET['finalArray'];
    $data1= json_decode($data, true);
    //var_dump($data);
    //print_r($data1[0][5]);
    $arrLength = count($data1);
    for($i=0;$i<$arrLength;$i++){
    if($date1[$i][4]!==0){
   echo    '<tbody class="table-body">
  <tr class="row2">
            <td class="cell100 column1" id="inc"></td>
    <td class="cell100 column1">'.$data1[$i][5].' '.$data1[$i][6].'</td>
    <td class="cell100 column2">'.$data1[$i][0].'</td>
    <td class="cell100 column3">'.$data1[$i][2].'</td>
    <td class="cell100 column3">'.$data1[$i][7].'</td>
    <td class="cell100 column3">'.$data1[$i][4].'</td>
    <td class="cell100 column3">'.$data1[$i][3].'/5</td>
    <td class="column5"><a href="programsVolunteer.php?id='.$row['id'].'">عرض البرامج</a></td>
   <form action="volenteerShowPrograms.php" method="POST" style="margin-top: 14px;">
    <button style="display: none;" name:"send"><td class="column5"><a href=#>إضافة</a></td></button>
    </form>
    
    </tr>';}
    }
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  ?>
             
           </tbody> 
            
           </table> <br>
        </div>
        <br>
        <br>
        <br>
        <div class="divtable">
        <table class="table">
            <thead class="table-head">
            <tr class="row1">
                  <td class="column1">#</td>
                  <?php
   //member infomation will appear first
            echo
      '<td class="column1">اسم المتطوع </td>'
           .'<td class="column2">البريد الإلكتروني</td>'.'<td class="column3">التخصص</td>'.
            '<td class="column4">الجنس</td>'.
                '<td class="column4">إضافة</td>'.'
                 </tr>  
            </thead>';
 for($i=0;$i<$arrLength;$i++){
    if($date1[$i][4]===0){
   echo    '<tbody class="table-body">
  <tr class="row2">
            <td class="cell100 column1" id="inc"></td>
    <td class="cell100 column1">'.$data1[$i][5].' '.$data1[$i][6].'</td>
    <td class="cell100 column2">'.$data1[$i][0].'</td>
    <td class="cell100 column3">'.$data1[$i][2].'</td>
    <td class="cell100 column3">'.$data1[$i][7].'</td>
    <form action="volenteerShowPrograms.php" method="POST" style="margin-top: 14px;">
    <button style="display: none;" name:"send"><td class="column5"><a href="programsVolunteerAdd.php?id='.$row['id'].'">إضافة</a></td></button>
    </form>
        </tr>';
   }
    }
   
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  ?>
             
           </tbody> 
            
           </table> <br>
        </div>
   
         
    </div>
   <element dir="ltr">
      <?php require 'layout/footer.php'; 
?>
    </body>
    <script type="text/javascript" src="jquery-1.3.2.js"> </script>
 <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</html>

