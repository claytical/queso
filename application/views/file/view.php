<div class="span10">
<h1><?php echo $quest ?></h1>


<div class="row-fluid">

	<div class="span8"><p class="lead"><?php echo $instructions;?></p></div>
	<div class="span4">
	<?php if (!empty($progress)):?>
	<table class="table table-condensed">
			<thead>
			  <tr>
				<th>Skill</th>
				<th>Points</th>
			  </tr>
			</thead>
			<tbody>
			<?php foreach ($progress as $prog):?>
			  <tr>
				<td><?php echo $prog['skill'];?></td>
				<td>
					<div class="progress progress-success">
					  <div class="bar" style="width: <?php echo $prog['percentage'];?>%;"><?php echo $prog['amount'];?></div>
					</div>
				</td>
			  </tr>
			<?php endforeach;?>
			<tr>
			<td colspan="2">
			<a href='<?= base_url('quest/upload/'.$qid) ?>' class="btn btn-primary pull-right">Revise</a>
			</td>
			</tr>
			</tbody>
		  </table>
	<?php else:?>
		<div class="well">
		<p>This quest has not been reviewed yet.</p>
		<p>
			<a href='<?= base_url('quest/upload/'.$qid) ?>' class="btn btn-primary">Resubmit Anyway</a>
		</p>
		</div>
	<?php endif;?>
	</div>
</div>
	<div class="well">
	<a href="<?= base_url('uploads/'.$filename) ?>"><?= $filename?></a></div>
</div>
<div class="span10">
	<h3>Notes</h3>
	<?php if (!$note):?>
		<p>There are no notes</p>
	<?php else:?>
			<blockquote>
			  <p><?= $note;?></p>
			</blockquote>
	<?php endif;?>

	
</div>