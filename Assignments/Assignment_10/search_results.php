<?php
	$host = "303.itpwebdev.com";
	$username = "kshan_db_user";
	$password = "uscitp2021!";
	$db = "kshan_dvd_db";

	$mysqli = new mysqli($host, $username, $password, $db);

	if ($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit();
	}

	$mysqli->set_charset("utf8");

	$sql = "SELECT dvd_titles.title title, dvd_titles.release_date release_date, g.genre genre, 
			r.rating rating, dvd_titles.dvd_title_id id
			FROM dvd_titles
			JOIN genres g
    			ON g.genre_id = dvd_titles.genre_id
			JOIN ratings r
    			ON r.rating_id = dvd_titles.rating_id
			WHERE 1=1";

	if (isset($_GET["title"]) && !empty($_GET["title"])) {
		$sql = $sql . " AND dvd_titles.title LIKE '%" . $title . "%'";
	}

	if (isset($_GET["genre"]) && !empty($_GET["genre"])) {
		$sql = $sql . " AND dvd_titles.genre_id = " . $genre;
	}

	if (isset($_GET["rating"]) && !empty($_GET["rating"])) {
		$sql = $sql . " AND dvd_titles.rating_id = " . $rating;
	}

	if (isset($_GET["label"]) && !empty($_GET["label"])) {
		$sql = $sql . " AND dvd_titles.label_id = " . $label;
	}

	if (isset($_GET["format"]) && !empty($_GET["format"])) {
		$sql = $sql . " AND dvd_titles.format_id = " . $format;
	}

	if (isset($_GET["sound"]) && !empty($_GET["sound"])) {
		$sql = $sql . " AND dvd_titles.sound_id = " . $sound;
	}

	if (isset($_GET["award"]) && !empty($_GET["award"])) {
		if ($_GET["award"] == "yes") {
			$sql = $sql . " AND dvd_titles.award IS NOT NULL";
		}
		else if ($_GET["award"] == "no") {
			$sql = $sql . " AND dvd_titles.award IS NULL";
		}
	}

	if (!empty($_GET["release_date_from"]) || !empty($_GET["release_date_to"])) {
		if (!empty($_GET["release_date_from"]) && !empty($_GET["release_date_to"])) {
			$sql = $sql . " AND '" . $_GET["release_date_from"] . "' <= dvd_titles.release_date";
			$sql = $sql . " AND dvd_titles.release_date " . " <= '" . $_GET["release_date_to"] . "'";
		}
		else if (!empty($_GET["release_date_from"])) {
			$sql = $sql . " AND dvd_titles.release_date >= '" . $_GET["release_date_from"] . "'";
		}
		else if (!empty($_GET["release_date_to"])) {
			$sql = $sql . " AND dvd_titles.release_date <= '" . $_GET["release_date_to"] . "'";
		}
	}

	$sql = $sql . ";";

	$results = $mysqli->query($sql);

	if (!$results) {
		echo $mysqli->error;
		exit();
	}

	$mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DVD Search Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item active">Results</li>
	</ol>
	<div class="container-fluid">
		<div class="row">
			<h1 class="col-12 mt-4">DVD Search Results</h1>
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
	<div class="container-fluid">
		<div class="row mb-4">
			<div class="col-12 mt-4">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row">
			<div class="col-12">

				Showing <span><?php echo $results->num_rows; ?></span> result(s).

			</div> <!-- .col -->
			<div class="col-12">
				<table class="table table-hover table-responsive mt-4">
					<thead>
						<tr>
							<th></th>
							<th>DVD Title</th>
							<th>Release Date</th>
							<th>Genre</th>
							<th>Rating</th>
						</tr>
					</thead>
					<tbody>

						<?php while ($row = $results->fetch_assoc()): ?>
							<tr>
								<td>
									<a href="delete.php" class="btn btn-outline-danger delete-btn">
										Delete
									</a>
								</td>
								<td>
									<a href="details.php?dvd_id=<?php echo $row['id']; ?>">
										<?php echo $row["title"]; ?>
									</a>
								</td>
								<td>
									<?php echo $row["release_date"]; ?>
								</td>
								<td>
									<?php echo $row["genre"]; ?>
								</td>
								<td>
									<?php echo $row["rating"]; ?>
								</td>
							</tr>
						<?php endwhile; ?>

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