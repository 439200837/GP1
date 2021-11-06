<?php require 'layout/AdminHeader.php';
require 'config.php';
$id=@$_GET['id'];
?>
<element dir="rtl">
<html>
    <head>
      
    <meta charset="UTF-8">
    <title class="reg">تعديل معلومات الاعضاء</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <header class="header">
       
       
       
   </header>
    <body class="reg" onchange="mm()">
        <div class="container5">
    <div class="title" dir="rtl">تعديل معلومات الاعضاء</div>
    <div class="content">
 <?php 
 
 if (isset($_GET['id'])) {

  //get  member data 

 $sql="SELECT * FROM member where id='$id'";
          $result = mysqli_query( $connection, $sql);
  // output data of  row
  while($row = mysqli_fetch_assoc($result)) {?>
      <form action="edit-member.php" method="POST">
        <div class="user-details">
              <div class="input-box">
            <span class="details" dir="rtl">الأسم الاول</span>
            <input type="text" placeholder="ادخل الاسم الاول" dir="rtl"  id="fname"  onchange="ValidateNameMember()"  name="first_name" value="<?= $row['first_name']?>">
            <p id="er6" style="color: red;"></p>

          </div>
          <div class="input-box">
            <span class="details" dir="rtl">الأسم الثاني</span>
            <input type="text" placeholder="ادخل الاسم الثاني" id="lname" onchange="ValidateNameMember()"  name="last_name" value="<?= $row['last_name']?>" dir="rtl">
            <p id="er7" style="color: red;"></p>

          </div>
          
   
          <div class="input-box">
            <span class="details" dir="rtl">البريد الإلكتروني</span>
            <input type="email" placeholder="ادخل البريد الإلكتروني" dir="rtl" id="email" onchange="ValidateEmail()"  name="email_address" value="<?=$row['email_address']?>">
            <p id="er" style="color: red;"></p>

          </div>
          <div class="input-box">
            <span class="details" dir="rtl">رقم الهاتف</span>
            <input type="tel" placeholder="ادخل رقم الهاتف" id="phone"  onchange="ValidatePhone()"  dir="rtl" name="phone_number" value="<?= $row['phone_number']?>">
            <p id="er5" style="color: red;"></p>

          </div>
         
            
            <div class="input-box">
            <span class="details" dir="rtl">العنوان</span>
            <input type="text" placeholder="ادخل العنوان" id="address" dir="rtl" onchange="ValidateNameMember()"  name="address" value="<?= $row['address']?>">
            <p id="er8" style="color: red;"></p>

          </div>
            
            
          <div class="gender-details" dir="rtl">
          <input type="radio" name="gender" value="ذكر" id="dot-1" <?= ($row['gender'] == 'ذكر')?'checked="checked"':''?>>
          <input type="radio" name="gender" value="أنثى" id="dot-2"   <?= ($row['gender'] == 'أنثى')?'checked="checked"':''?>>
   
          <span class="gender-title" dir="rtl">الجنس</span>
          <div class="category" >
              <ul style="list-style-type: none;">  
                  <li><label for="dot-1">
                             <span class="dot one"></span>
                 <span class="gender">ذكر</span>
         
          
                      </label></li>
                      <li> <label for="dot-2">
                              <span class="dot two"></span>
               <span class="gender">أنثى</span>
         
           
                          </label></li> </ul>
         
          </div>
          
          
        </div>
           
        </div>
        <input type="hidden" name="id" value="<?=$row['id']?>">
       
            <input type="submit" name="edit" id="SubmitButtun" value="تعديل" class="fbutton">
        <a href="board.php?type=الاعضاء" class="Bbutton">الغاء </a>
      </form>

      <?php  }
    }
      ?>
        <script> 
            
var count=0;
document.getElementById("SubmitButtun").disabled=true;
       function ValidateNameMember() {
  var regex="^[\u0621-\u064A\040]+$";
  var reg="[\u0600-\u06FF]";
  var fname = document.getElementById("fname").value;
  var lname = document.getElementById("lname").value;
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
  if (!lname.match(regex)){
         document.getElementById("er7").innerHTML="فضلا ، ادخل اسم باللغه العربيه";
          document.getElementById("lname").style.borderColor="red";
          count++;
     }else{
        document.getElementById("er7").innerHTML="";
        document.getElementById("lname").style.borderColor="#9b59b6";
         count--;
     }
     if (!address.match(reg)){
         document.getElementById("er8").innerHTML="فضلا ، ادخل عنوان باللغه العريبه ";
          document.getElementById("address").style.borderColor="red";
      count++;
         
     }else{
        document.getElementById("er8").innerHTML="";
        document.getElementById("address").style.borderColor="#9b59b6";
      count--;
     }

  }
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
function mm(){
  er=document.getElementById("fname").style.borderColor;
  er1=document.getElementById("lname").style.borderColor;
   er5=document.getElementById("email").style.borderColor;
      er8=document.getElementById("address").style.borderColor;
   if(!(er=="red"||er1=="red"||er5=="red"  ||er8=="red")){
      document.getElementById("SubmitButtun").disabled=false;
   } else{
        document.getElementById("SubmitButtun").disabled=true;
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

            </script>
<?php

//if edit button clicked

if(isset($_POST['edit'])){
    //get form data

 $email_address= $_POST['email_address'];
  $first_name=$_POST['first_name'];
  $last_name=$_POST['last_name'];
  $gender=$_POST['gender'];
  $phone_number=$_POST['phone_number'];
  $address=$_POST['address'];
  $id=$_POST['id'];
//update sponser data
   $sql_update ="UPDATE `member` SET `email_address`='$email_address',
                                    `first_name`='$first_name',
                                    `last_name`='$last_name',
                                    `gender`='$gender',
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
                     title: 'تم تعديل بيانات العضو بنجاح',
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