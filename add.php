<?php require 'layout/header.php'; ?>

<html>
    <head>
      
    <meta charset="UTF-8">
    <title class="reg">إضافة الأعضاء</title>
    <link rel="stylesheet" href="css/n.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <header class="header">
       
       
       
   </header>
    <body class="reg">
        <div class="container">
    <div class="title" dir="rtl">إضافة الأعضاء</div>
    <div class="content">
      <form action="#">
        <div class="user-details">
          <div class="input-box">
            <span class="details" dir="rtl">الاسم</span>
            <input type="text" placeholder="ادخل الاسم الكامل" dir="rtl">
          </div>
          <div class="input-box">
            <span class="details" dir="rtl">اسم المستخدم</span>
            <input type="text" placeholder="ادخل اسم المستخدم" dir="rtl">
          </div>
            <div class="input-box">
            <span class="details" dir="rtl">كلمة السر</span>
            <input type="text" placeholder="ادخل كلمة السر" dir="rtl">
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
            <span class="details" dir="rtl">العنوان</span>
            <input type="text" placeholder="ادخل العنوان"  dir="rtl">
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
           
        </div>
       
        <div class="button">
          <input type="submit" value="إضافة">
        </div>
      </form>
    </div>
  </div>

        
</body>

</html>
        
        </main>
</html>