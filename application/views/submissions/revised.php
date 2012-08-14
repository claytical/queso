<div>
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
						<td><div class="span6"><?php echo $submission->quest;?></div></td>
						<td><?php echo $submission->first_name . " " . $submission->last_name;?></td>
						<td><?php echo date("D, d M Y H:m", $submission->submitted);?></td>
						<td><div>
						<?php if ($submission->file):?>
							<a href="<?= base_url('admin/file/grade/'.$submission->id) ?>"><span class="badge badge-inverse"><i class="icon-eye-open"></i></span></a>

						<?php else:?>
							<a href="<?= base_url('admin/submission/'.$submission->id) ?>"><span class="badge badge-inverse"><i class="icon-eye-open"></i></span></a>
						<?php endif;?>
						</div></td>
					  </tr>					
					  <?php endforeach;?>
			</tbody>
	</table>
	<?php else:?>
	<h2>There are no revised submissions</h2>
	<?php endif;?>
</div>