<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Confirmation</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-5 mb-3">Order Confirmation</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	
	<div class="container">

		<div class="row mt-3">
			<div>
				<!-- Change this to date/time that this was submitted. -->
				<!-- This form was submitted on [weekday], [month] [day], [year] at [time]. -->
				<?php
					date_default_timezone_set('America/Los_Angeles');
					echo 'This form was submitted on ' . date('l, F d, Y \a\t h:i:s A');
				?>
			</div>
		</div>

		<div class="row mt-4">
			<div class="col-4 text-right">Full Name:</div>
			<div class="col-8">
				<!-- PHP Output Here -->
				<?php
					if (isset($_POST['fname']) && !empty($_POST['fname']) &&
						isset($_POST['lname']) && !empty($_POST['lname'])) {
						echo $_POST['fname'] . " " . $_POST['lname'];
					}
					else {
						echo "<span class='text-danger'>Not provided</span>";
					}
				?>
			</div>
		</div> <!-- .row -->

		<div class="row mt-3">
			<div class="col-4 text-right">Phone Number Match:</div>
			<div class="col-8">
				<!-- PHP Output Here -->
				<?php
					if (isset($_POST['phone']) && !empty($_POST['phone']) &&
						isset($_POST['phone-confirm']) && !empty($_POST['phone-confirm'])) {
						if ($_POST['phone'] == $_POST['phone-confirm']) {
							echo "<span class='text-success'>Phone Numbers match</span>";
							echo "<br/>" . $_POST['phone'];
						}
						else {
							echo "<span class='text-danger'>Phone Numbers do not match</span>";
						}
					}
					else {
						echo "<span class='text-danger'>Not provided</span>";
					}
				?>
			</div>
		</div> <!-- .row -->

		<div class="row mt-3">
			<div class="col-4 text-right">Order:</div>
			<div class="col-8">
				<!-- PHP Output Here -->
				<?php
					if (isset($_POST['order'])) {
						echo $_POST['order'];
					}
					else {
						echo "<span class='text-danger'>Not provided</span>";
					}
				?>
			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-4 text-right">Size:</div>
			<div class="col-8">
				<!-- PHP Output Here -->
				<?php
					if (isset($_POST['size'])) {
						echo $_POST['size'];
					}
					else {
						echo "<span class='text-danger'>Not provided</span>";
					}
				?>
			</div>
		</div> <!-- .row -->

		<div class="row mt-3">
			<div class="col-4 text-right">Flavor shot(s): </div>
			<div class="col-8">
				<!-- PHP Output Here -->
				<?php
					if (isset($_POST['flavor'])) {
						foreach ($_POST['flavor'] as $val) {
							echo $val . " ";
						}
					}
					else {
						echo "None.";
					}
				?>
			</div>
		</div> <!-- .row -->

		<div class="row mt-4 mb-4">
			<a href="form.php" role="button" class="btn btn-primary">Back to Form</a>
		</div> <!-- .row -->

	</div> <!-- .container -->

</body>
</html>