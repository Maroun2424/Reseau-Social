<!-- Sur cette page, l'utlisateur se déconnecte de son compte en répondant par 'oui' ou 'non' avant que la déconnection ait lieu -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Me déconnecter</title>
        <link rel ="stylesheet" href ="deconnect.css">
        <div class="tete">
            <img src="images/logo.png" alt="logo" width="180" height="180">
        </div>
    </head>
    <body>
        <?php if(!isset($_SESSION)){session_start();};
        if (isset($_SESSION['nomduti'])){
            if (isset($_POST['reponses'])){
                if ($_POST['reponses']=="oui"){
                    echo "Au revoir, ".$_SESSION['prenom']." et à très bientôt!<br>";
                    session_destroy();
                    echo "Clique <a href=\"http://localhost/projet/bienvenue.php\">ici</a> pour retourner à la page d'accueil.";
                }else{
                    echo "On est heureux de te garder encore un peu!<br>";
                    echo "Clique <a href=\"http://localhost/projet/welcome.php\">ici</a> pour retourner à la page d'accueil.";
                }
            }else{
                echo "<form action=\"deconnect.php\" method=\"post\">";
                echo "Il est déjà temps de se quitter, ".$_SESSION['prenom']."? <br><br>";
                echo "<td><input type=\"radio\" name=\"reponses\" value=\"oui\"> Oui &nbsp";
                echo "<td><input type=\"radio\" name=\"reponses\" value=\"non\"> Non <br>";
                echo "<br>";
                echo  "<input type=\"submit\" name=\"action\" class=\"buttons\">";
                echo "</form>";
            }
        }else{
            echo "<br><h1>Vous n'êtes pas connectés, cliquez <a href=\"http://localhost/projet/bienvenue.php\">ici</a> pour aller à la page d'accueil.</h1>";
        }?>
    </body>
</html>
