<?php include('admin-header.php'); 

$user_id = $_SESSION['user_id'];

//Parse the form if submitted
if($_POST['did_upload']){

	//file uploading stuff begins	
	$target_path = "../uploads/";
	
	//list of image sizes to generate. make sure a column name in your DB matches up with a key for each size
	$sizes = array(
		'thumb_img' => 150,
		'medium_img' => 300 
	);	
		
	// This is the temporary file created by PHP
	$uploadedfile = $_FILES['uploadedfile']['tmp_name'];
	// Capture the original size of the uploaded image
	list($width,$height) = getimagesize($uploadedfile);
	
	//make sure the width and height exist, otherwise, this is not a valid image
	if($width > 0 AND $height > 0){
	
	//what kind of image is it
	$filetype = $_FILES['uploadedfile']['type'];
	
	switch($filetype){
		case 'image/gif':
			// Create an Image from it so we can do the resize
			$src = imagecreatefromgif($uploadedfile);
		break;
		
		case 'image/pjpeg':
		case 'image/jpg':
		case 'image/jpeg': 
			// Create an Image from it so we can do the resize
			$src = imagecreatefromjpeg($uploadedfile);
		break;
	
		case 'image/png':
			// Create an Image from it so we can do the resize
			ini_set('memory_limit','16M');
			$src = imagecreatefrompng($uploadedfile);
			ini_restore ("memory_limit");
		break;
		
			
	}
	//for filename
	$randomsha = sha1(microtime());
	
	//do it!  resize images
	foreach($sizes as $size_name => $size_width){
		if($width >=  $size_width){
		$newwidth = $size_width;
		$newheight=($height/$width) * $newwidth;
		}else{
			$newwidth=$width;
			$newheight=$height;
		}
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
		
		$filename = $target_path.$randomsha.'_'.$size_name.'.jpg';
		$didcreate = imagejpeg($tmp,$filename,70);
		imagedestroy($tmp);
				
	}
	
	imagedestroy($src);
	
		
	}else{//width and height not greater than 0
		$didcreate = false;
	}
	
	
	if($didcreate) {
		//add the identifier for the user's image to the DB
		$query = "UPDATE users
				  SET userpic = '$randomsha'
				  WHERE user_id = $user_id
				  LIMIT 1";
		$result = $db->query($query);
		//TODO: remove this message after testing
		if( $db->affected_rows == 1 ){
			$statusmsg .= 'File added to DB';
		}else{
			$statusmsg .= 'DB update failed';
		}		  
		$statusmsg .=  "The file ".  basename( $_FILES['uploadedfile']['name']). 
		" has been uploaded <br />";
	} else{
		$statusmsg .= "There was an error uploading the file, please try again!<br />";
	}
}//end parser

?>
	<main>
		<h2>Edit Your Profile Picture:</h2>
		<?php show_userpic($user_id, 'medium_img'); ?>

		<?php if(isset($statusmsg)){
			echo $statusmsg;
		} ?>

		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
			<label>Choose an Image:</label>
			<input type="file" name="uploadedfile">

			<input type="submit" value="Update Image">
			<input type="hidden" name="did_upload" value="1">
		</form>
		
	</main>
<?php include('admin-footer.php'); ?>

