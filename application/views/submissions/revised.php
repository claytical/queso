<div class="span10">
	<?php if ($submissions):?>

	<table class="table">
			<thead>
			  <tr>
				<th>Submission</th>
				<th>User</th>
				<th>Time</th>
				<th></th>
			  </tr>
			</thead>
			<tbody>
<?php foreach ($submissions as $submission) :?>

					  <tr>
						<td><div class="span6">
						<?php if ($submission->file):?>
							<a href="<?= base_url('admin/file/grade/'.$submission->id) ?>" title="View this submission for grading">	<?php echo $submission->quest;?>
</a>

						<?php else:?>
							<a href="<?= base_url('admin/submission/'.$submission->id) ?>" title="View this submission for grading"><?php echo $submission->quest;?>
</a>
						<?php endif;?>
						
						</div></td>
						<td><?php echo $submission->username;?></td>
						<td><?php echo date("D, d M Y H:m", $submission->submitted);?></td>
						<td><div>
						</div></td>
					  </tr>					
					  <?php endforeach;?>
			</tbody>
	</table>
	<?php else:?>
	<h2>There are no revised submissions</h2>
	<?php endif;?>
</div>