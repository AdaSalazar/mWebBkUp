<!-- This is gonna create the database-->
<?php
	function databaseCreator(){
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
		//echo "<p>Connected</p>";
		
		if (!mysql_select_db($dbName)) {
			$query = ("CREATE DATABASE ".$dbName);
			mysql_query($query) or die('Couldn\'t create databases "'.$dbName.'"');
			echo '<p>Created database '.$dbName.'</p>';
			mysql_select_db($dbName, $connect);
			
			//I need the password part to be 100characters because I am using md5 encryption
			$createUsersTable = "CREATE TABLE usersT
			(
				userID int NOT NULL AUTO_INCREMENT,
				userName varchar(25) NOT NULL ,
				password varchar(100) NOT NULL ,
				uName varchar(35) NOT NULL ,
				uLastName varchar(35) NOT NULL ,
				userFriends int NOT NULL ,
				regDate date NOT NULL,
				PRIMARY KEY ( userID )
			)";
			mysql_query($createUsersTable,$connect) or die("Couldn't create 'usersT' table .<br>" . mysql_error());
			//test
			echo "table 'usersT' created.<br>";
			
			
			$createUserPageTable = "CREATE TABLE userPageT
			(
				uPageID int NOT NULL AUTO_INCREMENT,
				userID int NOT NULL ,
				uPage TEXT NOT NULL ,
				uProfilePic TEXT NOT NULL ,
				uAbout LONGTEXT NOT NULL ,
				uBanner TEXT NOT NULL ,
				uCSS TEXT NOT NULL ,
				PRIMARY KEY (uPageID),
				FOREIGN KEY (userID) REFERENCES usersT(userID)
			)";
			mysql_query($createUserPageTable,$connect) or die("Couldn't create 'userPageT' table .<br>" . mysql_error());
			//test
			echo "table 'userObjectT' created. <br>";
			
			$createVideosTable = "CREATE TABLE userObjectT
			(
				userObjectID int NOT NULL AUTO_INCREMENT,
				userID int NOT NULL ,
				userObjectTitle VARCHAR(100) NOT NULL ,
				userObjectLink MEDIUMTEXT NOT NULL ,
				userObjectDesc LONGTEXT NOT NULL ,
				userObjectKeywords TEXT NOT NULL ,
				userObjectType VARCHAR(3) NOT NULL ,
				PRIMARY KEY (userObjectID),
				FOREIGN KEY (userID) REFERENCES usersT(userID)
			)";
			mysql_query($createVideosTable,$connect) or die("Couldn't create 'userObjectT' table .<br>" . mysql_error());
			//test
			echo "table 'userObjectT' created. <br>";
			
			
			$createPicTutTable = "CREATE TABLE picTutorialT
			(
				userPicID int NOT NULL AUTO_INCREMENT,
				userID int NOT NULL ,
				picTutorialTitle VARCHAR(100) NOT NULL ,
				picTitle VARCHAR(100) NOT NULL ,
				picLink MEDIUMTEXT NOT NULL ,
				picDesc LONGTEXT NOT NULL ,
				tutorialKeywords TEXT NOT NULL ,
				picNum int NOT NULL ,
				PRIMARY KEY (userPicID),
				FOREIGN KEY (userID) REFERENCES usersT(userID)
			)";
			mysql_query($createPicTutTable,$connect) or die("Couldn't create 'picTutorialT' table .<br>" . mysql_error());
			//test
			echo "table 'picTutorialT' created. <br>";
			
			
			$createFriendsTable = "CREATE TABLE friendsT
			(
				friendshipID int NOT NULL AUTO_INCREMENT,
				userID int NOT NULL ,
				freindsID int NOT NULL ,
				PRIMARY KEY ( friendshipID ),
				FOREIGN KEY (userID) REFERENCES usersT(userID),
				FOREIGN KEY (freindsID) REFERENCES usersT(userID)
			)";
			mysql_query($createFriendsTable,$connect) or die("Couldn't create 'friendsT' table .<br>" . mysql_error());
			//test
			echo "table 'friendsT' created. <br>";
			
			$createSearchTable = "CREATE TABLE searchEngine
			(
				id int NOT NULL AUTO_INCREMENT,
				title varchar(50) NOT NULL,
				description text NOT NULL,
				price float NOT NULL,
				keywords varchar(200) NOT NULL,
				PRIMARY KEY ( id )
			)";
			mysql_query($createSearchTable,$connect) or die("Couldn't create 'searchengine' table .<br>" . mysql_error());
			//test
			echo "table 'Searchengine' created.<br>";
			
			//this will populate the table search engine with the items
			// $getProductInfo = mysql_query('SELECT pName, pDescription, pPrice  FROM products');
			// $numOfProducts = mysql_num_rows($getProductInfo);
			// if($numOfProducts>0){
				// while($get_row = mysql_fetch_assoc($getProductInfo)){
				
					// $titleVar = $get_row['pName'];
					// $descriptionVar = $get_row['pDescription'];
					// $priceVar = $get_row['pPrice'];
					// $keywords = $get_row['pName'].' '.strval($get_row['pPrice']) ;
					
					// $fillSearchEngine = mysql_query("
					// INSERT INTO searchengine VALUES('','$titleVar','$descriptionVar','$priceVar','$keywords')
					// ");
					
					// //test
					// //echo "Populating search engine table<br>";
				// }
			// }

		
		} else {
			//echo "<p>Database exists</p>" . mysql_error();
		}
	}
	
	function menuCreator($path){
		//Top menu labels
					$topMenuLabels = array("Home","MakeUp Basics","Gallery","Tutorials","Chat","Contact Us");
					//Top menu links (html files names)
					$htmlFile = array("index","makeupBasics","gallery","tutorials","chat","contactUs");
					
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
							echo '<a href="'.$path.$htmlFile[$topMenu].'.php">'.$topMenuLabels[$topMenu].'</a></li>';
							break;
						case 1:
							echo '<a href="'.$path.$htmlFile[$topMenu].'.php">'.$topMenuLabels[$topMenu].'</a>
								<ul>';
							$mbDropdownLabelsSize =count($mbDropdownLabels) - 1;
							//This is depending on how many links has the first drop down menu
							for ($dropDown1=0; $dropDown1<=$mbDropdownLabelsSize; $dropDown1++){
								echo '<li><a href="'.$path.$htmlFile[$topMenu].'.php#'.$mbDropdown[$dropDown1].'">'.$mbDropdownLabels[$dropDown1].'</a>
										<ul>';
								
								switch ($dropDown1) {
									case 0:
										$brushDdSize =count($brushDd) - 1;
										for ($dropDown2=0; $dropDown2<=$brushDdSize; $dropDown2++){
											echo '<li><a href="'.$path.$htmlFile[$topMenu].'.php#brush'.$brushDd[$dropDown2].'">'.$brushDd[$dropDown2].'</a></li>';
										}
										break;
									case 1:
										$prodDdSize =count($prodDd) - 1;
										for ($dropDown2=0; $dropDown2<=$prodDdSize; $dropDown2++){
											echo '<li><a href="'.$path.$htmlFile[$topMenu].'.php#prod'.$prodDd[$dropDown2].'">'.$prodDd[$dropDown2].'</a></li>';
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
							echo '<a href="'.$path.$htmlFile[$topMenu].'.php">'.$topMenuLabels[$topMenu].'</a></li>';
							break;
						case 3:
							echo '<a href="'.$path.$htmlFile[$topMenu].'.php">'.$topMenuLabels[$topMenu].'</a>
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
											echo '<li><a href="'.$path.$htmlFile[$topMenu].'.php#pic'.$vidTutDropdown[$dropDown2].'">'.$vidTutLabels[$dropDown2].'</a></li>';
										}
										break;
									case 1:
										$vidTutDropdownSize =count($vidTutDropdown) - 1;
										for ($dropDown2=0; $dropDown2<=$vidTutDropdownSize; $dropDown2++){
											echo '<li><a href="'.$path.$htmlFile[$topMenu].'.php#vid'.$vidTutDropdown[$dropDown2].'">'.$vidTutLabels[$dropDown2].'</a></li>';
										}
										break;
								}
								echo '	</ul>';
							}
							echo '
								</ul>
							</li>';
							break;
						case 4:
							echo '<a href="'.$path.$htmlFile[$topMenu].'.php?">'.$topMenuLabels[$topMenu].'</a></li>';
							break;
						case 5:
							echo '<a href="'.$path.$htmlFile[$topMenu].'.php?">'.$topMenuLabels[$topMenu].'</a></li>';
							break;
					}
				}  
				  echo   '
						 <!-- This is the search engine miniform-->
						
						<form action="../cms/search.php" method="GET">
							<div id="searchForm">  
								<input type="submit" name="submit" value="Search" class="button">
							</div>
							<div id="searchForm"> 
								<input type="text" size="15" name="search" class="box">
							</div>
						</form>
				   </ul>
			   </nav><!--tabs-->
					';
	}
	
	function loginBanner($path){
		echo'<div id="right">
			<img src="'.$path.'images/banner+logo.png" alt="Right brush image not available" align="left">
										
					<div class="miniSubMenu"> 
						<a href="index.php">Manage your page</a> <b>|</b> 
						<a href="video.php">Upload a Video</a> <b>|</b>  
						<a href="userpagemanager.php">Manage your Uploads</a>
					</div><!--minitabs-->	';
			/*	<a href="http://www.youtube.com/"><img src="'.$path.'images/youtube.png" height="25px" width="25px" ></a>
				<a href="https://twitter.com/"><img src="'.$path.'images/twitter.png" height="25px" width="25px" ></a>
				<a href="http://www.flickr.com/"><img src="'.$path.'images/flickr.png" height="25px" width="25px" ></a>
				<a href="https://www.facebook.com/"><img src="'.$path.'images/fb.png" height="25px" width="25px" ></a>	
			';*/
			//Sessions
			//session_start(); 
			//session_destroy();
			if(isset($_SESSION['username'])){
				//$sessionName = $_SESSION['username'];//This line is used for the cart.php
				echo '<div ><p class="login" >Welcome '.ucfirst ( $_SESSION['username']).'!!  <br/><a href="'.$path.'users/">Go to My Page</a><br/>';
				echo ' <small><sub>Not '.ucfirst ( $_SESSION['username']).'?? <br/>Please <a href="'.$path.'users/logout.php">Logout</a></sub></small></p>
				</div>
				';
			}else{
				//$sessionName = "Guest";<p class="login" ><a href="'.$path.'users/register.php">Register</a></p>
				
				echo '
			<br /><br />
				<form action="'.$path.'users/login.php" method="POST">
					<small>Username:</small><input type="text" size="13" name="usernameF" class="box" /><br/>
					<small>Password:</small><input type="password" size="13" name="password" class="box"/><br/>
					<input type="submit" value="Log in" name="login" class="blogin">
					<input type="submit" value="Register" name="register" class="blogin">
				</form>';	
			}
				
		echo'</div>';
	}
	
	function updateSearchEngine(){
				//this will populate the table search engine with the items
				$getVideoInfo = mysql_query('SELECT pName, pDescription, pPrice FROM Videos');
				$numOfVideos = mysql_num_rows($getVideoInfo);
				$cleanSearchEngineTable = mysql_query("
						TRUNCATE TABLE searchengine");
				if($numOfVideos>0){
					while($get_row = mysql_fetch_assoc($getVideoInfo)){
					
						$titleVar = $get_row['pName'];
						$descriptionVar = $get_row['pDescription'];
						$priceVar = $get_row['pPrice'];
						$keywords = $get_row['pName'].' '.strval($get_row['pPrice']) ;
						
						$fillSearchEngine = mysql_query("
						INSERT INTO searchengine VALUES('','$titleVar','$descriptionVar','$priceVar','$keywords')
						");
						
					}
				}
			}

	function cleanInput($input) {
		$search = array(
		'@<script[^>]*?>.*?</script>@si',   // Strip out javascript
		'@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
		'@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
		'@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
		);

		$output = preg_replace($search, '', $input);
		return $output;
	}		
	
	function sanitize($input) {
		if (is_array($input)) {
			foreach($input as $var=>$val) {
				$output[$var] = sanitize($val);
			}
		} else {
			$input = stripslashes($input);
			$input  = cleanInput($input);
			$output = mysql_real_escape_string($input);
			$output = removecharacters($output);
		}
		return $output;
	}
	function removecharacters($input){
		$cleaned = str_replace("/", "", $input);
		$cleaned = str_replace("'", "", $cleaned);
		$cleaned = str_replace("\\", "", $cleaned);
		$cleaned = filter_var($cleaned, FILTER_SANITIZE_STRING);
					
		return $cleaned;
	}	
	function dinamicCounter(){
echo'
								<script type="text/javascript">
									
									 window.onload = function() {
									 /* set your parameters( number to countdown from, pause between counts in milliseconds, 
									 function to execute when finished ) 	 */
									 startCountDown(30, 1000, myFunction("index.php"));
									 }
									function startCountDown(i, p, f) {
										 // store parameters
										 var pause = p;
										 var fn = f;
										 // make reference to div
										 var countDownObj = document.getElementById("countDown");
										 if (countDownObj == null) {
											 // error
											 alert("div not found, check your id");
											 // bail
											 return;
										 }
										 countDownObj.count = function(i) {
											 // write out count
											 countDownObj.innerHTML = i;
											 if (i == 0) {
												 // execute function
												 fn();
												 // stop
												 return;
											 }
											 setTimeout(function() {
												 // repeat
												 countDownObj.count(i - 1);
											 },
											 pause);
										 }
										 // set it going
										 countDownObj.count(i);
									 }

									 function myFunction(page) {
										//window.location.replace(page);
									 }
								</script>';
}	
			?>