<!DOCTYPE html>
<html>
    <head>
        
        <title>Forum</title>
        <meta charset="utf-8"/>
    </head>
    
    <link type="text/css" rel="stylesheet" href="../Style/forum.css"/>

    <body>
        
        <?php include ("Header.php") ?>
        <?php require("model.php") ?>
        
        <table id = "table_de_topic">
            <thead>
                <tr>
                    <td class="colonne_topics">Topics</td>
                    <td class="colonne_messages">Messages</td>
                    <td class="colonne_dernier_message">Dernier message</td>
                </tr>
            </thead>
            
            <tbody>
                <?php affichage_topics(); ?>
            </tbody>
        </table>
        
        <?php include("footer.php") ?>
    </body>
    
</htm>


