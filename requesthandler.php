<?php
//Set to true to get debug output. This is for development at the moment. But it might be useful when setting it up in new environments too.
$DEBUG = "false";
include_once('functions/mysqli_conn.php');
include_once('functions/func.php');
include('functions/variables.php');
if($DEBUG == "true"){
	echo "<span>IN DEBUGMODE</span><br />";
}

if(isset($_POST['request']) && isset($_POST['requester']) && isset($_POST['technician']) ){

	if($DEBUG == "true"){
		echo "<br /> Check post-attributes: Ok <br />";
	}

	$requests = $_POST['request'];
	$requester = $_POST['requester'];
	$technician = $_POST['technician'];
	if(isset($_POST['close_request'])){
		$close_request = $_POST['close_request'];
	} else {
		$close_request  = "false";
	}
	if($DEBUG == "true"){
		echo "Input from form.<br/>";
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
			$arrXMLContent = array('id'=>$r['id'], 'subject'=>$r['subject'], 'description'=>$r['description'], 'requesttemplate'=>$r['requesttemplate'], 'group'=>$r['group'], 'level'=>$r['level'], 'status'=>$r['status'], 'mode'=>$r['mode'], 'requesttype'=>$r['requesttype'], 'category'=>$r['category'], 'subcategory'=>$r['subcategory'], 'item'=>$r['item'], 'impact'=>$r['impact'], 'urgency'=>$r['urgency'], 'priority'=>$r['priority']);

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
				foreach($post_input as $x=>$x_val){
					echo $x . ": " . $x_val . "<br>";
				}
			}
			
			$returnAddRequest = add_request($url, $post_input);
			$xmlString = simplexml_load_string($returnAddRequest);
			$output = Obj2arr($xmlString);
			if(isset($output['result']['status']))
			{
				$name = $output['@attributes']['name'] ;
				$status = $output['result']['status'];
				$message = $output['result']['message'];
				$workorderID = "n/a";
			} else {
				$name = $output['response']['operation']['@attributes']['name'];
				$status = $output['response']['operation']['result']['status'];
				$message = $output['response']['operation']['result']['message'];
				$workorderID = $output['response']['operation']['Details']['0']['workorderid'];
			}
			if($DEBUG == "true"){
				echo "<br> output from ServiceDesk Plus(adding request): <br>";
				echo  "Type: " . $name . "<br/>";
				echo "Status: " .$status . "<br/>";
				echo "Message: " . $message . "<br/>";
				echo "WorkOrderID: " . $workorderID . "<br/>";
			}
		}
	if( $close_request == 'true' && isset($workorderID) ){
		$reqCloseConfirm = close_request($url, $workorderID, $techniciankey);
		$xmlString = simplexml_load_string($reqCloseConfirm);
		$output = Obj2arr($xmlString);
		if(isset($output['@attributes']['name'])){
			$name = $output['@attributes']['name'];
			$status = $output['result']['status'];
			$message = $output['result']['message'];
		} else {
			$name = $output['response']['operation']['@attributes']['name'];
			$status = $output['response']['operation']['result']['status'];
			$message  = $output['response']['operation']['result']['message'];
		}
		
		if($DEBUG == "true" && $close_request == 'true'){
				echo "<br> output from ServiceDesk Plus(closing request): <br>";
				echo "url: " . $url . "<br/>";
				echo "workorderID: " . $workorderID . "<br/>";
				echo "TechnicianKey: " . $techniciankey . "<br/>";
				echo  "Type: " . $name . "<br/>";
				echo "Status: " .$status . "<br/>";
				echo "Message: " . $message . "<br/>";
		}
	}
	header('Location: http://localhost:8080/fastic/index.php');
	
}

?>