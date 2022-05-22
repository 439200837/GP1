<?php 
//connect to the header.php page and to config.php page
require 'layout/header.php';
require 'config.php';  
// change title name
echo "<script> document.title='إنشاء حساب داعم' </script>";
if(isset($_POST['add'])){
//define the variables
    $pass1=$_POST["password"];
    $name = $_POST['first_name'];
    $email_address = $_POST['email_address'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
// use hash function for Password encryption
   $b=uniqid();
   $salt ='$6$rounds=5000'.$b;
 $hashed_password = crypt($_POST['password'],$salt);
  //hash_equals($hashed_password, $SavedPass);
//bring the phone number and email information to check if it has been stored before
  	$sql_p = "SELECT * FROM sponsor WHERE phone_number='$phone_number'";
  	$sql_e = "SELECT * FROM sponsor WHERE email_address='$email_address'";

    $res_p = mysqli_query($connection, $sql_p);
  	$res_e = mysqli_query($connection, $sql_e);

  	if (mysqli_num_rows($res_p) > 0){
        echo  "<p style='text-align: right; color:red; margin-top:120px;'>"."نعتذر ، الرقم مستخدم من قبل عضو اخر ، يرجى تغيير الرقم"."</p>"; }
        else if(mysqli_num_rows($res_e) > 0){
        echo "<p style='text-align: right; color:red; margin-top:120px;'>". "نعتذر ، البريد الإلكتروني مستخدم من قبل عضو اخر يرجى تغيير البريد الإلكتروني"."</p>";
    }else{
      //insert into the volunteer table in database
       $query = "INSERT INTO `sponsor` (email_address,name,phone_number,address,password,salt)
	 VALUES ('$email_address','$name','$phone_number','$address','$hashed_password','$salt')";
        $results = mysqli_query($connection, $query);

           if($results){
   //Print the result of creating an account
             echo "<script>
                Swal.fire({
                     icon: 'success',
                     title: 'تم إنشاء حسابك بنجاح',
                     text: '',
                     showConfirmButton: true,
                     confirmButtonText:'إغلاق ',
                     closeOnConfirm: false

                     }).then((result) => {
                         location.replace('sponsorSignUp.php'); 
                         })

                 </script>";      
           } else {
                 echo "<p style='text-align: right; margin-top:120px;'>". "نعتذر ، حدث خطأ"."</p>";
           }
         
 }}

?>
<element dir="rtl">
<html>
    <head>

    <meta charset="UTF-8">
    <title class="reg">إنشاء حساب داعم</title>
    <link rel="stylesheet" href="css/n.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <header class="header">



   </header>
   <body class="reg" onkeyup="my()">
        <div class="container5">
    <div class="title">إنشاء حساب داعم</div>
    <div class="content">
        <form action="sponsorSignUp.php" method="POST">
        <div class="user-details">

            <div class="input-box">
            <span class="details" dir="rtl">الاسم *</span>
            <input type="text" onkeyup="ValidateName()" id="fname" placeholder="ادخل الاسم كامل" name="first_name" dir="rtl" required="required" value="<?php if(isset($_POST['first_name'])) { echo htmlentities ($_POST['first_name']); }?>" >
            <p id="er6" style="color: red;"></p>
            </div>

            <div class="input-box">
            <span class="details" dir="rtl">رقم الهاتف*</span>
            <input onkeyup="ValidatePhone()" type="text" name="phone_number"  id="phone" placeholder="05XXXXXXXX" " dir="rtl" required="required" value="<?php if(isset($_POST['phone_number'])) { echo htmlentities ($_POST['phone_number']); }?>">
             <p id="er5" style="color: red;"></p>
             </div>
            
            <div class="input-box">
            <span class="details" dir="rtl">البريد الإلكتروني*</span>
            <input type="email" onchange="ValidateEmail()" name="email_address" id="email" placeholder="mail@example.com"  dir="rtl" required="required" value="<?php if(isset($_POST['email_address'])) { echo htmlentities ($_POST['email_address']); }?>">
            <p id="er" style="color: red;"></p>
          </div>
              <div class="input-box">
            <span class="details" dir="rtl">تأكيد البريد الإلكتروني*</span>
            <input type="email" onkeyup="ValidateEmail()" id="ConfirmEmail" placeholder="mail@example.com"  dir="rtl" required="required">
            <p id="er2" style="color: red;"></p>
              </div>
                 <div class="input-box">
            <span class="details" dir="rtl">كلمة المرور*</span>
            <input type="password" onkeyup="ValidatePassword()" onfocus="ValidatePassword()" id="txtPassword" name="password" placeholder="ادخل كلمة المرور"  dir="rtl" required="required">
            <p id="8char" style="color: red;"></p>
            <p id="upper" style="color: red;"></p>
            <p id="lower" style="color: red;"></p>
            <p id="num" style="color: red;"></p>
            <p id="symbol" style="color: red;"></p>
                 </div>
          <div class="input-box">
            <span class="details" dir="rtl">تأكيد كلمة المرور*</span>
            <input onkeyup="ValidatePassword()" type="password" id="txtConfirmPassword" placeholder="ادخل تأكيد كلمة المرور"  dir="rtl" required="required">
           <p id="er4" style="color: red;"></p>
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
<script type="text/javascript">
  document.getElementById('address').value = "<?php echo $_POST['address'];?>";
</script>          </div>

        </div>

        <input id="SubmitButtun" type="submit" name='add' class="fbutton" value="تسجيل">
            <input type="button" value="إلغاء" class="Bbutton" onClick="history.go(-1);">
      </form>
    </div>
  </div>

  <script type="text/javascript">
      var count=0;
   document.getElementById("SubmitButtun").disabled=true;
        function ValidatePassword() {
            //validate password
            var lowerCaseLetters = /[a-z]/g;
            var upperCaseLetters = /[A-Z]/g;
            var numbers = /[0-9]/g;
            var symbol = /[!@#\$%\^&\*]/g;
            var password = document.getElementById("txtPassword").value;
            var confirmPassword = document.getElementById("txtConfirmPassword").value;
              if (!password.match(upperCaseLetters)){
                 document.getElementById("upper").innerHTML="<li class='fa fa-remove'></li>"+"-يجب أن تحتوي على حرف كبير   <br>";
                  document.getElementById("txtPassword").style.borderColor="red";
                   document.getElementById("upper").style.color="red";
                   count++;
             }else{
                 document.getElementById("upper").innerHTML="<li class='fa fa-check'></li>"+"-يجب أن تحتوي على حرف كبير   <br>";
                document.getElementById("upper").style.color="green";
                document.getElementById("txtPassword").style.borderColor="#9b59b6";
                 count--;
             }
               if (!password.match(lowerCaseLetters)){
                 document.getElementById("lower").innerHTML="<li class='fa fa-remove'></li>"+"- يجب أن تحتوي على حرف صغير<br>";
                  document.getElementById("txtPassword").style.borderColor="red";
                   document.getElementById("lower").style.color="red";
                   count++;
             }else{
                document.getElementById("lower").innerHTML="<li class='fa fa-check'></li>"+"- يجب أن تحتوي على حرف صغير<br>";
                document.getElementById("lower").style.color="green";
                document.getElementById("txtPassword").style.borderColor="#9b59b6";
                 count--;
             }
                 if (!password.match(numbers)){
                 document.getElementById("num").innerHTML="<li class='fa fa-remove'></li>"+"-يجب أن تحتوي على رقم   <br>";
                  document.getElementById("txtPassword").style.borderColor="red";
                   document.getElementById("num").style.color="red";
                   count++;
             }else{
                document.getElementById("num").innerHTML="<li class='fa fa-check'></li>"+"-يجب أن تحتوي على رقم   <br>";
                document.getElementById("num").style.color="green";
                document.getElementById("txtPassword").style.borderColor="#9b59b6";
                 count--;
             }
              if (!password.match(symbol)){
                 document.getElementById("symbol").innerHTML="<li class='fa fa-remove'></li>"+"-يجب أن تحتوي على علامة خاصة   <br>";
                  document.getElementById("txtPassword").style.borderColor="red";
                   document.getElementById("symbol").style.color="red";
                   count++;
             }else{
                document.getElementById("symbol").innerHTML="<li class='fa fa-check'></li>"+"-يجب أن تحتوي على علامة خاصة   <br>";
                document.getElementById("symbol").style.color="green";
                document.getElementById("txtPassword").style.borderColor="#9b59b6";
                 count--;
             }
               if (password.length < 8){
                 document.getElementById("8char").innerHTML="<li class='fa fa-remove'></li>"+"-يجب أن تتكون من 8 خانات   <br>";
                  document.getElementById("txtPassword").style.borderColor="red";
                   document.getElementById("8char").style.color="red";
                   count++;
             }else{
                document.getElementById("8char").innerHTML="<li class='fa fa-check'></li>"+"-يجب أن تتكون من 8 خانات   <br>";
                document.getElementById("8char").style.color="green";
                document.getElementById("txtPassword").style.borderColor="#9b59b6";
                 count--;
             }
            if (password != confirmPassword) {
                document.getElementById("er4").innerHTML="كلمة المرور غير متطابقة";
              document.getElementById("txtConfirmPassword").style.borderColor="red";
                count++;

            }else{
            document.getElementById("er4").innerHTML="";
              document.getElementById("txtConfirmPassword").style.borderColor="#9b59b6";
              count--;

            }
        }
        //validate email
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
             }

            var confirmEmail = document.getElementById("ConfirmEmail").value;
            if (email !== confirmEmail) {
               document.getElementById("er2").innerHTML="البريد الإلكتروني غير متطابق";
              document.getElementById("ConfirmEmail").style.borderColor="red";
            count++;
            }else{
             document.getElementById("er2").innerHTML="";
              document.getElementById("ConfirmEmail").style.borderColor="#9b59b6";
                count--;
            return true;
            }
        }
        //validate phone start with 0 and contain 10 digit
           function ValidatePhone() {
      var regex="^05[0-9]{8}$";
      var phone = document.getElementById("phone").value;
          if (phone.length !==10){
                 document.getElementById("er5").innerHTML="يجب أن يحتوي رقم الهاتف على 10 أرقام";
                  document.getElementById("phone").style.borderColor="red";
                  count++;
             }else if (!phone.match(regex)){
                 document.getElementById("er5").innerHTML="يجب أن يبدأ رقم الهاتف بـ 05";
                  document.getElementById("phone").style.borderColor="red";
                  count++;
             }else{
                document.getElementById("er5").innerHTML="";
                document.getElementById("phone").style.borderColor="#9b59b6";
                count--;
             }

    }
    //validate names, qulification written in arabic and address in arabic and may have digit
          function ValidateName() {
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
    //check if there are any input has an error then user can not click on submit button
    function my(){
        er=document.getElementById("fname").style.borderColor;
        er3=document.getElementById("txtPassword").style.borderColor;
        er4=document.getElementById("txtConfirmPassword").style.borderColor;
         er5=document.getElementById("email").style.borderColor;
          er6=document.getElementById("ConfirmEmail").style.borderColor;
           er7=document.getElementById("phone").style.borderColor;
            er8=document.getElementById("address").style.borderColor;
         if(!(er=="red"||er3=="red"||er4=="red"||er5=="red" ||er6=="red" ||er7=="red" ||er8=="red")){
            document.getElementById("SubmitButtun").disabled=false;
         } else{
              document.getElementById("SubmitButtun").disabled=true;
         }
   }
    </script>

</body>

    <element dir="ltr">
      <?php require 'layout/footer.php';
//close database connection
       mysqli_close($connection);
?>
    </body>
</html>

