<?php
require 'core.php';
require 'connection.php';
           /* $_SESSION['username'];
             $_SESSION['userId'];*/
$mainString = $_GET['varname'];
$pieces = explode("*", $mainString);
$_SESSION['userId']=$pieces[0];
$globalUserId =$pieces[0];
$globalUserName = $pieces[1];
$_SESSION['username'] = $pieces[1];
?>
<!DOCTYPE html>
<html lang="en">
    <title>
    My Vault
    </title>
    <head>
    <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/javascript/bootstrap/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="/javascript/bootstrap/js/bootstrap.min.js"></script>
  </head>
   <body background="/images/background.jpg">
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li><a href="wall.php?varname=<?php echo $_SESSION['userId']."*".$_SESSION['username'] ?>"><span class="glyphicon glyphicon-home"></span>Home</a></li>
      <li><a href="profile.php?varname=<?php echo $_SESSION['userId'].'*'.$_SESSION['username'] ?>"><span class="glyphicon glyphicon-plus-sign">Post</a></li>
      <li class="active"><a href="userContent.php?varname=<?php echo $globalUserId.'*'.$globalUserName ?>"><span class="glyphicon glyphicon-lock">MyVault</a></li>  
    </ul>
      <ul class="nav navbar-nav navbar-right">
         <li> <a href="editProfile.php?varname=<?php echo $globalUserId.'*'.$globalUserName ?>">
          <span class="glyphicon glyphicon-user"></span>&nbsp;
              <?php echo $_SESSION['username'] ?></li></a>
      <li><a href = "logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
          
    </ul>
  </div>
</nav>
</body>
</html>
<?php
$allData = "SELECT * FROM content where userId=".$_SESSION['userId'];
if($query_run = mysqli_query($con,$allData)){
    $row_num = mysqli_num_rows($query_run);
            if($row_num==0){
                echo "<label style='font-weight:bold;color:white'>You have not posted anything yet :(</label>";
            } else { 
    while($row = $query_run->fetch_assoc()) {
        if($row['Anonymity']=='U'){
         echo "<div class='panel panel-default'><div class='panel-heading' style='background:black;color:white'> User Name: ".$row["username"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Category:".$row["Category"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Posted on:".$row["DatePosted"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='updateContent.php?varname=".$row['id']."*".$row['username']."*".$row['userId']."'><span class='glyphicon glyphicon-edit'>Edit</a></div><div class='panel-body' style='background:grey;color:white'>".$row['Content']."</div>";
        } else {
             echo "<div class='panel panel-default'><div class='panel-heading' style='background:black;color:white'> User Name: Anonymous&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Category:".$row["Category"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Posted on:".$row["DatePosted"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='updateContent.php?varname=".$row['id']."*".$row['username']."*".$row['userId']."'><span class='glyphicon glyphicon-edit'>Edit</a> </div><div class='panel-body'style='background:grey;color:white'>".$row['Content']."</div>";
        }
    }
}
}

?>
