<div id="block-login-status">
	<?php
		global $logout;
		global $login;
		global $auth;
		
		if($logout != null && $logout != 1) {
			echo "<p class=\"error\">" . error_report($logout) . "</p>";
		}	elseif($login[2] != null) {
			echo "<p class=\"error\">" . error_report($login[2]) . "</p>";
		} elseif($auth[2] != null) {
			echo "<p class=\"error\">" . error_report($auth[2]) . "</p>";
		} else {
			echo "<p>Site administration has been restricted to the bride, groom and site developer(s) only.</p>";
		}
	?>
</div>