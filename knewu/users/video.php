<?php 
	$path="../";
	require $path.'cms/sessionStarter.php';	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
	<title>Upload Video - kNewU</title>
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
			<?php menuCreator($path); 
				$displayChooser = true; 
				$displayForm = false;
			?>
		</div>		

		<div id="tabContent"><!--This creates what goes inside the 'usertabs' in the website-->
			<?php 
				if($sessionName == 'Guest'){
					echo '<p>You can\'t upload a video if you are not loged in!! <br> Please log in first.</p>';
				} else {
					//Menu
					$userName = str_replace(" ", "_", $_SESSION['username']);
					echo '							
					<div class="subMenu"> 
						<ul>					
							<li id="nonsel"><a href="editpage.php">Manage Your Page</a></li>
							<li id="sel"><a href="video.php">Upload a Video</a></li>
							<li id="nonsel"><a href="photo.php">Upload a Photo</a></li>
							<li id="nonsel"><a href="ptutorial.php">Upload a photo tutorial </a></li>
							<li id="nonsel"><a href="userpagemanager.php">Manage Your Uploads</a></li>
							<li id="nonsel"><a href="user.php?username='.$userName.'">Preview your user page </a></li>
						</ul>
					</div><!--tabs-->
					<br />
					<br />
					<center><h1>Upload a video to my channel</h1>
					<p>Please select a way to upload a video to your channel:</p>
					</center>
					
					<form action="video.php" method="POST" align="center">
						<fieldset>
							<input class="button" name="computer" type="submit" value="Upload a video from your computer to your page.">
							<input class="button" name="link" type="submit" value="Add a video from an online source (as yourtube) to your page.">
						</fieldset>
					</form>
					
					';
					//$test1 = isset($_POST['computer']);
					
					//$test2 = isset($_POST['link']);
					
					if(isset($_POST['computer'])){
						$formSelector = "computer";
					}else if(isset($_POST['link'])){
						$formSelector = "link";
					} else if(isset($_POST['uploadingVideo'])){
						$formSelector = "uploading";
					} else {
						$formSelector = "";
					}
					
					switch ($formSelector) {
						case "computer":
							echo '
								<form action="video.php" method="POST" enctype="multipart/form-data">
									<fieldset class="form">
										<label>Type a <b>Title</b> for your video:</label>  
										<input class="box" type="text" required="required" size="20" name="vTitle" value="">
										
										<label>Select a <b>Video</b> from your computer:</label>  
										<input class="box" type="file" required="required" name="video"> 
											
										<label>Type <b>description</b> for your video:</label>  
										<textarea class="box" required="required" rows="5" cols="16" name="vDescription"></textarea> 
										
										<label>Type some keywords/tags for your video to be able to find it using the Search:</label>  
										<input class="box" type="text" size="20" required="required" name="vTags" value="">
														
									</fieldset>
									
									<fieldset>
										<input class="button" name="uploadingVideo" type="submit" value="Upload Video">
									</fieldset>
								</form>
								<p>Please remember that the <b>maximum</b> file size is <strong>127MB</strong></p>';
								/*echo '
								<form action="video.php" method="post" enctype="multipart/form-data">
								 <label for="file">Filename:</label>
								 <input type="file" name="video" id="file"><br>
								 <input type="submit" name="uploadingVideo" value="Submit">
								 </form>
								';		*/			
							break;
						
						
						case "link":
							//filter_var($_POST['videourl'], FILTER_SANITIZE_URL);  
							//filter_var($page, FILTER_VALIDATE_URL)
							echo "link";
							break;
						
						
						case "uploading":
							//This checks if there is any errors
							if ($_FILES["video"]["error"] > 0){
								echo "Error: " . $_FILES["video"]["error"] . "<br>";
							} else {
								$videoName = str_replace(" ", "_", $_FILES["video"]["name"]);
								$videoType = $_FILES["video"]["type"];
								$videoSize = number_format((($_FILES["video"]["size"] / 1024)/1024), 3);//number_format changes it to 3 decimal places
								//echo "Stored in: " . $_FILES["video"]["tmp_name"] . "<br>";
							}
							
							
							
							//Finds if the type of file contains the word video
							$isVideo = strpos($videoType, "video");
							//This is our limit file type condition 
							if($isVideo===false){
								$validVideoFiles = array("AVI,", "MP4,", "FLV,", "MOV,", "MPEG,", "WMV,", "3GPP,", "DIVX", ".");
								$types ="";
								foreach($validVideoFiles as $type){
									$types = $types.$type." ";
								}
								echo "<p class='highlightbad'>Please select a <b>video file</b>, the accepted file types are:<br /> $types </p>";
								//print_r ($validVideoFiles);
								$ok = "false"; ;
							} else {
								$ok = "true";
								$userName = str_replace(" ", "_", $_SESSION['username']);
								$videoPath = "uploads/".$userName."/videos/"; 

								if (!is_dir($videoPath)) {
									//Pathname, mode (ignored on windows), recursive (nested directories)
									mkdir($videoPath, 0777, true);
								}
								
								$videoPath = $videoPath . basename( $_FILES['video']['name']) ; 
								 //This is our size condition 
								/**/ 
								if ($videoSize > 127) { 
								 echo "<p class='highlightbad'>Your file is too large.</p>"; 
								 $ok = "false"; 
								}
								//Here we check that $ok was not set to FALSE by an error 
								if ($ok=="false") { 
									echo "<p class='highlightbad'>Sorry your file was not uploaded.</p>"; 
								} else { 
									//If everything is ok we try to upload it 
									if(!move_uploaded_file($_FILES['video']['tmp_name'], $videoPath)) { 
										echo "<p class='highlightbad'>Sorry, there was a problem uploading your file.</p>"; 
									} else { 
										//This sanitazes the data
										$VideoTitle =  mysql_real_escape_string(filter_var($_POST['vTitle'], FILTER_SANITIZE_STRING));
										$VideoDescription = mysql_real_escape_string(filter_var($_POST['vDescription'], FILTER_SANITIZE_STRING));
										$VideoTags = mysql_real_escape_string(filter_var($_POST['vTags'], FILTER_SANITIZE_STRING));
										//adding the users part to the path
										$videoPath = 'users/'.$videoPath;
										echo $userName.'<br>'.$VideoTitle.'<br>'.$VideoDescription.'<br>'.$VideoTags;
										$userName = $_SESSION['username'];
										$getUserID = mysql_query('SELECT userID FROM usersT WHERE userName =\''.$userName.'\';');					
										
										//echo 'SELECT userID FROM usersT WHERE userName =\''.$userName.'\';';
										$countRecords = mysql_num_rows($getUserID);
										//If the username is taken displays a message if not continue with the registration
										if($countRecords!=0){
											$userID = "";
											while ($get_row = mysql_fetch_assoc($getUserID)){
												$userID = $get_row['userID'];
											} 				
										}
										
										echo '<br>'.$videoPath;
										
										if(!$addingVideo = mysql_query("INSERT INTO userObjectT VALUES('','$userID','$VideoTitle','$videoPath','$VideoDescription','$VideoTags','VID')")){
											echo '<p class="highlightbad">Problem uploading the video!</p>';	
										} else {
											echo "<h3>File information:</h3><p><strong>Filename:</strong> " .$videoName. "<br> 
											<strong>Type: </strong>" .$videoType. "<br> <strong>Size:</strong> " .$videoSize. " MB<br></p>";
											echo "<p class='highlight'>The file has been uploaded sucessfully!.</p>"; 
											//updateSearchEngine();
										};/**/
										
										
									} 
								} 
							
							}
							
							
							
					
							break;
						default:
							echo "Default";
					}
					

				}//logged in else
				
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