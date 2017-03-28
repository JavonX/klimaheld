<main class="">
<h1 class="bracket align_center"><?php echo $page->title ?></h1>

   <?php
    if($page->body)
        echo $page->body;

    $referenzlogos = $page->images;
    ?>


    <?php 
    //ANZEIGEN DER REFERENZSEITE wenn ID stimmt

    if($page->id == "1056") {
    echo "<section class='flex referenzen row'>";

            foreach ($referenzlogos as $logo) {
            echo "
                <div class='g_4-12 col'>";

                    //BERECHNEN UND AUSGABE SRC-SET ATTRIBUTE
                        $url = "";
                        $imgDaten = [
                            "breite" => "350",      //gewünschte Breite des Bildes in Pixel
                            "klassen" => "colorbox lazyload einzelreferenz", //css-klassen für das Bild
                            "url" => $url,    //Ziel-url wenn man auf das Bild klickt, leer lassen wenn kein Link
                        ];

                        $optionen =["quality" => 85, "upscaling" => false, "cropping" => false,];

                        $srcsetMarkup = scrset_werte($logo, $imgDaten, $optionen); //Markup des Bildes generieren   
                        echo $srcsetMarkup;  

               echo "</div>";
            }
            echo "</section>";
        }
      ?>





</main>
