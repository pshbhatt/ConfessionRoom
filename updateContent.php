<?php
require 'core.php';
require 'connection.php';
if(isset($_GET['varname'])){          
$mainString = $_GET['varname'];
$pieces = explode("*", $mainString);

$contentId =$pieces[0];
$globalUserName = $pieces[1];
$_SESSION['username'] = $pieces[1];
    $_SESSION['userId'] = $pieces[2];
    $globalUserId = $pieces[2];
}

$query = "SELECT * from content where id=".$contentId;
if($content_query_run = mysqli_query($con,$query)){
    if($row=$content_query_run->fetch_assoc()){
                    $anonymity= $row['Anonymity'];
                    $cont = $row['Content'];
                    $visibility= $row['Visibility'];
                    $categ = $row['Category'];
                }
}
$http_client_ip=$_SERVER['HTTP_CLIENT_IP'];
$http_x_forwarded_for = $_SERVER['HTTP_X_FORWARDED_FOR'];
$remote_address = $_SERVER['REMOTE_ADDR'];
if(!empty($http_client_ip)){
    $ip_address = $http_client_ip;
} else if(!empty($http_x_forwarded_for)){
    $ip_address=$http_x_forwarded_for;
} else {
    $ip_address = $remote_address;
}
if(isset($_POST['update'])){
 $ip_address = '0';
if(isset($_POST['visibility'])&& isset($_POST['postAs'])&& isset($_POST['cat'])&& isset($_POST['editor'])){
    $visibility = $_POST['visibility'];
    $postAs = $_POST['postAs'];
    $cat = $_POST['cat'];
    $content = $_POST['editor'];
    date_default_timezone_set('UTC');
    $today = date("m.d.y");
   $contentQuery="Update content set ipaddress = '$ip_address',Anonymity = '$postAs', Content= '$content', Visibility ='$visibility', Category='$cat',DatePosted = '$today' where id='$contentId'";
if($query_run = mysqli_query($con,$contentQuery)){
   
    header('Location:index.php');
     echo 'Content has been saved';
} else {
    echo 'Not saved';
}
   
}
}

if(isset($_POST['delete'])){
  $query = "Delete from content where id=".$contentId;
if($content_query_run = mysqli_query($con,$query)){
   header('Location:index.php');
}  
}

?>
<html lang="en">
    <title>
    Post Confession
    </title>
    <head>
    <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/javascript/bootstrap/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="/javascript/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript">
        
    function hideForm(){
        var form = document.getElementById('formId');
        form.style.display='none';
    }
         $(document).ready(function(){
        if("<?php echo $visibility ?>" == "Y"){
            $("#yesId").prop("checked", true);
        } else {
            $("#noId").prop("checked", true);
        }
        if("<?php echo $anonymity ?>" == "U"){
            $("#uId").prop("checked", true);
        } else {
            $("#aId").prop("checked", true);
        }
        if("<?php echo $categ ?>" == "Funny"){
            $('#cat option[value="Funny"]').attr('selected', true);
        } else if("<?php echo $categ ?>" == "Sexual"){
            $('#cat option[value="Sexual"]').attr('selected', true);
        } else if("<?php echo $categ ?>" == "Grim"){
            $('#cat option[value="Grim"]').attr('selected', true);
        } else if("<?php echo $categ ?>" == "Prank"){
            $('#cat option[value="Prank"]').attr('selected', true);
        } else if("<?php echo $categ ?>" == "Guilt"){
            $('#cat option[value="Guilt"]').attr('selected', true);
        } else {
            $('#cat option[value="Other"]').attr('selected', true);
        }
             
  });
    </script>
  </head>
<body background="/images/background.jpg">
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li><a href="wall.php?varname=<?php echo $_SESSION['userId']."*".$_SESSION['username'] ?>"><span class="glyphicon glyphicon-home"></span>Home</a></li>
      <li  class="active"><a href="profile.php?varname=<?php echo $_SESSION['userId']."*".$_SESSION['username'] ?>"><span class="glyphicon glyphicon-plus-sign">Post</a></li>
      <li><a href="userContent.php?varname=<?php echo $_SESSION['userId']."*".$_SESSION['username'] ?>"><span class="glyphicon glyphicon-lock">MyVault</a></li>  
    </ul>
      <ul class="nav navbar-nav navbar-right">
          <li> <a href="editProfile.php?varname=<?php echo $globalUserId.'*'.$globalUserName ?>">
          <span class="glyphicon glyphicon-user"></span>&nbsp;
              <?php echo $_SESSION['username'] ?></li></a>
      <li><a href = "logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
          
    </ul>
  </div>
</nav>
    <form id="formId" name="contentForm" action="" method="post">
     
        <label style="font-weight:bold;color:white;font-size:15px;">Visibility: </label><label style="font-weight:bold;color:red;font-size:20px;">* </label></br>
        <input type="radio" id="yesId" value="Y" name="visibility" > <label style="font-weight:bold;color:white;">Visibile to Everyone</label>
        <input type="radio" id="noId" value="N" name="visibility" > <label style="font-weight:bold;color:white;">For your secret vault</label></br>
        <label style="font-weight:bold;color:white;font-size:15px;">Post As: </label><label style="font-weight:bold;color:red;font-size:20px;">* </label></br>
        <input type="radio" id="aId" name="postAs" value="A" ><label style="font-weight:bold;color:white;">Anonymous</label>
  <input type="radio" id="uId" name="postAs" value="U"><label style="font-weight:bold;color:white;">Username</label></br>
        <label style="font-weight:bold;color:white;font-size:15px;">Category: </label><label style="font-weight:bold;color:red;font-size:20px;">* </label>
<div class="dropdown">        
<select name="cat" id="cat" value=<?php echo $categ ?> class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
    <option value="">--Select--</option>
    <option value="Funny">Funny</option>
  <option value="Sexual">Sexual</option>
  <option value="Grim">Grim</option>
  <option value="Prank">Prank</option>
  <option value="Guilt">Guilt</option>
  <option value="Other">Other</option>
</select>
    
</div>
        <script type="text/javascript" src="/javascript/ckeditor/ckeditor.js"></script>
        <textarea class="ckeditor" name="editor"><?php echo $cont?></textarea>
        <input type="submit" value="Update Confession" name="update"  class="btn-danger btn-lg" style="color:black;font-weight:bold;" onclick="hideForm();">
<input type="submit" value="Delete Confession" name="delete"  class="btn-danger btn-lg" style="color:black;font-weight:bold;">
        
    </form>
    </body>
</html>

