<?php 

	include "db_config.php";
	$conn = new mysqli($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

	if (mysqli_connect_errno()) 
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
 		die();
	}
 

	$stmt = $conn->prepare("SELECT id,title,description,image_path FROM NewsFeedTable ORDER BY id DESC;");
  	$stmt->execute(); 
 	$stmt->bind_result($id, $title, $description, $image_path);
 
 	$products = array(); 
  
 	while($stmt->fetch())
 	{	
 	
 		$temp = array();
 		$temp['id'] = $id; 
 		$temp['title'] = $title; 
 		$temp['description'] = $description;
		$temp['image_path'] = $image_path; 
 		array_push($products, $temp);
 	}

 	echo json_encode($products);

 ?>