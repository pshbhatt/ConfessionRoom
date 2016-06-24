<?php
require 'core.php';
require 'connection.php';
$mainString = $_GET['varname'];
$pieces = explode("*", $mainString);
$_SESSION['userId']=$pieces[0];
$globalUserId =$pieces[0];
$globalUserName = $pieces[1];
$_SESSION['username'] = $pieces[1];
/*$http_client_ip=$_SERVER['HTTP_CLIENT_IP'];
$http_x_forwarded_for = $_SERVER['HTTP_X_FORWARDED_FOR'];
$remote_address = $_SERVER['REMOTE_ADDR'];
if(!empty($http_client_ip)){
    $ip_address = $http_client_ip;
} else if(!empty($http_x_forwarded_for)){
    $ip_address=$http_x_forwarded_for;
} else {
    $ip_address = $remote_address;
}*/

if(isset($_POST['cat']) && isset($_POST['editor1'])){
    
    if(!empty($_POST['visibility'])&& !empty($_POST['postAs'])&& !empty($_POST['cat'])){
        if(($_POST['editor1']!='<p>Write your confession here...</p>') && (!empty($_POST['editor1']))){
            
    $visibility = $_POST['visibility'];
    $postAs = $_POST['postAs'];
    $cat = $_POST['cat'];
    $content = $_POST['editor1'];
    $userId = $_SESSION['userId'];
    $username = $_SESSION['username'];
    date_default_timezone_set('UTC');
    $today = date("m.d.y");
    $contentQuery="INSERT INTO content (id,userId,username,ipaddress,Anonymity,Content,Visibility,Category,DatePosted)VALUES('','$userId','$username','$ip_address','$postAs','$content','$visibility','$cat','$today')";
if($query_run = mysqli_query($con,$contentQuery)){
   
    header('Location:index.php');
     echo 'Content has been saved';
} else {
    echo 'Not saved';
}
    } else {
            
        echo "<div class='alert alert-danger'><strong>!Error</strong> Please write the confession!</div>"; 
    }
    } else {
        echo "<div class='alert alert-danger'><strong>!Error</strong> Please fill all the mandatory fields</div>";
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
        function showForm(){
        var form = document.getElementById('formId');
        form.style.display='visible';
    }
    </script>
  </head>
<body background="/images/background.jpg">
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li><a href="wall.php?varname=<?php echo $_SESSION['userId']."*".$_SESSION['username'] ?>"><span class="glyphicon glyphicon-home"></span>Home</a></li>
      <li  class="active"><a href="profile.php?varname=<?php echo $globalUserId.'*'.$globalUserName ?>"><span class="glyphicon glyphicon-plus-sign">Post</a></li>
      <li><a href="userContent.php?varname=<?php echo $globalUserId.'*'.$globalUserName ?>"><span class="glyphicon glyphicon-lock">MyVault</a></li>  
    </ul>
      <ul class="nav navbar-nav navbar-right">
          <li> <a href="editProfile.php?varname=<?php echo $globalUserId.'*'.$globalUserName ?>">
          <span class="glyphicon glyphicon-user"></span>&nbsp;
              <?php echo $globalUserName ?></li></a>
      <li><a href = "logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
          
    </ul>
  </div>
</nav>
    <form id="formId" name="contentForm" action="" method="post">
     
        <label style="font-weight:bold;color:white;font-size:15px;">Visibility: </label><label style="font-weight:bold;color:red;font-size:20px;">* </label></br>
        <input type="radio" name="visibility" value="Y"> <label style="font-weight:bold;color:white;">Visibile to Everyone</label>
    <input type="radio" name="visibility" value="N"> <label style="font-weight:bold;color:white;">For your secret vault</label></br>
        <label style="font-weight:bold;color:white;font-size:15px;">Post As: </label><label style="font-weight:bold;color:red;font-size:20px;">* </label></br>
        <input type="radio" name="postAs" value="A"><label style="font-weight:bold;color:white;">Anonymous</label>
  <input type="radio" name="postAs" value="U"><label style="font-weight:bold;color:white;">Username</label></br>
        <label style="font-weight:bold;color:white;font-size:15px;">Category: </label><label style="font-weight:bold;color:red;font-size:20px;">* </label>
<div class="dropdown">        
<select name="cat" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
    <option value="">--Select--</option>
    <option value="Funny">Funny</option>
  <option value="Sexual">Sexual</option>
  <option value="Grim">Grim</option>
  <option value="Prank">Prank</option>
  <option value="Guilt">Guilt</option>
  <option value="Other">Other</option>
</select>
    
</div>
        <script type="text/javascript" src="/javascript/ckeditor/ckeditor.js">
</script>
        <textarea class="ckeditor" id="editor1" name="editor1">Write your confession here...</textarea>
        <input type="submit"  class="btn-danger btn-lg" style="color:black;font-weight:bold;" value="Post" onclick="hideForm();">
        
    </form>
    </body>
</html>

