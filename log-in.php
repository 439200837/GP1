<?php
require 'layout/header.php';
require 'config.php';  
// change title name
echo "<script> document.title='تسجيل دخول' </script>";
$message="";
if(isset($_POST['log'])){
//define the variables
  	$email_address = $_POST['email'];
        $user_type = $_POST['user'];
     if($user_type==='member'){
//bring the phone number and email information to check if it has been stored before
  	$sql_e = "SELECT * FROM `member` WHERE `email_address`='$email_address'";
  	$res_e = mysqli_query($connection, $sql_e);
//check if the email it dose not exit in database
        
  	 if(mysqli_num_rows($res_e) < 0){            
//echo to user that this email is not have an account
      $message= "<p style='text-align: right; color:red; margin-top:20px;'>". "البريد الإلكتروني أو كلمة المرور غير صحيحة"."</p>";
    }else{
        
    //insert into the volunteer table in database
       $query = "SELECT * FROM `member` WHERE `email_address`='$email_address'";
        $results = mysqli_query($connection, $query);
if (mysqli_num_rows($results) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($results)) {
 $id=$row['id'];
 $email=$row['email_address'];
 $SavedPass=$row['password'];
  $salt = $row['salt'];
  $name=$row['first_name'];
  }
  //check if password entered is equal hashed password in the database
  // use hash function for Password encryption
  $hashed_password = crypt($_POST['password'],$salt);
  $bool=hash_equals($hashed_password,$SavedPass );
  if($bool==1){
       //Create sesstion and redirect member to borad.php
       session_start();
       $_SESSION['type']="member";
       $_SESSION['id']=$id; 
       $_SESSION['name']=$name;
       $_SESSION['email']=$email;
       $_SESSION['logged_in'] = true;
       header("location:home.php?name=$name;");
       
  }else{
       $message= "<p style='text-align: right; color:red; margin-top:20px;'>". "البريد الإلكتروني أو كلمة المرور غير صحيحة"."</p>";
  }  
           } else {
               
                 $message= "<p style='text-align: right; color:red; margin-top:20px;'>". "نعتذر، حدث خطأ ما "."</p>";
           }
           
    }
         
         
 }//end if the user is member
 
 //check if the user is volunteer
 else if ($user_type==='volunteer'){
   //bring the email to check if it has been stored before
  	$sql_e = "SELECT * FROM `volunteer` WHERE `email_address`='$email_address'";
  	$res_e = mysqli_query($connection, $sql_e);
//check if the email it dose not exit in database
  	 if(mysqli_num_rows($res_e) < 0){            
//echo to user that there is an error for security reason the error message will be general
      $message= "<p style='text-align: right; color:red; margin-top:20px;'>". "البريد الإلكتروني أو كلمة المرور غير صحيحة"."</p>";
    }else{
        
    //search from volunteer table in database for entered email 
       $query = "SELECT * FROM `volunteer` WHERE `email_address`='$email_address'";
        $results = mysqli_query($connection, $query);
if (mysqli_num_rows($results) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($results)) {
 $id=$row['id'];
 $email=$row['email_address'];
 $SavedPass=$row['password'];
 $salt = $row['salt'];
 $name=$row['first_name'];
 $numVolunteer=$row['numvolunteer'];
  }
  //check if password entered is equal hashed password in the database
  // use hash function for Password encryption
  $hashed_password = crypt($_POST['password'],$salt);
  $bool=hash_equals($hashed_password,$SavedPass );
  if($bool==1){
       //Create sesstion and redirect volunteer to program.php
       session_start();
       //save attribute is session array to use it later in authentication
       $_SESSION['type']="volunteer";
       $_SESSION['id']=$id; 
       $_SESSION['numV']=$numVolunteer;
     $_SESSION['name']=$name;
       $_SESSION['email']=$email;
       $_SESSION['logged_in'] = true;
       header("location:home.php?name=$name;");
       
  }else{
       $message= "<p style='text-align: right; color:red; margin-top:20px;'>". "البريد الإلكتروني أو كلمة المرور غير صحيحة"."</p>";
  } //end in case of the passwords are not equal 
           } else {
               
                 $message= "<p style='text-align: right; color:red; margin-top:20px;'>". "نعتذر، حدث خطأ ما "."</p>";
           }//end of case that error appear while excute the sql statment
           
    }//end of case the email is found in database 
 }//end of volunteer user type
 
 
           }

?>
<element dir="rtl">
    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
     <div class="card card0 border-0">
        <div class="row d-flex">
            <form action="log-in.php" method="POST">
            <div class="col-lg-6">
                <div class="card2 card border-0 px-4 py-5">
                    <div class="user-type">
                      <div class="radio-toolbar">
    <input class="input" type="radio" id="radioVolunteer" name="user" value="volunteer" checked>
    <label for="radioVolunteer">متطوع</label>

    <input class="input" type="radio" id="radioMemebr" name="user" value="member">
    <label for="radioMemebr">عضو</label>

    <input class="input" type="radio" id="radioSponsor" name="user" value="sponsor">
    <label for="radioSponsor">راعي</label> 
</div>
                    </div>
                    <div class="row px-3 mb-4">
                        <div class="line"></div>
                    </div>
                     
                    <div class="row px-3"> <label class="mb-1">
                            <?php  echo $message;?>
                            <p id="error" style='text-align: right; color:red; margin-top:20px;'></p>
                            <h6 class="mb-0 text-sm">البريد الإلكتروني</h6>
                        </label> <input class="mb-4 input" type="email" name="email" id="email" placeholder="example@email.com" > </div>
                    <div class="row px-3"> <label class="mb-1">
                            <h6 class="mb-0 text-sm">كلمة المرور</h6>
                        </label> <input class="input" type="password" name="password" id="pass" placeholder="ادخل كلمة المرور"> </div>
                    <div class="row px-3 mb-4 forget">
                    <a href="forgetpass1.php" class="ml-auto mb-0 text-sm">نسيت كلمة المرور ؟</a>
                    </div>
                    <div class="row mb-3 px-3"> <button type="submit" class="btn text-center" name="log" onfocus="Validation()" >تسجيل دخول</button> </div>
                    <div class="row mb-4 px-3 insertAccount"> <small class="font-weight-bold">ليس لديك حساب ؟ <a class="text-danger " href="index.php">إنشاء حساب</a></small> </div>
                    <div class="row mb-4 px-3 insertAccount"> <small class="font-weight-bold"><a class="text-danger " href="adminLogIn.php"> تسجيل الدخول (مشرف)</a></small> </div>
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





</script>