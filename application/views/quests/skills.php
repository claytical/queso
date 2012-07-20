        <div class="span9">
		<?php
        	$attributes = array('class' => 'well form-horizontal');
			echo form_open('admin/quest/confirm', $attributes);
  		?>
  		<h1><?php echo $title ?></h1>
        <input type="hidden" name="title" value="<?php echo $title ?>">
        <input type="hidden" name="qid" value="<?php echo $id ?>">
        <input type="hidden" name="requirements" value="<?php echo $requirements ?>">
		
			<p class="lead"></p>
  			<fieldset>
  				<?php foreach ($skills as $skill) :?>

					<h3><?php echo $skill['name'];?></h3>
					<div id="skill<?php echo $skill['id'];?>">
						<div class="control-group">
							<label class="control-label" for="skill-title">Points</label>
							<div class="controls">
								<div class="input-append">
								<input type="text" id="skill<?php echo $skill['id'];?>label0" name="label[]" class="input" placeholder="Label">
								</div>
								<div class="input-append">
								<input type="text" id="skill<?php echo $skill['id'];?>points0" name="points[]" class="input-medium" placeholder="Amount"><span class="add-on add-button"><i class="icon-plus"></i></span>
								</div>
								<input type="hidden" name="skill[]" value="<?php echo $skill['id'];?>"/>
							</div>
							<label></label>
		
						</div>
					</div>
				<?php endforeach ?>
			</fieldset>
			
			<div class="form-actions">
				<div class="pull-right">
			  		<button type="submit" class="btn-primary">Create Points for Quest</button>
			  		<button type="submit" class="btn">Cancel</button>
				</div>
			</div>		
			</form>
        
		</div>
        
        
      <hr>
	<script>
	$(function(){
		
		$('.add-button').click(function(){
			var count = $(this).parent().parent().parent().parent().children(".control-group").children(".controls").size();
			var skillid = $(this).parent().parent().children("input").val();
			var attribName = $(this).parent().parent().parent().parent().attr("id");
			$(this).parent().parent().parent().append('<div class="controls"><div class="input-append"><input type="text" id="'+attribName+'label'+count+'" name="label[]"  class="input" placeholder="Label"> </div><div class="input-append"> <input type="text" id="'+attribName+'points'+count+'" name="points[]" class="input-medium" placeholder="Amount" style="margin-left:4px;"><span class="add-on remove-button"><i class="icon-remove-sign"></i></span></div><input type="hidden" name="skill[]" value="'+skillid+'"/></div><label></label>');
	
			//register removal
			$('.remove-button').click(function(){
				$(this).parent().parent().remove();
			});
			
		});
	});

	</script>
