<?php
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
		echo "Technician Key" . $techniciankey . "<br />";
		echo "Close Request?" . $close_request . "<br />";
		echo "End of output. <br />";
	}
	$SQLquery = "SELECT * FROM incidents WHERE id = " . $requests;
	if($DEBUG == "true"){
		echo "SQL query: " . $SQLquery;
	}
		$data = get_mysqliData($SQLquery);
		while($r = $data->fetch_assoc()){
			if($DEBUG == "true"){
				//echo $r;
				
				echo "<br /> ID: " . $r['id'] . "Subject: " . $r['subject'] . "Description: " . $r['description'] . "Request Template: " . $r['requesttemplate'] . "Group" . $r['group'] . "Level: " . $r['level'] . "Status: " . $r['status'] . "Mode: " . $r['mode'] . "Request Type: " . $r['requesttype'] . "Category: " . $r['category'] . "Subcategory: " . $r['subcategory'] . "Item: . " $r['item'] . "Impact: " . $r['impact'] . "Urgency: " . $r['urgency'] . "Priority: " . $r['priority'] . "<b>End of Line</b>";
			}
			foreach($data as $x=>$x_val){
				$arrXMLContent = array($x=>$x_val);
			}
			$XMLString = create_xmlstring($arrXMLContent, $requester, $technician);
			$post_input = array(
				"OPERATION_NAME" => "ADD_REQUEST",
				"TECHNICIAN_KEY" => $techniciankey,
				"INPUT_DATA" => $XMLString
			);
			if($DEBUG == "true"){
				echo $post_input;
			}
			$returnAddRequest = add_request($url, $post_input);
			get_sdpoutput($returnAddRequest);
			
			
		}
	if( $close_request == 'true' && isset($workorderID) ){
		$reqCloseConfirm = close_request($url, $workorderID, $techniciankey);
		get_sdpoutput($reqCloseConfirm);
	}
}

?>