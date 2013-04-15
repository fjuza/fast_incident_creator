<?php

if ( !isset($_REQUEST['term']) )
    exit;

	include('functions/variables.php');


//Search strings.
$SearchFor = $_REQUEST['term'];
$SearchField = "displayname";
$LDAPFields = array("displayname");

$cnx = ldap_connect($LDAPhost) or die ("Failed to connect to AD server");
ldap_set_option($cnx, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($cnx, LDAP_OPT_REFERRALS, 0);
ldap_bind($cnx, $LDAPuser.$LDAPuserDomain,$LDAPpassword) or die ("Could not bind to LDAP");
error_reporting(E_ALL ^ E_NOTICE);
$filter = "($SearchField=$SearchFor*)";
$sr = ldap_search($cnx, $dn, $filter, $LDAPFields, 0, 0);
$info = ldap_get_entries($cnx, $sr);
$data[] = array();
if($data) {
	for($x=0; $x<$info['count']; $x++){
		$data[] = array(
			'label' => $info[$x]['displayname'][0]
		);
	}
}
$data = array_slice($data, 1);
echo json_encode($data);
flush();

?>
