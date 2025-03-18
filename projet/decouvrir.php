<!-- Sur cette page, l'utlisateur est invité à choisir s'il veut chercher un compte ou plutôt voir la liste complète des comptes -->
<?php include_once('pagedac.php'); ?>
    <br> <br> 
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Découverte de comptes</title>
        <div class="tete">
            <img src="images/logo.png" alt="logo" width="180" height="180">
        </div>
        <link rel ="stylesheet" href ="decouvrir.css">
    </head>
    <body>
        <?php if (!isset($_SESSION)){session_start();}
        if (isset($_SESSION['nomduti'])){
            echo "<div class=\"center\">
            <a href=\"http://localhost/projet/recherche.php\"><button type=\"button\" class=\"buttons\">Chercher un compte</button></a>&nbsp &nbsp &nbsp
            <a href=\"http://localhost/projet/lesautres.php\"><button type=\"button\" class=\"buttons\">Découvrir les comptes</button></a><br><br>
            </div>";
        }?>
    </body>
</html>



    