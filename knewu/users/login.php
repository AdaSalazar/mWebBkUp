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
	<title>Log in</title>
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

		<div id="tabContent">
			<center><h1>Loging in</h1></center>
			<?php
				$dbusername = "";
				$dbpassword = "";
				//Gets the information from the previous page
				
				if (isset($_POST['register'])){
					//this is going to send the username to the register page
					if (isset($_POST['usernameF'])&&$_POST['usernameF']!=""){
						$uname=$_POST['usernameF'];
						//echo " uname   ".$uname;
						//this redirects the user to the register page and send the username
						header( 'Location: register.php?uname='.$uname ) ;
					}else {
						//echo "no uname";
						header( 'Location: register.php') ;
						//header( 'refresh:4;url=register.php' );
					}
					
				} else if($_POST['login']) {
					$username = strtolower($_POST['usernameF']);
					$password = $_POST['password'];
					if($username&&$password){
						//open database 
						$dbName = "knewu";	
						//Local host
						$dbHost = "localhost";
						$dbUsername = "root";
						$dbPassword = "";
						
						//Live Host
						/*$dbHost = "knewu.db.10370453.hostedresource.com";
						$dbUsername = "knewu";
						$dbPassword = "Makeup1!";*/
						$connect = mysql_connect($dbHost,$dbUsername,$dbPassword) or die("Couldn't connect." . mysql_error());
						//select database
						mysql_select_db($dbName)or die("Couldn't select database." . mysql_error());
						
						//This helps to check that the username exists
						$checkUsers = mysql_query("SELECT * FROM usersT WHERE userName='$username'");
						$noUsers = mysql_num_rows($checkUsers);
						
						//$checkAdmin = mysql_query("SELECT * FROM administrators WHERE userName='$username'");
						//$noAdmin = mysql_num_rows($checkAdmin);
						
						
						//if ($noUsers!=0 || $noAdmin!=0 ){
						
						if($noUsers !=0){						
								$querySelector = $checkUsers;
								$displayMessage = 'See our <a href="'.$path.'products.php">Products</a>  page!';
							/*} else if($noAdmin !=0) {
								$querySelector = $checkAdmin;
								$displayMessage = '	<form action="'.$path.'cms/index.php" method="GET">
										<input type="submit" name="adminEntryVerified" value="Manage Products">
										</form> 
										<form action="'.$path.'cms/lowStockProducts.php" method="GET">
										<input type="submit" name="adminEntryVerified" value="View Low Stock Products">
										</form> 
										<form action="'.$path.'cms/manageAdmin.php" method="GET">
										<input type="submit" name="adminEntryVerified" value="Manage Administrators">
										</form>
										<form action="'.$path.'cms/manageStaff.php" method="GET">
										<input type="submit" name="adminEntryVerified" value="Manage Staff">
										</form>
										<form action="'.$path.'cms/viewOrders.php" method="GET">
										<input type="submit" name="adminEntryVerified" value="View Orders">
										</form> ';
							} */
							//taking data from the query and putting it in a array to compare username and password
							while ($row = mysql_fetch_assoc($querySelector)){
								$dbusername = $row['userName'];
								$dbpassword = $row['password'];
							}
							if ($username==$dbusername&&md5($password)==$dbpassword){
								echo "<h3>You have successfully logged in!</h3> <br/> <p class='highlight'>You are going to be redirected to yopur page.</p>";
								$_SESSION['username']=$username;
								header( 'refresh:4;url=index.php' );
								//Displays a personalized message depending on the user entered
								//echo $displayMessage;
							}else{
								//echo '<a href="http://localhost/447967/index.php"> <h2>Click here to go back and try again</h2></a><br> ';
								echo "<h3 class='highlightbad'>Incorrect password!</h3>";
							}
						}else{
							//echo '<a href="http://localhost/447967/index.php"><h2> Click here to go back and try again</h2></a><br> ';
							die("<h3 class='highlightbad'>That username does not exist!</h3>");
						}

					}else{
						 //Shows a link to go back and displays an error message with instructions
						 //echo '<a href="http://localhost/447967/index.php"><h2> Click here to go back and try again</h2></a><br> ';
						 die("<h3 class='highlightbad'>Please enter a username and password!</h3>");
					}
				}
				
				
				
				
			?>
			
		</div><!--tabContent-->

	</div><!--wrapper-->
	
	<br>
	<br>
	<div id="footer">	
		<p><a>&copy; Ada Salazar 2011 - Present</a>
		&nbsp;|&nbsp;
		<a href="../disclaimer.html"> Disclaimer</a>
		&nbsp;|&nbsp;
		<a href="#topOfPage">Top of page</a></p>
	</div><!--footer-->
</body>

</html> 