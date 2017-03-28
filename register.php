<main>
<h1>Registrierung</h1>
<?php

$out = '';

// create a new form field (also field wrapper)
$form = $modules->get("InputfieldForm");
$form->action = "./";
$form->method = "post";
$form->attr("id+name",'subscribe-form');

// create a text input
$field = $modules->get("InputfieldText");
$field->label = _x("Name", "Name Label");
$field->attr('id+name','name');
$field->required = 1;
$form->append($field); // append the field to the form

// create email field
$field = $modules->get("InputfieldEmail");
$field->label = _x("E-Mail", "Email Label");
$field->attr('id+name','email');
$field->required = 1;
$form->append($field); // append the field

// you get the idea
$field = $modules->get("InputfieldPassword");
$field->label = _x("Passwort", "Password Label");
$field->attr("id+name","pass");
$field->required = 1;
$form->append($field);

// oh a submit button!
$submit = $modules->get("InputfieldSubmit");
$submit->attr("value", _x("Senden", "Subscribe-Button"));
$form->append($submit);

// form was submitted so we process the form
if($input->post->submit) {

    // user submitted the form, process it and check for errors
    $form->processInput($input->post);

    // here is a good point for extra/custom validation and manipulate fields
	$name = $sanitizer->text($form->get("name")->value);
	$errorMessageName = _x("Dieser Benutzername ist bereits vergeben. Wählen Sie einen anderen", "Register Dialog. Error Username is taken");		    
	$nameCheck = $users->get("name=$name");
	echo "bereits exisiterender user: " . $nameCheck . "<br><br>";
    if($nameCheck instanceof NullPage OR $nameCheck === null) {
		echo "name ok <br>";
    }	
	else {
		$form->get("name")->error("fehler name");
	}
		
                             
    $email = $sanitizer->email($form->get("email")->value);    
	$errorMessageEmail = _x("Diese E-Mail-Adresse ist bereits belegt. Wählen Sie eine andere", "Register Dialog. Error E-Mail is taken");						   
		$emailCheck = $users->get("email=$email");
    if($emailCheck instanceof NullPage OR $emailCheck === null) {
		echo "email ok <br>";
    }	
	else {
		$form->get("email")->error($errorMessageEmail);
	}
	
	
    $password = $sanitizer->text($form->get("pass")->value);
	

    if($form->getErrors()) {
        // the form is processed and populated
        // but contains errors
        $out .= $form->render();
    } else {
        $new_user = new User();
        $new_user->of(false);
        $new_user->name = $name;
        $new_user->email = $email;
        $new_user->pass = $password;
        $new_user->addRole("guest");
        $new_user->addRole("member");
		//$new_user->date_created = time();
        $new_user->save();
        $new_user->of(true);
        
		$out .= "<div class='register_success_notification'>";
        $out .= "<h3>" . _x("Vielen Dank! Deine Anmeldung war erfolgreich.", "Success-Notification after Registration") . "</h3>";
		$out .= "<p>"  . _x("Eine E-Mail mit dem Aktivierungs-Link wurde an die angegebene E-Mailadresse gesendet. Klicke auf den Link in der E-Mail um Dein Konto zu aktivieren." , "Instructions for automatic E-Mail") . "</p>";
		$out .= "</div>";

    }
} else {
    // render out form without processing
    $out .= $form->render();
}

echo $out;

?>
</main>