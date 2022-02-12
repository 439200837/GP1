<?php
require 'layout/header.php';
require 'config.php';  
// change title name
echo "<script> document.title='تسجيل دخول' </script>";
$message="";
if(isset($_POST['logg'])){
//define the variables
  	$email_address = $_POST['email'];
//bring the phone number and email information to check if it has been stored before
  	$sql_e = "SELECT * FROM `admin` WHERE `email_address`='$email_address'";
  	$res_e = mysqli_query($connection, $sql_e);
//check if the email it dose not exit in database
        
  	 if(mysqli_num_rows($res_e) < 0){            
//echo to user that this email is not have an account
      $message= "<p style='text-align: right; color:red; margin-top:20px;'>". "البريد الإلكتروني أو كلمة المرور غير صحيحة"."</p>";
    }else{
        
    //insert into the volunteer table in database
       $query = "SELECT * FROM `admin` WHERE `email_address`='$email_address'";
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
       $_SESSION['type']="admin";
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
         
         
 }//end 


?>
<element dir="rtl">
    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
     <div class="card card0 border-0">
        <div class="row d-flex">
            <form action="adminLogIn.php" method="POST">
            <div class="col-lg-6">
                <div class="card2 card border-0 px-4 py-5">
            
                 
                     
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
                    <div class="row mb-3 px-3"> <button type="submit" class="btn text-center" name="logg" onfocus="Validation()" >تسجيل دخول</button> </div>
                   
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
