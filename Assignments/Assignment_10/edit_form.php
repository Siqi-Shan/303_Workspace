<?php
	if (!isset($_GET["dvd_id"]) || empty($_GET["dvd_id"])) {
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

		$sql = "SELECT *
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
		$sql_genre = "SELECT * FROM genres";
		$sql_rating = "SELECT * FROM ratings";
		$sql_label = "SELECT * FROM labels";
		$sql_format = "SELECT * FROM formats";
		$sql_sound = "SELECT * FROM sounds";

		$results = $mysqli->query($sql);
		$result_genre = $mysqli->query($sql_genre);
		$result_rating = $mysqli->query($sql_rating);
		$result_label = $mysqli->query($sql_label);
		$result_format = $mysqli->query($sql_format);
		$result_sound = $mysqli->query($sql_sound);

		if (!$results) {
			echo $mysqli->error;
			exit();
		}

		if (!$result_genre || !$result_rating || !$result_label || !$result_format || !$result_sound) {
			echo $mysqli->error;
			exit();
		}

		$row = $results->fetch_assoc();

		$mysqli->close();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Form | DVD Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		.form-check-label {
			padding-top: calc(.5rem - 1px * 2);
			padding-bottom: calc(.5rem - 1px * 2);
			margin-bottom: 0;
		}
	</style>
</head>
<body>

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item"><a href="search_results.php">Results</a></li>
		<li class="breadcrumb-item"><a href="details.php?dvd_id=<?php echo $_GET['dvd_id']; ?>">Details</a></li>
		<li class="breadcrumb-item active">Edit</li>
	</ol>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Edit a DVD</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

			<?php if(isset($error) && !empty($error)): ?>

					<div class="col-12 text-danger">
						<?php echo $error; ?>
					</div>

			<?php else: ?>

				<form action="edit_confirmation.php" method="POST">

					<input type="hidden" name="dvd_id" value="<?php echo $_GET['dvd_id']; ?>">

					<div class="form-group row">
						<label for="title-id" class="col-sm-3 col-form-label text-sm-right">Title: <span class="text-danger">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="title-id" name="title" value="<?php echo $row['title']; ?>">
						</div>
					</div> <!-- .form-group -->

					<div class="form-group row">
						<label for="release-date-id" class="col-sm-3 col-form-label text-sm-right">Release Date:</label>
						<div class="col-sm-9">
							<input type="date" class="form-control" id="release-date-id" name="release_date"  value="<?php echo $row['release_date']; ?>">
						</div>
					</div> <!-- .form-group -->

					<div class="form-group row">
						<label for="label-id" class="col-sm-3 col-form-label text-sm-right">Label:</label>
						<div class="col-sm-9">
							<select name="label" id="label-id" class="form-control">
								<option value="<?php echo $row['label_id']; ?>" selected>-- Select One --</option>

								<?php while($row_label = $result_label->fetch_assoc()): ?>

									<?php if($row["label_id"] == $row_label["label_id"]): ?>

										<option selected value="<?php echo $row_label['label_id']; ?>">
											<?php echo $row_label['label']; ?>
										</option>

									<?php else: ?>

										<option value="<?php echo $row_label['label_id']; ?>">
											<?php echo $row_label['label']; ?>
										</option>

									<?php endif; ?>

								<?php endwhile; ?>

							</select>
						</div>
					</div> <!-- .form-group -->

					<div class="form-group row">
						<label for="sound-id" class="col-sm-3 col-form-label text-sm-right">Sound:</label>
						<div class="col-sm-9">
							<select name="sound" id="sound-id" class="form-control">
								<option value="<?php echo $row['sound_id']; ?>" selected>-- Select One --</option>

								<?php while($row_sound = $result_sound->fetch_assoc()): ?>

									<?php if($row["sound_id"] == $row_sound["sound_id"]): ?>

										<option selected value="<?php echo $row_sound['sound_id']; ?>">
											<?php echo $row_sound['sound']; ?>
										</option>

									<?php else: ?>

										<option value="<?php echo $row_sound['sound_id']; ?>">
											<?php echo $row_sound['sound']; ?>
										</option>

									<?php endif; ?>

								<?php endwhile; ?>

							</select>
						</div>
					</div> <!-- .form-group -->

					<div class="form-group row">
						<label for="genre-id" class="col-sm-3 col-form-label text-sm-right">Genre:</label>
						<div class="col-sm-9">
							<select name="genre" id="genre-id" class="form-control">
								<option value="<?php echo $row['genre_id']; ?>" selected>-- Select One --</option>

								<?php while($row_genre = $result_genre->fetch_assoc()): ?>

									<?php if($row["genre_id"] == $row_genre["genre_id"]): ?>

										<option selected value="<?php echo $row_genre['genre_id']; ?>">
											<?php echo $row_genre['genre']; ?>
										</option>

									<?php else: ?>

										<option value="<?php echo $row_genre['genre_id']; ?>">
											<?php echo $row_genre['genre']; ?>
										</option>

									<?php endif; ?>

								<?php endwhile; ?>

							</select>
						</div>
					</div> <!-- .form-group -->

					<div class="form-group row">
						<label for="rating-id" class="col-sm-3 col-form-label text-sm-right">Rating:</label>
						<div class="col-sm-9">
							<select name="rating" id="rating-id" class="form-control">
								<option value="<?php echo $row['rating_id']; ?>" selected>-- Select One --</option>

								<?php while($row_rating = $result_rating->fetch_assoc()): ?>

									<?php if($row["rating_id"] == $row_rating["rating_id"]): ?>

										<option selected value="<?php echo $row_rating['rating_id']; ?>">
											<?php echo $row_rating['rating']; ?>
										</option>

									<?php else: ?>

										<option value="<?php echo $row_rating['rating_id']; ?>">
											<?php echo $row_rating['rating']; ?>
										</option>

									<?php endif; ?>

								<?php endwhile; ?>

							</select>
						</div>
					</div> <!-- .form-group -->

					<div class="form-group row">
						<label for="format-id" class="col-sm-3 col-form-label text-sm-right">Format:</label>
						<div class="col-sm-9">
							<select name="format" id="format-id" class="form-control">
								<option value="<?php echo $row['format_id']; ?>" selected>-- Select One --</option>

								<?php while($row_format = $result_format->fetch_assoc()): ?>

									<?php if($row["format_id"] == $row_format["format_id"]): ?>

										<option selected value="<?php echo $row_format['format_id']; ?>">
											<?php echo $row_format['format']; ?>
										</option>

									<?php else: ?>

										<option value="<?php echo $row_format['format_id']; ?>">
											<?php echo $row_format['format']; ?>
										</option>

									<?php endif; ?>

								<?php endwhile; ?>

							</select>
						</div>
					</div> <!-- .form-group -->

					<div class="form-group row">
						<label for="award-id" class="col-sm-3 col-form-label text-sm-right">Award:</label>
						<div class="col-sm-9">
							<textarea name="award" id="award-id" class="form-control">
								<?php
									if (isset($row['award'])) {
										echo $row['award'];
									}
								?>
							</textarea>
						</div>
					</div> <!-- .form-group -->

					<div class="form-group row">
						<div class="ml-auto col-sm-9">
							<span class="text-danger font-italic">* Required</span>
						</div>
					</div> <!-- .form-group -->

					<div class="form-group row">
						<div class="col-sm-3"></div>
						<div class="col-sm-9 mt-2">
							<button type="submit" class="btn btn-primary">Submit</button>
							<button type="reset" class="btn btn-light">Reset</button>
						</div>
					</div> <!-- .form-group -->

				</form>
			<?php endif; ?>

	</div> <!-- .container -->
</body>
</html>