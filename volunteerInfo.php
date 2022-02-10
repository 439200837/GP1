<?php
 require 'config.php';


       echo '<div class="above-table">
            
        <div class="dropdown">
            <button class="dropbtn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
  <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
</svg> المتطوعين </button>
  <div class="dropdown-content">
   <button id="displayM" class="display" type="button">الأعضاء</button>
      <button id="displayV" class="display" type="button">المتطوعين</button>
      <button id="displayS" class="display" type="button">الرعاة</button>
  </div>
</div>
            
           <a href="index.php"> <button class="button" type="button">إضافة متطوع</button></a>
            
        </div>
    
        
        <table class="table">
            <thead class="table-head">
            <tr class="row1">
                  <td class="column1">#</td>'; ?>
             <?php
   
            echo
      '<td class="column1">اسم المتطوع </td>'
           .'<td class="column2">البريد الإلكتروني</td>'.'<td class="column3">رقم الهاتف</td>'.
		'<td class="column4">الجنس</td>'.
                '<td class="column4">التعديل</td>'.
               '<td class="column4">الحذف</td>'.' </tr>  
            </thead>';
            
            
                    $sql="SELECT * FROM volunteer";
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
                <td class="column5"><a href="edit-volunteer.php?id='.$row['id'].'&email='.$row['email_address'].'">تعديل</a></td><!-- comment -->
                <td class="column6"> <input<a href="javascript:void(0)" id="delete_user" data-id='.$row['email_address'].' class="trigger-btn" data-toggle="modal">حذف </a></td>
		
        </tr>';
  }
                  }
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
             
           echo '</tbody> 
            
        </table>
    
                  
 <script type="text/javascript">

 $(document).ready(function() {

    $("#displayS").click(function() {                

      $.ajax({    //create an ajax request to display.php
        type: "GET",
        url: "sponsorInfo.php",             
        dataType: "html",   //expect html to be returned                
        success: function(response){                    
            $("#responsecontainer").html(response); 
            //alert(response);
        }

    });
});


  $("#displayM").click(function() {                

      $.ajax({    //create an ajax request to display.php
        type: "GET",
        url: "memberInfo.php",             
        dataType: "html",   //expect html to be returned                
        success: function(response){                    
            $("#responsecontainer").html(response); 
            //alert(response);
        }

    });
});
  $("#displayV").click(function() {                

      $.ajax({    //create an ajax request to display.php
        type: "GET",
        url: "volunteerInfo.php",             
        dataType: "html",   //expect html to be returned                
        success: function(response){                    
            $("#responsecontainer").html(response); 
            //alert(response);
        }

    });
});
});


$(document).ready(function(){';
		
echo "$(document).on('click', '#delete_user', function(e){
		
	var productId = $(this).data('id');
	SwalDelete(productId);
	e.preventDefault();
                     
		});
		
	
	
	function SwalDelete(email){
	Swal.fire({
  title: 'هل أنت متأكد ؟',
  text: 'لن تستطيع استرجاع البيانات بعد عملية الحذف',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#d33',
  cancelButtonColor: '#3085d6',
  confirmButtonText: 'حذف',
  cancelButtonText:'إلغاء'
}).then((result) => {
  if (result.isConfirmed) {
     $.ajax({    //create an ajax request 
        type: 'POST',
        url: 'deleteV.php',
        data: {email:email},
        dataType: 'html',   //expect html to be returned                
        success: function(response){                    
            Swal.fire(
      response,
      'تم حذف بيانات المتطوع بنجاح',
      'success'    
    ).then((result) => {
        location.reload(true); 
    })
        },
  error: function(XMLHttpRequest, textStatus, errorThrown) {
     alert(textStatus);
  }

    });//end ajax

            }
})
		
	}
});
</script>";


