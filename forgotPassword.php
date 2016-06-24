<?php
require 'connection.php';
if(isset($_POST['user_name'])&& isset($_POST['password'])&& isset($_POST['newPass'])&& isset($_POST['newPassAgain'])){
    if(!empty($_POST['user_name']) && !empty($_POST['password'])&& !empty($_POST['newPass'])&& !empty($_POST['newPassAgain'])){
    $username = htmlentities($_POST['user_name']);
        $query = "SELECT id from users where username = '$username'";
        if($query_run=mysqli_query($con,$query)){
            $row_num = mysqli_num_rows($query_run);
            if($row_num==0){
                echo "<div class='alert alert-danger'><strong>Invalid username!</strong>Username does not exist </div>";
            } 
        }
        $newPass = htmlentities($_POST['newPass']);
        $newPassAgain = htmlentities($_POST['newPassAgain']);
    $password = htmlentities($_POST['password']);
         $query = "SELECT id from users where username = '$username' and Sec_Password='$password'";
        if($query_run=mysqli_query($con,$query)){
            $row_num = mysqli_num_rows($query_run);
            if($row_num!=0){
    
   if (strlen($newPass) < '8') {
            echo "<div class='alert alert-danger'><strong>!Error</strong> Your Password Must Contain At Least 8 Characters!</div>";
            
    }
    elseif(!preg_match("#[0-9]+#",$newPass)) {
        echo "<div class='alert alert-danger'><strong>!Error</strong> Your Password Must Contain At Least 1 Number!</div>";
        
    }
    elseif(!preg_match("#[A-Z]+#",$newPass)) {
        echo "<div class='alert alert-danger'><strong>!Error</strong> Your Password Must Contain At Least 1 Uppercase Letter!</div>";
        
    }
    elseif(!preg_match("#[a-z]+#",$newPass)) {
         echo "<div class='alert alert-danger'><strong>!Error</strong> Your Password Must Contain At Least 1 Lowercase Letter!</div>";
        
    } else {
        if($newPass==$newPassAgain){
      $newPass_hash=md5($newPass);
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
    $query="UPDATE users set password='$newPass_hash' where username='$username'";
if($query_run = mysqli_query($con,$query)){
    //header("Location:index.php");
    echo "<div class='alert alert-success'><strong>Congratulations!</strong> The password has been reset!</div>";
} else {
    echo 'Not Reg';
}
     
  } else {
       echo "<div class='alert alert-danger'><strong>!Error</strong> Passwords entered do not match</div>";
   }
    }
} else {
       echo "<div class='alert alert-danger'><strong>!Error</strong> Please fill all the mandatory fields</div>";
    }
}
  
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
        <script type="text/javascript">
        function passwordGuide(){
             alert("Password must contain:\nAtleast 8 characters \nAtleast 1 Uppercase Letter\nAtleast 1 Lowercase Letter\nAtleast 1 numeric value ");
         } 
        </script>
  </head>
    <body background="/images/background.jpg">
    <h1 style="color:white">Reset Password</h1>
    <form action="" method="post">
<div class="table-responsive">
     <table class="table">
         <tbody>
             <tr>
    <td><label style="color:white;">Username:</label><t/d>
    <td><input type="text" name="user_name" >
        <label style="font-weight:bold;color:red;font-size:20px;">* </label></td>
        
    </tr>
 
    <tr>   
        <td><label style="color:white">Secondary Password:</label></td>
    <td><input type="password" name="password" >
        <label style="font-weight:bold;color:red;font-size:20px;">* </label>
        </td>
        </tr>
    <tr>     
        <td><label style="color:white">New Password:</label></td>
    <td><input type="password" name="newPass">
        <label style="font-weight:bold;color:red;font-size:20px;">* </label>
        <a href="" onclick="passwordGuide();"><span class="glyphicon glyphicon-question-sign"></span></a></td>
        </tr>
        
        <tr>
            <td><label style="color:white">Re enter New Password:</label></td>
      <td><input type="password" name="newPassAgain" id="newPassAgain"/>
          <label style="font-weight:bold;color:red;font-size:20px;">* </label>
           
    </tr>
         </tbody>
    </table>
    </div>
<input type="submit" class="btn-danger btn-lg" style="color:black;font-weight:bold;" value="Reset Password"/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <a style="color:black;font-weight:bold;" class="btn-info btn-lg" href="index.php">Login Page </a>

    </form> 
    </body>
</html>