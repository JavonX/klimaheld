<?php


//GERÄTE ERKENNEN BEIM LADEND
//////////////////////////////////////////////////

$device = '';
$userAgent = $_SERVER['HTTP_USER_AGENT'];

if( stristr($userAgent,'ipad') ) {
    $device = "ipad";
} else if( stristr($userAgent,'iphone') ) {
    $device = "iphone";
} else if( stristr($userAgent,'blackberry') ) {
    $device = "blackberry";
} else if( stristr($userAgent,'android') ) {
    $device = "android";
} else if( stristr($userAgent,'edge') ) {
    $device = "edge";
} else  {
    //CHECKEN OB ES IE IST und welche Version, mit Hilfe von RexEx
    preg_match('/MSIE (.*?);/', $userAgent, $matches);

    if(count($matches)<2) {
      preg_match('/Trident\/\d{1,2}.\d{1,2}; rv:([0-9]*)/', $userAgent, $matches);
    }

    if (count($matches)>1){
        $device = "IE";
        $version = $matches[1];

        switch(true) {
            case ($version<=9):
              $device .= "9";
                break;

            case ($version>9):
              $device .= "10+";
                break;

            default:
                break;
        }
    }

}
	


// Variable ausgeben zum schnellen debuggen
////////////////////////////////////////////////////

function debuger ($variable, $color = NULL) {
	echo "Debug Function: <br><pre style='color:$color;'>";
	echo "gugus1";
	flush();
	ob_flush();
	print_r($variable);
	echo "gugus2";
	echo "</pre><br>";
}






//MARKUP FÜR TILES GENERIEREN UND AUSGEBEN
//////////////////////////////////////////////////

function generate_tiles ($allTiles, $tileWidthClass, $imageWidth, $noUrl) {
    
// Zu übergebende Werte
// $allTiles = Page-Array mit allen Unterseiten die angezeigt werden sollen
// $tileWidthClass = String mit der Klasse der Breite eines Tiles
// $imageWidth = String mit der Klasse für die Breite des Bildes innerhalb des Tiles

    foreach($allTiles as $tile) {
        echo "<article class='tile $tileWidthClass shadow'>" .
                 "<a class='test' href='$tile->url'>" .
                     "<div class='tile_content'>"; 
                        echo "<h2>$tile->title</h2>";
                        echo "<hr>";

                        if($tile->leadtext){  //Leadtext anzeigen falls vorhanden
                            $leadtext = $tile->leadtext;
                            $leadtext = str_replace("KMU Datacenter", "KMU&nbspDatacenter", $leadtext); //kein Zeilenumbruch zwischen KMU und Datacenter
                            echo "<h3>$leadtext</h3>";
                        }
        
                        if($noUrl == true) //falls das ganze Tile klickbar sein soll braucht es nicht noch einen IMG-Link
                            $url = "";
                        else
                            $url = $tile->url;

                        if($tile->single_image->first) {  //Vorschaubild anzeigen falls vorhanden
                          
                            $imgDaten = [
                                "breite" => "350",      //gewünschte Breite des Bildes in Pixel
                                "klassen" => "$imageWidth align_center lazyload", //css-klassen für das Bild
                                "url" => $url,    //Ziel-url wenn man auf das Bild klickt
                            ];

                            $optionen =["quality" => 85, "upscaling" => false, "cropping" => false,];

                            $srcsetMarkup = scrset_werte($tile->single_image->first, $imgDaten, $optionen); //Markup des Bildes generieren   
                            echo $srcsetMarkup;  
                          }
                     echo "</div>
                    </a>
                </article>";
    }
}




//MARKUP FÜR SRCSET GENERIEREN
//////////////////////////////////////////////////

function scrset_werte($img, $imgDaten, $optionen) {
    
// $img = einzelnes Bild
// $xWerte: Die srcset-Werte aus der Funktion "function scrset_werte"
// $imgDaten =  Array mit Werten für die Verarbeitung:
//              "breite"    => "",   //gewünschte Breite des Bildes in Pixel
//              "klassen"   => "",   //css-klassen für das Bild
//              "url"       => "",   //ziel-url wenn man aufs Bild klickt. leer = kein Link
// $optionen: Parameter für die automatische Generierung des Bildes durch processwire 
    
    
    
    //BILD BREIT GENUG FÜR X-SRCSET-ATTRIBUT?
    
    $breite = $imgDaten["breite"];
    
    $maxBreite = $img->width; //maximale Breite des Bildes
    $x1 = $breite;
    $x2 = 0; // 0 damit es nicht undefined ist
    $x3 = 0;

    if (1 < $maxBreite/$breite && $maxBreite/$breite <= 2) {
        $x2 = $breite*2;
    }

    if (2 < $maxBreite/$breite) {
        $x2 = $breite*2;
        $x3 = $breite*3;                
    } 
    
    $xWerte = [
                "x1" => $x1,
                "x2" => $x2,
                "x3" => $x3,
              ];
    
    
    
    //MARKUP ZUSAMMENSTELLEN
    
    $srcsetMarkup = "";
             
    //A-TAG FALLS VORHANDEN    
    if (array_key_exists( "url" , $imgDaten )) { //existiert der key "url" im array "$imgdaten"
        if($imgDaten["url"] != ""){
            $srcsetMarkup = "<a href='" . $imgDaten["url"] . "'> ";
        }
    }
    
    //IST ES EIN SVG?
    $dateiendung = $img->ext;
    if( $dateiendung == "svg" ) {
        $srcsetMarkup .= "<img  class='" . $imgDaten["klassen"] . "' src='" . $img->url . "' ";
    }
    
    
    else //DANN IST ES EIN PIXELBILD
    {    
        $srcsetMarkup .= "<img  class='" . $imgDaten["klassen"] . "' src='" . $img->url; 
        
        if($xWerte["x2"] == 0 && $xWerte["x3"] == 0) {
            $srcsetMarkup .= "' srcset='" . $img->size($xWerte["x1"], 0, $optionen)->url . " 1x' "; 
        }
        
        //gibt es nur 2x, kein 3x?    
        elseif($xWerte["x2"] != 0 && $xWerte["x3"] == 0) {
            $srcsetMarkup .= "' srcset='" . $img->size($xWerte["x1"], 0, $optionen)->url . " 1x, " . $img->size($xWerte["x2"], 0, $optionen)->url . " 2x' ";
        }
        
        //es gibt 2x und 3x?
        elseif( $xWerte["x2"] != 0 && $xWerte["x3"] != 0 ) {
            $srcsetMarkup .= "' srcset='" . $img->size($xWerte["x1"], 0, $optionen)->url . " 1x, " . $img->size($xWerte["x2"], 0, $optionen)->url . " 2x, " . $img->size($xWerte["x3"], 0, $optionen)->url . " 3x' ";
        }
    }

    
    //ALT-TEXT DES BILDES und IMG-Tag abschluss
    if($img->description != "") {
        $srcsetMarkup .= "alt='" . $img->description . "'/>";
    }
    else
    {
        $srcsetMarkup .= "/>";
    }
    
    
    //A-TAG ABSCHLUSS falls nötig
    if (array_key_exists( "url" , $imgDaten )) {
        if($imgDaten["url"] != "")
            {
                $srcsetMarkup .= "</a>";
            }
    }
    return $srcsetMarkup;
}








/**
 * Given a group of pages, render a simple <ul> navigation
 *
 * This is here to demonstrate an example of a simple shared function.
 * Usage is completely optional.
 *
 * @param PageArray $items
 * @return string
 *
 */
function renderNav(PageArray $items) {

	// $out is where we store the markup we are creating in this function
	$out = '';

	// cycle through all the items
	foreach($items as $item) {

		// render markup for each navigation item as an <li>
		if($item->id == wire('page')->id) {
			// if current item is the same as the page being viewed, add a "current" class to it
			$out .= "<li class='current'>";
		} else {
			// otherwise just a regular list item
			$out .= "<li>";
		}

		// markup for the link
		$out .= "<a href='$item->url'>$item->title</a> ";

		// if the item has summary text, include that too
		if($item->summary) $out .= "<div class='summary'>$item->summary</div>";

		// close the list item
		$out .= "</li>";
	}

	// if output was generated above, wrap it in a <ul>
	if($out) $out = "<ul class='nav'>$out</ul>\n";

	// return the markup we generated above
	return $out;
}



/**
 * Given a group of pages, render a <ul> navigation tree
 *
 * This is here to demonstrate an example of a more intermediate level
 * shared function and usage is completely optional. This is very similar to
 * the renderNav() function above except that it can output more than one
 * level of navigation (recursively) and can include other fields in the output.
 *
 * @param array|PageArray $items
 * @param int $maxDepth How many levels of navigation below current should it go?
 * @param string $fieldNames Any extra field names to display (separate multiple fields with a space)
 * @param string $class CSS class name for containing <ul>
 * @return string
 *
 */
function renderNavTree($items, $maxDepth = 0, $fieldNames = '', $class = 'nav') {

	// if we were given a single Page rather than a group of them, we'll pretend they
	// gave us a group of them (a group/array of 1)
	if($items instanceof Page) $items = array($items);

	// $out is where we store the markup we are creating in this function
	$out = '';

	// cycle through all the items
	foreach($items as $item) {

		// markup for the list item...
		// if current item is the same as the page being viewed, add a "current" class to it
		$out .= $item->id == wire('page')->id ? "<li class='current'>" : "<li>";

		// markup for the link
		$out .= "<a href='$item->url'>$item->title</a>";

		// if there are extra field names specified, render markup for each one in a <div>
		// having a class name the same as the field name
		if($fieldNames) foreach(explode(' ', $fieldNames) as $fieldName) {
			$value = $item->get($fieldName);
			if($value) $out .= " <div class='$fieldName'>$value</div>";
		}

		// if the item has children and we're allowed to output tree navigation (maxDepth)
		// then call this same function again for the item's children 
		if($item->hasChildren() && $maxDepth) {
			if($class == 'nav') $class = 'nav nav-tree';
			$out .= renderNavTree($item->children, $maxDepth-1, $fieldNames, $class);
		}

		// close the list item
		$out .= "</li>";
	}

	// if output was generated above, wrap it in a <ul>
	if($out) $out = "<ul class='$class'>$out</ul>\n";

	// return the markup we generated above
	return $out;
}

?>