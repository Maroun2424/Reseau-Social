<link rel ="stylesheet" href ="rechercheparthemE.css">
<?php include_once('pagedac.php');
    echo "<br> <br> <br> <br> <br>"; ?>
<?php
    $connexion = mysqli_connect ('127.0.0.1','root','','projet');
    $req ='SELECT * FROM themes;';
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
?>