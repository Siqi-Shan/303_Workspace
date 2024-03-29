<?php
	$deleted = false;

	if (!isset($_GET["dvd_id"]) || empty($_GET["dvd_id"]) ||
		!isset($_GET["dvd_title"]) || empty($_GET["dvd_title"])) {
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

		$statement = $mysqli->prepare("DELETE FROM dvd_titles WHERE dvd_title_id = ?");

		$statement->bind_param("i", $_GET["dvd_id"]);

		$executed = $statement->execute();

		if (!$executed) {
			echo $mysqli->error;
			exit();
		}

		if ($statement->affected_rows == 1) {
			$deleted = true;
		}

		$statement->close();

		$mysqli->close();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Delete a DVD | DVD Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item"><a href="search_results.php">Results</a></li>
		<li class="breadcrumb-item active">Delete</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Delete a DVD</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

				<?php if (isset($error) && !empty($error)): ?>
					<div class="text-danger">
						<?php echo $error; ?>
					</div>
				<?php endif; ?>

				<?php if ($deleted): ?>
					<div class="text-success"><span class="font-italic"><?php echo $_GET["dvd_title"]; ?></span> was successfully deleted.</div>
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