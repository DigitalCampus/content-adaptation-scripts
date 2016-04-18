<?php

include 'local_settings.php';

//connect to db
$conn = mysql_connect('localhost', $DB->DBUSER, $DB->DBPASS) or die('Could not connect to server.' );
mysql_select_db($DB->DBNAME, $conn) or die('Could not select database.');
mysql_query("SET NAMES utf8");

// set course id
$course = 135;

$sql = "SELECT id,sequence FROM mdl_course_sections WHERE course=".$course;
echo $sql;
$topics = mysql_query($sql,$conn);
while($row = mysql_fetch_array($topics, MYSQL_ASSOC)){
	$new_sequence = array();
	$topic = $row['sequence'];
	print "\nOld sequence: ".$topic."\n";
	$topic_array = explode(",",$topic);
	$summary_id = 0;
	$quiz_id = 0;
	$intro_id = 0;
	$lo_id = 0;
	foreach($topic_array as $act_id){
		$sql = "SELECT p.name FROM mdl_page p inner join mdl_course_modules cm ON cm.instance = p.id WHERE p.course=".$course." AND cm.id= ".$act_id;
		$result = mysql_query($sql,$conn);
		while($act = mysql_fetch_array($result, MYSQL_ASSOC)){
			if ($act['name'] == "Summary"){
				$summary_id = $act_id;
			} else if ($act['name'] == "Quiz"){
				$quiz_id = $act_id;
			} else if ($act['name'] == "Introduction"){
				$intro_id = $act_id;
			} else if ($act['name'] == "Learning Outcomes"){
				$lo_id = $act_id;
			} else {
				array_push($new_sequence,$act_id);
			}
		}
		$sql = "SELECT p.name FROM mdl_quiz p inner join mdl_course_modules cm ON cm.instance = p.id WHERE p.course=".$course." AND cm.id= ".$act_id;
		$result = mysql_query($sql,$conn);
		while($act = mysql_fetch_array($result, MYSQL_ASSOC)){
			if ($act['name'] == "Summary"){
				$summary_id = $act_id;
			} else if ($act['name'] == "Quiz"){
				$quiz_id = $act_id;
			} else if ($act['name'] == "Introduction"){
				$intro_id = $act_id;
			} else if ($act['name'] == "Learning Outcomes"){
				$lo_id = $act_id;
			} else {
				array_push($new_sequence,$act_id);
			}
		}
	}
	if ($summary_id != 0){
		array_push($new_sequence,$summary_id);
	}
	if ($quiz_id != 0){
		array_push($new_sequence,$quiz_id);
	}
	if ($lo_id != 0){
		array_unshift($new_sequence,$lo_id);
	}if ($intro_id != 0){
		array_unshift($new_sequence,$intro_id);
	}
	$new_seq_str = implode(",",$new_sequence);
	print "\n".$new_seq_str;
	$sql = "UPDATE mdl_course_sections SET sequence='".$new_seq_str."' WHERE course=".$course." AND id=".$row['id'];
	mysql_query($sql,$conn);
	
}

// db disconnect
mysql_close($conn);
