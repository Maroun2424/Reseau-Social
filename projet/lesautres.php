<!-- Sur cette page, un utilisateur peut voir la liste de tous les autres utilisateurs -->
<?php include_once('pagedac.php');
    echo "<br><br>"; ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Profile</title>
        <link rel ="stylesheet" href ="recherche.css">
        <div class="tete">
            <img src="images/logo.png" alt="logo" width="150" height="150">
        </div>
    </head>
    <body> <?php
        if(!isset($_SESSION)){session_start();}
        if (isset($_SESSION['nomduti'])){
            $connexion = mysqli_connect ('127.0.0.1','root','','projet');
            $req ='SELECT * FROM users WHERE pseudo!=\''.$_SESSION['nomduti'].'\';'; //j'exclue l'utilisateur connecté car ça n'aurait pas beaucoup de sens de retrouver son propre compte quand on cherche à découvrir de nouveaux comptes..
            $resultat = mysqli_query ($connexion,$req);
            if (mysqli_num_rows($resultat) > 0){
                $compte=1;
                echo "<h2>";
                echo "Voici la liste de tous les utilisateurs:<br></h2>";
                echo "<table>";
                foreach($resultat as $tab){
                    echo "<tr><td>";
                    echo "<img src=\"http://localhost/projet/photosDeProfile/photos/".$tab['photo']."\" height=\"45\" width=\"45\"/>";
                    echo "</td><td>";
                    echo "<a href=\"http://localhost/projet/profileautres.php?utilisateur=";
                    echo $tab['pseudo'];
                    echo "\">";
                    echo $tab['pseudo'];
                    echo "</a><br>";
                    echo"</td></tr>";
                }
                echo "</table>";
            }else{
                echo "<h2>";
                echo "Désolé... Il n'y a aucun compte.";
                echo "</h2>";
            }
        }?>
    </body>
</html>
     