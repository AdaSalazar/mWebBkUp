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
	
		<?php 
			require $path.'cms/functions.php';	
			databaseCreator();			
			loginBanner($path);
		?>
		<div id="menu">
			<?php menuCreator($path); $displayForm = true;?>
		</div>		


		<div id="tabContent">
			
			<?php
				if (isset($_POST['sendEmail'])){
					$sendEmail = $_POST['sendEmail'];
					//Getting data from the form
					//The strip_tags is to prevent people trying to use html tags in the fields
					//the paramcheck uses that function to check for sql injections
					$typeOfMessage = strip_tags($_POST['typeOfMessage']);				
					$fullName = strip_tags($_POST['fullName']);	
					$email = strip_tags($_POST['email']);
					$message = strip_tags($_POST['message']);
					
					//check for existance of all fields
					if($fullName&&$email&&$message){
						if($typeOfMessage!=='none'){

							echo "<h1 class='highlight'>Your message has been successfully sent.</h1>"; 
							
							//E-mail Information
							$header = "From: abi@salazar.com \r\nOriginating-IP: " . $_SERVER['REMOTE_ADDR'];
							$from = "From: <".$email.">\r\nOriginating-IP: <" . $_SERVER['REMOTE_ADDR']."> \r\n";
							$toEmail  = 'knewu@abisalazar.com';
							$subject = $typeOfMessage;
							// \n\r creates a New Line
							$finalMessage = $from."Subject: < ".$subject." >\r\nFullname: < ".$fullName." >\r\n\r\n Message: \r\n".$message;
						//	echo $toEmail.'<br>'.$subject.'<br>'.$finalMessage.'<br>'.$header;
							//sends the email
							mail($toEmail, $subject, $finalMessage, $header);
							
							$to = $email;
							$subject = 'Thank you for your e-mail.';
							$body = "Thank you for your e-mail, I will be in contact as soon as possible.";
							$headers = 'From: Do-not-reply@abisalazar.com';

							mail($to, $subject, $body, $headers);
							
							$displayForm = false;
							
						} else {
							echo '<p class="highlightbad">Please select a type of message before submiting!!<p/>';
						}	
					} else {
						echo '<p class="highlightbad">Please fill in <b><u>all</u></b> fields before sending the form!!<p/>';
					}	
					
				
				}
				if($displayForm){
				echo '
					
					<h2>Do you want to send me a message?</h2>
					<p><strong>Please select the reason of your message and fill the form.</strong></p>
					
					<form action="contactUs.php" method="POST">
					
						<fieldset class="form">

							<label>Type Of Message:</label> 
							<select class="box" name="typeOfMessage" required="required">
								<option value="none" ></option>
								<option value="Question">Question</option>
								<option value="Feedback">Feedback</option>
								<option value="Other">Other</option>
							</select>
							
							<label>Full name:</label> 
							<input class="box" type="text" name="fullName" value="" size="35" required="required">
							
							<label>E-mail:</label> 
							<input class="box" type="text" name="email" value="" size="35" required="required">
							
							<label>Message:</label> 
							<textarea rows="10" cols="30" input type="text" name="message"></textarea> 

						</fieldset>
						
						<fieldset class="form">
						<input class="button" type="submit" name="sendEmail" value="Send">
						</fieldset>
						
					</form>
					
					';
				}
				//Resets the form and variables
						$fullName = "";
						$email = "";
						$message = "";		
						$companyName = "";
						$phoneNumber = "";
	
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