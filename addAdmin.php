<?php 
session_start();
//check if user is admin or restrict him/her 
require 'layout/adminHeader.php';
//connect to config.php page 
require 'config.php';
// change title name
echo "<script> document.title='إضافة مشرف' </script>";
//Include required PHPMailer files
	require 'includes/PHPMailer.php';
	require 'includes/SMTP.php';
	require 'includes/Exception.php';
//Define name spaces
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

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
       $query = "INSERT INTO `admin` (`email_address`,`id`, `password`, `salt`, `first_name`, `last_name`, `gender`, `phone_number`, `address`) VALUES ('$email_address',223,'$password','$salt','$first_name','$last_name','$gender','$phone_number','$address')";
        $results = mysqli_query($connection, $query);
       
                 if ( false===$results ) {
                    echo "<p style='text-align: right; margin-top:120px;'>". "نعتذر ، حدث خطأ"."</p>";
                                    }
                 else {
                       //echo success adding member
                          echo "<script>
           
                Swal.fire({
                     icon: 'success',
                     title: 'تم إضافة المشرف بنجاح',
                     text: '',
                     showConfirmButton: true,
                     confirmButtonText:'إغلاق ',
                     closeOnConfirm: false

                     }).then((result) => {
                         location.replace('board.php'); 
                         })

                 </script>";
//send an auto email including the email and password if the member is added
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
	$mail->Body = "مرحبا "."$first_name".","."<br>"."  نرحب بانضمامك لفريق عمل نادي تاج التطوعي تجد أدناه معلومات الدخول الخاصة بك"."<br>".
                "$email_address"." : اسم المستخدم "."<br>".
                $_POST['pass']." : كلمة المرور "."<br>".
                "! نتطلع للعمل معك ";
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
 }}

?>

<element dir="rtl">

  
    <!-- Form that will appear to user -->
    <body class="reg" onkeyup="my();" >
        <div class="container5">
    <div class="title" dir="rtl">إضافة المشرفين</div>
    <div class="content">
        <form name="form" action="addAdmin.php" method="post"  >
        <div class="user-details">
            <div class="input-box">
            <span class="details" dir="rtl">الأسم الأول</span> 
           <input type="text" name="fname" id="fname" onkeyup="ValidateName() " placeholder="ادخل الاسم الاول" dir="rtl" required="required">
            <p id="er6" style="color: red;"></p>
          </div>
            
             <div class="input-box">
            <span class="details" dir="rtl">الأسم الثاني</span>
            <input type="text" name="lname" id="lname" onkeyup="ValidateName()" placeholder="ادخل الاسم الثاني" dir="rtl" required="required">
            <p id="er7" style="color: red;"></p>
          </div>
            
          <div class="input-box">
            <span class="details" dir="rtl">كلمة السر</span>
            
            <input type="password" name="pass" id="pass" onfocus="ValidatePassword()" onkeyup="ValidatePassword()" placeholder="ادخل كلمة السر" dir="rtl" required="required">
            <p id="8char" style="color: red;"></p>
            <p id="upper" style="color: red;"></p>
            <p id="lower" style="color: red;"></p>
            <p id="num" style="color: red;"></p>
            <p id="symbol" style="color: red;"></p>
          </div>
            <div class="input-box">
            <span class="details" dir="rtl">تأكيد كلمة السر</span>
            <input type="password" name="confirmpass" id="confirmpass" onkeyup="ValidatePassword()"  placeholder="ادخل تأكيد كلمة السر" dir="rtl" required="required">
             <p id="er4" style="color: red;"></p>
          </div>
            <div class="input-box">
            <span class="details" dir="rtl">البريد الالكتروني</span>
            <input type="email" name="email" id="email" onkeyup="ValidateEmail()" placeholder="ادخل البريد الإلكتروني" dir="rtl" required="required">
            <p id="er" style="color: red;"></p>
          </div>
         
          <div class="input-box">
            <span class="details" dir="rtl">رقم الهاتف</span>
            <input type="number"  onkeyup="ValidatePhone()" name="phone" id="phone" placeholder="05XXXXXXXX" dir="rtl" required="required">
            <p id="er5" style="color: red;"></p>
          </div>
         
            
            <div class="input-box">
            <span class="details" dir="rtl">العنوان</span>
            <input type="text" name="address" onkeyup="ValidateName()" id="address" placeholder="المدينة، الحي، الشارع"  dir="rtl" required="required">
           <p id="er8" style="color: red;"></p>
            </div>
            
            
               <div class="gender-details" dir="rtl">
          <input type="radio" name="gender" id="dot-1" value="ذكر" checked="checked">
          <input type="radio" name="gender" id="dot-2" value="أنثى" >
   
          <span class="gender-title" dir="rtl" >الجنس</span>
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
   //Validate password
       function ValidatePassword() {
            var lowerCaseLetters = /[a-z]/g;
            var upperCaseLetters = /[A-Z]/g;
            var numbers = /[0-9]/g;
            var symbol = /[!@#\$%\^&\*]/g;
            var password = document.getElementById("pass").value;
            var confirmPassword = document.getElementById("confirmpass").value;
              if (!password.match(upperCaseLetters)){
                  document.getElementById("upper").innerHTML="<li class='fa fa-remove'></li>"+"-يجب أن تحتوي على حرف كبير   <br>";
                  document.getElementById("pass").style.borderColor="red";
                   document.getElementById("upper").style.color="red";
                   count++;
             }else{
                document.getElementById("upper").innerHTML="<li class='fa fa-check'></li>"+"-يجب أن تحتوي على حرف كبير   <br>";
                document.getElementById("upper").style.color="green";
                document.getElementById("pass").style.borderColor="#9b59b6";
                 count--;
             }
               if (!password.match(lowerCaseLetters)){
                  document.getElementById("lower").innerHTML="<li class='fa fa-remove'></li>"+"- يجب أن تحتوي على حرف صغير<br>";
                  document.getElementById("pass").style.borderColor="red";
                   document.getElementById("lower").style.color="red";
                   count++;
             }else{
                document.getElementById("lower").innerHTML="<li class='fa fa-check'></li>"+"- يجب أن تحتوي على حرف صغير<br>";
                document.getElementById("lower").style.color="green";
                document.getElementById("pass").style.borderColor="#9b59b6";
                 count--;
             }
                 if (!password.match(numbers)){
                  document.getElementById("num").innerHTML="<li class='fa fa-remove'></li>"+"-يجب أن تحتوي على رقم   <br>";
                  document.getElementById("pass").style.borderColor="red";
                   document.getElementById("num").style.color="red";
                   count++;
             }else{
                document.getElementById("num").innerHTML="<li class='fa fa-check'></li>"+"-يجب أن تحتوي على رقم   <br>";
                document.getElementById("num").style.color="green";
                document.getElementById("pass").style.borderColor="#9b59b6";
                 count--;
             }
              if (!password.match(symbol)){
                  document.getElementById("symbol").innerHTML="<li class='fa fa-remove'></li>"+"-يجب أن تحتوي على علامة خاصة   <br>";
                  document.getElementById("pass").style.borderColor="red";
                   document.getElementById("symbol").style.color="red";
                   count++;
             }else{
                document.getElementById("symbol").innerHTML="<li class='fa fa-check'></li>"+"-يجب أن تحتوي على علامة خاصة   <br>";
                document.getElementById("symbol").style.color="green";
                document.getElementById("pass").style.borderColor="#9b59b6";
                 count--;
             }
               if (password.length < 8){
                  document.getElementById("8char").innerHTML="<li class='fa fa-remove'></li>"+"-يجب أن تتكون من 8 خانات   <br>";
                  document.getElementById("pass").style.borderColor="red";
                   document.getElementById("8char").style.color="red";
                   count++;
             }else{
                document.getElementById("8char").innerHTML="<li class='fa fa-check'></li>"+"-يجب أن تتكون من 8 خانات   <br>";
                document.getElementById("8char").style.color="green";
                document.getElementById("pass").style.borderColor="#9b59b6";
                 count--;
             }
            if (password != confirmPassword) {
                document.getElementById("er4").innerHTML="كلمة المرور غير متطابقة";
              document.getElementById("confirmpass").style.borderColor="red";
                count++;

            }else{
            document.getElementById("er4").innerHTML="";
              document.getElementById("confirmpass").style.borderColor="#9b59b6";
              count--;

            }
        }
        //Validate email
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
        //Validate phone number if it begin with 0 and its length 10
           function ValidatePhone() {
      var regex="^05[0-9]{8}$";
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
    //Validate first name,last name if it is in arabic and its only charichaters
    /// //Validate address thats written in arabic number are allowed
          function ValidateName() {
      var regex="^[\u0621-\u064A\040]+$";
      var reg="[\u0600-\u06FF]";
      var fname = document.getElementById("fname").value;
       var lname = document.getElementById("lname").value;
       var address = document.getElementById("address").value;
      
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
      
    }
    // if any input is had an error user can not click on add button until every inpunt is written correct
    function my(){
        er=document.getElementById("fname").style.borderColor;
        er1=document.getElementById("lname").style.borderColor;
       // er2=document.getElementById("sp").style.borderColor;
        er3=document.getElementById("pass").style.borderColor;
        er4=document.getElementById("confirmpass").style.borderColor;
         er5=document.getElementById("email").style.borderColor;
         // er6=document.getElementById("ConfirmEmail").style.borderColor;
           er7=document.getElementById("phone").style.borderColor;
            er8=document.getElementById("address").style.borderColor;
         if(!(er=="red"||er1=="red"||er3=="red"||er4=="red"||er5=="red"||er7=="red" ||er8=="red")){
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

