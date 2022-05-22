  
<html>
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>header</title>
 <link rel="icon" href="layout/812381_305489.png" type="image/icon type">
        <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"> </script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"> </script>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="css/style.css?<?php echo time(); ?>"> 
      <script src="js/script.js"></script>
    </head>
 
<body> 
<!-- Navigation Block -->
  
<div class="bloc l-bloc" id="nav-bloc">
	<div class="container">
		<nav class="navbar row">
			<div class="navbar-h">
                            <a class="navbar-brand" id="logo" href="index.php"><img src="layout/812381_305489.png" alt="logo" style="margin-top: -28px ;"> </a>
				<button id="nav-toggle" type="button" class="ui-navbar-toggle navbar-toggle" data-toggle="collapse" data-target=".navbar-1">
					<span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse navbar-1">
				<ul class="site-navigation nav">
                                    <li id="firstt" class="nav-item">
						<a href="Archive.php">الأرشيف</a>
					</li>
                                    <li class="nav-item">
						<a href="programs.php">برامجنا</a>
					</li>
                                        
					<li class="nav-item">
						<a href="about.php">من نحن</a>
					</li>
					<li class="nav-item">
						<a href="index.php">الرئيسة</a>
					</li>
				 <li id="SU">
						<a href="signUpV.php">إنشاء حساب</a>
					</li>
                                         <li id="SI">
						<a href="log-in.php">تسجيل دخول</a>
					</li>
                                        
					
          </ul>
                            
			</div>
                    <a href="log-in.php" class="clickedButton" id='log' > تسجيل دخول</a>
              
            <div class="dropdown">
                <button id='log' class="btn btn-secondary dropdown-toggle clickedButton change" type="submit" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">إنشاء حساب</button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
      <element dir="rtl">
          <a href="signUpV.php" id="change1">  إنشاء حساب متطوع </a>
          <a href="sponsorSignUp.php" id="change2">  إنشاء حساب داعم </a>
         
  </div>
</div>
		</nav>
           
            
                </div>
</div> 
<!-- Navigation Block END -->

<script type="application/javascript">
//this jQuery function will change nav link font to "bold" when it clicked by the user
jQuery(function($) {
  var path = window.location.href; 
  // because the 'href' property of the DOM element is the absolute path
  $('ul li a').each(function() {
    if (this.href === path) {
      $(this).addClass('active');
    }
  });
});

//this jQuery function will change nav link font to "bold" when it clicked by the user
jQuery(function($) {
  var path = window.location.href; 
  // because the 'href' property of the DOM element is the absolute path
  $('#log').each(function() {
    if (this.href === path) {
      $(this).addClass('active2');
    }
  });
});

$( document ).ready(function() {
 
//this jQuery function will change nav link font to "bold" when it clicked by the user
jQuery(function($) {
  var path = window.location.href; 
  // because the 'href' property of the DOM element is the absolute path
  $('#change1').each(function() {
    if (this.href === path) {
      $('.change').addClass('active2');
    }
  });
});
   });
//this jQuery function will change nav link font to "bold" when it clicked by the user
jQuery(function($) {
  var path = window.location.href; 
  // because the 'href' property of the DOM element is the absolute path
  $('#change2').each(function() {
    if (this.href === path) {
      $('.change').addClass('active2');
    }
  });
});


</script>
