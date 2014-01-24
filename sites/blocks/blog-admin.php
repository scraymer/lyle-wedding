<div id="block-blog-admin">
	
	<?php
		//include required classes
		require_once('sites/classes/user.php');
		require_once('sites/classes/comment.php');
		require_once('sites/scripts/authenticate.php');
		
		//approve any posted comments
		if(isset($_GET['blog-comment-id']) && isset($_GET['blog-comment-status'])) {
			$comment = Comment::updateCommentStatus($_GET['blog-comment-id'], $_GET['blog-comment-status']);
			
			//send newsletter if and only if one has not been sent previously
			if($_GET['blog-comment-status'] == 'approved' && $comment->get_newsletter() == false) {
				include_once 'sites/scripts/send_email.php';
				
				//set comment variables for email bodies
				$id = $comment->get_id();
				$date = $comment->get_date(true);
				$username = $comment->get_username();
				if($username == "") { $username = 'Anonymous'; }
				$subject = $comment->get_subject();
				$message = $comment->get_message();
				$collection = $comment->get_collection();
				
				//get email addresses for users who want newsletters
				$users = User::selectUserByNewsletter(true);
				
				for($i=0; $i<count($users); $i++) {
					$email = $users[$i]->get_email();
					
					//set alternative email body
					ob_start();
					include 'sites/blocks/blog-newsletter-email-alt.php';
					$altBody = ob_get_contents();
					ob_end_clean();
					
					//set html email body
					ob_start();
					include 'sites/blocks/blog-newsletter-email-html.php';
					$htmlBody = ob_get_contents();
					ob_end_clean();
					
					$_POST['to'] = $email;
					$_POST['subject'] = 'Lisa and Kyle\'s Wedding Newsletter';
					$_POST['altBody'] = $altBody;
					$_POST['body'] = $htmlBody;
					
					sendMessage();
				}
				
				$comment->set_newsletter(true);
				$comment->updateRecord();
			}
		}
		
		//delete any posted comments
		if(isset($_GET['blog-comment-id']) && isset($_GET['blog-comment-drop']) && $_GET['blog-comment-drop'] == "true") {
			$comment = Comment::deleteCommentById($_GET['blog-comment-id']);
		}
	?>
	
	<br />
	
	<div class="content">

		<table>
			<tr>
				<th id="id" class="center">id:</th>
				<th id="date" class="center">date:</th>
				<th id="username" class="center">username:</th>
				<th id="subject" class="left">subject:</th>
				<th id="message" class="left">message:</th>
				<th id="status" class="center">status:</th>
				<th id="action" class="center">action:</th>
			</tr>
			
			<?php
				$comments = Comment::selectCommentsByCollection('blog', 'date');
				
				for($i=0; $i<count($comments); $i++) {
					$id = $comments[$i]->get_id();
					$username = $comments[$i]->get_username();
					$subject = $comments[$i]->get_subject();
					$message = $comments[$i]->get_message();
					$date = $comments[$i]->get_date(true);
					$status = $comments[$i]->get_status();
					
					if($username == null) {
						$username = "Anonymous";
					}
					
					if($status == 'approved') {
						echo '<tr id="comment-' . $id . '" onclick="window.location=\'blog.php#comment-' . $id .'\';">';
					} else {
						echo '<tr id="comment-' . $id . '">';
					}
						echo '<td class="center">' . $id . '</td>';
						echo '<td class="center">' . $date . '</td>';
						echo '<td class="center">' . $username . '</td>';
						echo '<td class="left">' . $subject . '</td>';
						echo '<td class="left">' . $message . '</td>';
						echo '<td class="center">' . $status . '</td>';
						echo '<td class="center">';
							
							$action = 'administration.php?blog-admin=true';
							$action = $action . '&blog-comment-id=' . $id;
							
							if($status == "waiting") {
								echo '<a href="' . $action . '&blog-comment-status=approved#comment-' . $id . '">APPROVE</a>';
								echo '<br />';
								echo '<a href="' . $action . '&blog-comment-status=rejected#comment-' . $id . '">REJECT</a>';
								echo '<br />';
								echo '<a href="' . $action . '&blog-comment-drop=true">DELETE</a>';
							} elseif($status == "rejected") {
								echo '<a href="' . $action . '&blog-comment-status=approved#comment-' . $id . '">APPROVE</a>';
								echo '<br />';
								echo '<a href="' . $action . '&blog-comment-drop=true">DELETE</a>';
							} elseif($status == "approved") {
								echo '<a href="' . $action . '&blog-comment-status=rejected#comment-' . $id . '">REJECT</a>';
								echo '<br />';
								echo '<a href="' . $action . '&blog-comment-drop=true">DELETE</a>';
							} else {
								echo '<a href="' . $action . '&blog-comment-drop=true">DELETE</a>';
							}
						echo '</td>';
					echo '</tr>';	
				}
			?>
		</table>
	</div>
</div>