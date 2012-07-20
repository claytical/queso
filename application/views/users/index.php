
        <div class="span9">
			<h1><?php echo $title ?></h1>
			<p class="lead"><?php echo $instructions ?></p>
			<table class="table">
					<thead>
					  <tr>
						<th>First</th>
						<th>Last</th>
						<th>Email</th>
						<th></th>
					  </tr>
					</thead>
					<tbody>
					  <?php foreach ($users as $user):?>
					  <tr>
						<td><?php echo $user->first;?></td>
						<td><?php echo $user->last;?></td>
						<td><?php echo $user->email;?></td>
						<td><a>view</a> / <a>modify</a> / <a>delete</a></td>
					  </tr>					
					  <?php endforeach;?>
					</tbody>
			</table>
		</div>