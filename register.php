<?php require('db-connect.php'); 

//parse the form if the user submitted it
if($_POST['did_register']){
	//clean the data
	$username 	= clean_input( $_POST['username'], $db );
	$email 		= clean_input( $_POST['email'], $db );
	$password 	= clean_input( $_POST['password'], $db );
	$policy 	= clean_input( $_POST['policy'], $db );

	//hashed password for DB
	$hashed_password = sha1($password);

	//validate
	$valid = true;

	//username not within the limits
	if( strlen($username) < 3 OR strlen($username) > 50 ){
		$valid = false;
		$errors['username'] = 'Choose a username that is between 3 - 50 characters long.';
	}else{
		//if the length check passed, check to see if this username is already taken in DB
		$query_username = "SELECT username FROM users
							WHERE username = '$username' 
							LIMIT 1";
		$result_username = $db->query($query_username);
		//if one result found, name is already taken :(
		if( $result_username->num_rows == 1 ){
			$valid = false;
			$errors['username'] = 'That username is already taken.';
		}
	}//end username tests

	//check for invalid or blank email
	if( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ){
		$valid = false;
		$errors['email'] = 'Please provide a valid email address, like johndoe@mail.com';
	}else{
		//valid email, but make sure it isn't already taken in DB
		$query_email = "SELECT email FROM users
						WHERE email = '$email'
						LIMIT 1 ";
		$result_email = $db->query($query_email);
		if( $result_email->num_rows == 1 ){
			$valid = false;
			$errors['email'] = 'Your email is already registered. <a href="login.php">Do you want to login</a>?';
		}
	}//end email check

	//password too short
	if( strlen($password) < 5 ){
		$valid = false;
		$errors['password'] = 'Password must be at least 5 characters long.';
	}

	//did not check the policy box
	if( $policy != 1 ){
		$valid = false;
		$errors['policy'] = 'Please agree to the Terms before registering.';
	}

	//if valid, add the new user to DB
	if( $valid ){
		$query_newuser = "INSERT INTO users 
						  ( username, is_admin, email, password, date_joined )
						  VALUES
						  ( '$username', 0, '$email', '$hashed_password', now() ) ";
		$result_newuser = $db->query($query_newuser);
		//check to make sure the user was added
		if( $db->affected_rows == 1 ){
			$success_message = 'You are now registered. Proceed to Login.';

		}else{
			$errors['db'] = 'Something went wrong during account creation.';
		}
	}//end if valid	
}//end of parser
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sign up for an account</title>
	<link rel="stylesheet" type="text/css" href="css/login-style.css">
</head>
<body class="register">
	<main>
	<?php //if registration is complete, show a success message
	if(isset($success_message)){ ?>
		<h1>Success</h1>
		<p><?php echo $success_message ?></p>
	<?php
	}else{ ?>
	<h1>Create an account</h1>
	<?php mmc_show_array($errors); ?>

	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
		<label>Create a username:</label>
		<input type="text" name="username">

		<label>Email Address:</label>
		<input type="email" name="email">

		<label>Create your password:</label>
		<input type="password" name="password">

		<label>
			<input type="checkbox" name="policy" value="1">
			I agree to the <a href="#" target="_blank">Terms of Service</a>
		</label>

		<input type="submit" value="Sign Up!">
		<input type="hidden" name="did_register" value="1">
	</form>
	<?php }//end if ?>
</main>
</body>
</html>