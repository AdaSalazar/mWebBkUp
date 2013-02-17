<?php 
	$path="";
	require $path.'cms/sessionStarter.php';	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
	<title>Disclaimer</title>
	<!--This part does the styles switcher-->
	<link rel="stylesheet" type="text/css" title="Main" 
	href="css/main.css">
	<link rel="alternate stylesheet" type="text/css" title="High Contrast" 
	href="css/highcontrast.css">
	<script type="text/javascript" src="../files/javascripts/styleswitcher.js"></script>
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
		<div id="content"><!--This creates what goes inside the 'tabs' in the website-->
			<h2>Disclaimer</h2> 
		<p>The information contained in this website is for general information purposes only. 
		I endeavour to keep the information up to date and correct, 
		I make no representations or warranties of any kind, express or implied, about the completeness, accuracy, reliability,
		suitability or availability with respect to the website or the information or related graphics 
		contained on the website for any purpose. Any reliance you place on such information is therefore strictly at your own risk.
		<br>
		<br>
		In no event will I be liable for any loss or damage including without limitation, indirect or consequential loss or damage, 
		or any loss or damage whatsoever arising from loss of data or profits arising out of, or in connection with, the use of this website.
		<br>
		<br>
		Through this website you are able to link to other websites which are not under my control. 
		I have no control over the nature, content and availability of those sites. The inclusion of any links does not necessarily 
		imply a recommendation or endorse the views expressed within them.
		<br>
		<br>
		Every effort is made to keep the website up and running smoothly. However, I take no responsibility for, 
		and will not be liable for, the website being temporarily unavailable due to technical issues beyond our control.
		</p>
		</div><!--content-->
	</div><!--wrapper--> 
		<br>
		<div id="footer">	
			<p><a>&copy; Ada Salazar 2011 - Present</a>
			&nbsp;|&nbsp;
			<a href="disclaimer.html"> Disclaimer</a>
			&nbsp;|&nbsp;
			<a href="#topOfPage">Top of page</a></p>
			</div><!--footer-->
	</div> <!--wrapper-->
</body>

</html>