<?php
include '../local_settings.php';

//connect to db
$conn = mysql_connect('localhost', $DB->DBUSER, $DB->DBPASS) or die('Could not connect to server.' );
mysql_select_db($DB->DBNAME, $conn) or die('Could not select database.');
mysql_query("SET NAMES utf8");


$link = "http://moodle.digital-campus.org/course/modedit.php?return=0&sr=0&update=";



	
$file = "to-clean.html";
$fh = fopen($file, 'w') or die("can't open file"); 
fwrite($fh, "<h2>Pages with 'caption img'</h2>");
$sql = "select cm.id, p.name from mdl_page p inner join mdl_course_modules cm On cm.instance = p.id where (p.content like '%caption\"><img %') 
AND p.course IN (105, 97, 118, 106, 107, 108, 109, 110, 111, 112, 117, 113, 114, 158, 101, 120, 99, 115, 116, 100, 98, 177, 175, 178, 173, 176, 174,185, 189, 190, 191, 192, 187, 195, 196, 193, 194, 199, 171, 168 ,169, 164, 197, 198, 170, 172 )";

$result = mysql_query($sql,$conn);

fwrite($fh, "<ol>");
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	fwrite($fh, "<li><a target='_blank' href='");
	fwrite($fh, $link.$row['id']."'>");
	fwrite($fh, $row['name']);
	fwrite($fh, "</a></li>");
}
fwrite($fh, "</ol>");

fwrite($fh, "<h2>Pages with 'style=\"text-align: left;\"'</h2>");
$sql = "select cm.id, p.name from mdl_page p inner join mdl_course_modules cm On cm.instance = p.id where (p.content like '%style=\"text-align: left;\"%') 
AND p.course IN (105, 97, 118, 106, 107, 108, 109, 110, 111, 112, 117, 113, 114, 158, 101, 120, 99, 115, 116, 100, 98, 177, 175, 178, 173, 176, 174,185, 189, 190, 191, 192, 187, 195, 196, 193, 194, 199, 171, 168 ,169, 164, 197, 198, 170, 172 )";

$result = mysql_query($sql,$conn);

fwrite($fh, "<ol>");
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	fwrite($fh, "<li><a target='_blank' href='");
	fwrite($fh, $link.$row['id']."'>");
	fwrite($fh, $row['name']);
	fwrite($fh, "</a></li>");
}
fwrite($fh, "</ol>");

fwrite($fh, "<h2>Pages with 'style=\"display: block; margin-left: auto; margin-right: auto;\"'</h2>");
$sql = "select cm.id, p.name from mdl_page p inner join mdl_course_modules cm On cm.instance = p.id where (p.content like '%style=\"display: block; margin-left: auto; margin-right: auto;\"%') 
AND p.course IN (105, 97, 118, 106, 107, 108, 109, 110, 111, 112, 117, 113, 114, 158, 101, 120, 99, 115, 116, 100, 98, 177, 175, 178, 173, 176, 174,185, 189, 190, 191, 192, 187, 195, 196, 193, 194, 199, 171, 168 ,169, 164, 197, 198, 170, 172 )";

$result = mysql_query($sql,$conn);

fwrite($fh, "<ol>");
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	fwrite($fh, "<li><a target='_blank' href='");
	fwrite($fh, $link.$row['id']."'>");
	fwrite($fh, $row['name']);
	fwrite($fh, "</a></li>");
}
fwrite($fh, "</ol>");


fwrite($fh, "<h2>Pages with 'style=\"line-height:'</h2>");
$sql = "select cm.id, p.name from mdl_page p inner join mdl_course_modules cm On cm.instance = p.id where (p.content like '%style=\"line-height:%') 
AND p.course IN (105, 97, 118, 106, 107, 108, 109, 110, 111, 112, 117, 113, 114, 158, 101, 120, 99, 115, 116, 100, 98, 177, 175, 178, 173, 176, 174,185, 189, 190, 191, 192, 187, 195, 196, 193, 194, 199, 171, 168 ,169, 164, 197, 198, 170, 172 )";

$result = mysql_query($sql,$conn);

fwrite($fh, "<ol>");
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	fwrite($fh, "<li><a target='_blank' href='");
	fwrite($fh, $link.$row['id']."'>");
	fwrite($fh, $row['name']);
	fwrite($fh, "</a></li>");
}
fwrite($fh, "</ol>");



fwrite($fh, "<h2>Pages with 'p class=\"credit\"'</h2>");
$sql = "select cm.id, p.name from mdl_page p inner join mdl_course_modules cm On cm.instance = p.id where (p.content like '%p class=\"credit\"%') 
AND p.course IN (105, 97, 118, 106, 107, 108, 109, 110, 111, 112, 117, 113, 114, 158, 101, 120, 99, 115, 116, 100, 98, 177, 175, 178, 173, 176, 174,185, 189, 190, 191, 192, 187, 195, 196, 193, 194, 199, 171, 168 ,169, 164, 197, 198, 170, 172 )";

$result = mysql_query($sql,$conn);

fwrite($fh, "<ol>");
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	fwrite($fh, "<li><a target='_blank' href='");
	fwrite($fh, $link.$row['id']."'>");
	fwrite($fh, $row['name']);
	fwrite($fh, "</a></li>");
}
fwrite($fh, "</ol>");



fwrite($fh, "<h2>Pages with 'p class=\"box '</h2>");
$sql = "select cm.id, p.name from mdl_page p inner join mdl_course_modules cm On cm.instance = p.id where (p.content like '%p class=\"box %') 
AND p.course IN (105, 97, 118, 106, 107, 108, 109, 110, 111, 112, 117, 113, 114, 158, 101, 120, 99, 115, 116, 100, 98, 177, 175, 178, 173, 176, 174,185, 189, 190, 191, 192, 187, 195, 196, 193, 194, 199, 171, 168 ,169, 164, 197, 198, 170, 172 )";

$result = mysql_query($sql,$conn);

fwrite($fh, "<ol>");
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	fwrite($fh, "<li><a target='_blank' href='");
	fwrite($fh, $link.$row['id']."'>");
	fwrite($fh, $row['name']);
	fwrite($fh, "</a></li>");
}
fwrite($fh, "</ol>");

fwrite($fh, "<h2>Pages with 'div class=\"box question\" p strong'</h2>");
$sql = "select cm.id, p.name from mdl_page p inner join mdl_course_modules cm On cm.instance = p.id where (p.content like '%<div class=\"box question\"><p><strong>%' OR p.content LIKE '%<div class=\"box question\"><strong>%' ) 
AND p.course IN (105, 97, 118, 106, 107, 108, 109, 110, 111, 112, 117, 113, 114, 158, 101, 120, 99, 115, 116, 100, 98, 177, 175, 178, 173, 176, 174,185, 189, 190, 191, 192, 187, 195, 196, 193, 194, 199, 171, 168 ,169, 164, 197, 198, 170, 172 )";

$result = mysql_query($sql,$conn);

fwrite($fh, "<ol>");
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	fwrite($fh, "<li><a target='_blank' href='");
	fwrite($fh, $link.$row['id']."'>");
	fwrite($fh, $row['name']);
	fwrite($fh, "</a></li>");
}
fwrite($fh, "</ol>");


fclose($fh);




// db disconnect
mysql_close($conn);
