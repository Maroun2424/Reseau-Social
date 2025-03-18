<!-- Sur cette page, l'utlisateur a le choix d'effacer ses questions posées -->
<?php include_once('pagedac.php');
    echo "<br> <br><br><br><br>"; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Effacer une question</title>
        <link rel ="stylesheet" href ="effacerquestion.css">
    </head>
    <body>
        <?php if(!isset($_SESSION)){session_start();};
        if (isset($_SESSION['nomduti'])){
            if (!isset($_POST['reponses']) &&(!isset($_POST['motdepasse']))&&isset($_GET['question_id'])){
                echo "<form action=\"effacerquestion.php?question_id=".$_GET['question_id']."\" method=\"post\">";
                echo "Êtes-vous surs de vouloir effacer cette question ".$_SESSION['nomduti']."? <br><br>";
                echo "<input type=\"radio\" name=\"reponses\" value=\"oui\"> Oui &nbsp";
                echo "<input type=\"radio\" name=\"reponses\" value=\"non\"> Non <br><br>";
                echo  "<input type=\"submit\" name=\"action\" class=\"buttons\">";
                echo "</form>";
            }else if ((isset($_POST['reponses']))&&($_POST['reponses']=="oui") && (!isset($_POST['motdepasse']))){
                echo "<form action=\"effacerquestion.php?question_id=".$_GET['question_id']."\" method=\"post\">";
                echo "Écrivez votre mot de passe pour confirmer la suppression de la question. <br><br>";
                echo "<input type=\"password\" name=\"motdepasse\"><br><br>";
                echo "<input type=\"submit\" name=\"action\" class=\"buttons\">";
                echo "</form>";
            }else if ((isset($_POST['motdepasse']))){ //une vérification du mot de passe est nécéssaire pour pouvoir effacer une question: c'est toujours plus sécurisé
                if (password_verify($_POST['motdepasse'],$_SESSION['mdp'])){
                    supprimer();
                    echo "Clique <a href=\"http://localhost/projet/moncompte.php\">ici</a> pour retourner à ta page profile.";
                }else{
                    echo "Ce mot de passe ne convient pas, aucune question n'a été supprimée.";
                    echo "<br>Clique <a href=\"http://localhost/projet/moncompte.php\">ici</a> pour retourner à ta page profile.";
                }
            }else{
                echo "Aucune question n'a été supprimée.<br>";
                echo "Clique <a href=\"http://localhost/projet/moncompte.php\">ici</a> pour retourner ta page profile.";
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
