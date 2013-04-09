<?php
//Set to true to get debug output. This is for development at the moment. But it might be useful when setting it up in new environments too.
$DEBUG = "true";
include_once('functions/mysqli_conn.php');
include_once('functions/func.php');
include('functions/variables.php');
if($DEBUG == "true"){
	echo "<span>IN DEBUGMODE</span><br />";
}

if(isset($_POST['request']) && isset($_POST['requester']) && isset($_POST['technician']) && isset($_POST['technician_key']) ){

	if($DEBUG == "true"){
		echo "<br /> Check post-attributes: Ok <br />";
	}

	$requests = $_POST['request'];
	$requester = $_POST['requester'];
	$technician = $_POST['technician'];
	$techniciankey = $_POST['technician_key'];
	if(isset($_POST['close_request'])){
		$close_request = $_POST['close_request'];
	} else {
		$close_request  = "No";
	}
	if($DEBUG == "true"){
		echo "Input from form.";
		echo "Requests: " . $requests . "<br />";
		echo "Requester: " . $requester . "<br />";
		echo "Technician: " . $technician . "<br />";
		echo "Technician Key: " . $techniciankey . "<br />";
		echo "Close Request? " . $close_request . "<br />";
		echo "End of output. <br /><br/>";
	}
	$SQLquery = "SELECT * FROM incidents WHERE id = " . $requests;
	if($DEBUG == "true"){
		echo "SQL query: " . $SQLquery;
	}
		$data = get_mysqliData($SQLquery);
		while($r = $data->fetch_assoc()){
			if($DEBUG == "true"){
				echo "<br>ID: ". $r['id'] . "<br>";
				echo "Subject: " . $r['subject'] . "<br>";
				echo "Dscription: " . $r['description'] . "<br>";
				echo "Request Type: " . $r['requesttemplate'] . "<br>";
				echo "Group: " . $r['group'] . "<br>";
				echo "Level: " . $r['level'] . "<br>";
				echo "Status: " . $r['status'] . "<br>";
				echo "Mode: " . $r['mode'] . "<br>";
				echo "Request type: " . $r['requesttype'] . "<br>";
				echo "Category: " . $r['category'] . "<br>";
				echo "Subcategory: " . $r['subcategory'] . "<br>";
				echo "Item: " . $r['item'] . "<br>";
				echo "Urgency: " . $r['urgency'] . "<br>";
				echo "Impact: " . $r['impact'] . "<br>";
				echo "Priority: " . $r['priority'] . "<br>";
			}
			foreach($r as $x=>$x_val){
				$arrXMLContent = array($x=>$x_val);
			}
			$XMLString = create_xmlstring($arrXMLContent, $requester, $technician);
			
			if($DEBUG == "true") {
				echo "<br/>XMLString: " . $XMLString . "<br/>";
			}
			
			$post_input = array(
				"OPERATION_NAME" => "ADD_REQUEST",
				"TECHNICIAN_KEY" => $techniciankey,
				"INPUT_DATA" => $XMLString
			);
			
			if($DEBUG == "true"){
				echo "<br>post_input string.<br>";
				foreach($test as $x=>$x_val){
					echo $x . ": " . $x_val . "<br>";
				}
			}
			
			$returnAddRequest = add_request($url, $post_input);
			$output = get_sdpoutput($returnAddRequest);
			
			if($DEBUG == "true"){
				echo "<br> output from ServiceDesk Plus: <br>";
				foreach($output as $x=>$x_val){
					echo $x . ": " . $x_val . "<br>";
				}
			}
		}
	if( $close_request == 'true' && isset($workorderID) ){
		$reqCloseConfirm = close_request($url, $workorderID, $techniciankey);
		$output = get_sdpoutput($reqCloseConfirm);
		
		if($DEBUG == "true"){
			echo "<br> output from ServiceDesk Plus: <br>";
			foreach($output as $x=>$x_val){
				echo $x . ": " . $x_val . "<br>";
			}
		}
	}
}

?>