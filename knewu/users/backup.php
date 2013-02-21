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
			<?php menuCreator($path); $displayChooser = true; $displayForm = true; $uType = false;?>
		</div>		

		<div id="tabContent"><!--This creates what goes inside the 'usertabs' in the website-->
			<?php 
				if($sessionName == 'Guest'){
					echo '<p>You can\'t upload a video if you are not loged in!! <br> Please log in first.</p>';
				} else {
					//Menu
					echo '							
					<div class="subMenu"> 
						<ul>					
							<li id="nonsel"><a href="index.php">Manage Your Page</a></li>
							<li id="sel"><a href="video.php">Upload a Video</a></li>
							<li id="nonsel"><a href="photo.php">Upload a Photo</a></li>
							<li id="nonsel"><a href="userspage.php">View my Page</a></li>
						</ul>
					</div><!--tabs-->
					<br />
					<br />
					<center><h1>Upload a video to my channel</h1></center>';
					if (isset($_POST['uploadSelection'])){	
						$typeOfUpload =$_POST['typeOfUpload'];	
						if($typeOfUpload!='none'){
							$displayChooser = false;
							$uType = true;
							
							//according to which method is selected, displays two different forms.
						//	switch ($typeOfUpload) {
							//	case "computer":
									echo '';
									if(isset($_POST['uploadingVideo'])){	
										$nVideoTitle = $_POST['vTitle'];
										$nVideoDescription = $_POST['vDescription'];
										$nVideo = $_POST['video'];
										$nVideoTags = $_POST['vTags'];
									} else {
										$nVideoTitle = '';
										$nVideoDescription = '';
										$nVideo = '';
										$nVideoTags = '';
									}
									echo '
										<form action="video.php" method="POST" enctype="multipart/formdata">
											<fieldset class="form">
												<label>Type a <b>Title</b> for your video:</label>  
												<input class="box" type="text" size="20" name="vTitle" value="'.$nVideoTitle.'">
												
												<label>Select a <b>Video</b> from your computer:</label>  
												<input class="box" type="file" name="video"> 
													
												<label>Type <b>description</b> for your video:</label>  
												<textarea class="box" rows="5" cols="16" name="vDescription">'.$nVideoDescription.'</textarea> 
												
												<label>Type some keywords/tags for your video to be able to find it using the Search:</label>  
												<input class="box" type="text" size="20" name="vTags" value="'.$nVideoTags.'">
																
											</fieldset>
											
											<fieldset>
												<input class="button" name="uploadingVideo" type="submit" value="Add New Video">
											</fieldset>
										</form>';
											
										//This is going to deal with the Add New Video click
										if(isset($_POST['uploadingVideo'])){
											$userName = $_SESSION['username'];											
											$VideoTitle = $_POST['vTitle'];
											$VideoDescription = $_POST['vDescription'];
											$Video = $_POST['video'];
											$VideoTags = $_POST['vTags'];
											//file properties
											$file = $_FILES['video']['tmp_name'];
											
											if($VideoTitle&&$VideoDescription&&$file&&$VideoTags){
												//this gets the data of the Video inside of the varible
												$Video = addslashes(file_get_contents($_FILES['Video']['tmp_name']));	
												//the addslashes helps to prevent sql injection because thise is going to be stored in the database
												$Video_name = addslashes($_FILES['video']['name']);				
												$Video_size = filesize($_FILES['video']['tmp_name']);
												
												if ($_FILES["video"]["error"] > 0) {
													echo "Error: " . $_FILES["video"]["error"] . "<br>";
												} else {
												   echo "Upload: " . $_FILES["video"]["name"] . "<br>";
												   echo "Type: " . $_FILES["video"]["type"] . "<br>";
												   echo "Size: " . ($_FILES["video"]["size"] / 1024) . " kB<br>";
												   echo "Stored in: " . $_FILES["video"]["tmp_name"];
												}
												/*
												//if is not an Video then...
												if($Video_size==FALSE){
													echo '<div id="highlightbad">That is not an Video!</div>';
												} else {
													if($VideoPrice!=0&&$VideoQty!=0){
														if(!$addingNewItem = mysql_query("INSERT INTO Videos VALUES('','$VideoName','$VideoDescription','$VideoPrice','$VideoQty','$Video_name','$Video')")){
															echo '<div id="highlightbad">Problem uploading Video! <br>
																Please ensure that the text doesn\'t have single quotes!</div>';	
														} else {
															echo '<div id="highlight">New Video has been added sucessfully!</div>';
															updateSearchEngine();
														}
													
													} else {
														echo '<div id="highlightbad">Please insert a valid Video price and Video quantity.</div>';
													}
												}
											*/
												
											} else {
												echo '<div id="highlightbad">Please fill in <b>All</b> the fields before submiting.</div>';
											}
										}
									
								//	break;
							//	case "link":
								//	echo '';
									
									
									//break;
								/*case "":
									echo '';
									break;*/
								
							}
							
						} else {
							echo '<p class="highlightbad">Please select a type of upload!!<p/>';
						}
						
					//}
					
					//selects if the first form should be displayed
					if($displayChooser){
						echo '		<br>
							<p>Please select one of the following options: </p>						
							
							<form action="video.php" method="POST">
						
							<fieldset class="form">

								<label>How do you want to upload your video?:</label> 
								<select class="box" name="typeOfUpload" required="required">
									<option value="none"></option>
									<option value="computer">Upload a video from My Computer</option>
									<option value="link">Upload a video using a link from another website (such as YouTube) </option>
								</select>
								
							</fieldset>
							
							<fieldset class="form">
							<input class="button" type="submit" name="uploadSelection" value="Send">
							</fieldset>
							
						</form>
						';
					}
					
				}
				/*
				
				echo '
										<form action="video.php" method="POST" enctype="multipart/formdata">
											<fieldset class="form">
												<label>Type a <b>Title</b> for your video:</label>  
												<input class="box" type="text" size="20" name="vTitle" value="">
												
												<label>Select a <b>Video</b> from your computer:</label>  
												<input class="box" type="file" name="video"> 
													
												<label>Type <b>description</b> for your video:</label>  
												<textarea class="box" rows="5" cols="16" name="vDescription"></textarea> 
												
												<label>Type some keywords/tags for your video to be able to find it using the Search:</label>  
												<input class="box" type="text" size="20" name="vTags" value="">
																
											</fieldset>
											
											<fieldset>
												<input class="button" name="uploadingVideo" type="submit" value="Add New Video">
											</fieldset>
										</form>';
						//This is going to deal with the Add New Video click
										if(isset($_POST['uploadingVideo'])){
											$userName = $_SESSION['username'];											
											$VideoTitle = $_POST['vTitle'];
											$VideoDescription = $_POST['vDescription'];
											$Video = $_POST['video'];
											$VideoTags = $_POST['vTags'];
											//file properties
											$file = $_FILES['video']['tmp_name'];
											
											if($VideoTitle&&$VideoDescription&&$file&&$VideoTags){
												//this gets the data of the Video inside of the varible
												$Video = addslashes(file_get_contents($_FILES['Video']['tmp_name']));	
												//the addslashes helps to prevent sql injection because thise is going to be stored in the database
												$Video_name = addslashes($_FILES['video']['name']);				
												$Video_size = filesize($_FILES['video']['tmp_name']);
												
												if ($_FILES["video"]["error"] > 0) {
													echo "Error: " . $_FILES["video"]["error"] . "<br>";
												} else {
												   echo "Upload: " . $_FILES["video"]["name"] . "<br>";
												   echo "Type: " . $_FILES["video"]["type"] . "<br>";
												   echo "Size: " . ($_FILES["video"]["size"] / 1024) . " kB<br>";
												   echo "Stored in: " . $_FILES["video"]["tmp_name"];
												}
											}
										}*/
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