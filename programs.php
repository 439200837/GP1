<?php 
session_start();
//connect to the header.php page and to config.php page
//connect to the AdminHeader.php page and to config.php page
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
 require 'config.php';
  // change title name
echo "<script> document.title='برامجنا' </script>";
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';
//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//if the enrollment button is pressed
if(isset($_POST['insert']))
{	 
	 $volenteer_id = $_POST['volenteer_id'];
	 $program_id = $_POST['program_id'];
	 $status = 'قيد الانتظار';
	 $member_id = 1;
	 $email_address =$_SESSION['email'];

	 $sql = "INSERT INTO `enroll` (`volenteer_id`,`program_id`,`status`,`member_id`)
	 VALUES ('$volenteer_id','$program_id','$status','$member_id')";
     $results = mysqli_query($connection, $sql);
if ( false===$results ) {
    echo "<p style='text-align: right; margin-top:120px;'>". "نعتذر ، حدث خطأ"."</p>";
    echo "Error: " . $sql . "" . mysqli_error($connection);
                    }
 else {
       //echo success sendig the enrollment request
          echo "<script>

Swal.fire({
     icon: 'success',
     title: 'تم إرسال طلب الانضمام بنجاح',
     text: '',
     showConfirmButton: true,
     confirmButtonText:'إغلاق ',
     closeOnConfirm: false

     }).then((result) => {
         location.replace('programs.php'); 
         })

 </script>";
//send an auto email when the request is sent
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
$mail->Body = "مرحبا ".","."<br>"."  تم ارسال طلب انضمامك بنجاح"."<br>".
"! وفي حال تم الموافقة على الإنضمام سيتم ارسال اشعار لك ";
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
<div class="containerP">


<?php if($_SESSION['logged_in']&& $_SESSION['type']==="member"){?>

<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-body center-block text-center" >

<button class="detailss" onclick="go('AddProgram.php')">إضافه برنامج</button>

</div>
</div>
 </div>
</div>
<?php }?>

<div class="row">


<?php
$sql="SELECT * FROM `program`";
$result=mysqli_query($connection,$sql);
$sql2="SELECT * FROM `enroll` WHERE `volenteer_id` = '" . $_SESSION["id"] . "'";

$result=mysqli_query($connection,$sql);
$result3=mysqli_query($connection,$sql);
$result2=mysqli_query($connection,$sql2);


while($row=mysqli_fetch_assoc($result3)):
$check = 0;
?>
<div class="col-md-4">
<div class="panel panel-default">
<div class="panel-heading" >
    <div class="imgdiv center-block">
<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['picture']).'"alt:"program img" class="responsive"/>';?>
</div>
    </div>
  <div class="panel-body">
    <h2 class="programName"><?=$row['name']?></h2>
    <br>
      <?php if($_SESSION['logged_in']&& $_SESSION['type']==="member"){?>
      <button class="detailss" onclick="go('EditProgram.php?id=<?=$row['id']?>')">تعديل</button>
      <button class="detailss" onclick="go('memberrate.php?id=<?=$row['id']?> &date=<?=$row['end_date']?>')">تقييم المتطوعين</button>
      <?php }
       else{

        // while($row2=mysqli_fetch_array($result2)):
           //check the status of the enrollment 
          foreach($result2 as $tt){
            
          if($row['id'] == $tt['program_id']){
            if ($tt['status'] == 'قيد الانتظار') {
              $check= 2;
            } elseif ($tt['status'] == 'تمت الموافقة') {
              $check= 3;
            }else{
              $check= 0;
            }
            
            
          }
          // }elseif($row['id'] == $row2['program_id'] && $row2['status'] == 'waiting'){
          //   $check = 2;
          // }elseif($row['id'] == $row2['program_id']){
          //   $check = 3;
          // }else{
          //   $check = 0;
          // }

          // if($row['id'] == $row2['program_id']){
          //     $check = 1;
          //     break;
          //   }else{
          //     $check = 0;
          //     break;
          //   }
          // endwhile;
        } 
        
        //not enrolled
         if($check == '0'){
         ?>
      <form action="programs.php" method="POST" style="margin-top: 14px;">
        <input type="hidden" name="volenteer_id" value="<?= $_SESSION['id']; ?>">
        <input type="hidden" name="program_id" value="<?= $row['id'] ?>">
        <button class="detailss" type="submit" name="insert">انضم إلينا</button>
       </form>
      <?php }
      //sent enroll request
      elseif($check == '2'){?>
        <button class="detailss">قيد انتظار القبول </button>
      <?php }
         //accepted
         else{?>
        <button class="detailss">تمت الموافقة</button>
      <?php } }?>

      <button class="detailss" onclick="go('detalis.php?id=<?=$row['id']?>')">التفاصيل</button>

</div>
  <div class="panel-footer"> من <?=$row['start_date'] ?> الي <?=$row['end_date']?></div>
</div>

</div>

<?php endwhile;?>






</div>





</div>
    
    <element dir="ltr">
      <?php require 'layout/footer.php';
?>
<script type="text/javascript">
function go(web){
  window.location = web;



}


</script>

