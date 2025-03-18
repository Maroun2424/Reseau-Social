<!-- Sur cette page, la barre de navigation est créé et affichée. Beaucoup de pages font référence à celle-ci avec 'include_once' pour que l'utilisateur puisse s'orienter comme il veut -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Page d'accueil</title>
        <link rel ="stylesheet" href ="pagedac.css">

<?php   if (!isset($_SESSION)){session_start();} 
        if (isset($_SESSION['nomduti'])){
            echo "<ul class=\"navbar\">
            <li><a href=\"http://localhost/projet/actu.php\">FIL D'ACTUALITÉ</a></li>
            <li><a href=\"http://localhost/projet/decouvrir.php\">CHERCHER UN COMPTE</a></li>
            <li><a href=\"http://localhost/projet/recherchepartheme.php\">RECHERCHE PAR THÈME</a></li>
            <li><a href=\"http://localhost/projet/question.php\">POSER UNE QUESTION</a></li>
            <li><a href=\"http://localhost/projet/moncompte.php\">PROFILE</a></li>
            <li><a href=\"http://localhost/projet/about.php\">A PROPOS DE NOUS</a></li>";
            if (!isset($_SESSION)){session_start();} 
            if ($_SESSION['admin']==1){
                 echo "<li><a href=\"http://localhost/projet/voirsignal.php\">SIGNALEMENTS</a></li>";
            }
            echo "</ul>";
        }else{
            echo "<br><h2>Vous n'êtes pas connectés, cliquez <a href=\"http://localhost/projet/bienvenue.php\">ici</a> pour aller à la page d'accueil.</h2>";
        }?>
    </head>
</html>
