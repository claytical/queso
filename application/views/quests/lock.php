        <div class="span9">
		<?php
        	$attributes = array('class' => 'well form-horizontal');
			echo form_open('quest/skills', $attributes);
  		?>
  		<h1><?php echo $title ?></h1>
        <input type="hidden" name="title" value="<?php echo $title ?>">
        <input type="hidden" name="qid" value="<?php echo $id ?>">
  		<?php foreach ($skills as $skill) :?>
			<input type="hidden" name="skill[]" value="<?php echo $skill['id'];?>">
		<?php endforeach ?>
			<p class="lead">You've chosen to lock this quest to students that don't have enough points.  You can determine the thresholds here.</p>
			
			<div class="form-actions">
				<div class="pull-right">
			  		<button type="submit" class="btn-primary">Lock this Quest</button>
			  		<button type="submit" class="btn">Cancel</button>
				</div>
			</div>		
			</form>
        
		</div>
      <hr>