<?php

$host = "192.168.100.2";

$ds = ldap_connect($host);

if($ds)
{
	//$r = ldap_bind($ds, "uid=ldapuser, ou=users, dc=contoso, dc=com", "NOTAPASSWORD123");
	ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
	ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
	$r=ldap_bind($ds);
	$sr = ldap_search($ds, "cn=Internal, cn=Standard User, cn=Users, cn=StudentConsulting, dc=studentconsulting, dc=net", "uid=*");
	
	$info = ldap_get_entries($ds, $sr);
	
	for($i=0; $i<$info["count"]; $i++){
		echo "uid: " . $info[$i]['uid'][0] . "<br/>";
		echo "displayName: " . $info[$i]['displayname'][0] . "<br/>";
	}
	ldap_close($ds);
} else {
	echo "say what!?";
} 