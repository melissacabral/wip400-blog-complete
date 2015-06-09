<?php 
//connect to the database (contains DB info and constants)
require('db-connect.php'); 
 
include( SITE_PATH . '/includes/header.php' );  ?>

	<main>
		<h2>Links you may like:</h2>
		<?php 
		//set up query to get all the links 	
		$query = "SELECT * FROM links 
					ORDER BY title ASC";
		//run the query
		$result = $db->query($query); 

		//check to make sure that the result contains data
		if( $result->num_rows >= 1  ){
			//loop through each row in the results
			while($row = $result->fetch_assoc()){
		?>
		<article>
			<h2><a href="<?php echo urlencode( $row['url'] ); ?>"><?php echo $row['title']; ?></a></h2>
			<p><?php echo $row['description'] ?></p>

		</article>
		
		<?php 
			} //end while loop

		//we are done with the results, so free the memory/resources on the server
		$result->free();		
		?>

		<?php		
		}else{
			echo 'Sorry, no links found';
		} 
		
		?>

	</main>
	<?php 
include( SITE_PATH . '/includes/sidebar.php' ); 
include( SITE_PATH . '/includes/footer.php' );	
	?>