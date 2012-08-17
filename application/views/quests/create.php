        <div>
		
		<?php
        	$attributes = array('class' => 'well form-horizontal');
			echo form_open_multipart('admin/quest/skills', $attributes);
  		?>
  		<h1><?php echo $title ?></h1>
			<p class="lead"><?php echo $instructions ;?></p>
  			<fieldset>
  				<div class="control-group">
			  		<label class="control-label" for="quest-title">Name</label>
					<div class="controls">
						<input type="text" id="quest-title" name="quest-title" class="span6" placeholder="What's the name of this quest?">
					</div>
				</div>
  				<div class="control-group">
			  		<label class="control-label" for="quest-instructions">Instructions</label>
					<div class="controls">
						<textarea type="text" id="quest-instructions" name="quest-instructions" class="span6 tinymce" placeholder="What's this quest about?"></textarea>
					</div>
				</div>

  				<div class="control-group">
			  		<label class="control-label" for="userfile">Supplemental File</label>
					<div class="controls">
					<input type="file" name="userfile" class="span8"/>
					</div>
				</div>


				<div class="control-group">

					<label class="control-label" for="quest-type">Type</label>
					<div class="controls">
						<select name="quest-type" id="quest-type" data-placeholder="Please select..." class="chzn-select">
							<?php foreach ($options as $option) :?>
								<option value="<?php echo $option->id;?>"><?php echo $option->name;?></option>
							<?php endforeach ?>
						</select>
					</div>						
				</div>
				<div class="control-group">

					<label class="control-label" for="skills">Skills</label>
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
			  		<button type="submit" class="btn">Cancel</button>
				</div>
			</div>
		</form>
        
        
      <hr>
    <script>
		 $('.chzn-select').chosen();
		 
	$('button.btn-primary').click( function() {
		/*event.preventDefault();
		var skills = new Array();
	   	var	questName = $('input#quest-title').val();
	   	var questType = 1;
	   $('ul.chzn-choices li.search-choice a').each(function (index) {
			skills.push($('select#quest-skills option:eq('+$(this).attr("rel")+')').val());
	   		});

		$.post("quest/skills", { name: questName, selectedSkills: skills, type: questType },
		   function(data) {
		   	//window.location = "skills";
			 //$('tbody').append(data);
		   });
		*/		
	});
		 
		 
	</script>