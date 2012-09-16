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
  		<h3>Edit Post</h3>
  		<p class="lead"></p>
  			<fieldset>
  				<div class="control-group">
			  		<label class="control-label" for="headline">Headline</label>
					<div class="controls">
						<input type="text" id="headline" name="headline" placeholder="Name of page or headline" value="<?php print $title;?>">
					</div>
				</div>
  				<div class="control-group">
					<div class="controls">
						<textarea type="text" id="body" name="body"><?php print $body;?></textarea>
					</div>
				</div>
  				<div class="control-group">
					<label class="control-label" for="userfile">Supplemental File</label>
					<? if($file):?>

						<div class="controls" id="file">
						<a href='<?=base_url('uploads/'.$file)?>'><?=$file?></a> <a class='btn btn-danger btn-mini remove-file' href='#'><i class='icon-remove-sign'></i></a>
						<? else:?>
						<div class="controls" id="file">
						<input type="file" name="userfile" class="span8"/>
					<? endif;?>
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
<script>
$('.remove-file').click( function() {
	event.preventDefault();

	$.post("<?=base_url('admin/post/rmfile/'.$pid);?>");
	$('#file').html('<input type="file" name="userfile" class="span8"/>');
});


</script>