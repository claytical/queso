<div>
<h1><?php echo $quest ?></h1>
	<div class="row-fluid">
		<p class="lead"><?php echo $instructions;?></p>
	</div>
	<div class="well">
		<?php echo $submission;?>
	</div>

	<div>
		<h3>Discussion</h3>
		<?php if (!$responses):?>
		<p>The discussion hasn't started yet, feel free to start it.</p>
		<?php endif;?>
			<?php foreach($responses as $response):?>
				<div class="row-fluid">
				<blockquote>
				<?php if($the_user->group_id == 1): ?>
					<?php if (!$response->qid):?>
						<div class="btn-group pull-right">
						  <a class="btn dropdown-toggle btn-mini btn-primary" data-toggle="dropdown" href="#">
							Grade as Response Quest
							<span class="caret"></span>
						  </a>

						  <ul class="dropdown-menu">
							<?php foreach($response_quests as $option):?>
							<li><a href="<?= base_url('admin/quest/grade/all/'.$option['info']->id.'/'.$response->user_id.'/'.$response->id)?>"><?= $option['info']->name;?></a></li>
							<?php endforeach;?>
						  </ul>
						</div>					
					<?php else:?>
						<div class="pull-right"><span class="label label-success"><?= $response->name;?></span></div>
					<?php endif;?>
				<?php endif;?>
				  <p><?php echo $response->response;?></p>
				  <small><?php echo $response->first_name . " " . $response->last_name ;?></small>
				</blockquote>
				</div>
			<?php endforeach;?>
			<div class="well">
				<?php echo form_open(''); ?>

				<fieldset>
					<div class="control-group">
						<div class="controls">
							<textarea type="text" id="response" name="response"></textarea>
						</div>
					</div>
	
				</fieldset>
				<input type="hidden" name="submission" value="<?php echo $id ;?>">
					<div class="form-actions">
						<div class="pull-right">
							<button type="submit" class="btn-primary">Add Your Thoughts</button>
						</div>
					</div>		
			</div>
		</form>	
	</div>

		<script>
		$('select.response-quests').change(function() {
		var selected = $(this);
		$.post("<?= base_url('admin/quests/skills/get') ?>", { qid: $(this).val() },
		   function(data) {
		   		selected.parent().parent().parent().children('.skills').html(data);
				$('.chzn-select').chosen();

		   	});
		});
		
		$('.response-quests').chosen();
		
		</script>
