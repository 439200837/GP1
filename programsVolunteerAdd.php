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
 $id=$_GET['id'];
  // change title name
echo "<script> document.title='برامجنا' </script>";
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';
//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['insert']))
{   
   $volenteer_id = $_POST['volenteer_id'];
   $program_id = $_POST['program_id'];
   $member_id = 1;

   $sql = "INSERT INTO invite (volenteer_id,program_id,member_id)
   VALUES ('$volenteer_id','$program_id','$member_id')";
     $results = mysqli_query($connection, $sql);
if ( false===$results ) {
    echo "<p style='text-align: right; margin-top:120px;'>". "نعتذر ، حدث خطأ"."</p>";
    echo "Error: " . $sql . "" . mysqli_error($connection);
                    }
 else {
       //echo success adding member
          echo "<script>

Swal.fire({
     icon: 'success',
     title: 'تم إرسال الدعوة بنجاح',
     text: '',
     showConfirmButton: true,
     confirmButtonText:'إغلاق ',
     closeOnConfirm: false

     }).then((result) => {
         location.replace('volenteerShowPrograms.php'); 
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
$sql="SELECT * FROM program";
$result=mysqli_query($connection,$sql);
$sql2="SELECT * FROM enroll WHERE volenteer_id = '" . $id . "'";
$result=mysqli_query($connection,$sql);
$result2=mysqli_query($connection,$sql2);


while($row=mysqli_fetch_assoc($result)):
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
          foreach($result2 as $tt){
            
          if($row['id'] == $tt['program_id']){
            if ($tt['status'] == 'قيد الانتظار') {
              $enrollid = $tt['id'];
              $check= 2;
            } elseif ($tt['status'] == 'تمت الموافقة') {
              $enrollid = $tt['id'];
              $check= 3;
            }else{
              $check= 0;
            }
            
            
          }

        } 
         if($check == '0'){
         ?>
      <form action="programsVolunteerAdd.php" method="POST" style="margin-top: 14px;">
        <input type="hidden" name="volenteer_id" value="<?= $id; ?>">
        <input type="hidden" name="program_id" value="<?= $row['id'] ?>">
        <button class="detailss" type="submit" name="insert" onclick="return confirm('هل أنت متأكد من ارسال الدعوة؟')">
ارسال دعوة</button>
       </form>
      <?php }elseif($check == '2'){?>
      <?php }else{?>

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
