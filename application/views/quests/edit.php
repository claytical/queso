<div class="span10">
		
	<?php if(!empty($message)):?>
	<div class="alert">
		<button class="close" data-dismiss="alert">x</button>
		<?php echo $message;?>
	</div>
	<?php endif;?>

  		<h1>Update Quest</h1>
			<?php
				$attributes = array('class' => 'well form-horizontal');
				echo form_open_multipart('', $attributes);
  			?>
  			<fieldset>
				<h4>Information</h4>
  				<div class="control-group">
					<label class="control-label" for="quest-title">Name</label>
					<div class="controls">
						<input type="text" id="quest-title" name="quest-title" class="span6" placeholder="What's the name of this quest?" value='<?= $title ?>'>
					</div>

				</div>
  				<div class="control-group">
			  		<label class="control-label" for="quest-instructions">Instructions</label>
					<div class="controls">
						<textarea type="text" id="quest-instructions" name="quest-instructions" class="span6 tinymce" placeholder="What's this quest about?"><?= $instructions?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="userfile">Supplemental File</label>
					<? if($file):?>

						<div class="controls" id="file">
						<a href='<?=base_url('uploads/'.$file)?>'><?=$file?></a> <a class='btn btn-danger btn-mini remove-file' href='#'><i class='icon-remove-sign'></i></a>
						<? else:?>
						<div class="controls" id="file">
						<input type="file" name="userfile" class="span8"/>
					<? endif;?>
					</div>
				</div>

				
				<h4>Skills</h4>
				<? foreach($quest_skills as $skill):?>
					<div class="control-group">
						<label class="control-label"><?= $skill[0]->name;?></label>
							<?php foreach ($skill as $subskill):?>
								<div class="controls">						
									<input type="text" name="existingSkillLabel[]" value="<?= $subskill->label?>"> 
									<input type="text" name="existingSkillAmount[]" value="<?= $subskill->amount?>">
									<input type="hidden" class='skid' name="existingSkillID[]" value="<?= $subskill->skid?>">

									<a href="#" class="remove-existing-skill btn btn-danger"><i class="icon-trash"></i></a>
								</div>
								<br/>
							<? endforeach;?>
							<div class="controls">
								<a href="" class="add-skill btn"><i class="icon-plus"></i></a>
							</div>

					</div>
						<? endforeach;?>
				<h4>Threshold Requirements</h4>
				<? foreach ($skills as $skill):?>
  				<div class="control-group">
					<label class="control-label"><?= $skill->name;?></label>
					<div class="controls">
						<input type="hidden" value="<?=$skill->id?>" name="skill[]">
						<select name="threshold<?=$skill->id?>" id="grade-level-<?=$skill->id?>" data-placeholder="Please select..." class="chzn-select">
							<?php foreach ($grades as $grade) :?>
								<option value="<?php echo $grade->amount;?>"><?php echo $grade->label;?> (<?=$grade->amount;?>)</option>
							<?php endforeach ?>
						</select>
					
					</div>
				</div>
				<?php endforeach ?>


				<div class="control-group hidden">
					<label class="checkbox" for="locked">
    				<div class="controls">
    					<input type="checkbox" name="locked">This quest is unlockable</label>
					</div>
				</div>
			</fieldset>
			<div class="form-actions">
				<div class="pull-right">
			  		<button type="submit" class="btn-primary">Update Quest</button>
				</div>
			</div>
        </form>
        

    <script>
      <? foreach($locks as $lock):?>
      
      		$('select[name="threshold<?=$lock->skid?>"]').val(<?= $lock->requirement?>);
      
      <? endforeach ?>
    	 
		 $('.chzn-select').chosen();
		
		$('.add-skill').click( function() {
			event.preventDefault();
			var skid = $(this).parent().parent().children(".controls").children("input.skid").val();
			$(this).parent('div:last').before("<div class='controls'><input type='text' name='existingSkillLabel[]'> <input type='text' name='existingSkillAmount[]'><input type='hidden' class='skid' name='existingSkillID[]' value='"+skid+"'> <a href='' class='remove-existing-skill btn btn-danger'><i class='icon-trash'></i></a></div><br/>");
			$('.remove-existing-skill').click( function() {
				event.preventDefault();
				$(this).parent().next().remove();
				$(this).parent().children("input").remove();
				$(this).remove();
			
			});
		
		});
		
		$('.remove-existing-skill').click( function() {
			event.preventDefault();
			$(this).parent().next().remove();
			$(this).parent().children("input").remove();
			$(this).remove();
		
		});
		 		 
		 		 
	$('.remove-file').click( function() {
		event.preventDefault();
	
		$.post("<?=base_url('admin/quest/rmfile/'.$id);?>");
		$('#file').html('<input type="file" name="userfile" class="span8"/>');
	});


	</script>