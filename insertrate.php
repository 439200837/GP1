<?php
session_start();
//connect to the AdminHeader.php page and to config.php page
/*if($_SESSION['logged_in']===true && $_SESSION['type'] ==='member' && $_SESSION['id'] ==1){
    require 'layout/AdminHeader.php'; 
 }
 elseif($_SESSION['logged_in']===true && $_SESSION['type'] ==='member' && $_SESSION['id'] !=1){
    require 'layout/loggedHeader.php'; 
 }else{
     echo 'sorry ! you are not athorize to access this page'; 
     header('location:log-in.php'); 
 }*/
 
require 'config.php';
 $rate=$_POST['rate'];
 print_r($rate);
 $id=$_POST['id'];
 $finalRate=$_POST['finalRate'];
 $pId=$_POST['pId'];
 //echo $finalRate;
  //echo $rate;
 // echo $id;
 $query = "UPDATE `volunteer` SET cumlativeRating='$finalRate' WHERE `id`='$id'";
 
 $results = mysqli_query($connection, $query);
 $query1 = "UPDATE `enroll` SET `rate`='تم تقييمه' WHERE `volenteer_id`='$id' AND program_id=$pId AND status='انتهى'";
 $results1 = mysqli_query($connection, $query1);
       
                 if ($results ) {
                     echo "<p style='text-align: right; margin-top:120px;'>". "تم تقييم المتطوع ".$id."</p>";
                 
                    } else {echo ' <script> alert("wrong"); </script>';
//echo "<p style='text-align: right; margin-top:120px;'>". "حدث خطأ في ادخال التقييم للداتا بيس "."</p>";}
                    }
 

