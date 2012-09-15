<div class="span10">
<h1>Course Setup Checklist</h1>
	<table class="table">
			<thead>
			  <tr>
				<th style="width:25%">Task</th>
				<th style="width:40%">Description</th>
				<th style="width:15%"></th>
				<th style="width:15%">Completed</th>
			  </tr>
			</thead>
			<tbody>
				<tr>
					<td>Information</td>
					<td>Just the facts</td>
					<td><a href='<?=base_url("admin/course")?>' class='btn btn-block'>Setup</a></td>
					<td>
					<? if ($information):?>
						<span class="badge badge-success"><i class="icon-thumbs-up"></i></span>
					<? else:?>
						<span class="badge badge-warning"><i class="icon-wrench"></i></span>

					<? endif;?>
					</td>
				</tr>

				<tr>
					<td>Skills</td>
					<td>Skills are acquired from quests and pave the way for glory</td>
					<td><a href='<?=base_url("admin/skills")?>' class='btn btn-block'>Create Skills</a></td>
					<td>
					<? if ($skills):?>
						<span class="badge badge-success"><i class="icon-thumbs-up"></i></span>
					<? else:?>
						<span class="badge badge-warning"><i class="icon-wrench"></i></span>

					<? endif;?>
					
					</td>
				</tr>

				<tr>
					<td>Grades</td>
					<td>Grade levels let your students gauge their prowess based on the skills they have acquired</td>
					<td><a href='<?=base_url("admin/grades")?>' class='btn btn-block'>Create Grades</a></td>
					<td>
					<? if ($grades):?>
						<span class="badge badge-success"><i class="icon-thumbs-up"></i></span>
					<? else:?>
						<span class="badge badge-warning"><i class="icon-wrench"></i></span>

					<? endif;?>
					
					</td>
				</tr>

				<tr>
					<td>Quests</td>
					<td>Quests allow people to gain skills and be on their way to magnificent grades</td>
					<td><a href='<?=base_url("admin/quest/create")?>' class='btn btn-block'>Create a Quest</a>
					</td>
					<td>
					<? if ($quests):?>
						<span class="badge badge-success"><i class="icon-thumbs-up"></i></span>
					<? else:?>
						<span class="badge badge-warning"><i class="icon-wrench"></i></span>

					<? endif;?>
					
					</td>
				</tr>


				<tr>
					<td>Posts</td>
					<td>Like all epic journeys, you should tell people what's going on.  You must post something to the front page in order for the checklist to go away.</td>
					<td><a href='<?=base_url("admin/post/create")?>' class='btn btn-block'>Post Something</a></td>
					<td>
					<? if ($posts):?>
						<span class="badge badge-success"><i class="icon-thumbs-up"></i></span>
					<? else:?>
						<span class="badge badge-warning"><i class="icon-wrench"></i></span>

					<? endif;?>
					
					</td>
				</tr>

				<tr>
					<td>Students</td>
					<td>Without students there would be no one to play your game!</td>
					<td><a href='<?=base_url("register")?>' class='btn btn-block'>Create Accounts</a></td>
					<td>
					<? if ($users):?>
						<span class="badge badge-success"><i class="icon-thumbs-up"></i></span>
					<? else:?>
						<span class="badge badge-warning"><i class="icon-wrench"></i></span>

					<? endif;?>
					
					</td>
				</tr>

			</tbody>
	</table>

</div>