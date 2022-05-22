<?php 
session_start();
require 'config.php';
$volunteer_id=$_SESSION['id'];
$program_id = $_POST['enrollid'];
$sql="DELETE FROM enroll WHERE program_id = $program_id AND volenteer_id=$volunteer_id AND status='تمت الموافقة'";
  $resultsdelete = mysqli_query($connection, $sql);
?>


