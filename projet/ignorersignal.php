<!-- Sur cette page, seul un utilisateur admin peut ignorer un signalement-->
<?php include_once('pagedac.php');
    echo "<br> <br><br><br><br>"; ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Effacer la question d'un autre utilisateur (admin)</title>
        <link rel ="stylesheet" href ="effacerquestionadmin.css">
    </head>
    <body>
        <?php if(!isset($_SESSION)){session_start();};
        if (isset($_SESSION['admin'])&&$_SESSION['admin']==1){
            if (isset($_GET['signal_id'])){ 
                $connexion = mysqli_connect ('127.0.0.1','root','','projet');
                $req='DELETE FROM signaler WHERE signal_id = \''.$_GET['signal_id'].'\'';
                $resultat = mysqli_query ($connexion,$req);
                echo "Signal ignoré avec succès. <br>";
                echo "Clique <a href=\"http://localhost/projet/voirsignal.php\">ici</a> pour aller à la page des questions signalées.";
            }else{
                echo "Il y a eu un problème.";
                echo "Clique <a href=\"http://localhost/projet/voirsignal.php\">ici</a> pour aller à la page des questions signalées.";
            }
        }?>
    </body>
</html>