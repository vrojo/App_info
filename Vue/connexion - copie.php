<!DOCTYPE html>
<html>
    <head>
        
        <title>Connexion</title>
        <meta charset="utf-8"/>
    </head>
           <link type="text/css" rel="stylesheet" href="connexion.css"/>

    <body>
        
        <?php include("header.php"); ?>
        <?php require("model.php"); ?> 
        

        <div class="regroupement_connexion_inscription">
        <div class="Connexion">
            <span id="titre_inscritpion">Inscription :</span>
            <form action="inscription.php" method="post">
                <input type="text" name="nominscri" placeholder="Nom"> 
                <br>
                <input type="text" name="prenominscri" placeholder="Prénom">
                <br>
                <input type="text" name="adrinscri" placeholder="Adresse mail">
                <br>
                <br>
                <input type="submit" value="S'inscrire" name="sinscrire" id="bouton_connexion">
            </form>
        </div>
        </div>
        
        <div class="regroupement_connexion_inscription">
        <div class="Connexion">
            <span id="titre_connexion">Connexion :</span>
            <form action="connexion_verif.php" method="post">
                <input type="text" name="adrconnexion" placeholder="Adresse mail">
                <br>
                <input type="password" name="mdpconnexion" placeholder="Mot de passe">
                <br>
                <br>
                <input type="submit" value="Se connecter" name="seconnecter" id="bouton_connexion">
                <br>
            </form>
        </div>
        </div>
        <?php include("Footer.php"); ?>
    </body>
</html>

