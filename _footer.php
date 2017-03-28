        </div> <?php // Ende DIV page-width aus _main-menu.php ?>

        
    <!-- FOOTER -->
	<footer id='footer'>
	   <div class="page_width row col">
             <div id="powered_by">
                <span class="font_small">Powered by </span><br>
                <a href='https://www.globalsystem.ch'>
                    <img id="global_system" src="<?php echo $daten->images_global->eq(0)->url; ?>" alt="Global System">
                </a>
            </div>
             
             
            <div class="footer_element">
                <a href="<?php echo $pages->get(1031)->url;?> "> <?php echo _x("Impressum", "Legal Notices-Link");?></a>
                <span class="primary_color"> |&nbsp</span>         
                <a href="<?php $url = $pages->get(1031)->url; $url = substr($url, 0, -1); echo $url . "#Datenschutz"; ?>"> <?php echo _x("Datenschutz", "Privacy Notices-Link");?>  </a>
                <span class="primary_color"> |&nbsp</span> 
                
                
                <!-- EDIT Button -->
                <?php //LOGOUT ADMIN
				
                    if($user->isLoggedin()) {
                        // if user is logged in, show a logout link
                        echo "<a href='{$pages->get(1083)->url}" . "?redirect={$page->id}'>";   // id = logout seite                     
                        echo _x("Abmelden", "Logout-Link");                        
                        echo " ($user->name)</a>";
                    } else {
                    // if user not logged in, show a login link
                    echo "<a href='{$pages->get(1030)->url}'>";    //ID= Anmelden-Seite
                    echo _x('Anmelden', 'Login-Link'); 
                    echo "</a>"; 
                    }
                ?>
                <span class="primary_color">&nbsp|&nbsp</span>
                
                
                <?php //LOGIN- ODER EDIT-LINK
				  //nur wer angemeldet ist sieht den edit button
                  if ($page->template != "login" AND $page->editable()) 
                  {
                      echo "<a id='login_link' class='button small' href='{$config->urls->admin}page/edit/?id={$page->id}'>";                      
                      echo _x('Bearbeiten', 'Edit-Link');
                      echo "</a> <span class='primary_color'>&nbsp|&nbsp</span><br>";                      
                      echo "<span>Template:&nbsp$page->template</span>
                      <span class='primary_color'>&nbsp|&nbsp</span>"; //das verwendete Template in Processwire
                      echo "<span>Page-ID:&nbsp$page->id</span>";      //damit ich immer weiss welche ID eine seite hat
                  }
                ?> 
            </div>
        </div>    
        
        <script src="<?php echo $config->urls->templates?>scripts/jquery-accessibleMegaMenu.js"></script> 
        <script src="<?php echo $config->urls->templates?>scripts/lazysizes.js" async></script>
        <script src="<?php echo $config->urls->templates?>scripts/respimage.js" async></script>
        <script src="<?php echo $config->urls->templates?>scripts/jquery-colorbox.js"></script>
		<script src="<?php echo $config->urls->templates?>scripts/tooltipster.bundle.js"></script>
        
        
        
        <?php //HTML5 VIDEOPLAYER: PLYR 
            if($page->id === 1080) {  // Seite ist: Angebot->Simulation
                
                
                //Einbinden des Plyr-Players
                echo "<link rel='stylesheet' href='{$config->urls->templates}styles/css/{$prefix}plyr.css'>
                      <script src='{$config->urls->templates}scripts/plyr.js'></script> ";
                
                
                /*Ausgabe der Plyr-Icons als InlineSVG. Die einzelnen Icons sind über Ihre ID aufrufbar.
                echo"
                <svg style='position: absolute; width: 0; height: 0; overflow: hidden;' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'>
                <defs>
                <symbol id='icon-plyr-captions-off' viewBox='0 0 32 32'>
                <title>plyr-captions-off</title>
                <path class='path1' d='M1.778 1.778h28.444c1.067 0 1.778 0.711 1.778 1.778v19.556c0 1.067-0.711 1.778-1.778 1.778h-8.178l-4.8 4.8c-0.356 0.356-0.711 0.533-1.244 0.533s-0.889-0.178-1.244-0.533l-4.8-4.8h-8.178c-1.067 0-1.778-0.711-1.778-1.778v-19.556c0-1.067 0.711-1.778 1.778-1.778zM9.813 19.822c3.538 0 5.351-2.347 5.831-4.284l-2.293-0.693c-0.338 1.173-1.387 2.578-3.538 2.578-2.027 0-3.911-1.476-3.911-4.16 0-2.862 1.991-4.213 3.876-4.213 2.187 0 3.164 1.333 3.467 2.542l2.311-0.729c-0.498-2.044-2.293-4.178-5.778-4.178-3.378 0-6.418 2.56-6.418 6.578s2.933 6.56 6.453 6.56zM23.271 19.822c3.538 0 5.351-2.347 5.831-4.284l-2.293-0.693c-0.338 1.173-1.387 2.578-3.538 2.578-2.027 0-3.911-1.476-3.911-4.16 0-2.862 1.991-4.213 3.876-4.213 2.187 0 3.164 1.333 3.467 2.542l2.311-0.729c-0.498-2.044-2.293-4.178-5.778-4.178-3.378 0-6.418 2.56-6.418 6.578s2.933 6.56 6.453 6.56z'></path>
                </symbol>
                <symbol id='icon-plyr-captions-on' viewBox='0 0 32 32'>
                <title>plyr-captions-on</title>
                <path class='path1' d='M1.778 1.778h28.444c1.067 0 1.778 0.711 1.778 1.778v19.556c0 1.067-0.711 1.778-1.778 1.778h-8.178l-4.8 4.8c-0.356 0.356-0.711 0.533-1.244 0.533s-0.889-0.178-1.244-0.533l-4.8-4.8h-8.178c-1.067 0-1.778-0.711-1.778-1.778v-19.556c0-1.067 0.711-1.778 1.778-1.778zM9.813 19.822c3.538 0 5.351-2.347 5.831-4.284l-2.293-0.693c-0.338 1.173-1.387 2.578-3.538 2.578-2.027 0-3.911-1.476-3.911-4.16 0-2.862 1.991-4.213 3.876-4.213 2.187 0 3.164 1.333 3.467 2.542l2.311-0.729c-0.498-2.044-2.293-4.178-5.778-4.178-3.378 0-6.418 2.56-6.418 6.578s2.933 6.56 6.453 6.56zM23.271 19.822c3.538 0 5.351-2.347 5.831-4.284l-2.293-0.693c-0.338 1.173-1.387 2.578-3.538 2.578-2.027 0-3.911-1.476-3.911-4.16 0-2.862 1.991-4.213 3.876-4.213 2.187 0 3.164 1.333 3.467 2.542l2.311-0.729c-0.498-2.044-2.293-4.178-5.778-4.178-3.378 0-6.418 2.56-6.418 6.578s2.933 6.56 6.453 6.56z'></path>
                </symbol>
                <symbol id='icon-plyr-enter-fullscreen' viewBox='0 0 32 32'>
                <title>plyr-enter-fullscreen</title>
                <path class='path1' d='M17.778 5.333h6.4l-7.111 7.111 2.489 2.489 7.111-7.111v6.4h3.556v-12.444h-12.444z'></path>
                <path class='path2' d='M12.444 17.067l-7.111 7.111v-6.4h-3.556v12.444h12.444v-3.556h-6.4l7.111-7.111z'></path>
                </symbol>
                <symbol id='icon-plyr-exit-fullscreen' viewBox='0 0 32 32'>
                <title>plyr-exit-fullscreen</title>
                <path class='path1' d='M1.778 21.333h6.4l-7.111 7.111 2.489 2.489 7.111-7.111v6.4h3.556v-12.444h-12.444z'></path>
                <path class='path2' d='M28.444 1.067l-7.111 7.111v-6.4h-3.556v12.444h12.444v-3.556h-6.4l7.111-7.111z'></path>
                </symbol>
                <symbol id='icon-plyr-fast-forward' viewBox='0 0 32 32'>
                <title>plyr-fast-forward</title>
                <path class='path1' d='M14 12.749l-14-10.971v28.444l14-10.971v10.971l18-14.222-18-14.222z'></path>
                </symbol>
                <symbol id='icon-plyr-muted' viewBox='0 0 32 32'>
                <title>plyr-muted</title>
                <path class='path1' d='M22.044 22.222l3.733-3.733 3.733 3.733 2.489-2.489-3.733-3.733 3.733-3.733-2.489-2.489-3.733 3.733-3.733-3.733-2.489 2.489 3.733 3.733-3.733 3.733z'></path>
                <path class='path2' d='M6.73 10.681h-5.46c-0.762 0-1.27 0.535-1.27 1.337v8.021c0 0.802 0.508 1.337 1.27 1.337h5.46l7.238 6.858c0.889 0.535 2.032 0 2.032-1.070v-22.272c0-1.070-1.143-1.738-2.032-1.070l-7.238 6.858z'></path>
                </symbol>
                <symbol id='icon-plyr-pause' viewBox='0 0 32 32'>
                <title>plyr-pause</title>
                <path class='path1' d='M10.667 1.778h-5.333c-1.067 0-1.778 0.711-1.778 1.778v24.889c0 1.067 0.711 1.778 1.778 1.778h5.333c1.067 0 1.778-0.711 1.778-1.778v-24.889c0-1.067-0.711-1.778-1.778-1.778v0z'></path>
                <path class='path2' d='M21.333 1.778c-1.067 0-1.778 0.711-1.778 1.778v24.889c0 1.067 0.711 1.778 1.778 1.778h5.333c1.067 0 1.778-0.711 1.778-1.778v-24.889c0-1.067-0.711-1.778-1.778-1.778h-5.333z'></path>
                </symbol>
                <symbol id='icon-plyr-play' viewBox='0 0 32 32'>
                <title>plyr-play</title>
                <path class='path1' d='M27.665 14.4l-20.784-14c-1.455-1-3.325 0-3.325 1.6v27.999c0 1.6 1.871 2.6 3.325 1.6l20.784-14c1.039-0.8 1.039-2.4 0-3.2v0z'></path>
                </symbol>
                <symbol id='icon-plyr-restart' viewBox='0 0 32 32'>
                <title>plyr-restart</title>
                <path class='path1' d='M17.244 2.133l1.244 11.378 3.733-3.733c3.378 3.378 3.378 9.067 0 12.444-1.6 1.778-3.911 2.667-6.222 2.667s-4.622-0.889-6.222-2.667c-3.378-3.378-3.378-9.067 0-12.444 1.067-1.067 2.489-1.956 4.089-2.311l-1.067-3.378c-2.133 0.533-4.089 1.6-5.689 3.2-4.8 4.8-4.8 12.622 0 17.6 2.311 2.311 5.511 3.556 8.711 3.556 3.378 0 6.4-1.244 8.711-3.556 4.8-4.8 4.8-12.622 0-17.6l3.911-3.911-11.2-1.244z'></path>
                </symbol>
                <symbol id='icon-plyr-rewind' viewBox='0 0 32 32'>
                <title>plyr-rewind</title>
                <path class='path1' d='M18 1.778l-18 14.222 18 14.222v-10.971l14 10.971v-28.444l-14 10.971z'></path>
                </symbol>
                <symbol id='icon-plyr-volume' viewBox='0 0 32 32'>
                <title>plyr-volume</title>
                <path class='path1' d='M27.733 5.867c-0.711-0.711-1.778-0.711-2.489 0s-0.711 1.778 0 2.489c2.133 2.133 3.2 4.8 3.2 7.644s-1.067 5.511-3.2 7.644c-0.711 0.711-0.711 1.778 0 2.489 0.356 0.356 0.889 0.533 1.244 0.533 0.533 0 0.889-0.178 1.244-0.533 2.667-2.667 4.267-6.222 4.267-10.133s-1.6-7.467-4.267-10.133v0z'></path>
                <path class='path2' d='M20.057 9.39c-0.668 0.668-0.668 1.671 0 2.339 1.307 1.307 1.769 2.592 1.769 4.27 0 1.664-0.757 3.408-1.769 4.421-0.668 0.668-0.668 1.671 0 2.339 0.258 0.258 1.13 0.466 1.809 0.278 0.2-0.055 0.384-0.145 0.53-0.278 2.090-1.902 2.726-4.699 2.726-6.761 0-0.302-0.005-0.604-0.021-0.907-0.093-1.763-0.567-3.564-2.705-5.703-0.668-0.668-1.671-0.668-2.339 0z'></path>
                <path class='path3' d='M6.73 10.681h-5.46c-0.762 0-1.27 0.535-1.27 1.337v8.021c0 0.802 0.508 1.337 1.27 1.337h5.46l7.238 6.858c0.889 0.535 2.032 0 2.032-1.070v-22.272c0-1.070-1.143-1.738-2.032-1.070l-7.238 6.858z'></path>
                </symbol>
                </defs>
                </svg>
                ";*/
            }
        ?>
        
        <script src="<?php echo $config->urls->templates?>scripts/<?php echo $prefix;?>main.js"></script>
            
       
	</footer>
</body>
</html>
