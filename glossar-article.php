<!-- MAIN PART -->

<main>
<?php 
    echo "<h1 class='bracket align_center'>$page->title</h1>";
    echo $page->body;
	echo "<br><br>";
	foreach($page->images as $image) {
		echo "<img src='$image->url' alt='$image->description'><br>";
	}
	
	echo "<p>Tags: ";
	$tags = $page->tag_select;	
	//echo "<br><br>Printf: <br>";	
	//printf($tags);
	//echo "<br><br>";	
	//echo "<br><br>Vardump: <br>";	
	//var_dump($tags);
	//echo "<br><br>";	
	
	$tagString = "";
	foreach($tags as $tag) {		
		$tagString .= $tag->title . ", ";
	}
	//Leerzeichen und Komma ab Schluss entfernen
	//substr($tagString, 0, -2);
	
	echo $tagString;
  ?>
</main>
