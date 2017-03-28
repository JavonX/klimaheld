<?php
                               
	$mainMenu = $modules->get("MarkupSimpleNavigation");

	/* SETUP HOOKs -------------
	// hook to have custom items markup 
	$nav->addHookAfter('getTagsString', null, 'customNavItems');
	function customNavItems(HookEvent $event){
		$item = $event->arguments('page');

		// first level items need additional attr
		if($item->numChildren(true) && count($item->parents) < 2){
			$title = $item->get("title|name");
			$event->return = '<a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $title . ' <b class="caret"></b></a>';
		}

		// submenus don't need class and data attribs
		if($item->numChildren(true) && count($item->parents) > 1){
			$event->return = '<a href="#">' . $item->get("title|name") . '</a>';
		}
	} */

	// hook to add custom class to li's that have submenu
	$mainMenu->addHookAfter('getListClass', null, 'customListClass');
	function customListClass(HookEvent $event){
		$item = $event->arguments('page');

	  /* if current list item has children and is level 2 from root
		if($item->numChildren(true) && count($item->parents) > 1){
			$event->return = ' dropdown-submenu'; // adds class to li
		}  */

		 // if current list item is level 1 from root
		if(count($item->parents) == 1){
			$event->return .= ' nav_item'; // add class to li
		}
	}



	//PRORFIL-MENU Generieren
	/////////////////////////////////////////////////////////////////
	$menuProfil = "<!--PROFIL-MENU-->";

	$linkToNotifications = "#";
	$linkToProfil =        $pages->get(1082)->url;
	$linkToSettings = 	   "#";
	$linkToBackend = 	   $config->urls->admin;
	$linkToLogout =        $pages->get(1083)->url . "?redirect={$page->id}";			//"{$config->urls->admin}login/logout/"; //$session->logout();


	//Wenn Benutzer angemeldet ist
	if($user->isLoggedin()) {

		$menuProfil .= "<li class='level_1 has_children nav_item'><a href='#'>$user->name</a>";
		$menuProfil .= "<ul class='profil_menu sub_nav'>";
		$menuProfil .= "<li class='level_2'><a href='$linkToNotifications'>" . _x("Meldungen", "Notification-Link") . "</a></li>";
		$menuProfil .= "<li class='level_2'><a href='$linkToProfil'>" . _x("Profil", "Profil-Link") . "</a></li>";
		$menuProfil .= "<li class='level_2'><a href='$linkToSettings'>" . _x("Einstellungen", "Settings-Link") . "</a></li>";
		
		//Backend Link anzeigen wenn User die Rechte hat
		if($user->hasRole("superuser") OR $user->hasRole("manager")) {
			$menuProfil .= "<li class='level_2'><a href='$linkToBackend'>" . _x("Backend", "Backend-Link") . "</a></li>";
		}

		$menuProfil .= "<li class='level_2'><a href='$linkToLogout'>" . _x("Abmelden", "Logout-Link") . "</a></li>";
		//Abschluss der Liste
		$menuProfil .= "</ul></li>";
	}
	else {
		// 1030 = ID der Anmelden-Seite, _x() für Mehrsprachenunterstützung
		$menuProfil .= "<li class='nav_item level_1'><a href='{$pages->get(1030)->url}'>" . _x("Anmelden", "Login-Link") . "</a></li>"; 
	}	


 	//LANGUAGE-MENU Generieren
	/////////////////////////////////////////////////////////////////
	$menuLanguage = "<!--LANGUAGE-MENU-->";

	$menuLanguage .= "<li class='level_1 has_children nav_item'><a href=''>{$user->language->title}</a><ul class='language_menu sub_nav'>";
           
            foreach($languages as $language) {
                if(!$page->viewable($language)) continue; // is page viewable in this language?
                if($language->id == $user->language->id) {
                    $menuLanguage .= "<li class='current'>";
                } else {
                    $menuLanguage .= "<li>";
                }
                $url = $page->localUrl($language); 
                $hreflang = $homepage->getLanguageValue($language, 'name'); 
                $menuLanguage .= "<a hreflang='$hreflang' href='$url'>$language->title</a></li>";
            }
          
           $menuLanguage .= "</ul></li>";





	//Outer Template für RENDER MENU erstellen
	$otp = 	"<ul class='nav_menu'>|| $menuLanguage $menuProfil </ul>";	

	/* RENDER MENU ------------- */
	$options = [
	'max_levels' => 4,
	'current_class' => 'current',
	'has_children_class' => 'has_children',        // all li's that have children
	'levels' => true,
	'levels_prefix' => 'level_',
	'outer_tpl' => $otp, // custom class
	'inner_tpl' => '<ul class="sub_nav">|| </ul>',  // custom class for all submenu will get hooked for dropdown-submenu
	//'list_tpl' => '<li class="test">||</li>',
	'list_field_class' => '',
	'item_tpl' => '<a href="{url}">{title}</a>',
	'item_current_tpl' => '<a href="{url}">{title}</a>',
	'debug' => false,
	];    
	print $mainMenu->render($options);


?>
  