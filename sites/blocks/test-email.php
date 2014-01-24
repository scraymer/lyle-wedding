<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Error Chart</title>
	<style type="text/css">
	#block-test-email {
		text-align: center;
	}
	
	#block-test-email .content {
		clear: both;
		display: inline-block;
		text-align: left;
		margin: 0px auto;
	}
	</style>
</head>
<body>

<div id="block-test-email">
	<br />
		
	<div id="test-email-header" class="block-admin-subheading">
		<button type="button" style="float:right" name="error-chart-close"
			onclick="window.location='administration.php?error-chart=false';">
		CLOSE
		</button>
		<h4 style="margin:0px; padding:10px 0px 0px 0px;">Test Email</h4>
	</div>
	
	<div class="content">
		<form action="administration.php?test-email=true" method="POST" id="test-email" accept-charset="UTF-8">
			To: <input type="text" name="to" value="" size="25" maxlenght="60" /><br />
			Subject: <input type="text" name="subject" value="" size="25" maxlenght="60" /><br />
			<textarea name="body" rows="10" cols="100"></textarea><br />
			<input type="submit" name="submit" value="SEND" />
			<input type="hidden" name="email" value="true" />
		</form>
	</div>
	
	<?php
		if(isset($email) && $email[2] != null) {
			echo "<p class=\"error\">" . error_report($email[2]) . "</p>";
		}	elseif(isset($email) && $email[0] != null) {
			echo "<p>";
			echo "Email entitled, '" . $email[1] . "', was successfully sent to ";
			$to = $email[0];
			$lngth = count($to);
			for($i = 0; $i < $lngth; $i++) {
				echo "'" . $to[$i] . "'";
				if(($lngth - $i) == 1) {
					echo ".";
				} else {
					echo ", ";
				}
			}
			echo "</p>";
		}
	?>
</div>
</body>
</html>
	