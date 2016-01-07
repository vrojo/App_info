<?php session_start();
require '../Controler/fonction_user.php';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>profiluser</title>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" href="../Style/profiluser.css"/>
    </head>
    
    <body>
        <?php include ("Header.php"); ?>
        <div id="pageuser">
            <table id="table1" border="0">
                <tr>
                    <td width="33%" align="center">
                        <img id="photoprofil" src="<?php echo $user['photo_u'];?>" height="200" width="200" border="3"/>
                    
                        <br> &nbsp; <br>
                        <?php if($user['id_utilisateur']!=$_SESSION['id_utilisateur'])
                        { ?><a href="#" style="color:black"><div id="msg">Envoyer un message</div></a>
                        
                        <?php }?>
                    </td>
                    
                    
                    
                    
                    <td id="addqq">
                        <h2 align="left"><?php echo $user['prenom_u'].'&nbsp;'.$user['nom_u']; ?> </h2>
                        <br>
                       
                        <h4 align="left"><em>Ma description</em></h4>
                        <p><em><?php echo $user['description']; ?></em></p>
                    </td>
                    <td id="addqq2" width='20%'>
                        <a href="#"><img id="add" src="adduser.png"/></a>
                    </td>
                </tr>
                <tr>
                    <td id="aparticipe" colspan="4" align="left">A participé à :<br><?php include'carrousel2.php'; ?></td>
                </tr>
                <tr>
                    <td>Commmentaires récents : <br> <?php recup_com($com);?><!-- a utiliser le php--></td>
                    <td colspan="2">Evenements créés : <br> <!--a utiliser le php--></td>
                </tr>
            </table>
        </div>
        <div>A participé à :<br><?php include'carrousel2.php'; ?><br><?php carrousselprofiles();?></div>
        <?php include ("footer.php"); ?>
    </body>
</html>