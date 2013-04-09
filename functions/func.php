<?php
	include('variables.php');
	function show_returnMessage($XMLmessage){
		foreach($XMLmessage as $x => $x_val){
			
		}
	}
	function add_request($url, $post_input)
	{
		foreach($post_input as $x=>$x_val)
		{
			if($x == "OPERATION_NAME"){
				$operationname = $x_val;
			}
			if($x == "TECHNICIAN_KEY"){
				$techniciankey = trim($x_val);
			}
			if($x == "INPUT_DATA"){
				$inputdata = $x_val;
			}
		}

		//$recURL = "http://helpdesk.studentconsulting.net/sdpapi/request/";
		$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "OPERATION_NAME=".$operationname."&TECHNICIAN_KEY=".$techniciankey."&INPUT_DATA=".$inputdata);
		$output = curl_exec($ch);
		
		curl_close($ch);
		return $output;
	}
	
	function create_xmlstring($XMLContent, $requester, $technician, $opt = null ){
	include 'variables.php';
		//building the XML string.
		if($opt){
			//Later addons. For making changes to the request perhaps?
		}
		$xmlstring = "<Operation><Details><requester>$requester</requester><technician>$technician</technician><callbackURL>$callbackURL</callbackURL>";
		foreach($XMLContent as $r=>$r_val){
			if(!isset($r_val))
			{
				$xmlstring .= "<".$r.">"."</".$r.">";
			}else{
				$xmlstring .= "<".$r.">".$r_val."</".$r.">";
			}
		}
		$xmlstring .= "</Details></Operation>";
		return $xmlstring;
	}
	
	function close_request($url, $workorderID, $techniciankey){
	// $url contains http://localhost:8080/sdpapi/request/<workorderid>
	$url = $url . $workorderID;
		$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURL_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "OPERATION_NAME=CLOSE_REQUEST"."?TECHNICIAN_KEY=".$techniciankey );
		$output = curl_exec($ch);
		
		curl_close($ch);
		return $output;
	}
	function get_sdpoutput($output){
		$content = new SimpleXMLElement($output);
		foreach($content->operation as $operation){
			switch((string) $operation['name']){
				case 'CLOSE_REQUEST':
						$status = $content->operation[0]->status;
						$message = $content->operation[0]->message;
						$arrReturn = array("AMIHERECLOSEREQ?"=>"YES", "status"=>$status, "message"=>$message);
						return $arrReturn;
					break;

				case 'ADD_REQUEST':
						$status = $content->operation[0]->result->status;
						$message = $content->operation[0]->result->message;
						if($content->operation[0]->details->workorderid){
							$workorderID = $content->operation[0]->details->workorderid;
						}
						$arrReturn = array("AMIHEREADDREQ?"=>"YES", "status"=>$status, "message"=>$message, "workorderID"=>$workorderID);
						return $arrReturn;
					break;
			}
		}
	}

?>