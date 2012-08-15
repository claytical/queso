<?php if($quests):?>
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
						<td><h4><a href='<?=base_url("admin/quest/details/".$quest->id)?>'><?= $quest->name;?></a></h4></td>
						<td><?php echo $quest->instructions;?></td>
						<td>
						<a class="btn btn-danger" href="quest/remove/<?php echo $quest->id;?>" title="Remove this quest and everything related to it"><i class="icon-trash"></i></a>

						<?php if ($quest->hidden):?>
							<a class="btn btn-success" href='quest/activate/<?php echo $quest->id;?>'>show</a>
						<?php else:?>
							<a class="btn btn-warning" href='quest/deactivate/<?php echo $quest->id;?>'>hide</a>
						<?php endif;?>

						</td>
					  </tr>					
					  <?php endforeach;?>
			</tbody>
	</table>

<?php else:?>
<p class="lead">No quests have been created, click <a href="<?= base_url('admin/quest/create')?>">here</a> to create one.</p>
<?php endif;?>