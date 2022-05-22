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
//Include required SendGrid files
require 'includes/sendgrid-php/sendgrid-php.php';
use SendGrid\Mail\Mail;
  global $email_address;
  $email_address=$_GET['email'];
  $_SESSION['email']=$email_address;
  $GLOBALS['z']=$email_address;
  $isCorrect=false;
//Create instance of PHPMailer
$email = new Mail();
$email->setFrom("tajclubvolunteer@gmail.com", "نادي تاج التطوعي");
//Add recipient
$email->addTo("$email_address");
$email->setSubject("رمز التحقق");
//set random number for vifoication code
if(!isset($_SESSION["rand"])){ $_SESSION["rand"] = rand(1000,9999);
$Vcode= $_SESSION["rand"];
}

 if(isset($_POST['send'])){
    unset($_SESSION['rand']);
    $_SESSION["rand"] = rand(1000,9999);
$Vcode= $_SESSION["rand"];
}
$Vcode= $_SESSION["rand"];
//Email body
$email->addContent("text/html","لقد تم طلب إعادة ضبط كلمة مرورك الخاصة، إذا لم تقم بطلب إعادة تعيين كلمة المرور يرجى تجاهل هذا البريد ".","."<br>"."<b> رمز التحقق".": ".
                "$Vcode"."</b>");
$sendgrid = new \SendGrid('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');
try {
    $response = $sendgrid->send($email);
   
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}
//Finally send email
	if ( $response->statusCode()===202) {
        $message="<p style='text-align: right; margin-top:20px;'>". "تم إرسال رمز التحقق إلى البريد الإلكتروني : ".$email_address."</p>";
	}
if(isset($_POST['verfiy'])){
    $code=$_POST['code'];
     $email=$_POST['email'];
        if($code==$Vcode){
           $_SESSION['isCodeCorrect']=true;
            unset($_SESSION['rand']);
            echo '<script>window.location.replace("reset.php?email='.$email.'");</script>';
        }else{
           $message="<p style='text-align: right; color:red; margin-top:20px;'>"."رمز التحقق غير صحيح"."</p>";
                }
                
           }


?>
<element dir="rtl">
    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
     <div class="card card0 border-0">
        <div class="row d-flex">
            <form action="forgetpass2.php?email=<?php  echo $email_address;?>" method="POST">
            <div class="col-lg-6">
                <div class="card2 card border-0 px-4 py-5">
                 
                    <div class="row px-3 mb-4 steps">
                          <h6 class="mb-0 text-sm step1">الخطوة الأولى</h6>
                          <h6 class="mb-0 text-sm step2">الخطوة الثانية </h6>
                          <h6 class="mb-0 text-sm step1">الخطوة الأخيرة </h6>
                    </div>
                <div class="line"></div>
                     
                    <div class="row px-3"> <label class="mb-1">
                            <?php  echo $message;?>
                            <p id="error" style='text-align: right; color:red; margin-top:20px;'></p>
                            <h6 class="mb-0 text-sm"> رقم التحقق</h6>
                        </label> <input class="mb-4 input" type="number" name="code" id="code" placeholder="XXXX" > </div>
                <div>تنتهي فعالية رمز التحقق خلال :<span id='counter'></span></div> 
               <input type="hidden" name="email" value="<?=$email_address?>">
               <button name="send" style="display: none;" id="resend2" class="btn text-center resend"
                       >  <a href="#" class="ml-auto mb-0 text-sm" style="display: none;" id="resend">إعادة إرسال رمز التحقق</a></button>
                    <div class="row mb-3 px-3"> <button type="submit" class="btn text-center pass" name="verfiy" onfocus="Validation()" >تحقق </button> </div>
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
var pass = document.getElementById("pass").value;
if(email==="" || pass===""){
  //error message will appear to user 
 document.getElementById("error").innerHTML="فضلا ، قم بكتابة الخانتين المطلوبة" ;  
}}

class Timer {

    constructor(secondes, minutes) {
      this.counter = document.getElementById("counter");
     
        this.secondes = secondes; //if not set mins and sec to value passed in constructor
        this.minutes = minutes;
       
     
    }

     countdown() {
       
       debugger;
       var vm=this;
        if(!(this.minutes-1<0))
           this.minutes--;
       let tick= function(){
         
           vm.secondes--
           if(vm.secondes==0){
              vm.secondes=59;
              vm.minutes--;
           }
           vm.counter.innerHTML =  vm.minutes + ":" + (vm.secondes < 10 ? "0" : "") + vm.secondes;
          if(vm.minutes == 0 && vm.secondes-1<=0){
            vm.secondes--; 
            vm.counter.innerHTML =  "00" + ":" +"00";
            document.getElementById("code").disabled = true;
            document.getElementById("resend").style.display = "block";
            document.getElementById("resend2").style.display = "block";
            }     
           else{
             setTimeout(tick,1000);
           }
           sessionStorage.setItem("mins",vm.minutes);//set current min
           sessionStorage.setItem("secs", vm.secondes);//set current sec
         }
        setTimeout(tick,1000);
     }    
    


   
     
           
        
    

    storageCheck() {
        //if both mins and secs exists
        if (sessionStorage.getItem("mins") && sessionStorage.getItem("secs")) {
            // keep the countdown running
            this.minutes=parseInt(sessionStorage.getItem("mins"));//get min
            this.secondes=parseInt(sessionStorage.getItem("secs"));//get secs
            return true;
        }
        else
          return false;
    }

}

let newTimer = new Timer(60, 1);
newTimer.countdown();

$(document).on('click', '#resend', function(e){
 localStorage.removeItem("mins");
 localStorage.removeItem("secs");
 location.reload();

                     
		});
</script>
