<div class="span9">
	<table class="table">
			<thead>
			  <tr>
				<th>Quest</th>
				<th></th>
				<th></th>
			  </tr>
			</thead>
			<tbody>
<?php foreach ($quests as $quest) :?>

					  <tr>
						<td><div class="span3"><?php echo $quest->name;?></div></td>
						<td><?php echo $quest->instructions;?></td>
						<td><div class="span3"><a>view</a> / <a>modify</a> / <a>delete</a></div></td>
					  </tr>					
					  <?php endforeach;?>
			</tbody>
	</table>

</div>