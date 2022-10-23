<?php 
	$email = $_POST['email'];
	$name = $_POST['name'];
	$password = $_POST['passwd'];

	// Database connection
	$conn = new mysqli('localhost','root','','mgs');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into users(email, name, password) values(?, ?, ?)");
		$stmt->bind_param("sss", $email, $name, $password);
		$execval = $stmt->execute();
		echo $execval;
		echo "Registration successfully...";
		$stmt->close();
		$conn->close();
		header('Location: index.html');
	}



 ?>