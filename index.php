<?php
require 'core.php';
require 'connection.php';

if(loggedIn()){
    require 'wall.php';
} else {  
include 'main.php';    
}

?>
<!DOCTYPE html>
<html lang="en">

</html>

