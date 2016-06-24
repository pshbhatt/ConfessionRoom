<?php

ob_start();
session_start();

//$currentFile = $_SERVER['SCRIPT_NAME'];
//$http_referer = $_SERVER['HTTP_REFERER']; 
 if(isset($_SESSION['userId'])&& isset($_SESSION['username'])){
$globalUserId = $_SESSION['userId'];
$globalUserName = $_SESSION['username'];
 }

function isAdmin(){
if(isset($_SESSION['username'])&& !empty($_SESSION['username'])){
   if($_SESSION['username']=='admin'){
       return true;
   } else {
       return false;
   }
}
}

function loggedIn(){
    if(isset($_SESSION['userId'])&& !empty($_SESSION['userId'])){
    return true;
    } else {
        return false;
    }
}

function getUserData($field){
    require 'connection.php';
    $query="SELECT ".$field." from users where id='".$_SESSION['userId']."'";
    if($query_run=mysqli_query($con,$query)){
        if($row=$query_run->fetch_assoc()){
                   return $row[$field];
                    
                }
             } 
    }
function getUserId($userName){
     require 'connection.php';
    $query="SELECT id from users where username='".$userName."'";
    if($query_run=mysqli_query($con,$query)){
        if($row=$query_run->fetch_assoc()){
                   return $row[$field];
                    
                }
             } 
}

function getUserContent($field){
    require 'connection.php';
    $query="SELECT ".$field." from content where id='".$_SESSION['userId']."'";
    if($query_run=mysqli_query($con,$query)){
        if($row=$query_run->fetch_assoc()){
                   return $row[$field];
                    
                }
             } 
    }


?>