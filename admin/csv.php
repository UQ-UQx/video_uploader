<?php
	header("Content-type: text/csv");
	header("Content-Disposition: attachment; filename=video_uploader_names_".date('Y_m_d').".csv");
	header("Pragma: no-cache");
	header("Expires: 0");
	$courseid=$_GET['courseid'];
	require_once('../hashing.php');
	require_once('anon_lookup.php');
	require_once('sql_setup.php');
	ini_set('display_errors',0);
	$dir = "../files";
	$dh  = opendir($dir);
	echo 'File Link,Video Name,File Name,Student ID,Username,Full Name,Upload Date'."\n";
	$files = array();
        while (false !== ($filename = readdir($dh))) {
		if($filename != '.' && $filename != '..' && $filename != 'thumbnail') {
	    	$files[] = $filename;
	    }
	}
	foreach($files as $file) {
		$ftime = date('Y-m-d H:i:s',filemtime($dir.'/'.$file));
		$filename = preg_replace("/\\.[^.\\s]{3,4}$/", "", $file);
		$filename = do_decrypt('upload',$filename);
		$student = 'Unknown';
		$username = 'Unknown';
		$fullname = 'Unknown';
		if(isset($students[$filename])) {
			$student = $students[$filename];
			$username = $users[$student]['username'];
			$fullname = $users[$student]['fullname'];
			echo '"http://tools.ceit.uq.edu.au/videouploader/files/'.$file.'","'.$file.'","'.$filename."\",";
			echo '"'.$student.'",';
			echo '"'.$username.'",';
			echo '"'.$fullname.'",';
			echo '"'.$ftime.'"';
			echo "\n";
		}
	}	
?>
