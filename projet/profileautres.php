<!-- Sur cette page, un utilisateur peut voir le profile de l'utilisateur donné en paramètre avec $_GET['utilisateur']-->
<?php include_once('pagedac.php'); ?>
<br><br><br> 
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Profile</title>
    </head>
    <body>
        <?php function affiche_profil(){
        if (!isset($_SESSION)){session_start();}
        if (isset($_SESSION['nomduti'])){
            $user=$_GET['utilisateur'];
            $connexion = mysqli_connect ('127.0.0.1','root','','projet');
            $req ='SELECT * FROM users WHERE pseudo = \''.$user.'\'';
            $resultat = mysqli_query ($connexion,$req);
            $tab=mysqli_fetch_assoc($resultat);
            echo "<!DOCTYPE html><html lang=\"fr\"><head><meta charset=\"UTF-8\"><title>Le profil de ".$user.".</title><link rel =\"stylesheet\" href =\"monCompte.css\">
            </head>
            <body>
            <div class=\"center\">
            <img src=\"http://localhost/projet/photosDeProfile/photos/".$tab['photo']."\" height=\"100\" width=\"100\"/><br><br>
            </div>
            <table>
                <thead> 
                    <tr>
                        <td colspan=\"2\">Profil de ".$user."</td>
                    </tr>
                </thead> 
            <tbody>
                <?php session_start(); ?>
                <tr><td>Nom d'utilisateur</td><td>".$tab['pseudo']."</td></tr>
                <tr><td>Prénom</td><td>".$tab['prenom']."</td></tr>
                <tr><td>Nom</td><td>".$tab['nom']."</td></tr>
                <tr><td>Date de naissance</td><td>".$tab['naissance']."</td></tr>
                <tr><td>Nombre d'abonnés</td><td>".$tab['abonnes']."</td></tr>
                <tr><td>Nombre de comptes suivis</td><td>".$tab['suivis']."</td></tr>
            </tbody>
            </table>
                <div class=\"center2\">";
                $req2 ='SELECT * FROM abonnement WHERE follower_id = \''.$_SESSION['id'].'\' AND followed_id = \''.$tab['id'].'\''; //fait référence au tableau 'abonnement' où sont stockés les abonnements d'un compte à un autre 
                $resultat2 = mysqli_query ($connexion,$req2);
                if (!mysqli_num_rows($resultat2) > 0){//pour voir si abonné ou pas
                    echo "<a href=\"http://localhost/projet/sabonner.php?utilisateur=".$tab['id']."\"><button type=\"button\" class=\"buttons2\">M'abonner</button></a>&nbsp &nbsp";
                }else{
                    echo "<h1>Vous êtes abonnés à ce compte.</h1>";
                    echo "<h1>Cliquez <a href=\"http://localhost/projet/lesautres.php\">ici</a> pour découvrir d'autres profiles.</h1><br>";
                }
                echo"</body></html>";
            }
        }
        affiche_profil();?>
    </body>
</html>
<?php 

