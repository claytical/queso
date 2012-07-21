<?php if(!empty($quests)):?>
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
						<td colspan="2"><div><h4>
						<?php if($quest['quest']->type == 2):?>
						<a href="<?//= base_url('submission/'.$quest['quest']->sid);?>"><?php echo $quest['quest']->name;?></a>

						<?php else:?>
						<?php echo $quest['quest']->name;?>

						<?php endif;?>
						</h4></div>
						<div><em><?php echo date("l, n/d/Y @ h:m a", $quest['quest']->completed);?></em></div>
						
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
					  
					<tr>
						
						<td></td>
						<td></td>
						<td>
						<?php foreach($summary as $skillSummary) :?>
						<div>
							<strong>Total <?php echo $skillSummary->name;?></strong><span class="pull-right"><?php echo $skillSummary->amount;?></span>
						</div>
						<?php endforeach;?>
						</td>
					</tr>
					  
					  
			</tbody>
	</table>
<?php else:?>
<h2>You haven't completed any quests</h2>
<?php endif;?>