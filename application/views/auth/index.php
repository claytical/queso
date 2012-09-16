<div class="span10">
	<?php if($message):?>
	<div class="alert">
		<button class="close" data-dismiss="alert">x</button>
		<?php echo $message;?>
	</div>
	<?php endif;?>

<table class="table table-hover">
	<thead>
	<tr>
		<th>Name</th>
		<th>Level</th>
		<th>Email</th>
		<th>Status</th>
	</tr>
	</thead>
	<?php foreach ($users as $user):?>
		<tr>
		
			<td><b><a href="<?=base_url('admin/user/'.$user->id)?>"><?php echo $user->username;?></a></b>
			
			<div id="user-<?= $user->id?>" class="collapse">
			
			<?php foreach($user->grade as $current_skill):?>
					<h6><?=  $current_skill['skill']?></h6>
				
					<div class="progress progress-striped progress-info">
						<div class="bar" style="text-align: left; padding-left: 10px;width: <?= $current_skill['amount'] / $current[0]['next_amount'] * 100?>%;">
						<?=  $current_skill['amount']?> 
						</div>
					</div>
			<?php endforeach;?>
				</div>

			
			
			
			</td>
			<td>
			
				<span class="badge" data-toggle="collapse" data-target="#user-<?= $user->id?>" style="cursor:pointer">
				<?php if (!empty($user->grade[0]['current_level'])):?>
				<?=$user->grade[0]['current_level'];?>
				</span>
				<?php else:?>
				None
				<?php endif;?>				
			</td>
			<td><?php echo $user->email;?></td>
			<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, 'Deactivate', 'class="btn btn-danger btn-block"') : anchor("auth/activate/". $user->id, 'Activate','class="btn btn-success btn-block"');?></td>
		</tr>
	<?php endforeach;?>
</table>
<p>
<a href="<?php echo site_url('auth/create_user');?>" class="btn-primary btn">Create a new user</a>
</p>
<script>
$("table").addTableFilter({
  labelText: "",
});
$('p.formTableFilter input').attr("placeholder", "Type here to filter students");
$('p.formTableFilter input').attr("class", "span4");
var pop = "<a class='badge badge-info pop-help' data-content='If there are too many results you can type a keyword to filter by.  All columns will be filtered.' data-original-title='Filtering'><i class='icon-question-sign'></i></a>";
$('p.formTableFilter input').after(" " + pop);

</script>
</div>