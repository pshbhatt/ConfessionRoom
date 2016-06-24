<?php
require 'connection.php';
if(isset($_GET['varname'])){
$mainString = $_GET['varname'];
$pieces = explode("*", $mainString);
$_SESSION['userId']=$pieces[0];
$globalUserId =$pieces[0];
$globalUserName = $pieces[1];
$_SESSION['username'] = $pieces[1];
}

if(isset($_POST['user_name'])&& isset($_POST['password'])&& isset($_POST['password_again'])&& isset($_POST['secPass'])){
    if(!empty($_POST['user_name']) && !empty($_POST['password'])&& !empty($_POST['password_again'])&& !empty($_POST['secPass'])){
    $username = htmlentities($_POST['user_name']);
        $query = "SELECT id from users where username = '$username'";
        if($query_run=mysqli_query($con,$query)){
            $row_num = mysqli_num_rows($query_run);
            if($row_num!=0){
                echo "<div class='alert alert-danger'><strong>!Error</strong> This username is unavailable. Try using a different username</div>";
            } 
        }
    $password = htmlentities($_POST['password']);
    $password_again = htmlentities($_POST['password_again']);
   if (strlen($password) < '8') {
            echo "<div class='alert alert-danger'><strong>!Error</strong> Your Password Must Contain At Least 8 Characters!</div>";
            
    }
    elseif(!preg_match("#[0-9]+#",$password)) {
        echo "<div class='alert alert-danger'><strong>!Error</strong> Your Password Must Contain At Least 1 Number!</div>";
        
    }
    elseif(!preg_match("#[A-Z]+#",$password)) {
        echo "<div class='alert alert-danger'><strong>!Error</strong> Your Password Must Contain At Least 1 Uppercase Letter!</div>";
        
    }
    elseif(!preg_match("#[a-z]+#",$password)) {
         echo "<div class='alert alert-danger'><strong>!Error</strong> Your Password Must Contain At Least 1 Lowercase Letter!</div>";
        
    } else {
        if($password_again==$password){
       
      $password_hash=md5($password);
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
      $secPass = $_POST['secPass'];
      if($secPass!=$password){
    $query="update users set username='$username',password = '$password_hash', Sec_Password='$secPass' where id='$globalUserId'"; 
if($query_run = mysqli_query($con,$query)){
    //header("Location:index.php");
    echo "<div class='alert alert-success'><strong>Congratulations!</strong> Get ready for your confessions!</div>";
} else {
    echo 'Not Reg';
}
      } else {
          echo "<div class='alert alert-danger'><strong>!Error</strong> Password and Secondary password cannot be same.</div>";
      }
    mysqli_close($con);
  } else {
       echo "<div class='alert alert-danger'><strong>!Error</strong> Passwords entered do not match</div>";
   }
    }
} else {
       echo "<div class='alert alert-danger'><strong>!Error</strong> Please fill all the mandatory fields</div>";
    }
    
}    

?>
<!DOCTYPE html>
<html lang="en">
    <title>
    Confession Room
    </title>
    <head>
    <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/javascript/bootstrap/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="/javascript/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/javascript/jquery-1.7.1.min.js"></script>
       <script type="text/javascript" src="/javascript/jquery-ui-1.8.17.custom.min.js"></script>
       <link rel="stylesheet" type="text/css"
        href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
       <script type="text/javascript">
              
         function passwordGuide(){
             alert("Password must contain:\nAtleast 8 characters \nAtleast 1 Uppercase Letter\nAtleast 1 Lowercase Letter\nAtleast 1 numeric value ");
         }  
           
           function secPassword(){
               alert("This password would be used to reset the primary password in case you forget your password.\nThis password cannot be same as your primary password.\nThere are no criteria for this password.")
               
           }
       </script>
  </head>
<body background="/images/background.jpg">
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li><a href="wall.php?varname=<?php echo $_SESSION['userId']."*".$_SESSION['username'] ?>"><span class="glyphicon glyphicon-home"></span>Home</a></li>
      <li><a href="profile.php?varname=<?php echo $_SESSION['userId'].'*'.$_SESSION['username'] ?>"><span class="glyphicon glyphicon-plus-sign">Post</a></li>
      <li class="active"><a href="userContent.php?varname=<?php echo $_SESSION['userId'] ?>"><span class="glyphicon glyphicon-lock">MyVault</a></li>  
    </ul>
      <ul class="nav navbar-nav navbar-right">
         <li> <a href="editProfile.php?varname=<?php echo $globalUserId.'*'.$globalUserName ?>">
          <span class="glyphicon glyphicon-user"></span>&nbsp;
              <?php echo $_SESSION['username'] ?></li></a>
      <li><a href = "logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
          
    </ul>
  </div>
</nav>
    <h1 style="color:white">Update Profile</h1>
    <form action="" method="post">
<div class="table-responsive">
     <table class="table">
         <tbody>
             <tr>
    <td><label for="user" style="color:white;">Username:</label><t/d>
    <td><input type="text" name="user_name" value=<?php echo $globalUserName?>>
        <label style="font-weight:bold;color:red;font-size:20px;">* </label></td>
        <td></td>
    </tr>
 
    <tr>   
        <td><label for="pass" style="color:white">Password:</label></td>
    <td><input type="password" name="password" value="****">
        <label style="font-weight:bold;color:red;font-size:20px;">* </label>
        <a href="" onclick=passwordGuide();><span class="glyphicon glyphicon-question-sign"></span></a>
        </td>
        </tr>
    <tr>     
        <td><label for="pass" style="color:white">Re enter Password:</label></td>
    <td><input type="password" name="password_again">
        <label style="font-weight:bold;color:red;font-size:20px;">* </label></td>
        <td></td>
        </tr>
    
        <tr>
            <td><label style="color:white">Secondary Password:</label></td>
      <td><input type="text" name="secPass" id="secPass" value="****"/>
          <label style="font-weight:bold;color:red;font-size:20px;">* </label>
            <a href="" onclick=secPassword();><span class="glyphicon glyphicon-question-sign"></span></a></td>
            <td> </td>
    </tr>
         </tbody>
    </table>
    </div>
<input type="submit" class="btn-danger btn-lg" style="color:black;font-weight:bold;" value="Update"/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <a style="color:black;font-weight:bold;" class="btn-info btn-lg" href="index.php">Login Page </a>

    </form>
    
    </body>
</html>
