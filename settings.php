<?php 

$DB = new stdClass();
$DB->DBNAME = "moodle"; // moodle database name
$DB->DBUSER = "moodleuser"; // moodle database username
$DB->DBPASS = "password"; // moodle database password
		

$ADAPT = new stdClass();
$ADAPT->COURSES = array(1,2,3); // array of the Moodle course ids to apply the scripts to
$ADAPT->EXT_LINK = "http://<my.moodle.url>/mod/page/view.php?id="; // url to your Moodle site

