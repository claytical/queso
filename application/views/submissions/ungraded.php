<div>
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
						<td><div class="span6"><?php echo $submission->quest;?></div></td>
						<td><?php echo $submission->username;?></td>
						<td><div class="span2">
						<?php if($submission->file):?>
						<a href="<?= base_url('admin/file/grade/'.$submission->id) ?>">
						<?php else:?>
						<a href="<?= base_url('admin/submission/'.$submission->id) ?>">
						<?php endif;?>
						<span class="badge badge-inverse"><i class="icon-eye-open"></i></span></a></div></td>
					  </tr>					
					  <?php endforeach;?>
			</tbody>
	</table>
	<?php else:?>
	<h2>There are no new submissions</h2>
	<?php endif;?>

</div>