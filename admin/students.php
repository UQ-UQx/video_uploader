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

$studentlist = array("Epatiti","uqstudentros","ronaldojr12","uqstudentros","yikileung","kdadesho","Signap","HelaynaZ","chaceconroy","jillteitelbaum","s4318883","RamonaKleinschmidt","Angelchercoles85","tessstevenson","thaisazeredo","Angelchercoles85","Hennekam","Hennekam","MancyTang","SebastianGeorgiou7d26","Lbennett93","DanGibson","PetraHarman","Jai Croucher","Nathan1509","slouisem","courtneydevin","katelunney","makayla0128","Brooklyncorbett","tiff6995","Flick8","rickspcosta","Ksick","JackN96","victoriabotti","sunshinesterling","jessdemichelis","courtneydevin","PSYfan","DHannah","Aurorajes","VictoriaConcetti","Naomi81","nayounglim","zoeweller","jbrand3","alexstallman","alexstallman","DragonPrincess7","JohnSimpson22","Gfeberhart","JCSH8","BriannaNork","LaurenKaplan","victoriabotti","JoeyE","42900968","RebeccaWest","RebeccaWest","hooleydooleyy","courtneyskin","s43136175","kelseyirvin","zoe042","hughyp","lemyma-32","ROXANNEBORNMAN","ROXANNEBORNMAN","Cam2371","QuirkyGirl12345","AnnabelEdgecombe","TamzinWardle","ROXANNEBORNMAN","PSYC2371","DanFish10","talco511","eeebuss","AramintaMcLennan","AramintaMcLennan","DaniellePower","slamb12","ghassall","eeebuss","eeebuss","Luanaat","yinnam","HeitorDMM","FletchHammond","MarcusSia","sujlim93","gabrielaipanema","karenmelon","Lukeshen","jedlutton","leilaaubrey95","LewisNitschinsk","melly2371","rfabhiow","jberger210","Alexandria_McMillan22","CamilleBoileau","srahe","winnieyellow","fleuresant","sylviegiguere","emccusker95","twhj","monononon","ROXANNEBORNMAN","monononon","yinnam","J_Mills","QHailaiti","stephlangella","Choibeans","madeleinewilson22","YapQuanYi","epatiti","Scottin2","Lukeshen","jrv94","Mud_Garde","danigiuliani","AJINAU","IsaacSalisbury","ROXANNEBORNMAN","ROXANNEBORNMAN","hannahs7","JonBen","reprieschl","ben-austin","hannahs7","anitabroom","CandyceP","LachiePeterson","james5665","goleta","Don_93","Chelseaduke","tecaornella","FeLucchesi","Imeime","OrnellaZumpano","curtnotkurt","victoriag96","LachiePeterson","srcameron","kylewoodford","gchallub","CoenHird","Jberger210","Mimsie","AmandaManso","natalie_lee26","Ninjapanda","joshyouare80","renatagl","Kimberleyamie");
$studentlist = array_unique($studentlist);
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
		}
                if(in_array($username,$studentlist)) {
			echo '<tr>';
			echo '<td>'.$username.'</td>';
			echo '<td>'.$fullname.'</td>';
			echo '<td>'.$student.'</td>';
			echo '<td><a target="_blank" href="../files/'.$file.'">'.$filename.'</a></td>';
			echo '<td>(Uploaded '.$ftime.')</td>';
			echo '</tr>';

if(($key = array_search($username, $studentlist)) !== false) {
    unset($studentlist[$key]);
}                        

                }
	}	
?>
</tbody>
</table>
<h3>Students Missing</h3>
<ul>
<?php
foreach($studentlist as $stu) {
  echo '<li>'.$stu.'</li>';
}
?>
</ul>
<script>
$(document).ready(function() 
    { 
        $("#studentTable").tablesorter(); 
    } 
);
</script>
</body>
</html>
