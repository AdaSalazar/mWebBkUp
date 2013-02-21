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
					<center><h1>Upload a video to my channel</h1>
					<p>Please select a way to upload a video to your channel:</p>
					</center>
					
					<form action="video.php" method="POST">
						<fieldset>
							<input class="button" name="computer" type="submit" value="computer vid">
							<input class="button" name="link" type="submit" value="link vid">
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
							/*echo '
								<form action="video.php" method="POST" enctype="multipart/formdata">
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
								</form>';	*/
								echo '
								<form action="video.php" method="post" enctype="multipart/form-data">
								 <label for="file">Filename:</label>
								 <input type="file" name="xfile" id="file"><br>
								 <input type="submit" name="uploadingVideo" value="Submit">
								 </form>
								';
							echo '	
							';							
							break;
						
						
						case "link":
							echo "link";
							break;
						
						
						case "uploading":
							echo "uploading";
							
							
								if ($_FILES["xfile"]["error"] > 0){
								echo "Error: " . $_FILES["xfile"]["error"] . "<br>";
							} else {
								echo "Upload: " . $_FILES["xfile"]["name"] . "<br>";
								echo "Type: " . $_FILES["xfile"]["type"] . "<br>";
								echo "Size: " . ($_FILES["xfile"]["size"] / 1024) . " kB<br>";
								echo "Size: " . $_FILES["xfile"]["size"]  . " <br>";
								echo "Stored in: " . $_FILES["xfile"]["tmp_name"] . "<br>";
							}
							$userName = $_SESSION['username'];
							$target = "uploads/".$userName."/"; 
							if (!is_dir($target)) {
								mkdir($target);
							}
							 
 $target = $target . basename( $_FILES['xfile']['name']) ; 
 $ok=1; 
 
 //This is our size condition 
 /*if ($uploaded_size > 99999999) { 
	 echo "Your file is too large.<br>"; 
	 $ok=0; 
 }*/ 
 
 //This is our limit file type condition 
 if ($_FILES["xfile"]["type"] =="text/php") { 
	 echo "No PHP files<br>"; 
	 $ok=0; 
 } 
 
 //Here we check that $ok was not set to 0 by an error 
 if ($ok==0) { 
	echo "Sorry your file was not uploaded"; 
 } else { //If everything is ok we try to upload it 
	 if(move_uploaded_file($_FILES['xfile']['tmp_name'], $target)) { 
		echo "<br>The file ". basename( $_FILES['xfile']['name']). " has been uploaded"; 
	 } else { 
		echo "Sorry, there was a problem uploading your file."; 
	 } 
 } 
						/*	$userName = $_SESSION['username'];
							$VideoTitle = htmlentities($_POST['vTitle']);
							$VideoDescription = htmlentities($_POST['vDescription']);
							$VideoTags = htmlentities($_POST['vTags']);
							$Video = htmlentities($_POST['video']);
							echo $userName.'<br>'.$VideoTitle.'<br>'.$VideoDescription.'<br>'.$VideoTags;
							//file properties
							$file = $_FILES['video']['tmp_name'];
							
							
						
							//this gets the data of the image inside of the varible
							$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));	
							//the addslashes helps to prevent sql injection because thise is going to be stored in the database
							$image_name = addslashes($_FILES['image']['name']);				
							$image_size = getimagesize($_FILES['image']['tmp_name']);
							
							//if is not an image then...
							if($image_size==FALSE){
								echo '<p class="highlightbad">That is not an image!</p>';
							} else {
								if($VideoPrice!=0&&$VideoQty!=0){
									if(!$addingNewItem = mysql_query("INSERT INTO Vclasseos VALUES('','$VclasseoName','$VclasseoDescription','$VclasseoPrice','$VclasseoQty','$image_name','$image')")){
										echo '<p class="highlightbad">Problem uploading image! <br>
											Please ensure that the text doesn\'t have single quotes!</p>';	
									} else {
										echo '<p class="highlight">New Vclasseo has been added sucessfully!</p>';
										//updateSearchEngine();
									}
								
								} else {
									echo '<p class="highlightbad">Please insert a valclass Vclasseo price and Vclasseo quantity.</p>';
								}
						
							
							}*/
						 /*else {
							echo '<p class="highlightbad">Please fill in <b>All</b> the fields before submiting.</p>';
						}*/
							break;
						default:
							echo "Default";
					}
					

				}//logged in else
				
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