<?php
    require 'core.php';
    require 'connection.php';
 if(isset($_GET['varname'])){     
$contentId = $_GET['varname'];
 }
//if(isset($_POST['Delete'])){
 $query = "Update content set Reports = Reports + 1 where id=".$contentId;
if($content_query_run = mysqli_query($con,$query)){
    header("Location:index.php");
}  
//}
    ?>