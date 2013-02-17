		<div id="right">
			<img src="images/banner+logo.png" alt="Right brush image not available" align="left">
			
				<a href="http://www.youtube.com/"><img src="images/youtube.png" height="25px" width="25px" ></a>
				<a href="https://twitter.com/"><img src="images/twitter.png" height="25px" width="25px" ></a>
				<a href="http://www.flickr.com/"><img src="images/flickr.png" height="25px" width="25px" ></a>
				<a href="https://www.facebook.com/"><img src="images/fb.png" height="25px" width="25px" ></a>	
			
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
				require 'cms/functions.php';
			?>
		</div>
		
		<div id="menu">
			<!--creates the top menu -->	
				<?php 
					//This is gonna create the database
					databaseCreator(); 
					//This creates the menu requires functions.php
					menuCreator(); 	
				?>
		</div>		
