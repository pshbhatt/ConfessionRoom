<?php
    require 'core.php';
    require 'connection.php';
 if(isset($_GET['varname'])){     
$contentId = $_GET['varname'];
 }
//if(isset($_POST['Delete'])){
   echo $query = "Delete from content where id=".$contentId;
if($content_query_run = mysqli_query($con,$query)){
   echo "2";
    header("Location:index.php");
}  
//}
    ?>