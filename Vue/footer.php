 		<link type="text/css" rel="stylesheet" href="../Style/Footer.css"/>
		<div id="footer">
			<div id="utilisation">
				<h4 class="titre_footer">Utilisation de SimplEvent :</h4>
				<a href="aide.php">Aide</br></a>
				<a href="forum.php">Forum</br></a>
                                <a href="CGU.php">CGU</br></a>
				<p></p>
			</div>
			<?php 
                        if(isset($_SESSION['admin_utilisateur'])&& $_SESSION['admin_utilisateur'] ==1){
                        echo'<div id="administrateur"> <h4 class="titre_footer">Administrateur :</h4> <a href="backoffice.php">Accéder au panneau de configuration</br></a>				<p></p>			</div>';
                        }
                        ?>
			<div id="contact">
				<h4 class="titre_footer">Nous contacter :<h4>
				<div id="facebook">
					<a href="https://www.facebook.com/SimpEevent/?fref=ts"><img src="../reste/images/fbicon.png" id="img_fb"/><br></a>
				</div>
				<div id="twitter">
					<a href="https://twitter.com/Simplevent2"><img src="../reste/images/twittericon.png" id="img_twitter"/></br></a>
				</div>
				<div id="mail">
					<a href="sitesimplevent@gmail.com"><img src="http://www.musiquelepop.com/mail_envelope_blue_icon.png" id="img_mail"/></br></a>
				</div>
			</div>
		</div>