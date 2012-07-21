	<?php if($message):?>
	<div class="alert">
		<button class="close" data-dismiss="alert">x</button>
		<?php echo $message;?>
	</div>
	<?php endif;?>

<table class="table">
	<tr>
		<th>Name</th>
		<th>Email</th>
		<th>Groups</th>
		<th>Status</th>
	</tr>
	<?php foreach ($users as $user):?>
		<tr>
			<td><?php echo $user->username;?></td>
			<td><?php echo $user->email;?></td>
			<td>
				<?php foreach ($user->groups as $group):?>
					<?php echo $group->name;?><br />
                <?php endforeach?>
			</td>
			<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, 'Deactivate', 'class="btn btn-danger"') : anchor("auth/activate/". $user->id, 'Activate','class="btn btn-success"');?></td>
		</tr>
	<?php endforeach;?>
</table>

<a href="<?php echo site_url('auth/create_user');?>" class="btn-primary btn">Create a new user</a>