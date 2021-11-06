<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require 'config.php';
$memberId= $_POST['productId'];
 $sql="DELETE FROM volunteer WHERE email_address='$memberId'";
  $result = mysqli_query( $connection, $sql);
  echo 'Sucssess';


