    <div>
		<?php			
			echo validation_errors();
        	$attributes = array('class' => 'well');
			echo form_open('', $attributes);
  		?>
  		<h1><?php echo $quest ?></h1>
			<p class="lead"><?php echo $instructions ;?></p>
  			<fieldset>
  				<div class="control-group">
					<div class="controls">
						<textarea type="text" id="quest" name="submission"><?php echo $submission;?></textarea>
					</div>
				</div>
  				<div class="control-group">
					<div class="controls">
						<input type="checkbox" id="visible" name="visible"> Visible to Others</input>
					</div>
				</div>

			</fieldset>
			<input type="hidden" name="quest" value="<?php echo $qid ;?>">

			<div class="form-actions">
				<div class="pull-right">
			  		<button type="submit" class="btn-primary">Resubmit</button>
				</div>
			</div>
		</form>
        
        
      <hr>
    <script>

		 
	</script>