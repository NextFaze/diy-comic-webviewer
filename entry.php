<?php include("include.php"); 
	$TITLE = "Entry";
?>



<?php	 
	$result = $FLICKR->collections_getTree(0,$FLICKR_USER);
	$collections = $result['collections']['collection'];
	$challengeID = $_GET['chalid'];
	$entryID = $_GET['entryid'];

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
		}
	}
	
	// Find Current Entry
	$currentEntry = null;
	foreach ($entries as $entry) {
		if($entry['id']==$entryID) {
			$currentEntry = $entry;
		}
	}
		
	$description = splitDescription($currentEntry['description']);
	$details = splitDetails($description);
	$heading = splitEntryTitle($currentEntry['title']);
	
	$TITLE = " -> <a href='index.php'>Challenge</a> -> <a href='challenge.php?chalid=".$challengeID."'>".$challenge['title']."</a> -> ".$heading['title'];
	
?>
<?php include("header.php") ?>

<?php	

	// Show comic details
	echo "<div class=\"tableCell\">".
	"<img class='tableImage' src='".$details['THUMB']."'>".
	"<div class='tableUser'>By: ".$heading['user']."</div>".
	getDescription($description)."<br/>".
	"</div>";

	// Show the comic slides
	$set = $FLICKR->photosets_getPhotos($entryID,"url_o");
	$slides = $set['photoset']['photo'];
	
	echo "<div class='imageBlock'>";
	
	$i = 0;	
	foreach ($slides as $slide) {
		echo "<img class='slideImage' src='".$slide['url_o']."'>";	
		//if ($i%1==0) echo "<br/>";
		$i++;
	}
	
	echo "</div></div>";
?>


<?php include("footer.php") ?>