        <div class="span10">
		
			<?php
				$attributes = array('class' => 'well form-horizontal');
				echo form_open_multipart('', $attributes);
  			?>
  			<?php if(validation_errors()):?>
				<div class="alert">
				<button class="close" data-dismiss="alert">x</button>
				<?php echo validation_errors();?>
				</div>
			<?php endif;?>
  		<h1>Create Post</h1>
  		<p class="lead"></p>
  			<fieldset>
  				<div class="control-group">
			  		<label class="control-label" for="headline">Headline <a class='badge badge-info pop-help' data-content="This will be the title of your post.  If you choose to put this post on the menu, this title will also be used there." data-original-title="Headline"><i class='icon-question-sign'></i></a></label>
					<div class="controls">
						<input type="text" id="headline" name="headline" class="span6" placeholder="Name of page or headline">
					</div>
				</div>
  				<div class="control-group">
					<div class="controls">
						<textarea type="text" id="body" name="body" class="span6"></textarea>
					</div>
				</div>
				
  				<div class="control-group">
			  		<label class="control-label" for="userfile">Supplemental File <a class='badge badge-info pop-help' data-content="You can upload a file and it will be attached to the post.  Students will be able to download it when they view the post." data-original-title="Supplemental File"><i class='icon-question-sign'></i></a></label>
					<div class="controls">
					<input type="file" name="userfile" class="span8"/>
					</div>
				</div>
				
  				<div class="control-group">
					<div class="controls">
						<label>
						<input type="checkbox" id="frontpage" name="frontpage" value="1"> Publish to Front Page</input> <a class='badge badge-info pop-help' data-content="By checking this box, this post will show up on the front page in the list of posts.  File attachments are not shown in this list." data-original-title="Front Page"><i class='icon-question-sign'></i></a></label>
					</div>
				</div>

			</fieldset>

			<div class="form-actions">
				<div class="pull-right">
			  		<button type="submit" class="btn-primary">Post</button>
				</div>
			</div>
		</form>
        
        
      <hr>
