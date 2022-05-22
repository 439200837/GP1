<?php
session_start();
if($_SESSION['logged_in']===true && $_SESSION['type'] ==='volunteer'){
   require'layout/loggedHeader.php';
    require 'config.php';
  // change title name
echo "<script> document.title='برامجي السابقة' </script>";
 }else{
   echo 'sorry ! you are not athorize to access this page'; 
echo "<script>window.location.href='index.php'</script>";
 }

$sql="SELECT * FROM `enroll`,program,volunteer WHERE enroll.program_id=program.id AND enroll.volenteer_id=volunteer.id AND enroll.volenteer_id = '" . $_SESSION["id"] . "' AND enroll.status='انتهى' AND enroll.rate='تم تقييمه'";

$result=mysqli_query($connection,$sql);
if(mysqli_num_rows($result)===0){
   echo "<p style='text-align: right; color:black; margin-top:120px; font-weight: bold;'>"."لا توجد برامج سابقة مسجلة"."</p>";   
}
while($row=mysqli_fetch_assoc($result)){?>
<element dir="rtl">
<div class="containerP">




<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-body center-block text-center" >
<h3 style="color: #660066; float: right;">برامجنا السابقة</h3>
</div>
</div>
 </div>
</div>
 <div class="row">
 <div class="col-md-4">
<div class="panel panel-default">
<div class="panel-heading" >
    <div class="imgdiv center-block">
<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['picture']).'"alt:"program img" class="responsive"/>';?>
</div>
    </div>
  <div class="panel-body">
    <h2 class="programName"><?=$row['name']?></h2>
    <br>
    <form action="previousPrograms.php" method="POST">
        <a> <button class="detailss print" id="myDIV" name="download">إنشاء شهادة الحضور </button> </a>
        <input type="hidden" name="volenteer_name1" value="<?= $row['first_name'] ?>">
        <input type="hidden" name="volenteer_name2" value="<?= $row['last_name'] ?>">
        <input type="hidden" name="program_name" value="<?= $row['name'] ?>">
        <input type="hidden" name="enddate" value="<?= $row['end_date'] ?>">
        <input type="hidden" name="startdate" value="<?= $row['start_date'] ?>">
   </form>

<?php }
if(isset($_POST['download'])){
/*Using PHP GD Library to process images and creating dynamic certificates*/
/*Creating Certificate Dynamically*/
//Set the Content Type
header('Content-Disposition: Attachment;filename=image.png');
header('Content-Type: image/png');

// Create Image From Existing File
$jpg_image = imagecreatefrompng("C:\Users\kmb-m\Downloads\White and Navy Employee of the Month Award Certificate (1).png");

// Allocate A Color For The Text
$white =imagecolorallocate($jpg_image, 100, 0, 102);

// Set Path to Font File
$font_path = "alfont_com_arial-1.ttf";
$font_path1="times-new-roman.ttf";
 require('includes/I18N/Arabic.php'); 
    $Arabic = new I18N_Arabic('Glyphs'); 
   
    echo $text;
$name_text =$_POST['volenteer_name1']." ". $_POST['volenteer_name2'];
 $text = $Arabic->utf8Glyphs($name_text);
$programName= $_POST['program_name'];
$text1 = $Arabic->utf8Glyphs($programName);
$startdate = $_POST['startdate'];
$enddate =$_POST['enddate'];


//imagettftext($jpg_image,40, 0, 800, 500, $white, $font_path,$name_text);
//imagettftext($jpg_image,40, 0, 780, 500, $white, $font_path,$name_text2);

imagettftext($jpg_image, 33, 0, 965, 502, $white, $font_path, $text);
imagettftext($jpg_image, 33, 0, 1105, 635, $white, $font_path, $text1);

imagettftext($jpg_image, 33, 0, 1105, 768, $white, $font_path1, $startdate);
imagettftext($jpg_image, 33, 0, 780, 768, $white, $font_path1, $enddate);
// Send Image to Browser
ob_start();
//imagepng($jpg_image,'c.png');
imagepng($jpg_image,NULL,0,NULL);
 $imgData=ob_get_clean();
//echo '<img src="data:image/png;base64,'.imagepng($jpg_image,NULL,0,NULL);.'"alt:"program img" class="responsive"/>';
echo '<script>document.getElementById("myDIV").style.display = "none";</script>';
// Clear Memory
imagedestroy($jpg_image);
 echo'<a href="data:image/png;base64,'.base64_encode($imgData).'" download="certificate'.time().'.png"> <button class="detailss print"  name="download" media="print">اضغط للتحميل</button> </a>'      
. '</div>
</div>
</div> 
</div>';
}
 










?>


<a href="javascript:history.go(-1)" class="Bbutton" style="float:right;">العودة</a>
