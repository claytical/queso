<div>
<h1><?php echo $headline ?></h1>
<div class="row-fluid">
<?php echo $body;?>
<?php if($file):?>
<h4>Attachment</h4>
<p><a href='<?= base_url('uploads/'.$file);?>'><?= $file;?></a></p>
<?php endif;?>

</div>
