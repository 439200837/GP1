   <?php
session_start();
$name=$_SESSION['name'];
$id=$_SESSION['id'];
$email=$_SESSION['email'];

 ?> 
<html>
    
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>header</title>
        <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"> </script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"> </script>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="css/style.css?<?php echo time(); ?>"> 
       <script type="text/javascript" src="//js/script.js" async></script>
   </head>
<body> 
<!-- Navigation Block -->   
<div class="bloc l-bloc" id="nav-bloc">
	<div class="container">
		<nav class="navbar row">
			 <div class="navbar-h">
				<a class="navbar-brand" id="logo" href="#"><img src="layout/812381_305489.png" alt="logo"" ></a>
                                <button id="nav-toggle" type="button" class="ui-navbar-toggle navbar-toggle" data-toggle="collapse" data-target=".navbar-1" >
					<span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse navbar-1">
                            <ul class="site-navigation nav" id="myLinks">
                                    
					
					</li>
                                <li id="top">
						<a href="board.php">لوحة التحكم</a>
					</li>
                                         <li>
						<a href="Archive.php">الأرشيف</a>
					</li>
					<li>
						<a href="programs.php">برامجنا</a>
					</li>
					<li>
						<a href="about.php">من نحن</a>
					</li>
                                        <li>
						<a href="home.php">الرئيسة</a>
					</li>
                                          <li id="SO">
						<a href="#">تسجيل خروج</a>
					</li>
				
                                        
					
          </ul>
                            
			</div>
                            <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-caret-down" aria-hidden="true"></i><a> أهلا
    <?php echo $name;?> </a>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
      <element dir="rtl">
          <a href="edit.php?id=<?php echo $id;?>&email=<?php echo $email;?>"><button class="dropdown-item"  type="button">تعديل معلومات الحساب </button></a>
    <button class="dropdown-item"  type="button">الحساب</button>
  </div>
</div> 
                    
                    
                    
                   <a href="logOut.php"> <button id='logout' type="submit">تسجيل خروج
                       <span class="glyphicon glyphicon-log-out" style="margin-left: 3px;"></span>
                   </button></a>
                    <!-- comment  <p>المستخدم</p>-->
                
                   
		</nav>
                
                </div>
</div>

