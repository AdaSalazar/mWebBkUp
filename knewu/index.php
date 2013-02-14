
<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
	<meta http-equiv="Default-Style" content="Main">
	<title>kNewU</title>
	<!--This part does the styles switcher-->
	<link rel="stylesheet" type="text/css" title="Main" 
	href="css/main.css">
	<link rel="alternate stylesheet" type="text/css" title="High Contrast" 
	href="css/highContrast.css">
	<script type="text/javascript" src="../files/javascripts/styleswitcher.js"></script>
</head>

<body>
	<div id="wrapper">
	<!-- Places the images on top-->
		<?php require 'cms/sesionStarter.php'?>
		<?php 
						//This is gonna create the database
						databaseCreator(); 
						
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
						/*	echo '
							<nav>';
						
						for ($i=0; $i<=3; $i++){
							//echo $link[$i].'  '.$tabName;
							if (strcmp ($link[$i],$tabName) == 0){
								echo '<ul>';
							} else {
								echo '<ul>';
							}			
							echo '<li><a href="'.$link[$i].'.php?adminEntryVerified">'.$labels[$i].'</a></li>
								<ul>
									<li><a href="">adf</a></li>
									<li><a href="">5</a></li>
								</ul>
								';
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
						</ul></nav><!--tabs-->
							';*/
					?>
		
		
		<div id="content">
		
		
	<?php
		echo "testing dropdown<br/><br/><br/>";
		//Top menu labels
		$topMenuLabels = array("Home","MakeUp Basics","Gallery","Tutorials");
		//Top menu links (html files names)
		$htmlFile = array("index","makeupBasics","gallery","tutorials");
		
		//first drop down menu
			//Make Up Basics drop down menu labels
			$mbDropdownLabels = array("Brushes for...","Products for");
			//Make Up Basics drop down menu links 
			$mbDropdown = array("brushes","products");
		
			//second drop down menu	
				//Brushes drop down menu labels
				$brushDdLbl = array("Face","Eyes");
				//Brushes drop down menu links 
				$brushDd = array("bFace","bEyes");		
				
				//Products drop down menu labels
				$prodDdLbl = array("Face","Eyes","Lips");
				//Products drop down menu links 
				$prodDd = array("pFace","pEyes","pLips");
	
		//first drop down menu	
			//Tutorials drop down menu labels
			$tutDropdownLabels = array("Photo Tutorials","Video Tutorials");
			//Tutorials drop down menu links 
			$tutDropdown = array("photo","video");
				//Tutorials drop down menu labels
				$vidTutLabels = array("Quick Looks","Going Out Looks","Night Looks");
				//Tutorials drop down menu links 
				$vidTutDropdown = array("quick","goingout","night");
		
		$currentFile = $_SERVER["PHP_SELF"];
		$parts = Explode('/', $currentFile);
		//this will just take the name of the file   start  end
		$tabName =  substr($parts[count($parts) - 1],  0,   -4);
      /**/echo '
       <nav>
			<ul>';
      
      for ($i=0; $i<=3; $i++){
       //echo $htmlFile[$i].'  '.$tabName;
	   
		switch ($i) {
			case 0:
				echo "i equals 0";
				break;
			case 1:
				echo "i equals 1";
				break;
			case 2:
				echo "i equals 2";
				break;
		}
	   
         if (strcmp ($htmlFile[$i],$tabName) == 0){
         echo '<li id="selected">';
        } else {
          echo '<li>';
        }        
        echo '<a href="'.$htmlFile[$i].'.php?adminEntryVerified">'.$topMenuLabels[$i].'</a></li>';
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
        ';/**/
		?>
		<nav>
			<ul>
				<li><a href="#" class="SelectedX">Home</a></li>
				<li><a href="#" class="noselectedX">MakeUp Basics</a>
					<ul>
						<li><a href="#">Brushes for..</a>
							<ul>
								<li><a href="#">Face</a></li>
								<li><a href="#">Eyes</a></li>
							</ul>
						</li>
						<li><a href="#">Products for..</a>
							<ul>
								<li><a href="#">Face</a></li>
								<li><a href="#">Eyes</a></li>
								<li><a href="#">Lips</a></li>
							</ul>
						</li>
					</ul>
				</li>
				<li><a href="#" class="noselectedX">Gallery</a>	</li>
				<li><a href="#" class="noselectedX">Tutorials</a>
					<ul>
						<li><a href="#">Photo Tutorials</a></li>
						<li><a href="#">Video Tutorials</a>
							<ul>
								<li><a href="#">Quick Looks</a></li>
								<li><a href="#">Going Out Looks</a></li>
								<li><a href="#">Night Looks</a></li>
							</ul>
						</li>
					</ul>
				</li>
			</ul>
		</nav>
			<p>Content 
				<br>
				<br>
				text
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				
				
				<br>
				end
			</p>
		</div><!--content-->
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