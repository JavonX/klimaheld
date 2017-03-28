
<main>
<h2> Profilpage</h2>


<?php
	debuger($page);
	
if($user->isLoggedin()) {
	echo "debug eingelogged <br>";

	//debuger($page);
	echo _x("     Benutzername: ", "Label") . $user->name;
}
else {
	$session->redirect($pages->get(1030)->url); //1030 = Anmeldenseite
}
	
	
?>	
</main>	