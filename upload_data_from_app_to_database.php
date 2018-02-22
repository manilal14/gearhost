<?php 
	
	include "db_config.php";
	$conn = new mysqli($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

	if($conn)
	{
		
		// Getting image and name from Android App
		$image = $_POST["image"];
		$title = $_POST["title"];
		$description = $_POST["description"];

		$timeStamp = time();

		$sql = "INSERT INTO NewsFeedTable(title,description,image_path) values('$title','$description','$timeStamp')";
		$upload_path = "uploaded_image/";
		$file_name = time().".jpeg";
	
		if( is_dir($upload_path) === false )
			mkdir($upload_path,0777,true);
		

		if(mysqli_query($conn,$sql))
		{
			//$file = fopen($upload_path.$name.".jpeg","w");
			file_put_contents($upload_path.$file_name,base64_decode($image));
			echo json_encode(array('response'=>'Image Uploaded Successfully'));
		}

		else
		{
			echo json_encode(array('response'=>'Image Upload Failed'));
		}
	}

	else
	{
		echo json_encode(array('response'=>'connection Failed'));
	}

mysqli_close($conn);
	
?>