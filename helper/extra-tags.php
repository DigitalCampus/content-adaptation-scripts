<?php
/*
 * 
 *
 */


include '../local_settings.php';

//connect to db
$db = new mysqli('localhost', $DB->DBUSER, $DB->DBPASS, $DB->DBNAME );

$sql = "SELECT cm.id as cmid, p.id as pid, p.name, p.content FROM mdl_page p 
	inner join mdl_course_modules cm ON cm.instance = p.id 
	WHERE p.content LIKE '%</i><i>%'
	OR p.content LIKE '%</i> <i>%'
	OR p.content LIKE '%</b><b>%'
	OR p.content LIKE '%</b> <b>%'";
$result = mysql_query($sql,$conn);
		
$fh = fopen("tags.html", 'w') or die("can't open file");
		fwrite($fh, "<h1>Tags</h1>");

	fwrite($fh, "<ol>");
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		fwrite($fh, "<li><a target='_blank' href='");
		fwrite($fh, $link.$row['cmid']."'>");
		fwrite($fh, $row['name']);
		fwrite($fh, "</a>");
		//fwrite($fh, "<pre>".$row['content']."</pre>");
		fwrite($fh,"</li>");

		$new_content = str_replace('</b> <b>'," ",$row['content']);
		$new_content = str_replace('</b><b>',"",$new_content);
		$new_content = str_replace('</i><i>',"",$new_content);
		$new_content = str_replace('</i> <i>'," ",$new_content);
		$sql = "UPDATE mdl_page set content='".mysql_real_escape_string(trim($new_content))."' WHERE id=".$row['pid'].";";
		$newres = mysql_query($sql,$conn);
		print trim($new_content)."\n\n\n";
	}
	fwrite($fh, "</ol>");

	fclose($fh);


// db disconnect
$db->close();
