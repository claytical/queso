        <div class="span9">
		<?php echo validation_errors(); ?>
		<?php echo form_open('attributes/create') ?>
<!--			<h1>Modify Attributes</h1>
			<p class="lead">Attributes can have their name modified.  Attributes that are already assigned to quests cannot be removed.</p>
			<table class="table">
					<thead>
					  <tr>
						<th>Title</th>
						<th></th>
					  </tr>
					</thead>
					<tbody>
					  <tr>
						<td>
						<span class="attribute-title">Creativity</span>
						<input type="hidden" name="attribute-number[]" value="0">
						<input class="hidden attribute-editing" type="text" id="attribute0-title" name="attribute-title[]" value="Creativity">
						<button class="btn pull-right hidden attribute-save">
						<span class="add-on"><i class="icon-ok"></i></span>
						</button>
						<button class="btn pull-right attribute-edit">
						<span class="add-on">
						<i class="icon-pencil"></i></span>
						</button>
						</td>
						<td><button class="btn-danger pull-right remove">Remove</button></td>
					  </tr>
					</tbody>
				  </table>
-->
		<label for="title">Title</label> 
		<input type="text" name="title" />
		<input type="submit" name="submit" value="Create Attribute"/>
		</form>
        
        
      <hr>
	<script>
	
	$('button.attribute-save').click( function() {
		event.preventDefault();
		//save new title
		
		//hide editable fields
		$(this).parent().children(".attribute-title").show();
		$(this).parent().children(".attribute-edit").show();
		$(this).parent().children(".attribute-editing").addClass("hidden");
		$(this).parent().children(".attribute-save").addClass("hidden");

	});
	
	$('button.attribute-edit').click( function() {
		//show editable fields
		event.preventDefault();
		$(this).parent().children(".attribute-title").hide();
		$(this).parent().children(".attribute-edit").hide();
		$(this).parent().children(".attribute-editing").removeClass("hidden");
		$(this).parent().children(".attribute-save").removeClass("hidden");

	});

	$('button.remove').click( function() {
		alert("Remove");
	});

	</script>