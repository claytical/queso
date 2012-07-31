<div class="row-fluid">
	<div class="span12">
		<div class="span4"><h1><?php echo $title ?></h1></div>
		<div class="span8">
			<div class="span3">
			</div>
			<div class="span1"></div>
			<div class="span5">
			<div class="row">

			<label class="badge"><?= $current[0]['current_level']?></label>
			</div>
			<?php foreach($current as $current_skill):?>
			<div class="row">
				<div class="span5">
					<h6><?=  $current_skill['skill']?></h6>
				</div>
				<div class="progress progress-striped progress-success">
					<div class="bar" style="text-align: left; padding-left: 10px;width: <?= $current_skill['amount'] / $current[0]['next_amount'] * 100?>%;">
					<?=  $current_skill['amount']?> 
					</div>
				</div>
			</div>
			<?php endforeach;?>
			</div>
		</div>
	</div>
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
<?php 
$last = array_shift(array_values($grades));
$first = end($grades);
$threshold = $first->amount - $last->amount;
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


<hr>
