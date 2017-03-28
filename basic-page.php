<!-- MAIN PART -->

<main>
<?php 
    echo "<h1 class='bracket align_center'>$page->title</h1>";
    echo $page->body;
	echo "<br><br>";
	foreach($page->images as $image) {
		echo "<img src='$image->url' alt='$image->description'><br>";
	}
  ?>
</main>
