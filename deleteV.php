<?php
//include connection file
require 'config.php';
///save email comes from Ajax
$email= $_POST['email'];
 $sql="DELETE FROM `volunteer` WHERE `email_address`='$email'";
 /// echo result to Ajax
  $result = mysqli_query( $connection, $sql);
echo mysqli_error($connection);


