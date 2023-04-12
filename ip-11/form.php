<!DOCTYPE html>
<html>
<head>
	<title>User Registration</title>
</head>
<body>
	<h2>User Registration Form</h2>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<label>Username:</label>
		<input type="text" name="username"><br><br>
		<label>Password:</label>
		<input type="password" name="password"><br><br>
		<input type="submit" name="submit" value="Register">
	</form>

	<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$username = $_POST['username'];
			$password = $_POST['password'];

			// Validate input
			if (empty($username) || empty($password)) {
				echo "Both fields are required.";
			} elseif (strlen($password) < 8) {
				echo "Password must be at least 8 characters long.";
			} else {
				// Connect to MySQL database
				$servername = "127.0.0.1";
				$username = "root";
				$password = "";
				$dbname = "users";
				$conn = new mysqli($servername, $username, $password, $dbname);
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}

				// Insert data into table
				$sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
				if ($conn->query($sql) === TRUE) {
					echo "Registration successful.";
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}

				$conn->close();
			}
		}
	?>
</body>
</html>