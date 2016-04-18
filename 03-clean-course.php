<?php
/*
 * 
 *
 */


include 'local_settings.php';

//connect to db
$db = new mysqli('localhost', $DB->DBUSER, $DB->DBPASS, $DB->DBNAME );

// set course id
$course = 135;

$sql = "UPDATE mdl_course_modules SET indent=0 WHERE course=".$course;
$result = mysql_query($sql,$conn);


// remove number from start of page name
// & copy page name to description
$sql = "SELECT id,name FROM mdl_page WHERE name REGEXP '\\(^[0-9]+\\)' = 1 AND course=".$course;
$result = mysql_query($sql,$conn);
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	print $row['name']."\n";
	$new_content = preg_replace("(^[0-9.]*)",'',$row['name']);
	$new_content = str_replace("&#xA0;","",$new_content);
	print trim($new_content)."\n\n";
	$sql = "UPDATE mdl_page SET name='".mysql_real_escape_string($new_content)."',  intro='".mysql_real_escape_string($new_content)."' WHERE id=".$row['id'];
	$newres = mysql_query($sql,$conn);
	print $newres;
}


// remove any include js scripts

$sql = "SELECT id, content FROM mdl_page WHERE course=".$course;
$result = mysql_query($sql,$conn);
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	print $row['content']."\n\n\n";
	print $row['id']."\n\n\n";
	$new_content = str_replace('<div id="mod-oucontent-view" class="mod-oucontent">','', $row['content']);
	
	$new_content = preg_replace('#<script[^>]*>([^<]*)<\/script>#','',$new_content);
	$new_content = preg_replace('#<script type=\'text/javascript\'>//<!([^<]*?)><\/script>#','',$new_content);
	print trim($new_content)."\n\n\n";
	$sql = "UPDATE mdl_page SET content='".mysql_real_escape_string($new_content)."' WHERE id=".$row['id'];
	$newres = mysql_query($sql,$conn);
	print $newres;
}


// remove initial navigation
$sql = "SELECT id, content FROM mdl_page WHERE course=".$course;
$result = mysql_query($sql,$conn);
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	print $row['content']."\n\n\n";
	
	$new_content = preg_replace('#<div class=\'oucontent-prev\'>(.*?)><\/div>#','',$row['content']);
	$sql = "UPDATE mdl_page SET content='".mysql_real_escape_string(trim($new_content))."' WHERE id=".$row['id'];

	$newres = mysql_query($sql,$conn);
	print trim($new_content)."\n\n\n";
}



// remove final navigation
$sql = "SELECT id, content FROM mdl_page WHERE course=".$course;
$result = mysql_query($sql,$conn);
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	print $row['content']."\n\n\n";
	$new_content = preg_replace('#<div class=\'oucontent-next\'>(.*?)><\/div>#','',$row['content']);
	$sql = "UPDATE mdl_page SET content='".mysql_real_escape_string(trim($new_content))."' WHERE id=".$row['id'];
	$newres = mysql_query($sql,$conn);
	print trim($new_content)."\n\n\n";
}


// remove heading 1
$sql = "SELECT id, content FROM mdl_page WHERE course=".$course;
$result = mysql_query($sql,$conn);
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	print $row['content']."\n\n\n";
	print $row['id']."\n\n\n";
	$new_content = preg_replace('#<h1>(.*?)<\/h1>#','',$row['content']);
	$sql = "UPDATE mdl_page SET content='".mysql_real_escape_string(trim($new_content))."' WHERE id=".$row['id'];
	$newres = mysql_query($sql,$conn);
	print trim($new_content)."\n\n\n";
}


// remove unnecessary classes etc

$sql = "SELECT id, content FROM mdl_page WHERE course=".$course;
$result = mysql_query($sql,$conn);
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	print $row['content']."\n\n\n";
	
	$new_content = str_replace('&#x2018;',"'",$row['content']);
	$new_content = str_replace('’',"'",$new_content);
	$new_content = str_replace(' class="oucontent-numbered"',"",$new_content);
	$new_content = str_replace(' class="oucontent-bulleted"',"",$new_content);
	$new_content = str_replace('<div class="oucontent-internalsection">',"",$new_content);
	$new_content = str_replace('&#xA0;'," ",$new_content);
	$new_content = str_replace('class="oucontent-h2 oucontent-internalsection-head"',"",$new_content);
	$new_content = str_replace('class="oucontent-h3 oucontent-nonumber"',"",$new_content);
	$new_content = str_replace('<div class="oucontent-inner-box">'," ",$new_content);
	$new_content = str_replace('<div class="oucontent-table oucontent-s-type2 oucontent-s-box">',"",$new_content);
	$new_content = str_replace('<div id="mod-oucontent-view" class="mod-oucontent">',"",$new_content);
	$new_content = str_replace('<span xml:lang="en-US" lang="en-US">',"",$new_content);
	$new_content = str_replace('<span xml:lang="en-GB" lang="en-GB">',"",$new_content);
	$new_content = str_replace('<span lang="en-US" xml:lang="en-US">',"",$new_content);
	$new_content = str_replace('<span lang="en-GB" xml:lang="en-GB">',"",$new_content);
	$new_content = str_replace('<span lang="de" xml:lang="de">',"",$new_content);
	$new_content = str_replace('<span lang="en-US">',"",$new_content);
	$new_content = str_replace('<span lang="en-GB">',"",$new_content);
	$new_content = str_replace('</span>',"",$new_content);
	$new_content = str_replace('<ul><li class="oucontent-saq-question">',"",$new_content);
	$new_content = str_replace('<li class="oucontent-saq-answer">',"",$new_content);
	$new_content = str_replace('class="oucontent-tablemiddle"',"",$new_content);
	$new_content = str_replace('<div class="oucontent-outer-box">',"",$new_content);
	$new_content = str_replace('<div class="oucontent-inner-box">',"",$new_content);
	$new_content = str_replace('oucontent-caption oucontent-nonumber"><span class="oucontent-figure-',"",$new_content);
	$new_content = preg_replace('((</div>)$)','',$new_content);
	$new_content = str_replace('<div class="oucontent-figure oucontent-media-mini">',"",$new_content);
	$new_content = str_replace('<div class="oucontent-figure-text">',"",$new_content);
	$new_content = str_replace('style="list-style-type: lower-alpha;"',"",$new_content);
	$new_content = str_replace('<div class="oucontent-box oucontent-s-heavybox1 oucontent-s-box ">',"",$new_content);
	$new_content = str_replace('</b><b>',"",$new_content);
	$new_content = str_replace('</i><i>',"",$new_content);

	$sql = "UPDATE mdl_page SET content='".mysql_real_escape_string(trim($new_content))."' WHERE id=".$row['id'];
	$newres = mysql_query($sql,$conn);
	print trim($new_content)."\n\n\n";

}


// db disconnect
$db->close();

?>
