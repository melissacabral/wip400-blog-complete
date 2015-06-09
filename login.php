<?php 
session_start();
require('db-connect.php');

//parse the form if it was submitted
if( $_POST['did_login'] ):
	//extract and clean the data
	$username = clean_input( $_POST['username'] );
	$password = clean_input( $_POST['password'] );

	//validate
	$valid = true;

	//test to see if username is the wrong length (not between 5 - 20)
	if( strlen( $username ) < 5 OR strlen( $username ) > 20 ):
		$valid = false;
	endif;

	//test to see if password is wrong length (minimum 8)
	if( strlen( $password ) < 8 ):
		$valid = false;
	endif;


	if($valid):
		//check for the correct credentials 
		$query = "SELECT user_id 
				  FROM users
				  WHERE username = '$username'
				  AND password = sha1('$password')
				  LIMIT 1";
		//run it
		$result = $db->query($query);
		//if one row is found, success! log them in
		if( $result->num_rows == 1 ):
			//SUCCESS!
			$message = 'Success! You are now logged in.';
			//log the user in for 1 week - store their user_id and security key
			$key = sha1( microtime() . 'dsaf9o743kylfxdz8o5' );
			setcookie( 'key', $key, time() + 60 * 60 * 24 * 7 );
			$_SESSION['key'] = $key;

			//get the user ID
			$row = $result->fetch_assoc();
			$user_id = $row['user_id'];
			//store the user_id in a cookie and session
			setcookie( 'user_id', $user_id, time() + 60 * 60 * 24 * 7 );
			$_SESSION['user_id'] = $user_id;

			//store the key in the db
			$query_update = "UPDATE users
							SET login_key = '$key' 
							WHERE user_id = $user_id
							LIMIT 1";
			$result_update = $db->query($query_update);

			//redirect to admin panel
			header('Location:admin/index.php');
		else:
			//ERROR
			$message = 'Incorrect login info. Try again.';
		endif;
	else:
		//error. not valid
		$message = 'Invalid login info. Try again.';
	endif; // valid
endif; //end of parser

//if the user returns here to log out, destroy all sessions and cookies
if( $_GET['logout'] ):
	session_destroy();

	//TODO:  remove the key from the db with the UPDATE statement
	
	//destroy the key
	unset($_SESSION['key']);
	setcookie( 'key', '', time() - 9999999 );


	//destroy the user_id
	unset($_SESSION['user_id']);
	setcookie( 'user_id', '', time() - 9999999 );

endif;

//if the user returns to this page and they still have a valid cookie, use it to re-create the session
if( $_SESSION['key'] == '' ){
	$_SESSION['key'] = $_COOKIE['key'];
}
if( $_SESSION['user_id'] == '' ){
	$_SESSION['user_id'] = $_COOKIE['user_id'];
}

//if the user views this page and is logged in, redirect them to admin
if( $_SESSION['key'] != '' AND $_SESSION['user_id'] != '' ):
	header('Location:admin/');
endif;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Simple login form with cookies and sessions</title>
	<link rel="stylesheet" type="text/css" href="css/login-style.css">
</head>
<body>
	<h1>Log In</h1>

	<?php 
	if( isset($message) ):
		echo "<div class='message'>$message</div>";
	endif;	
	?>

	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

		<label for="the_username">Username:</label>
		<input type="text" name="username" id="the_username" required>

		<label for="the_password">Password:</label>
		<input type="password" name="password" id="the_password" required>

		<input type="submit" value="Log In">
		<input type="hidden" name="did_login" value="true"> 
	</form>

	<a href="index.php">&larr; Return to Blog</a>

</body>
</html>