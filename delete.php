<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require 'config.php';
        $memberId= $_GET['id'];
       
        echo $r;
       $sql="DELETE FROM member WHERE id=$memberId";
          $result = mysqli_query( $connection, $sql);

          header("location:board.php");
