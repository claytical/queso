<div class="row-fluid">
<div class="span2">&nbsp;</div>
<div class="span10">
<br/>

<?php if(!empty($quests)):?>
	<table class="table table-hover">
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
						<td colspan="2"><div><h4>
						<?php if($quest['quest']->type == 2):?>
							<a href="<?= base_url('admin/submission/'.$quest['submission']['id']);?>"><?php echo $quest['quest']->name;?></a>

						<?php elseif ($quest['quest']->type == 3):?>
							<a href="<?= base_url('admin/file/grade/'.$quest['submission']['id']);?>"><?php echo $quest['quest']->name;?></a>

						<?php else:?>
						<?php echo $quest['quest']->name;?>

						<?php endif;?>
						</h4></div>
						<div><p><em><?php echo date("l, n/d/Y @ h:m a", $quest['quest']->completed);?></em></p></div>
						<?php if($quest['quest']->note != $quest['quest']->name):?>
						<p><?=$quest['quest']->note;?></p>
						<? endif;?>
						
						</td>
						<td>
							<table class="table table-condensed">
									<thead>
									  <tr>
										<th>Skill</th>
										<th>Points</th>
									  </tr>
									</thead>
									<tbody>
									<?php foreach ($quest['progress'] as $prog):?>
									  <tr>
										<td style="width:50%;"><?php echo $prog['skill'];?></td>
										<td style="width:50%;">
											<div class="progress progress-success">
											  <div class="bar" style="width: <?php echo $prog['percentage'];?>%;"><?php echo $prog['amount'];?></div>
											</div>
										</td>
									  </tr>
									<?php endforeach;?>
									</tbody>
								  </table>
						</td>
					  </tr>					

					  <?php endforeach;?>
					  
					  <?php foreach($summary as $skillSummary) :?>
							<tr>
								<td colspan="2">
								<strong>Total <?php echo $skillSummary->name;?></strong>
								</td>
								<td><span class="pull-right"><?php echo $skillSummary->amount;?></span>
								</td>
							</tr>
						<?php endforeach;?>
			</tbody>
	</table>
<?php else:?>
<h2>No quests completed</h2>
<?php endif;?>
</div>
</div>