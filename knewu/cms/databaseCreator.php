<!-- This is gonna create the database-->
<?php
	function databaseCreator(){
		$connect = mysql_connect("localhost","root","") or die("Couldn't connect." . mysql_error());
		
		//echo "<p>Connected</p>";
		
		if (!mysql_select_db("knewUDB")) {
			$query = ("CREATE DATABASE knewUDB");
			mysql_query($query) or die("Couldn't create databases 'knewUDB'");
			echo "Created database 'knewUDB'<p>";
			mysql_select_db("knewUDB", $connect);
			
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
			
			
			$createVideosTable = "CREATE TABLE userObjectT
			(
				userObjectID int NOT NULL AUTO_INCREMENT,
				userID int NOT NULL ,
				userObjectTitle varchar(100) NOT NULL ,
				userObjectLink mediumtext NOT NULL ,
				userObject LONGBLOB NOT NULL,
				userObjectDesc text NOT NULL ,
				userObjectKeywords varchar(100) NOT NULL ,
				PRIMARY KEY (userObjectID),
				FOREIGN KEY (userID) REFERENCES usersT(userID)
			)";
			mysql_query($createVideosTable,$connect) or die("Couldn't create 'userObjectT' table .<br>" . mysql_error());
			//test
			echo "table 'userObjectT' created. <br>";
			
			$createProductsTable = "CREATE TABLE friendsT
			(
				friendshipID int NOT NULL AUTO_INCREMENT,
				userID int NOT NULL ,
				freindsID int NOT NULL ,
				PRIMARY KEY ( friendshipID ),
				FOREIGN KEY (userID) REFERENCES usersT(userID),
				FOREIGN KEY (freindsID) REFERENCES usersT(userID)
			)";
			mysql_query($createProductsTable,$connect) or die("Couldn't create 'friendsT' table .<br>" . mysql_error());
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
			echo "<p>Database exists</p>" . mysql_error();
		}
	}
	//databaseCreator();
?>