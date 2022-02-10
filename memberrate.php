
<?php 
session_start();
//connect to the header.php page and to config.php page
//connect to the AdminHeader.php page and to config.php page
if($_SESSION['logged_in']===true && $_SESSION['type'] ==='member' && $_SESSION['id'] ==1){
    require 'layout/AdminHeader.php'; 
 }
 elseif($_SESSION['logged_in']===true && $_SESSION['type'] ==='member' && $_SESSION['id'] !=1){
    require 'layout/loggedHeader.php'; 
 }elseif($_SESSION['logged_in']===true && $_SESSION['type'] ==='volunteer'){
   require'layout/loggedHeader.php';
 }else{
  require'layout/header.php';   
 }
echo "<script> document.title='الرئيسة' </script>";
 require 'config.php';
 $id=$_GET['id'];
 $rating=$_POST["rate"];
 // $query = "INSERT INTO volunteer (cumlativeRating ) VALUES ('$rating')";
 $enddate=$_GET['end_date'];
 $currentdate = date('Y-m-d');

$today_time = strtotime($currentdate);
$expire_time = strtotime($enddate);
   // $res_n = mysqli_query($connection, $sql_n);
 
 //if (mysqli_num_rows($res_n) > 0){
     if( $enddate > $currentdate ) {
     echo "<p style='text-align: right; color:red; margin-top:120px;'>"."يمكنك تقييم المتطوعين عند انتهاء البرنامج"."</p>";
 }
 
    // }*/
         
 
?>
<element dir="rtl">
<!-- Carousel -->
<div class="containerH" style="background-color: #f4f3ef;">
  <div class="row">
    <!-- Carousel -->
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      </ol>
      <!-- Wrapper for slides -->
     
      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
      </a>
    </div><!-- Carousel END -->
  </div>
</div>

 <div class="divtable">
        <table class="table">
            <thead class="table-head">
            <tr class="row1">
                  <td class="column1"></td>
                  <?php
   //member infomation will appear first
          /*  echo
      '<td class="column1">اسم المتطوع </td>'
           .'<td class="column2">البريد الإلكتروني</td>'.'<td class="column3">رقم الهاتف</td>'.
		'<td class="column4">الجنس</td>'.
                '<td class="column4">التقييم</td>'.
               ' </tr>  
            </thead>';*/
            
            
             $sql_v="SELECT * FROM volunteer WHERE email_address=(SELECT Vemail_address FROM enroll WHERE program_id=$id AND status='finished')";
       $res_v = mysqli_query($connection, $sql_v);
       if (mysqli_num_rows($res_v) > 0){
            echo
      '<td class="column1">اسم المتطوع </td>'
           .'<td class="column2">البريد الإلكتروني</td>'.'<td class="column3">رقم الهاتف</td>'.
		'<td class="column4">الجنس</td>'.
                '<td class="column4">التقييم</td>'.
               ' </tr>  
            </thead>';
               
        while($row = mysqli_fetch_assoc($res_v)) {
   echo    '<tbody class="table-body">
	<tr class="row2">
            <td class="cell100 column1" id="inc"></td>
		<td class="cell100 column1">'.$row['first_name'].' '.$row['last_name'].'</td>
		<td class="cell100 column2">'.$row['email_address'].'</td>
		<td class="cell100 column3">'.$row['phone_number'].'</td>
		<td class="cell100 column4">'.$row['gender'].'</td>
                <td class="cell100 column4">'.'<input type="number" id="rate" min="0" max="5" >'.'</td>
                
        </tr>';
       }}else {
            echo "<p style='text-align: right; color:red; margin-top:120px;'>"."لا يوجد متطوعين في هذا البزنامج"."</p>";
       }
?>
             
           </tbody> 
            
           </table> <br>
        </div>



  <element dir="ltr">
      <?php require 'layout/footer.php';
?>
    </body>
</html>