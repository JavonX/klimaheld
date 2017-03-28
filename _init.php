<?php

/**
 * Initialize variables output in _main.php
 *
 * Values populated to these may be changed as desired by each template file.
 * You can setup as many such variables as you'd like. 
 *
 * This file is automatically prepended to all template files as a result of:
 * $config->prependTemplateFile = '_init.php'; in /site/config.php. 
 *
 * If you want to disable this automatic inclusion for any given template, 
 * go in your admin to Setup > Templates > [some-template] and click on the 
 * "Files" tab. Check the box to "Disable automatic prepend file". 
 *
 */

// Variables for regions we will populate in _main.php. Here we also assign 
// default values for each of them.
//$title = $page->get('headline|title'); // headline if available, otherwise title
//$content = $page->body;


// We refer to our homepage a few times in our site, so we preload a copy 
// here in a $homepage variable for convenience. 
$homepage = $pages->get('/'); 



//Variable für das Porjektkürzel, dass vor vielen Namen steht um Verwechslungen zwischen verschiedenen Projekten zu vermeiden;
$prefix = "";
$daten = $pages->get(1001);   //die _daten-Seite, ID = 1001

$test= 1111111111111111119;
// Include shared functions (if any)
include_once("./_func.php");
include_once("./_head.php"); 
include_once("./_mainmenu.php"); 


// What happens after this?
// ------------------------
// 1. ProcessWire loads your page's template file (i.e. basic-page.php).
// 2. ProcessWire loads the _footer.php file (in der Original Vorlage war es _main.php)
// 
// See the README.txt file for more information.

