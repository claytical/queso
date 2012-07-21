
	<table class="table">
			<thead>
			  <tr>
				<th style="width:25%">Quest</th>
				<th style="width:60%"></th>
				<th style="width:15%"></th>
			  </tr>
			</thead>
			<tbody>
<?php foreach ($quests as $quest) :?>

					  <tr>
						<td><h4><?php echo $quest->name;?></h4></td>
						<td><?php echo $quest->instructions;?></td>
						<td><a>view</a> / <a>modify</a></td>
					  </tr>					
					  <?php endforeach;?>
			</tbody>
	</table>

</div>