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
echo "<script> document.title='برامجنا' </script>";
?>
<element dir="rtl">
<div class="containerP">


<?php if($_SESSION['logged_in']&& $_SESSION['type']==="member"){?>

<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-body center-block text-center" >

<button class="detailss" onclick="go('AddProgram.php')">إضافه برنامج</button>

</div>
</div>
 </div>
</div>
<?php }?>

<div class="row">

<?php
$sql="SELECT * FROM `program`";
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
      <?php if($_SESSION['logged_in']&&$_SESSION['type']==="member"){?>
      <button class="detailss" onclick="go('EditProgram.php?id=<?=$row['id']?>')">تعديل</button>
      <?php }
       else{?>
      <button class="detailss">انضم إلينا </button>
      <?php }?>

      <button class="detailss" onclick="go('detalis.php?id=<?=$row['id']?>')">التفاصيل</button>

</div>
  <div class="panel-footer"> من <?=$row['start_date'] ?> الي <?=$row['end_date']?></div>
</div>

</div>

<?php endwhile;?>






</div>





</div>

<script type="text/javascript">
function go(web){
  window.location = web;



}


</script>

