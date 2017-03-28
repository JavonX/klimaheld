
<main>

<?php  
	
	if($user->isLoggedin()) {
        // automatische weiterleitung wenn der benutzer schon angemeldet ist auf seine Profilseite
        $session->redirect($pages->get(1082)->url); 
    }

	// create a new form field (also field wrapper)
	$form = $modules->get("InputfieldForm");
	$form->action = "./";
	$form->method = "post";
	$form->attr("id+name",'login_form');

	// create a text input
	$field = $modules->get("InputfieldText");
	$field->label = _x("Name", "Name Label");
	$field->attr('id+name','name');
	$field->required = 1;
	$form->append($field); // append the field to the form

	// you get the idea
	$field = $modules->get("InputfieldText");
	$field->label = _x("Passwort", "Password Label");
	$field->attr("id+name","pass");
	$field->attr("type", "password");
	$field->required = 1;
	$form->append($field);

	// oh a submit button!
	$submit = $modules->get("InputfieldSubmit");
	$submit->attr("value", _x("Anmelden", "Login-Button"));
	$form->append($submit);
	
	
	// login überprüfen bevor markup ausgegeben wird
    if($input->post->name && $input->post->pass) 
    {
        $name = $sanitizer->name($input->post->name);
        $pass = $input->post->pass; 

        if($session->login($name, $pass)) {
            // login erfolgreich => weiteleiten
            $session->redirect($config->urls->admin); 
        }
		else {
			$form->get('name')->error("Ungültiger Login");
		}
	} 

	echo $form->render();	
?>
Noch nicht angemeldet?<a href="<?php echo $pages->get(1067)->url;?>">Registrieren.</a>
</main>