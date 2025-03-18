<!-- Sur cette page, les différents thèmes apparaissent avec une icône symobolique stockée dans le fichier images/thèmes afin de permettre à l'utilisateur de trouver des questions liées à un thème précis s'il le désire -->
<?php include_once('pagedac.php');
echo "<br> <br> <br> <br> <br>"; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Recherche par thème</title>
        <link rel ="stylesheet" href ="rechercheparthemE.css">
    </head>
    <body>
        <?php if (!isset($_SESSION)){session_start();}
        if (isset($_SESSION['nomduti'])){
            $connexion = mysqli_connect ('127.0.0.1','root','','projet');
            $req ='SELECT * FROM themes;'; //je sélectionne tous les thèmes
            $resultat = mysqli_query ($connexion,$req);
            echo "<table>";
            foreach($resultat as $tab){
                echo "<tr><td>";
                echo "<img src=\"http://localhost/projet/images/themes/".$tab['theme_icon']."\" height=\"110\" width=\"110\"/>";
                echo "</td><td>";
                echo "<a href=\"http://localhost/projet/themes.php?theme=";
                echo $tab['theme_nom'];
                echo "\">";
                echo $tab['theme_nom'];
                echo "</a><br>";
                echo"</td><td>";
                echo "<img src=\"http://localhost/projet/images/themes/".$tab['theme_icon']."\" height=\"110\" width=\"110\"/>";
                echo "</td><td></tr>";
            }echo "</table>";
        } ?>
    </body>
</html>
