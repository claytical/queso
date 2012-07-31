    <div class="span9">
		<?php			
			echo validation_errors();
        	$attributes = array('class' => 'well');
			echo form_open_multipart('file/do_upload/'.$id, $attributes);
  		?>
  		<h1><?php echo $title ?></h1>
			<p class="lead"><?php echo $instructions ;?></p>
  			<fieldset>
  				<div class="control-group">
					<div class="controls">
					<input type="file" name="userfile" class="span8"/>
					</div>
				</div>

			</fieldset>
			<input type="hidden" name="quest" value="<?php echo $id ;?>">
			<input type="hidden" name="attempt" value="<?php echo $attempt ;?>">
			<input type="hidden" name="notes" value"<?php echo $title;?>">
			<div class="form-actions">
				<div class="pull-right">
			  		<button type="submit" class="btn-primary">Upload Quest</button>
				</div>
			</div>
		</form>
        
        
      <hr>