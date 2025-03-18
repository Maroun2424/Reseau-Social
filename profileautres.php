<?php include_once('pagedac.php'); ?>
<br> <br> <br> 

<?php 

function affiche_profil(){
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
    <div class=\"center2\">
    <a href=\"modification.php\"><button type=\"button\" class=\"buttons1\">M'abonner</button></a>&nbsp &nbsp 
    <a href=\"modification.php\"><button type=\"button\" class=\"buttons2\">Signaler ce compte</button></a>&nbsp &nbsp 
    </div>
</body>
</html>
";}

affiche_profil();