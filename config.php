<?php

                   session_start();  
      define('Server', "localhost:8889");
        define('user', "root");
        define('pass', "root");
       define('Database', "Taj");
        $connection = mysqli_connect(Server, user, pass, Database);
        
        //handle the error
        if (mysqli_connect_error() != null) {
            die(mysqli_connect_error());
        }