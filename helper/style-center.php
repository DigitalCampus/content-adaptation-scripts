<?php
/*
 * 
 *
 */

include '../local_settings.php';

//connect to db
$db = new mysqli('localhost', $DB->DBUSER, $DB->DBPASS, $DB->DBNAME );

$file = "../output/centre.html";
$fh = fopen($file, 'w') or die("can't open file"); 
fwrite($fh, "<h2>Pages with 'centre'</h2>");
$sql = "select cm.id as cmid, p.id as pid, p.content, p.name from mdl_page p 
	inner join mdl_course_modules cm On cm.instance = p.id 
	where (p.content like '%style=\"text-align: center;\"%') 
	AND p.course IN (105, 97, 118, 106, 107, 108, 109, 110, 111, 112, 117, 113, 114, 158, 101, 120, 99, 115, 116, 100, 98, 166, 167, 177, 175, 178, 173, 176, 174,185, 189, 190, 191, 192, 187, 195, 196, 193, 194, 199, 171, 168 ,169, 164, 197, 198, 170, 172 )";

$result = mysql_query($sql,$conn);

fwrite($fh, "<ol>");
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	fwrite($fh, "<li><a target='_blank' href='");
	fwrite($fh, $link.$row['cmid']."'>");
	fwrite($fh, $row['name']);
	fwrite($fh, "</a></li>");
	$new_content = str_replace("style=\"text-align: center;\""," ",$row['content']);
	print trim($new_content)."\n\n";
	$sql = "UPDATE mdl_page SET content='".mysql_real_escape_string($new_content)."' WHERE id=".$row['pid'];
	$newres = mysql_query($sql,$conn);
}
fwrite($fh, "</ol>");


fclose($fh);

// db disconnect
$db->close();
