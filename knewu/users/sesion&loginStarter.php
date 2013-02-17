<?php
	session_start(); 
//session_destroy();
	$displayerSelector = "";
	if(isset($_SESSION['username'])){
		$sessionName = $_SESSION['username'];//This line is used for the cart.php
		//echo "<p>Welcome ".$_SESSION['username']."!!  ";
		//echo '<sub> <small>Not '.$_SESSION['username'].'?? Click <a href="http://localhost/447967/admin/logout.php">to Logout</a></sub></small></p> ';
	}else{
		$sessionName = 'Guest';
		//echo "<p>Welcome Guest!  ";
		//echo '<sub><small>Why not <a href="http://localhost/447967/index.php">Log in</a></sub></small>?</p> ';
	}
?>