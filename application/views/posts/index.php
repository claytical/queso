<?php foreach($posts as $post):?>
<div>
	<h1><?php print $post->headline; ?><span class="label pull-right"><?php print date("m/j",$post->created);?></span></h1>
	<div class="row-fluid">
	<?php print $post->body;?>
</div>
<hr>
<?php endforeach;?>