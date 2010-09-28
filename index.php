<?php include("include.php"); 
	$TITLE = " -> Challenges";
?>

<?php include("header.php") ?>

<?php	 
	$result = $FLICKR->collections_getTree(0,$FLICKR_USER);
	$collections = $result['collections']['collection'];

	// Find the challenges list
	$challenges = null;
	foreach ($collections as $collection) {
		if($collection['title']=='CHALLENGES') {
			$challenges = $collection['collection'];
		} 
	}
	// Show the challenges list
	foreach ($challenges as $challenge) {
		$description = splitDescription($challenge['description']);
	
		echo "<div class=\"tableCell\">".
		"<img class='tableImage' src='".$challenge['iconsmall']."'>".
		"<div class='tableText'><a href='challenge.php?chalid=".$challenge['id']."'>".$challenge['title']."</a><br/>".
		getDescription($description)."<br/>".
		"</div></div>";
	}
?>


<?php include("footer.php") ?>