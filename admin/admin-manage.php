<?php include('admin-header.php'); ?>
	<main>
		<h2>Manage Your Posts:</h2>
		<?php //get all the posts written by the logged in user, newest first
		$user_id = $_SESSION['user_id'];
		$query = "SELECT post_id, title, is_published
				  FROM posts
				  WHERE user_id = $user_id
				  ORDER BY date DESC"; 
		$result = $db->query($query);
		if($result->num_rows >= 1){
		?>
		<ul>
			<?php while( $row = $result->fetch_assoc() ){ ?>
			<li><a href="admin-edit.php?post_id=<?php echo $row['post_id'] ?>">
				<?php echo $row['title'] ?>
				</a> - 
<?php echo ( $row['is_published'] == 1 ? 'Public' : 'Draft' ); ?></li>
			<?php }//end while ?>
		</ul>
		<?php 
		}else{
			echo 'You have not written any posts yet.';
		} ?>
	</main>
<?php include('admin-footer.php'); ?>