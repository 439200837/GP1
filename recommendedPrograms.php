<?php
session_start();
$id =$_SESSION['id'];
$numVolunteer=$_SESSION['numV'];
if($numVolunteer >0 ){
 $cURLConnection = curl_init();
curl_setopt($cURLConnection, CURLOPT_URL, 'http://34.207.2.27:5000/api/result1');
curl_setopt($cURLConnection,CURLOPT_POSTFIELDS, $id);
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, TRUE);

$resultList = curl_exec($cURLConnection);
curl_close($cURLConnection);
$resultP = json_decode($resultList,TRUE);
var_dump($resultP);

}else{
$cURLConnection = curl_init();
curl_setopt($cURLConnection, CURLOPT_URL, 'http://34.207.2.27:5001/api/result');
curl_setopt($cURLConnection,CURLOPT_POSTFIELDS, $id);
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, TRUE);

$resultList = curl_exec($cURLConnection);
curl_close($cURLConnection);

$resultP = json_decode($resultList,TRUE);
var_dump($resultP);
}

