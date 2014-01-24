<script type="text/javascript">
	function ismaxlength(obj)
	{
		 var mlength=obj.getAttribute? parseInt(obj.getAttribute("maxlength")) : ""
		 if (obj.getAttribute && obj.value.length>mlength)
		 obj.value=obj.value.substring(0,mlength)
	}
</script>

<div id="block-blog-form">
	<h2 class="title">Add New Comment</h2>
	
	<?php
		if(isset($_GET['err'])) {
			echo '<p id="status" class="error">';
			echo error_report($_GET['err']);
			echo '</p>';
		} elseif(isset($_GET['done'])) {
			echo '<p id="status" class="done">';
			echo 'Your comment has been successfully submitted for review.';
			echo '</p>';
		}
	?>
	
	<form name="submit-comment" action="sites/scripts/submit_comment.php?src=administration&loc=block-blog-form&get=blog-admin" method="POST">
		<input type="hidden" id="collection" name="collection" value="blog" />
		
		<label for="username" <?php if(isset($_GET['err']) || isset($_GET['done'])){echo 'style="margin-top:0px"';} ?>>Your name </label>
		<input type="text" id="username" class="textbox" name="username" <?php if(isset($_GET['username'])) { echo 'value="' . $_GET['username'] . '"'; } ?> 
			size="30" maxlength="30" onpaste="return ismaxlength(this)" 
			onkeyup="return ismaxlength(this)" />
		
		<label for="subject">Subject </label>
		<input type="text" id="subject" class="textbox" name="subject" <?php if(isset($_GET['subject'])) { echo 'value="' . $_GET['subject'] . '"'; } ?> 
			size="60" maxlength="65" onpaste="return ismaxlength(this)" 
			onkeyup="return ismaxlength(this)" />
		
		<label for="message">Comment 
			<span class="form-required" title="This field is required.">*</span>
		</label>
		<textarea id="message" class="textbox" name="message" cols="60" rows="5" maxlength="1000"
			onpaste="return ismaxlength(this)" onkeyup="return ismaxlength(this)"><?php if(isset($_GET['message'])) {echo $_GET['message'];} ?></textarea>
		
		<div id="captcha-wrapper">
			<img id="captcha" src="sites/classes/securimage/securimage_show.php" alt="CAPTCHA Image" />
		</div>
		<div id="submit-wrapper">
			<div class="description">Enter characters shown in image.</div>
			<input type="text" id="response" name="captcha_code" value="" size="15" maxlength="128" 
				class="textbox" autocomplete="off">
			<input type="submit" id="submit" name="submit" value="Submit" class="form-submit button">
		</div>
	</form>
	
	<div class="footer">All comments are reviewed by an administrator before they are made public.</div>
</div>