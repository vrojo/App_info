<!DOCTYPE html>
<html>
    <head>
        
        <title>Connexion</title>
        <meta charset="utf-8"/>
        <link type="text/css" rel="stylesheet" href="../Style/connexion.css"/>
        <script type="text/javascript" src="connexion.js"></script>

    </head>
           

    <body>
        
        <?php include("header.php"); ?>
        <?php require("model.php"); ?> 
        

        <div class="regroupement_connexion_inscription">
        <div class="Connexion">
            <span id="titre_inscritpion">Inscription :</span>
            <form action="message_d_inscription.php" method="post" onsubmit="verifComplet()">
                <input type="mail" name="mail" placeholder="Adresse mail" id="mail_inscription" onblur="verifMail(this)"> <span id="erreur_mail"></span>
                <br>
                <input type="password" name="mdpconnexion" placeholder="Mot de passe" id="mdpconnexion_inscription" oninput="verifMdpI(this)"><span id="erreur_mdpi"></span>
                <br>
                <input type="password" name="mdpconnexion_verif" placeholder="Confirmation mot de passe" id="mdpconnexion_verif_inscription" oninput="verifMdpconf(this)"> <span id="erreur_confirmation_mdp"></span>
                <br>
                <br>
                <br>
                <input type="submit" value="S'inscrire" name="sinscrire" id="bouton_connexion" style="visibility: visible">
            </form>
        </div>
       
        
        
        <div class="Connexion">
            <span id="titre_connexion">Connexion :</span>
            <form action="../Controler/connexion_verif.php" method="post" onsubmit="verifComplet()">
                <input type="mail" name="adrconnexion" placeholder="Adresse mail" id="mail_connexion" onblur="verifMailConnexion(this)"> <span id="erreur_mail_connexion"></span>
                <br>
                <input type="password" name="mdpconnexion" placeholder="Mot de passe" oninput="verifMdpC(this)"><span id="erreur_mdpc"></span>
                <br>
                <br>
                <br>
                <input type="submit" value="Se connecter" name="seconnecter" id="bouton_connexion2" style="visibility: visible">
                <br>                
            </form>
        </div>
        </div>
        <?php include("Footer.php"); ?>
    </body>
</html>

