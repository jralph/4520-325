<?php require path('views').'structure'.DS.'header.php'; ?>

<?php require path('views').'structure'.DS.'navigation.php'; ?>



<div class="container-fluid">
	<div class="well">
		<form class="form-inline" method="post" action="<?php echo URL::to('files@upload'); ?>" enctype="multipart/form-data">
			<input type="file" class="input-file" name="file" id="file">
			<input type="submit" class="btn btn-primary" value="Upload">
		</div>
	</div>
</div>



<?php require path('views').'structure'.DS.'footer.php'; ?>