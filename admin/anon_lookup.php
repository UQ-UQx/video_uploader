<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	$contents = file_get_contents("$courseid/anon_ids.csv");
        $contents = str_replace('"',"",$contents);
	$rows = explode("\n", $contents);
	$students = array();
	foreach($rows as $row) {
		$row = explode(",", $row);
		if(sizeOf($row) > 2) {
			$students[trim($row[2])] = $row[0];
		}
	}
?>
