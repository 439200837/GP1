<?php 
session_start();
//connect to the header.php page and to config.php page
//connect to the AdminHeader.php page and to config.php page
if($_SESSION['logged_in']===true && $_SESSION['type'] ==='member' && $_SESSION['id'] ==1){
    require 'layout/AdminHeader.php'; 
 }
 elseif($_SESSION['logged_in']===true && $_SESSION['type'] ==='member' && $_SESSION['id'] !=1){
    require 'layout/loggedHeader.php'; 
 }elseif($_SESSION['logged_in']===true && $_SESSION['type'] ==='volunteer'){
   require'layout/loggedHeader.php';
 }else{
  require'layout/header.php';   
 } 
require 'config.php';
//retrive the value of the chosen id
$id=$_GET['id'];
// change title name
echo "<script> document.title='تفاصيل البرنامج' </script>";
?>

<element dir="rtl">
<!DOCTYPE html>
<html>
    <head>
      
    <meta charset="UTF-8">
    <title class="reg">تفاصيل البرنامج</title>
    <link rel="stylesheet" href="css/style.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style>
         
    
     </style>
   </head>
   <nav aria-label="breadcrumb" style="margin: 1%; margin-top:100px;">
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><strong><a href="programs.php">برامجنا</a> </strong></li>
    <li class="breadcrumb-item active" aria-current="page"> <strong> التفاصيل </strong></li>
  </ol>
</nav>
       
       

 
    <div class="cardA">
        <?php  
   if (isset($_GET['id'])) {
//retrieve all the program's information of this id
  $sql="SELECT * FROM `program` where id='$id'";
  $sql2 = "SELECT program.*, enroll.program_id, enroll.id, enroll.volenteer_id, enroll.status FROM program, enroll WHERE enroll.program_id = program.id ;";
          $result = mysqli_query( $connection, $sql);
          $result2 = mysqli_query( $connection, $sql2);
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $check = 0;
    foreach($result2 as $tt){
      if($row['id'] == $tt['program_id']){
        if ($tt['status'] == 'قيد الانتظار') {
          $check= 2;
        } elseif ($tt['status'] == 'تمت الموافقة') {
          $check= 3;
        }else{
          $check= 0;
        }
      }
    }
    ?>
      
    <div class="fakeimg">
         <?php 
      //check if the logged in user is a member to display the edit program button 
     
     if($_SESSION['logged_in']===true && $_SESSION['type']==='member' ){
          
     echo '<a href="EditProgram.php?id='.$id.'"'.'<button id="editP"  name="editP" type="button" class="buttonP">تعديل</button></a>';
     echo '<style> .fakeimg{justify-content:space-around !important;} </style>';
     }?>
      
     
  
  
      <div class="programt">
          <h1 class="namep" style="color: #009999;"> <?php  
           //retrieve the name of the program
          echo $row['name']?> </h1>
          
        <h4 class="datep" style="color: #009999;"><span> يبدأ من </span><?php 
        //retrieve the date of the program
        echo $row['start_date']?><span> إلى </span><?php echo $row['end_date']?> </h4>
      </div>
          <div class="image">
       
      <?php
      //to display the image from the database 
      echo '<img src="data:image/jpeg;base64,'.base64_encode($row['picture']).'"alt:"program img" style:"width:100%;"/>';?>
      </div> 
    </div>
        <br>
        <br>
        <br>
        <br>
        <br>
         <hr class="lineP"></hr>
        
             
              <h3 class="typep" style="color:#660066;"><span> نوع البرنامج: </span><?php
              //retrieve the type of the program
              echo $row['type']?> </h3>
             
                   <p class="descriptionp" style="color:#660066;"><?php 
                   //retrieve the description of the program
                   echo $row['description']?> </p>
                   <!-- a button to enroll in a program -->
                   <?php
                   if($check == '0'){
         ?>
              <form action="programs.php" method="POST" style="margin-top: 14px;">
                <input type="hidden" name="volenteer_id" value="<?= $_SESSION['id']; ?>">
                <input type="hidden" name="program_id" value="<?= $row['id'] ?>">
                <input type="hidden" name="email_address" value="<?= $_SESSION['email_address'] ?>">
                <button class="buttonP" type="submit" name="insert">انضم إلينا</button>
              </form>
              <?php }elseif($check == '2'){?>
                <button class="buttonP">قيد انتظار القبول </button>
              <?php }else{?>
                <button class="buttonP">تمت الموافقة</button>
              <?php }?>
                    <!-- <button id="enroll"  name="enroll" type="button" class="buttonP">انضم إلينا </button> -->
    </div>
   
  
   
   
   
      <input type="hidden" name="id" value="<?=$row['id']?>">

         <?php  }
    }
      ?>

<element dir="rtl">
<body>

   
</body>
</html>
    <element dir="ltr">
      <?php
      //connect to the footer page
      require 'layout/footer.php'; 
      
        
?>
    </body>
</html>
