<?php 
//connect to the database (contains DB info and constants)
require('db-connect.php'); 

//figure out which post the user clicked on.
//URL looks like /single.php?cat_id=X
$cat_id = $_GET['cat_id'];
 
include( SITE_PATH . '/includes/header.php' ); 
include( SITE_PATH . '/includes/parse-comment.php'); ?>

	<main>
		<?php 
		//set up query to get the post the user is viewing 
	
		$query = "SELECT posts.title, posts.body, posts.date, users.username, 
					posts.post_id, posts.allow_comments
					FROM posts, users
					WHERE posts.is_published = 1
					AND posts.user_id = users.user_id
					AND posts.category_id = $cat_id
					";
		//run the query
		$result = $db->query($query); 

		//check to make sure that the result contains data
		if( $result->num_rows >= 1  ){
			//loop through each row in the results
			while($row = $result->fetch_assoc()){
		?>
		<article>
			<h2><?php echo $row['title']; ?></h2>
			<p><?php echo $row['body'] ?></p>

			<footer class="post-info">
				<span class="author">
					Posted by <?php echo $row['username'] ?>	
				</span>			

				<time class="date" datetime="<?php echo $row['date']; ?>">
					on <?php echo convert_date($row['date']); ?>
				</time>

				<span class="category">
					in the category <?php echo $row['name'] ?>
				</span>

				<span class="comments-number">
					<?php count_comments( $row['post_id'], true ); ?>
				</span>

			</footer>

		</article>
				
		<?php 
			} //end while loop

		//we are done with the results, so free the memory/resources on the server
		$result->free();		
		?>

		<?php		
		}else{
			echo 'Sorry, no posts found';
		} 
		
		?>

	</main>
	<?php 
include( SITE_PATH . '/includes/sidebar.php' ); 
include( SITE_PATH . '/includes/footer.php' );	
	?>