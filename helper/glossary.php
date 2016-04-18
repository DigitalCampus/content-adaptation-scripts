<?php

include '../local_settings.php';

//connect to db
$conn = mysql_connect('localhost', $DB->DBUSER, $DB->DBPASS) or die('Could not connect to server.' );
mysql_select_db($DB->DBNAME, $conn) or die('Could not select database.');
mysql_query("SET NAMES utf8");

// set course id
//$courses = array(105, 97, 118, 106, 107, 108, 109, 110, 111, 112, 117, 113, 114, 158, 101, 120, 99, 115, 116, 100, 98, 166, 167, 177, 175, 178, 173, 176, 174, 204, 208, 209, 210, 211, 203, 212, 213, 218, 214, 215, 216, 217,185, 189, 190, 191, 192, 187, 195, 196, 193, 194, 199, 171, 168 ,169, 164, 197, 198, 170, 172, 201,202 ); //array(134,135);
$courses_et = array(185, 189, 190, 191, 192, 187, 195, 196, 193, 194, 199, 171, 168 ,169, 164, 197, 198, 170, 172, 201,202 );

//array(117, 111,112, 115,116,105, 106, 107,108,109, 110,113,114);
$link = "http://moodle.digital-campus.org/course/modedit.php?return=0&sr=0&update=";

$all_defs = array();
foreach ($courses_et as $course){

	$file = null;
	$sql = "select fullname, shortname from mdl_course where id=".$course;
	$result = mysql_query($sql,$conn);
	/*while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$file = "output/".$course."-".$row['shortname'].".html";
		$fh = fopen($file, 'w') or die("can't open file");
		fwrite($fh, "<h1>".$row['fullname']."</h1>");
	}*/
	$sql = "SELECT cm.id, p.name, p.content FROM mdl_page p inner join mdl_course_modules cm On cm.instance = p.id 
		WHERE p.content REGEXP '\\(<b>\\)' = 1 
		AND p.course=".$course;
	$result = mysql_query($sql,$conn);
	
	unset($definitions);
	$definitions = array();

	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		
		preg_match_all('((<b>(?P<def>[\w\-]*)</b>))',$row['content'],$defs, PREG_OFFSET_CAPTURE);
		if(isset($defs['def']) && count($defs['def']) > 0){
			for($i=0;$i<count($defs['def']);$i++){
				if (strlen($defs['def'][$i][0]) > 1){
					$obj = new stdClass;
					$obj->word = $defs['def'][$i][0];
					$pos = strpos($row['content'],"<b>".$defs['def'][$i][0]."</b>")."\n";
					$start = 0;
					$end = strlen($row['content']);
					if($pos > 100){
						$start = $pos-150;
					}
					$obj->def = strip_tags(substr($row['content'], $start, 307+strlen($defs['def'][$i][0])));
					array_push($definitions,$obj);
				}
			}
		}
	}
	//$definitions = array_unique($definitions);
	//sort($definitions, SORT_NATURAL | SORT_FLAG_CASE);
	/*fwrite($fh, "<ol>");
	foreach ($definitions as $d){
		fwrite($fh, "<li><b>".$d->word."</b> - ".$d->def."</li>");
	}
	fwrite($fh, "</ol>");

	fclose($fh);*/

	$all_defs = array_merge($all_defs,$definitions);
}
// db disconnect
mysql_close($conn);

$file = "output/glossary.html";
$fh = fopen($file, 'w') or die("can't open file");
//fwrite($fh, "<h1>Glossary</h1>");

//$all_defs = array_unique($all_defs);
//sort($all_defs, SORT_NATURAL | SORT_FLAG_CASE);

fwrite($fh, "<table>");
foreach ($all_defs as $d){
	fwrite($fh, "<tr><td>".$d->word."</td><td>".$d->def."</td></tr>");
}
fwrite($fh, "</table>");
fclose($fh);



