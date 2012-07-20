<div class="span9">
	<table class="table">
			<thead>
			  <tr>
				<th>Quest</th>
				<th></th>
				<th></th>
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

</div>