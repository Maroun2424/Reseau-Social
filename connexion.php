<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connection</title>
    <link rel ="stylesheet" href ="connexion.css">
</head>
<body>
    <div class="tete">
        <img src="images/logo.png" alt="logo" width="150" height="150">
    </div>
    <?php session_start();
        if(!isset($_SESSION['nomduti'])){
            if((!isset($_POST['pseudolog'])||(!isset($_POST['mdplog'])))){
                formulaire_login();
            }else{
                verifier();
            }
        }else{
            echo "<h1>";
            echo "Tu es déjà connecté, ".$_SESSION['prenom'].".";
            echo "<br>Clique <a href=\"http://localhost/projet/pagedac.php\">ici</a> pour aller à la page d'accueil.";
            echo "</h1>";
        }
    ?>
    </body>
</html>

<?php
    function formulaire_login(){
        echo "<form action=\"connexion.php\" method=\"post\">";
        echo "<table>";
        echo "<thead> <tr><td colspan=\"2\">Se connecter</td></tr></thead>";
        echo  "<tr><td>Votre pseudo:</td><td><input type=\"text\" name=\"pseudolog\" class=\"fields\" ><br> </td></tr>";
        echo  "<tr><td>Votre mot de passe:</td><td><input type=\"password\" name=\"mdplog\" class=\"fields\" <br> </td></tr>";
        echo "</table>";
        echo "<div class=\"center\"><input type=submit value=\"Envoyer\" class=\"buttons\"/></div>";
        echo "<h3 class=\"croisons\">Croisons nos pensées, pour tous nous cultiver!</h3>";
        echo "</form>";
    }

    function verifier(){
        $connexion = mysqli_connect ('127.0.0.1','root','','projet');
        if (empty($_POST['pseudolog'])&&empty($_POST['mdplog'])){
            formulaire_login();
        }
        else if((!$connexion||empty($_POST['pseudolog'])||empty($_POST['mdplog']))){
            echo "Erreur... Retentez de vous inscire";
            include_once("inscription.php");
        }else{
            $req='SELECT * FROM users WHERE pseudo=\''.$_POST['pseudolog'].'\';';
            $resultat = mysqli_query ($connexion,$req);
            if (!isset($_SESSION)){session_start();}
            if (mysqli_num_rows($resultat) > 0){
                foreach($resultat as $login){
                    if (password_verify($_POST['mdplog'],$login['password'])){
                        $_SESSION['nomduti']=$login['pseudo'];
                        $_SESSION['id']=$login['id'];
                        $_SESSION['prenom']=$login['prenom'];
                        $_SESSION['nom']= $login['nom'];
                        $_SESSION['mdp']=$login['password'];
                        $_SESSION['email']=$login['mail'];
                        $_SESSION['admin']=$login['isAdmin'];
                        $_SESSION['date']=$login['naissance'];
                        $_SESSION['abonnes']=$login['abonnes'];
                        $_SESSION['suivis']=$login['suivis'];
                        $_SESSION['photo']=$login['photo'];
                        include_once("consulter.php");
                        echo "<br>Clique <a href=\"http://localhost/projet/pagedac.php\">ici</a> pour aller à la page d'accueil.";
                    }else{
                        echo '<script type="text/javascript">alert("Le mot de passe ne convient pas.")</script>';
                        formulaire_login();
                    }
                }
            }else{
                echo '<script type="text/javascript">alert("Un tel compte n\'existe pas.")</script>';
                formulaire_login();
            }    
        }
    }
?>