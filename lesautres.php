<link rel ="stylesheet" href ="recherchE.css">
<?php include_once('pagedac.php');
    echo "<br> <br>"; ?>
    <div class="tete">
        <img src="images/logo.png" alt="logo" width="150" height="150">
</div> <?php
    if(!isset($_SESSION)){session_start();}
    $connexion = mysqli_connect ('127.0.0.1','root','','projet');
    $req ='SELECT * FROM users WHERE pseudo!=\''.$_SESSION['nomduti'].'\';';
    $resultat = mysqli_query ($connexion,$req);
    if (mysqli_num_rows($resultat) > 0){
        $compte=1;
        echo "<h2>";
        echo "Voici la liste de tous les utilisateurs:<br></h2>";
        echo "<table>";
        foreach($resultat as $tab){
            echo "<tr><td>";
            echo "<img src=\"http://localhost/projet/photosDeProfile/photos/".$tab['photo']."\" height=\"35\" width=\"35\"/>";
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
?>