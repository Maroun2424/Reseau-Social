<!-- Sur cette page, l'utilisateur peut supprimer son compte-->
<link rel ="stylesheet" href ="supprimeR.css">
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Supprimer</title>
    </head>
    <body>
        <?php if(!isset($_SESSION)){session_start();};
        if (isset($_SESSION['nomduti'])){
            if (!isset($_POST['reponses']) &&(!isset($_POST['motdepasse']))){ //on montre le formulaire 'oui' ou 'non'
                echo "<form action=\"supprimer.php\" method=\"post\">";
                echo "Êtes-vous surs de vouloir effacer votre compte ".$_SESSION['nomduti']."? <br><br>";
                echo "<input type=\"radio\" name=\"reponses\" value=\"oui\"> Oui &nbsp";
                echo "<input type=\"radio\" name=\"reponses\" value=\"non\"> Non <br><br>";
                echo  "<input type=\"submit\" name=\"action\" class=\"buttons\">";
                echo "</form>";
            }else if ((isset($_POST['reponses']))&&($_POST['reponses']=="oui") && (!isset($_POST['motdepasse']))){ //formulaire de confirmation avec le mot de passe pour sécurité
                echo "<form action=\"supprimer.php\" method=\"post\">";
                echo "Écrivez votre mot de passe pour confirmer la suppression. <br><br>";
                echo "<input type=\"password\" name=\"motdepasse\"><br><br>";
                echo "<input type=\"submit\" name=\"action\" class=\"buttons\">";
                echo "</form>";
            }else if ((isset($_POST['motdepasse']))){
                if (password_verify($_POST['motdepasse'],$_SESSION['mdp'])){ //si le mot de passe convient, on supprime
                    supprimer();
                    echo "Clique <a href=\"http://localhost/projet/bienvenue.php\">ici</a> pour retourner à la page d'accueil.";
                }else{
                    echo "Ce mot de passe ne convient pas.";
                }
            }else{
                echo "Aucun compte n'a été supprimé.<br>";
                echo "Clique <a href=\"http://localhost/projet/welcome.php\">ici</a> pour retourner à la page d'accueil.";
            }
        }else{
            echo "Vous n'êtes pas connectés.<br>";
            echo "Cliquez <a href=\"http://localhost/projet/bienvenue.php\">ici</a> pour aller à la page d'accueil.";
        }

        function supprimer(){
            if (isset($_SESSION['nomduti'])&&isset($_SESSION['nom'])&&isset($_SESSION['prenom'])&&isset($_SESSION['mdp'])&&isset($_SESSION['date'])){
            $connexion = mysqli_connect ('127.0.0.1','root','','projet');
            $req='DELETE FROM users WHERE pseudo = \''.$_SESSION['nomduti'].'\';'; //suppression
            $resultat = mysqli_query ($connexion,$req);
            echo "Compte supprimé. <br>";
            session_destroy(); //session détruite care compte supprimé
            }
        }?>
    </body>
</html>
