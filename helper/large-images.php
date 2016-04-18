<?php
/*
 *
 *
 */


include '../local_settings.php';

//connect to db
$db = new mysqli('localhost', $DB->DBUSER, $DB->DBPASS, $DB->DBNAME );

$file = "large-images.html";
$fh = fopen($file, 'w') or die("can't open file"); 
fwrite($fh, "<h2>Pages with 'large images'</h2>");
$sql = "select cm.id as cmid, p.id as pid, p.content, p.name, c.shortname from mdl_page p 
	inner join mdl_course_modules cm On cm.instance = p.id 
	inner join mdl_course c ON p.course = c.id
	where (p.content like '%.small.jpg%') 
	AND p.course IN (185, 189, 190, 191, 192, 187, 195, 196, 193, 194, 199, 171, 168 ,169, 164, 197, 198, 170, 172, 201,202)
	ORDER BY c.shortname ASC";

$result = mysql_query($sql,$conn);

fwrite($fh, "<ol>");
$shortname = "";
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	if ($shortname != $row['shortname']){
		fwrite($fh, "</ol>");
		fwrite($fh, "<h3>".$row['shortname']."</h3>");
		fwrite($fh, "<ol>");
	}
	fwrite($fh, "<li><a target='_blank' href='");
	fwrite($fh, $link.$row['cmid']."'>");
	fwrite($fh, $row['name']);
	fwrite($fh, "</a>");
	fwrite($fh, ": " . $row['shortname']);
	fwrite($fh, "</li>");
	$shortname = $row['shortname'];
}
fwrite($fh, "</ol>");


fclose($fh);

// db disconnect
$db->close();
