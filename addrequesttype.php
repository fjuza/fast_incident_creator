<!DOCTYPE HTML>

<html>
	<head>
		<title>Fastic - Add requesttype</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<?php
	
		include 'functions/variables.php';
		include 'functions/mysqli_conn.php';
		include 'functions/func.php';
		
	?>
	<head>
	<body>
	<div id="stylized" class="commitForm">
	<form action="addrequesttype.php" method="POST" id="form" name="form">
		<label>Subject: </label><input name="subject" type="text"/>
		<label>Description: </label><input name="description" type="textarea" rows="5" />
		<label>Request Template: </label><input name="requesttemplate" type="text" />
		<label>Technician Group: </label><input name="group" type="text" />
		<label>Level: </label><input name="level" type="text" />
		<label>Mode: </label><input name="mode" type="text" />
		<label>Request Type: </label><input name="requesttype" type="text" />
		<label>Category: </label><input name="category" type="text" />
		<label>Subcategory: </label><input name="subcategory" type="text" />
		<label>Item: </label><input name="item" type="text" />
		<label>Impact: </label><input name="impact" type="text" />
		<label>Urgency: </label><input name="urgency" type="text" />
		<label>Priority: </label><input name="priority" type="text" />
		<input type="submit" value="Add Requesttype" name="add_requesttype" />
	</form>
	</div>
<?php
	if( isset($_POST['subject']) && isset($_POST['requesttemplate']) && isset($_POST['mode']) && isset($_POST['level']) && isset($_POST['category']) && isset($_POST['priority']) )
	{
		$content = array(
			"subject"=>$_POST['subject'],
			"description"=>$_POST['description'],
			"requesttemplate"=>$_POST['requesttemplate'],
			"group"=>$_POST['group'],
			"level"=>$_POST['level'],
			"mode"=>$_POST['mode'],
			"requesttype"=>$_POST['requesttype'],
			"category"=>$_POST['category'],
			"subcategory"=>$_POST['subcategory'],
			"item"=>$_POST['item'],
			"impact"=>$_POST['impact'],
			"urgency"=>$_POST['urgency'],
			"impact"=>$_POST['priority']
		);
		$SQL = "INSERT INTO incidents ('subjects', 'description', 'requesttemplate', 'group', 'level', 'mode', 'requesttype', 'category', 'subcategory', 'item', 'impact', 'urgency', 'priority') VALUES (";
		foreach($content as $x => $x_val){
			if(isset($x_val)){
				$SQL .= $x_val . ","; 
			} else {
				$SQL .= " " . ",";
			}
		}
		$SQL .= ")";
		
		get_mysqliData($SQL);
	}
?>
	</body>
</html>