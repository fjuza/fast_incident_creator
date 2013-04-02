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
			<form action="requesthandler.php" method="POST" id="form" name="form">
			
				<label>Request Type
				<span class="small">What type of request has been submitted?</span>
				</label>
				<select name="request" id="request">
					<?php
					$sql = "SELECT id, requesttemplate FROM incidents";
					$output = get_mysqliData($sql);
					
						while($row = $output->fetch_assoc()){
							echo "<option value='" . $row['id'] . "'>".$row['requesttemplate'] . "</option>";
						}
					?>
				</select>
				
				<label>Technician Key
				<span class="small">Select the technician key.</span>
				</label>
				<select name="technician_key" id="technician_key">
					<option value="3F394415-32F0-4FD9-F44D-977A-C56F44D5A6F1">Freddie</option>
					<option value="79C4E7D5-4BD9-427D-5050-BE56-4335050702AC">Erik</option>
				</select>
				
				<label>Requester
				<span class="small">Who submitted the request.</span>
				</label>
				
				<input type="text" name="requester" />
				<label>Technician
				<span class="small">Who recievied the request.</span>
				</label>
				<input type="text" name="technician" />
				
				<label>Close Request
				<span class="small">Should the request be closed?</span>
				</label>
				
				<input type="checkbox" value="true" name="close_request" />
				<input type="submit" value="Add Request" name="add_request" />
			</form>
		</div>
		<?php

		?>
	</body>
</html>