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

	$sql_genre = "SELECT * FROM genres";
	$sql_rating = "SELECT * FROM ratings";
	$sql_label = "SELECT * FROM labels";
	$sql_format = "SELECT * FROM formats";
	$sql_sound = "SELECT * FROM sounds";

	$result_genre = $mysqli->query($sql_genre);
	$result_rating = $mysqli->query($sql_rating);
	$result_label = $mysqli->query($sql_label);
	$result_format = $mysqli->query($sql_format);
	$result_sound = $mysqli->query($sql_sound);

	if (!$result_genre || !$result_rating || !$result_label || !$result_format || !$result_sound) {
		echo $mysqli->error;
		exit();
	}

	$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Form | DVD Database</title>
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
		<li class="breadcrumb-item active">Add</li>
	</ol>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Add a DVD</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

		<form action="add_confirmation.php" method="POST">

			<div class="form-group row">
				<label for="title-id" class="col-sm-3 col-form-label text-sm-right">Title: <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="title-id" name="title">
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="release-date-id" class="col-sm-3 col-form-label text-sm-right">Release Date:</label>
				<div class="col-sm-9">
					<input type="date" class="form-control" id="release-date-id" name="release_date">
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="label-id" class="col-sm-3 col-form-label text-sm-right">Label:</label>
				<div class="col-sm-9">
					<select name="label_id" id="label-id" class="form-control">
						<option value="" selected disabled>-- Select One --</option>

						<!-- PHP Output Here -->
						<?php while ($row = $result_label->fetch_assoc()): ?>
							<option value="<?php echo $row['label_id']; ?>">
								<?php echo $row["label"]; ?>
							</option>
						<?php endwhile; ?>

					</select>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="sound-id" class="col-sm-3 col-form-label text-sm-right">Sound:</label>
				<div class="col-sm-9">
					<select name="sound_id" id="sound-id" class="form-control">
						<option value="" selected disabled>-- Select One --</option>

						<!-- PHP Output Here -->
						<?php while ($row = $result_sound->fetch_assoc()): ?>
							<option value="<?php echo $row['sound_id']; ?>">
								<?php echo $row["sound"]; ?>
							</option>
						<?php endwhile; ?>

					</select>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="genre-id" class="col-sm-3 col-form-label text-sm-right">Genre:</label>
				<div class="col-sm-9">
					<select name="genre_id" id="genre-id" class="form-control">
						<option value="" selected disabled>-- Select One --</option>

						<!-- PHP Output Here -->
						<?php while ($row = $result_genre->fetch_assoc()): ?>
							<option value="<?php echo $row['genre_id']; ?>">
								<?php echo $row["genre"]; ?>
							</option>
						<?php endwhile; ?>

					</select>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="rating-id" class="col-sm-3 col-form-label text-sm-right">Rating:</label>
				<div class="col-sm-9">
					<select name="rating_id" id="rating-id" class="form-control">
						<option value="" selected disabled>-- Select One --</option>

						<!-- PHP Output Here -->
						<?php while ($row = $result_rating->fetch_assoc()): ?>
							<option value="<?php echo $row['rating_id']; ?>">
								<?php echo $row["rating"]; ?>
							</option>
						<?php endwhile; ?>

					</select>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="format-id" class="col-sm-3 col-form-label text-sm-right">Format:</label>
				<div class="col-sm-9">
					<select name="format_id" id="format-id" class="form-control">
						<option value="" selected disabled>-- Select One --</option>

						<!-- PHP Output Here -->
						<?php while ($row = $result_format->fetch_assoc()): ?>
							<option value="<?php echo $row['format_id']; ?>">
								<?php echo $row["format"]; ?>
							</option>
						<?php endwhile; ?>

					</select>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="award-id" class="col-sm-3 col-form-label text-sm-right">Award:</label>
				<div class="col-sm-9">
					<textarea name="award" id="award-id" class="form-control"></textarea>
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

	</div> <!-- .container -->
</body>
</html>