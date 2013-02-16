
		<div id="topBanner">
			<div id="leftImg"><img src="images/banner+logo.png" alt="Right brush image not available"></div>
			<!--<div id="rightImg"><img class="brush" src="images/RBrush.png" align="right" alt="Right brush image not available"></div>
			<div id="centerImg"><img class="logo" src="images/Logo.png"  alt="Logo image not available"></div>
			<div id="leftImg"><img class="brush" src="images/LBrush.png" alt="Left brush image not available"></div>
			<div id="rightImg"></div>		-->
				<a href="http://www.youtube.com/"><img src="images/youtube.png" height="25px" width="25px" align="right"></a>
				<a href="https://twitter.com/"><img src="images/twitter.png" height="25px" width="25px" align="right"></a>
				<a href="http://www.flickr.com/"><img src="images/flickr.png" height="25px" width="25px" align="right"></a>
				<a href="https://www.facebook.com/"><img src="images/fb.png" height="25px" width="25px" align="right"></a>	
			<div id="right">
			<?php //Sessions
				session_start(); 
				//session_destroy();
				$displayerSelector = "";
				if(isset($_SESSION['username'])){
					$sessionName = $_SESSION['username'];//This line is used for the cart.php
					echo '<p class="login" >Welcome '.$_SESSION['username'].'!!  ';
					echo '<sub> <small>Not '.$_SESSION['username'].'?? Click <a href="/admin/logout.php">to Logout</a></sub></small></p> ';
				}else{
					$sessionName = 'Guest';
					echo '<p class="login" >Welcome! <br /> ';
					echo '<sub><small>Why not <a href="admin/login.php">Log in</a> or <a href="admin/register.php">Sign Up</a></sub></small>?</p> ';
				}
				require 'cms/databaseCreator.php';
			?>
			</div>
		</div>
		<!--creates the top menu -->				
			
				<?php //Menu Creator 
					//This is gonna create the database
					databaseCreator(); 
					//This creates the 
					//Top menu labels
					$topMenuLabels = array("Home","MakeUp Basics","Gallery","Tutorials");
					//Top menu links (html files names)
					$htmlFile = array("index","makeupBasics","gallery","tutorials");
					
					//first drop down menu
						//Make Up Basics drop down menu labels
						$mbDropdownLabels = array("Brushes for...","Products for...");
						//Make Up Basics drop down menu links 
						$mbDropdown = array("brushes","products");
					
						//second drop down menu	
							//Brushes drop down menu labels
							$brushDd = array("Face","Eyes");					
							//Products drop down menu labels
							$prodDd = array("Face","Eyes","Lips");
				
					//first drop down menu	
						//Tutorials drop down menu labels
						$tutDropdownLabels = array("Photo Tutorials","Video Tutorials");
						//Tutorials drop down menu links 
						$tutDropdown = array("photo","video");
							//Tutorials drop down menu labels
							$vidTutLabels = array("Quick Looks","Going Out Looks","Night Looks");
							//Tutorials drop down menu links 
							$vidTutDropdown = array("Quick","Goingout","Night");
					
					$currentFile = $_SERVER["PHP_SELF"];
					$parts = Explode('/', $currentFile);
					//this will just take the name of the file   start  end
					$tabName =  substr($parts[count($parts) - 1],  0,   -4);
				  /**/echo '
				   <nav>
						<ul>';
						$topMenuSize =count($topMenuLabels) - 1;
				//This depends on how many links are in the top menu  
				for ($topMenu=0; $topMenu<=$topMenuSize; $topMenu++){
				   //echo $htmlFile[$topMenu].'  '.$tabName;

					if (strcmp ($htmlFile[$topMenu],$tabName) == 0){
					 echo '<li class="selected">';
					} else {
					  echo '<li>';
					}        
					
					switch ($topMenu) {
						case 0:
							echo '<a href="'.$htmlFile[$topMenu].'.php">'.$topMenuLabels[$topMenu].'</a></li>';
							break;
						case 1:
							echo '<a href="'.$htmlFile[$topMenu].'.php">'.$topMenuLabels[$topMenu].'</a>
								<ul>';
							$mbDropdownLabelsSize =count($mbDropdownLabels) - 1;
							//This is depending on how many links has the first drop down menu
							for ($dropDown1=0; $dropDown1<=$mbDropdownLabelsSize; $dropDown1++){
								echo '<li><a href="'.$htmlFile[$topMenu].'.php#'.$mbDropdown[$dropDown1].'">'.$mbDropdownLabels[$dropDown1].'</a>
										<ul>';
								
								switch ($dropDown1) {
									case 0:
										$brushDdSize =count($brushDd) - 1;
										for ($dropDown2=0; $dropDown2<=$brushDdSize; $dropDown2++){
											echo '<li><a href="'.$htmlFile[$topMenu].'.php#brush'.$brushDd[$dropDown2].'">'.$brushDd[$dropDown2].'</a></li>';
										}
										break;
									case 1:
										$prodDdSize =count($prodDd) - 1;
										for ($dropDown2=0; $dropDown2<=$prodDdSize; $dropDown2++){
											echo '<li><a href="'.$htmlFile[$topMenu].'.php#prod'.$prodDd[$dropDown2].'">'.$prodDd[$dropDown2].'</a></li>';
										}
										break;
								}
								echo '	</ul>';
							}
							echo '
								</ul>
							</li>';
							break;
						case 2:
							echo '<a href="'.$htmlFile[$topMenu].'.php?adminEntryVerified">'.$topMenuLabels[$topMenu].'</a></li>';
							break;
						case 3:
							echo '<a href="'.$htmlFile[$topMenu].'.php">'.$topMenuLabels[$topMenu].'</a>
								<ul>';
									
							$tutDropdownLabelsSize =count($tutDropdownLabels) - 1;
							//This is depending on how many links has the first drop down menu
							for ($dropDown1=0; $dropDown1<=$tutDropdownLabelsSize; $dropDown1++){
								echo '<li><a href="'.$htmlFile[$topMenu].'.php#'.$tutDropdown[$dropDown1].'">'.$tutDropdownLabels[$dropDown1].'</a>
										<ul>';
								
								switch ($dropDown1) {
									case 0:
										$vidTutLabelsSize =count($vidTutLabels) - 1;							
										for ($dropDown2=0; $dropDown2<=$vidTutLabelsSize; $dropDown2++){
											echo '<li><a href="'.$htmlFile[$topMenu].'.php#pic'.$vidTutDropdown[$dropDown2].'">'.$vidTutLabels[$dropDown2].'</a></li>';
										}
										break;
									case 1:
										$vidTutDropdownSize =count($vidTutDropdown) - 1;
										for ($dropDown2=0; $dropDown2<=$vidTutDropdownSize; $dropDown2++){
											echo '<li><a href="'.$htmlFile[$topMenu].'.php#vid'.$vidTutDropdown[$dropDown2].'">'.$vidTutLabels[$dropDown2].'</a></li>';
										}
										break;
								}
								echo '	</ul>';
							}
							echo '
								</ul>
							</li>';
							break;
					}
				}  
				  echo   '<li>
						 <!-- This is the search engine miniform-->
					   <form action="../cms/search.php" method="GET">
							  <input type="text" size="15" name="search">
							 <input type="submit" name="submit" value="Search">
					   </form>
					 </li>
				   </ul>
			   </div><!--tabs-->
					';
				?>
				

<?php 	
	/*OLD  MENU VERSION
	//This will create the menu
	//$labels = array("HOME","MAKEUP BASICS","GALLERY","TUTORIALS");
	$labels = array("Home","MakeUp Basics","Gallery","Tutorials");
	$link = array("index","makeupBasics","gallery","tutorials");
	//$labels = array("","","","");

	//This gets the name of the page
	$currentFile = $_SERVER["PHP_SELF"];
	$parts = Explode('/', $currentFile);

	//this will just take the name of the file   start  end
	$tabName =  substr($parts[count($parts) - 1],  0,   -4);
	echo '
		<div id="tabs">';

	for ($i=0; $i<=3; $i++){
		//echo $link[$i].'  '.$tabName;
		if (strcmp ($link[$i],$tabName) == 0){
			echo '<div id="selected">';
		} else {
			echo '<div id="noSelected">';
		}				
		echo '<a href="'.$link[$i].'.php?adminEntryVerified">'.$labels[$i].'</a>
			<!-- <div id="dropDown"><a href="">2</a></div> -->
			</div>';
	}	
	echo 	'<div id="noSelected">
				<div id="sForm">
						<!-- This is the search engine miniform-->
					<form action="search.php" method="GET">
								<input type="text" size="15" name="search" class="searchBox">
								<input type="submit" name="submit" value="Search" class="searchButton">
					</form>
				</div>
			</div>
	</div><!--tabs-->
		';*/
				
?>
