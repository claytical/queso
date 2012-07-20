<div class="span9">
	<?php if($message):?>
	<div class="alert">
		<button class="close" data-dismiss="alert">x</button>
		<?php echo $message;?>
	</div>
	<?php endif;?>

<?php 
	 $attributes = array('class' => 'well form-horizontal');
	 echo form_open("auth/forgot_password", $attributes);?>

<h1>Forgotten Password</h1>
<p class="lead">Please enter your email address so we can send you an email to reset your password.</p>



		<fieldset>
		<div class="control-group">
			<label class="control-label" for="Email">Email</label>
			<div class="controls">
		  <?php echo form_input($email);?>
			</div>
		</div>

		</fieldset>

		<div class="form-actions">
		<div class="pull-right">
			<?php echo form_submit('submit', 'Submit', 'class="btn-primary"');?>
		</div>
	</div>
  
<?php echo form_close();?>
</div>