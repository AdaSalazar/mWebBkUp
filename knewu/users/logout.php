<?php 
	$path="../";
	require $path.'cms/sessionStarter.php';	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
	<meta http-equiv="Default-Style" content="Main">
	<title>Log Out</title>
	<!--This part does the styles switcher-->
	<link rel="stylesheet" type="text/css" title="Main" 
	href="../css/main.css">
	<link rel="alternate stylesheet" type="text/css" title="High Contrast" 
	href="../css/highContrast.css">
	<script type="text/javascript" src="../javascripts/styleswitcher.js"></script>
</head>

<body>
	<div id="wrapper">	
		<?php 
			require $path.'cms/functions.php';	
			databaseCreator();			
			loginBanner($path);
		?>
		<div id="menu">
			<?php menuCreator($path); ?>
		</div>		
		<center><h1>Loging Out</h1></center>

		<div id="tabContent">
			<?php
				session_destroy();
				echo '<p>You have been logged out.</p>';
				echo '<p class="highlight">You are going to be redirected to the Homepage.</p>';
				header( 'refresh:2;url='.$path.'index.php' );
			?>
					
		
		</div><!--tabContent-->
		<br>
		<br>
		<div id="footer">	
		<img border="0" src="../images/footer.png" alt="footer image">
			<p><a>&copy; Ada Salazar 2011 - Present</a>
			&nbsp;|&nbsp;
			<a href="disclaimer.html"> Disclaimer</a>
			&nbsp;|&nbsp;
			<a href="#topOfPage">Top of page</a></p>
		</div><!--footer-->
		
	</div><!--wrapper-->
	
	<br>

</body>

</html> 