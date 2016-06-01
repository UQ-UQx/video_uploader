<html>
<head>
	<script type="text/javascript" src="jquery.js"></script> 
	<script type="text/javascript" src="jquery.tablesorter.min.js"></script> 
</head>
<body>
<style>
body {
	background:#fafafa;
	font-family:"Helvetica Neue",Helvetica,sans-serif;
	margin:10px;
}
table {
	border:1px solid #333;
	width:100%;
}
table th {
	background:#333;
	color:#fff;
	padding:5px;
}
table td {
	padding:5px;
	border-bottom:1px solid #333;
}
p a {
	font-size:120%;
}
</style>
<h1>Video Uploader - Uploaded Files</h1>
<table cellpadding="0" cellspacing="0" id='studentTable'>
<thead>
	<tr><th>Username</th><th>Name</th><th>Student ID</th><th>File</th><th>Uploaded</th></tr>
</thead> 
<tbody>
<?php
	$courseid=$_POST['courseid'];
	require_once('../hashing.php');
	require_once('anon_lookup.php');
	require_once('sql_setup.php');
	$dir = "../files";	
	$dh  = opendir($dir);
	$files = array();
        while (false !== ($filename = readdir($dh))) {
		if($filename != '.' && $filename != '..' && $filename != 'thumbnail') {
	    	$files[] = $filename;
	    }
	}
        //print_r($students);
	foreach($files as $file) {
		echo '<tr>';
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
			echo '<td>'.$username.'</td>';
			echo '<td>'.$fullname.'</td>';
			echo '<td>'.$student.'</td>';
			echo '<td><a target="_blank" href="../files/'.$file.'">'.$filename.'</a></td>';
			echo '<td>(Uploaded '.$ftime.')</td>';
			echo '</tr>';
		}	
	}	
?>
</tbody>
</table>
<p><a href="csv.php?courseid=<?php print $courseid ?>">Download the file CSV here</a>.</p>
<script>
$(document).ready(function() 
    { 
        $("#studentTable").tablesorter(); 
    } 
);
</script>
</body>
</html>
