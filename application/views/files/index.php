<?php require path('views').'structure'.DS.'header.php'; ?>

<?php require path('views').'structure'.DS.'navigation.php'; ?>



<div class="container-fluid">
	<div class="well">
		<p class="lead">
			File Storage
		</p>
		<hr />
		<a href="<?php echo URL::to('files@view'); ?>" class="btn btn-primary">View Files</a>
		<a href="<?php echo URL::to('files@wipe'); ?>" class="btn btn-warning">Clear Storage</a>
	</div>
	<div class="well">
		<p class="lead">
			Storage Statistics
		</p>
		<hr />
		<div class="row">
			<div class="span4">
				<div class="well" style="text-align: center">
					<h1><?php echo count(Files::get_user_files(Authenticate::user('user_id'))); ?></h1>
					<p><b>File(s) In Storage</b></p>
				</div>
			</div>
			<div class="span4">
				<div class="well" style="text-align: center">
					<h1><?php echo User::space_used(); ?></h1>
					<p><b>Total Size Used</b></p>
				</div>
			</div>
			<div class="span4">
				<div class="well" style="text-align: center">
					<h1><?php echo User::formatBytes(disk_free_space('C:')); ?></h1>
					<p><b>Space Available</b></p>
				</div>
			</div>
		</div>
	</div>
</div>



<?php require path('views').'structure'.DS.'footer.php'; ?>