<!-- MAIN PART -->
<main class="">
<?php 
    echo "<h1 class='bracket align_center'>$page->title</h1>";
    echo "<section class='members'>";

    $team = $page->children('include=hidden');

    $team1 = $team->slice(0, 2); //die ersten 2 mitglieder, von 0-1
    $team2 = $team->slice(2);

    echo "<div class='leaders'>";

    foreach($team1 as $mitglied) {
        echo"<div class='member g_6-12'>
                <div>
                    <img class='g_6-12' src='{$mitglied->single_image->eq(0)->url}'>
                    <h3>$mitglied->title</h3>
                    <span>$mitglied->leadtext</span>
                    ";
                    if($mitglied->body) {
                        echo "$mitglied->body";
                    }

                echo"<span>$mitglied->nummer</span>
                    <a href='mailto:$mitglied->email'>
                    <span>$mitglied->email</span></a>
                </div>
            </div>";
    }
    echo "</div>"; //Ende DIV-Leaders


    echo "<div class='employee'>";

    foreach($team2 as $mitglied) {
         echo"<div class='member g_6-12'>
                <div>
                    <img class='g_6-12' src='{$mitglied->single_image->eq(0)->url}'>
                    <h3>$mitglied->title</h3>
                    <span>$mitglied->leadtext</span>";
                    if($mitglied->body) {
                        echo "$mitglied->body";
                    }
                echo"<span>$mitglied->nummer</span>
                    <a href='mailto:$mitglied->email'>
                    <span class='email'>$mitglied->email</span></a>
                </div>
            </div>";
    }        
    echo "</div>"; //Ende DIV-Employee

    echo "</section>";
?>
</main>
