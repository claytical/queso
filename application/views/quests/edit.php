        <div>
		
	<?php if(!empty($message)):?>
	<div class="alert">
		<button class="close" data-dismiss="alert">x</button>
		<?php echo $message;?>
	</div>
	<?php endif;?>

  		<h1>Update Quest</h1>
  		<form method="post" class="well form-horizontal">
  			<fieldset>
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
				<? foreach ($skills as $skill):?>
  				<div class="control-group">
					<label class="control-label"><?= $skill->name;?> Required</label>
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
        
      <hr>

    <script>
      <? foreach($locks as $lock):?>
      
      		$('select[name="threshold<?=$lock->skid?>"]').val(<?= $lock->requirement?>);
      
      <? endforeach ?>
    	 
		 $('.chzn-select').chosen();
		 		 
	</script>