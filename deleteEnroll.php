<?php 
require 'config.php';
$enroll_id = $_POST['enrollid'];
$sql="DELETE FROM enroll WHERE enroll.id = '$enroll_id'";

  $resultsdelete = mysqli_query($connection, $sql);
?>


