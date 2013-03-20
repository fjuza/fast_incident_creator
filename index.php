<!DOCTYPE HTML>
<?php
	$title = "Bloody Fast Incident Creator";
	include_once('functions/mysqli_conn.php');
	include('functions/variables.php');
?>
<html>
	<head>
		<title><?php $title ?></title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<form action="requesthandler.php" method="post">
			<span id="text_form">Request Type:</span>
			<input list="Requests" />
			<datalist id="Requests">
				<?php
				$sql = "SELECT requesttemplate FROM incidents";
				$output = get_mysqliData($sql);
				
					while($row = $output->fetch_assoc()){
						echo "<option value='" . $row['requesttemplate'] . "' />";
					}

				?>
			</datalist>
			<span id="text_form">Technician Key:</span>
			<input id="technician_key">
			<datalist id="technician_key">
				<option value="3F394415-32F0-4FD9-977A-C56F44D5A6F1" />
				<option value="79C4E7D5-4BD9-427D-BE56-4335050702AC" />
			<span id="text_form">Requester: </span>
			<input type="text" name="Requester" />
			<span id="text_form">Technician: </span>
			<input type="text" name="Technician" />
			<span id="text_form">Close Request: </span>
			<input type="checkbox" value="true" name="close_request" />
			<input type="submit" value="Add Request" name="add_request" />
		</form>
		<?php

		?>
	</body>
</html>