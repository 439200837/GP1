<?php 
session_start();
//connect to the header.php page and to config.php page
//connect to the AdminHeader.php page and to config.php page
if($_SESSION['logged_in']===true && $_SESSION['type'] ==='admin'){
    require 'layout/AdminHeader.php'; 
 }
 elseif($_SESSION['logged_in']===true && $_SESSION['type'] ==='member'){
    require 'layout/loggedHeader.php'; 
 }elseif($_SESSION['logged_in']===true && $_SESSION['type'] ==='volunteer'){
   require'layout/loggedHeader.php';
 }else{
  require'layout/header.php';   
 }
 // change title name
echo "<script> document.title='الرئيسة' </script>";
 require 'config.php';
?>
<element dir="rtl">
<!-- Carousel -->
<div class="containerH" style="background-color: #f4f3ef;">
  <div class="row">
    <!-- Carousel -->
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      </ol>
      <!-- Wrapper for slides -->
      <div class="carousel-inner">
          <div class="item active">
              <img src="layout/1.png" alt="First slide">
                    <!-- Static Header -->
                    <div class="header-text">
                        <div class="col-md-12 text-center">
                            <h2>
                              <span>من نحن</span>
                            </h2>
                            <br>
                            <div>
                                <a class="btn btn-theme btn-sm btn-min-block" href="about.php">إقرأ المزيد</a></div>
                        </div>
                    </div><!-- /header-text -->
          </div>
          <div class="item">
              <img src="layout/2.png" alt="Second slide">
            <!-- Static Header -->
                    <div class="header-text hidden-xs">
                        <div class="col-md-12 text-center">
                            <h2>
                                <span>من نحن</span>
                            </h2>
                            <br>
                            <div>
                                <a class="btn btn-theme btn-sm btn-min-block" href="about.php">إقرأ المزيد</a></div>
                        </div>
                    </div><!-- /header-text -->
          </div>
          <div class="item">
              <img src="layout/3.png" alt="Third slide">
            <!-- Static Header -->
                    <div class="header-text hidden-xs">
                        <div class="col-md-12 text-center">
                            <h2>
                                <span>من نحن</span>
                            </h2>
                            <br>
                            <div>
                              <a class="btn btn-theme btn-sm btn-min-block" href="about.php">إقرأ المزيد</a></div>
                        </div>
                    </div><!-- /header-text -->
          </div>
      </div>
      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
      </a>
    </div><!-- Carousel END -->
  </div>
</div>

<!-- Posts -->
<div class="main-content" style="background-color: #f4f3ef;">
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid" style="margin-top: 10px;">
        <h2 class="mb-5 text-white">عن المبادرات</h2>
        <br>
        <div class="header-body">
            <div class="col-xl-3 col-lg-6"  style="display: flex; flex-direction:row; justify-content: space-between; width:100%; padding: 10px;">
                <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                      <div class="row" style="margin: 10px;">
                    <div class="col">
                      <h5 class="card-title text-muted mb-0">المتطوعين</h5>
                      <span class="text-success mr-2"><i class="fa fa-user" style="font-size: 35px;"></i></span>
                      <span class="h2 font-weight-bold mb-0">10,000</span>
                    </div>
                  
                  </div>
              
                </div>
             
        </div>
                  <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                      <div class="row" style="margin: 10px;">
                    <div class="col">
                      <h5 class="card-title text-muted mb-0">المستفيدين</h5>
                      <span class="text-success mr-2"><i class="fa fa-home" style="font-size: 35px;"></i></span>
                      <span class="h2 font-weight-bold mb-0">10,000</span>
                    </div>
                  
                  </div>
              
                </div>
             
        </div>
                       <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                      <div class="row" style="margin: 10px;">
                    <div class="col">
                      <h5 class="card-title text-muted mb-0">البرامج</h5>
                      <span class="text-success mr-2"><i class="fa fa-heart" style="font-size: 35px;"></i></span>
                      <span class="h2 font-weight-bold mb-0">100</span>
                    </div>
                  
                  </div>
              
                </div>
             
        </div>
            </div>
              </div>
      </div>
      </div>
    <!-- Page content -->
  </div>
<style>
    body{
        background-color: #f4f3ef;
    }
</style>
    <element dir="ltr">
      <?php require 'layout/footer.php';
?>
    </body>
</html>