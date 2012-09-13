<div class='span10'>
	<?php if(!empty($message)):?>
	<div class="alert">
		<button class="close" data-dismiss="alert">x</button>
		<?php echo $message;?>
	</div>
	<?php endif;?>

<?php
    $attributes = array('class' => 'well form-horizontal');
	echo form_open("", $attributes);?>
	<h1>Course Information</h1>
		<p></p>
		<fieldset>
		<div class="control-group">
			<label class="control-label" for="identity">Course Name</label>
			<div class="controls">
			<input type="text" name="course" value="<?php echo $course ;?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="identity">Custom Dropdown Title</label>
			<div class="controls">
			<input type="text" name="dropdown" value="<?php echo $dropdown ;?>">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="password">Registration Code</label>
			<div class="controls">
			  <input type="text" name="registration_code" value='<?php echo $registration_code;?>'>
			</div>
		</div>
  
		<div class="control-group">
			<label class="control-label" for="theme">Theme</label>
			<div class="controls">
			<select name="theme" class="chzn-select">'
				<?php foreach ($themes as $option):?>
					<?php if($option == $theme):?>
					<option value="<?php echo $option;?>" selected><?php echo $option;?></option>
					<?php else:?>
					<option value="<?php echo $option;?>"><?php echo $option;?></option>
					<?php endif;?>

				<?php endforeach;?>
			</select>
			</div>
  		</div>
		</fieldset>
    		<div class="form-actions">
			<div class="pull-right">
				<?php echo form_submit('submit', 'Update', 'class="btn-primary"');?>
			</div>
<?php echo form_close();?>
</div>
