<?php 
session_start();
//connect to the header page and to config.php page
if($_SESSION['logged_in']===true && $_SESSION['type'] ==='admin'){
    require 'layout/AdminHeader.php'; 
 }
 elseif($_SESSION['logged_in']===true && $_SESSION['type'] ==='member'){
    require 'layout/loggedHeader.php'; 
 }
 elseif($_SESSION['logged_in']===true && $_SESSION['type'] ==='volunteer'){
   require'layout/loggedHeader.php';
   require 'recommendedPrograms.php';
 }elseif($_SESSION['logged_in']===true && $_SESSION['type'] ==='sponsor'){
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
      <li class="breadcrumb-item"><strong><a href="Archive.php">الأرشيف</a> </strong></li>
    <li class="breadcrumb-item active" aria-current="page"> <strong> التفاصيل </strong></li>
  </ol>
</nav>
       
       

 
    <div class="cardA">
        <?php  
   if (isset($_GET['id'])) {
//retrieve all the program's information of this id
  $sql="SELECT * FROM `program` where id='$id'";
          $result = mysqli_query( $connection, $sql);
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {?>
      
    <div class="fakeimg">
     
      
     
  
  
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
         <hr class="lineP"></hr>
        
             
              <h3 class="typep" style="color:#660066;"><span> نوع البرنامج: </span><?php
              //retrieve the type of the program
              echo $row['type']?> </h3>
             
                   <p class="descriptionp" style="color:#660066;"><?php 
                   //retrieve the description of the program
                   echo $row['description']?> </p>
                   
                    
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

