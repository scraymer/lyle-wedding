<?php

$action = 'administration.php';

if(isset($_SERVER['QUERY_STRING'])) {
	$query = $_SERVER['QUERY_STRING'];
	$action = $action . '?' . $query;
}

?>

<div id="block-user-login" class="block block-user last even">
	<h2 class="block-title">User login</h2><!--hidden by css-->
	<div class="content">
		<?php 
			global $action;
			echo '<form action="' . $action . '" method="POST" id="user-login-form" accept-charset="UTF-8">';
		?>
			<div class="form-item form-type-textfield form-item-name" id="username-wrapper">
				<label for="edit-name">&nbsp;Username <span class="form-required" title="This field is required.">*</span></label>
				<input type="text" id="username" name="username" value="" size="25" maxlength="60" class="form-text required textbox" />
			</div>
			<div class="form-item form-type-password form-item-pass" id="password-wrapper">
				<label for="edit-pass">&nbsp;Password <span class="form-required" title="This field is required.">*</span></label>
				<input type="password" id="password" name="password" size="25" maxlength="60" class="form-text required textbox" />
			</div>
			<div class="form-actions form-wrapper" id="submit-wrapper">
				<input type="submit" id="submit" name="submit" value="Log in" class="form-submit button" />
			</div>
			<input type="hidden" name="form_build_id" value="form-eKJFcObd7pIQ_3gak5YmUY27aRcxTV8QuEawZc4efVc" />
			<input type="hidden" name="login" value="true" />
		</form>
	</div><!--/.content-->
</div><!-- /.block -->