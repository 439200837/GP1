<?php
session_start();
//connect to the header.php page and to config.php page
//connect to the AdminHeader.php page and to config.php page
if($_SESSION['logged_in']===true && $_SESSION['type'] ==='admin'){
    require 'layout/AdminHeader.php'; 
 }elseif($_SESSION['logged_in']===true && $_SESSION['type'] ==='sponsor'){
   require'layout/loggedHeader.php';
 }else{
  //if anyone try to enter this page without premession it will be redirect to home.php
  echo '<script>window.location.replace("index.php");</script>';
 }

require 'config.php';
$id=@$_GET['id'];
    // change title name
echo "<script> document.title='تعديل بيانات الراعي' </script>";
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
            <input type="text" placeholder="ادخل الاسم الكامل"   id="fname"  onkeyup="ValidateNameٍsponser()"  dir="rtl" name="name" value="<?= $row['name']?>">
            <p id="er6" style="color: red;"></p>

          </div>

          <div class="input-box">
            <span class="details" dir="rtl">البريد الإلكتروني</span>
            <input type="email" placeholder="mail@example.com" dir="rtl"  id="email" onchange="ValidateEmail()"  name="email_address" value="<?=$row['email_address']?>">
          </div>
          <div class="input-box">
            <span class="details" dir="rtl">رقم الهاتف</span>
            <input type="tel" placeholder="05XXXXXXXX" id="phone" dir="rtl" onchange="ValidatePhone()"  name="phone_number" value="<?= $row['phone_number']?>">
            <p id="er5" style="color: red;"></p>

          </div>

         
            
           <div class="input-box">
            <span class="details" dir="rtl"> الحي (مدينة الرياض) *</span>
         <select name="address" id="address"  dir="rtl" required="required">
  <option value="المغرزات">المغرزات</option>
  
  <option value="غرناطة">غرناطة</option>
  
  <option value="العقيق">العقيق</option>
  
  <option value="المروج">المروج</option> 
  
  <option value="الازدهار">الازدهار</option>
  
  <option value="الصحافة">الصحافة</option> 
  
  <option value="النخيل">النخيل</option>
  
  <option value="الملقا">الملقا</option> 
  
  <option value="الربيع">الربيع</option>
  
  <option value="النخيل الشرقي">النخيل الشرقي</option>
  
  <option value="النخيل الغربي">النخيل الغربي</option>
  
  <option value="الورود">الورود</option> 
  
  <option value="المرسلات">المرسلات</option>
  
  <option value="المروة">المروة</option> 
  
  <option value="الدار البيضاء">الدار البيضاء</option>
  
  <option value="العزيزية">العزيزية</option>
 <option value="شبرا">شبرا</option>
  
  <option value="الدريهمية">الدريهمية</option>  
  
  <option value="المنصورة">المنصورة</option>
  
  <option value="اليمامة">اليمامة</option> 
  <option value="بدر">بدر</option>
  
  <option value="الفواز">الفواز</option> 
  
  <option value="نمار">الشفاء</option>
  
  <option value="المصانع">المصانع</option>
 <option value="الحاير">الحاير</option>
  
  <option value="الشميسي">الشميسي</option> 
  
  <option value="السويدي">السويدي</option>
  
  <option value="الشعلان">الشعلان</option>
  
  <option value="بن تركي">بن تركي</option>
  
  <option value="جامعة الملك سعود">جامعة الملك سعود</option>
  
  <option value="عرقة">عرقة</option>
  
  <option value="الدرعية">الدرعية</option> 
  <option value="شبرا">شبرا</option>
  
  <option value="ظهرة البديعة">ظهرة البديعة</option> 
  
  <option value="العريجاء">العريجاء </option>
  
  <option value="البديعة">البديعة</option>
 <option value="القدس">القدس</option>
  
  <option value="الحمراء">الحمراء</option> 
  
  <option value="الريان">الريان</option>
  
  <option value="الروضة">الروضة</option>
  
  <option value="الشهداء">الشهداء</option>
  
  <option value="الفلاح">الفلاح</option>
 <option value="النسيم">النسيم</option>
  
  <option value="قرطبة">قرطبة</option> 
  <option value="أشبيلية">أشبيلية</option>
  
  <option value="الرواد">الرواد</option> 
  
  <option value="الربوه">الربوه</option>
  
  <option value="الجزيرة">الجزيرة</option>
 <option value="اليرموك">اليرموك</option>
  
  <option value="الخليج">الخليج</option> 
  
  <option value="النهضة">النهضة</option>
  
  <option value="السلي">السلي</option>
  
  <option value="الملز">الملز</option>
  
  <option value="الديره">الديره</option>          
  
   <option value="المرقب">المرقب</option>
  
  <option value="البطحاء">البطحاء</option> 
  <option value="الفاخرية">الفاخرية</option>
  
  <option value="المربع">المربع</option> 
  
  <option value="الصالحية">الصالحية</option>
  
  <option value="المونسية">المونسية</option>
 <option value="طويق">طويق</option>
  
  <option value="الرمال">الرمال</option> 
  
  <option value="العارض">العارض</option>
  
  <option value="اليرموك">اليرموك</option>
  
  <option value="السلام">السلام</option>
  
  <option value="الياسمين">الياسمين</option>
  
 
  
   <option value="الرائد">الرائد</option>
  
  <option value="العليا">العليا</option> 
  <option value="الفلاح">الفلاح</option>
  
  <option value="التعاون">التعاون</option> 
  
  <option value="الخزامي">الخزامي</option>
  
  <option value="منفوحة">منفوحة</option>
 <option value="النزهة">النزهة</option>
  
  <option value="الواحة">الواحة</option> 
  
  <option value="النظيم">النظيم</option>
  
  <option value="الوادي">الوادي</option>
  
  <option value="الملك فهد">الملك فهد</option>
  
  <option value="الملك فيصل">الملك فيصل</option>

<option value="الخالدية">الخالدية</option>
  
  <option value="السليمانية">السليمانية</option> 
  <option value="حطين">حطين</option>
  
  <option value="أم سليم">أم سليم</option> 
  
  <option value="المصيف">المصيف</option>
  
  <option value="الطريف">الطريف</option>
 <option value="صلاح الدين">صلاح الدين</option>
  
  
         </select>
          </div>
  <script type="text/javascript">
  document.getElementById('address').value = "<?php echo $row['address'];?>";
</script>
            
           
           
        </div>
       
        <input type="hidden" name="id" value="<?=$row['id']?>">

          <input type="submit"  id="SubmitButtun" name="edit" value="تعديل" class="fbutton">
            <a href="javascript:history.go(-1)" class="Bbutton">الغاء </a>
       
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
var format = /[`!@#$%^&*()_+\-=\[\]{};'":\\|,.<>\/?~]/;
  var fname = document.getElementById("fname").value;
  var address = document.getElementById("address").value;
 if (fname.match(format)){
         document.getElementById("er6").innerHTML="فضلا ، ادخل اسم بلا علامات خاصة";
          document.getElementById("fname").style.borderColor="red";
        count++;
     }else if(!fname.match(format)&&fname.match(regex)){
        document.getElementById("er6").innerHTML="";
        document.getElementById("fname").style.borderColor="#9b59b6";
        count--;
       
     }
        else if (!fname.match(regex)){
                 document.getElementById("er6").innerHTML="فضلا ، ادخل اسم باللغة العربية";
                  document.getElementById("fname").style.borderColor="red";
                count++;
             }else{
                document.getElementById("er6").innerHTML="";
                document.getElementById("fname").style.borderColor="#9b59b6";
                count--;
             }


  }
   function ms(){
    e6=document.getElementById("fname").style.borderColor;
     er=document.getElementById("email").style.borderColor;
         er5=document.getElementById("phone").style.borderColor;
     if(!(er=="red"|| er5=="red" ||er6=="red")){
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
                          javascript:history.go(-1) 
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
