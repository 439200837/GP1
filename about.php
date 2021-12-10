<?php 
session_start();
//connect to the header and config (database connection) pages
 if($_SESSION['logged_in']===true && $_SESSION['id'] !=1){
     require 'layout/loggedHeader.php';
 }
 elseif($_SESSION['logged_in']===true && $_SESSION['type']==='member' && $_SESSION['id'] ==1 ){
     require 'layout/AdminHeader.php';
    
 }else{
     require 'layout/header.php'; 
 }
require 'config.php';  
// change title name
echo "<script> document.title='من نحن' </script>";
?>
<body>
<element dir="rtl">
    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto" style=" background-color: #F6FDF5;">
     <div class="card card0 border-0">
        <div class="row d-flex">
            
           <!-- seperating the pictures and the description in two columns -->
           
            <div class="col-lg-6">
                <div class="card2 card border-0 px-4 py-5" style="text-align: center;
vertical-align: middle;
line-height: 50px; margin-top: 150px; ">
                    <h1 style="color: #660066;">من نحن؟</h1>
                    
                    <p style="color: #660066;">نادي تاج التطوعي هو نادٍ تطوعي منظم، يهتم بنشر مفهوم العمل التطوعي وتقديم الخدمات التطوعية لجميع فئات المجتمع بأسلوب احترافي وخطط مدروسة وأهداف مستمدة من ديننا الحنيف ومتواكبة مع رؤية المملكة ٢٠٣٠ لتطوير مجال العمل التطوعي وتحقيق التنمية المستدامة

 
 </p>
                </div>
        </div>
               <div class="col-lg-6">
                <div class="card1 pb-5">
                    <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img src="layout/aboutt.png" class="image" style="width: 100%; height: auto;"> 
                        
                    
                    </div>
                </div>
            </div>
             
        </div>
    </div>
</div>

   <element dir="ltr">
      <?php 
      //connecting to the footer page
      require 'layout/footer.php';
?>
    </body>
</html>

