<?php
 session_start();
 $id=$_SESSION['program_id'];
//check if user is member or restrict him/her 
if($_SESSION['logged_in']===true && $_SESSION['type'] ==='admin'){
    require 'layout/AdminHeader.php'; 
 }
 elseif($_SESSION['logged_in']===true && $_SESSION['type'] ==='member'){
    require 'layout/loggedHeader.php'; 
 }
 else{
     echo 'sorry ! you are not athorize to access this page'; 
    echo "<script>window.location.href='index.php'</script>"; 
 }  
//calling database conennction
require 'config.php';
//header 
//Include required PHPMailer file
require 'includes/sendgrid-php/sendgrid-php.php';
// change title name
use SendGrid\Mail\Mail;

echo "<script> document.title='لوحة التحكم' </script>";

if(isset($_POST['send']))
{   
     
   $status = $_POST['status'];
   $pid=$_POST['pid'];
   $member_id = $_SESSION['id'];
   $email_address = $_POST['email_address'];
   $note=$_POST['note'];
   $sql_update = "UPDATE enroll SET status='$status', member_id=$member_id, note='$note' WHERE program_id=$pid AND Vemail_address='$email_address' AND status='قيد الانتظار'";
     $results = mysqli_query($connection, $sql_update);
if ( false===$results ) {
    echo "<p style='text-align: right; margin-top:120px;'>". "نعتذر ، حدث خطأ"."</p>";
    echo "Error: " . $sql_update . "" . mysqli_error($connection);
                    }
 else {
      $pid2=$_POST['program_id'];
       //echo success adding member
          echo "<script>

Swal.fire({
     icon: 'success',
     title: 'لقد تم تحديث الحال بنجاح  ',
     text: '',
     showConfirmButton: true,
     confirmButtonText:'إغلاق ',
     closeOnConfirm: false

     }).then((result) => {
         location.replace('userFilter.php?id=$pid');   
         })

 </script>";
 $sql_v="SELECT name FROM program WHERE id=$pid";
  // echo'<script>alert('.$pid.');</script>';
       $res_v = mysqli_query($connection, $sql_v);
       if (mysqli_num_rows($res_v) > 0){
            while($row = mysqli_fetch_assoc($res_v)) {
        $name=$row['name'];     
            }
       }
//send an auto email including the email and password if the member is added
//Create instance of PHPMailer
$email = new Mail();
$email->setFrom("tajclubvolunteer@gmail.com", "نادي تاج التطوعي");
$email->addTo("$email_address");
if ($_POST['status'] == 'تمت الموافقة') {
    $email->setSubject("الموافقةعلى طلبك للتطوع");
    $email->addContent("text/html","مرحبا ".","."<br>"."  لقد تمت الموافقة على طلب انضمامك لبرنامج $name بنجاح"."<br>".
"! يمكنك الإطلاع على إجراءات البرنامج من خلال الموقع  ");
} else {
    $email->setSubject("نتيجة طلبك للتطوع");
    $email->addContent("text/html","مرحبا ".","."<br>"."  نعتذر لقد تم رفض طلب الإنضمام لبرنامج $name"."<br>".
" نؤسفكم علما بأنه تم رفض طلب انضمامك للبرنامج بسبب  ".$_POST['note']);
$_SESSION['note']=$_POST['note'];
}
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
?>
<element dir="rtl">
 <nav aria-label="breadcrumb" style="margin: 1%; margin-top:100px;">
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><strong><a href="programs.php">برامجنا</a> </strong></li>
      <li class="breadcrumb-item"><strong><a href="detalis.php?id=<?php echo $_SESSION['program_id'] ;?>">التفاصيل</a> </strong></li>
      <li class="breadcrumb-item active" aria-current="page"> <strong>اختيار المتطوعين </strong></li>
  </ol>
</nav>  
 <?php //if there is no volunteer left
 if(!isset($_GET['finalArray'])){
 echo "<p style='text-align: right; margin-top:20px;'>". "لقد تم الإنتهاء من اختيار جميع المتقدمين"."</p>";      
 }
 ?>
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
                '<td class="column4">إضافة</td>'.
                '<td class="column4">رفض</td>'.'
                 </tr>  
            </thead>';

    $data= $_GET['finalArray'];
    $data1= json_decode($data, true);
    //var_dump($data);
    //print_r($data1[0][5]);
    $arrLength = count($data1);
    for($i=0;$i<$arrLength;$i++){
    $myVariable = filter_var($data1[$i][4], FILTER_SANITIZE_NUMBER_INT);
    if($myVariable>0){
   echo    '<tbody class="table-body">
  <tr class="row2">
            <td class="cell100 column1" id="inc"></td>
    <td class="cell100 column1"><a href="volenteerDetails.php?id='.$data1[$i][0].'">'.$data1[$i][5].' '.$data1[$i][6].'</a></td>
    <td class="cell100 column2">'.$data1[$i][0].'</td>
    <td class="cell100 column3">'.$data1[$i][2].'</td>
    <td class="cell100 column3">'.$data1[$i][7].'</td>
    <td class="cell100 column3">'.$myVariable.'</td>
    <td class="cell100 column3">'.$data1[$i][3].'/5</td>
    <td class="column5"><a href="programsVolunteer.php">عرض البرامج</a></td>
   <form action="volenteerShowPrograms.php?id='.$_SESSION['program_id'].'" method="POST" style="margin-top: 14px;">
    <td class="column5"><button type="submit" name="send" class="add_vol">قبول</button></td>
    <input type="hidden" name="email_address" value="'.$data1[$i][0].'">
     <input type="hidden" name="status" value="تمت الموافقة">
        <input type="hidden" name="pid" value="'.$_SESSION['program_id'].'">
        <input type="hidden" name="program_id" value="'.$pid.'">
    </form>
    <form action="volenteerShowPrograms.php?id='.$_SESSION['program_id'].'" method="post">
        <input type="hidden" name="status" value="تم الرفض">
        <input type="hidden" name="pid" value="'.$_SESSION['program_id'].'">
        <td class="column5"><input type="text" name="note" placeholder="الرجاء كتابة سبب الرفض" value="اكتمال العدد"><button type="submit" name="send" class="add_decline" style="background: none!important; border: none;">رفض</button></td>
         <input type="hidden" name="email_address" value="'.$data1[$i][0].'">
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
                '<td class="column4">قبول</td>
                <td class="column4">رفض</td>'.'
                </tr>  
            </thead>';
 for($i=0;$i<$arrLength;$i++){
    $myVariable = filter_var($data1[$i][4], FILTER_SANITIZE_NUMBER_INT);
    if($myVariable==0){
   echo    '<tbody class="table-body">
  <tr class="row2">
            <td class="cell100 column1" id="inc"></td>
    <td class="cell100 column1"><a href="volenteerDetails.php?id='.$data1[$i][0].'">'.$data1[$i][5].' '.$data1[$i][6].'</a></td>
    <td class="cell100 column2">'.$data1[$i][0].'</td>
    <td class="cell100 column3">'.$data1[$i][2].'</td>
    <td class="cell100 column3">'.$data1[$i][7].'</td>
   <form action="volenteerShowPrograms.php?id='.$_SESSION['program_id'].'" method="POST" style="margin-top: 14px;">
    <td class="column5"><button type="submit" name="send" class="add_vol">قبول</button></td>
    <input type="hidden" name="email_address" value="'.$data1[$i][0].'">
     <input type="hidden" name="status" value="تمت الموافقة">
        <input type="hidden" name="pid" value="'.$_SESSION['program_id'].'">
    </form>
    <form action="volenteerShowPrograms.php?id='.$_SESSION['program_id'].'" method="post">
        <input type="hidden" name="status" value="تم الرفض">
        <input type="hidden" name="pid" value="'.$_SESSION['program_id'].'">
        <td class="column5"><input type="text" name="note" placeholder="الرجاء كتابة سبب الرفض" value="اكتمال العدد"><button type="submit" name="send" class="add_decline" style="background: none!important; border: none;">رفض</button></td>
         <input type="hidden" name="email_address" value="'.$data1[$i][0].'">
        </form>
        </tr>';
   }
    } 
                  ?>
           </tbody>
           </table>
            <div style="margin-bottom: 100px;">
            <a href="detalis.php?id=<?php echo $_SESSION['program_id'] ;?>"<button id="cancel"  name="cancel" style="float: right; " type="button" class="BackButton">العودة</button></a>           
            </div>
          
        </div>
      
   <element dir="ltr">
 
    </body>
        <?php require 'layout/footer.php'; 
?>
    <script type="text/javascript" src="jquery-1.3.2.js"> </script>
 <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</html>

