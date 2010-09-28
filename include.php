<?php
//include("phpflickr/auth.php");
//include("phpflickr/example.php");
//include("phpflickr/getToken.php");
include("phpflickr/phpFlickr.php");

$FLICKR_KEY           = "SET_VALUE";
$FLICKR_SHARED_SECRET = "SET_VALUE";
$FLICKR_AUTH_TOKEN    = "SET_VALUE";
$FLICKR_USER          = "SET_VALUE";

$FLICKR = new phpFlickr($FLICKR_KEY,$FLICKR_SHARED_SECRET,true);
$FLICKR->enableCache("fs","cache");

function splitDescription($details) {
	return explode("---", $details);
}

function getDescription($split) {
	return $split[0];
}

function splitDetails($details) {
	$result = null;
	$split = explode(";", $details[1]);
	foreach ($split as $part) {
		$components = explode(":", $part, 2);
		if (count($components)>1) {
			$result[trim($components[0])] = trim($components[1]);
		}
	}
	
	return $result;
}

function splitEntryTitle($title) {
	$result = null;
	$split = explode("::",$title);
	$result['title'] = $split[0];
	$result['user'] = $split[1];
	return $result;
}

function splitLocation($details) {
	$details = str_replace(array("(",")"), "", $details);
	$split = explode(",",$details);
	$result['lat']=$split[0];
	$result['lon']=$split[1];
	$result['range']=$split[2];
	return $result;
}


?>
