<?php
	include('variables.php');
	function get_mysqliData ($query){
		$db = new mysqli($url, $user, $password, $dbName);
		if($db->connect_errno > 0){
			return $db->connect_error;
		}
		if(!$result = $db->query($query)){
			return $db->error;
		}
		return $result;
	}
?>