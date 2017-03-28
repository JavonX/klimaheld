<!doctype html>


<html
    <?php 
      
        //prefix=og: Für Open Graph Tags
        echo " prefix='og: http://ogp.me/ns#' ";

        //apple-Klasse: Fix für Geräte die nicht Flex-Column richtig anwenden für Footer der bis zum Screenboden geht. Verwendet $device aus _func.php 
        //Detect special conditions devices
        if( $device === "iphone" or $device === "ipad" ){
            echo "class='apple' "; 
        } 
        elseif ($device != "") {
            echo "class='$device' ";
        }
        
    ?>
    
    lang="de-ch>" >

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta lang="de-ch"/>
    <title><?php if($page->headline) { echo $page->headline; } else { echo $page->title; } ?>
    </title>
    
    <?php	
	// handle output of 'hreflang' link tags for multi-language
	// this is good to do for SEO in helping search engines understand
	// what languages your site is presented in	
	foreach($languages as $language) {
		// if this page is not viewable in the language, skip it
		if(!$page->viewable($language)) continue;
		// get the http URL for this page in the given language
		$url = $page->localHttpUrl($language); 
		// hreflang code for language uses language name from homepage
		$hreflang = $homepage->getLanguageValue($language, 'name'); 
		// output the <link> tag: note that this assumes your language names are the same as required by hreflang. 
		echo "\n\t<link rel='alternate' hreflang='$hreflang' href='$url' />";
	}	
	?>
    
    <?php 
         //Seiten die nicht in den Suchmaschienen aufgeführt werden sollen. Besser als in robots.txt, dort kann es jeder nachlesen
         if($page->isHidden() and $page->id!=1){
           echo "<meta name='robots' content='noindex, nofollow'>
                 <meta name='google' content='notranslate'>";
         }
             
         //Author der Seite  
         if($page->meta_author)
            echo "<meta name='author' content='$page->meta_author'>";
        elseif($daten->meta_author)   
            echo "<meta name='author' content='$daten->meta_author'>"; 
          
        //Beschreibung/Zusammenfassung der Seite     
         if($page->meta_description)
            echo "<meta name='description' content='$page->meta_description'>";
        elseif($daten->meta_description)   
            echo "<meta name='description' content='$daten->meta_description'>";    
             
             
        // OPEN GRAPH TAGS (unter anderem für Facebook) 
        //Beschreibung     
        if($page->meta_description)
            echo "<meta property='og:description' content='$page->meta_description'>";
        elseif($daten->description)   
            echo "<meta name='og:description' content='$daten->meta_description'>";
              
        //Seitenname     
        if($daten->meta_site_name)
            echo "<meta property='og:site_name' content='$daten->meta_site_name'>";
             
         //Titel der einzelnen Seite     
        if($page->meta_title)
            echo "<meta property='og:title' content='$page->meta_title'>";
        else  
            echo "<meta property='og:title' content='$page->title'>";      
             
        //Vorschaubild
        if(count($page->meta_image)) 
           echo "<meta property='og:image' content='{$page->meta_image->eq(0)->httpUrl}'>";  
    ?>

    <link rel="stylesheet" href="<?php echo $config->urls->templates?>styles/css/main.css">
    <script src="<?php echo $config->urls->templates?>scripts/jquery-3.1.1.min.js"></script>  
    
    <!-- Favicons -->
    <link rel="icon" type="image/png" href="<?php echo $daten->images->eq(0)->url; ?>">
  <!--  <link rel="icon" type="mask-png" href="<?php echo $daten->images->eq(1)->url; ?>" color="#3F3F91"> -->
    <link rel="icon" type="image/svg+xml" href="<?php echo $daten->images->eq(2)->url; ?>">
           
</head>

 