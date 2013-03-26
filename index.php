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
		<div id="stylized" class="commitForm">
			<form action="requesthandler.php" method="post" id="form" name="form">
			
				<label>Request Type
				<span id="text_form">What type of request has been submitted?</span>
				</label>
				<select id="Requests">
					<?php
					$sql = "SELECT requesttemplate FROM incidents";
					$output = get_mysqliData($sql);
					
						while($row = $output->fetch_assoc()){
							echo "<option value='" . $row['requesttemplate'] . "'>".$row['requesttemplate'] . "</option>";
						}
					?>
				</select>
				
				<label>Technician Key
				<span class="text_form">Select the technician key.</span>
				</label>
				<select id="technician_key">
					<option value="3F394415-32F0-4FD9-F44D-977A-C56F44D5A6F1">Freddie</option>
					<option value="79C4E7D5-4BD9-427D-5050-BE56-4335050702AC">Erik</option>
				</select>
				
				<label>Requester
				<span class="text_form">Who submitted the request.</span>
				</label>
				
				<input type="text" name="Requester" />
				<label>Technician
				<span class="text_form">Who recievied the request.</span>
				</label>
				<input type="text" name="Technician" />
				
				<label>Close Request
				<span class="text_form">Should the request be closed aswell?</span>
				</label>
				
				<input type="checkbox" value="true" name="close_request" />
				<input type="submit" value="Add Request" name="add_request" />
			</form>
		</div>
		<?php

		?>
	</body>
</html>