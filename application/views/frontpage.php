
<?php if ($logged_in):?>
<div class="span11">
<?php endif;?>
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
<?php if ($logged_in):?>

</div>
<?php endif;?>