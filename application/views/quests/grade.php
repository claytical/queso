<div class="span10">
		<?php
			echo validation_errors();
        	$attributes = array('class' => 'well form-horizontal');
			echo form_open(base_url('admin/quest/grade/post'), $attributes);
  		?>
			<?php if(empty($selected)):?>
			<h3><?php echo $title?></h3>
			<?php else:?>
			<h3>Grade for Response</h3>
			<?php endif;?>
			<p class="lead"></p>
  			<fieldset>
				<div class="control-group quest-field">

					<label class="control-label" for="quest">Quest <a class='badge badge-info pop-help' data-content="Select the quest that you want to grade." data-original-title="Quest"><i class='icon-question-sign'></i></a></label>
					<div class="controls">
						<select name="quest-id" id="quest"  class="chzn-select">
							<option></option>
							<?php foreach ($quests as $quest) :?>
							<option value="<?php echo $quest['info']->id;?>"><?php echo $quest['info']->name;?></option>
							<?php endforeach;?>
						</select>
					</div>						
				</div>
				
				<div class="control-group" id="points-awarded" style="display:none">
				</div>
				<div class="control-group student-field">

					<label class="control-label" for="users">Students <a class='badge badge-info pop-help' data-content="You can select multiple students to assign these skill rewards to. If you end up mistakenly assigning a quest to a student, you can always remove them." data-original-title="Students"><i class='icon-question-sign'></i></a></label>
					<div class="controls">
						<select id="users" name="users[]" data-placeholder="Please select..." class="chzn-select" multiple>
							<?php foreach ($users as $user) :?>
							<option value="<?php echo $user->id;?>"><?php echo $user->username;?></option>
							<?php endforeach;?>
						</select>

					</div>						
				</div>
				<div class="control-group">
					<label class="control-label" for="quest-note">Note <a class='badge badge-info pop-help' data-content="This will show up in the list when you or a student is looking at completed quests." data-original-title="Note"><i class='icon-question-sign'></i></a></label>
						<div class="controls">
							<input type="text" id="quest-note" name="quest-note" class="span5" placeholder="Note or comment...">
						</div>
				</div>
			</fieldset>
			<?php if(!empty($rid)):?>
			<input type="hidden" name="response-id" value="<?=$rid?>">
			<?php endif;?>
			<div class="form-actions">
				<div class="pull-right">
			  		<button type="submit" class="btn-primary">Continue</button>
				</div>
			</div>
		</form>
	</div>
	<?php 	if (!empty($selected) && !empty($uid)):?>
<script>
		$.post("<?= base_url('admin/quests/skills/get') ?>", { qid: <?= $selected ?> },
		   function(data) {
		   		$('#points-awarded').html(data);

		   });
		   $('select#quest').val(<?= $selected?>);
		   $('select#users').val(<?= $uid?>);
		   $('.quest-field').hide();
		   $('.student-field').hide();
</script>
	<?php else:?>
	<script>
		$('.chzn-select').chosen();		
		$('select#quest').change(function() {
		$.post("<?= base_url('admin/quests/skills/get') ?>", { qid: $(this).val() },
		   function(data) {
		   		$('#points-awarded').html(data);
				$('#points-awarded').show();
				$('.chzn-select').chosen();

		   });
				});
	</script>
	
	<?php endif;?>