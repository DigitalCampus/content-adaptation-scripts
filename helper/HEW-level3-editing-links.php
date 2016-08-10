<?php
/*
 * 
 *
 */


include '../local_settings.php';

//connect to db
$db = new mysqli('localhost', $DB->DBUSER, $DB->DBPASS, $DB->DBNAME );

$ADAPT->COURSES = array(291, 296, 308, 317, 312, 310, 307, 303, 313, 315, 316, 319 );

$SEARCH_TERMS = array(	"health extension worker",
						"Health Centre",
						"Hospital",
						"health post",
						"box",
						"case study",
						"table",
						"figure",
						"fig"	
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
