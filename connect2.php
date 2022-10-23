<?php 
	$title = $_POST['title'];
	$content = $_POST['content'];
	$name = $_POST['name'];

	// Database connection
	$conn = new mysqli('localhost','root','','mgs');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into blogs(title, content, name) values(?, ?, ?)");
		$stmt->bind_param("sss", $title, $content, $name);
		$execval = $stmt->execute();
		echo $execval;
		echo "Registration successfully...";
		$stmt->close();
		$conn->close();
		header('Location: lgindex.html');
	}



 ?>