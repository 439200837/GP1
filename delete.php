<?php
//include connection to database
require 'config.php';
//save email address that come from POST function
$email= $_POST['email'];
//delete from database
 $sql="DELETE FROM member WHERE email_address='$email'";
 //echo result to Ajax 
  $result = mysqli_query( $connection, $sql);
  echo 'تمت العملية';



