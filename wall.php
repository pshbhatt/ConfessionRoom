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
?>
<!DOCTYPE html>
<html lang="en">
    <title>
    Confession Wall
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
      <li class="active"><a href="#"><span class="glyphicon glyphicon-home"></span>Home</a></li>
      <li><a href="profile.php?varname=<?php echo $globalUserId.'*'.$globalUserName ?>"><span class="glyphicon glyphicon-plus-sign">Post</a></li>
      <li><a href="userContent.php?varname=<?php echo $globalUserId.'*'.$globalUserName ?>"><span class="glyphicon glyphicon-lock">MyVault</a></li>  
    </ul>
      <ul class="nav navbar-nav navbar-right">
         <li> <a href="editProfile.php?varname=<?php echo $globalUserId.'*'.$globalUserName ?>">
          <span class="glyphicon glyphicon-user"></span>&nbsp;
              <label><?php echo $globalUserName ?><label></li></a>
      <li><a href = "logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
          
    </ul>
  </div>
</nav>
    <form action="" method="post">
        <div class="dropdown">        
<select onchange="this.form.submit()" name="cat" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
    <option value="">--Select--</option>
    <option value="All">All</option>
  <option value="Funny">Funny</option>
  <option value="Sexual">Sexual</option>
  <option value="Grim">Grim</option>
  <option value="Prank">Prank</option>
  <option value="Guilt">Guilt</option>
  <option value="Other">Other</option>
</select>
</div>
    </form>
</body>
</html>
<?php
if(isset($_POST['cat'])&& !empty($_POST['cat'])){
   $category = $_POST['cat'];
    if($category!="All"){
$allData = "SELECT * FROM content where Visibility='Y' and Category='".$category."'";
    } else {
     $allData = "SELECT * FROM content where Visibility='Y'";   
    }
    

    if($query_run = mysqli_query($con,$allData)){
     while($row = $query_run->fetch_assoc()) {
        if($row['Anonymity']=='U'){
            if(isAdmin()){
                echo "<div class='panel panel-default'><div class='panel-heading' style='background:black;color:white'> Date:".$row["DatePosted"]." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User Name: ".$row["username"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Category:".$row['Category']."<a href='deleteContent.php?varname=".$row['id']."'>Delete</a></div><div class='panel-body' style='background:grey;color:white'>".$row['Content']."</div>";
            } else {
            echo "<div class='panel panel-default'><div class='panel-heading' style='background:black;color:white'> Date:".$row["DatePosted"]." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User Name: ".$row["username"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Category:".$row['Category']."<a href='reportContent.php?varname=".$row['id']."'>Report Content</a></div><div class='panel-body' style='background:grey;color:white'>".$row['Content']."</div>";
            }
        } else {
            if(isAdmin()){
              echo "<div class='panel panel-default'><div class='panel-heading' style='background:black;color:white'>Date:".$row["DatePosted"]." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User Name: Anonymous &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Category:".$row['Category']."<a href='deleteContent.php?varname=".$row['id']."'>Delete</a></div><div class='panel-body'style='background:grey;color:white'>".$row['Content']."</div>";  
            } else {
             echo "<div class='panel panel-default'><div class='panel-heading' style='background:black;color:white'>Date:".$row["DatePosted"]." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User Name: Anonymous &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Category:".$row['Category']."<a href='reportContent.php?varname=".$row['id']."'>Report Content</a></div><div class='panel-body'style='background:grey;color:white'>".$row['Content']."</div>";
        }
        }
    }
}  
    
} else {
   $allData = "SELECT * FROM content where Visibility='Y'";
if($query_run = mysqli_query($con,$allData)){
     while($row = $query_run->fetch_assoc()) {
        if($row['Anonymity']=='U'){
            if(isAdmin()){
                
                 echo "<div class='panel panel-default'><div class='panel-heading' style='background:black;color:white'>Date:".$row["DatePosted"]." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User Name: ".$row["username"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Category:".$row['Category']."<a href='deleteContent.php?varname=".$row['id']."'>Delete</a></div><div class='panel-body' style='background:grey;color:white'>".$row['Content']."</div>";
            } else {
                
            echo "<div class='panel panel-default'><div class='panel-heading' style='background:black;color:white'>Date:".$row["DatePosted"]." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User Name: ".$row["username"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Category:".$row['Category']."<a href='reportContent.php?varname=".$row['id']."'>Report Content</a></div><div class='panel-body' style='background:grey;color:white'>".$row['Content']."</div>";
            }
        } else {
            if(isAdmin()){
                echo "<div class='panel panel-default'><div class='panel-heading' style='background:black;color:white'>Date:".$row["DatePosted"]." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User Name: Anonymous &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Category:".$row['Category']. "<a href='deleteContent.php?varname=".$row['id']."'>Delete</a></div><div class='panel-body'style='background:grey;color:white'>".$row['Content']."</div>";
            } else {
                
             echo "<div class='panel panel-default'><div class='panel-heading' style='background:black;color:white'>Date:".$row["DatePosted"]." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User Name: Anonymous &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Category:".$row['Category']. "<a href='reportContent.php?varname=".$row['id']."' >Report Content</a></div><div class='panel-body'style='background:grey;color:white'>".$row['Content']."</div>";
            }
        }
    }
}  
   
}
?>
