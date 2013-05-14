<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="brand" href="">
					Web Files Store
				</a>
				<ul class="nav">
					<li><a href="<?php echo URL::to('home'); ?>">Home</a></li>
				</ul>
				<?php
				// If user is logged in, display users navigation bar.
				if(Authenticate::check()){
				?>
					<ul class="nav">
						<li class="pull-right"><a href="<?php echo URL::to('profile'); ?>">Profile</a></li>
						<li class="pull-right"><a href="<?php echo URL::to('files'); ?>">Files</a></li>
					</ul>
					<ul class="nav pull-right">
						<li class="pull-right"><a href="<?php echo URL::to('home@login'); ?>">Logout</a></li>
					</ul>
				<?php
				// else display normal non-logged in users.
				} else {
				?>
					<ul class="nav pull-right">
						<li class="pull-right"><a href="<?php echo URL::to('home@login'); ?>">Login</a></li>
						<li class="pull-right"><a href="<?php echo URL::to('home@register'); ?>">Register</a></li>
					</ul>
				<?php
				// end if statement.
				}
				?>
			</div>
		</div>
</div>