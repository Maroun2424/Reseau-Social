<!-- Sur cette page, seul un utilisateur admin peut effacer une question signalée -->
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
            if (!isset($_POST['reponses']) &&(!isset($_POST['motdepasse']))&&isset($_GET['question_id'])){
                echo "<form action=\"effacerquestionsignalee.php?question_id=".$_GET['question_id']."&signal_id=".$_GET['signal_id']."\" method=\"post\">";
                echo "Êtes-vous surs de vouloir effacer cette question ".$_SESSION['nomduti']."? <br><br>";
                echo "<input type=\"radio\" name=\"reponses\" value=\"oui\"> Oui &nbsp";
                echo "<input type=\"radio\" name=\"reponses\" value=\"non\"> Non <br><br>";
                echo  "<input type=\"submit\" name=\"action\" class=\"buttons\">";
                echo "</form>";
            }else if ((isset($_POST['reponses']))&&($_POST['reponses']=="oui") && (!isset($_POST['motdepasse']))){
                echo "<form action=\"effacerquestionsignalee.php?question_id=".$_GET['question_id']."&signal_id=".$_GET['signal_id']."\" method=\"post\">";
                echo "Écrivez votre mot de passe pour confirmer la suppression de la question. <br><br>";
                echo "<input type=\"password\" name=\"motdepasse\"><br><br>";
                echo "<input type=\"submit\" name=\"action\" class=\"buttons\">";
                echo "</form>";
            }else if ((isset($_POST['motdepasse']))){
                if (password_verify($_POST['motdepasse'],$_SESSION['mdp'])){
                    supprimer();
                    echo "Clique <a href=\"http://localhost/projet/voirsignal.php\">ici</a> pour aller à la page des questions signalées.";
                }else{
                    echo "Ce mot de passe ne convient pas, aucune question n'a été supprimée.";
                    echo "Clique <a href=\"http://localhost/projet/actu.php\">ici</a> pour retourner au fil d'actualité.";
                }
            }else{
                echo "Aucune question n'a été supprimée.<br>";
                echo "Clique <a href=\"http://localhost/projet/actu.php\">ici</a> pour retourner au fil d'actualité.";
            }
        }

        function supprimer(){
            if (isset($_GET['question_id'])&&isset($_GET['signal_id'])){ //les paramètre $_GET['question_id'] et $_GET['signal_id'] sont donnés en argument, j'ai trouvé cette façon la plus efficace pour transmettre l'id de la question et du signalement d'une page à une autre
                $connexion = mysqli_connect ('127.0.0.1','root','','projet');
                $req='DELETE FROM question WHERE question_id = \''.$_GET['question_id'].'\'';
                $req2='DELETE FROM signaler WHERE signal_id = \''.$_GET['signal_id'].'\'';
                $resultat = mysqli_query ($connexion,$req);
                $resultat2 = mysqli_query ($connexion,$req2);
                echo "Question supprimée. <br>";
            }else{
                echo "Il y a eu un problème.";
            }
        }?>
    </body>
</html>
