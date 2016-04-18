<?php
/*
 * 
 * 
 */


include 'local_settings.php';

//connect to db
$db = new mysqli('localhost', $DB->DBUSER, $DB->DBPASS, $DB->DBNAME );

foreach ($ADAPT->COURSES as $course ){

	for ($section = 1; $section<= $MAX_TOPICS; $section++){
		$sqlString = 'SELECT cm.id FROM mdl_page p 
						INNER JOIN mdl_course_modules cm ON cm.instance = p.id 
						WHERE p.course=%1$d  
						AND p.name LIKE \'%2$d.%%\'';
		$sql = sprintf($sqlString, $course, $section);
		$result = $db->query($sql);
		$seqArray = [];
		while($row = $result->fetch_assoc()){
			array_push($seqArray, $row['id']);
		}
		$result->free();
		$seq = implode(',',$seqArray);
				
		$sqlString = 'UPDATE mdl_course_sections 
						SET sequence=\'%1$s\' 
						WHERE course=%2$d
						AND section = %3$d';
		$sql = sprintf($sqlString, $seq, $course, $section+1);
		$db->query($sql);
	}
	
	// reset the first topic
	$sqlString = 'UPDATE mdl_course_sections SET sequence=\'\' 
					WHERE course=%1$d 
					AND section = 1';
	$sql = sprintf($sqlString, $course);
	$db->query($sql);
}

// db disconnect
$db->close();
