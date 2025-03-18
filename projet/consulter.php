<!-- Sur cette page, on salut l'utilisateur qui vient de se connecter -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Bonjour</title>
        <link rel ="stylesheet" href ="consulte.css">
    </head>
    <body>
        <?php if (!isset($_SESSION)){session_start();}
        if (isset($_SESSION['nomduti'])){
            echo "Bonjour, ".$_SESSION['prenom']." ".$_SESSION['nom']."! <br> Il est temps de croiser tes pensées!<br>";
        }else{
            echo "<br><h1>Vous n'êtes pas connectés, cliquez <a href=\"http://localhost/projet/bienvenue.php\">ici</a> pour aller à la page d'accueil.</h1>";
        } ?>
    </body>
</html>
