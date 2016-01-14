<?php session_start();
$_SESSION['id_utilisateur']=1; ?>
<!DOCTYPE html>
<html>
    <head>
        
        <title>Création d'un topic</title>
        <meta charset="utf-8"/>
        <link type="text/css" rel="stylesheet" href="../Style/creation_topic.css"/>
    </head>
    

    <body>
        
        <?php include ("../Vue/Header.php") ?>
        <?php require("../Modele/fonction_forum.php") ?>
        <div id="body">
            <form method='POST' action='../Controler/cree_topic.php'>
            <table id = "table_de_topic">
                <thead>
                    <tr>
                        <td id="tdentete" align="center"><div id="entete"><h2>Création d'un topic</h2></div></td>
                    </tr>
                    <tr>
                        <td class="top_colonne_topics"><div id="Boutontopic">Votre topic</div></td>
                    </tr>
                    <tr><td></td></tr>
                </thead>
            
                <tbody>
                    <tr>
                        <td class="top_colonne_topics" align="center" colspan='3'><input type="text" name="sujet" id="sujet" placeholder="titre du sujet"></td>
                    </tr>
                    <tr><td></td></tr>
                    <tr>
                        <td class="top_colonne_topics" align="center" colspan='3'><textarea name="message" id="message" placeholder="entrez votre message"></textarea></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="créer mon topic" id="creer"></td>
                    </tr>
                    <tr>
                        <td height="35" align="center">
                            <div id="Bouton"><a href="../Vue/forum.php"><span style='color:blue'><u>retour au forum (forum.php)</u></span></a></div>
                        </td>
                    </tr>
                </tbody>
            
            </table>
            </form>
        </div>
        <?php include("footer.php") ?>
    </body>
    
</html>
