<!-- Sur cette page, seul un utilisateur admin a la possibilité d'effacer la question d'un utilisateur quelconque -->
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
                echo "<form action=\"effacerquestionadmin.php?question_id=".$_GET['question_id']."\" method=\"post\">";
                echo "Êtes-vous surs de vouloir effacer cette question ".$_SESSION['nomduti']."? <br><br>";
                echo "<input type=\"radio\" name=\"reponses\" value=\"oui\"> Oui &nbsp";
                echo "<input type=\"radio\" name=\"reponses\" value=\"non\"> Non <br><br>";
                echo  "<input type=\"submit\" name=\"action\" class=\"buttons\">";
                echo "</form>";
            }else if ((isset($_POST['reponses']))&&($_POST['reponses']=="oui") && (!isset($_POST['motdepasse']))){
                echo "<form action=\"effacerquestionadmin.php?question_id=".$_GET['question_id']."\" method=\"post\">";
                echo "Écrivez votre mot de passe pour confirmer la suppression de la question. <br><br>";
                echo "<input type=\"password\" name=\"motdepasse\"><br><br>";
                echo "<input type=\"submit\" name=\"action\" class=\"buttons\">";
                echo "</form>";
            }else if ((isset($_POST['motdepasse']))){
                if (password_verify($_POST['motdepasse'],$_SESSION['mdp'])){
                    supprimer();
                    echo "Clique <a href=\"http://localhost/projet/actu.php\">ici</a> pour retourner au fil d'actualité.";
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
            if (isset($_GET['question_id'])){ //le paramètre $_GET['question_id'] est donné en argument, j'ai trouvé cette façon la plus efficace pour transmettre l'id de la question d'une page à une autre
                $connexion = mysqli_connect ('127.0.0.1','root','','projet');
                $req='DELETE FROM question WHERE question_id = \''.$_GET['question_id'].'\'';
                $resultat = mysqli_query ($connexion,$req);
                echo "Question supprimée. <br>";
            }else{
                echo "Il y a eu un problème.";
            }
        }?>
    </body>
</html>
