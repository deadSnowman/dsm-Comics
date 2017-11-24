<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<head>
<meta charset="utf-8">
<title>404 Page Not Found</title>
<style type="text/css">
.vertical-center {
  min-height: 50%;
  min-height: 50vh;
  display: flex;
  align-items: center;
}
</style>
</head>
<body>
	<div class="vertical-center text-center">
		<div class="container" id="container">

			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<h1><?php echo $heading; ?></h1>
					<?php echo $message; ?>
				</div>
			</div>

		</div>
	</div>
</body>
</html>
