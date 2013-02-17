<?php 
	$path="";
	require $path.'cms/sessionStarter.php';	
?>
<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
	<meta http-equiv="Default-Style" content="Main">
	<title>kNewU</title>
	<!--This part does the styles switcher-->
	<link rel="stylesheet" type="text/css" title="Main" 
	href="css/main.css">
	<link rel="alternate stylesheet" type="text/css" title="High Contrast" 
	href="css/highContrast.css">
	<script type="text/javascript" src="../files/javascripts/styleswitcher.js"></script>
</head>

<body>
	<div id="wrapper">
	<!-- Places the images on top-->
		<?php 
			require $path.'cms/functions.php';	
			databaseCreator();			
			loginBanner($path);
		?>
		<div id="menu">
			<?php menuCreator($path); ?>
		</div>	
		<div id="content">
		
		
		<!--<nav>
			<ul>
				<li><a href="#" >Home</a></li>
				<li><a href="#" class="SelectedX">MakeUp Basics</a>
					<ul>
						<li><a href="#">Brushes for..</a>
							<ul>
								<li><a href="#">Face</a></li>
								<li><a href="#">Eyes</a></li>
							</ul>
						</li>
						<li><a href="#">Products for..</a>
							<ul>
								<li><a href="#">Face</a></li>
								<li><a href="#">Eyes</a></li>
								<li><a href="#">Lips</a></li>
							</ul>
						</li>
					</ul>
				</li>
				<li><a href="#" class="noselectedX">Gallery</a>	</li>
				<li><a href="#" class="noselectedX">Tutorials</a>
					<ul>
						<li><a href="#">Photo Tutorials</a></li>
						<li><a href="#">Video Tutorials</a>
							<ul>
								<li><a href="#">Quick Looks</a></li>
								<li><a href="#">Going Out Looks</a></li>
								<li><a href="#">Night Looks</a></li>
							</ul>
						</li>
					</ul>
				</li>
				<div id="searchForm">
				<form action="../cms/search.php" method="GET">
				  <input type="text" size="15" name="search">
				  <input type="submit" name="submit" value="Search">
				</form>
				</div>
			
			</ul>
		</nav>-->
			<p>Content 
				<br>
				<br>
				text
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				
				
				<br>
				end
			</p>
		</div><!--content-->
	</div><!--wrapper-->

	<br>
	<div id="footer">	
		<p>
			<a>&copy; Ada Salazar 2013 - Present</a>
			&nbsp;|&nbsp;
			<a href="disclaimer.php"> Disclaimer</a>
			&nbsp;|&nbsp;
			<a href="#topOfPage">Top of page</a>
		</p>
	</div><!--footer-->
</body>

</html> 