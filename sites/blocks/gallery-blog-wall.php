<div id="block-blog-wall">
	<h2 class="title">Comments</h2>
	
	<?php
		//include required classes
		require_once('sites/classes/comment.php');
		
		//get all blog comments order by DESC date
		$comments = Comment::selectCommentsByCollection('gallery', 'date', "ASC");
		
		//display each comment that has been approved
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
			
			if($subject == null) {
				$subject = $username . " wrote:";
			}
			
			if($status == "approved") {
				echo '<div id="comment-' . $id . '" class="comment">';
					echo '<h3 class="comment-subject">';
						echo '<a href="gallery.php#comment-' . $id . '" class="permalink" rel="bookmark">' . $subject . '</a>';
					echo '</h3>';
					echo '<div class="comment-details">';
						echo 'Submitted by <span class="username">'. $username . '</span> on ' . $date;
					echo '</div>';
					echo '<div class="comment-message">';
						echo '<p>';
							echo $message;
						echo '</p>';
					echo '</div>';
				echo '</div>';
			}
		}
	?>
	
</div>