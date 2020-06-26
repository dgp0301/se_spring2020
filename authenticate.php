<?php

$server = "localhost";

$dbusername = "root";

$password = "";

$db = "se_20s_g01_db";

$debug = "true";


$dbconn = mysqli_connect($server, $dbusername, $password, $db);



if ($dbconn->connect_error) {
    die('Could not connect: ' . $dbconn->connect_error);
}


//You can use the command below to set the default database to another db.

//mysqli_select_db($dbconn, "webiii");

if ($debug == "true"){
	echo nl2br("Connected");
}


// Check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['Username'], $_POST['Password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}
$result = mysqli_query($dbconn,"SELECT * FROM UserLogin");
$row = mysqli_fetch_assoc($result);
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $dbconn->prepare('SELECT UserID, Password FROM UserLogin WHERE Username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['Username']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

if ($stmt->num_rows > 0) {
	$stmt->bind_result($server, $password);
	$stmt->fetch();
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	if ($_POST['Password'] == $row['Password']) {
		// Verification success! User has loggedin!
		// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
		//session_regenerate_id();
		$_SESSION["loggedin"] = TRUE;
		$_SESSION["name"] = $_POST['Username'];
		header("Location: https://cs.newpaltz.edu/se/se-s20-g01/NewHome.html");
		//$_SESSION["UserID"] = $id;
		echo 'Welcome ' . $_SESSION['name'] . '!';
	} else {
		echo 'Incorrect password!';
	}
} else {
	echo 'Incorrect username!';
}

	$stmt->close();
}
?>
