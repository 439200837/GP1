<?php
session_start();
if($_SESSION['isCodeCorrect']!==true){
  header("location:log-in.php");
}
require 'layout/header.php';
require 'config.php';  
// change title name
echo "<script> document.title='إعادة تعيين كلمة المرور' </script>";
$message="";
$email_address=$_GET['email'];
if(isset($_POST['log'])){
     //$user_type = $_POST['user'];
    if($_SESSION["type"]==='member'){
      $email=$_POST['email'];
     //bring the email information to check if it has been stored before
  	$sql_e = "SELECT * FROM `member` WHERE `email_address`='$email'";
  	$res_e = mysqli_query($connection, $sql_e);
        	 if(mysqli_num_rows($res_e) < 0){            
//echo to user that this email is not have an account
      $message= "<p style='text-align: right; color:red; margin-top:20px;'>"."البريد الإلكتروني غير مسجل"."</p>";
    }//end if the email is not in member table
    else{
     //this is mean that the eamil is correct
       $email=$_POST['email']; 
     //Retreive salt fron database
      while($row = mysqli_fetch_assoc($res_e)) {
        $salt = $row['salt'];
         }
     //The entered password will be hashed using CRYPT function
     //adding salt that is saved in user row in database
     $hashedPass= crypt($_POST['password'],$salt);
     //update user password
      $sql_update ="UPDATE `member` SET `password`='$hashedPass'
                                     WHERE `email_address`='$email'";
                                  
$query_update = mysqli_query( $connection, $sql_update);
if(mysqli_affected_rows($connection) >0){
  echo "<script>
           
                Swal.fire({
                     icon: 'success',
                     title: 'تم تغيير كلمة المرور بنجاح',
                     text: 'سيتم إرجاعك إلى صفحة تسجيل الدخول',
                     showConfirmButton: true,
                     confirmButtonText:'إغلاق ',
                     closeOnConfirm: false

                     }).then((result) => {
                         location.replace('log-in.php'); 
                         })

                 </script>";

}//if the editing is done correctly
else{
  $r=  mysqli_num_rows($query_update);
 //if the sql statment has an error
$message= "<p style='text-align: right; color:red; margin-top:20px;'>"."حدث خطأ"."</p>";

}//if the editing is done correctly
    }//end if the email is aviliable    
        
        
        
    }//end if user is member
    elseif ($_SESSION["type"]==='volunteer') {
        $Vemail=$_POST['email'];
       //bring the email information to check if it has been stored before
  	$sql_e = "SELECT * FROM `volunteer` WHERE `email_address`='$Vemail'";
  	$res_e = mysqli_query($connection, $sql_e);
        	 if($res_e <= 0){            
//echo to user that this email is not have an account
      $message= "<p style='text-align: right; color:red; margin-top:20px;'>"."البريد الإلكتروني غير مسجل"."</p>";
    }//end if the email is not in volunteer table
    else{
     //this is mean that the eamil is correct 
     //Retreive salt fron database
      while($row = mysqli_fetch_assoc($res_e)) {
        $salt = $row['salt'];
         }
     //The entered password will be hashed using CRYPT function
     //adding salt that is saved in user row in database
     $hashedPass= crypt($_POST['password'],$salt);
     //update user password
      $sql_update1 ="UPDATE `volunteer` SET `password`='$hashedPass'
                                     WHERE `email_address`='$Vemail'";
                                  
$query_update1 = mysqli_query( $connection, $sql_update1);
if(mysqli_affected_rows($connection) >0){
echo "<script>
           
                Swal.fire({
                     icon: 'success',
                     title: 'تم تغيير كلمة المرور بنجاح',
                     text: 'سيتم إرجاعك إلى صفحة تسجيل الدخول',
                     showConfirmButton: true,
                     confirmButtonText:'إغلاق ',
                     closeOnConfirm: false

                     }).then((result) => {
                         location.replace('log-in.php'); 
                         })

                 </script>";
}//if the editing is done correctly

else{
 //if the sql statment has an error
$message= "<p style='text-align: right; color:red; margin-top:20px;'>"."حدث خطأ"."</p>";
 
    }//end if the email is aviliable    
        
    }        
        
   
}//end if Volunteer
           }//end if the form is POST

?>
<element dir="rtl">
    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto" onclick="check()">
     <div class="card card0 border-0">
        <div class="row d-flex">
            <form action="reset.php?email=<?php echo $email_address;?>" method="POST">
            <div class="col-lg-6">
                <div class="card2 card border-0 px-4 py-5">
                     <div class="row px-3 mb-4 steps">
                          <h6 class="mb-0 text-sm step1">الخطوة الأولى</h6>
                           <h6 class="mb-0 text-sm step22">الخطوة الثانية </h6>
                            <h6 class="mb-0 text-sm step2">الخطوة الأخيرة </h6>
                    </div>
                <div class="line"></div>
                    <div class="user-type">
                      <div class="radio-toolbar">
</div>
                    </div>
                    <div class="row px-3 mb-4">
                  
                    </div>
                     
                    <div class="row px-3"> <label class="mb-1">
                            <?php  echo $message;?>
                            <p id="error" style='text-align: right; color:red; margin-top:20px;'></p>
                            </div>
                    <div class="row px-3"> <label class="mb-1">
                            <h6 class="mb-0 text-sm">كلمة المرور الجديدة</h6>
                        </label> <input class="input" type="password" name="password" onkeyup="ValidatePassword()" onfocus="ValidatePassword()" id="txtPassword" placeholder="ادخل كلمة المرور" required>
                        <div class="errorDiv">
                        <p id="8char" style="color: red;"></p>
                        <p id="upper" style="color: red;"></p>
                        <p id="lower" style="color: red;"></p>
                        <p id="num" style="color: red;"></p>
                        <p id="symbol" style="color: red;"></p>
                        </div>
                    </div>
                        <div class="row px-3"> <label class="mb-1">
                            <h6 class="mb-0 text-sm">تأكيد كلمة المرور</h6>
                            </label> <input class="input" onkeyup="ValidatePassword()" type="password" id="txtConfirmPassword" name="conPassword" id="pass" placeholder="ادخل تأكيد كلمة المرور" required>
                        <p id="er4" style="color: red;"></p>
                        </div>
                    <input class="input" type="hidden" name="email" value="<?=$email_address?>">
                    <div class="row mb-3 px-3"> <button name="log" type="submit" class="btn text-center" style="margin-top: 10px;" onfocus="Validation()" id="SubmitButtun" >تعديل </button> </div>
                    <div class="row mb-4 px-3 insertAccount"> <small class="font-weight-bold">ليس لديك حساب ؟ <a class="text-danger " href="index.php">إنشاء حساب</a></small> </div>
                </div>
        </div>
               <div class="col-lg-6">
                <div class="card1 pb-5">
                    <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img src="https://i.imgur.com/uNGdWHi.png" class="image"> </div>
                </div>
            </div>
                 </form>
        </div>
    </div>
</div>
   <element dir="ltr">
      <?php require 'layout/footer.php';
//close database connection
       mysqli_close($connection);
      ?>
    </body>
</html>

<script>
    //function check that inputs are not empty 
  function Validation() {
// save value of the input form
var email = document.getElementById("email").value;
var pass = document.getElementById("txtPassword").value;
if(email==="" || pass===""){
  //error message will appear to user 
 document.getElementById("error").innerHTML="فضلا ، قم بكتابة الخانتين المطلوبة" ;  
}}
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
         //check if there are any input has an error then user can not click on submit button
    function check(){
        er3=document.getElementById("txtPassword").style.borderColor;
        er4=document.getElementById("txtConfirmPassword").style.borderColor;
        er5=document.getElementById("error").value;
         if(!(er3=="red"||er4=="red")){
            document.getElementById("SubmitButtun").disabled=false;
         } else{
              document.getElementById("SubmitButtun").disabled=true;
         }
   }




</script>

