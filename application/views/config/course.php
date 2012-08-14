<div class='span9'>
<h1>Course Information</h1>
	<?php if(!empty($message)):?>
	<div class="alert">
		<button class="close" data-dismiss="alert">x</button>
		<?php echo $message;?>
	</div>
	<?php endif;?>

<?php
    $attributes = array('class' => 'well form-horizontal');
	echo form_open("", $attributes);?>
		<fieldset>
		<div class="control-group">
			<label class="control-label" for="identity">Course Name</label>
			<div class="controls">
			<input type="text" name="course" value="<?php echo $course ;?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="password">Registration Code</label>
			<div class="controls">
			  <input type="text" name="registration_code" value='<?php echo $registration_code;?>'>
			</div>
		</div>
  	
		</fieldset>
    		<div class="form-actions">
			<div class="pull-right">
				<?php echo form_submit('submit', 'Update', 'class="btn-primary"');?>
			</div>
<?php echo form_close();?>
</div>
