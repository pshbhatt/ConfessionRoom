<?php
$server_host='127.0.0.1';
$server_user='root';
$server_pass='';
    $my_db='confession';

if(!mysqli_connect($server_host,$server_user,$server_pass,$my_db)){
    die('Oops! this is embarassing.');
} 
   global $con;
$con =mysqli_connect($server_host,$server_user,$server_pass,$my_db);

?>