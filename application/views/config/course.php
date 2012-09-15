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
			<input type="text" name="course" value="<?php echo $course ;?>"> <a class='badge badge-info pop-help' data-content="This is the name of your course.  It will be shown in the top left hand corner of the site." data-original-title="Course Name"><i class='icon-question-sign'></i></a>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="identity">Custom Dropdown Title</label>
			<div class="controls">
			<input type="text" name="dropdown" value="<?php echo $dropdown ;?>"> <a class='badge badge-info pop-help' data-content="If you choose to create posts, they can be listed next to the quests dropdown menu.  What you define here will be used as the name for that menu." data-original-title="Dropdown Title"><i class='icon-question-sign'></i></a>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="password">Registration Code</label>
			<div class="controls">
			  <input type="text" name="registration_code" value='<?php echo $registration_code;?>'> <a class='badge badge-info pop-help' data-content="Your students can create accounts by themselves.  In order to register, they must enter this registration code." data-original-title="Registration Code"><i class='icon-question-sign'></i></a>
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
			</select> <a class='badge badge-info pop-help' data-content="Try these different themes to change the look of your site." data-original-title="Themes"><i class='icon-question-sign'></i></a>
			</div>
  		</div>
		</fieldset>
    		<div class="form-actions">
			<div class="pull-right">
				<?php echo form_submit('submit', 'Update', 'class="btn-primary"');?>
			</div>
<?php echo form_close();?>
</div>
