<?php
include '../local_settings.php';

//connect to db
$conn = mysql_connect('localhost', $DB->DBUSER, $DB->DBPASS) or die('Could not connect to server.' );
mysql_select_db($DB->DBNAME, $conn) or die('Could not select database.');
mysql_query("SET NAMES utf8");

// set course id
$courses_ou = array(105, 97, 118, 106, 107, 108, 109, 110, 111, 112, 117, 113, 114, 158, 101, 120, 99, 115, 116, 100, 98, 166, 167, 177, 175, 178, 173, 176, 174, 204, 208, 209, 210, 211, 203, 212, 213, 218, 214, 215, 216, 217,185, 189, 190, 191, 192, 187, 195, 196, 193, 194, 199, 171, 168 ,169, 164, 197, 198, 170, 172, 201,202 ); //array(134,135);
$courses_et = array(); //array(117, 111,112, 115,116,105, 106, 107,108,109, 110,113,114);
$link = "http://moodle.digital-campus.org/course/modedit.php?return=0&sr=0&update=";

$file = "sections.html";
$fh = fopen($file, 'w') or die("can't open file");
foreach ($courses_ou as $course){
	$sql = "select fullname, shortname from mdl_course where id=".$course;
	$c_result = mysql_query($sql,$conn);
	
	$sql = "select cm.id, p.name from mdl_page p " .
		" inner join mdl_course_modules cm On cm.instance = p.id " . 
		" where p.content LIKE '%http://down%'" . 
		" and p.course =".$course;
	$result = mysql_query($sql,$conn);
	
	if (mysql_num_rows($result) > 0){
		while($row = mysql_fetch_array($c_result, MYSQL_ASSOC)){
			fwrite($fh, "<h1>".$row['fullname']."</h1>");
		}
		
		fwrite($fh, "<ol>");
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			fwrite($fh, "<li><a target='_blank' href='");
			fwrite($fh, $link.$row['id']."'>");
			fwrite($fh, $row['name']);
			fwrite($fh, "</a></li>");
		}
		fwrite($fh, "</ol>");
	}
} 

fclose($fh);






foreach ($courses_et as $course){

	$file = null;
	$sql = "select fullname, shortname from mdl_course where id=".$course;
	$result = mysql_query($sql,$conn);
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$file = "links-".$row['shortname'].".html";
		$fh = fopen($file, 'w') or die("can't open file");
		fwrite($fh, "<h1>".$row['fullname']."</h1>");
	}
	fwrite($fh, "<h2>Pages with 'Ethiopia' refs</h2>");
	fwrite($fh, "<ol>");
	$sql = "select cm.id, p.name from mdl_page p inner join mdl_course_modules cm On cm.instance = p.id  where  
			p.content like '%Ethiopia%' AND p.course =".$course;
	$result = mysql_query($sql,$conn);
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		fwrite($fh, "<li><a target='_blank' href='");
		fwrite($fh, $link.$row['id']."'>");
		fwrite($fh, $row['name']);
		fwrite($fh, "</a></li>");
	}
	fwrite($fh, "</ol>");

	/*fwrite($fh, "<h2>Pages with 'Federal' refs</h2>");
	fwrite($fh, "<ol>");
	$sql = "select cm.id, p.name from mdl_page p inner join mdl_course_modules cm On cm.instance = p.id  where  
			p.content like '%Federal%'  AND p.course =".$course;
	$result = mysql_query($sql,$conn);
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		fwrite($fh, "<li><a target='_blank' href='");
		fwrite($fh, $link.$row['id']."'>");
		fwrite($fh, $row['name']);
		fwrite($fh, "</a></li>");
	}
	fwrite($fh, "</ol>");

	fwrite($fh, "<h2>Pages with 'health extension' refs</h2>");
	fwrite($fh, "<ol>");
	$sql = "select cm.id, p.name from mdl_page p inner join mdl_course_modules cm On cm.instance = p.id  where  
			p.content like '%health extension%' AND p.course =".$course;
	$result = mysql_query($sql,$conn);
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		fwrite($fh, "<li><a target='_blank' href='");
		fwrite($fh, $link.$row['id']."'>");
		fwrite($fh, $row['name']);
		fwrite($fh, "</a></li>");
	}
	fwrite($fh, "</ol>");

	fwrite($fh, "<h2>Pages with 'woreda' refs</h2>");
	fwrite($fh, "<ol>");
	$sql = "select cm.id, p.name from mdl_page p inner join mdl_course_modules cm On cm.instance = p.id  where  
			p.content like '%woreda%' AND p.course =".$course;
	$result = mysql_query($sql,$conn);
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		fwrite($fh, "<li><a target='_blank' href='");
		fwrite($fh, $link.$row['id']."'>");
		fwrite($fh, $row['name']);
		fwrite($fh, "</a></li>");
	}
	fwrite($fh, "</ol>");


	fwrite($fh, "<h2>Pages with 'kebele' refs</h2>");
	fwrite($fh, "<ol>");
	$sql = "select cm.id, p.name from mdl_page p inner join mdl_course_modules cm On cm.instance = p.id  where  
			p.content like '%kebele%' AND p.course =".$course;
	$result = mysql_query($sql,$conn);
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		fwrite($fh, "<li><a target='_blank' href='");
		fwrite($fh, $link.$row['id']."'>");
		fwrite($fh, $row['name']);
		fwrite($fh, "</a></li>");
	}
	fwrite($fh, "</ol>");

	fwrite($fh, "<h2>Pages with 'health centre' refs</h2>");
	fwrite($fh, "<ol>");
	$sql = "select cm.id, p.name from mdl_page p inner join mdl_course_modules cm On cm.instance = p.id  where  
			p.content like '%health centre%' AND p.course =".$course;
	$result = mysql_query($sql,$conn);
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		fwrite($fh, "<li><a target='_blank' href='");
		fwrite($fh, $link.$row['id']."'>");
		fwrite($fh, $row['name']);
		fwrite($fh, "</a></li>");
	}
	fwrite($fh, "</ol>");

	fwrite($fh, "<h2>Pages with 'health center' refs</h2>");
	fwrite($fh, "<ol>");
	$sql = "select cm.id, p.name from mdl_page p inner join mdl_course_modules cm On cm.instance = p.id  where  
			p.content like '%health center%' AND p.course =".$course;
	$result = mysql_query($sql,$conn);
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		fwrite($fh, "<li><a target='_blank' href='");
		fwrite($fh, $link.$row['id']."'>");
		fwrite($fh, $row['name']);
		fwrite($fh, "</a></li>");
	}
	fwrite($fh, "</ol>");

	fwrite($fh, "<h2>Pages with 'health post' refs</h2>");
	fwrite($fh, "<ol>");
	$sql = "select cm.id, p.name from mdl_page p inner join mdl_course_modules cm On cm.instance = p.id  where  
			p.content like '%health post%' AND p.course =".$course;
	$result = mysql_query($sql,$conn);
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		fwrite($fh, "<li><a target='_blank' href='");
		fwrite($fh, $link.$row['id']."'>");
		fwrite($fh, $row['name']);
		fwrite($fh, "</a></li>");
	}
	fwrite($fh, "</ol>");	
	
	fwrite($fh, "<h2>Pages with 'health worker' refs</h2>");
	fwrite($fh, "<ol>");
	$sql = "select cm.id, p.name from mdl_page p inner join mdl_course_modules cm On cm.instance = p.id  where  
			p.content like '%health worker%' AND p.course =".$course;
	$result = mysql_query($sql,$conn);
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		fwrite($fh, "<li><a target='_blank' href='");
		fwrite($fh, $link.$row['id']."'>");
		fwrite($fh, $row['name']);
		fwrite($fh, "</a></li>");
	}
	fwrite($fh, "</ol>");

	fwrite($fh, "<h2>Pages with Table X/Box X/Figure X</h2>");
	fwrite($fh, "<ol>");
	$sql = "SELECT cm.id, p.name FROM mdl_page p inner join mdl_course_modules cm On cm.instance = p.id 
		WHERE ( p.content REGEXP '\\(Table [0-9]+.\\)' = 1 
		OR p.content REGEXP '\\(Box [0-9]+.\\)' = 1 
		OR p.content REGEXP '\\(Figure [0-9]+.\\)' = 1 
		OR p.content REGEXP '\\(Activity [0-9]+.\\)' = 1 
		) AND p.course=".$course;
	$result = mysql_query($sql,$conn);

	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		fwrite($fh, "<li><a target='_blank' href='");
		fwrite($fh, $link.$row['id']."'>");
		fwrite($fh, $row['name']);
		fwrite($fh, "</a></li>");
	}
	fwrite($fh, "</ol>");

	fwrite($fh, "<h2>Pages with 'you studied'/Module X</h2>");
	fwrite($fh, "<ol>");
	$sql = "SELECT cm.id, p.name FROM mdl_page p inner join mdl_course_modules cm On cm.instance = p.id 
		WHERE ( p.content like '%you studied%'
		OR p.content LIKE '%Module%'
		OR p.content like '%you have studied%'
		OR p.content like '%you have already studied%'
		) AND p.course=".$course;
	$result = mysql_query($sql,$conn);
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		fwrite($fh, "<li><a target='_blank' href='");
		fwrite($fh, $link.$row['id']."'>");
		fwrite($fh, $row['name']);
		fwrite($fh, "</a></li>");
	}
	fwrite($fh, "</ol>");*/

	fclose($fh);

	echo "Created editing links for: ".$course."<br/>";
}
// db disconnect
mysql_close($conn);
