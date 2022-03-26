<?php

                   session_start();  
      define('Server', "localhost:8889");
        define('user', "root");
        define('pass', "root");
       define('Database', "taj3");
        $connection = mysqli_connect(Server, user, pass, Database);
        
        //handle the error
        if (mysqli_connect_error() != null) {
            die(mysqli_connect_error());
        }
        
$id = 11;
$cURLConnection = curl_init();

curl_setopt($cURLConnection, CURLOPT_URL, 'http://127.0.0.1:5000/api/result1');
curl_setopt($cURLConnection,CURLOPT_POSTFIELDS, $id);
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, TRUE);

$resultList = curl_exec($cURLConnection);
curl_close($cURLConnection);

$result = json_decode($resultList,TRUE);
var_dump($result);

        