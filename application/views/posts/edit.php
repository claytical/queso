        <div>
		
			<?php
				$attributes = array('class' => 'well form-horizontal');
				echo form_open('', $attributes);
  			?>
  			<?php if(validation_errors()):?>
				<div class="alert">
				<button class="close" data-dismiss="alert">x</button>
				<?php echo validation_errors();?>
				</div>
			<?php endif;?>
  		<h1>Edit Post</h1>
  		<p class="lead"></p>
  			<fieldset>
  				<div class="control-group">
			  		<label class="control-label" for="headline">Headline</label>
					<div class="controls">
						<input type="text" id="headline" name="headline" class="span9" placeholder="Name of page or headline" value="<?php print $title;?>">
					</div>
				</div>
  				<div class="control-group">
					<div class="controls">
						<textarea type="text" id="body" name="body"><?php print $body;?></textarea>
					</div>
				</div>
  				<div class="control-group">
					<div class="controls">
						<label>
						<input type="checkbox" id="frontpage" name="frontpage" value="1" <?php if($frontpage) print "checked";?>> Publish to Front Page</input></label>
					</div>
				</div>

			</fieldset>
			<input name="postid" type="hidden" value="<?php print $pid;?>">
			<div class="form-actions">
				<div class="pull-right">
			  		<button type="submit" class="btn-primary">Post</button>
				</div>
			</div>
		</form>
        
        
      <hr>