<?php

                   session_start();  
      define('Server', "localhost:3306");
        define('user', "root");
        define('pass', "Naruto12@");
       define('Database', "taj");
        $connection = mysqli_connect(Server, user, pass, Database);
$connection->set_charset("utf8");
mysqli_set_charset($connection,'utf8');        
        //handle the error
        if (mysqli_connect_error() != null) {
            die(mysqli_connect_error());
        }
        


      







