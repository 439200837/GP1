<?php
session_start();
ob_start();
flush(); // Flush the buffer
ob_flush();
error_reporting(E_ALL);
ini_set('display_errors',1);
require 'layout/header.php';
require 'config.php';  
// change title name
echo "<script> document.title='إعادة تعيين كلمة المرور' </script>";
$message="";
if(isset($_POST['reset'])){
//define the variables
  	$email_address = $_POST['email'];
//bring the email information to check if it has been stored before
 $sql_e = "SELECT * FROM `member` WHERE `email_address`='$email_address'";
  	$res_e = mysqli_query($connection, $sql_e);
        $sql_v = "SELECT * FROM `volunteer` WHERE `email_address`='$email_address'";
  	$res_v = mysqli_query($connection, $sql_v);
        $sql_s= "SELECT * FROM `sponsor` WHERE `email_address`='$email_address'";
  	$res_s = mysqli_query($connection, $sql_s);
        $sql_a = "SELECT * FROM `admin` WHERE `email_address`='$email_address'";
  	$res_a = mysqli_query($connection, $sql_a);
      if(mysqli_num_rows($res_e) > 0){
      $_SESSION["type"]="member";
    }elseif(mysqli_num_rows($res_v) > 0){
      $_SESSION["type"]="volunteer";
    }elseif(mysqli_num_rows($res_s) > 0){
      $_SESSION["type"]="sponsor";
    }elseif(mysqli_num_rows($res_a) > 0){
      $_SESSION["type"]="admin";
    }
//check if the email it dose not exit in database    
  	 if(mysqli_num_rows($res_e) <= 0 && mysqli_num_rows($res_v) <= 0 && mysqli_num_rows($res_s) <= 0 && mysqli_num_rows($res_a) <= 0){            
//echo to user that this email is not have an account
      $message= "<p style='text-align: right; color:red; margin-top:20px;'>". "البريد الإلكتروني غير مسجل"."</p>";
    }
   
    else{      
//Redirect user to step 2
   echo '<script>window.location.replace("forgetpass2.php?email='.$email_address.'");</script>';
    }//end of case the email is found in database 
           }

?>
<element dir="rtl">
    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
     <div class="card card0 border-0">
        <div class="row d-flex">
            <form action="forgetpass1.php" method="POST">
            <div class="col-lg-6">
                <div class="card2 card border-0 px-4 py-5">
                 
                     <div class="row px-3 mb-4 steps">
                          <h6 class="mb-0 text-sm step11">الخطوة الأولى</h6>
                           <h6 class="mb-0 text-sm step22">الخطوة الثانية </h6>
                           <h6 class="mb-0 text-sm step22">الخطوة الأخيرة </h6>
                    </div>
                       <div class="line"></div>
                    <div class="row px-3"> <label class="mb-1">
                            <?php  echo $message;?>
                            <p id="error" style='text-align: right; color:red; margin-top:20px;'></p>
                            <h6 class="mb-0 text-sm">البريد الإلكتروني</h6>
                        </label> <input class="mb-4 input" type="email" name="email" id="email" placeholder="example@email.com" onchange="emailValidation()" > </div>
                        <div class="row mb-3 px-3 pass"> <button type="submit" class="btn text-center" name="reset" onfocus="Validation()" id="SubmitButtun" >إرسال رمز تحقق </button> </div>
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
?>
    </body>
</html>

<script>
    //function check that inputs are not empty 
  function Validation() {
// save value of the input form
var email = document.getElementById("email").value;
if(email===""){
  //error message will appear to user 
 document.getElementById("error").innerHTML="فضلا قم بكتابة البريد الإلكتروني" ;
 document.getElementById("SubmitButtun").disabled=true;
}else{
 document.getElementById("error").innerHTML="" ;
 document.getElementById("SubmitButtun").disabled=false; 
}
}
 function emailValidation() {
// save value of the input form
var email = document.getElementById("email").value;
  const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
             if (!email.match(re)){
                 document.getElementById("error").innerHTML="فضلا قم بكتابة البريد الإلكتروني بشكل صحيح";
                  document.getElementById("SubmitButtun").disabled=true;
             }else{
                document.getElementById("error").innerHTML="";
                 document.getElementById("SubmitButtun").disabled=false;
             }}






</script>

