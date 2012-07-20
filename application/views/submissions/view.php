<div class="span9">
<h1><?php echo $quest ?></h1>



<p class="lead"><?php echo $instructions;?></p>
<div class="pull-right">
<table class="table table-condensed">
        <thead>
          <tr>
            <th>Skill</th>
            <th>Points</th>
          </tr>
        </thead>
        <tbody>
		<?php foreach ($progress as $prog):?>
          <tr>
            <td><?php echo $prog['skill'];?></td>
            <td>
				<div class="progress progress-success">
				  <div class="bar" style="width: <?php echo $prog['percentage'];?>%;"><?php echo $prog['amount'];?></div>
				</div>
            </td>
          </tr>
		<?php endforeach;?>

        </tbody>
      </table>
</div>
	<div class="well">
		<?php echo $submission;?>
	</div>
</div>
<div class="span9">
		<?php
			echo validation_errors();
			echo form_open('');
  		?>
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