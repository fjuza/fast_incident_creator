<!DOCTYPE HTML>
<?php
	$title = "FastiC - Submit form";
	include_once('functions/mysqli_conn.php');
	include('functions/variables.php');
?>
<html>
	<head>
		<title><?php $title ?></title>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="stylesheet" href="jquery/css/smoothness/jquery-ui-1.8.2.custom.css" /> 
		<script type="text/javascript" src="jquery/js/jquery-1.4.2.min.js"></script> 
		<script type="text/javascript" src="jquery/js/jquery-ui-1.8.2.custom.min.js"></script> 
		<script type="text/javascript"> 
			jQuery(document).ready(function(){
				$('#requester').autocomplete({source:'search_ldap.php', minLength:3});
				$('#technician').autocomplete({source:'search_ldap.php', minLength:3});
			});
	</script> 
		
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
				<!--
				<label>Technician Key
				<span class="small">Select the technician key.</span>
				</label>
				<select name="technician_key" id="technician_key">
					<option value="3F394415-32F0-4FD9-977A-C56F44D5A6F1">Freddie</option>
					<option value="79C4E7D5-4BD9-427D-BE56-4335050702AC">Erik</option>
				</select>-->
				
				<label>Requester
				<span class="small">Who submitted the request.</span>
				</label>
				
				<input type="text" name="requester" id="requester" />
				<label>Technician
				<span class="small">Who recievied the request.</span>
				</label>
				<input type="text" name="technician" id="technician" />
				
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