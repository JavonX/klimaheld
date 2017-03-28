
  

   <body vocab="http://schema.org/"  <?php //Vocab definition für RDFaTags ?>
    <?php 
        //Automatisches ID-Klasse generieren, mit Seitenname 
        $name = $page->name;
        $name = str_replace("-", "_", $name); //- mit _ ersetzen wegen Namenskonvention im CSS
        echo " id='site_$name'"; 
         
        //Verwendetes Template 
        $template = $page->template;
                 
        $template = substr($template, 4); //die ersten 4 Zeichen weg, damit die Klasse Porjektübergreifend einfacher verwendbar ist
                 
        $template = str_replace("-", "_", $template); //- mit : ergänzen für korrekte CSS-Konvetion
        echo " class='template_$template'";
    ?>
    
    > <?php //<= Abschusss Bodytag-Start ?>
   
   <?php
       if( $device === "IE9"){ 
            echo "<div class='old_browser'>
                <p class='old_browser_text'><b>Geschätzter Besucher, Sie verwenden eine veraltete Version von Internet Explorer.</b><br>Mit dieser Version kann diese Webseite nicht korrekt dargestellt werden. Bitte installieren Sie die aktuellste Version: Internet Explorer 11 (benötigt Windows 7).<br>Sie können das Programm direkt von der Microsoft-Webseite herunterladen und installieren:<br>
                <a target='_blank' href='https://www.microsoft.com/de-ch/download/internet-explorer-11-for-windows-7-details.aspx'>https://www.microsoft.com/de-ch/download/internet-explorer-11-for-windows-7-details.aspx</a>
                </p>
               </div>
               ";
       }
   ?>


  
    <!--HEADER -->
    <header id="header_main" class="menu_fixed shadow_header" >
        <div  class=" row col">
           <div id="header_content" class="flex">
             
            <!-- LOGO -->
               <div id="logo" typeof="Organization">
                   <a property="url" href="<?php echo $pages->get(1)->url ?>" >
                       <img  property="logo" src="<?php echo $daten->single_image->first->url; ?>" alt="<?php echo $daten->single_image->first->description; ?>">
                   </a>
               </div>
                
              
           <!-- MAINMENU -->           
           <!-- Toggle Buttom for mobil-->
           <a class="toggleMenu active" href="">
               <img src="<?php echo $daten->images_global->eq(1)->url ?>" width="100%" height="100%"/>
           </a>
           
           <!-- Menu -->
           <nav id="menu" class="flex"> 
			   <?php 
			   // MAINMENU GENERIEREN
			   //====================
			   include_once("./_mainmenu-generate.php"); ?>
      	   </nav>
       
        </div>
      </div> <?php //Ende DIV row-class ?>
    </header>
        <div class="page_width row col">