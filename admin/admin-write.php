<?php include('admin-header.php'); 

//Parse the form if it was submitted
if($_POST['did_post']){
	//sanitize all user input
	$title 			= clean_input($_POST['title']);
	$body 			= clean_input($_POST['body']);
	$is_published 	= clean_input($_POST['is_published']);
	$allow_comments = clean_input($_POST['allow_comments']);
	$category_id 	= clean_input($_POST['category_id']);

	//fix blank checkboxes
	if($is_published != 1){
		$is_published = 0;
	}
	if($allow_comments != 1){
		$allow_comments = 0;
	}
	
	//validate
	$valid = true;

	//require title and body
	if( $title == '' OR $body == '' ){
		$valid = false;
		$message = 'Title and Body are required fields.';
	}
	
	//if valid, add to the DB
	if($valid){
		$user_id = $_SESSION['user_id'];
		echo $query = "INSERT INTO posts
		( date, title, body, user_id, is_published, allow_comments, category_id )
		VALUES
		( now(), '$title', '$body', $user_id, $is_published, $allow_comments, 
			$category_id  )";
		$result = $db->query($query);
		if( $db->affected_rows == 1 ){
			//success! post was added
			$message = 'Your post has been saved.';
		}else{
			//something went wrong with the query
			$message = 'Sorry, your post was not saved. Try again.';
		}
	}//end if valid
	
}//end parser
?>
	<main>
		<h2>Write New Post</h2>

		<?php 
		if( isset($message)){
			echo $message;
		} ?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<div class="threequarters panel noborder">
				<label>Title:</label>
				<input type="text" name="title" value="<?php echo $title; ?>">
			
				<label>Body:</label>
				<textarea name="body"><?php echo $body; ?></textarea>
			</div>
			<div class="onequarter panel">

				<h2>Publish Settings</h2>

				<label>
					<input type="checkbox" name="is_published" value="1" <?php checked( $is_published, 1 ); ?>> Make this post public
				</label>

				<label>
					<input type="checkbox" name="allow_comments" value="1" <?php checked( $allow_comments, 1 ); ?>> Allow people to comment on this post
				</label>

				<h2>Category:</h2>
				<select name="category_id">
					<option value="null">Choose One</option>
					<?php //get all categories out of the DB
					$query_cats = "SELECT *
								   FROM categories
								   ORDER BY name ASC";
					$result_cats = $db->query($query_cats);
					//check to see if there are cats to show
					if( $result_cats->num_rows >= 1 ){
						//loop through each cat
						while( $row_cats = $result_cats->fetch_assoc() ){
					?>
					<option value="<?php echo $row_cats['category_id'] ?>" <?php 
					selected($category_id, $row_cats['category_id']); ?>>
					
						<?php echo $row_cats['name']; ?>
					</option>
					<?php 
						}//end while
					}//end if 
					?>
				</select>

				<input type="submit" value="Save Post">
				<input type="hidden" name="did_post" value="1">
			</div>
		</form>		
	</main>
<?php include('admin-footer.php'); ?>