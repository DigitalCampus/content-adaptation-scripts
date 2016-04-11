<?php
include 'local_settings.php';

//connect to db
$conn = mysql_connect('localhost', $DB->DBUSER, $DB->DBPASS) or die('Could not connect to server.' );
mysql_select_db($DB->DBNAME, $conn) or die('Could not select database.');
mysql_query("SET NAMES utf8");

$section_end = 22;

foreach ($ADAPT->COURSES as $course ){

	for ($section = 1; $section<= $section_end; $section++){
		$sql = "SELECT cm.id FROM mdl_page p inner join mdl_course_modules cm ON cm.instance = p.id WHERE p.course=".$course." AND p.name LIKE '".$section.".%'";
		$result = mysql_query($sql,$conn);
		$seq = "";
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$seq .= $row['id'].",";
		}
	
		$seq =substr($seq, 0, -1);
		print $seq;
	
		$sql = "SELECT * FROM mdl_course_sections WHERE course=".$course." AND section = ".($section+1);
		echo $sql;
		$result = mysql_query($sql,$conn);
		$toupdate = 0;
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$toupdate = $row['id'];
		}
	
		$sql = "UPDATE mdl_course_sections SET sequence='".$seq."' WHERE course=".$course." AND section = ".($section+1);
		mysql_query($sql,$conn);
	}
	
	$sql = "UPDATE mdl_course_sections SET sequence='' WHERE course=".$course." AND section = 1";
	mysql_query($sql,$conn);
}

// db disconnect
mysql_close($conn);
