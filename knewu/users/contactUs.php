<?php 
	require '../admin/sessionStarter.php'
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
	<meta http-equiv="Default-Style" content="Main">
	<title>Contact Us</title>
	<!--This part does the styles switcher-->
	<link rel="stylesheet" type="text/css" title="Main" 
	href="../css/main.css">
	<link rel="alternate stylesheet" type="text/css" title="High Contrast" 
	href="../css/highContrast.css">
	<script type="text/javascript" src="../javascripts/styleswitcher.js"></script>
</head>

<body>
	<div id="wrapper">
		<div id="tabs"> 
			<ul>
				<li><a href="http://localhost/447967/client/index.php">Home</a></li>
				<li><a href="http://localhost/447967/client/products.php">Products</a></li>
				<li><a href="http://localhost/447967/client/orders.php">Your order</a></li>
				<li id="selected"><a href="http://localhost/447967/client/contactUs.php">Contact Us</a></li>
				<li><a href="http://localhost/447967/client/aboutUs.php">About Us</a></li>
			</ul>
		</div><!--tabs-->

		<div id="tabContent">
					
			<?php
				if (isset($_POST['submit'])){
					//open database 
					$connect = mysql_connect("localhost","root","") or die("Couldn't connect." . mysql_error());
					//select database
					mysql_select_db("myDatabase")or die("Couldn't select database." . mysql_error());
					
					$submit = $_POST['submit'];
					
					//Form data
					//The strip_tags is to prevent people trying to use html tags in the fields
					$fullName = strip_tags($_POST['fullName']);
					$email = strip_tags($_POST['email']);
					$message = strip_tags($_POST['message']);
					$typeOfMessage = strip_tags($_POST['typeOfMessage']);	
					
					//check for existance of all fields
					if($fullName&&$email&&$message&&$typeOfMessage!=='none'){
						//Registering the user into the database
						$queryreg = mysql_query("
						INSERT INTO messages VALUES('','$typeOfMessage','$fullName','$email','$message')
						");
						//Resets the form and variables
						$fullName = "";
						$email = "";
						$message = "";		
						//Personalised message display for each category
						if($typeOfMessage=='complaint'){
							echo "<h3>Your message has been successfully sent.</h3><br>
								  <p>We are sorry for any inconvinience that we caused you.</p>";
						} else if($typeOfMessage=='question'){
							echo "<h3>Your message has been successfully sent.</h3><br> 
								  <p>We will get in touch as soon as possible</p>";
						} else if($typeOfMessage=='positiveFeedback'){
							echo "<h3>Your message has been successfully sent.</h3><br> 
								  <p>Thank you for sharing your opinions with us! <br>:) Have a nice day.</p>";
						} else {
							echo "<h1>Your message has been successfully sent.</h1>"; 
						}
					} else {
						echo "<p>Please fill in <b><u>all</u></b> fields before sending the form!!<p/>";
					}
				
				} else {
					echo '
					<center><h1>Contact Us</h1></center>
					<h2>Do you want to send us a message?</h2>
					<p>Please select the reason of your message and fill the form.</p>
					<form action="contactUs.php" method="POST">
						<fieldset class="form">
							<label>Type Of Message:</label> 
							<select class="typing" name="typeOfMessage">
								<option value="none"></option>
								<option value="question">Question</option>
								<option value="complaint">Complaint</option>
								<option value="positiveFeedback">Positive Feedback</option>
								<option value="other">Other</option>
							</select>
							<label>Full name:</label> 
							<input class="typing" type="text" name="fullName" value="" size="35">
							
							<label>E-mail:</label> 
							<input class="typing" type="text" name="email" value="" size="35">
							
							<label>Message:</label> 
							<textarea rows="10" cols="30"input type="text" name="message"></textarea> 
						</fieldset>
						
						<fieldset class="form">
						<input class="btn" type="submit" name="submit" value="Send">
						</fieldset>
					</form>
					';
				}
			?>
			
				
				
			
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