<?php
	require_once('sql_engine.php');
	$connection_information = array(
		'host' => 'localhost',
		'user' => 'root',
		'pass' => 'r3m0teAXS',
		'db' => $courseid 
	);
	$m = new mysql($connection_information);
	
	$userfullnameresults = $m->query('SELECT user_id,name FROM `auth_userprofile`');
	$userfullnames = array();
	foreach($userfullnameresults as $userfullnameresult) {
		$userfullnames[$userfullnameresult['auth_userprofile']['user_id']] = $userfullnameresult['auth_userprofile']['name'];
	}
	
	$usernameresults = $m->query('SELECT id,username FROM `auth_user`');
	$users = array();
	foreach($usernameresults as $usernameresult) {
		$userdata = array('username'=>$usernameresult['auth_user']['username']);
		if(isset($userfullnames[$usernameresult['auth_user']['id']])) {
			$userdata['fullname'] = $userfullnames[$usernameresult['auth_user']['id']];
		}
		
		$users[$usernameresult['auth_user']['id']] = $userdata;
	}
	
?>
