<?php
 session_start();
 if($_SESSION['logged_in']===true ){
    require 'layout/loggedHeader.php'; 
    
 }else{
    echo 'sorry ! you are not athorize to accecc this page'; 
     header('location:log-in.php');  
 }
//calling database conennction
require 'config.php';
//header 

// change title name
echo "<script> document.title='البرامج التي اشتركت بها' </script>";
?>
<element dir="rtl">
  
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="divtable">
        <table class="table">
            <thead class="table-head">
            <tr class="row1">
                  <td class="column1">#</td>
                  <?php

            echo
      '<td class="column1">اسم البرنامج </td>'
           .'<td class="column2">الحالة</td>'.' </tr>  
            </thead>';
            
       //retrieving the enrollment information of the volunteer from database
                    $sql="SELECT * FROM `enroll`";
                    $sql2 = "SELECT program.name, volunteer.id, enroll.program_id, enroll.id, enroll.status FROM program, volunteer, enroll WHERE volunteer.id = enroll.volenteer_id AND enroll.program_id = program.id";
          $result = mysqli_query( $connection, $sql2);
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
   echo    '<tbody class="table-body">
	<tr class="row2">
            <td class="cell100 column1" id="inc"></td>
		<td class="cell100 column1">'.$row['name'].'</td>
		<td class="cell100 column2">'.$row['status'].'</td>
		<td class="column5"><a href="detalis.php?id='.$row['program_id'].'">'.$row['name'].'</a></td>
		
        </tr>';
  }
                  }
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  ?>
             
           </tbody> 
            
           </table> <br>
        </div>
   
         
    </div>
   <element dir="ltr">
      <?php require 'layout/footer.php'; 
?>
    </body>
    <script type="text/javascript" src="jquery-1.3.2.js"> </script>
 <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</html>
