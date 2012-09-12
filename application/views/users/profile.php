<div class="span10">
<div class="row-fluid">
		<div class="span4"><h1><?php echo $title ?></h1></div>
</div>

<div class="row-fluid">
<p class="lead">	</p>

</div>
<div class="row-fluid">
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
</div>
</div>
<?php 
$last = array_shift(array_values($grades));
$first = end($grades);
if (!empty($first->amount) && !empty($last->amount)) {
	$threshold = $first->amount - $last->amount;
}
else {
	$threshold = 1;
}
$jsRange = "[";
$jsLabels = "[";
foreach($grades as $grade) {
	$jsRange .= "'".($grade->amount / $threshold) * 100 . "%',";
	$jsLabels .= "'".($grade->label) ."',";
}
$jsRange .= "]";
$jsLabels .= "]";
?>
<script>
$('table#progress').visualize({type: 'area'});
/*$('select#metric2').bulletGraph({
  width: 1000,
  height: 20,
  ranges: <?= $jsRange?>,
  rangesLabels: <?= $jsLabels?>,
  sliderOptions: {
    disabled: true
  }
});
*/

</script>

