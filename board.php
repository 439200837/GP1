<?php
 session_start();
// if($_SESSION['logged_in']===true && $_SESSION['type']==='member' && $_SESSION['id'] ==1 ){
     require 'layout/AdminHeader.php';
    
 //}else{
   // echo 'sorry ! you are not athorize to accecc this page'; 
   //  header('location:log-in.php');  
// }
//calling database conennction
require 'config.php';
//header 

// change title name
echo "<script> document.title='لوحة التحكم' </script>";

?>
<element dir="rtl">
  
        
    <div id="responsecontainer">
        <div class="above-table">
            
        <div class="dropdown">
            <button class="dropbtn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
  <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
</svg> الأعضاء </button>
            <!-- menue -->
  <div class="dropdown-content">
      <button id="displayM" class="display" type="button">الأعضاء</button>
      <button id="displayV" class="display" type="button">المتطوعين</button>
      <button id="displayS" class="display" type="button">الرعاة</button>
      <button id="displayA" class="display" type="button">المشرفين</button>
  </div>
</div>
            <!-- add button -->
            <a href="add.php" id="addB" <button class="button" type="button">إضافة عضو</button></a>
            
        </div>
    
        <div class="divtable">
        <table class="table">
            <thead class="table-head">
            <tr class="row1">
                  <td class="column1">#</td>
                  <?php
   //member infomation will appear first
            echo
      '<td class="column1">اسم العضو </td>'
           .'<td class="column2">البريد الإلكتروني</td>'.'<td class="column3">رقم الهاتف</td>'.
		'<td class="column4">الجنس</td>'.
                '<td class="column4">التعديل</td>'.
               '<td class="column4">الحذف</td>'.' </tr>  
            </thead>';
            
            //including all members in database
                    $sql="SELECT * FROM member";
          $result = mysqli_query( $connection, $sql);
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
   echo    '<tbody class="table-body">
	<tr class="row2">
            <td class="cell100 column1" id="inc"></td>
		<td class="cell100 column1">'.$row['first_name'].' '.$row['last_name'].'</td>
		<td class="cell100 column2">'.$row['email_address'].'</td>
		<td class="cell100 column3">'.$row['phone_number'].'</td>
		<td class="cell100 column4">'.$row['gender'].'</td>
                <td class="column5"><a href="edit-member.php?id='.$row['id'].'">تعديل</a></td><!-- comment -->
                <td class="column6"> <input<a href="javascript:void(0)" id="delete_user" data-id='.$row['email_address'].' class="trigger-btn" data-toggle="modal">حذف </a></td>
		
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
 <script type="text/javascript">

 $(document).ready(function() {
//jQuery for dropdown menu 
//for sponsor choice, call sponsorInfo using POST 
    $("#displayS").click(function() {                

      $.ajax({    //create an ajax request to sponsorInfo.php
        type: "GET",
        url: "sponsorInfo.php",             
        dataType: "html",   //expect html to be returned                
        success: function(response){                    
            $("#responsecontainer").html(response); 
            //alert(response);
        }

    });
});

//for member choice, call memberInfo using POST 
  $("#displayM").click(function() {                

      $.ajax({    //create an ajax request to memberInfo.php
        type: "GET",
        url: "memberInfo.php",             
        dataType: "html",   //expect html to be returned                
        success: function(response){                    
            $("#responsecontainer").html(response); 
            //alert(response);
        }

    });
});
//for volunteer choice, call volunteerInfo using POST 
 $("#displayV").click(function() {                

      $.ajax({    //create an ajax request to volunteerInfo.php
        type: "GET",
        url: "volunteerInfo.php",             
        dataType: "html",   //expect html to be returned                
        success: function(response){                    
            $("#responsecontainer").html(response); 
            //alert(response);
        }

    });
});
 
    $("#displayA").click(function() {                

      $.ajax({    //create an ajax request to sponsorInfo.php
        type: "GET",
        url: "adminInfo.php",             
        dataType: "html",   //expect html to be returned                
        success: function(response){                    
            $("#responsecontainer").html(response); 
            //alert(response);
        }

    });
});


});

//delete users using jQuery (POST)
$(document).ready(function(){
		
		//when click on delete button
		$(document).on('click', '#delete_user', function(e){
		
			var productId = $(this).data('id');
			SwalDelete(productId);
			e.preventDefault();
                     
		});
		
	
	//an alert will appear to confirm deleting
	function SwalDelete(email){
	Swal.fire({
  title: 'هل أنت متأكد ؟',
  text: "لن تستطيع استرجاع البيانات بعد عملية الحذف",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#d33',
  cancelButtonColor: '#3085d6',
  confirmButtonText: 'حذف',
  cancelButtonText:'إلغاء'
}).then((result) => {
  if (result.isConfirmed) {
      //when click on confirm
     $.ajax({    //create an ajax request 
        type: "POST",
        url: "delete.php",
        data: {email:email},
        dataType: "html",   //expect html to be returned                
        success: function(response){                    
            Swal.fire(
      response,
      'تم حذف بيانات العضو بنجاح',//alert message with success delete 
      'success'    
    ).then((result) => {
        location.reload(true); // reload page 
    })
        },
  error: function(XMLHttpRequest, textStatus, errorThrown) {
     alert(textStatus); //alert error message if there
  }

    });//end ajax

            }
})
		
	}
});	
</script>
</html>
