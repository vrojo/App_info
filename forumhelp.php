<!DOCTYPE html>
<html>
    <head>
        
        <title>Forum</title>
        <meta charset="utf-8"/>
        <link type="text/css" rel="stylesheet" href="../Style/forum.css"/>
    </head>
    

    <body>
        
        <?php include ("../Vue/Header.php") ?>
        <?php require("../Modele/fonction_forum.php") ?>
        <div id="body">
            <table id = "table_de_topic">
                <thead>
                    <tr>
                        <td id="tdentete" colspan="3" align="center"><div id="entete"><h1>Forum</h1></div></td>
                    </tr>
                    <tr>
                        <td class="top_colonne_topics" align="center"><div id="Boutontopic">Topics</div></td>
                        <td class="top_colonne_messages" align="center"><div id="Boutonmsg">Messages</div></td>
                        <td class="top_colonne_dernier_message" align="center"><div id="Boutondernier">Dernier message</div></td>
                    </tr>
                </thead>
            
                <tbody>
                    <tr>
                        <td height="35" align="center">
                            <a href="#"><div id="Bouton">créer un topic</div></a>
                        </td>
                    </tr>
                    <?php affichage_topics(); ?>
                </tbody>
            
            </table>
        </div>
        <?php include("footer.php") ?>
    </body>
    
</htm>


