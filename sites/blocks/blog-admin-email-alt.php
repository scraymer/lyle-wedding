<?php
	$collectionExt = "";
	
	if($collection == "gallery") {
		$collectionExt = "gallery-";
	}
	
	echo $username . ' has posted a new comment to the '. $collection . 
		'. Please login as an administrator at \'http://localhost/lyle/administration.php?' . 
		$collectionExt . 'blog-admin=true\' to approve or reject the new post.'
?>