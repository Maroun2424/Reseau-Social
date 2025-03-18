<!-- Sur cette page, l'utlisateur peut s'abonner à un compte donné par $_GET['utilisateur']-->
<?php include_once('pagedac.php'); ?>
<br> <br> <br> <br><br>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>S'abonner</title>
        <link rel ="stylesheet" href ="sabonnerr.css">
    </head>
    <body>
        <?php if (!isset($_SESSION)){session_start();}
        if (isset($_SESSION['nomduti'])){
            $user=$_GET['utilisateur'];
            $connexion = mysqli_connect ('127.0.0.1','root','','projet');
            $req='INSERT INTO abonnement (followed_id, follower_id) VALUES (\''.mysqli_real_escape_string($connexion,$user).'\',\''.$_SESSION['id'].'\');'; //je créé le lien dans le tableau 'abonnement'
            $resultat = mysqli_query ($connexion,$req);

            $req2='SELECT * from users WHERE id=\''.$user.'\';'; //je trouve le nom de l'utilisateur du compte auquel s'est abonné l'utilisateur
            $resultat2 = mysqli_query ($connexion,$req2);
            $tab2=mysqli_fetch_assoc($resultat2);

            if ($resultat){
                $req3='UPDATE users SET  abonnes= abonnes +1 WHERE id ='.$tab2['id'].';'; 
                $req4='UPDATE users SET  suivis= suivis +1 WHERE id ='.$_SESSION['id'].';'; //j'incrémente le nombre d'abonnés et de comptes suivis
                $resultat3 = mysqli_query ($connexion,$req3);
                $resultat4 = mysqli_query ($connexion,$req4);
                if ($resultat3 && $resultat4){
                    echo "<h1>".$_SESSION['prenom'].", vous êtes à présent abonnés au compte de ".$tab2['pseudo']."!</h1>";
                    $_SESSION['suivis']++; //j'incrémente la valeur de comptes suivis dans les sessions car sinon il faut se déconnecter et se reconnecter pour que celle-ci soit modifiée (car $_SESSION['suivis'] est créé lors de la connexion)
                    echo "<h1>Cliquez <a href=\"http://localhost/projet/lesautres.php\">ici</a> pour découvrir d'autres profiles.</h1>";
                }else{
                    echo "Une erreur est survenue";
                }
            }else{
                echo "Une erreur est survenue";
            }
        }?>
    </body>
</html>

