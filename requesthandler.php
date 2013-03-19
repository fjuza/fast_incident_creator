<?php

include_once('functions/mysqli_conn.php');
include_once('functions/func.php');
include('functions/variables.php');
if(isset($_POST['requests']) && isset($_POST['Requester']) && isset($_POST['Technician']) && isset($_POST['close_request']) && isset($_POST['technician_key']) ){
	
	$requests = $_POST['requests'];
	$requester = $_POST['Requester'];
	$technician = $_POST['Technician'];
	$techniciankey = $_POST['technician_key'];
	$close_request = $_POST['close_request'];
		
	$SQLquery = "SELECT * FROM incidents WHERE reqTemplate = " . $requests;
		$data = get_mysqliData($SQLquery);
		
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