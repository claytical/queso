<div class="span9">

<h1><?php echo $title ?></h1>
	<p class="lead">
	</p>
<select id="creativity">
<option value="10">ten</option>
<option value="60">sixtee</option>
<option value="100">hundred</option>
</select>
<table id="progress" style="display: none">
	<caption>Progress Over Time</caption>
	<thead>
		<tr>
			<td></td>
			<?php foreach($progress['dates'] as $date):?>
			<th scope="col"><?php print date("n/j",$date->completed);?></th>
			<?php endforeach;?>
		</tr>
	</thead>
	<tbody>
			<?php foreach($progress['progress'] as $row): ?>
				<tr>
				<th scope="row"><?php print $row['name'];?></th>
				<?php foreach($row['values'] as $col):?>
					<td><?php print $col;?></td>
				<?php endforeach;?>
				</tr>
			<?php endforeach;?>
	
	</tbody>
</table>        
<script>
$('table#progress').visualize({type: 'area'});
</script>
<hr>
