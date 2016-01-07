<?php
session_start();

$connect = mysqli_connect("localhost", "root", "root", "bddsimplevent");
if (!$connect) {
    printf("Ã‰chec de la connexion : %s\n", mysqli_connect_error());
    exit();
}   
function update_event($nom,$description,$prix,$Event_id) {
    global $connect;
    mysqli_query($connect, "update event set Nom_e = '$nom', description_e = '$description', 'prix' = '$prix' where Event_id='$Event_id'") or die("MySQL Erreur : " . mysqli_error());
}

function insert_event($nom,$description,$prix) {
    global $connect;
    mysqli_query($connect, "insert into event (Nom_e,description_e,prix) values ('$nom', '$description', '$prix')") or die("MySQL Erreur : " . mysqli_error());
}    

function select_event() {
    global $connect;
    $result=mysqli_query($connect,"select * from event") or die("MySQL Erreur : " . mysqli_error());
    return $result;
}
function select_one_event($Event_id) {
    global $connect;
     $result=mysqli_query($connect,"select * from event where Event_id=".$Event_id) or die("MySQL Erreur : " . mysqli_error());
     return $result;
}
?>
<!DOCTYPE HTML>
<html>
    <head>        
        <title>Exemple simple de site en PHP </title>
    </head>
    <body>
        <h1>Liste des utilisateurs</h1>
        <?php
        if (isset($_GET['action']) && $_GET['action'] == "save") {
            if(!empty ($_GET['Event_id'])) {
                update_event($_GET['nom'],$_GET['description'],$_GET['Event_id']);
            } else {
                insert_event($_GET['nom'],$_GET['description']);
            }
        }

       if (isset($_GET['action']) && $_GET['action'] == "ajouter" || isset($_GET['action']) && $_GET['action'] == "modifier") {
            $nom = "";
            $description = "";
            $Event_id = "" ;
			$prix="";

            if($_GET['action']=="modifier") {
                $result = select_one_event($_GET['id']);
                $event = mysqli_fetch_assoc($result);
                $nom = $event['nom'];
                $description = $event['description_e'];
                $Event_id = $event['Event_id'];
            } ?>

        <form action="creaevent.php" method="get">
		Nom : <input type="text" name="nom" value="<?php echo $nom; ?>"/>
		description : <input type="text" name="description" value="<?php echo $description; ?>"/>
		Prix : <input type="text" name="description" value="<?php echo $prix; ?>"/>
            <input type="hidden" name="Event_id" value="<?php echo $Event_id; ?>"/>
            <input type="hidden" name="action" value="save"/>
            <input type="submit"/>
        </form>

            <?php

        } else {
            $result=select_event();
            ?>
        <table>
                <?php                
                while($event = mysqli_fetch_assoc($result)) {
                    ?>
            <tr>
                <td>
                            <?php echo $event['nom']; ?>
                </td>
                <td>
                            <?php echo $event['description']; ?>
                </td>
                <td>
                            <?php echo '<a href=" ../controler/creaevent.php?action=modifier&Event_id='.$event['Event_id'].'">modifier</a>'; ?>
                </td>
            </tr>
                    <?php }
                mysqli_free_result($result); ?>

        </table>
        <a href=" ../controler/creaevent.php?action=ajouter">ajouter</a>
            <?php } ?>
    </body>
</html>