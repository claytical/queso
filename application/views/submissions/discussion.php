<div class="span10">
<?php if(!empty($submissions)):?>

	<table class="table table-hover">
			<thead>
			  <tr>
				<th style="width:25%">Quest</th>
				<th style="width:50%"></th>
				<th style="width:15%">Started by</th>
				<th style="width:10%">Responses</th>
			  </tr>
			</thead>
			<tbody>
				<?php foreach ($submissions as $submission) :?>
					  <tr>
						<td><b><a href="<?=base_url('discuss/'.$submission->id);?>"><?php echo $submission->name;?></a></b></td>
						<td><?php echo substr(strip_tags($submission->text),0,75);?>...</td>
						<td><?php echo $submission->username;?></td>
						<td><span class="pull-right"><?php echo $submission->responses;?></span></td>
					  </tr>					
					<?php endforeach;?>
			</tbody>
	</table>
<?php else:?>
<h2>There are no submissions available for discussion right now</h2>
<?php endif;?>
</div>