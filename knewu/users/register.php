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
	<title>Register</title>
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
			<center><h1>Register</h1></center>
			<h2>Please complete the form:</h2>
			
			<?php
				if (isset($_GET['uname'])){
					//$username = $_POST['usernameF'];
					$username = $_GET['uname'];
				}
				
				if (isset($_POST['submitRegistration'])) {
					$submitRegistration = $_POST['submitRegistration'];
					//Form data
					//The strip_tags is to prevent people trying to use html tags in the fields
					$firstname = strip_tags($_POST['firstname']);
					$lastname = strip_tags($_POST['lastname']);
					$username = strtolower(strip_tags($_POST['username']));
					$password = strip_tags($_POST['password']);
					$repeatpassword = strip_tags($_POST['repeatpassword']);
					$date = date("Y-m-d");
				} 
				if (isset($_POST['submitRegistration'])){
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
					
					//Checking if the user name entered is already on the database
					$namecheck = mysql_query("SELECT userName FROM usersT WHERE userName='$username'");
					$countRecords = mysql_num_rows($namecheck);
					
					//If the username is taken displays a message if not continue with the registration
					if($countRecords!=0){
						echo "<p class='highlightbad'>The username selected is already taken, please try again.</p>";				
					}else{
						//check for existance of all fields
						if($firstname&&$lastname&&$username&&$password&&$repeatpassword){
							
							if($password==$repeatpassword){
								//checking the length of the data entered. 
								if(strlen($username)>25||strlen($firstname)>35||strlen($lastname)>35){
									echo "<p>The one of the fields entered is <b>too long</b>. <br> 
										Maximum lenght for the Username is 35 characters, <br>
										Maximum lenght for the First and Last name is 35 characters.</p>";
								} else {
									//Check the length of the password
									if(strlen($password)>25||strlen($password)<6){
										echo "Password must be between 6 and 25 characters long.<br>";
									} else{								
										//This md5 is a way to encrypt the password so the website is safer
										$password = md5($password);
										$repeatpassword = md5($repeatpassword);	
										
										//Registering the user into the database
										$queryreg = mysql_query("
										INSERT INTO usersT VALUES('','$username','$password','$firstname','$lastname','','$date')
										");
										die('<p class="highlight">Registration has been successfull!</p><br/> 
										<center><form action="login.php" method="POST">											
											<p><b>Username:</b><input type="text" size="20" name="usernameF" class="box">
											<b>Password:</b><input type="password" size="20" name="password" class="box">
											<input type="submit" value="Log in" name="login" class="button"></p>
										</form></center>
										');
							
										echo "<p class='highlight'>Registration has succeeded!</p>";
									}
								
								}
							} else {
								echo "<p class='highlightbad'>Your passwords do not match!<br></p>";
							}	
						} else {
							echo "<p class='highlightbad'>Please fill in <b><u>all</u></b> fields!!</p>";
						}
					}
					
					
				}
			?>
			<table id="registert">
				<tr>
					<td width="55%"><!--Register-->
						<p> Note that you can <strong><u>not</u></strong> 
						use single quotes ' for any field and the password has
						to be between 6 and 25 characters long.</p>
						<form action='register.php' method='POST'>
							<fieldset class="form">
								<label>First name:</label>
								<input type="text" size="20" name="firstname" value="<?php if(isset($firstname)){echo $firstname;} ?>" class="box"> 
								
								<label>Last name:</label> 	 
								<input type="text" size="20" name="lastname" value="<?php if(isset($lastname)){echo $lastname;} ?>" class="box"> 
								
								<label>Username:</label> 	 
								<input type="text" size="15" name="username" value="<?php if(isset($username)){echo $username;} ?>" class="box" >
								<small>Maximum 35 characters long</small>
								<label>Password:</label> 	 
								<input type="password" name="password" class="box">
								<small>Between 6 and 25 characters long</small>
								
								<label>Repeat password:</label> 	 
								<input type="password" name="repeatpassword" class="box">				
							</fieldset>
							
							<input type='submit' value='Register' name='submitRegistration' class="button">
						</form> 	
						
					</td>				
					
					<td valign="top" id="logint"><!--Log In-->
						<p>If you are already a member please log in.</p>
						<form action="login.php" method="POST">
							<fieldset  class="form">
								<label>Username:</label>
								<input type="text" size="20" name="usernameF" class="box">
								<label>Password:</label>
								<input type="password" size="20" name="password" class="box">
							</fieldset>
							<input type="submit" value="Log in" name="login" class="button">
						</form>
					</td>
				</tr>
			</table>
			
		</div><!--tabContent-->
		
	</div><!--wrapper-->
	
	<br>
	<br>
	<div id="footer">	
		<p><a>&copy; Ada Salazar 2011 - Present</a>
		&nbsp;|&nbsp;
		<a href="disclaimer.html"> Disclaimer</a>
		&nbsp;|&nbsp;
		<a href="#topOfPage">Top of page</a></p>
	</div><!--footer-->
</body>

</html> 