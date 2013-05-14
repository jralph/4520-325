<?php require path('views').'structure'.DS.'header.php'; ?>

<?php require path('views').'structure'.DS.'navigation.php'; ?>



<div class="container-fluid">
	<div class="well">
		<p class="lead">
			File Storage
		</p>
		<hr />
		<a href="<?php echo URL::to('files@view'); ?>" class="btn btn-primary">View Files</a>
		<a href="<?php echo URL::to('files@delete'); ?>" class="btn btn-warning">Clear Storage</a>
	</div>
	<div class="well">
		<p class="lead">
			Storage Statistics
		</p>
		<hr />
		<div class="row">
			<div class="span4">
				<div class="well">

				</div>
			</div>
			<div class="span4">
				<div class="well">

				</div>
			</div>
			<div class="span4">
				<div class="well">

				</div>
			</div>
		</div>
	</div>
</div>



<?php require path('views').'structure'.DS.'footer.php'; ?>