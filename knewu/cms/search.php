<?php 
	//require 'sesion&loginStarter.php';
	require 'cart.php';
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
	<meta http-equiv="Default-Style" content="Main">
	<title>Search Engine</title>
	<!--This part does the styles switcher-->
	<link rel="stylesheet" type="text/css" title="Main" 
	href="../files/css/main.css">
	<link rel="alternate stylesheet" type="text/css" title="High Contrast" 
	href="../files/css/highContrast.css">
	<script type="text/javascript" src="../files/javascripts/styleswitcher.js"></script>
</head>

<body>
	<div id="wrapper">
		<center><h1>Search Engine</h1></center>

		<div id="tabs"> 
			<ul>
				<li><a href="../client/index.php">Home</a></li>
				<li><a href="../client/products.php">Products</a></li>
				<li><a href="../client/orders.php">Your order</a></li>
				<li><a href="../client/contactUs.php">Contact Us</a></li>
				<li><a href="../client/aboutUs.php">About Us</a></li>
			</ul>
		</div><!--tabs-->

		<div id="tabContent">
			
			<?php
				$construct = "";
				$x = 0;
				//$runrows = "";

				//get the data from the form
				if(!isset($button)){
					$button = $_GET['submit'];
				}
				if(!isset($search)){
					$search = $_GET['search'];
				}
				
				
				if(!$button){
					echo "You did not submit a keyword!!"; 
				} else {
					if(strlen($search)<2){
						echo "Search term is too short.<br><br>";
					} else {
						echo "<h2>You searched for <u>$search</u> <hr size='1'></h2>";
						
						$connect = mysql_connect("localhost","root","") or die("Couldn't connect." . mysql_error());
						mysql_select_db("myDatabase")or die("Couldn't select database." . mysql_error());
						
						//explod (eseparatign the text into variables) the search term and add that value to an array
						$search_exploded = explode(" ", $search);
						
						//this enables to search one 'chunk' of the exploded text at the time
						foreach($search_exploded as $search_each){
							$x++;//counter for the loop
							
							//This is gonna construct the last part of the query for the search
							if($x==1){
								$construct .= "keywords LIKE '%$search_each%'";
							} else {
								$construct .= "OR keywords LIKE '%$search_each%'";
							}
						}
						//This is the first part of the query
						$construct = "SELECT * FROM searchengine WHERE $construct";
						$runQuery = mysql_query($construct);
						$rowFound = mysql_num_rows($runQuery);
						$spaceTab = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				
						
						if($rowFound==0){
							echo "No results found <br>";
						} else {
							echo "$rowFound results found!!<p>";
							while($runrows = mysql_fetch_assoc($runQuery)){
								//get data from the db
								$pID = $runrows['id'];
								$title = $runrows['title'];
								$description = $runrows['description'];
								$price = $runrows['price'];
								
								//Display the data 
								echo "Product Name:<br> $spaceTab <b>$title</b> <br>
								Product description:<br> $spaceTab $description <br>
								Product price:<br> $spaceTab &pound; 
								";
								echo number_format($price, 2);http://localhost/447967/admin/cart.php?add=4
								//In here adds the item to the cart and shows a link to go and see the product using the name atribute
								
								if($sessionName == 'Guest'){
									echo '<td>To add this item to your cart please <a href="../index.php">log in</a> or </td>';
									echo '<br>you can <a href="../client/products.php#'.$title.'">View</a> it in our products page<br><br><br>';
								} else {
									//This shows a link to add the item to the cart
									echo '  <a href="../admin/cart.php?add='.$pID.'">Add  to my cart</a>';				
								}
									
							}
						}
					}//2nd else			
						
				}

				//This displays the shop cart
				echo '<br><br>';
				 $displayerSelector = 'Orders&Products';
				shopcart($sessionName, $displayerSelector);
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