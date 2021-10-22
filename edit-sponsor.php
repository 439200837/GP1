<?php require 'layout/header.php'; ?>
<element dir="rtl">
<html>
    <head>
      
    <meta charset="UTF-8">
    <title class="reg">تعديل معلومات الرعاة</title>
    <link rel="stylesheet" href="css/n.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <header class="header">
       
       
       
   </header>
    <body class="reg">
        <div class="container5">
    <div class="title" dir="rtl">تعديل معلومات الرعاة</div><br>
    <div class="content">
      <form action="#">
        <div class="user-details">
          <div class="input-box">
            <span class="details" dir="rtl">الاسم</span>
            <input type="text" placeholder="ادخل الاسم الكامل" dir="rtl">
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