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
					<center><h1>Upload a video to my channel</h1></center>';
					
					
					
					if (isset($_POST['uploadSelection'])){	
						$typeOfUpload =$_POST['typeOfUpload'];						
						$displayChooser = false;
						$displayForm = true; //displays the uploading form
						
					} /*else {
						echo '<p class="highlightbad">Please select a type of upload!!<p/>';
					}//if uploadselection*/
					
					//selects if the first form should be displayed
					if($displayChooser){
						echo '		<br>
							<p>Please select one of the following options: </p>						
							
							<form action="video.php" method="POST">
						
							<fieldset class="form">

								<label>How do you want to upload your video?:</label> 
								<select class="box" name="typeOfUpload" required="required">
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
					
					
					
					
					if($displayForm){
						echo $typeOfUpload.'<br>';	
						//according to which method is selected, displays two different forms.
						
						if(isset($_POST['uploadingVideo'])){	
							$nVideoTitle = $_POST['vTitle'];
							$nVideoDescription = $_POST['vDescription'];
							$nVideoTags = $_POST['vtags'];
						} else {
							$nVideoTitle = '';
							$nVideoDescription = '';
							$nVideoTags = '';
						}
						echo '
							<form action="video.php" method="POST" enctype="multipart/formdata">
								<fieldset class="form">
									<label>Type a <b>Title</b> for your video:</label>  
									<input class="box" type="text" required="required" size="20" name="vTitle" value="'.$nVideoTitle.'">
									
									<label>Select a <b>Video</b> from your computer:</label>  
									<input class="box" type="file" required="required" name="video"> 
										
									<label>Type <b>description</b> for your video:</label>  
									<textarea class="box" required="required" rows="5" cols="16" name="vDescription">'.$nVideoDescription.'</textarea> 
									
									<label>Type some keywords/tags for your video to be able to find it using the Search:</label>  
									<input class="box" type="text" size="20" required="required" name="vTags" value="'.$nVideoTags.'">
													
								</fieldset>
								
								<fieldset>
									<input class="button" name="uploadingVideo" type="submit" value="Add New Video">
								</fieldset>
							</form>';
							
					}
					
						
							//This is going to deal with the Add New Video click
					if(isset($_POST['uploadingVideo'])){
						$displayChooser = false;
							$displayForm = true; //displays the uploading form
						$userName = $_SESSION['username'];
						$VideoTitle = htmlentities($_POST['vTitle']);
						$VideoDescription = htmlentities($_POST['vDescription']);
						$VideoTags = htmlentities($_POST['vTags']);
						$Video = htmlentities($_POST['video']);
						echo $userName.'<br>'.$VideoTitle.'<br>'.$VideoDescription.'<br>'.$VideoTags;
						//file properties
						//$file = $_FILES['image']['tmp_name'];
						
						//if($VideoTitle&&$VideoDescription&&$file){
						if($VideoTitle&&$VideoDescription&&$VideoTags){
							//this gets the data of the image inside of the varible
						/*	$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));	
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
						} else {
							echo '<p class="highlightbad">Please fill in <b>All</b> the fields before submiting.</p>';
						}
					
					
					
					
					}//display form
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