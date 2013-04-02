<?php
	function connect_mysqli($dbURL, $user, $password, $dbName){
		$db = new mysqli($dbURL, $user, $password, $dbName);
		return $db;
	}
	function close_mysqli($db){
		$db->close_connection;
	}
	
	function get_mysqliData ($query){
		include 'variables.php';
		$db = new mysqli($dbURL, $user, $password, $dbName);
		if($db->connect_errno > 0){
			return $db->connect_error;
		}
		if(!$result = $db->query($query)){
			return $db->error;
		}else{
			return $result;
			$db->close_connection;
		}
	}
	
	function add_mysqliData ($query){
		include 'variables.php';
		$connection = connect_mysqli($dbURL, $user, $password, $dbName);
		
		if($connection->connect_errno > 0){
			return $db->connect_error;
		} else {	
			if( !$result = $connection->query($query) ) {
				return $db->error;
			} else {
				return $result;
			}
		}
	}
?>