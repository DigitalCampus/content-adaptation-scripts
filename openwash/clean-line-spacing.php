<?php
/*
 * 
 *
 */


include '../local_settings.php';

//connect to db
$db = new mysqli('localhost', $DB->DBUSER, $DB->DBPASS, $DB->DBNAME );

// set course id
$course = 165;


// remove unnecessary classes etc

$sql = "SELECT id, content FROM mdl_page WHERE course=".$course;
$result = $db->query($sql);
while($row = $result->fetch_assoc()){
	print $row['content']."\n\n\n";
	
	$new_content = $row['content'];
	
	$new_content = str_replace('<span style="line-height: 1.231;">',"",$new_content);
	$new_content = str_replace(' style="line-height: 1.231;"',"",$new_content);
	$new_content = str_replace('</span>',"",$new_content);


	$sql = "UPDATE mdl_page SET content='".mysql_real_escape_string(trim($new_content))."' WHERE id=".$row['id'];
	$newres = $db->query($sql);
	print trim($new_content)."\n\n\n";

}


// db disconnect
$db->close();

?>
