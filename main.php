<?php
require 'connection.php';
//require 'core.php';
if(isset($_POST['userName'])&& isset($_POST['password'])){
$username = $_POST['userName'];
    $password = $_POST['password'];
    $password_hash=md5($password);
    if(!empty($username)&& !empty($password)){
        echo $query = "SELECT id from users where username = '$username' and password='$password_hash'";
        if($query_run=mysqli_query($con,$query)){
            $row_num = mysqli_num_rows($query_run);
            if($row_num==0){
                echo "<div class='alert alert-danger'><strong>!Error</strong> Invalid Username or Password</div>";
            } else {
                if($row=$query_run->fetch_assoc()){
                    $userId= $row['id'];
                   // echo $userId;
                    $_SESSION['userId']=$userId;
                    $_SESSION['username'] = $username;
                    header('Location:index.php');
                }
             }
        }
    }
/*$result = mysqli_query($con, "SELECT password FROM users where username ='".$username."'");
   if($row=$result->fetch_assoc()){
       if($row['password']==$password)
       {
           echo 'Logged in';
       } else {
           echo 'username and password does not match';
       }
   }*/
    
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
  </head>
<body background="/images/background.jpg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                
        <h1 style="color:grey">Confession Room</h1></br><h2 style="color:white">Confess to anything and everything</h2>
            
            <img src="/images/mainImg.jpg" class="img-responsive" alt="Cinque Terre" width="304" height="236">
            </div>
            
                
        <div class="col-sm-4">  
        <!--<div class="table-responsive"> -->         
            <h1 style="color:grey">Login to share your secrets</h1></br>
 <form role="form" name="loginForm" method="post" action="index.php">
    <!--<table class="table">
    <tbody>
      <tr>
        <td><label for="user" style="color:white;">UserName:</label></td>
        <td><input type="text" name="userName" id="user"/></br></td>
      </tr>
        <tr>
        <td><label for="pass" style="color:white">Password:</label></td>
        <td><input type="password" name="password" id="pass"/></br></td>
      </tr>
    <tr>
        <td><input type="submit" class="btn-danger btn-lg" style="color:black;font-weight:bold;" value="Login"/></label></td>
    <td><a style="color:black;font-weight:bold;" class="btn-danger btn-lg" href="registration.php">New User </a></td>
      </tr>
    </tbody>
  </table>-->
  <div class="form-group">
    <label for="user" style="color:white;">UserName:</label>
    <input type="text" name="userName" id="user"/></br>
  </div>
  <div class="form-group">
    <label for="pass" style="color:white">Password:</label>
    <input type="password" style="margin-left:1px;" name="password" id="pass"/></br>
  </div>
  <div class="form-group">
  <input type="submit" class="btn-danger btn-lg" style="color:black;font-weight:bold;" value="Login"/> &nbsp;
      <a style="color:black;font-weight:bold;" class="btn-info btn-lg" href="registration.php">New User </a> &nbsp;</br></div>
        <a style="color:black;font-weight:bold;" class="btn-info btn-lg" href="forgotPassword.php">Forgot Password </a>

</form>
 <!-- </div>-->
</div>
</div>
</div>
</body>
</html>
