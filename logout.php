<?php

	
	//get page id from input
	//link kommt mit GET-parameter &redirect= und der ID der Seite von der der User kommt
	$redirectId = $sanitizer->name(wire('input')->get->redirect);
	//get page from page-id
	$redirectSite = $pages->get($redirectId);

	if($user->isLoggedin()) {
		$session->logout();
		
		//Wenn die vorherige Seite nicht eine Profilseite war, dorthin weiterleiten, sonst zur Startseite
		// Parent aller Profilseiten: benutzer-menu mit ID = 1084
		if($redirectSite->parent()->id != 1084) {
			$session->redirect($redirectSite->url);
		}
		else {
			$session->redirect($pages->get(1)->url);
		}
	}
	else {
		$session->redirect($pages->get(1030)->url); //1030 = Anmeldenseite
	}


?>
