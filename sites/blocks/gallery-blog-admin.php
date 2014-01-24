<div id="block-blog-admin">
	
	<?php
		//include required classes
		require_once('sites/classes/comment.php');
		require_once('sites/scripts/authenticate.php');
	?>
	
	<?php
		//approve any posted comments
		if(isset($_GET['blog-comment-id']) && isset($_GET['blog-comment-status'])) {
			$comment = Comment::updateCommentStatus($_GET['blog-comment-id'], $_GET['blog-comment-status']);
		}
		
		//delete any posted comments
		if(isset($_GET['blog-comment-id']) && isset($_GET['blog-comment-drop']) && $_GET['blog-comment-drop'] == "true") {
			$comment = Comment::deleteCommentById($_GET['blog-comment-id']);
		}
	?>
	
	<br />
		
	<div id="blog-admin-header" class="block-admin-subheading">
		<button type="button" style="float:right" name="blog-admin-close"
			onclick="window.location='administration.php?gallery-blog-admin=false';">
		CLOSE
		</button>
		<h4 style="margin:0px; padding:10px 0px 0px 0px;">Gallery Blog Administration: Comments</h4>
	</div>
	
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
				$comments = Comment::selectCommentsByCollection('gallery', 'date');
				
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
						echo '<tr id="comment-' . $id . '" onclick="window.location=\'gallery.php#comment-' . $id .'\';">';
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
							
							$action = 'administration.php?gallery-blog-admin=true';
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