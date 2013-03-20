<!DOCTYPE HTML>

<html>
	<head>
		<title>Fastic - Add requesttype</title>
	</head>
	<?php
		include 'functions/variables.php';
		include 'functions/mysqli_conn.php';
		include 'functions/func.php';
	?>
	<head>
	<body>
	
	<form action="addrequesttype.php" method="POST">
		Subject: <input name="subject" type="text"/>
		Description: <input name="description" type="textarea" rows="5" />
		Request Template: <input name="requesttemplate" type="text" />
		Technician Group: <input name="group" type="text" />
		Level: <input name="level" type="text" />
		Mode: <input name="mode" type="text" />
		Request Type: <input name="requesttype" type="text" />
		Category: <input name="category" type="text" />
		Subcategory: <input name="subcategory" type="text" />
		Item: <input name="item" type="text" />
		Impact: <input name="impact" type="text" />
		Urgency: <input name="urgency" type="text" />
		Priority: <input name="priority" type="text" />
		<input type="submit" value="Add Requesttype" name="add_requesttype" />
	</form>
	
<?php
	if(isset($_POST['subject']) && isset($_POST['requesttemplate']) && isset($_POST['mode'])&& isset($_POST['level']) && isset($_POST['category'] && isset($_POST['priority'])) )
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
		foreach($content as $x=>$x_val){
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