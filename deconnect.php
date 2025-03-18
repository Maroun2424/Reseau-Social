<link rel ="stylesheet" href ="deconnecT.css">
<div class="tete">
    <img src="images/logo.png" alt="logo" width="180" height="180">
</div>
<body>
<?php session_start();

    if (isset($_POST['reponses'])){
        if ($_POST['reponses']=="oui"){
            echo "Au revoir, ".$_SESSION['prenom']." et à très bientôt!<br>";
            session_destroy();
            echo "Clique <a href=\"http://localhost/projet/bienvenue.php\">ici</a> pour retourner à la page d'accueil.";
        }else{
            echo "On est heureux de te garder encore un peu!<br>";
            echo "Clique <a href=\"http://localhost/projet/pagedac.php\">ici</a> pour retourner à la page d'accueil.";
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
?>
</body>