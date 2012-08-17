<?php if(!empty($quests)):?>

	<table class="table">
			<thead>
			  <tr>
				<th style="width:25%">Quest</th>
				<th style="width:60%"></th>
				<th style="width:15%"></th>
			  </tr>
			</thead>
			<tbody>
<?php foreach ($quests as $quest) :?>

					  <tr>
						<td><h4><?php echo $quest['info']->name;?></h4></td>
						<td><?php echo $quest['info']->instructions;?></td>
						<td>
						<?php if($quest['info']->type == 1 && $quest['info']->file):?>
							<a href="<?= base_url('uploads/'.$quest['info']->file);?>" class='btn-primary btn'>Download</a>
						<?php endif;?>
						<?php if($quest['info']->type == 2):?>
							<a href="<?= base_url('quest/attempt/'.$quest['info']->id);?>" class='btn-primary btn'>Attempt</a>
						<?php endif;?>
						<?php if($quest['info']->type == 3):?>
							<a href="<?= base_url('quest/upload/'.$quest['info']->id);?>" class='btn-primary btn'>Upload</a>
						<?php endif;?>
						<?php if($quest['info']->type == 4):?>
							<a href="<?= base_url('discussions');?>" class='btn-primary btn'>Discussions</a>
						<?php endif;?>

						</td>
					  </tr>					
					  <?php endforeach;?>
			</tbody>
	</table>
<?php else:?>
<h2>There are no quests available right now</h2>
<?php endif;?>
