<div class="span9">
<h2><?= $details['name']?></h2>
<div class="row-fluid">
<?php if ($students):?>
<table class="table">
	<thead>
	  <tr>
		<th style="width:25%">Student</th>
		<th style="width:40%">Note</th>
		<th style="width:20%">Completed</th>
		<th style="width:15%"></th>
	  </tr>
	</thead>
	<tbody>
	
	<?php foreach ($students as $student) :?>

	  <tr>
		<td><h4><?= $student->username;?></h4></td>
		<td><?= $student->note;?></td>
		<td><?= date("F jS, Y", $student->completed);?></td>

		<td>
			<a href="<?= base_url('admin/quest/kill/'.$details['id'].'/'.$student->uid) ?>" class="btn btn-danger">Remove</a>
		</td>
	  </tr>					
	<?php endforeach;?>
	</tbody>
</table>
<?php else:?>
<p class="lead">No one has completed this quest!</p>
<?php endif;?>
</div>
	
<p class="lead"><?php //echo $quests['instructions'];
?></p>
</div>