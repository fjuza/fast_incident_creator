<?php
$DEBUG = "true";
include_once('functions/mysqli_conn.php');
include_once('functions/func.php');
include('functions/variables.php');
if(isset($_POST['requests']) && isset($_POST['Requester']) && isset($_POST['Technician']) && isset($_POST['technician_key']) ){
	if($DEBUG == "true"){
		echo "test";
	}
	$requests = $_POST['requests'];
	$requester = $_POST['Requester'];
	$technician = $_POST['Technician'];
	$techniciankey = $_POST['technician_key'];
	$close_request = $_POST['close_request'];
	if($DEBUG == "true"){
		echo "Requests: " . $requests . "<br />";
		echo "Requester: " . $requester . "<br />";
		echo "Technician: " . $technician . "<br />";
		echo "Technician Key" . $techniciankey . "<br />";
		echo "Close Request?" . $close_request . "<br />";
	}
	$SQLquery = "SELECT * FROM incidents WHERE reqTemplate = " . $requests;
	if($DEBUG == "true"){
		echo "SQL query: " . $SQLquery;
	}
		$data = get_mysqliData($SQLquery);
		while($r = $data->fetch_assoc()){
			
		}
		if(isset($data)){
			foreach($data as $x=>$x_val){
				$arrXMLContent = array($x=>$x_val);
			}
			$XMLString = create_xmlstring($arrXMLContent, $requester, $technician);
			$post_input = array(
				"OPERATION_NAME" => "ADD_REQUEST",
				"TECHNICIAN_KEY" => $techniciankey,
				"INPUT_DATA" => $XMLString
			);
			$returnAddRequest = add_request($url, $post_input);
		}
		
	if( $close_request == 'true' && isset($workorderID) ){
		$reqCloseConfirm = close_request($url, $workorderID, $techniciankey);
	}
}

?>