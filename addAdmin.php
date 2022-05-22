<?php 
session_start();
//check if user is admin or restrict him/her 
if($_SESSION['logged_in']===true && $_SESSION['type'] ==='admin'){
    require 'layout/AdminHeader.php'; 
 }
 else{
     echo 'sorry ! you are not athorize to access this page'; 
    echo "<script>window.location.href='index.php'</script>"; 
 }
//connect to config.php page 
require 'config.php';
// change title name
echo "<script> document.title='تغيير المشرف' </script>";
//Include required SendGrid files
require 'includes/sendgrid-php/sendgrid-php.php';
use SendGrid\Mail\Mail;

if(isset($_POST['add'])){
  //define the variables
  $first_name = $_POST['fname'];
  $last_name = $_POST['lname'];
  $email_address = $_POST['email'];
  $gender = $_POST['gender'];
    $phone_number = $_POST['phone'];
    $address = $_POST['address'];
 //bring the phone number and email information to check if it has been stored before
  $sql_p = "SELECT * FROM admin WHERE phone_number='$phone_number'";
  $sql_e = "SELECT * FROM admin WHERE email_address='$email_address'";

    $res_p = mysqli_query($connection, $sql_p);
  $res_e = mysqli_query($connection, $sql_e);

  if (mysqli_num_rows($res_p) > 0){
         echo  "<p style='text-align: right; color:red; margin-top:120px;'>"."نعتذر ، الرقم مستخدم من قبل عضو اخر ، يرجى تغيير الرقم"."</p>"; }
        else if(mysqli_num_rows($res_e) > 0){
        echo "<p style=' text-align: right; color:red; margin-top:120px;'>". "نعتذر ، البريد الإلكتروني مستخدم من قبل عضو اخر يرجى تغيير البريد الإلكتروني"."</p>";
    }else{
     
        //insert in member table
          $b=uniqid();
   $salt ='$6$rounds=5000'.$b;
  $password = crypt($_POST['pass'],$salt);
   $sql_update ="UPDATE `admin` SET `email_address`='$email_address',
                                    `first_name`='$first_name',
                                    `last_name`='$last_name',
                                    `gender`='$gender',
                                    `phone_number`='$phone_number',
                                    `address`='$address',`password`='$password',`salt`='$salt' WHERE 1";
        $results = mysqli_query($connection, $sql_update);
       
                 if ( false===$results ) {
echo "<p style='text-align: right; margin-top:120px;'>". "نعتذر ، حدث خطأ"."</p>";
                                    }
                 else {
                       //echo success adding member
                          echo "<script>
           
                Swal.fire({
                     icon: 'success',
                     title: 'تم تغيير حساب المشرف',
                     text: 'سيتم تسجيل الخروج الرجاء الدخول مجددًا بالحساب المدخل الجديد',
                     showConfirmButton: true,
                     confirmButtonText:'إغلاق ',
                     closeOnConfirm: false

                     }).then((result) => {
                         location.replace('logOut.php'); 
                         })

                 </script>";
//send an auto email including the email and password if the member is added
//Create instance of SendGrid
$email = new Mail();
$email->setFrom("tajclubvolunteer@gmail.com", "نادي تاج التطوعي");
$email->addTo("$email_address");
    $email->setSubject("بيانات الدخول إلى نادي تاج التطوعي");
    //Email body
    $email->addContent("text/html","مرحبا "."$first_name".","."<br>"."  نرحب بانضمامك لفريق عمل نادي تاج التطوعي تجد أدناه معلومات الدخول الخاصة بك"."<br>".
                "$email_address"." : اسم المستخدم "."<br>".
                $_POST['pass']." : كلمة المرور "."<br>".
                "! نتطلع للعمل معك ");
$sendgrid = new \SendGrid('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');
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}
                        }
 }}

?>

<element dir="rtl">

  
    <!-- Form that will appear to user -->
    <body class="reg" onkeyup="my();" >
        <div class="container5">
    <div class="title" dir="rtl">تغيير المشرف</div>
    <div class="content">
        <form name="form" action="addAdmin.php" method="post"  >
        <div class="user-details">
            <div class="input-box">
            <span class="details" dir="rtl">الاسم الأول*</span> 
           <input type="text" name="fname" id="fname" onkeyup="ValidateName() " placeholder="ادخل الاسم الاول" dir="rtl" required="required">
            <p id="er6" style="color: red;"></p>
          </div>
            
             <div class="input-box">
            <span class="details" dir="rtl">اسم العائلة *</span>
            <input type="text" name="lname" id="lname" onkeyup="ValidateName()" placeholder="ادخل اسم العائلة" dir="rtl" required="required">
            <p id="er7" style="color: red;"></p>
          </div>
            
          <div class="input-box">
            <span class="details" dir="rtl">*كلمة السر</span>
            
            <input type="password" name="pass" id="txtPassword" onfocus="ValidatePassword()" onkeyup="ValidatePassword()" placeholder="ادخل كلمة السر" dir="rtl" required="required">
            <p id="8char" style="color: red;"></p>
            <p id="upper" style="color: red;"></p>
            <p id="lower" style="color: red;"></p>
            <p id="num" style="color: red;"></p>
            <p id="symbol" style="color: red;"></p>
          </div>
            <div class="input-box">
            <span class="details" dir="rtl">*تأكيد كلمة السر</span>
            <input type="password" name="confirmpass" id="txtConfirmPassword" onkeyup="ValidatePassword()"  placeholder="ادخل تأكيد كلمة السر" dir="rtl" required="required">
             <p id="er4" style="color: red;"></p>
          </div>
            <div class="input-box">
            <span class="details" dir="rtl">البريد الالكتروني*</span>
            <input type="email" name="email" id="email" onkeyup="ValidateEmail()" placeholder="ادخل البريد الإلكتروني" dir="rtl" required="required">
            <p id="er" style="color: red;"></p>
          </div>
         
          <div class="input-box">
            <span class="details" dir="rtl">رقم الهاتف*</span>
            <input type="text"  onkeyup="ValidatePhone()" name="phone" id="phone" placeholder="05XXXXXXXX" dir="rtl" required="required">
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
            
            
               <div class="gender-details" dir="rtl">
          <input type="radio" name="gender" id="dot-1" value="ذكر" checked="checked">
          <input type="radio" name="gender" id="dot-2" value="أنثى" >
   
          <span class="gender-title" dir="rtl" >الجنس*</span>
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
             <input id="Submit" type="submit" name='add' class="fbutton" value="إضافة">
           <a href="board.php"<button id="cancel"  name="cancel" type="button" class="Bbutton">إلغاء</button></a>
      </form>
    </div>
  </div>
<script type="text/javascript">
      var count=0;
   document.getElementById("Submit").disabled=true;
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
       var lname = document.getElementById("lname").value;
 
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
     if (lname.match(format)){
         document.getElementById("er7").innerHTML="فضلا ، ادخل اسم بلا علامات خاصة";
          document.getElementById("lname").style.borderColor="red";
        count++;
     }else if(!lname.match(format)&&lname.match(regex)){
        document.getElementById("er7").innerHTML="";
        document.getElementById("lname").style.borderColor="#9b59b6";
        count--;
       
     }
        else if (!lname.match(regex)){
                document.getElementById("er7").innerHTML="فضلا ، ادخل اسم باللغة العربية";
                  document.getElementById("lname").style.borderColor="red";
                  count++;
             }else{
                document.getElementById("er7").innerHTML="";
                document.getElementById("lname").style.borderColor="#9b59b6";
                 count--;
             }
            
    }
    //check if there are any input has an error then user can not click on submit button
    function my(){
         er=document.getElementById("fname").style.borderColor;
        er1=document.getElementById("lname").style.borderColor;
        er3=document.getElementById("txtPassword").style.borderColor;
        er4=document.getElementById("txtConfirmPassword").style.borderColor;
         er5=document.getElementById("email").style.borderColor;
           er7=document.getElementById("phone").style.borderColor;
         if(!(er=="red"||er1=="red"||er3=="red"||er4=="red"||er5=="red" ||er7=="red")){
            document.getElementById("Submit").disabled=false;
         } else{
              document.getElementById("Submit").disabled=true;
         }
   }
    </script>
        
</body>

    <element dir="ltr">
        <!-- footer calling -->   
      <?php require 'layout/footer.php'; 
     // close database connections 
     mysqli_close($connection);
?>
   </body>
</html>

