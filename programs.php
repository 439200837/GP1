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

	 $sql = "INSERT INTO `enroll` (`volenteer_id`,`program_id`,`status`,`member_id`,`Vemail_address`,`rate`)
	 VALUES ('$volenteer_id','$program_id','$status','$member_id','$email_address','لم يتم التقييم')";
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
//START CODE CHANGE STSTUS 
$currentdate = date("Y-m-d");
$today_time = strtotime($currentdate);
$expire_time = strtotime($enddate);
$sqlU="UPDATE `enroll` SET status='انتهى' WHERE program_id IN (SELECT id FROM program WHERE end_date < '$currentdate') AND status='تمت الموافقة'";
$resultU=mysqli_query($connection,$sqlU);
//END CHANGE STATUS 

if(isset($_POST['deleteenroll']))
{	 
	 $enroll_id = $_POST['enrollid'];
   $sql="DELETE FROM `enroll` WHERE `enroll`.`id` = '$enroll_id'";

     $resultsdelete = mysqli_query($connection, $sql);
if ( false===$resultsdelete ) {
    echo "<p style='text-align: right; margin-top:120px;'>". "نعتذر ، حدث خطأ"."</p>";
    echo "Error: " . $sql . "" . mysqli_error($connection);
                    }
 else {
       //echo success adding member
          echo "<script>

Swal.fire({
     icon: 'success',
     title: 'تم إلغاء الطلب بنجاح',
     text: '',
     showConfirmButton: true,
     confirmButtonText:'إغلاق ',
     closeOnConfirm: false

     }).then((result) => {
         location.replace('programs.php'); 
         })

 </script>";
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
$currentdate1 = date("Y-m-d");
$sql="SELECT * FROM `program` WHERE end_date > '$currentdate1'";
//$result=mysqli_query($connection,$sql);
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
        <input type="hidden" name="enddate" value="<?= $row['end_date'] ?>">
         <input type="hidden" name="id" value="<?=$id?>">
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
        <a class="detailssdelete" href="javascript:void(0)" id="delete_enroll" data-id="<?=$enrollid;?>" class="trigger-btn" data-toggle="modal">
إلغاء</a>
      <?php } }?>

      <button class="detailss" onclick="go('detalis.php?id=<?=$row['id']?>')">التفاصيل</button>

</div>
  <div class="panel-footer"> من <?=$row['start_date'] ?> الي <?=$row['end_date']?></div>
</div>

</div>
<script>
//delete users using jQuery (POST)
$(document).ready(function(){
		
		//when click on delete button
		$(document).on('click', '#delete_enroll', function(e){
		
			var productId = $(this).data('id');
			SwalDelete(productId);
			e.preventDefault();
                     
		});
		
	
	//an alert will appear to confirm deleting
	function SwalDelete(enrollid){
	Swal.fire({
  title: 'هل أنت متأكد ؟',
  text: "لن تستطيع استرجاع البيانات بعد عملية الحذف",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#d33',
  cancelButtonColor: '#3085d6',
  confirmButtonText: 'حذف',
  cancelButtonText:'إلغاء'
}).then((result) => {
  if (result.isConfirmed) {
      //when click on confirm
     $.ajax({    //create an ajax request 
        type: "POST",
        url: "deleteEnroll.php",
        data: {enrollid:enrollid},
        dataType: "html",   //expect html to be returned                
        success: function(response){                    
            Swal.fire(
      response,
      'تم الحذف بنجاح',//alert message with success delete 
      'success'    
    ).then((result) => {
        location.reload(true); // reload page 
    })
        },
  error: function(XMLHttpRequest, textStatus, errorThrown) {
     alert(textStatus); //alert error message if there
  }

    });//end ajax

            }
})
		
	}
});
</script>
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