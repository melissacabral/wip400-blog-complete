<?php include('admin-header.php'); 

//Get the user's id
$user_id = $_SESSION['user_id'];

//Parse the form if it was submitted
if($_POST['did_user']){
	//sanitize all user input
	$username 		= clean_input($_POST['username']);
	$email 			= clean_input($_POST['email']);
	$bio 			= clean_input($_POST['bio']);
	
	//validate
	$valid = true;

	//require title and body
	if( $username == '' OR $bio == '' ){
		$valid = false;
		$errors['required'] = 'Username and Bio are required fields.';
	}else{
		//username can't be in use
		$query_username = "SELECT username 
							FROM users 
							WHERE username = '$username' 
							AND user_id != $user_id
							LIMIT 1";
		$result_username = $db->query($query_username);
		if($result_username->num_rows == 1){
			$valid = false;
			$errors['username'] = 'that Username is already taken, try another.';
		}

		//email can't be in use
		$query_email = "SELECT email FROM users WHERE email = '$email' AND user_id != $user_id LIMIT 1";
		$result_email = $db->query($query_email);
		if($result_email->num_rows == 1){
			$valid = false;
			$errors['email'] = 'that email is already taken, try another.';
		}
	}
	//if valid, Edit the post in the DB
	if($valid){
		$query = "UPDATE users
				  SET
				  username = '$username',
				  email = '$email',
				  bio = '$bio'
				  WHERE user_id = $user_id";
		$result = $db->query($query);
		if( $db->affected_rows == 1 ){
			//success! post was added
			$message = 'Your profile has been saved.';
		}else{
			//no rows were updated
			$message = 'No changes were made to your profile.';
		}
	}//end if valid
	
}//end parser


$query = "SELECT * FROM users
		  WHERE user_id = $user_id
		  LIMIT 1";
$result = $db->query($query);
?>
	<main>
		<?php if( $result->num_rows == 1 ){
		//while loop not needed because only 1 row will be in the result
		$row = $result->fetch_assoc(); ?>
		<h2>Edit your Profile</h2>

		<?php 
		mmc_show_array($errors);
		if( isset($message)){
			echo $message;
		} ?>
		<form 
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<div class="onehalf panel">
				<label>Username:</label>
				<input type="text" name="username" value="<?php echo $row['username'] ?>">
				<label>Email Address:</label>
				<input type="email" name="email" value="<?php echo $row['email'] ?>">
			
				<label>Bio:</label>
				<textarea name="bio"><?php echo $row['bio'] ?></textarea>

				

				<input type="submit" value="Save Profile">
				<input type="hidden" name="did_user" value="1">
			</div>
		</form>	
		<?php 
		}else{
			echo 'Invalid User Profile.';
		} ?>	
	</main>
<?php include('admin-footer.php'); ?>