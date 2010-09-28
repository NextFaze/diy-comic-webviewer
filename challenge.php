<?php include("include.php"); 
	$TITLE = "Challenge";
?>



<?php	 
	$result = $FLICKR->collections_getTree(0,$FLICKR_USER);
	$collections = $result['collections']['collection'];
	$challengeID = $_GET['chalid'];

	// Find the challenges list
	$challenges = null;
	foreach ($collections as $collection) {
		if($collection['title']=='CHALLENGES') {
			$challenges = $collection['collection'];
		} 
	}
	
	// Find the current challenge
	$entries = null;
	$currentChallenge = null;
	foreach ($challenges as $challenge) {
		if($challenge['id']==$challengeID) {
			$entries = $challenge['set'];
			$currentChallenge = $challenge;
			$TITLE = " -> <a href='index.php'>Challenge</a> -> ".$challenge['title'];
		}
	}
	
?>
<?php include("header.php") ?>

<div class='tableCell'>
<?php
	$description = splitDescription($currentChallenge['description']);
	echo getDescription($description);
	$details = splitDetails($description);
	if(array_key_exists("START", $details)) echo "<br/><br/><div class='smallText'><b>Start:</b> ".$details['START']."</div>";
	if(array_key_exists("END", $details)) echo "<div class='smallText'><b>End:</b> ".$details['END']."</div>";
	if(array_key_exists("LOCATION", $details)) {
		$location = splitLocation($details['LOCATION']);
		echo "<div class='smallText'><b>Location:</b> <a href='http://maps.google.com/maps?q=".$location["lat"].",".$location["lon"].
		"'>Latitude: ".$location['lat'].", Longitude: ".$location['lon'].", Range: ".$location['range']."m</div>";
	}
?>
</div>
<?php	
	// Show the entries
	foreach ($entries as $entry) {
		$description = splitDescription($entry['description']);
		$details = splitDetails($description);
		$heading = splitEntryTitle($entry['title']);
		

		echo "<div class=\"tableCell\">".
		"<img class='tableImage' src='".$details['THUMB']."'>".
		"<div class='tableText'><a href='entry.php?chalid=".$currentChallenge['id']."&entryid=".$entry['id']."'>".$heading['title']."</a><br/>".
		"<div class='tableUser'>By: ".$heading['user']."</div>".
		getDescription($description)."<br/>".
		"</div></div>";
	}
?>


<?php include("footer.php") ?>