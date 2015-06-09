<?php 
//connect to the database (contains DB info and constants)
require('db-connect.php'); 

include( SITE_PATH . '/includes/header.php' ); ?>

	<main>
		<?php 
		//set up query to get the newest published post - title & body only. 
		// newest first
		$query = "SELECT posts.title, posts.body, posts.date, users.username, 
					posts.post_id, categories.name
					FROM posts, users, categories
					WHERE posts.is_published = 1
					AND posts.user_id = users.user_id
					AND posts.category_id = categories.category_id
					ORDER BY posts.date DESC";
		//run the query
		$result = $db->query($query); 

		//check to make sure that the result contains data
		if( $result->num_rows >= 1  ){
			//loop through each row in the results
			while($row = $result->fetch_assoc()){
		?>
		<article>
			<h2>
				<a href="single.php?post_id=<?php echo $row['post_id'] ?>">
				<?php echo $row['title']; ?>
				</a>
			</h2>
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
			//we are done with the results, so free the memory/resources
			$result->free();	
				
		}else{
			echo '<h2>Sorry, no posts found</h2>';
		} 		
		?>

	</main>

<?php 
include( SITE_PATH . '/includes/sidebar.php' ); 
include( SITE_PATH . '/includes/footer.php' ); 
?>
