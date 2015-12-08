<!DOCTYPE html>
<html>
    <head>
        
        <title>Recherche d'événement :</title>
        <meta charset="utf-8"/>
    </head>
           <link type="text/css" rel="stylesheet" href="RechercheAvanceeFinale.css"/>

    <body>
        <?php include ("Header.php"); ?>
        <?php require("model.php") ?>
        <?php
        if (isset($_GET['action']) && $_GET['action'] == "save") {
            if ($_GET['id'] != null) {
                mysqli_query($connect, "update utilisateur set nom = '$_GET[nom]', prenom = '$_GET[prenom]' where id='$_GET[id]'") or die("MySQL Erreur : " . mysqli_error());
            } else {
                mysqli_query($connect, "insert into users (nom,prenom) values ('$_GET[nom]', '$_GET[prenom]')") or die("MySQL Erreur : " . mysqli_error($connect));
            }
        }

        if (isset($_GET['action']) && $_GET['action'] == "ajouter" || isset($_GET['action']) && $_GET['action'] == "modifier") {
            $nom = "";
            $prenom = "";
            $id = "" ;
            if ($_GET['action'] == "modifier") {
                $result = mysqli_query($connect, "select * from users where id=" . $_GET['id']) or die("MySQL Erreur : " . mysqli_error($connect));
                $user = mysqli_fetch_assoc($result);
                $nom = $user['nom'];
                $prenom = $user['prenom'];
                $id = $user['id'];
            }
            ?>

            <form action="index.php" method="get">
                Nom : <input type="text" name="nom" value="<?php echo $nom; ?>"/>
                Prenom : <input type="text" name="prenom" value="<?php echo $prenom; ?>"/>
                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                <input type="hidden" name="action" value="save"/>
                <input type="submit"/>
            </form>

            <?php
        } else {
            $result = mysqli_query($connect, "select * from users") or die("MySQL Erreur : " . mysqli_error($connect));
            ?>
            <table>
                <?php
                while ($user = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $user['nom']; ?>
                        </td>
                        <td>
                            <?php echo $user['prenom']; ?>
                        </td>
                        <td>
                            <?php echo '<a href="index.php?action=modifier&id=' . $user['id'] . '">modifier</a>'; ?>
                        </td>
                    </tr>
                <?php }
                mysqli_free_result($result);
                ?>

            </table>
            <a href="index.php?action=ajouter">ajouter</a>
<?php } ?>
    
    
    
    
    </body>
    
     