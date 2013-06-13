<?php require path('views').'structure'.DS.'header.php'; ?>
<?php require path('views').'structure'.DS.'navigation.php'; ?>

<!--
Create a fluid container for the content to reside in. This container is fluid
so that it will fit to the size of the users screen, making mobile site development much easier.
-->
<div class="container-fluid">
	<div class="well">
		<p class="lead">
			Please Login Below
		</p>
		<hr />
		<div class="row">
			<div class="span12">
				<!--
				Creating the form for the user input and registration. The URL for the form action is generated using the
				php function I have created called URL to generate the correct url to the page even if the domain changes.
				-->
				<form class="form-horizontal" method="post" action="<?php URL::to('home@login'); ?>">
					<!--
					All input fields are displayed within a control-group. This helps organise input fields and assign labels
					as well as design styling.
					-->
					<div class="control-group">
						<label class="control-label" for="username">Username/Email:</label>
						<div class="controls">
							<input type="text" name="username" class="input-large" id="username" placeholder="example@test.com">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="password">Password:</label>
						<div class="controls">
							<input type="password" name="password" class="input-large" id="password" placeholder="password">
						</div>
					</div>
					<div class="form-actions">
						<!--
						Here we will be using buttons to submit and reset (clear) the form. Another option is to use
						the input type submit and reset, but we will use buttons.
						-->
						<button type="submit" class="btn btn-primary">Login</button>
						<button type="reset" class="btn">Reset</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<?php require path('views').'structure'.DS.'footer.php'; ?>