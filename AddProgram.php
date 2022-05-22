<?php
session_start();
//connect to the header page and to config.php page
if($_SESSION['logged_in']===true && $_SESSION['type'] ==='admin'){
    require 'layout/AdminHeader.php'; 
 }elseif($_SESSION['logged_in']===true && $_SESSION['type'] ==='member'){
   require'layout/loggedHeader.php';
 }else{
  //if anyone try to enter this page without premession it will be redirect to home.php
  echo '<script>window.location.replace("index.php");</script>';
 }
require 'config.php';
// change title name
echo "<script> document.title='إضافة برنامج' </script>";
$status = $statusMsg = ''; 
if(isset($_POST['add'])){
  //define the variables
    $proname=$_POST["proname"];
    $prodes = $_POST['prodes'];
  $start_date = $_POST['prostart'];
  $end_date = $_POST['proend'];
  $procedures= $_POST['propro'];
  $sp_phone=$_POST['sponsor_phone'];
 // $protype=$_POST['protype'];
 
   $checkbox1=$_POST['protype'];  
$chk="";  
foreach($checkbox1 as $chk1)  
   {  
      $chk .= $chk1.",";  
   }
   
   $checkbox2=$_POST['preference'];
   $chk2="";
   foreach($checkbox2 as $chk3)  
   {  
      $chk2 .= $chk3.",";  
   }
  
 $image = addslashes(file_get_contents($_FILES['images']['tmp_name']));
 //bring the name information to check if it has been stored before
  $sql_n = "SELECT * FROM program WHERE name='$proname'";
 

    $res_n = mysqli_query($connection, $sql_n);
  

  if (mysqli_num_rows($res_n) > 0){
         echo  "<p style='text-align: right; color:red; margin-top:120px;'>"."نعتذر ، الاسم مستخدم في برنامج آخر ، يرجى تغيير الاسم"."</p>"; 
        
    }else{
       //insert in program table
       $query = "INSERT INTO program (name, start_date, end_date, type, description, picture, procedures, preference, phone) VALUES ('$proname','$start_date','$end_date','$chk','$prodes','$image', '$procedures', '$chk2', $sp_phone)";
        $results = mysqli_query($connection, $query);
       
                 if ( false===$results ) {
                    echo "<p style='text-align: right; margin-top:120px;'>". "نعتذر ، حدث خطأ"."</p>";
                                    }
                 else {
                       //echo success adding program
                           echo "<script>
           
                Swal.fire({
                     icon: 'success',
                     title: 'تم إضافة البرنامج بنجاح',
                     text: '',
                     showConfirmButton: true,
                     confirmButtonText:'إغلاق ',
                     closeOnConfirm: false

                     }).then((result) => {
                         location.replace('AddProgram.php'); 
                         })

                 </script>";}}}
?>

<element dir="rtl">
<body>
    <!-- adding program form  -->
    <body class="reg" onkeyup="my()">
        <div class="container5">
    <div class="title" dir="rtl">إضافة برنامج</div>
    <div class="content">
        <form enctype="multipart/form-data" name="form" action="AddProgram.php" method="post">
        <div class="user-details">
            
            
            <div class="input-box">
            <span class="details" dir="rtl">اسم البرنامج*</span> 
           <input type="text" name="proname" id="proname" onkeyup="ValidateName() " placeholder="ادخل اسم البرنامج" dir="rtl" required="required">
            <p id="er6" style="color: red;"></p>
          </div>
            
            <div class="input-box">
            <span class="details" dir="rtl">وصف البرنامج*</span> 
              <input type="text"    name="prodes" id="prodes" onkeyup="Validatedes()" placeholder="ادخل وصف البرنامج" dir="rtl" required="required">
           <p id="er10" style="color: red;"></p>
           </div>
            
             <div class="input-box">
            <span class="details" dir="rtl">إجراءات المتطوع للعمل بالبرنامج*</span> 
              <input type="text"    name="propro" id="propro" onkeyup="Validatepropro()" placeholder=" االإجراءات اللازمة (المكان، الوقت، إلخ..)" dir="rtl" required="required">
           <p id="er11" style="color: red;"></p>
           </div>
            
           <div class="input-box">
            <span class="details" dir="rtl">تاريخ بداية البرنامج*</span>
            <input type="date" name="prostart" id="start"  onchange="checkdate()" placeholder="تاريخ الميلاد"  dir="rtl" required="required" >
           </div><!-- comment -->
           
            <div class="input-box">
            <span class="details" dir="rtl">تاريخ نهاية البرنامج*</span>
            <input type="date" name="proend" id="end" onchange="checkdate() " placeholder="تاريخ الميلاد"  dir="rtl" required="required" >
            <p id="er3" style="color: red;"></p>
          </div>
            <div class="input-box" id="input-wrapper">
            <span class="details" dir="rtl">رقم الهاتف للتواصل مع الرعاة*</span>
            
            <input onkeyup="ValidatePhone()" type="tel" name="sponsor_phone"  id="sponsor_phone" placeholder="5XXXXXXXX" " dir="rtl" required="required">
            <span id="SAcode">966+</span>
            <p id="er5" style="color: red;"></p>
           </div>
 
      <div style="margin-left: 100px; white-space: nowrap;" dir="rtl" id="Skilll" onchange="ValidateCheckBoxpref()">
<p id="er2" style="color: red;"></p>
        <span  dir="rtl" >تفضيلات البرنامج*</span><br><br>
        <input  type="checkbox" name="preference[]" value="العمل بدون تواصل مع المستفيدين" checked="checked"><span class="skill" >العمل بدون تواصل مع المستفيدين</span><br>
        <input  type="checkbox" name="preference[]" value="أفضل التعامل مع كبار السن"><span class="skill" > التعامل مع كبار السن</span><br>
        <input type="checkbox" name="preference[]" value="أفضل التعامل مع الأطفال"><span class="skill" > التعامل مع الأطفال</span><br>
        <input type="checkbox" name="preference[]" value="أفضل التعامل مع ذوي الاحتياجات الخاصة"><span class="skill" > التعامل مع ذوي الاحتياجات الخاصة</span><br>
<br>
        </div>    
     
             <div dir="rtl" style="margin-left: 40%; white-space: nowrap;" onchange="ValidateCheckBoxtype()" >
              <p id="er1" style="color: red;"></p>
            <span class="details" dir="rtl">اختر نوع البرنامج* </span><br>
               
            <p id="er4" style="color: red;"></p>
            <input  type="checkbox" id="check1" name="protype[]"  value="ترفيه" onchange="valthisform()"><span class="skill" >ترفيه</span><br>
            <input  type="checkbox"  id="check2" name="protype[]"  value="تعليم" onchange="valthisform()"><span class="skill" >تعليم</span><br>
            <input  type="checkbox" id="check3" name="protype[]"  value="غذاء" onchange="valthisform()"><span class="skill" >غذاء</span><br>
            <input  type="checkbox" id="check4" name="protype[]"  value="ملابس" onchange="valthisform()"><span class="skill" >ملابس</span><br>
            <input  type="checkbox" id="check5" name="protype[]"  value="جلسات نفسية" onchange="valthisform()"><span class="skill" >جلسات نفسية</span><br>
                   </div>   
     
     
     
     
     
     <div class="filebutton input-box" style="margin-right: 0%;">
               <p id="erF" style="color: red;"></p>
           <label for="file-upload" class="custom-file-upload" style="float:right; width: 50%;">
    اختر صورة للبرنامج*
</label>
           
               <input type="file" id="file-upload"   name="images" placeholder="Enter Image Please"  accept="image/*" onchange='getFileData(this)' required> 
      <p id="file_name" style="margin-left: 20px"></p>
           </div>
        
           <!-- comment  <span class="details_img" dir="rtl">اختر صورة للبرنامج</span>
            <input type="file" name="dateOfBirth" id="birth" placeholder="تاريخ الميلاد"  dir="rtl" value="<//?= $row['dateOfBirth']?>">
          
           <input type="file" name="proimg" class="hidden" id="uploadFile" />
<div class="button" id="uploadTrigger" style="margin-left: 480px; ">اختر صورة للبرنامج</div>
          <script>
          $("uploadTrigger").click(function(){
           $("#uploadFile").click();   
          });
           </script>-->
           
        </div>
             <input id="Submit" type="submit" name='add' class="fbutton" value="إضافة" >
             <a href="programs.php"<button id="cancel"  name="cancel" type="button" class="Bbutton">إلغاء</button></a>
      </form>
    </div>
  </div>
    
        <script type="text/javascript">
            //script for input validation 
      var count=0;
 document.getElementById("Submit").disabled=true;
   
   function ValidateName() {
      var regex="^[\u0621-\u064A\040!@#\$%\^\&*\)\(+=.ّ,_ًٌٍَُِ]+$";
      var reg="[\u0600-\u06FF]";
      var pname = document.getElementById("proname").value;
      
      
      if (!pname.match(regex)){
                 document.getElementById("er6").innerHTML="فضلا ،  ادخل اسم صحيح أو باللغة العربية";
                  document.getElementById("proname").style.borderColor="red";
              
             }else{
                document.getElementById("er6").innerHTML="";
                document.getElementById("proname").style.borderColor="#9b59b6";
              
             }}
        function Validatedes()   {  
      var regex="^[\u0621-\u064A\040!@#\$%\^\&*\)\(+=.ّ,_ًٌٍَُِ]+$";
      var pdes = document.getElementById("prodes").value;
      if (!pdes.match(regex)){
                 document.getElementById("er10").innerHTML="فضًلا، أدخل وصف باللغة العربية";
                  document.getElementById("prodes").style.borderColor="red";
                  
             }else{
                document.getElementById("er10").innerHTML="";
                document.getElementById("prodes").style.borderColor="#9b59b6";
              
             }}
         
     function Validatepropro()   {  
            var regex="^[\u0621-\u064A\0400-9!@#\$%\^\&*\)\(+=.ّ,_ًٌٍَُِ]+$";
            var propro = document.getElementById("propro").value;
            if (!propro.match(regex)){
                 document.getElementById("er11").innerHTML="فضًلا، ادخل بيانات باللغة العربية";
                  document.getElementById("propro").style.borderColor="red";
                  
             }else{
                document.getElementById("er11").innerHTML="";
                document.getElementById("propro").style.borderColor="#9b59b6";
              
             }}
         
      function ValidateCheckBoxtype() {
       var checkboxes = document.querySelectorAll('input[type="checkbox"]');
var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);
//var checkedone2= Array.preference.slice.call(checkboxes).some(x => x.checked);
if (checkedOne == true){
document.getElementById("er1").innerHTML="";
  document.getElementById("Submit").disabled=false;
 return true;
 } else {
    document.getElementById("er1").innerHTML="فضلا ، ادخل نوع صحيح";
      document.getElementById("Submit").disabled=true;
    return false;
 }
      }
      
      function ValidateCheckBoxpref(){
          var checkedone2 = Array.preference.slice.call(checkboxes).some(x => x.checked);
 if (checkedone2 == true){
document.getElementById("er2").innerHTML="";
  document.getElementById("Submit").disabled=false;
 return true;
 } else {
    document.getElementById("er2").innerHTML="فضلا ، ادخل تفضيل صحيح";
      document.getElementById("Submit").disabled=true;
    return false;
 }
 

   } 
         
  
 
     
     //check if end date is after start date
     function checkdate(){
      // $("#end").change(function () {
    var startDate = document.getElementById("start").value;
    var endDate = document.getElementById("end").value;


    if ((Date.parse(endDate) < Date.parse(startDate))) {
        document.getElementById("er3").innerHTML=" فضلا، يجب أن يكون تاريخ نهاية البرنامج بعد تاريخ بداية البرنامج ";
        document.getElementById("end").style.borderColor="red";
        count++;
    }else{
        document.getElementById("er3").innerHTML = "";
         document.getElementById("end").style.borderColor="#9b59b6";
        count--;
    }}
 //important||||||||||||
   function ValidatePhone() {
      var regex="^5[0-9]{8}$";
      var phone = document.getElementById("sponsor_phone").value;
         if (!phone.match(regex)){
                 document.getElementById("er5").innerHTML="أدخل رقم الهاتف بشكل صحيح يبدأ ب 5";
                  document.getElementById("sponsor_phone").style.borderColor="red";
                  count++;
             }else{
                document.getElementById("er5").innerHTML="";
                document.getElementById("sponsor_phone").style.borderColor="#9b59b6";
                count--;
             }

    }
 $('#Submit').click(function() {
      checked = $("input:checkbox[name='protype[]']:checked").length;
      checked2 = $("input:checkbox[name='preference[]']:checked").length;
      if(!checked) {
       document.getElementById("er1").innerHTML="فضلا ، ادخل نوع واحد على الأقل ";
      }else{
      document.getElementById("er1").innerHTML="";    
      }
      if(!checked2) {
       document.getElementById("er2").innerHTML="فضلا ، ادخل تفضيل واحد على الأقل ";
      }else{
      document.getElementById("er2").innerHTML="";    
      }
      if(!checked ||!checked2){
        return false;   
      }
      

      

    });

     function my(){
        er=document.getElementById("proname").style.borderColor;
        er1=document.getElementById("prodes").style.borderColor;
        er2=document.getElementById("end").style.borderColor;
        er4=document.getElementById("propro").style.borderColor;
        er5=document.getElementById("sponsor_phone").style.borderColor;
        er3=ValidateCheckBoxtype();
        er6=ValidateCheckBoxpref();
       
        if(!(er=="red"||er1=="red"||er2=="red"||er4=="red"||er5=="red")&& (er3==true||er6==true)){
            document.getElementById("Submit").disabled=false;
        
         } else{
              document.getElementById("Submit").disabled=true;
         }}

   
 $(document).ready(function(){
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            //alert('قمت باختيار الصورة"' + fileName +  '".');
            document.getElementById("file_name").innerHTML='قمت باختيار الصورة"' + fileName +  '".';
        })
    });
   </script>
    
</body>

    <element dir="ltr">
        <!-- footer calling -->   
      <?php require 'layout/footer.php'; 
     // close database connections 
     mysqli_close($connection);
?>
   </body>
    </html>
