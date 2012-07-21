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
						<td><a href="<?= base_url('quest/attempt/'.$quest['info']->id);?>" class='btn-primary btn'>Attempt</a></td>
					  </tr>					
					  <?php endforeach;?>
			</tbody>
	</table>
<?php else:?>
<h2>There are no quests available right now</h2>
<?php endif;?>
