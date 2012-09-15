
        <div class="span10">
			<h1><?php echo $title ?></h1>
			<p class="lead"><?php echo $instructions ?></p>
			<table class="table">
					<thead>
					  <tr>
						<th>Grade</th>
						<th>Amount</th>
						<th></th>
					  </tr>
					</thead>
					<tbody>

					  <tr>
						<td>
						<span class="grade-title"></span>
						<input class="grade-editing-label" placeholder="Label" type="text" name="new-grade-title">

						</td>

						<td>						
						<input class="grade-editing-amount" type="text" placeholder="Amount" name="new-grade-amount">
						</td>
						
						<td><button class="btn-primary btn-large add pull-right">Add New Grade</button></td>
					  </tr>					
					
					<?php foreach ($grades as $grade):?>

					  <tr>
						<td>
						<span class="grade-title"><?php echo $grade->label; ?></span>

						<input type="hidden" name="grade-number" class='grade-number' value="<?php echo $grade->id?>">
						<input class="hidden grade-editing" type="text" name="grade-title" value="<?php echo $grade->label;?>">
	
						</td>
						
						<td>
						<span class="grade-amount"><?php echo $grade->amount; ?></span>
						<input class="hidden grade-editing-amount" type="text" name="grade-amount" value="<?php echo $grade->amount;?>">

						</td>
						<td>
						<div class="btn-group pull-right">
						<button class="btn hidden grade-save">
						<span class="add-on"><i class="icon-ok"></i></span>
						</button>
						<button class="btn grade-edit">
						<span class="add-on">
						<i class="icon-pencil"></i></span>
						</button>

						<button class="btn remove btn-danger"><i class="icon-trash"></i></button>
						</div>
						</td>
					  </tr>

					<?php endforeach ?>
					</tbody>
				  </table>

      <hr>
      </div>
	<script>
	
	$('button.grade-save').click( function() {
		event.preventDefault();
		//save new title
		
		//hide editable fields
		$(this).parent().parent().parent().children().children(".grade-title").show();
		var gradename = $(this).parent().parent().parent().children().children(".grade-editing").val();
		var gradeamount = $(this).parent().parent().parent().children('td').children('.grade-editing-amount').val();
		var gradenum = $(this).parent().parent().parent().children('td').children(".grade-number").val();
		$.post("grade/edit", { id: gradenum, label: gradename, amount:gradeamount } );
		$(this).parent().parent().parent().children().children(".grade-title").html(gradename);
		$(this).parent().parent().parent().children().children(".grade-amount").html(gradeamount);
		$(this).parent().parent().parent().children().children(".grade-amount").show();
		$(this).parent().children(".grade-edit").show();
		$(this).parent().parent().parent().children().children(".grade-editing").addClass("hidden");
		$(this).parent().parent().parent().children().children(".grade-editing-amount").addClass("hidden");
		$(this).parent().children(".grade-save").addClass("hidden");
	});
	
	$('button.grade-edit').click( function() {
		//show editable fields
		event.preventDefault();
		$(this).parent().parent().parent().children().children(".grade-title").hide();
		$(this).parent().parent().parent().children().children(".grade-amount").hide();
		$(this).parent().children(".grade-edit").hide();
		$(this).parent().parent().parent().children().children(".grade-editing-amount").removeClass("hidden");
		$(this).parent().parent().parent().children().children(".grade-editing").removeClass("hidden");
		$(this).parent().children(".grade-save").removeClass("hidden");

	});

	$('button.remove').click( function() {
		var gradenum = $(this).parent().parent().parent().children().children(".grade-number").val();
		$.post("grade/remove", { id: gradenum } );
		$(this).parent().parent().parent().remove();
	});

	$('button.add').click( function() {
		var gradename = $(this).parent().parent().children('td').children('.grade-editing-label').val();
		var gradeamount = $(this).parent().parent().children('td').children('.grade-editing-amount').val();

		$.post("grade/create", { label: gradename, amount: gradeamount },
		   function(data) {
		   	window.location = "grade";
		   });
		
	});

	</script>