    <div class="span10">
		
		<?php
        	$attributes = array('class' => 'well form-horizontal');
			echo form_open_multipart('admin/quest/skills', $attributes);
  		?>
  		<h1><?php echo $title ?></h1>
			<p class="lead"><?php echo $instructions ;?></p>
  			<fieldset>
  				<div class="control-group">
			  		<label class="control-label" for="quest-title">Name </label>
					<div class="controls">
						<input type="text" id="quest-title" name="quest-title" class="span6" placeholder="What's the name of this quest?">
					</div>
				</div>
  				<div class="control-group">
			  		<label class="control-label" for="quest-instructions">Instructions <a class='badge badge-info pop-help' data-content="This text will be shown to the student in the quest list, while writing written submissions, and uploading file submissions." data-original-title="Instructions"><i class='icon-question-sign'></i></a></label>
					<div class="controls">
						<textarea type="text" id="quest-instructions" name="quest-instructions" class="span6 tinymce" placeholder="What's this quest about?"></textarea>
					</div>
				</div>

  				<div class="control-group">
			  		<label class="control-label" for="userfile">Supplemental File <a class='badge badge-info pop-help' data-content="You can upload a file and it will be attached to the quest.  Students will be able to download it when they see the quest listed in the quest list." data-original-title="Supplemental File"><i class='icon-question-sign'></i></a></label>
					<div class="controls">
					<input type="file" name="userfile" />  
					</div>
				</div>


				<div class="control-group">

					<label class="control-label" for="quest-type">Type <a class='badge badge-info pop-help' data-content="The type of quest defines how you and students interact with it. <i>In Class</i> quests are for things handed in during class.  <i>Written Submissions</i> allow students to submit a written assignment digitally.  <i>File Submissions</i> allow a student to upload a zip, pdf, or jpg to the server for you to download.  <i>Responses</i> allow you to award points to students for responding to another student's written submissions." data-original-title="Quest Type"><i class='icon-question-sign'></i></a></label>
					<div class="controls">
						<select name="quest-type" id="quest-type" data-placeholder="Please select..." class="chzn-select">
							<?php foreach ($options as $option) :?>
								<option value="<?php echo $option->id;?>"><?php echo $option->name;?></option>
							<?php endforeach ?>
						</select>  
					</div>						
				</div>
				<div class="control-group">

					<label class="control-label" for="skills">Skills <a class='badge badge-info pop-help' data-content="When a student completes a quest, you will be able to award them points based on the skills you choose here.  You can select multiple skills and in the next step, you will be able to assign multiple values for each skill." data-original-title="Skills"><i class='icon-question-sign'></i></a></label>
					<div class="controls">
						<select id="quest-skills" name="skills[]" data-placeholder="Please select..." class="chzn-select" multiple>
							<?php foreach ($skills as $skill) :?>
								<option value="<?php echo $skill->id;?>"><?php echo $skill->name;?></option>
							<?php endforeach ?>
						</select> 

					</div>						
				
				</div>
				<div class="control-group hidden">
					<label class="checkbox" for="locked">
    				<div class="controls">
    					<input type="checkbox" name="locked">This quest is unlockable</label>
					</div>
				</div>
			</fieldset>

			<div class="form-actions">
				<div class="pull-right">
			  		<button type="submit" class="btn-primary">Create Quest</button>
				</div>
			</div>
		</form>
        
        
      <hr>
