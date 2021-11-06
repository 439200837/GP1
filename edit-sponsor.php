<?php require 'layout/AdminHeader.php';
require 'config.php';
$id=@$_GET['id'];
?>
<element dir="rtl">
 
    <body class="reg" onchange="ms()">
        <div class="container5">
    <div class="title" dir="rtl">تعديل معلومات الرعاة</div><br>
    <div class="content">
    <?php 
 if (isset($_GET['id'])) {

 //get  sponsor data 
  $sql="SELECT * FROM sponsor where id='$id'";
          $result = mysqli_query( $connection, $sql);
  // output data of  row
  while($row = mysqli_fetch_assoc($result)) {?>
      <form action="edit-sponsor.php" method="post">
        <div class="user-details">
          <div class="input-box">
            <span class="details" dir="rtl">الاسم</span>
            <input type="text" placeholder="ادخل الاسم الكامل"   id="fname"  onchange="ValidateNameٍsponser()"  dir="rtl" name="name" value="<?= $row['name']?>">
            <p id="er6" style="color: red;"></p>

          </div>

          <div class="input-box">
            <span class="details" dir="rtl">البريد الإلكتروني</span>
            <input type="email" placeholder="ادخل البريد الإلكتروني" dir="rtl"  id="email" onchange="ValidateEmail()"  name="email_address" value="<?=$row['email_address']?>">
          </div>
          <div class="input-box">
            <span class="details" dir="rtl">رقم الهاتف</span>
            <input type="tel" placeholder="ادخل رقم الهاتف" id="phone" dir="rtl" onchange="ValidatePhone()"  name="phone_number" value="<?= $row['phone_number']?>">
            <p id="er5" style="color: red;"></p>

          </div>

         
            
            <div class="input-box">
            <span class="details" dir="rtl">العنوان</span>
            <input type="text" placeholder="ادخل العنوان" id="address" onchange="ValidateNameٍsponser()"    dir="rtl" name="address" value="<?= $row['address']?>">
      
            <p id="er8" style="color: red;"></p>
  </div>
            
           
           
        </div>
       
        <input type="hidden" name="id" value="<?=$row['id']?>">

          <input type="submit"  id="SubmitButtun" name="edit" value="تعديل" class="fbutton">
          <a href="board.php?type=الرعاة" class="Bbutton">الغاء </a>
       
      </form>

      <?php  }
    }
      ?>
       <script> 
            
var count=0;
document.getElementById("SubmitButtun").disabled=true;
 
function ValidateEmail() {
  var email = document.getElementById("email").value;
   const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
   if (!email.match(re)){
       document.getElementById("er").innerHTML="فضلا قم بكتابة البريد الإلكتروني بشكل صحيح";
        document.getElementById("email").style.borderColor="red";
         count++;
   }else{
      document.getElementById("er").innerHTML="";
      document.getElementById("email").style.borderColor="#9b59b6";
      count--;
   }}
 
    function ValidatePhone() {
var regex="^0[0-9]{9}$";
var phone = document.getElementById("phone").value;
if (!phone.match(regex)){
       document.getElementById("er5").innerHTML="ادخل رقم الهاتف بالشكل الصحيح";
        document.getElementById("phone").style.borderColor="red";
        count++;
   }else{
      document.getElementById("er5").innerHTML="";
      document.getElementById("phone").style.borderColor="#9b59b6";
      count--;
   }

}
function ValidateNameٍsponser() {
  var regex="^[\u0621-\u064A\040]+$";
  var reg="[\u0600-\u06FF]";
  var fname = document.getElementById("fname").value;
  var address = document.getElementById("address").value;
  if (!fname.match(regex)){
         document.getElementById("er6").innerHTML="فضلا ، ادخل اسم باللغه العربيه";
          document.getElementById("fname").style.borderColor="red";
        count++;
     }else{
        document.getElementById("er6").innerHTML="";
        document.getElementById("fname").style.borderColor="#9b59b6";
        count--;
     }

     if (!address.match(reg) &&address!==""){
         document.getElementById("er8").innerHTML="فضلا ، ادخل عنوان باللغه العربيه ";
          document.getElementById("address").style.borderColor="red";
      count++;
           return false;
     }else{
        document.getElementById("er8").innerHTML="";
        document.getElementById("address").style.borderColor="#9b59b6";
      count--;
     }

  }
   function ms(){
    e6=document.getElementById("fname").style.borderColor;
     er=document.getElementById("email").style.borderColor;
        er8=document.getElementById("address").style.borderColor;
         er5=document.getElementById("phone").style.borderColor;
     if(!(er=="red"|| er5=="red"  ||er8=="red" ||er6=="red")){
        document.getElementById("SubmitButtun").disabled=false;
     } else{
          document.getElementById("SubmitButtun").disabled=true;
     }
  }
            </script>
<?php
//if edit button clicked
if(isset($_POST['edit'])){
  //get form data
 $email_address= $_POST['email_address'];
  $name=$_POST['name'];
  $phone_number=$_POST['phone_number'];
  $address=$_POST['address'];
  $id=$_POST['id'];
//update sponser data
   $sql_update ="UPDATE `sponsor` SET `email_address`='$email_address',
                                    `name`='$name',
                                    `phone_number`='$phone_number',
                                    `address`='$address' WHERE id='$id'";
$query_update = mysqli_query( $connection, $sql_update);
//if run query get error echo eles redirect back
if($query_update==false){
echo "Error";

}else{
   echo "<script>
           
                Swal.fire({
                     icon: 'success',
                     title: 'تم تعديل بيانات الراعي بنجاح',
                     text: '',
                     showConfirmButton: true,
                     confirmButtonText:'إغلاق ',
                     closeOnConfirm: false

                     }).then((result) => {
                         location.replace('board.php'); 
                         })

                 </script>";

}

}

?>

    </div>
  </div>

         
</body>

    <element dir="ltr">
      <?php require 'layout/footer.php'; 
?>
    </body>
</html>