<div class='span9'>
	<?php if($message):?>
	<div class="alert">
		<button class="close" data-dismiss="alert">x</button>
		<?php echo $message;?>
	</div>
	<?php endif;?>

<?php 
    $attributes = array('class' => 'well form-horizontal');
	echo form_open("auth/change_password", $attributes);?>

	<h1>Change Password</h1>
	<p class="lead">Your password must be at least <?php echo $min_password_length;?> characters long</p>
      			<fieldset>
  				<div class="control-group">
			  		<label class="control-label" for="old_password">Old Password</label>
					<div class="controls">
			      <?php echo form_input($old_password);?>
					</div>
				</div>

  				<div class="control-group">
			  		<label class="control-label" for="new_password">New Password</label>
					<div class="controls">
			      <?php echo form_input($new_password);?>
					</div>
				</div>

  				<div class="control-group">
			  		<label class="control-label" for="new_password_confirm">Confirm New Password</label>
					<div class="controls">
			      <?php echo form_input($new_password_confirm);?>
					</div>
				</div>
			</fieldset>

    		<div class="form-actions">
			<div class="pull-right">
				<?php echo form_submit('submit', 'Change', 'class="btn-primary"');?>
			</div>
		</div>
      
      <?php echo form_input($user_id);?>
      
<?php echo form_close();?>
</div>