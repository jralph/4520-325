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
<div class="container-fluid">
	<div class="container-fluid well">
			<ul class="files">
				<?php
				foreach(Files::get_user_files(Authenticate::user('user_id')) as $file){
					$file_type = Files::get_file_type($file->file_type);
					echo '<li class="span2">';
					echo '<a href="'.$file->file_location.'">';
					echo '<img width="124" src="/img/type_icons/'.$file_type.'.png">';
					echo '<br />';
					echo $file->file_name;
					echo '</a>';
					echo '<br />';
					echo '<a href="'.URL::to('files@delete').'/'.$file->id.'" class="btn btn-warning">Delete</a>';
					echo '</li>';
				}
				?>
			</ul>
	</div>
</div>



<?php require path('views').'structure'.DS.'footer.php'; ?>