<div class="span7">
	<?php foreach($posts as $post):?>
	<div>
		<h2>
 <?php print $post->headline; ?> 		<span class="badge badge-info pull-right"><?php print date("m/j",$post->created);?></span>
</h2>
		
		<div class="row-fluid">
			<?php print $post->body;?>
		</div>
	<hr>
	</div>
	<?php endforeach;?>
</div>
