<?php 
session_start();
//connect to the header.php page and to config.php page
if($_SESSION['logged_in']===true && $_SESSION['type'] ==='admin'){
    require 'layout/AdminHeader.php'; 
 }
 elseif($_SESSION['logged_in']===true && $_SESSION['type'] ==='member'){
    require 'layout/loggedHeader.php'; 
 }else{
     echo 'sorry ! you are not athorize to access this page'; 
    echo "<script>window.location.href='index.php'</script>"; 
 }
echo "<script> document.title='تقييم المتطوعين' </script>";
 require 'config.php';
  
?>
<element dir="rtl">
<nav aria-label="breadcrumb" style="margin: 1%; margin-top:100px;">
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><strong><a href="Archive.php">الأرشيف</a> </strong></li>
    <li class="breadcrumb-item active" aria-current="page"> <strong>تقييم المتطوعين </strong></li>
  </ol>
</nav>

<div id="responsecontainer" style="margin:0px;">
                  <?php
  
 $id=$_GET['id'];
 $enddate=$_GET['date'];
 //$rating=$_POST["rate"];
 // $query = "INSERT INTO volunteer (cumlativeRating ) VALUES ('$rating')";
 //$enddate=$_GET['end_date'];
 $currentdate = date("Y-m-d");
 //echo "<script> alert('$enddate'); </script>";
$today_time = strtotime($currentdate);
$expire_time = strtotime($enddate);
   // $res_n = mysqli_query($connection, $sql_n);
  // echo $today_time,$currentdate;
 //if (mysqli_num_rows($res_n) > 0){

     if( $enddate > $currentdate ) {
     echo "<p style='text-align: right; color:red;'>"."يمكنك تقييم المتطوعين عند انتهاء البرنامج"."</p>";
 }
 else {
             $sql_v="SELECT * FROM volunteer WHERE id IN(SELECT volenteer_id FROM enroll WHERE program_id=$id AND status='انتهى' AND rate='لم يتم التقييم')";
       $res_v = mysqli_query($connection, $sql_v);
       if (mysqli_num_rows($res_v) > 0){
            echo
 '<div class="divtable">'.
        '<table class="table">'.
          '  <thead class="table-head">'.
           ' <tr class="row1">'.
                 ' <td class="column1"></td>'.
      '<td class="column1">اسم المتطوع </td>'
           .'<td class="column2">البريد الإلكتروني</td>'.'<td class="column3">رقم الهاتف</td>'.
		'<td class="column4">الجنس</td>'.
                '<td class="column4">التقييم (1-5) </td>'.
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
                <td class="cell100 column4">'.'<input type="number" id="rate'.$row['id'].'" min="0" max="5" >'.'</td>
                <td class="cell100 column5">'.' <button id="r'.$row['id'].'" onclick="Send('.$row['id'].')" style="margin-top:10px;" class="button" type="button">قيم</button>'.'</td>
                <input type="hidden" name="numVol" id="noVol" value="'.$row['numvolunteer'].'">  
                <input type="hidden" name="cumulativeRate" id="cumulative" value="'.$row['cumlativeRating'].'">
                <input type="hidden" name="pId" id="pId" value='.$id.'>
        </tr>';
   
   //onclick="go('.'insertrate.php?rate='.$row['cumlativeRating'] .')
       }}else {
            echo "<p style='text-align: right; color:red;'>"."لا يوجد متطوعين في هذا البرنامج"."</p>";
 }}
?>
  
             
           </tbody> 
           </table> <br>
<a href="javascript:history.go(-1)" class="Bbutton" style="margin-bottom:20px;">العودة</a> 
  <script type="text/javascript" src="jquery-1.3.2.js"> </script>
 <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 <script type="text/javascript">
     var buttons =[];
     function Send(id) { 
      //var rate = $('#rate'+id).val();
      var rate = document.getElementById("rate"+id).value;
      var noVolunteer= $('#noVol').val();
      var cumrate= $('#cumulative').val();
      var pId= $('#pId').val();
      //var add=+rate + +noVolunteer+ +cumrate;
      //alert(noVolunteer);
      if(noVolunteer==="0"){
          var finalRate= rate;
      }else{
      var finalRate= [(parseInt(noVolunteer)*parseFloat(cumrate))+parseFloat(rate)]/(parseInt(noVolunteer)+1);}
     // alert(cumrate);
      //alert(add);
      //alert(rate);
      // alert(noVolunteer);
     // alert(finalRate);
 console.log('hey');
 $.ajax({
 type: "POST",
 url: "insertrate.php",
 data: {"rate":rate, "id":id, "finalRate":finalRate,"pId":pId},
 //dataType: "html",
 success: function (response) {
  Swal.fire({
                     icon: 'success',
                     title: 'تم تقييم المتطوع',
                     text: '',
                     showConfirmButton: true,
                     confirmButtonText:'إغلاق ',
                     closeOnConfirm: false

                     })
                       .then((result) => {
                        window.location.reload(); 
                         })
        document.getElementById("r"+id).disabled = true;
        document.getElementById("r"+id).innerText = "تم التقييم";
       // buttons.push("r"+id); 
       
        },
            error:function(err){
               //handle your error
               alert('Rate is not submitted');
            }
 });
       
 }
 
    // <input type="hidden" name="id" id="id" value="'.$row['numvolunteer'].'"> 
    
   /*  $(document).ready(function() {
     $("#rateV").click(function(e) {  
        
      rate=$('#rate').val();
      id=$('#id').val();
      $.ajax({    //create an ajax request to sponsorInfo.php
        type: "POST",
        url: "insertrate.php",   
        data:{"rate":rate, "id":id},
           //expect html to be returned                
        success: function(response){ 
           // document.write("<p style='text-align: right; margin-top:120px;'> تم تقييم المتطوع</p>") ;
            //alert('تم تقييم المتطوع');
           // $('#responsecontainer').replaceWith($('#responsecontainer',response));
           //$("#responsecontainer").html(response);
            //alert(response);
             Swal.fire({
                     icon: 'success',
                     title: 'تم تقييم المتطوع',
                     text: '',
                     showConfirmButton: true,
                     confirmButtonText:'إغلاق ',
                     closeOnConfirm: false

                     })
                            /* .then((result) => {
                         location.replace('AddProgram.php'); 
                         })
        },
            error:function(err){
               //handle your error
               alert('Rate is not submitted');
            }

    });
    // e.preventDefault();
});
     });*/


</script>
  <element dir="ltr">
      <?php require 'layout/footer.php';
?>
    </body>
</html>
