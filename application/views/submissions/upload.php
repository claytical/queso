    <div class="span10">
		<?php			
			echo validation_errors();
        	$attributes = array('class' => 'well');
			echo form_open('quest/attempt/post', $attributes);
  		?>
  		<h1><?php echo $title ?></h1>
			<p class="lead"><?php echo $instructions ;?></p>
  			<fieldset>
  				<div class="control-group">
					<div class="controls">
						<textarea type="text" id="quest" name="submission" class="span8" placeholder="What's this quest about?"></textarea>
					</div>
				</div>
  				<div class="control-group">
					<div class="controls">
						<input type="checkbox" id="visible" name="visible"> Visible to Others</input>
					</div>
				</div>

			</fieldset>
			<input type="hidden" name="quest" value="<?php echo $id ;?>">
			<input type="hidden" name="attempt" value="<?php echo $attempt ;?>">

			<div class="form-actions">
				<div class="pull-right">
			  		<button type="submit" class="btn-primary">Attempt Quest</button>
				</div>
			</div>
		</form>