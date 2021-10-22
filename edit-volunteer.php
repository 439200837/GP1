<?php require 'layout/header.php'; ?>
<element dir="rtl">
<html>
    <head>
      
    <meta charset="UTF-8">
    <title class="reg">تعديل معلومات المتطوعين</title>
    <link rel="stylesheet" href="css/n.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <header class="header">
       
       
       
   </header>
    <body class="reg">
        <div class="container5">
    <div class="title" dir="rtl">تعديل معلومات المتطوعين</div>
    <div class="content">
      <form action="#">
        <div class="user-details">
              <div class="input-box">
            <span class="details" dir="rtl">الأسم الاول</span>
            <input type="text" placeholder="ادخل الاسم الاول" dir="rtl">
          </div>
         <div class="input-box">
            <span class="details" dir="rtl">الأسم الثاني</span>
            <input type="text" placeholder="ادخل الاسم الثاني" dir="rtl">
          </div>
          
          <div class="input-box">
            <span class="details" dir="rtl">البريد الإلكتروني</span>
            <input type="email" placeholder="ادخل البريد الإلكتروني" dir="rtl">
          </div>
             <div class="input-box">
            <span class="details" dir="rtl">رقم الهاتف</span>
            <input type="tel" placeholder="ادخل رقم الهاتف" dir="rtl">
          </div>
            
             <div class="input-box">
            <span class="details" dir="rtl">تاريخ الميلاد</span>
            <input type="date" name="birth" id="birth" placeholder="تاريخ الميلاد"  dir="rtl">
          </div>
            
               <div class="gender-details" dir="rtl">
          <input type="radio" name="gender" id="dot-1">
          <input type="radio" name="gender" id="dot-2">
   
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
         <select name="edu" id="edu"  dir="rtl" >
  <option value="g1">تعليم إبتدائي</option>
  <option value="g2">تعليم متوسط</option>
  <option value="g3">تعليم ثانوي</option>
  <option value="college">درجة بكالوريس</option>
   <option value="college">درجة الماجستير</option>
    <option value="college">دكتوراه</option>
     <option value="college">دبلوم</option>
      <option value="college">شهادة التأهيل المهني</option>
            </select>
          </div>
              <div class="input-box">
            <span class="details" dir="rtl">اسم التخصص</span>
            <input type="text" placeholder="ادخل اسم التخصص"  dir="rtl">
          </div>
            
              <div class="input-box">
            <span class="details" dir="rtl">ماذا تفضل؟</span>
         <select name="pref" id="pref" required dir="rtl" >
  <option value="direct">العمل مباشرة مع المستفيدين</option>
  <option value="undirect">العمل بدون تواصل مع المستفيدين</option>
  <option value="old">أفضل التعامل مع كبار السن</option>
  <option value="children">أفضل التعامل مع الأطفال</option>
   <option value="handdicaped">أفضل التعامل مع ذوي الاحتياجات الخاصة</option>
   
            </select>
          </div>
            
          
            
            <div class="input-box">
            <span class="details" dir="rtl">العنوان</span>
            <input type="text" placeholder="ادخل العنوان"  dir="rtl">
          </div>
            
            <div dir="rtl" >
      
        <span dir="rtl" >المهارات</span><br>
      <input  type="checkbox" id="s1" name="s1" ><span class="skill" >استخدام الحاسب الآلي</span><br>
     <input  type="checkbox" id="s2" name="s2" ><span class="skill" >العمل الجماعي</span><br>
      <input type="checkbox" id="s3" name="s3" ><span class="skill" >امكانية العمل تحت الضغط</span><br>
            <input type="text" class="skills" id="skills" placeholder="مهارات أخرى"  dir="rtl">

        </div>
            
      
        </div>
       
            <input type="submit" value="تعديل" class="fbutton">
           <input type="button" value="إلغاء" class="Bbutton">
      </form>
    </div>
  </div>

         
</body>

    <element dir="ltr">
      <?php require 'layout/footer.php'; 
?>
    </body>
</html>