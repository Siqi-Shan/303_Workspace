<?php
	$host = "303.itpwebdev.com";
	$username = "kshan_db_user";
	$password = "uscitp2021!";
	$db = "kshan_song_db";

	$mysqli = new mysqli($host, $username, $password, $db);

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Song Search Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<h1 class="col-12 mt-4">Song Search Results</h1>
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
	<div class="container-fluid">
		<div class="row mb-4 mt-4">
			<div class="col-12">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row">
			<div class="col-12">

				Showing 2 result(s).

			</div> <!-- .col -->
			<div class="col-12">
				<table class="table table-hover table-responsive mt-4">
					<thead>
						<tr>
							<th>Track</th>
							<th>Genre</th>
							<th>Media Type</th>
						</tr>
					</thead>
					<tbody>

						<tr>
							<td>For Those About To Rock (We Salute You)</td>
							<td>Rock</td>
							<td>MPEG audio file</td>
						</tr>

						<tr>
							<td>Put The Finger On You</td>
							<td>Rock</td>
							<td>MPEG audio file</td>
						</tr>

					</tbody>
				</table>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
</body>
</html>