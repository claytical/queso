<!DOCTYPE html>
<html lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="">
   <meta name="keywords" content="">
   <meta name="author" content="">

   <title><?= $site_name?></title>
	<link href='http://fonts.googleapis.com/css?family=Fredoka+One|Maven+Pro:400,900' rel='stylesheet' type='text/css'>
   <link href="<?= base_url('assets/css/bootstrap.'.$theme.'.min.css') ?>" rel="stylesheet">
   <link href="<?= base_url('assets/css/bootstrap-responsive.min.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/font-awesome.css') ?>" rel="stylesheet">
   <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
   <link href="<?= base_url('assets/css/custom.css') ?>" rel="stylesheet">
   <link href="<?= base_url('assets/css/chosen.css') ?>" rel="stylesheet">
   <link href="<?= base_url('assets/css/visualize.css') ?>" rel="stylesheet">

   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
    <script src="<?= base_url('assets/js/bootstrap-transition.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap-alert.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap-modal.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap-dropdown.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap-scrollspy.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap-tab.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap-tooltip.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap-popover.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap-button.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap-collapse.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap-carousel.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap-typeahead.js') ?>"></script>
    <script src="<?= base_url('assets/js/chosen.jquery.js') ?>"></script>
    <script src="<?= base_url('assets/js/tiny_mce/tiny_mce.js')?>"></script>
	<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/custom.js') ?>"></script>
	<script src="<?= base_url('assets/js/visualize.jQuery.js') ?>"></script>
	<script src="<?= base_url('assets/js/jquery.table-filter.min.js')?>"></script>
	<script src="<?= base_url('assets/js/jquery.tablednd.0.6.min.js')?>"></script>
	<script type="text/javascript">
	tinyMCE.init({
			mode : "textareas",
			theme : "advanced",
			// Theme options
			theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,cut,copy,paste,pasteword,|,bullist,numlist,|blockquote,|undo,redo,|,link,unlink,|,forecolor,backcolor,|,image",
			theme_advanced_buttons2 : "",
			theme_advanced_buttons3 : "",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,
			width: "100%"
	});
	</script>
</head>
<body>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="<?= base_url('') ?>"><?= $site_name?></a>
			<?php if(!empty($the_user)):?>
          <div class="btn-group pull-right">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="icon-user"></i> <?php echo $the_user->username;?>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
            <?php if($the_user->group_id == 1):?>
              <li><a href="<?= base_url('admin/course/dashboard') ?>">Dashboard</a></li>

			<?php endif;?>
              <li><a href="<?= base_url('user/profile') ?>">Progress Chart</a></li>
              <li class="divider"></li>
              <li><a href="<?= base_url('user/password') ?>">Change Password</a></li>
              <li><a href="<?= base_url('logout') ?>">Sign Out</a></li>

            </ul>
          </div>
          <?php else:?>
          <a class="btn btn-primary btn-large pull-right" href="auth/login">Login</a>

          <?php endif;?>
        </div>
      </div>
    </div>
    
    <div class="subnav subnav-fixed">
    <ul class="nav nav-pills">
		<?php if(!empty($menu)):?>
        <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?= $dropdown;?> <b class="caret"></b></a>
			<ul class="dropdown-menu">
				<?php foreach($menu as $item):?>
				<li><a href="<?= base_url('post') . "/". $item->id?>"><?= $item->headline;?></a></li>
				<?php endforeach;?>
			</ul>
      	</li>
      	<? endif;?>
	<?php if ($logged_in):?>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Quests <b class="caret"></b></a>
        <ul class="dropdown-menu">
		  <li><a href="<?= base_url('quests/available/in-class')?>">In Class</a></li>
		  <li><a href="<?= base_url('quests/available/online')?>">Online</a></li>
	  	  <li><a href="<?= base_url('discussion') ?>">Discussions</a></li>
		  <li><a href="<?= base_url('quests/completed') ?>">Completed</a></li>
        </ul>
        </li>
        
    <?php endif;?>
	<?php if (!empty($the_user)):?>
		<?php if($the_user->group_id == 1):?>
      
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Lists<b class="caret"></b></a>
        <ul class="dropdown-menu">
		  <li><a href="<?= base_url('admin/users') ?>">Students</a></li>
		  <li><a href="<?= base_url('admin/quests') ?>">Quests</a></li>
		  <li><a href="<?= base_url('admin/posts') ?>">Posts</a></li>

        </ul>
      </li>

      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Grading<b class="caret"></b></a>
        <ul class="dropdown-menu">
		  <li><a href="<?= base_url('admin/quest/grade/in-class') ?>">In Class Work</a></li>
		  <li><a href="<?= base_url('admin/submissions/ungraded') ?>">Online Submissions</a></li>
		  <li><a href="<?= base_url('admin/submissions/revised') ?>">Revisions</a></li>

        </ul>
      </li>




      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Create<b class="caret"></b></a>
        <ul class="dropdown-menu">

		  <li><a href="<?= base_url('admin/quest/create') ?>">Quest</a></li>
		  <li><a href="<?= base_url('admin/post/create') ?>">Post</a></li>
		</ul>
	   </li>      


      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Setup<b class="caret"></b></a>
        <ul class="dropdown-menu">
		  <li><a href="<?= base_url('admin/course') ?>">Information</a></li>
		  <li><a href="<?= base_url('admin/skills') ?>">Skills</a></li>
		  <li><a href="<?= base_url('admin/grades') ?>">Grades</a></li>
		  <li><a href="<?= base_url('admin/course/setup') ?>">Checklist</a></li>

        </ul>
      </li>

		
		<?php endif;?>
	<?php endif;?>
      
    </ul>
  </div>
<div id="top" class="container-fluid">
<?php if($logged_in):?>
<div class="span2">
<div class="row">
</div>

<div class="row well">
<?php if($the_user->group_id == 1):?>
			<h6>Administrator</h6>

<p></p>
<? if(count($quests_pending) > 0):?>
<p><span class='badge badge-warning'><?= count($quests_pending);?></span> <a href='<?= base_url("admin/submissions/ungraded")?>'>New Attempts</p></a>
<? endif;?>
<? if (count($quests_revisions)):?>
<p><span class='badge badge-warning'><?= count($quests_revisions);?></span> <a href='<?= base_url("admin/submissions/revised")?>'>New Revisions</p></a>
<? endif;?>
<? if(count($quests_pending) <= 0 && count($quests_revisions) <= 0):?>
<p>There are no submissions to grade</p>
<? endif;?>

<?php else:?>

			<h6>Rank</h6>
			<?php if ($current):?>
			<h4><?=$current[0]['current_level']?></h4><p></p>
			<?php endif;?>

<?php foreach($current as $current_skill):?>
	<h6><?=  $current_skill['skill']?></h6>
	
	<div class="progress progress-striped progress-info">
		<div class="bar" style="text-align: left; padding-left: 10px;width: <?= $current_skill['amount'] / $current[0]['next_amount'] * 100?>%;">
		<?=  $current_skill['amount']?> 
		</div>
	</div>
<?php endforeach;?>
<h6>Quests</h6>
<p></p>
<? if(count($quests_pending) > 0):?>
<span class="label label-warning"><b><?= count($quests_pending);?></b> Attempt<?php if (count($quests_pending) != 1):?>s<? endif;?> Pending</span><br>
<? endif;?>
<? if (count($quests_revisions)):?>
<span class="label label-warning"><b><?= count($quests_revisions);?></b> Revision<?php if (count($quests_revisions) != 1):?>s<? endif;?> Pending</span><br>
<? endif;?>

<b><?= count($quests_available);?></b> <a href='<?=base_url("/quests/available/online");?>'>Available</a><br>
<b><?= count($quests_completed);?></b> <a href='<?=base_url("/quests/completed");?>'>Completed</a><br>
<? endif;?>
</div>


</div>

<? endif;?>	
