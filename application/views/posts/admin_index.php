<div class="span10">
<?php if ($posts):?>
	<table id="post-list" class="table table-hover">
			<thead>
			  <tr>
				<th style="width:25%">Post</th>
				<th style="width:60%"></th>
				<th style="width:15%"></th>
			  </tr>
			</thead>
			<tbody>
<?php foreach($posts as $post):?>
					  <tr id="<?= $post->id?>">
						<td><b><a href='post/edit/<?php echo $post->id;?>' title="edit" data-placement="right"><?php echo $post->headline;?></a></b></td>
						<td><?php echo substr(strip_tags($post->body),0, 255);?>...</td>
						<td>
							<div class="btn-group">
							
							<a href='post/delete/<?php echo $post->id;?>' class="btn btn-danger" title="delete"><i class="icon-trash"></i></a>
							<?php if($post->frontpage):?>
									<a href='post/demote/<?php echo $post->id;?>' class="btn btn-warning" title="demote from front page"><i class="icon-arrow-down"></i></a>
								<?php else:?>
									<a href='post/promote/<?php echo $post->id;?>' class="btn btn-success" title="promote to front page"><i class="icon-star"></i></a>
							  	<?php endif;?>
								<?php if($post->menu):?>
									<a href='post/removemenu/<?php echo $post->id;?>' class="btn" title="remove from menu"><i class="icon-minus"></i></a>
								<?php else:?>
									<a href='post/addmenu/<?php echo $post->id;?>' class="btn" title="add to menu"><i class="icon-plus"></i></a>
								<?php endif;?>
									</div>
						</td>
					  </tr>					
					  <?php endforeach;?>
			</tbody>
	</table>

<?php else:?>
<p class="lead">No posts have been created.  Click <a href="<?=base_url('admin/post/create')?>">here</a> to create one.</p>
<?php endif;?>
</div>
<script>
$("table").addTableFilter({
  labelText: "",
});
$('p.formTableFilter input').attr("placeholder", "Type here to filter posts");
$('p.formTableFilter input').attr("class", "span4");
var pop = "<a class='badge badge-info pop-help' data-content='If there are too many results you can type a keyword to filter by.  All columns will be filtered.' data-original-title='Filtering'><i class='icon-question-sign'></i></a>";
$('p.formTableFilter input').after(" " + pop);

 $('#post-list').tableDnD({
 		onDragClass: "info",
        onDrop: function(table, row) {
			$.post("post/reorder", $.tableDnD.serialize());
        }
    });


</script>
