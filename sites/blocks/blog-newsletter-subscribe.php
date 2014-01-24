<div id="block-blog-newsletter-subscribe">
	<div class="header">
		<?php
			if(isset($_GET['submit']) && isset($_GET['email']) && isset($_GET['emailVerify']) && $_GET['email'] != '' && $_GET['emailVerify'] != '') {
				if($_GET['email'] == $_GET['emailVerify']) {
					require_once('sites/classes/user.php');
					
					if($user = User::selectUserByEmail($_GET['email'])) {
						$user->set_newsletter(true);
						$user->dbUpdateRecord();
						echo '<p style="color:green">' . $_GET['email'] . ' has been successfully updated in our mailing list</p>';
					} else {
						if($user = User::createMin($_GET['email'], $_GET['email'], 'newsletter-blog', 999, true, true)) {
							$user->dbInsertRecord();
							echo '<p style="color:green">' . $_GET['email'] . ' has been successfully added to our mailing list</p>';
						} else {
							echo '<a href="administration.php?help=blog-newsletter-subscribe">';
								echo '<p style="color:maroon">A problem has occurred! Please contact administration for assistance.</p>';
							echo '</a>';
						}
					}
				} else {
					echo '<p style="color:maroon">The email addresses you entered did not match... Please try again.</p>';
				}
			}
		?>
	</div>
	<form name="blog-newsletter-subscribe" action="blog.php" method="GET">
		<div id="newsletter-email">
			<input type="text" id="email" name="email" value="" class="textbox" size="30" maxlength="65" />
			<label for="email">Email: </label>
			
			<br />
			<input type="text" id="emailVerify" name="emailVerify" value="" class="textbox" size="30" maxlength="65" />
			<label for="emailVerify">Re-type: </label>
		</div>
		<div id="newsletter-submit">
			<input type="hidden" id="newsletter" name="newsletter" value="subscribe" />
			<input type="submit" id="submit" name="submit" value="Subscribe" class="form-submit button">
			<button type="button" id="close" name="close" class="button" onclick="window.location='blog.php';">
				Close
			</button>
		</div>
	</form>
	<div class="footer">
	</div>
</div>