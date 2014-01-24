<div id="block-blog-newsletter-unsubscribe">
	<?php
		require_once('sites/classes/user.php');
		
		if($_GET['email'] == ''){
			
		} elseif($user = User::selectUserByEmail($_GET['email'])) {
			if($user->get_hash() == 'newsletter-blog') {
				$user->dbDeleteRecord();
				if(!User::selectUserByEmail($_GET['email'])) {
					echo '<p style="color:green">' . $_GET['email'] . ' has been successfully removed from our mailing list</p>';
				} else {
					echo '<a href="administration.php?help=blog-newsletter-unsubscribe">';
						echo '<p style="color:maroon">A problem has occurred! Please contact administration for assistance.</p>';
					echo '</a>';
				}
			} else {
				$user->set_newsletter(false);
				$user->dbUpdateRecord();
				echo '<p style="color:green">' . $user->get_email() . ' has been successfully removed from our mailing list</p>';
			}
		} else {
			echo '<p style="color:maroon">' . $_GET['email'] . ' was not found on our records... there is no need to unsubscribe.</p>';
		}
	?>
</div>