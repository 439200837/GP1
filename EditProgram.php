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
//connect to the page config.php page
require 'config.php';
$id=$_GET['id'];
// change title name
echo "<script> document.title='تعديل برنامج' </script>";

//updating program information
if(isset($_POST['add']))
    {
   //define variables
$proname=$_POST["proname"];
    $prodes = $_POST['prodes'];
  $start_date = $_POST['prostart'];
  $end_date = $_POST['proend'];
  $procedures = $_POST['propro'];
  $sp_phone=$_POST['sponsor_phone'];
 // $protype= $_POST['protype'];
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
  
    $id2=$_POST['id'];
     $image = addslashes(file_get_contents($_FILES['images']['tmp_name']));
    if($image==""){
       $sql_update = "UPDATE `program` SET `name`='$proname', `start_date`='$start_date', `end_date`='$end_date', `type`='$chk', `description`='$prodes' ,`procedures`='$procedures', `preference`='$chk2',`phone`='$sp_phone' WHERE `id`='$id2'";  
         echo "<br>";
       }    

   elseif($image!="") { 
        // Get file info 
       $image = addslashes(file_get_contents($_FILES['images']['tmp_name']));
        $sql_update = "UPDATE `program` SET `name`='$proname', `start_date`='$start_date', `end_date`='$end_date', `type`='$chk', `description`='$prodes', `picture`='$image',`phone`='$sp_phone' WHERE `id`='$id2'";
       }
        $query_update = mysqli_query( $connection, $sql_update);
//if run query get error echo eles redirect back
if(mysqli_affected_rows($connection) >0){
 echo "<script>
           
                Swal.fire({
                     icon: 'success',
                     title: 'تم تعديل البرنامج بنجاح',
                     text: '',
                     showConfirmButton: true,
                     confirmButtonText:'إغلاق ',
                     closeOnConfirm: false

                     }).then((result) => {
                         location.replace('programs.php'); 
                         })

                 </script>";

}else{
     echo  "<p style='text-align: right; color:red; margin-top:120px;'>"."نعتذر ،حدث خطأ"."</p>"; 
}
   
    }
           
        
  
         
  // output data of  row
 
  ?>

<element dir="rtl">
<body>
    <body class="reg" onkeyup="my(); ">
        <div class="container5">
    <div class="title" dir="rtl">تعديل البرنامج</div>
    <div class="content">
        <?php 
 
 if (true) {

  //get  program data 

 $sql="SELECT * FROM program where id='$id'";
          $result = mysqli_query( $connection, $sql);
  // output data of  row
   $row = mysqli_fetch_assoc($result);
   $type=$row['type'];
   $preference=$row['preference'];
   ?>
        <form enctype="multipart/form-data" name="form" action="EditProgram.php?id=<?php  echo $id;?>" method="post"  >
        <div class="user-details">
            
            
            <div class="input-box">
            <span class="details" dir="rtl">اسم البرنامج</span> 
           <input type="text" name="proname" id="proname" onkeyup="ValidateName() " value="<?php echo $row['name']?>" dir="rtl" required="required">
            <p id="er6" style="color: red;"></p>
          </div>
            
            <div class="input-box">
            <span class="details" dir="rtl">وصف البرنامج</span> 
           <input type="textarea" rows="4" cols="50" name="prodes" id="prodes" onkeyup="Validatedes()" value="<?php echo $row['description']?>" dir="rtl" required="required">
            <p id="er10" style="color: red;"></p>
           </div>
            
             <div class="input-box">
            <span class="details" dir="rtl">إجراءات المتطوع للعمل بالبرنامج</span> 
              <input type="text"    name="propro" id="propro" onkeyup="Validatedes() () " value="<?php echo $row['procedures']?>" dir="rtl" required="required">
           <p id="er11" style="color: red;"></p>
             </div><!-- comment -->
           <div class="input-box">
            <span class="details" dir="rtl">تاريخ بداية البرنامج</span>
            <input type="date" name="prostart" id="start" onchange="checkdate()" placeholder="تاريخ الميلاد"  dir="rtl" value="<?php echo $row['start_date']?>">
           </div><!-- comment -->
           
            <div class="input-box">
            <span class="details" dir="rtl">تاريخ نهاية البرنامج</span>
            <input type="date" name="proend" id="end" onchange="checkdate()" placeholder="تاريخ الميلاد"  dir="rtl" value="<?php echo $row['end_date']?>">
          <p id="er3" style="color: red;"></p>
            </div>
           <input type="hidden" name="id" value="<?=$id?>">
           
            <div class="input-box" id="input-wrapper">
            <span class="details" dir="rtl">رقم الهاتف للتواصل مع الرعاة*</span>
            
            <input onkeyup="ValidatePhone()" type="tel" name="sponsor_phone"  id="sponsor_phone" value="<?php echo $row['phone']?>" dir="rtl" required="required">
            <span id="SAcode">966+</span> 
            <p id="er5" style="color: red;"></p>
             </div>
     <!-- comment
           <!-- comment 
           <div class="input-box">
            <span class="details" dir="rtl">اختر نوع البرنامج</span> 
           <input type="text" name="protype" id="protype" onchange="Validatetype() " value="<?php echo $row['type']?>" dir="rtl" required="required">
            <p id="er4" style="color: red;"></p>
          </div>-->
           
         
           
 <?php 
  $skills=  explode(",", $type);
  
  $pref=    explode(",", $preference);

//foreach($skills as $value) {
// echo $value."<br>";
  
//}
?>
             <div  dir="rtl" id="Skilll">
         <p id="er10" style="color: red;"></p>
        <span  dir="rtl" >تفضيلات البرنامج*</span><br><br>
        <input  type="checkbox" name="preference[]" value="العمل بدون تواصل مع المستفيدين" <?=(in_array('العمل بدون تواصل مع المستفيدين', $pref))? "CHECKED='CHECKED'" : '' ?> ><span class="skill" >العمل بدون تواصل مع المستفيدين</span><br>
        <input  type="checkbox" name="preference[]" value="أفضل التعامل مع كبار السن" <?=(in_array('أفضل التعامل مع كبار السن', $pref))? "CHECKED='CHECKED'" : '' ?>><span class="skill" > التعامل مع كبار السن</span><br>
        <input type="checkbox" name="preference[]" value="أفضل التعامل مع الأطفال" <?=(in_array('أفضل التعامل مع الأطفال', $pref))? "CHECKED='CHECKED'" : '' ?>><span class="skill" > التعامل مع الأطفال</span><br>
        <input type="checkbox" name="preference[]" value="أفضل التعامل مع ذوي الاحتياجات الخاصة" <?=(in_array('أفضل التعامل مع ذوي الاحتياجات الخاصة', $pref))? "CHECKED='CHECKED'" : '' ?>><span class="skill" > التعامل مع ذوي الاحتياجات الخاصة</span><br>
<br>
        </div>   
           <div dir="rtl" style="margin-left: 40%; white-space: nowrap;" onchange="ValidateCheckBox()">
             <p id="er1" style="color: red;"></p>
            <span class="details" dir="rtl">اختر نوع البرنامج </span><br>
              
            
               <input  type="checkbox"  name="protype[]"  value="ترفيه" <?=(in_array('ترفيه', $skills))? "CHECKED='CHECKED'" : '' ?> ><span class="skill" >ترفيه</span><br>
            <input  type="checkbox"  name="protype[]"  value="تعليم" <?=(in_array('تعليم', $skills))? "CHECKED='CHECKED'" : '' ?> ><span class="skill" >تعليم</span><br>
            <input  type="checkbox" name="protype[]" value="غذاء" <?=(in_array('غذاء', $skills))? "CHECKED='CHECKED'" : ''?> ><span class="skill" >غذاء</span><br>
            <input  type="checkbox" name="protype[]" value="ملابس" <?=(in_array('ملابس', $skills))? "CHECKED='CHECKED'" : ''?> ><span class="skill" >ملابس</span><br>
            <input  type="checkbox" name="protype[]" value="جلسات نفسية" <?=(in_array('جلسات نفسية', $skills))? "CHECKED='CHECKED'" : ''?> ><span class="skill" > جلسات نفسية </span><br><br>
                   </div>
           
           <div class="filebutton input-box" style="margin-right: 0%;">
           <label for="file-upload" class="custom-file-upload" style="float:right; width: 50%;">
    اختر صورة جديدة للبرنامج
</label>
         
           <input type="file" id="file-upload"   name="images" placeholder="Enter Course Image Please"  style="margin-left: 480px;"accept="image/*"> 
           <p id="file_name" style="margin-left: 20px"></p>
           </div>
           <!-- comment  <span class="details_img" dir="rtl">اختر صورة للبرنامج</span>
            <input type="file" name="dateOfBirth" id="birth" placeholder="تاريخ الميلاد"  dir="rtl" value="<//?= $row['dateOfBirth']?>">
          
           <input type="file" name="proimg" class="hidden" id="uploadFile" />
<div class="button" id="uploadTrigger" style="margin-left: 480px; white-space: nowrap;">اختر صورة للبرنامج</div>
         <script>
          $("uploadTrigger").click(function(){
           $("#uploadFile").click();   
          });
           </script>-->
           
        </div>
             <input id="Submit" type="submit" name='add' class="fbutton" value="تعديل">
             <a href="detalis.php?id=<?php echo $id;?>"<button id="cancel"  name="cancel" type="button" class="Bbutton">إلغاء</button></a>
      </form>
    </div>
  </div>
        <?php  }
    
      ?>
         <script type="text/javascript">
     // var count=0;
 document.getElementById("Submit").disabled=true;
   
 function ValidateName() {
      var regex="^[\u0621-\u064A\040!@#\$%\^\&*\)\(+=.ّ,_ًٌٍَُِ-]+$";
      var reg="[\u0600-\u06FF]";
      var pname = document.getElementById("proname").value;
      
      
      if (!pname.match(regex)){
                 document.getElementById("er6").innerHTML="فضلا ،  ادخل اسم صحيح أو باللغة العربية";
                  document.getElementById("proname").style.borderColor="red";
               
             }else{
                document.getElementById("er6").innerHTML="";
                document.getElementById("proname").style.borderColor="#9b59b6";
               
             }}
    
     function Validatedes(){  
            var regex="^[\u0621-\u064A\0400-9!@#\$%\^\&*\)\(+=.ّ,_ًٌٍَُِ-]+$";
      var reg="[\u0600-\u06FF]";
      var pname = document.getElementById("proname").value;
      var pdes = document.getElementById("prodes").value;
      if(pdes==""){
          document.getElementById("er10").innerHTML="فضلا ،  ادخل وصف صحيح أو باللغة العربية";
          document.getElementById("prodes").style.borderColor="red"; 
      }
      else if (!pdes.match(regex) &&pdes!==""){
                 document.getElementById("er10").innerHTML=" فضلا ،  ادخل وصف صحيح أو باللغة العربية ";
                  document.getElementById("prodes").style.borderColor="red";
                 
             }else{
                document.getElementById("er10").innerHTML="";
                document.getElementById("prodes").style.borderColor="#9b59b6";
               
             }}
         
          function Validatedes()   {  
            var regex="^[\u0621-\u064A\0400-9!@#\$%\^\&*\)\(+=.ّ,_ًٌٍَُِ]+$";
      var reg="[\u0600-\u06FF]";
      var pname = document.getElementById("proname").value;
      var pdes = document.getElementById("propro").value;
      if (!pdes.match(regex) &&pdes!==""){
                 document.getElementById("er11").innerHTML="فضلا ، ادخل وصف صحيح أو باللغة العربية";
                  document.getElementById("propro").style.borderColor="red";
                  
             }else{
                document.getElementById("er11").innerHTML="";
                document.getElementById("propro").style.borderColor="#9b59b6";
              
             }}
         
     function ValidateCheckBox() {
       var checkboxes = document.querySelectorAll('input[type="checkbox"]');
var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);
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
  
  function my(){
        er=document.getElementById("proname").style.borderColor;
        er1=document.getElementById("prodes").style.borderColor;
        er2=document.getElementById("end").style.borderColor;
        er3=ValidateCheckBox();
        if(!(er=="red"||er1=="red"||er2=="red")&& er3==true){
            document.getElementById("Submit").disabled=false;
            return true;
         } else{
              document.getElementById("Submit").disabled=true;
              return false;
         }}
     
  
     
   function checkdate(){
      // $("#end").change(function () {
    var startDate = document.getElementById("start").value;
    var endDate = document.getElementById("end").value;


    if ((Date.parse(endDate) < Date.parse(startDate))) {
        document.getElementById("er3").innerHTML="يجب أن يكون تاريخ نهاية البرنامج بعد تاريخ بداية البرنامج";
        document.getElementById("end").style.borderColor="red";
        count++;
    }else{
        document.getElementById("er3").innerHTML = "";
         document.getElementById("end").style.borderColor="#9b59b6";
        count--;
    }
 }
 
 $(document).ready(function(){
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
             isAllInputTrue=my();
             if(isAllInputTrue){
                document.getElementById("Submit").disabled=false;   
             }
            //alert('قمت باختيار الصورة"' + fileName +  '".');
            document.getElementById("file_name").innerHTML='قمت باختيار الصورة"' + fileName +  '".';
        })
    });
   </script>
    
    
</body>

    <element dir="ltr">
        <!-- footer calling -->   
      <?php
      require 'layout/footer.php'; 
     // close database connections 
     mysqli_close($connection);
?>
   </body>
</html>
