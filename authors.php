<?php 
//connect to the database (contains DB info and constants)
require('db-connect.php'); 

include( SITE_PATH . '/includes/header.php' ); ?>

	<main>
		<?php 
		//set up query to get the newest published post - title & body only. 
		// newest first
		$query = "SELECT username, userpic, bio, date_joined
					FROM users
					ORDER BY username ASC";
		//run the query
		$result = $db->query($query); 

		//check to make sure that the result contains data
		if( $result->num_rows >= 1  ){
			//loop through each row in the results
			while($row = $result->fetch_assoc()){
		?>
		<article class="cf">
			<h2>
				<?php echo $row['username']; ?>
			</h2>
			<time class="date" datetime="<?php echo $row['date_joined']; ?>">
					Active Since: <?php echo convert_date($row['date_joined']); ?>
			</time>
			<p>
				<?php
				//displays user pic if available 
				if($row['userpic']!=''){
					echo '<img src="'.$row['userpic'].'" class="alignleft">';
					}
				 ?>
				<?php echo $row['bio'] ?></p>
		</article>
		<hr>
		<?php 
			} //end while loop	
			//we are done with the results, so free the memory/resources
			$result->free();	
				
		}else{
			echo '<h2>Sorry, no authors found</h2>';
		} 		
		?>

	</main>

<?php 
include( SITE_PATH . '/includes/sidebar.php' ); 
include( SITE_PATH . '/includes/footer.php' ); 
?>
