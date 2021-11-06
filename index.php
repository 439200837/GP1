<?php require 'layout/header.php';
require 'config.php';  
// change title name
echo "<script> document.title='إنشاء حساب' </script>";
if(isset($_POST['add'])){

    $pass1=$_POST["password"];


  	$first_name = $_POST['first_name'];
  	$last_name = $_POST['last_name'];
  	$email_address = $_POST['email_address'];
  	$dateOfBirth = $_POST['dateOfBirth'];
  	$gender = $_POST['gender'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $educational_level = $_POST['educational_level'];
   // $cumlativeRating = $_POST['cumlativeRating'];
  	$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

  	$sql_p = "SELECT * FROM volunteer WHERE phone_number='$phone_number'";
  	$sql_e = "SELECT * FROM volunteer WHERE email_address='$email_address'";

    $res_p = mysqli_query($connection, $sql_p);
  	$res_e = mysqli_query($connection, $sql_e);

  	if (mysqli_num_rows($res_p) > 0){
        echo  "<p style='text-align: right; color:red; margin-top:120px;'>"."نعتذر ، الرقم مستخدم من قبل عضو اخر ، يرجى تغيير الرقم"."</p>"; }
        else if(mysqli_num_rows($res_e) > 0){
        echo "<p style='text-align: right; color:red; margin-top:120px;'>". "نعتذر ، البريد الإلكتروني مستخدم من قبل عضو اخر يرجى تغيير البريد الإلكتروني"."</p>";
    }else{
       // echo 'تم تسجيل بياناتك بنجاح';
       $query = "INSERT INTO `volunteer` (email_address,first_name,last_name,gender,dateOfBirth,phone_number,address,cumlativeRating,educational_level,password)
	 VALUES ('$email_address','$first_name','$last_name','$gender','$dateOfBirth','$phone_number','$address','0.00','$educational_level','$password')";
        $results = mysqli_query($connection, $query);

           if($results){
               if (isset($_POST['preference1'])){ $preference1 = $_POST['preference1'];
    $query2="INSERT INTO `preference`(`Preferences`, `Vemail_address`) VALUES ('$preference1','$email_address')";
     $results2 = mysqli_query($connection, $query2);
   }
   if (isset($_POST['preference2'])){ $preference2 = $_POST['preference2'];
     $query3="INSERT INTO `preference`(`Preferences`, `Vemail_address`) VALUES ('$preference2','$email_address')";
     $results3 = mysqli_query($connection, $query3);
   }
   if (isset($_POST['preference3'])){ $preference3 = $_POST['preference3'];
    $query4="INSERT INTO `preference`(`Preferences`, `Vemail_address`) VALUES ('$preference3','$email_address')";
     $results4 = mysqli_query($connection, $query4);
   }
    if (isset($_POST['preference4'])){ $preference4 = $_POST['preference4'];
     $query5="INSERT INTO `preference`(`Preferences`, `Vemail_address`) VALUES ('$preference4','$email_address')";
     $results5 = mysqli_query($connection, $query5);
    }

    if (isset($_POST['s1'])){ $skill1 = $_POST['s1'];
    $query6="INSERT INTO `skill`(`skills`, `Vemail_address`) VALUES ('$skill1','$email_address')";
     $results6 = mysqli_query($connection, $query6);
   }
    if (isset($_POST['s2'])){ $skill2 = $_POST['s2'];
    $query7="INSERT INTO `skill`(`skills`, `Vemail_address`) VALUES ('$skill2','$email_address')";
     $results7 = mysqli_query($connection, $query7);
   }
    if (isset($_POST['s3'])){ $skill3 = $_POST['s3'];
    $query8="INSERT INTO `skill`(`skills`, `Vemail_address`) VALUES ('$skill3','$email_address')";
     $results8 = mysqli_query($connection, $query8);
   }
    if (isset($_POST['s4'])&& $_POST['s4'] != ""){ $skill4 = $_POST['s4'];
    $query9="INSERT INTO `skill`(`skills`, `Vemail_address`) VALUES ('$skill4','$email_address')";
     $results9 = mysqli_query($connection, $query9);
   }
    if (isset($_POST['specialization'])){ $specialization = $_POST['specialization'];
    $query10="INSERT INTO `qualification`(`qualifications`, `Vemail_address`) VALUES ('$specialization','$email_address')";
     $results10 = mysqli_query($connection, $query10);
   }
             echo "<script>
           
                Swal.fire({
                     icon: 'success',
                     title: 'تم إنشاء حسابك بنجاح',
                     text: '',
                     showConfirmButton: true,
                     confirmButtonText:'إغلاق ',
                     closeOnConfirm: false

                     }).then((result) => {
                         location.replace('index.php'); 
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
    <title class="reg">تسجيل المتطوعين</title>
    <link rel="stylesheet" href="css/n.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <header class="header">



   </header>
   <body class="reg" onchange="my()">
        <div class="container5">
    <div class="title">تسجيل المتطوعين</div>
    <div class="content">
        <form action="index.php" method="POST">
        <div class="user-details">

            <div class="input-box">
            <span class="details" dir="rtl">الاسم الأول</span>
            <input type="text" onchange="ValidateName()" id="fname" placeholder="ادخل الاسم الاول" name="first_name" dir="rtl" required="required">
            <p id="er6" style="color: red;"></p>
            </div>
             <div class="input-box">
            <span class="details" dir="rtl">الاسم الثاني</span>
            <input type="text" onchange="ValidateName()" id="lname" name="last_name" placeholder="ادخل الاسم الثاني" dir="rtl" required="required">
           <p id="er7" style="color: red;"></p>
             </div>


            <div class="input-box">
            <span class="details" dir="rtl">البريد الإلكتروني</span>
            <input type="email" onchange="ValidateEmail()" name="email_address" id="email" placeholder="mail@example.com"  dir="rtl" required="required">
            <p id="er" style="color: red;"></p>
          </div>
              <div class="input-box">
            <span class="details" dir="rtl">تأكيد البريد الإلكتروني</span>
            <input type="email" onchange="ValidateEmail()" id="ConfirmEmail" placeholder="mail@example.com"  dir="rtl" required="required">
            <p id="er2" style="color: red;"></p>
              </div>
                 <div class="input-box">
            <span class="details" dir="rtl">كلمة المرور</span>
            <input type="password" onkeyup="ValidatePassword()" onfocus="ValidatePassword()" id="txtPassword" name="password" placeholder="8 خانات على الأقل + حروف تحتوي على حرف كبير + أرقام + علامات خاصة"  dir="rtl" required="required">
            <p id="8char" style="color: red;"></p>
            <p id="upper" style="color: red;"></p>
            <p id="lower" style="color: red;"></p>
            <p id="num" style="color: red;"></p>
            <p id="symbol" style="color: red;"></p>
                 </div>
          <div class="input-box">
            <span class="details" dir="rtl">تأكيد كلمة المرور</span>
            <input onchange="ValidatePassword()" type="password" id="txtConfirmPassword" placeholder="ادخل تأكيد كلمة المرور"  dir="rtl" required="required">
           <p id="er4" style="color: red;"></p>
          </div>
                <div class="input-box">
            <span class="details" dir="rtl">تاريخ الميلاد</span>
            <input type="date" name="dateOfBirth" id="birth" placeholder="تاريخ الميلاد"  dir="rtl" required="required">
          </div>

          <div class="gender-details" dir="rtl">
          <input type="radio" name="gender" id="dot-1" value="ذكر" checked="checked">
          <input type="radio" name="gender" id="dot-2" value="أنثى">

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
             <div class="input-box">
            <span class="details" dir="rtl">رقم الهاتف</span>
            <input onchange="ValidatePhone()" type="number" name="phone_number"  id="phone" placeholder="05XXXXXXXX" " dir="rtl" required="required">
             <p id="er5" style="color: red;"></p>
             </div>
             <div class="input-box">
            <span class="details" dir="rtl">العنوان</span>
            <input type="text" onchange="ValidateName()"id="address" name="address" placeholder="المدينة ، الحي ، الشارع"  dir="rtl" required="required">
            <p id="er8" style="color: red;"></p>
             </div>
         <div class="input-box">
            <span class="details" dir="rtl">المستوى التعليمي</span>
         <select name="educational_level" id="edu"  dir="rtl" required="required">
  <option value="تعليم إبتدائي">تعليم إبتدائي</option>
  <option value="تعليم متوسط">تعليم متوسط</option>
  <option value="تعليم ثانوي">تعليم ثانوي</option>
  <option value="درجة بكالوريس">درجة بكالوريس</option>
   <option value="درجة الماجستير">درجة الماجستير</option>
    <option value="دكتوراه">دكتوراه</option>
     <option value="دبلوم">دبلوم</option>
      <option value="شهادة التأهيل المهني">شهادة التأهيل المهني</option>
            </select>
          </div>
              <div class="input-box">
            <span class="details" dir="rtl">اسم التخصص</span>
            <input type="text" onchange="ValidateName()" id="sp" name="specialization" placeholder="ادخل اسم التخصص"  dir="rtl" required="required">
            <p id="er9" style="color: red;"></p>
              </div>
          <div  dir="rtl" id="Skilll">

        <span  dir="rtl" >ماذا تفضل ؟</span><br><br>
        <input  type="checkbox" name="preference1" value="العمل بدون تواصل مع المستفيدين" checked="checked"><span class="skill" >العمل بدون تواصل مع المستفيدين</span><br>
        <input  type="checkbox" name="preference2" value="أفضل التعامل مع كبار السن"><span class="skill" >أفضل التعامل مع كبار السن</span><br>
        <input type="checkbox" name="preference3" value="أفضل التعامل مع الأطفال"><span class="skill" >أفضل التعامل مع الأطفال</span><br>
        <input type="checkbox" name="preference4" value="أفضل التعامل مع ذوي الاحتياجات الخاصة"><span class="skill" >أفضل التعامل مع ذوي الاحتياجات الخاصة</span><br>
<br>
        </div>

        <!-- <div class="input-box">
            <span class="details" dir="rtl">ماذا تفضل؟</span>
          <select name="preference" id="pref"  dir="rtl" >
              <option value="undirect">العمل بدون تواصل مع المستفيدين</option>
              <option value="old">أفضل التعامل مع كبار السن</option>
              <option value="children">أفضل التعامل مع الأطفال</option>
              <option value="handdicaped">أفضل التعامل مع ذوي الاحتياجات الخاصة</option>
            </select>
        </div> -->

            <div  dir="rtl" id="Skilll">

        <span  dir="rtl" >المهارات</span><br><br>
        <input  type="checkbox" id="s1" name="s1" value="استخدام الحاسب الآلي" ><span class="skill" >استخدام الحاسب الآلي</span><br>
        <input  type="checkbox" id="s2" name="s2" value="العمل الجماعي" ><span class="skill" >العمل الجماعي</span><br>
        <input type="checkbox" id="s3" name="s3" value="امكانية العمل تحت الضغط" ><span class="skill" >امكانية العمل تحت الضغط</span><br>
        <input type="text" class="skills" name="s4" id="skills" placeholder="مهارات أخرى"  dir="rtl">

        </div>


        </div>

        <input id="SubmitButtun" type="submit" name='add' class="fbutton" value="تسجيل">
            <input type="button" value="إلغاء" class="Bbutton">
      </form>
    </div>
  </div>

  <script type="text/javascript">
      var count=0;
   document.getElementById("SubmitButtun").disabled=true;
        function ValidatePassword() {
            var lowerCaseLetters = /[a-z]/g;
            var upperCaseLetters = /[A-Z]/g;
            var numbers = /[0-9]/g;
            var symbol = /[!@#\$%\^&\*]/g;
            var password = document.getElementById("txtPassword").value;
            var confirmPassword = document.getElementById("txtConfirmPassword").value;
              if (!password.match(upperCaseLetters)){
                 document.getElementById("upper").innerHTML="-يجب أن تحتوي على حرف كبير   <br>";
                  document.getElementById("txtPassword").style.borderColor="red";
                   document.getElementById("upper").style.color="red";
                   count++;
             }else{
                document.getElementById("upper").style.color="green";
                document.getElementById("txtPassword").style.borderColor="#9b59b6";
                 count--;
             }
               if (!password.match(lowerCaseLetters)){
                 document.getElementById("lower").innerHTML="-يجب أن تحتوي على حرف صغير   <br>";
                  document.getElementById("txtPassword").style.borderColor="red";
                   document.getElementById("lower").style.color="red";
                   count++;
             }else{
                document.getElementById("lower").style.color="green";
                document.getElementById("txtPassword").style.borderColor="#9b59b6";
                 count--;
             }
                 if (!password.match(numbers)){
                 document.getElementById("num").innerHTML="-يجب أن تحتوي على رقم   <br>";
                  document.getElementById("txtPassword").style.borderColor="red";
                   document.getElementById("num").style.color="red";
                   count++;
             }else{
                document.getElementById("num").style.color="green";
                document.getElementById("txtPassword").style.borderColor="#9b59b6";
                 count--;
             }
              if (!password.match(symbol)){
                 document.getElementById("symbol").innerHTML="-يجب أن تحتوي على علامة خاصة   <br>";
                  document.getElementById("txtPassword").style.borderColor="red";
                   document.getElementById("symbol").style.color="red";
                   count++;
             }else{
                document.getElementById("symbol").style.color="green";
                document.getElementById("txtPassword").style.borderColor="#9b59b6";
                 count--;
             }
               if (password.length < 8){
                 document.getElementById("8char").innerHTML="-يجب أن تتكون من 8 خانات   <br>";
                  document.getElementById("txtPassword").style.borderColor="red";
                   document.getElementById("8char").style.color="red";
                   count++;
             }else{
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
          function ValidateName() {
      var regex="^[\u0621-\u064A\040]+$";
      var reg="[\u0600-\u06FF]";
      var fname = document.getElementById("fname").value;
       var lname = document.getElementById("lname").value;
       var address = document.getElementById("address").value;
       var sp = document.getElementById("sp").value;
         if (!fname.match(regex)){
                 document.getElementById("er6").innerHTML="فضلا ، ادخل اسم صحيح";
                  document.getElementById("fname").style.borderColor="red";
                count++;
             }else{
                document.getElementById("er6").innerHTML="";
                document.getElementById("fname").style.borderColor="#9b59b6";
                count--;
             }
     if (!lname.match(regex) &&lname!==""){
                 document.getElementById("er7").innerHTML="فضلا ، ادخل اسم صحيح";
                  document.getElementById("lname").style.borderColor="red";
                  count++;
             }else{
                document.getElementById("er7").innerHTML="";
                document.getElementById("lname").style.borderColor="#9b59b6";
                 count--;
             }
             if (!address.match(reg) &&address!==""){
                 document.getElementById("er8").innerHTML="فضلا ، ادخل عنوان صحيح";
                  document.getElementById("address").style.borderColor="red";
              count++;
                   return false;
             }else{
                document.getElementById("er8").innerHTML="";
                document.getElementById("address").style.borderColor="#9b59b6";
              count--;
             }
                if (!sp.match(reg) &&sp!==""){
                 document.getElementById("er9").innerHTML="فضلا ، ادخل عنوان صحيح";
                 document.getElementById("sp").style.borderColor="red";
                 count++;
             }else{
                document.getElementById("er9").innerHTML="";
                document.getElementById("sp").style.borderColor="#9b59b6";
                 count--;
             }
    }
    function my(){
        er=document.getElementById("fname").style.borderColor;
        er1=document.getElementById("lname").style.borderColor;
        er2=document.getElementById("sp").style.borderColor;
        er3=document.getElementById("txtPassword").style.borderColor;
        er4=document.getElementById("txtConfirmPassword").style.borderColor;
         er5=document.getElementById("email").style.borderColor;
          er6=document.getElementById("ConfirmEmail").style.borderColor;
           er7=document.getElementById("phone").style.borderColor;
            er8=document.getElementById("address").style.borderColor;
         if(!(er=="red"||er1=="red"||er2=="red"||er3=="red"||er4=="red"||er5=="red" ||er6=="red" ||er7=="red" ||er8=="red")){
            document.getElementById("SubmitButtun").disabled=false;
         } else{
              document.getElementById("SubmitButtun").disabled=true;
         }
   }
    </script>

</body>

    <element dir="ltr">
      <?php require 'layout/footer.php';

       mysqli_close($connection);
?>
    </body>
</html>