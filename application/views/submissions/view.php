<div class="span10">
<h1><?php echo $quest ?></h1>


<div class="row-fluid">

	<div class="span8"><p class="lead"><?php echo $instructions;?></p></div>
	<div class="span4">
	<?php if (!empty($progress)):?>
	<table class="table table-condensed">
			<thead>
			  <tr>
				<th>Skill</th>
				<th>Points</th>
			  </tr>
			</thead>
			<tbody>
			<?php foreach ($progress as $prog):?>
			 <?php if(!empty($prog['skill'])):?>
			  <tr>
				<td><?php echo $prog['skill'];?></td>
				<td>
					<div class="progress progress-success">
					  <div class="bar" style="width: <?php echo $prog['percentage'];?>%;"><?php echo $prog['amount'];?></div>
					</div>
				</td>
			  </tr>
			  <? endif;?>
			<?php endforeach;?>
			<tr>
			<td colspan="2">
			<a href='<?= base_url('submission/revise/'.$id) ?>' class="btn btn-primary pull-right">Revise</a>
			</td>
			</tr>
			</tbody>
		  </table>
	<?php else:?>
		<div class="well">
		<p>This quest has not been reviewed yet.</p>
		<p>
			<a href='<?= base_url('submission/revise/'.$id) ?>' class="btn btn-primary">Revise Anyway</a>
		</p>
		</div>
	<?php endif;?>
	</div>
</div>
	<div class="well">
		<?php echo $submission;?>
	</div>
</div>
<div>
		<?php
			echo form_open('');
  		?>
<div class="span10">
	<h3>Responses</h3>
	<?php if (!$responses):?>
	<p>There are no responses yet</p>
	<?php endif;?>
		<?php foreach($responses as $response):?>
			<blockquote>
			  <p><?php echo $response->response;?></p>
			  <small><?php echo $response->first_name . " " . $response->last_name ;?></small>
			</blockquote>
		<?php endforeach;?>
		<div class="well">
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
						<button type="submit" class="btn-primary">Respond</button>
					</div>
				</div>		
		</div>
	</form>
	
</div>
</div>