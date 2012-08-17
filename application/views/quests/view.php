<div class="span9">
<h2><?php echo $quests['name'] ?></h2>
<p class="lead"><?php echo $quests['instructions'];?></p>
<?php if($quests['file']):?>
<h4>Attachment</h4>
<p><a href='<?= base_url('uploads/'.$quests['file']);?>'><?= $quests['file'];?></a></p>
<?php endif;?>
</div>