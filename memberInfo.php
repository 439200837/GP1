<?php
 require 'config.php';


       echo '<div class="above-table">
            
        <div class="dropdown">
            <button class="dropbtn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
  <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
</svg> الأعضاء </button>
  <div class="dropdown-content">
   <button id="displayM" class="display" type="button">الأعضاء</button>
      <button id="displayV" class="display" type="button">المتطوعين</button>
      <button id="displayS" class="display" type="button">الرعاة</button>
  </div>
</div>
            
             <a href="add.php" id="addB" <button class="button" type="button">إضافة عضو</button></a>
            
        </div>
    
        
        <table class="table">
            <thead class="table-head">
            <tr class="row1">
                  <td class="column1">#</td>'; ?>
             <?php
   
            echo
      '<td class="column1">اسم العضو </td>'
           .'<td class="column2">البريد الإلكتروني</td>'.'<td class="column3">رقم الهاتف</td>'.
		'<td class="column4">الجنس</td>'.
                '<td class="column4">التعديل</td>'.
               '<td class="column4">الحذف</td>'.' </tr>  
            </thead>';
            
            
                    $sql="SELECT * FROM member";
          $result = mysqli_query( $connection, $sql);
          $list = array();
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
      $list=row['email_address'];
   echo    '<tbody class="table-body">
	<tr class="row2">
            <td class="cell100 column1" id="inc"></td>
		<td class="cell100 column1">'.$row['first_name'].' '.$row['last_name'].'</td>
		<td class="cell100 column2">'.$row['email_address'].'</td>
		<td class="cell100 column3">'.$row['phone_number'].'</td>
		<td class="cell100 column4">'.$row['gender'].'</td>
                <td class="column5"><a href="edit-member.php?id='.$row['id'].'">تعديل</a></td><!-- comment -->
                <td class="column6"><a href="#myModal" class="trigger-btn" data-toggle="modal">حذف</a></td>
		
        </tr>';
  }
                  }
                  
             
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
             
           echo '</tbody> 
            
        </table>
        
    <!-- Modal HTML -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header flex-column">
				<div class="icon-box">
				<i class="material-icons"><i class="fa fa-times" aria-hidden="true"></i></i>
				</div>						
				<h4 class="modal-title w-100">هل أنت متأكد ؟</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<p>حذفك لهذا الحساب يعني حذف جميع بياناته الشخصية</p>
			</div>
			<div class="modal-footer justify-content-center">
                            <a href="delete.php?id=2"><button type="button" class="btn btn-danger">حذف</button></a>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
			</div>
		</div>
	</div>
</div>
                  
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
</script>';

