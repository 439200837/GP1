<?php require 'layout/header.php';
require 'config.php';  
// change title name
echo "<script> document.title='تسجيل دخول' </script>";
$message="";
if(isset($_POST['log'])){
//define the variables
  	$email_address = $_POST['email'];
        $user_type = $_POST['user'];
// use hash function for Password encryption
  	$password = $_POST['password'];
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
  }
  //check if password entered is equal hashed password in the database
  if(password_verify($password, $SavedPass)){
       //Create sesstion and redirect member to borad.php
       session_start();
       $_SESSION['type']="member";
       $_SESSION['id']=$id; 
       $_SESSION['email']=$email;
       $_SESSION['logged_in'] = true;
       header("location:board.php");
       
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
  }
  //check if password entered is equal hashed password in the database
  if(password_verify($password, $SavedPass)){
       //Create sesstion and redirect volunteer to program.php
       session_start();
       //save attribute is session array to use it later in authentication
       $_SESSION['type']="volunteer";
       $_SESSION['id']=$id; 
       $_SESSION['email']=$email;
       $_SESSION['logged_in'] = true;
       header("location:index.php");
       
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
    <input type="radio" id="radioVolunteer" name="user" value="volunteer" checked>
    <label for="radioVolunteer">متطوع</label>

    <input type="radio" id="radioMemebr" name="user" value="member">
    <label for="radioMemebr">عضو</label>

    <input type="radio" id="radioSponsor" name="user" value="sponsor">
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
                        </label> <input class="mb-4" type="email" name="email" id="email" placeholder="example@x.com" required > </div>
                    <div class="row px-3"> <label class="mb-1">
                            <h6 class="mb-0 text-sm">كلمة المرور</h6>
                        </label> <input type="password" name="password" id="pass" placeholder="ادخل كلمة المرور" required> </div>
                    <div class="row px-3 mb-4 forget">
                    <a href="#" class="ml-auto mb-0 text-sm">نسيت كلمة المرور ؟</a>
                    </div>
                    <div class="row mb-3 px-3"> <button type="submit" class="btn text-center" name="log" onfocus="Validation()" >تسجيل دخول</button> </div>
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
    
    <style>

@media screen and (max-width: 991px) {

    .image {
        width: 300px;
        height: 220px
    }

    .border-line {
        border-right: none
    }
    .row.d-flex{
        display: flex;
        flex-direction: column-reverse;
    }
    .card1 {
        border-top: 1px solid #EEEEEE !important;
        margin: 0px 15px
    }
}
input:focus,
textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid #9b59b6;
    outline-width: 0
}

.forget, .insertAccount{
    margin-top: 10px;
      margin-bottom: 15px;
}
.btn {
    background-color: #009999;
    width: 150px;
    color: #fff;
    border-radius: 6px
}
.btn:hover{
    color: #fff;
    opacity: 0.9;
}
placeholder {
    color: #9b59b6;
    opacity: 1;
    font-weight: 300
}

-ms-input-placeholder {
    color: #9b59b6;
    font-weight: 300
}
.container-fluid{
    margin-top: 100px;
}

input,
textarea {
    padding: 10px 12px 10px 12px;
    border: 1px solid lightgrey;
    border-radius: 2px;
    margin-bottom: 5px;
    margin-top: 2px;
    width: 100%;
    box-sizing: border-box;
    color: #583e69;
    font-size: 14px;
    letter-spacing: 1px
}
.line {
    height: 1px;
    width: 45%;
    background-color: #E0E0E0;
}


.text-sm {
    font-size: 14px !important
}
.card0 {
    box-shadow: 0px 4px 8px 0px #757575;
    border-radius: 0px;
}

.card2 {
    margin: 0px 40px;
}


.image {
    width: auto;
    height: 280px;
    margin-right: 40px;
}

.border-line {
    border-left: 1px solid #EEEEEE;
    margin-top: 15px;
}

.user-type{
    margin-right: -35px;
}
.radio-toolbar {
  margin: 30px;

}

.radio-toolbar input[type="radio"] {
  opacity: 0;
  position: fixed;
  width: 0;
}

.radio-toolbar label {
    display: inline-block;
    width:  80px;
  height: 35px;
  border-radius:  24px; 
  text-align:  center; 
  padding:  4px 12px; 
  color: #009999; 
  background-color: white;
  font-size:  16px;
  font-weight: 100;
  border: 1.2px solid #009999;
    cursor: pointer;
      white-space: nowrap;
 
}

.radio-toolbar label:hover {
  background-color: #dfd;
}


.radio-toolbar input[type="radio"]:checked + label {
    background-color: #009999;
    opacity: 0.8;
    color:#fff;
    
}

    </style>
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