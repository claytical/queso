<div class="span12">
	<div class="span3">
	<h3>Popular Quests</h3>
	<ul class="unstyled">
	<?php foreach ($popular_quests as $quest):?>
		<li><a href='<?= base_url("admin/quest/details/".$quest->qid);?>'><?= $quest->name;?></a></li>
	<? endforeach;?>
	</ul>
	</div>

	<div class="span3">
	<h3>Unpopular Quests</h3>
	<ul class="unstyled">
	<?php foreach ($unpopular_quests as $quest):?>
		<li><a href='<?= base_url("admin/quest/details/".$quest->qid);?>'><?= $quest->name;?></a></li>
	<? endforeach;?>
	</ul>
	</div>

	<div class="span3">
	<h3>Total Skills Gained</h3>
	<ul class="unstyled">
	<?php foreach ($skills_gained as $skill):?>
		<li><?= $skill->name;?> <span class='badge pull-right'><?= $skill->total ?></span></li>
	<? endforeach;?>
	</ul>
	
	</div>
	<?php foreach ($top_skills as $skill_user):?>
	<div class="span3 top-skills">
	<h3>Highest <?= $skill_user['name'];?></h3>
		<ul class="unstyled">
		<?php foreach($skill_user['users'] as $user):?>
		<li><a href='<?= base_url("admin/user/".$user['uid'])?>' rel="tooltip" data-placement="right" title="<?=$user['grades']['current_level']." / " . $user['amount'];?>"><?= $user['name']?></a></li>
		<?php endforeach;?>
		</ul>
	</div>
	<?php endforeach;?>
	
	<?php foreach ($low_skills as $skill_user):?>
	<div class="span3 top-skills">
	<h3>Lowest <?= $skill_user['name'];?></h3>
		<ul class="unstyled">
		<?php foreach($skill_user['users'] as $user):?>
		<li><a href='<?= base_url("admin/user/".$user['uid'])?>' rel="tooltip" data-placement="right" title="<?=$user['grades']['current_level']." / " . $user['amount'];?>"><?= $user['name']?></a></li>
		<?php endforeach;?>
		</ul>
	</div>
	<?php endforeach;?>
</div>