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
		$ch1 = curl_init();
			curl_setopt($ch1, CURLOPT_URL, $url);
			curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch1, CURLOPT_POST, 1);
			curl_setopt($ch1, CURLOPT_POSTFIELDS, "OPERATION_NAME=CLOSE_REQUEST"."&TECHNICIAN_KEY=".$techniciankey );
		$output = curl_exec($ch1);
		
		curl_close($ch1);
		return $output;
	}

	function Obj2Arr($arrObjData, $arrSkipInd = array()){
		$arrData = array();
		
		//If input is object, convert into array
		if(is_object($arrObjData)) {
			$arrObjData = get_object_vars($arrObjData);
		}
		if(is_array($arrObjData)){
			foreach($arrObjData as $index => $value ) {
				if(is_object($value) || is_array($value)) {
					$value = Obj2Arr($value, $arrSkipInd); //reqursive call
				}
				if(in_array($index, $arrSkipInd)) {
					continue;
				}
				$arrData[$index] = $value;
			}
		}
	return $arrData;
	}
	
?>