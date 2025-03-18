<!-- Sur cette page, on accueil les utilisateurs-->
<!DOCTYPE html>
<html lang="fr">
        <head>
        <meta charset="UTF-8">
        <title>Page d'accueil</title>
        <link rel ="stylesheet" href ="pagedac.css">
        <?php if (!isset($_SESSION)){session_start();} 
        if (isset($_SESSION['nomduti'])){
                echo "<ul class=\"navbar\">
                        <li><a href=\"http://localhost/projet/actu.php\">FIL D'ACTUALITÉ</a></li>
                        <li><a href=\"http://localhost/projet/decouvrir.php\">CHERCHER UN COMPTE</a></li>
                        <li><a href=\"http://localhost/projet/recherchepartheme.php\">RECHERCHE PAR THÈME</a></li>
                        <li><a href=\"http://localhost/projet/question.php\">POSER UNE QUESTION</a></li>
                        <li><a href=\"http://localhost/projet/moncompte.php\">PROFILE</a></li>
                        <li><a href=\"http://localhost/projet/about.php\">A PROPOS DE NOUS</a></li>";
                        if ($_SESSION['admin']==1){
                                echo "<li><a href=\"http://localhost/projet/voirsignal.php\">SIGNALEMENTS</a></li>";
                        }
                echo "</ul>
                </head><br><br><br><br><br><br><br>
                <body>
                        <h1>Bonjour, ". $_SESSION['nomduti'].", et bienvenue sur Pensées Croisées!</h1>
                        <div class=\"tete\">
                                <img src=\"images/logo.png\" alt=\"logo\" width=\"220\" height=\"220\">
                        </div>
                        <h1>Il est temps de mettre nos cerveaux en marche!</h1>
                </body>";
        }else{
                echo "<br><h2>Vous n'êtes pas connectés, cliquez <a href=\"http://localhost/projet/bienvenue.php\">ici</a> pour aller à la page d'accueil.</h2>";
        }?>
</html>