<?php
session_start();
//connect to the header.php page and to config.php page
//connect to the AdminHeader.php page and to config.php page
if($_SESSION['logged_in']===true && $_SESSION['type'] ==='admin'){
    require 'layout/AdminHeader.php'; 
 }elseif($_SESSION['logged_in']===true && $_SESSION['type'] ==='volunteer'){
   require'layout/loggedHeader.php';
 }else{
  //if anyone try to enter this page without premession it will be redirect to home.php
  echo '<script>window.location.replace("index.php");</script>';
 }

require 'config.php';
$id=$_GET['id'];
 // change title name
echo "<script> document.title='تعديل بيانات المتطوع' </script>";
?>
<element dir="rtl">
    <body class="reg" onchange="my()">
        <div class="container5">
    <div class="title" dir="rtl">تعديل معلومات المتطوعين</div>
    <div class="content">
  <?php  
   if (isset($_GET['id'])) {

  $sql="SELECT * FROM volunteer where id='$id'";
          $result = mysqli_query( $connection, $sql);
  // output data of  row
  while($row = mysqli_fetch_assoc($result)) {?>

      <form action="edit-volunteer.php" method="post">
        <div class="user-details">
              <div class="input-box">
            <span class="details" dir="rtl">الاسم الأول</span>
            <input type="text" placeholder="ادخل الاسم الاول" dir="rtl" onkeyup="ValidateName()" id="fname" name="first_name" value="<?= $row['first_name']?>">
            <p id="er6" style="color: red;"></p>

          </div>
         <div class="input-box">
            <span class="details" dir="rtl">اسم العائلة </span>
            <input type="text" placeholder="ادخل الاسم الثاني" dir="rtl" onkeyup="ValidateName()" id="lname" name="last_name" value="<?= $row['last_name']?>">
            <p id="er7" style="color: red;"></p>

          </div>
          
          <div class="input-box">
            <span class="details" dir="rtl">البريد الإلكتروني</span>
            <input type="email" placeholder="mail@example.com" onchange="ValidateEmail()" id="email" dir="rtl"  name="email_address" value="<?=$row['email_address']?>">
            <p id="er" style="color: red;"></p>

          </div>
             <div class="input-box">
            <span class="details" dir="rtl">رقم الهاتف</span>
            <input type="tel" placeholder="05XXXXXXXX" id="phone" onchange="ValidatePhone()" dir="rtl" name="phone_number" value="<?= $row['phone_number']?>">
            <p id="er5" style="color: red;"></p>

          </div>
            
             <div class="input-box">
            <span class="details" dir="rtl">تاريخ الميلاد</span>
            <input type="date" name="dateOfBirth" id="birth" placeholder="تاريخ الميلاد"  dir="rtl" value="<?= $row['dateOfBirth']?>">
          </div>
            
               <div class="gender-details" dir="rtl">
          <input type="radio" name="gender" value="ذكر" id="dot-1" <?= ($row['gender'] == 'ذكر`')?'checked="checked"':''?>>
          <input type="radio" name="gender" value="أنثى" id="dot-2"   <?= ($row['gender'] == 'أنثى')?'checked="checked"':''?>>
   
          <span class="gender-title" dir="rtl">الجنس</span>
          <div class="category" >
              <ul style="list-style-type: none;">  
                  <li><label for="dot-1">
                             <span class="dot one"></span>
                 <span class="gender">ذكر</span>
         
          
                      </label></li>
                      <li> <label for="dot-2">
                              <span class="dot two"></span>
               <span class="gender">أنثى</span>
         
           
                          </label></li> </ul>
         
          </div>
          
        </div>
         
        
         <div class="input-box">
            <span class="details" dir="rtl">المستوى التعليمي</span>
         <select name="educational_level" id="edu"  dir="rtl" >
           <option value=""></option>
            <option <?=($row['educational_level']=='تعليم إبتدائي')? 'selected':'' ?> value="تعليم إبتدائي">تعليم إبتدائي</option>
            <option  <?=($row['educational_level']=='تعليم متوسط<')? 'selected':'' ?> value="تعليم متوسط<">تعليم متوسط</option>
            <option  <?=($row['educational_level']=='تعليم ثانوي')? 'selected':'' ?> value="تعليم ثانوي">تعليم ثانوي</option>
            <option  <?=($row['educational_level']=='درجة بكالوريس')? 'selected':'' ?> value="درجة بكالوريس">درجة بكالوريس</option>
            <option  <?=($row['educational_level']=='درجة الماجستير')? 'selected':'' ?> value="درجة الماجستير">درجة الماجستير</option>
              <option  <?=($row['educational_level']=='دكتوراه')? 'selected':'' ?> value="دكتوراه">دكتوراه</option>
              <option  <?=($row['educational_level']=='دبلوم')? 'selected':'' ?> value="دبلوم">دبلوم</option>
                <option  <?=($row['educational_level']=='شهادة التأهيل المهني')? 'selected':'' ?> value="شهادة التأهيل المهني">شهادة التأهيل المهني</option>
            </select>
          </div>
              <div class="input-box">
            <span class="details" dir="rtl"> الحي (مدينة الرياض) </span>
         <select name="address" id="address"  dir="rtl">
  <option value="المغرزات">المغرزات</option>
  
  <option value="غرناطة">غرناطة</option>
  
  <option value="العقيق">العقيق</option>
  
  <option value="المروج">المروج</option> 
  
  <option value="الازدهار">الازدهار</option>
  
  <option value="الصحافة">الصحافة</option> 
  
  <option value="النخيل">النخيل</option>
  
  <option value="الملقا">الملقا</option> 
  
  <option value="الربيع">الربيع</option>
  
  <option value="النخيل الشرقي">النخيل الشرقي</option>
  
  <option value="النخيل الغربي">النخيل الغربي</option>
  
  <option value="الورود">الورود</option> 
  
  <option value="المرسلات">المرسلات</option>
  
  <option value="المروة">المروة</option> 
  
  <option value="الدار البيضاء">الدار البيضاء</option>
  
  <option value="العزيزية">العزيزية</option>
 <option value="شبرا">شبرا</option>
  
  <option value="الدريهمية">الدريهمية</option>  
  
  <option value="المنصورة">المنصورة</option>
  
  <option value="اليمامة">اليمامة</option> 
  <option value="بدر">بدر</option>
  
  <option value="الفواز">الفواز</option> 
  
  <option value="نمار">الشفاء</option>
  
  <option value="المصانع">المصانع</option>
 <option value="الحاير">الحاير</option>
  
  <option value="الشميسي">الشميسي</option> 
  
  <option value="السويدي">السويدي</option>
  
  <option value="الشعلان">الشعلان</option>
  
  <option value="بن تركي">بن تركي</option>
  
  <option value="جامعة الملك سعود">جامعة الملك سعود</option>
  
  <option value="عرقة">عرقة</option>
  
  <option value="الدرعية">الدرعية</option> 
  <option value="شبرا">شبرا</option>
  
  <option value="ظهرة البديعة">ظهرة البديعة</option> 
  
  <option value="العريجاء">العريجاء </option>
  
  <option value="البديعة">البديعة</option>
 <option value="القدس">القدس</option>
  
  <option value="الحمراء">الحمراء</option> 
  
  <option value="الريان">الريان</option>
  
  <option value="الروضة">الروضة</option>
  
  <option value="الشهداء">الشهداء</option>
  
  <option value="الفلاح">الفلاح</option>
 <option value="النسيم">النسيم</option>
  
  <option value="قرطبة">قرطبة</option> 
  <option value="أشبيلية">أشبيلية</option>
  
  <option value="الرواد">الرواد</option> 
  
  <option value="الربوه">الربوه</option>
  
  <option value="الجزيرة">الجزيرة</option>
 <option value="اليرموك">اليرموك</option>
  
  <option value="الخليج">الخليج</option> 
  
  <option value="النهضة">النهضة</option>
  
  <option value="السلي">السلي</option>
  
  <option value="الملز">الملز</option>
  
  <option value="الديره">الديره</option>          
  
   <option value="المرقب">المرقب</option>
  
  <option value="البطحاء">البطحاء</option> 
  <option value="الفاخرية">الفاخرية</option>
  
  <option value="المربع">المربع</option> 
  
  <option value="الصالحية">الصالحية</option>
  
  <option value="المونسية">المونسية</option>
 <option value="طويق">طويق</option>
  
  <option value="الرمال">الرمال</option> 
  
  <option value="العارض">العارض</option>
  
  <option value="اليرموك">اليرموك</option>
  
  <option value="السلام">السلام</option>
  
  <option value="الياسمين">الياسمين</option>
  
 
  
   <option value="الرائد">الرائد</option>
  
  <option value="العليا">العليا</option> 
  <option value="الفلاح">الفلاح</option>
  
  <option value="التعاون">التعاون</option> 
  
  <option value="الخزامي">الخزامي</option>
  
  <option value="منفوحة">منفوحة</option>
 <option value="النزهة">النزهة</option>
  
  <option value="الواحة">الواحة</option> 
  
  <option value="النظيم">النظيم</option>
  
  <option value="الوادي">الوادي</option>
  
  <option value="الملك فهد">الملك فهد</option>
  
  <option value="الملك فيصل">الملك فيصل</option>

<option value="الخالدية">الخالدية</option>
  
  <option value="السليمانية">السليمانية</option> 
  <option value="حطين">حطين</option>
  
  <option value="أم سليم">أم سليم</option> 
  
  <option value="المصيف">المصيف</option>
  
  <option value="الطريف">الطريف</option>
 <option value="صلاح الدين">صلاح الدين</option>
  
  
         </select>
          </div>
    <script type="text/javascript">
  document.getElementById('address').value = "<?php echo $row['address'];?>";
</script>
            <?php }?>
             <?php 
       $email=@$_GET['email'];
  $sql="SELECT * FROM qualification where Vemail_address='$email'";
          $result = mysqli_query( $connection, $sql);
  // output data of  row
  while($row = mysqli_fetch_assoc($result)) {?>
     <div class="input-box">
  <span class="details" dir="rtl">اسم التخصص</span>
  <select name="specialization" id="sp"  dir="rtl"  required="required">
  <option value="الطب البشري">الطب البشري</option>
  <option value="الطب الاسنان">الطب الاسنان</option>
  <option value="الصيدلة">الصيدلة</option>
  <option value="الرياضيات">الرياضيات</option>
  <option value="الكيمياء">الكيمياء</option>
  <option value="الفيزياء">الفيزياء</option>
  <option value="علم النفس">علم النفس</option>
  <option value="اللغات والترجمة (اللغة الانجليزية)">اللغات والترجمة (اللغة الانجليزية)</option>
  <option value="اللغات والترجمة (اللغة الفرنسية)">اللغات والترجمة (اللغة الفرنسية)</option>       
  <option value="الهندسة">الهندسة</option>
  <option value="العمارة والتخطيط">العمارة والتخيط</option>
  <option value="العلوم الطبيعية التطبيقية">العلوم الطبيعية التطبيقية</option>
  <option value="التمريض">التمريض</option>
  <option value="علوم الحاسب والمعلومات">علوم الحاسب والمعلومات</option>
  <option value="إدارة الأعمال">إدارة الأعمال</option>
  <option value="علوم الأغذية والزراعة">علوم الأغذية والزراعة</option>
  <option value="التربية">التربية</option>
  <option value="رياض الأطفال">رياض الأطفال</option>
  <option value="الآداب">الآداب</option>
  <option value="علم الاجتماع">علم الاجتماع</option>
  <option value="الخدمة الاجتماعية">الخدمة الاجتماعية</option>
  <option value="برمجيات">برمجيات</option>
  <option value="التصميم الجرافيكي">التصميم الجرافيكي</option>
  <option value="التصميم الداخلي">التصميم الداخلي</option>
  <option value="تصميم الأزياء">تصميم الأزياء</option>
  <option value="التربية الخاصة">التربية الخاصة</option>
  <option value="ثقافة اسلامية">ثقافة اسلامية</option>
  <option value="سياحة وآثار">سياحة وآثار</option>
  <option value="محاسبة">محاسبة</option>
  <option value="نظم المعلومات">نظم المعلومات</option>
  <option value="الأحياء">الأحياء</option>
  <option value="العلوم">العلوم</option>
  <option value="حقوق والعلوم السياسية">حقوق والعلوم السياسية</option>
  <option value="التربية البدنية والرياضة">التربية البدنية والرياضة</option>
  <option value="الهندسة الصناعية والالكترونيات">الهندسة الصناعية والالكترونيات</option>
  <option value="الموارد البشرية">الموارد البشرية</option>
  <option value="العلاقات العامة">العلاقات العامة</option>
  <option value="الاعلام">الاعلام</option>

         </select>
          </div>
 <script type="text/javascript">
  document.getElementById('sp').value = "<?php echo $row['qualifications'];?>";
</script>
            <?php }?>
            
          
            
           
      

        
          <div dir="rtl" style="margin-left: 200px; white-space: nowrap;">
            <span class="details" dir="rtl">ماذا تفضل؟ </span><br>
                <?php 
  $sql="SELECT * FROM preference where Vemail_address='$email'";
          $result = mysqli_query( $connection, $sql);
  // output data of  row
  while($row = mysqli_fetch_assoc($result)) {
             $preference[] = $row['Preferences'];?>
         <?php }

                    ?>
            
             <input  type="checkbox"  name="preference1" <?=(in_array('العمل بدون تواصل مع المستفيدين', $preference))?'checked="checked"':'' ?> value="العمل بدون تواصل مع المستفيدين"><span class="skill" >العمل بدون تواصل مع المستفيدين</span><br>
            <input  type="checkbox"  name="preference2"<?=(in_array('أفضل التعامل مع كبار السن', $preference))? 'checked="checked"':''?>  value="أفضل التعامل مع كبار السن"><span class="skill" >أفضل التعامل مع كبار السن</span><br>
            <input  type="checkbox" name="preference3"<?=(in_array('أفضل التعامل مع الأطفال', $preference))? 'checked="checked"':'' ?> value="أفضل التعامل مع الأطفال"><span class="skill" >   أفضل التعامل مع الأطفال </span><br>
            <input  type="checkbox" name="preference4" <?=(in_array('أفضل التعامل مع ذوي الاحتياجات الخاصة', $preference))? 'checked="checked"':'' ?> value="أفضل التعامل مع ذوي الاحتياجات الخاصة"><span class="skill" > أفضل التعامل مع ذوي الاحتياجات الخاصة </span><br>
                   </div>

            <div dir="rtl"  >
        <span dir="rtl" >المهارات</span><br>
                <?php 
  $sql="SELECT * FROM skill where Vemail_address='$email'";
          $result = mysqli_query( $connection, $sql);
  // output data of  row
  while($row = mysqli_fetch_assoc($result)) {
             $skills[] = $row['skills'];?>
         <?php }

                    ?>
          <input  type="checkbox" name="s1" value="استخدام الحاسب الآلي" <?=(in_array('استخدام الحاسب الآلي', $skills))? 'checked':'' ?> ><span class="skill" >استخدام الحاسب الآلي</span><br>
        <input  type="checkbox"  name="s2" value="العمل الجماعي" <?=(in_array('العمل الجماعي', $skills))? 'checked':'' ?> ><span class="skill" >العمل الجماعي</span><br>
          <input type="checkbox"name="s3" value="امكانية العمل تحت الضغط" <?=(in_array('امكانية العمل تحت الضغط', $skills))? 'checked':'' ?>><span class="skill" >امكانية العمل تحت الضغط</span><br>
            <input type="text" name="s4"  class="skills"  value="<?=$row['skill_other']?>" id="skills" placeholder="مهارات أخرى"  dir="rtl">

        </div>
            
      
        </div>
        <input type="hidden" name="id" value="<?=$row['id']?>">

            <input type="submit" name="edit" id="SubmitButtun" value="تعديل" class="fbutton">
            <a href="javascript:history.go(-1)" class="Bbutton">الغاء </a>
      </form>
      <?php }?>
        <script>
  
var count=0;
document.getElementById("SubmitButtun").disabled=true;

function ValidateEmail() {
  var email = document.getElementById("email").value;
   const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
   if (!email.match(re)){
       document.getElementById("er").innerHTML="فضلا قم بكتابة البريد الإلكتروني بشكل صحيح";
        document.getElementById("email").style.borderColor="red";
         count++;
   }else{
      document.getElementById("er").innerHTML="";
      document.getElementById("email").style.borderColor="#9b59b6";
      count--;
   }

}
 function ValidatePhone() {
var regex="^05[0-9]{8}$";
var phone = document.getElementById("phone").value;
if (!phone.match(regex)){
       document.getElementById("er5").innerHTML="ادخل رقم الهاتف بالشكل الصحيح";
        document.getElementById("phone").style.borderColor="red";
        count++;
   }else{
      document.getElementById("er5").innerHTML="";
      document.getElementById("phone").style.borderColor="#9b59b6";
      count--;
   }

}
function ValidateName() {
var regex="^[\u0621-\u064A\040]+$";
var reg="[\u0600-\u06FF]";
 var format = /[ `!@#$%^&*()_+\-=\[\]{};'":\\|,.<>\/?~]/;
var fname = document.getElementById("fname").value;
var lname = document.getElementById("lname").value;
var address = document.getElementById("address").value;
var sp = document.getElementById("sp").value;
 if (fname.match(format)){
         document.getElementById("er6").innerHTML="فضلا ، ادخل اسم بلا علامات خاصة";
          document.getElementById("fname").style.borderColor="red";
        count++;
     }else if(!fname.match(format)&&fname.match(regex)){
        document.getElementById("er6").innerHTML="";
        document.getElementById("fname").style.borderColor="#9b59b6";
        count--;
       
     }
        else if (!fname.match(regex)){
                 document.getElementById("er6").innerHTML="فضلا ، ادخل اسم باللغة العربية";
                  document.getElementById("fname").style.borderColor="red";
                count++;
             }else{
                document.getElementById("er6").innerHTML="";
                document.getElementById("fname").style.borderColor="#9b59b6";
                count--;
             }
     if (lname.match(format)){
         document.getElementById("er7").innerHTML="فضلا ، ادخل اسم بلا علامات خاصة";
          document.getElementById("lname").style.borderColor="red";
        count++;
     }else if(!lname.match(format)&&lname.match(regex)){
        document.getElementById("er7").innerHTML="";
        document.getElementById("lname").style.borderColor="#9b59b6";
        count--;
       
     }
        else if (!lname.match(regex)){
                document.getElementById("er7").innerHTML="فضلا ، ادخل اسم باللغة العربية";
                  document.getElementById("lname").style.borderColor="red";
                  count++;
             }else{
                document.getElementById("er7").innerHTML="";
                document.getElementById("lname").style.borderColor="#9b59b6";
                 count--;
             }
}

function my(){
  er6=document.getElementById("fname").style.borderColor;
  er7=document.getElementById("lname").style.borderColor;
   er=document.getElementById("email").style.borderColor;
       er5=document.getElementById("phone").style.borderColor;
   if(!(er=="red" ||er5=="red" ||er7=="red" ||er6=="red")){
      document.getElementById("SubmitButtun").disabled=false;
   } else{
        document.getElementById("SubmitButtun").disabled=true;
   }
}      
        </script>
      <?php
      //if edit button clicked

if(isset($_POST['edit'])){
  //get form data 
 $email_address= $_POST['email_address'];
  $first_name=$_POST['first_name'];
  $last_name=$_POST['last_name'];
  $gender=$_POST['gender'];
  $phone_number=$_POST['phone_number'];
  $address=$_POST['address'];
  $id=$_POST['id'];
  $educational_level=$_POST['educational_level'];
  $dateOfBirth=$_POST['dateOfBirth'];
  $skill_other=$_POST['skill_other'];
  $skills=$_POST['skill'];
  $skill_value="";  
  $speciality=$_POST['speciality'];
  foreach($skills as $skill)  
     {  
        $skill_value .= $skill.",";  
     } 
  $preferences=$_POST['preference'];  
$preference_value="";  
foreach($preferences as $preference)  
   {  
      $preference_value .= $preference.",";  
   } 
   //update volunteer data

   $sql_update ="UPDATE `volunteer` SET `email_address`='$email_address',
                                    `first_name`='$first_name',
                                    `last_name`='$last_name',
                                    `gender`='$gender',
                                    `phone_number`='$phone_number',
                                    `address`='$address',
                                    `educational_level`='$educational_level',
                                    `dateOfBirth`='$dateOfBirth'
                                     WHERE `email_address`='$email_address'";
echo "<br>";
$query_update = mysqli_query( $connection, $sql_update);
 
if(mysqli_affected_rows($connection) >0){

              if (isset($_POST['preference1'])){ $preference1 = $_POST['preference1'];
    $query2="INSERT INTO `preference`(`Preferences`, `Vemail_address`) VALUES ('$preference1','$email_address') ON DUPLICATE key
  UPDATE  `Preferences`='$preference1'";
     $results2 = mysqli_query($connection, $query2);
   }
    if (isset($_POST['preference2'])){ $preference2 = $_POST['preference2'];
     $query3="INSERT INTO `preference`(`Preferences`, `Vemail_address`) VALUES ('$preference2','$email_address')  ON DUPLICATE key
  UPDATE  `Preferences`='$preference2'";
     $results3 = mysqli_query($connection, $query3);
   }
   if (isset($_POST['preference3'])){ $preference3 = $_POST['preference3'];
    $query4="INSERT INTO `preference`(`Preferences`, `Vemail_address`) VALUES ('$preference3','$email_address')  ON DUPLICATE key
  UPDATE  `Preferences`='$preference3'";
     $results4 = mysqli_query($connection, $query4);
   }
    if (isset($_POST['preference4'])){ $preference4 = $_POST['preference4'];
     $query5="INSERT INTO `preference`(`Preferences`, `Vemail_address`) VALUES ('$preference4','$email_address')  ON DUPLICATE key
  UPDATE  `Preferences`='$preference4'";
     $results5 = mysqli_query($connection, $query5);
    }
  if (isset($_POST['s1'])){ $skill1 = $_POST['s1'];
    $query6="INSERT INTO `skill`(`skills`, `Vemail_address`) VALUES ('$skill1','$email_address') ON DUPLICATE key
  UPDATE  `skills`='$skill1'";
     $results6 = mysqli_query($connection, $query6);
   }
    if (isset($_POST['s2'])){ $skill2 = $_POST['s2'];
    $query7="INSERT INTO `skill`(`skills`, `Vemail_address`) VALUES ('$skill2','$email_address') ON DUPLICATE key
  UPDATE  `skills`='$skill2'";
     $results7 = mysqli_query($connection, $query7);
   }
    if (isset($_POST['s3'])){ $skill3 = $_POST['s3'];
    $query8="INSERT INTO `skill`(`skills`, `Vemail_address`) VALUES ('$skill3','$email_address') ON DUPLICATE key
  UPDATE  `skills`='$skill3'";
     $results8 = mysqli_query($connection, $query8);
   }
    if (isset($_POST['s4'])&& $_POST['s4'] != ""){ $skill4 = $_POST['s4'];
    $query9="INSERT INTO `skill`(`skills`, `Vemail_address`) VALUES ('$skill4','$email_address') ON DUPLICATE key
  UPDATE  `skills`='$skill4'";
     $results9 = mysqli_query($connection, $query9);
   }
 if (isset($_POST['specialization'])){ $specialization = $_POST['specialization'];
    $query10="UPDATE `qualification` SET `qualifications`='$specialization' WHERE `Vemail_address`='$email_address' ";
     $results10 = mysqli_query($connection, $query10);
   }
  echo "<script>
           
                Swal.fire({
                     icon: 'success',
                     title: 'تم تعديل بيانات المتطوع',
                     text: '',
                     showConfirmButton: true,
                     confirmButtonText:'إغلاق ',
                     closeOnConfirm: false

                     }).then((result) => {
                        javascript:history.go(-1)
                         })

                 </script>";

}else{
   echo  "<p style='text-align: right; color:red; margin-top:120px;'>"."نعتذر ،حدث خطأ"."</p>";  
}

}?>
    </div>
  </div>

         
</body>

    <element dir="ltr">
      <?php require 'layout/footer.php'; 
?>
    </body>
</html>
