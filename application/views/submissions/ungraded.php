<div class="span10">
<?php if ($submissions):?>
	<table class="table">
			<thead>
			  <tr>
				<th>Submission</th>
				<th></th>
				<th></th>
			  </tr>
			</thead>
			<tbody>
<?php foreach ($submissions as $submission) :?>

					  <tr>
						<td><div class="span6">
						<?php if($submission->file):?>
						<a href="<?= base_url('admin/file/grade/'.$submission->id) ?>" title="View and grade this submission">
						<?php else:?>
						<a href="<?= base_url('admin/submission/'.$submission->id) ?>" title="View and grade this submission">
						<?php endif;?>
						<?php echo $submission->quest;?>
						</a>
						
						</div></td>
						<td><?php echo $submission->username;?></td>
						<td></td>
					  </tr>					
					  <?php endforeach;?>
			</tbody>
	</table>
	<?php else:?>
	<h2>There are no new submissions</h2>
	<?php endif;?>

</div>