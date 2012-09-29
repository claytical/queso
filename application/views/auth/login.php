<div class='span9'>
<h1>Login</h1>
	<?php if($message):?>
	<div class="alert">
		<button class="close" data-dismiss="alert">x</button>
		<?php echo $message;?>
	</div>
	<?php endif;?>

<?php
	if (empty($the_user)) {
    $attributes = array('class' => 'well form-horizontal');
	echo form_open("auth/login", $attributes);?>
		<fieldset>
		<div class="control-group">
			<label class="control-label" for="identity">Email/Username</label>
			<div class="controls">
		  <?php echo form_input($identity);?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="password">Password</label>
			<div class="controls">
		  <?php echo form_input($password);?>
			</div>
		</div>
  	
		</fieldset>
    		<div class="form-actions">
			<div class="pull-right">
				<?php echo form_submit('submit', 'Login', 'class="btn-primary"');?>
			</div>
			<a href="forgot_password">Forgot your password?</a>
<?php echo form_close();

	}
	else {
		echo "You're already logged in as ".$the_user->username.".  <a href='".base_url('logout')."'>Click here to log out.</a>";
	}
?>
</div>
