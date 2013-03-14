<?php 
	$path="../";
	require $path.'cms/sessionStarter.php';	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
	<title>Users Page - kNewU</title>
	<!--This part does the styles switcher-->
	<link rel="stylesheet" type="text/css" title="Main" 
	href="../css/main.css">
	<link rel="alternate stylesheet" type="text/css" title="High Contrast" 
	href="../css/highcontrast.css">
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

		<div id="tabContent"><!--This creates what goes inside the 'usertabs' in the website-->
			<?php 
				if($sessionName == 'Guest'){
					echo '<p>You can\'t edit your page if you are not loged in!! <br> Please log in first.</p>';
				} else {
					
					$userName = str_replace(" ", "_", $_SESSION['username']);
					echo '							
					<div class="subMenu"> 
						<ul>					
							<li id="sel"><a href="editpage.php">Manage Your Page</a></li>
							<li id="nonsel"><a href="video.php">Upload a Video</a></li>
							<li id="nonsel"><a href="photo.php">Upload a Photo</a></li>
							<li id="nonsel"><a href="ptutorial.php">Upload a photo tutorial </a></li>
							<li id="nonsel"><a href="userpagemanager.php">Manage Your Uploads</a></li>
							<li id="nonsel"><a href="user.php?username='.$userName.'">Preview your user page </a></li>
						</ul>
					</div><!--tabs-->
					<br />
					<br />
					<center><h1>Manage Your Page</h1></center>
						<br>
							<p>Now what? Here are a few ideas to get you on the right track...<br />
								<ul id="userIdeas">
									<li>Why not <a href="editpage.php">change the look</a> of your page? </li>
									<li>Maybe <a href="video.php">upload new a video</a> or <a href="photo.php">upload a new photo</a>?</li>
									<li>Why not <a href="ptutorial.php">upload a new photo tutorial</a>?</li>
									<li>Manage <a href="userpagemanager.php">your uploads</a> (videos or images)?</li>
									<li>Perhaps <a href="user.php?username='.$userName.'">preview your user page</a>?</li>
								</ul>
								</p>
						<p>You can change how your user page looks like! </p>
						
						
						';
				}
				
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