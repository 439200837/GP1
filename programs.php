<?php 
session_start();
//connect to the header.php page and to config.php page
//connect to the AdminHeader.php page and to config.php page
if($_SESSION['logged_in']===true && $_SESSION['type'] ==='admin'){
    require 'layout/AdminHeader.php'; 
 }
 elseif($_SESSION['logged_in']===true && $_SESSION['type'] ==='member'){
    require 'layout/loggedHeader.php'; 
 }
 elseif($_SESSION['logged_in']===true && $_SESSION['type'] ==='volunteer'){
   require'layout/loggedHeader.php';
   require 'recommendedPrograms.php';
 }elseif($_SESSION['logged_in']===true && $_SESSION['type'] ==='sponsor'){
   require'layout/loggedHeader.php';
 }else{
  require'layout/header.php';   
 }
 require 'config.php';
  // change title name
echo "<script> document.title='برامجنا' </script>";
//Include required SendGrid file
require 'includes/sendgrid-php/sendgrid-php.php';
use SendGrid\Mail\Mail;


//if the enrollment button is pressed
if(isset($_POST['insert']))
{
 if($_SESSION['logged_in']!==true){
   //echo success sendig the enrollment request
     echo "<script>
     Swal.fire({
     icon: 'info',
     title: 'أنت غير مسجل',
     text: 'إذا كان لديك حساب يرجي تسجيل الدخول أو اختيار صفحة إنشاء حساب',
     showConfirmButton: true,
     confirmButtonText:' إنشاء حساب',
     showCancelButton: true,
     cancelButtonText:'تسجيل الدخول',
     closeOnConfirm: false,
     showCloseButton: true,
     closeOnCancel: false

     }).then((result) => {
     if (result.isConfirmed) {    
    	location.replace('signUpV.php');  
    } else if(result.dismiss == 'cancel'){    
    	location.replace('log-in.php'); 
 	}
          
         })

 </script>";  
     echo '<style>'
     . '.swal2-styled.swal2-confirm{
    background-color: #9b59b6;
}
.swal2-styled.swal2-cancel{
   background-color: #9b59b6 !important; 
   opacity: 1;
}
.swal2-html-container, .swal2-text{
  font-size:15px !important;
}
.swal2-icon.swal2-info{
   border-color: #6e7d88 !important;
   color: #6e7d88 !important;
}'
             . '</style>';
 }
	 $volenteer_id = $_POST['volenteer_id'];
	 $program_id = $_POST['program_id'];
	 $status = 'قيد الانتظار';
	 $member_id = 1;
	 $email_address =$_SESSION['email'];

	 $sql = "INSERT INTO `enroll` (`volenteer_id`,`program_id`,`status`,`member_id`,`Vemail_address`,`rate`)
	 VALUES ('$volenteer_id','$program_id','$status','$member_id','$email_address','لم يتم التقييم')";
     $results = mysqli_query($connection, $sql);
if ( false===$results ) {
    echo "<p style='text-align: right; margin-top:120px;'>". "نعتذر ، حدث خطأ"."</p>";                   }
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
//Create instance of SendGrid
$email = new Mail();
$email->setFrom("tajclubvolunteer@gmail.com", "نادي تاج التطوعي");
$email->addTo("$email_address");
$email->setSubject("تم تقديم الطلب بنجاح");
//Email body
$email->addContent("text/html","مرحبا ".","."<br>"."  تم ارسال طلب انضمامك بنجاح"."<br>".
"! وفي حال تم الموافقة على الإنضمام سيتم ارسال اشعار لك ");
$sendgrid = new \SendGrid('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');
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}
}}
//START CODE CHANGE STSTUS 
$currentdate = date("Y-m-d");
$sqlU="UPDATE `enroll` SET status='انتهى' WHERE program_id IN (SELECT id FROM program WHERE end_date < '$currentdate') AND status='تمت الموافقة'";
$resultU=mysqli_query($connection,$sqlU);
//END CHANGE STATUS 

if(isset($_POST['deleteenroll']))
{	 
	 $enroll_id = $_POST['enrollid'];
   $sql="DELETE FROM `enroll` WHERE `id` = $enroll_id";

     $resultsdelete = mysqli_query($connection, $sql);
if ( false===$resultsdelete ) {
    echo "<p style='text-align: right; margin-top:120px;'>". "نعتذر ، حدث خطأ"."</p>";
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
if(isset($_POST['insertt22'])){
$program_idd=$_POST['program_idd'];
 $sql23='SELECT * FROM `program` WHERE `id` = ' .$program_idd;
 $result23= mysqli_query($connection,$sql23);
                 while($row23= mysqli_fetch_assoc($result23)){
                   $number= $row23['phone'];}?>
<script>
    var myVariable = <?php echo(json_encode($number)); ?>;
var programName = <?php echo(json_encode($_POST['program_name'])); ?>;   
    window.open(
   "https://api.whatsapp.com/send?phone=+966"+myVariable+"&text=مرحبًا، أريد أن أدعم مبادرة "+programName,
  '_blank' // <- This is what makes it open in a new window.
);
          
    </script>
 <?php }?>
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
$sql="SELECT * FROM `program` WHERE end_date > '$currentdate1' ";
//$result=mysqli_query($connection,$sql);
$sql2="SELECT * FROM `enroll` WHERE `volenteer_id` = '" . $_SESSION["id"] . "'";

$result=mysqli_query($connection,$sql);
$result3=mysqli_query($connection,$sql);
$result2=mysqli_query($connection,$sql2);
while($row=mysqli_fetch_assoc($result)){
if($_SESSION['logged_in']&& $_SESSION['type']==="volunteer" && in_array( $row['id'], $resultP)){
$check = 0;
?>
<div class="col-md-4">
<div class="panel panel-default">
<div class="panel-heading">
 <span class="label suggest" style= "">مقترح لك</span>
    <div class="imgdiv center-block">
<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['picture']).'"alt:"program img" class="responsive"/>';?>
</div>
    </div>
  <div class="panel-body">
    <h2 class="programName"><?=$row['name']?></h2>
    

      <?php

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
        }//end forech
        
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
      
      
     
      <?php }//end check=0
      //sent enroll request
      elseif($check == '2'){?>
        <button class="detailss">قيد انتظار القبول </button>
      <?php }//end check=2
         //accepted
         else{?>
        <button class="detailss">تمت الموافقة</button>
        <a class="detailssdelete" href="javascript:void(0)" id="delete_enroll" data-id="<?=$row['id']?>" class="trigger-btn" data-toggle="modal">
إلغاء</a>
       <?php }//end else
         ?>

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
      'تم الحذف بنجاح',
      "",//alert message with success delete 
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
<?php }}

while($row=mysqli_fetch_assoc($result3)){
$check = 0;
if(!in_array( $row['id'], $resultP)){
?>
<div class="col-md-4">
<div class="panel panel-default">
<div class="panel-heading">
    <div class="imgdiv center-block">
<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['picture']).'"alt:"program img" class="responsive"/>';?>
</div>
    </div>
  <div class="panel-body">
    <h2 class="programName"><?=$row['name']?></h2>
    

      <?php
      if($_SESSION['logged_in']&& $_SESSION['type']==="sponsor"){?>
    <form action="programs.php" method="POST" style="display: inline-block;">
      <input type="hidden" name="program_idd" value="<?= $row['id'] ?>">
      <input type="hidden" name="program_name" value="<?= $row['name'] ?>">
      <button class="detailss" type="submit" name="insertt22">ادعمنا</button>  
      </form> 
   <?php }elseif($_SESSION['logged_in']&& $_SESSION['type']==="member"){?>
      <button class="detailss" onclick="go('EditProgram.php?id=<?=$row['id']?>')">تعديل</button> 
       <?php   
           }
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
        }//end forech
        
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
      
      
     
      <?php }//end check=0
      //sent enroll request
      elseif($check == '2'){?>
        <button class="detailss">قيد انتظار القبول </button>
      <?php }//end check=2
         //accepted
         else{?>
        <button class="detailss">تمت الموافقة</button>
        <a class="detailssdelete" href="javascript:void(0)" id="delete_enroll" data-id="<?=$row['id']?>" class="trigger-btn" data-toggle="modal">
إلغاء</a>
       <?php }//end else
       
         }//end else
         ?>

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
      'تم الحذف بنجاح',
      "",//alert message with success delete 
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
<?php }}?>



</div>





</div>
    
    <element dir="ltr">
<?php require 'layout/footer.php';?>
<script type="text/javascript">
function go(web){
  window.location = web;

}




</script>
