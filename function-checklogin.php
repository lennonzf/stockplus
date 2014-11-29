<?php
//if user hasn't logged in, go back to login page
if(!isset($_SESSION['username'])){
	header('Location: page-login.php');
}

//logout
if(isset($_POST['logout'])){
   session_destroy();
   header('Location: page-login.php');
}
?>