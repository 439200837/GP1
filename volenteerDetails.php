<?php
//  session_start();
require 'config.php';
 if($_SESSION['logged_in']===true && $_SESSION['type'] ==='member' && $_SESSION['id'] ==1){
    require 'layout/AdminHeader.php'; 
 }
 elseif($_SESSION['logged_in']===true && $_SESSION['type'] ==='member' && $_SESSION['id'] !=1){
    require 'layout/loggedHeader.php'; 
 }else{
     echo 'sorry ! you are not athorize to accecc this page'; 
     header('location:log-in.php');  
 }



// change title name
echo "<script> document.title='معلومات المتطوع' </script>";


?>
<element dir="rtl">
<!DOCTYPE html>
<html>
    <head>
      
    <meta charset="UTF-8">
    <title class="reg">تفاصيل البرنامج</title>
    <link rel="stylesheet" href="css/style.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
   </head>
   
   <body class="reg" onkeyup="my()">
<?php
 $id=$_GET['id'];
 
//retrieve all the program's information of this id
  $sql="SELECT * FROM `volunteer` WHERE `email_address` = '" . $id . "'";
          $result = mysqli_query( $connection, $sql);
  // output data of each row
  foreach($result as $row) { ?>
       
 <div id="responsecontainer">
    <div class="divtable">
        <table class="table">
            <thead class="table-head">
            <tr class="row1">
         <?php
   //member infomation will appear first
         
    
           echo '<td class="column1">اسم المتطوع </td>';
  echo '<tbody>
	<tr class="row2">
            
          <td>'.$row['first_name'].' '.$row['last_name'].'</td>
        	
        </tr>';
    echo '<td class="column1">البريد الإلكتروني </td>';
         
  echo 
	'<tr class="row2">
            
          <td>'.$row['email_address'].'</td>
        	
        </tr>';
        
     echo '<td class="column1">تاريخ الميلاد </td>';
         
  echo '
	<tr class="row2">
            
          <td>'.$row['dateOfBirth'].'</td>
        	
        </tr>';
  
  echo '<td class="column1">الجنس </td>';
         
  echo '
	<tr class="row2">
            
          <td>'.$row['gender'].'</td>
        	
        </tr>';
  
  echo '<td class="column1">رقم الهاتف </td>';
         
  echo '
	<tr class="row2">
            
          <td>'.$row['phone_number'].'</td>
        	
        </tr>';
  
  echo '<td class="column1">العنوان </td>';
         
  echo '
	<tr class="row2">
            
          <td>'.$row['address'].'</td>
        	
        </tr>';
  
  echo '<td class="column1">المستوى التعليمي </td>';
         
  echo '
	<tr class="row2">
            
          <td>'.$row['educational_level'].'</td>
        	
        </tr>';
  
  
  echo '<td class="column1">التقييم </td>';
         
  echo '
	<tr class="row2">
            
          <td class="cell100 column1">'.$row['cumlativeRating'].'</td>
        	
        </tr>';
  
   
  }
   echo '<td class="column1">التخصص </td>';
         
  echo 
	'<tr class="row2">'; 
                
           $sql2="SELECT * FROM `qualification` WHERE `Vemail_address` = '" . $id . "'";
          $result2 = mysqli_query( $connection, $sql2);
          foreach($result2 as $row2){
           
       echo  '<td>'.$row2['qualifications'].'</td>';
          }
        echo '</tr>';
        
        
           echo '<td class="column1">التفضيلات </td>';
         
  echo '
	<tr class="row2">'; 
                
           $sql3="SELECT * FROM `preference` WHERE `Vemail_address` = '" . $id . "'";
          $result3 = mysqli_query( $connection, $sql3);
          foreach($result3 as $row3){
           
       echo  '<td>'.$row3['Preferences'].'</td>';
          }
       echo  '</tr>';
        
        
            echo '<td class="column1">المهارات </td>';
         
  echo '
	<tr class="row2">'; 
                
           $sql4="SELECT * FROM `skill` WHERE `Vemail_address` = '" . $id . "'";
          $result4 = mysqli_query( $connection, $sql4);
          foreach($result4 as $row4){
           
       echo  ' <td>'.$row4['skills'].'</td>';
          }
        echo '</tr>';
        
    
  
   
 

  
     ?>


   
  </tbody> 
            
           </table> <br>
        </div>
   
         
    </div>

      <input type="hidden" name="id" value="<?=$row['id']?>">
      
         
   
</body>
   
    <element dir="ltr">
      <?php 
     require 'layout/footer.php';
     
    
//close database connection
       mysqli_close($connection);
?>
    </body>
    </html>

