<?php 
session_start();
//connect to the header.php page and to config.php page
//connect to the AdminHeader.php page and to config.php page
if($_SESSION['logged_in']===true && $_SESSION['type'] ==='member' && $_SESSION['id'] ==1){
    require 'layout/AdminHeader.php'; 
 }
 elseif($_SESSION['logged_in']===true && $_SESSION['type'] ==='member' && $_SESSION['id'] !=1){
    require 'layout/loggedHeader.php'; 
 }elseif($_SESSION['logged_in']===true && $_SESSION['type'] ==='volunteer'){
   require'layout/loggedHeader.php';
 }else{
  require'layout/header.php';   
 }
 require 'config.php';
  // change title name
echo "<script> document.title='الأرشيف' </script>";
?>
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
<?php //}?>

<div class="row">

<?php
  
 $strtdate=$_POST['start_date'];
 $enddate=$_POST['end_date'];
 
 $currentdate = date("Y-m-d");


  // check if the program is finished to show it in the page

$sql="SELECT * FROM `program` WHERE end_date < '$currentdate' ";
$result=mysqli_query($connection,$sql);
while($row=mysqli_fetch_assoc($result)):

?>
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
     
<?php if($_SESSION['logged_in']&& $_SESSION['type']==="member"){?>
    <button class="detailss" onclick="go('memberrate.php?id=<?=$row['id']?> &date=<?=$row['end_date']?>')">تقييم المتطوعين</button>
     
      <?php }?>
      <button class="detailss" onclick="go('archiveDetails.php?id=<?=$row['id']?>')">التفاصيل</button>

</div>
  <div class="panel-footer"> من <?=$row['start_date'] ?> الي <?=$row['end_date']?></div>
</div>

</div>

<?php endwhile;?>






</div>





</div>
    
    <element dir="ltr">
      <?php require 'layout/footer.php';
?>
<script type="text/javascript">
function go(web){
  window.location = web;



}


</script>

