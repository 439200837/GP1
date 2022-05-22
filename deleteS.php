<?php
//include connection file
require 'config.php';
//save email comes from Ajax
$email= $_POST['email'];
 $sql="DELETE FROM sponsor WHERE email_address='$email'";
 //echo result
  $result = mysqli_query( $connection, $sql);
 echo 'تمت العملية';


