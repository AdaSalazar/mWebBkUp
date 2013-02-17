<?php
	session_start(); 
//session_destroy();
	$displayerSelector = "";
	if(isset($_SESSION['username'])){
		$sessionName = $_SESSION['username'];//This line is used for the cart.php
	}else{
		$sessionName = 'Guest';
	}
?>