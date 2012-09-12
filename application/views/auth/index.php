<div class="span10">
	<?php if($message):?>
	<div class="alert">
		<button class="close" data-dismiss="alert">x</button>
		<?php echo $message;?>
	</div>
	<?php endif;?>

<table class="table">
	<tr>
		<th>Name</th>
		<th>Level</th>
		<th>Email</th>
		<th>Status</th>
	</tr>
	<?php foreach ($users as $user):?>
		<tr>
		
			<td><a href="<?=base_url('admin/user/'.$user->id)?>"><?php echo $user->username;?></a></td>
			<td>
			
				<span class="badge">
				<?php if (!empty($user->grade[0]['current_level'])):?>
				<?=$user->grade[0]['current_level'];?>
				</span>
				<?php else:?>
				None
				<?php endif;?>
			</td>
			<td><?php echo $user->email;?></td>
			<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, 'Deactivate', 'class="btn btn-danger"') : anchor("auth/activate/". $user->id, 'Activate','class="btn btn-success"');?></td>
		</tr>
	<?php endforeach;?>
</table>
<a href="<?php echo site_url('auth/create_user');?>" class="btn-primary btn">Create a new user</a>

</div>