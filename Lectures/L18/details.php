<?php
	if(!isset($_GET["track_id"]) || empty($_GET["track_id"])) {
		// A track id is not given, show error message. Don't do anything else.
		$error = "Invalid ID";
	}
	else {
		// A track id is given so continue to connect to the DB.
		$host = "303.itpwebdev.com";
		$user = "kshan_db_user";
		$password = "uscitp2021!";
		$db = "kshan_song_db";
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Song Details | Song Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item"><a href="search_results.php">Results</a></li>
		<li class="breadcrumb-item active">Details</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Song Details</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

				<?php
					if(isset($error) || !empty($error)) :
				?>
					<div class="text-danger">
						<?php echo $error; ?>
					</div>
				<?php else : ?>
					<table class="table table-responsive">
						<tr>
							<th class="text-right">Track Name:</th>
							<td>Track Name</td>
						</tr>
						<tr>
							<th class="text-right">Artist Name:</th>
							<td>Artist Name</td>
						</tr>
						<tr>
							<th class="text-right">Composer:</th>
							<td>Composer</td>
						</tr>
						<tr>
							<th class="text-right">Album:</th>
							<td>Album</td>
						</tr>
						<tr>
							<th class="text-right">Genre:</th>
							<td>Genre</td>
						</tr>
						<tr>
							<th class="text-right">Milliseconds:</th>
							<td>Milliseconds</td>
						</tr>
						<tr>
							<th class="text-right">Bytes:</th>
							<td>Bytes</td>
						</tr>
						<tr>
							<th class="text-right">Price:</th>
							<td>Price</td>
						</tr>
					</table>
				<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_results.php" role="button" class="btn btn-primary">Back to Search Results</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>