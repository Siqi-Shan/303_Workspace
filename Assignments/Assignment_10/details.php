<?php
	if(!isset($_GET["dvd_id"]) || empty($_GET["dvd_id"])) {
		$error = "Invalid DVD";
	}
	else {
		$host = "303.itpwebdev.com";
		$username = "kshan_db_user";
		$password = "uscitp2021!";
		$db = "kshan_dvd_db";

		$mysqli = new mysqli($host, $username, $password, $db);

		if ($mysqli->connect_errno) {
			echo $mysqli->connect_error;
			exit();
		}

		$mysqli->set_charset('utf8');

		$sql = "SELECT dvd_titles.title title, dvd_titles.release_date date, dvd_titles.award,
					g.genre genre, f.format format, l.label label, r.rating rating, s.sound sound
				FROM dvd_titles
				JOIN genres g
					ON g.genre_id = dvd_titles.genre_id
				JOIN formats f
					ON f.format_id = dvd_titles.format_id
				JOIN labels l
					ON l.label_id = dvd_titles.label_id
				JOIN ratings r
					ON r.rating_id = dvd_titles.rating_id
				JOIN sounds s
					ON s.sound_id = dvd_titles.sound_id
				WHERE dvd_titles.dvd_title_id = " . $_GET["dvd_id"] . ";";

		$results = $mysqli->query($sql);

		if(!$results) {
			echo $mysqli->error;
			exit();
		}

		$row = $results->fetch_assoc();

		$mysqli->close();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Details | DVD Database</title>
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
			<h1 class="col-12 mt-4">DVD Details</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

		<div class="row mt-4">
			<div class="col-12">

				<?php if(isset($error) && !empty($error)): ?>

					<div class="text-danger font-italic">
						<?php echo $error; ?>
					</div>

				<?php else: ?>

					<table class="table table-responsive">

						<tr>
							<th class="text-right">Title:</th>
							<td>
								<?php echo $row["title"]; ?>
							</td>
						</tr>

						<tr>
							<th class="text-right">Release Date:</th>
							<td>
								<?php
									if (isset($row["date"])) {
										echo $row["date"];
									}
									else {
										echo "<div class='text-warning font-italic'>"
											 . "Not Available" . "</div>";
									}
								?>
							</td>
						</tr>

						<tr>
							<th class="text-right">Genre:</th>
							<td>
								<?php echo $row["genre"]; ?>
							</td>
						</tr>

						<tr>
							<th class="text-right">Label:</th>
							<td>
								<?php echo $row["label"]; ?>
							</td>
						</tr>

						<tr>
							<th class="text-right">Rating:</th>
							<td>
								<?php echo $row["rating"]; ?>
							</td>
						</tr>

						<tr>
							<th class="text-right">Sound:</th>
							<td>
								<?php echo $row["sound"]; ?>
							</td>
						</tr>

						<tr>
							<th class="text-right">Format:</th>
							<td>
								<?php echo $row["format"]; ?>
							</td>
						</tr>

						<tr>
							<th class="text-right">Award:</th>
							<td>
								<?php
									if (isset($row["award"])) {
										echo $row["award"];
									}
									else {
										echo "<div class='font-italic'>" . "No Award" . "</div>";
									}
								?>
							</td>
						</tr>

					</table>
				<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_results.php" role="button" class="btn btn-primary">Back to Search Results</a>
				<?php if(!isset($error)): ?>
					<a href="edit_form.php?track_id=<?php echo $_GET["dvd_id"]; ?>" class="btn btn-warning">Edit This Track</a>
				<?php endif; ?>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>