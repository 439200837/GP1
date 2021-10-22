<?php require 'layout/AdminHeader.php'; 
?>
<element dir="rtl">
<section>


        <div class="above-table">
            
        <div class="dropdown">
            <button class="dropbtn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
  <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
</svg> الأعضاء  </button>
  <div class="dropdown-content">
    <a href="#">الأعضاء</a>
    <a href="#">الرعاة</a>
    <a href="#">المتطوعين</a>
  </div>
</div>
            
            <button class="button" type="button">إضافة عضو</button>
            
        </div>
    
        
        <table class="table">
            <thead class="table-head">
            <tr class="row1">
                  <td class="column1">#</td>
                <td class="column1">اسم العضو </td>
                <td class="column2">البريد الإلكتروني</td>
                <td class="column3">رقم الهاتف</td>
		<td class="column4">الجنس</td>
                <td class="column4">التعديل</td><!-- comment -->
                <td class="column4">الحذف</td>
    	    </tr>  
            </thead>
            
        
         <!-- comment -->
        
           
            <tbody class="table-body">
	<tr class="row2">
            <td class="cell100 column1" id="inc"></td>
		<td class="cell100 column1">لينا النويصر</td>
		<td class="cell100 column2">lenna@hotmail.com</td>
		<td class="cell100 column3">0511111111</td>
		<td class="cell100 column4">انثى</td>
                <td class="column5"><a href="">تعديل</a></td><!-- comment -->
                <td class="column6"><a href="">حذف</a></td>
		
        </tr>

	<tr class="row3">
                <td class="cell100 column1" id="inc"></td>
		<td class="cell100 column1">ريما النويصر</td>
		<td class="cell100 column2">reema@gmail.com</td>
		<td class="cell100 column3">055555555</td>
		<td class="cell100 column4">انثى</td>
                <td class="column5"><a href="">تعديل</a></td><!-- comment -->
                <td class="column6"><a href="">حذف</a></td>
	  </tr>
          
	<tr class="row4">
                <td class="cell100 column1" id="inc"></td>
		<td class="cell100 column1">مشاعل القرني</td>
		<td class="cell100 column2">meshael@gmail.com</td>
		<td class="cell100 column3">0522222222</td>
		<td class="cell100 column4">انثى</td>
                <td class="column5"><a href="">تعديل</a></td><!-- comment -->
                <td class="column6"><a href="">حذف</a></td>
	  </tr>
          
	<tr class="row5">
                <td class="cell100 column1" id="inc"></td>
		<td class="cell100 column1">نورة الجنوبي</td>
		<td class="cell100 column2">noura@gmail.com</td>
		<td class="cell100 column3">053333333</td>
		<td class="cell100 column4">انثى</td>
                <td class="column5"><a href="">تعديل</a></td><!-- comment -->
                <td class="column6"><a href="">حذف</a></td>
        </tr><!-- comment -->
        
	<tr class="row6">
                <td class="cell100 column1" id="inc"></td>
		<td class="cell100 column1">غيداء الخضيري</td>
		<td class="cell100 column2">Ghaida@gmail.com</td>
		<td class="cell100 column3">054444444</td>
		<td class="cell100 column4">انثى</td>
                <td class="column5"><a href="">تعديل</a></td><!-- comment -->
                <td class="column6"><a href="">حذف</a></td>
	  </tr>
           </tbody> 
            
        </table>
        
            
    </section>
   <element dir="ltr">
      <?php require 'layout/footer.php'; 
?>
    </body>
</html>
