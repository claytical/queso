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
						<td><?php echo $submission->first_name . " " . $submission->last_name;?></td>
						<td><div class="span2"><a href="<?= base_url('admin/submission/'.$submission->id) ?>"><span class="badge badge-inverse"><i class="icon-eye-open"></i></span></a></div></td>
					  </tr>					
					  <?php endforeach;?>
			</tbody>
	</table>
	<?php else:?>
	<h2>There are no new submissions</h2>
	<?php endif;?>

</div>