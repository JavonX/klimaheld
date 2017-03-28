<!-- MAIN PART -->
 
<main class="">
    <h1 class="bracket align_center"><?php echo $page->title ?></h1>   
   
    <?php 
		echo "<section>";
		if($page->body) {
			echo $page->body . "<br><br>";
		}

		$unterseiten = $page->children("include=hidden");

		echo "<div class='row'>";

		foreach ($unterseiten as $unterseite) {
			echo "<h3 class='g_4-12 col'><a href='$unterseite->url'>$unterseite->title</a></h3>";  
		}
		echo "</div>";
		echo "</section>";
        
    ?>
</main> 
