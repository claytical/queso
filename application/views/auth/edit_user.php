<div class="span9">
<h1>Edit User</h1>

	<?php if($message):?>
	<div class="alert">
		<button class="close" data-dismiss="alert">x</button>
		<?php echo $message;?>
	</div>
	<?php endif;?>

<?php
echo form_open(current_url());?>

      <p>
            First Name: <br />
            <?php echo form_input($first_name);?>
      </p>

      <p>
            Last Name: <br />
            <?php echo form_input($last_name);?>
      </p>

      <p>
            Password: (if changing password)<br />
            <?php echo form_input($password);?>
      </p>

      <p>
            Confirm Password: (if changing password)<br />
            <?php echo form_input($password_confirm);?>
      </p>


      <?php echo form_hidden('id', $user['id']);?>
      <?php echo form_hidden($csrf); ?>

      <p><?php echo form_submit('submit', 'Save User');?></p>

<?php echo form_close();?>
</div>