<!-- Sur cette page, l'utlisateur fait une recherche de comptes -->
<?php include_once('pagedac.php');
echo "<br> <br> "; ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Recherche de comptes</title>
        <link rel ="stylesheet" href ="recherche.css">
        <div class="tete">
            <img src="images/logo.png" alt="logo" width="180" height="180">
        </div> 
    </head>
    <body> <?php
        function imprimer(){ //formulaire où la recherche sera faite
            echo "<form action=\"recherche.php\" method=\"POST\">
            <div class=\"chercher\">
            <input name=\"username\" id=\"search\" type=\"text\" placeholder=\"Recherche de pseudo\" class=\"fields\">
            <br><br><br><input id=\"submit\" type=\"submit\" value=\"Chercher\" class=\"buttons\">
            </div>
            </form>";
        }
        if (!isset($_SESSION)){session_start();}
        if (isset($_SESSION['nomduti'])){
            if (isset($_POST['username'])){
                $connexion = mysqli_connect ('127.0.0.1','root','','projet');
                $req ='SELECT * FROM users WHERE pseudo LIKE \'%'.$_POST['username'].'%\' AND pseudo!=\''.$_SESSION['nomduti'].'\''; //on cherche tous les pseudos où ce que l'utilisateur a écrit dans la barre de recherche est présent dans une partie du pseudo d'où le 'LIKE %'
                $resultat = mysqli_query ($connexion,$req);
                if (mysqli_num_rows($resultat) > 0){ //s'il y en a..
                    echo "<h2>";
                    echo "Les utilisateurs qui correspondent à votre recherche sont:<br></h2>";
                    echo "<table>";
                    foreach($resultat as $tab){
                        echo "<tr><td>";
                        echo "<img src=\"http://localhost/projet/photosDeProfile/photos/".$tab['photo']."\" height=\"35\" width=\"35\"/>"; //j'ai voulu que la photo de profile apparaisse à côté du pseudo
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
                    echo "Désolé... Il n'y a aucun compte de ce genre.";
                    echo "</h2>";
                }
            }else{
                imprimer();
            }
        }?>
    </body>
</html>

