<div class="span10">

	<h1>New User</h1>
	<p class="lead">Please enter the information below.</p>
	<?php if(!empty($message)):?>
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
				<?php if(empty($the_user)):?>
  				<div class="control-group">
			  		<label class="control-label" for="registration_code">Registration Code</label>
					<div class="controls">
					<?php echo form_input($registration_code);?>
					
					</div>
				</div>
				<?php endif;?>

			</fieldset>

    		<div class="form-actions">
			<div class="pull-right">
				<?php echo form_submit('submit', 'Create User', 'class="btn-primary"');?>
			</div>
		</div>
    <?php echo form_close();?>

</div>
