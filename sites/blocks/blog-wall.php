<p style="text-align:center">
	Subscribe to our <a href="blog.php?newsletter=subscribe">email newsletter</a> or 
	<a href="rss-check.php">RSS feed</a> to stay up to date with the latest news!
</p>

<div id="block-blog-wall" style="padding-top:1px">
	<!--<h2 class="title">Comments</h2>-->
	
	<div class="subscribe">
		<a href="rss-check.php">
			<div class="rss-icon"></div>
		</a>
		<a href="blog.php?newsletter=subscribe">
			<div class="email-icon"></div>
		</a>
		<div class="label-text">
			Subscribe: 
		</div>
	</div>
	
	<?php
		//include required classes
		require_once('sites/classes/comment.php');
		
		//get all blog comments order by DESC date
		$comments = Comment::selectCommentsByCollection('blog', 'date');
		
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
						echo '<a href="blog.php#comment-' . $id . '" class="permalink" rel="bookmark">' . $subject . '</a>';
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