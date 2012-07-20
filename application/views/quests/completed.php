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
			</tbody>
	</table>

</div>