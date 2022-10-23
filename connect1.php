<?php 
	session_start();
	// Change this to your connection info.
	$DATABASE_HOST = 'localhost';
	$DATABASE_USER = 'root';
	$DATABASE_PASS = '';
	$DATABASE_NAME = 'mgs';
	// Try and connect using the info above.
	$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
	if ( mysqli_connect_errno() ) {
		// If there is an error with the connection, stop the script and display the error.
		exit('Failed to connect to MySQL: ' . mysqli_connect_error());
	}
	else {
		if ($stmt = $con->prepare('SELECT name, password FROM users WHERE name = ? ')) {
	
		$stmt->bind_param('s', $_POST['name']);
		$stmt->execute();
		// Store the result so we can check if the account exists in the database.
		$stmt->store_result();
		if ($stmt->num_rows > 0) {
			$stmt->bind_result($name, $password);
			$stmt->fetch();
			// Account exists, now we verify the password.
			// Note: remember to use password_hash in your registration file to store the hashed passwords.
			if ($_POST['password'] == $password) {
				// Verification success! User has logged-in!
				// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
				session_regenerate_id();
				$_SESSION['loggedin'] = TRUE;
				$_SESSION['name'] = $_POST['name'];
				$_SESSION['id'] = $id;
				header('Location: home.php');;
			} 
			else {
				// Incorrect password
				echo 'Incorrect username and/or password!';
			}
		} 
		else {
		// Incorrect username
		echo 'Incorrect username and/or password!';
		}
		$stmt->close();
		}
	}
 ?>