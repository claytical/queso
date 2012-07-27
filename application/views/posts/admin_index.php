

	<table class="table">
			<thead>
			  <tr>
				<th style="width:25%">Post</th>
				<th style="width:40%"></th>
				<th style="width:15%"></th>
			  </tr>
			</thead>
			<tbody>
<?php foreach($posts as $post):?>
					  <tr>
						<td><h4><?php echo $post->headline;?></h4></td>
						<td colspan="2"><?php echo substr(strip_tags($post->body),0, 255);?>...</td>
						<td><div>
						<a href='post/edit/<?php echo $post->id;?>' class="btn" title="edit"><i class="icon-pencil"></i></a>
						<a href='post/delete/<?php echo $post->id;?>' class="btn" title="delete"><i class="icon-trash"></i></a>
						<?php if($post->frontpage):?>
						<a href='post/demote/<?php echo $post->id;?>' class="btn btn-warning" title="demote from front page"><i class="icon-arrow-down"></i></a>
						<?php else:?>
						<a href='post/promote/<?php echo $post->id;?>' class="btn btn-success" title="promote to front page"><i class="icon-star"></i></a></div></td>
					  	<?php endif;?>
					  </tr>					
					  <?php endforeach;?>
			</tbody>
	</table>
