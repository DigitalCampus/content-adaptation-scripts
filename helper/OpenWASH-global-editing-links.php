<?php
/*
 * 
 *
 */


include '../local_settings.php';

//connect to db
$db = new mysqli('localhost', $DB->DBUSER, $DB->DBPASS, $DB->DBNAME );

$SEARCH_TERMS = array(	"ethiopia", 
						"woreda",
						"kebele",						
						"health extension worker",
						"HEW",
						"health development army",
						"HDA",
						"health promotion worker",
						"Addis",
						"Oromo",
						"Oromia",
						"tigray",
						"amhara",
						"health post",
						"MoH",
						"FMoH",
						"Adama",
						"korales",
						"Ministry of Water and Energy",
						"Mekelle University",
						"Bahir Dar",
						"Regional Health Bureau",
						"Ministry of Works and Urban Development",
						"MoWE",
						"MoWUD",
						"MFSH",
						"CLTSH",
						"Town Water Board",
						"Hawassa",
						"Wechale",
						"birr",
						"gondar",
						"Operation and Maintenance Department",
						"Wuha Agar",
						"National Fluorosis Mitigation Project",
						"debo"	
);

foreach ($ADAPT->COURSES as $course){

	$file = null;
	$sql = "select fullname, shortname from mdl_course where id=".$course;
	$result = $db->query($sql);
	while($row = $result->fetch_assoc()){
		$file = $OUTPUT_DIR."links-".$row['shortname'].".html";
		$fh = fopen($file, 'w') or die("can't open file");
		fwrite($fh, "<h1>".$row['fullname']."</h1>");
	}
	
	foreach ($SEARCH_TERMS as $searchterm){
		print "checking for: ".$searchterm;
		print "\n";
		fwrite($fh, sprintf("<h2>Pages with '%s'</h2>",$searchterm));
		fwrite($fh, "<ol>");
		$sql = sprintf("select cm.id, p.name from mdl_page p inner join mdl_course_modules cm On cm.instance = p.id  where  
				p.content like '%%%s%%' AND p.course =%d", $searchterm, $course);
		$result = $db->query($sql);
		while($row = $result->fetch_assoc()){
			fwrite($fh, "<li><a target='_blank' href='");
			fwrite($fh, sprintf($ADAPT->EDIT_EXT_LINK,$row['id']));
			fwrite ($fh,"'>");
			fwrite($fh, $row['name']);
			fwrite($fh, "</a></li>");
		}
		fwrite($fh, "</ol>");
	}

	fclose($fh);

	print "Created editing links for: ".$course;
	print "\n";
}

// db disconnect
$db->close();
