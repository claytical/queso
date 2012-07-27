        <div>
		
		<?php
        	$attributes = array('class' => 'well form-horizontal');
			echo form_open('users/confirmation', $attributes);
  		?>
  		<h1><?php echo $title ?></h1>
			<p class="lead"><?php echo $instructions ;?></p>
  			<fieldset>
  				<div class="control-group">
			  		<label class="control-label" for="first">First Name</label>
					<div class="controls">
						<input type="text" id="first" name="first" class="span6" placeholder="First Name">
					</div>
				</div>
  				<div class="control-group">
			  		<label class="control-label" for="last">Last Name</label>
					<div class="controls">
						<input type="text" id="last" name="last" class="span6" placeholder="Last Name">
					</div>
				</div>
  				<div class="control-group">
			  		<label class="control-label" for="email">Email</label>
					<div class="controls">
						<input type="text" id="email" name="email" class="span6" placeholder="Email Address">
					</div>
				</div>

			</fieldset>

			<div class="form-actions">
				<div class="pull-right">
			  		<button type="submit" class="btn-primary">Create Student</button>
			  		<button type="submit" class="btn">Cancel</button>
				</div>
			</div>
		</form>
        
        
      <hr>
