<?php 
/**
 * Convert MySQL datetime format into a human-friendly display date
 * @param  string $dateR the datetime string like 2015-04-02 09:58:43
 * @return string        a nice date like April 2, 2015
 * @since  Day 7 
 */
function convert_date($uglydate){
	$date = new DateTime($uglydate);
	$nicedate = $date->format('F j, Y');
	return $nicedate;
}

/**
 * Count the number of comments on any post
 * @param int $post_id any valid post_id to count the comments for
 * @since  Day 8
 */
function count_comments( $post_id, $show_text = false ){
	//access the $db connection from outside this function
	global $db;

	//count all the published comments on the post_id
	$query 	 = "SELECT COUNT(*) AS total
				FROM comments 
				WHERE is_approved = 1
				AND post_id = $post_id";
	$result = $db->query( $query );
	//check to make sure it worked. COUNT should return exactly one row. 
	if( $result->num_rows == 1 ){
		//while loop can be skipped since we only have one row
		while($row = $result->fetch_assoc()){
			if($show_text){
				//display comment count with good grammar!
				if( $row['total'] == 1 ){
					echo 'One comment';
				}elseif( $row['total'] == 0 ){
					echo 'No comments yet';
				}else{
					echo $row['total'] . ' comments';
				}//end of grammar
			}else{
				echo '<span class="comment-number">' . $row['total'] . '</span>';
			}//end if show_text
		}//end while
		$result->free();
	}//end if comments
}//end count_comments function



/**
 * Count the number of published posts in any category
 * @param int $cat_id any valid category_id
 * @since  Day 8 
 */
function count_posts_in_category($cat_id){
	global $db;
	$query = "SELECT COUNT(*) AS total
			FROM  posts
			WHERE category_id = $cat_id
			AND is_published = 1";
	$result = $db->query($query);
	//check it
	if( $result->num_rows == 1 ){
		//only one result possible, so while() can be omitted
		$row = $result->fetch_assoc();

		echo '(' . $row['total'] . ')';
		$result->free();
	}
}

/**
 * Display comments for any posts in a list 	
 * @param  int $post_id - The post you want to show comments for
 * @since  Day 9
 */

function mmc_list_comments( $post_id ){
	global $db;
	//get comments for this post
	$query = "SELECT comments.body, comments.date, users.username 
			FROM comments, users
			WHERE comments.is_approved = 1
			AND comments.user_id = users.user_id
			AND comments.post_id = $post_id
			ORDER BY comments.date ASC
			LIMIT 20";
	$result = $db->query($query);
	if($result->num_rows >= 1){ ?>

	<section class="comments">
		<h3>Comments:</h3>
		<ul>
			<?php while($row = $result->fetch_assoc()){ ?>
			<li>
				<h4>From: <b><?php echo $row['username'] ?></b> on <?php echo convert_date($row['date']) ?></h4>
				<p><?php echo $row['body'] ?></p>
			</li>
			<?php }
			$result->free(); ?>
		</ul>
	</section>
	<?php } 
}


/**
 * Clean strings to prepare them for the DB
 * @param string $input - dirty data submitted by the user
 * @return string - clean data, ready for DB
 * @since  DAY 10 - needed to sanitize comment form
 */
function clean_input( $input ){
	global $db;
	return mysqli_real_escape_string($db, strip_tags( $input ));
}

/**
 * Display an array as an unordered list
 * @param   array 	$array list to display
 * @return  string 	HTML formatted list
 * @since  DAY 10 - needed to validate comment form
 */
function mmc_show_array( $array ){
	if( !empty( $array ) ){
		$output = '<ul class="error">';
		foreach( $array as $item ){
			$output .= '<li>' . $item . '</li>';
		}
		$output .= '</ul>';

		echo $output;
	}else{
		return;
	}
}

/**
 * Convert DATETIME into RSS friendly pubDate format (grab snippet from my website)
 * @param  string $date datetime data
 * @return string       correct pubDate format for RSS
 * @since  Day 11 
 */
function convTimestamp($date){
	$year   = substr($date,0,4);
	$month  = substr($date,5,2);
	$day    = substr($date,8,2);
	$hour   = substr($date,11,2);
	$minute = substr($date,14,2);
	$second = substr($date,17,2);
	$stamp =  date('D, d M Y H:i:s O', mktime($hour, $min, $sec, $month, $day, $year));
	return $stamp;
}

/**
 * Check to see if the person viewing the page is logged in. 
 * Optionally redirect to a new page if not logged in.
 * @since  0.1 
 * @param string $redirect a path to redirect to if NOT logged in. 
 *                         set to false for no redirect. 
 * @return bool true if logged in, false if not logged in
 */

function check_login_key( $redirect = false ){
	//re-build sessions from existing cookies if session was closed
	if( $_SESSION['key'] == '' ){
		$_SESSION['key'] = $_COOKIE['key'];
	}
	if( $_SESSION['user_id'] == '' ){
		$_SESSION['user_id'] = $_COOKIE['user_id'];
	}
	$key 		= $_SESSION['key'];
	$user_id 	= $_SESSION['user_id'];

	//if any session vars are blank, the user is not logged in
	if( $key == '' OR $user_id == '' ){
		if($redirect){
			header( 'Location:'. $redirect );
		}
		return false;
	}

	//look up this user/key combo in the db
	global $db;
	$query = "SELECT * FROM users
			  WHERE login_key = '$key'
			  AND user_id = $user_id
			  LIMIT 1";
	$result = $db->query($query);
	//check to see if one row found
	if( $result->num_rows == 1 ){
		//logged in
		return true;
	}else{
		//not logged in
		if($redirect){
			header( 'Location:'. $redirect );
		}
		return false;
	}
}


/**
 * Checkbox Helper 
 * compares two values. if they match, displays the attribute 'checked'
 */
function checked( $firstthing, $secondthing ){
	if( $firstthing == $secondthing ){
		echo 'checked';
	}
}

/**
 * Select Dropdown Helper 
 * compares two values. if they match, displays the attribute 'selected'
 */
function selected( $firstthing, $secondthing ){
	if( $firstthing == $secondthing ){
		echo 'selected';
	}
}

/**
 * Display any user's userpic at any defined size
 */
function show_userpic( $user_id, $size = 'thumb_img' ){
	global $db;
	//get the userpic randomsha from the db
	$query = "SELECT userpic 
			  FROM users 
			  WHERE user_id = $user_id
			  LIMIT 1";
	$result = $db->query($query);
	if( $result->num_rows == 1 ){
		$row = $result->fetch_assoc();
		//if they don't have a userpic
		if( $row['userpic'] == '' ){
			//show the default face
			echo '<img src="' . SITE_URL . '/images/default_user.png" class="userpic default-userpic">';
		}else{
			//show the user's pic
			//will be: http://localhost/bla/uploads/sdkufjsdkufh_small.jpg
			echo '<img src="' . SITE_URL . '/uploads/' . $row['userpic'] . '_' . $size . '.jpg" alt="user profile pic" class="userpic">';
		}
	}
}
//no close PHP