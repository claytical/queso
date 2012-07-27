<div>

	<h1>Create User</h1>
	<p class="lead">Please enter the users information below.</p>
	<?php if($message):?>
	<div class="alert">
		<button class="close" data-dismiss="alert">x</button>
		<?php echo $message;?>
	</div>
	<?php endif;?>
    <?php
    $attributes = array('class' => 'well form-horizontal');
    echo form_open("auth/create_user", $attributes);?>
    
      			<fieldset>
  				<div class="control-group">
			  		<label class="control-label" for="first">First Name</label>
					<div class="controls">
					<?php echo form_input($first_name);?>
					</div>
				</div>
  				<div class="control-group">
			  		<label class="control-label" for="last">Last Name</label>
					<div class="controls">
					<?php echo form_input($last_name);?>

					</div>
				</div>
  				<div class="control-group">
			  		<label class="control-label" for="email">Email</label>
					<div class="controls">
					<?php echo form_input($email);?>
					
					</div>
				</div>
  				<div class="control-group">
			  		<label class="control-label" for="email">Password</label>
					<div class="controls">
					<?php echo form_input($password);?>
					
					</div>
				</div>
  				<div class="control-group">
			  		<label class="control-label" for="password_confirm">Confirm Password</label>
					<div class="controls">
					<?php echo form_input($password_confirm);?>
					
					</div>
				</div>

			</fieldset>

    		<div class="form-actions">
			<div class="pull-right">
				<?php echo form_submit('submit', 'Create User', 'class="btn-primary"');?>
			</div>
		</div>
    <?php echo form_close();?>

</div>
