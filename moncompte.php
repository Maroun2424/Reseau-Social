<?php include('pagedac.php'); ?>
<br><br>

<?php 
session_start();
if (isset($_SESSION['nomduti'])){
    affiche_profil();
}else{
    echo "<link rel =\"stylesheet\" href =\"monCompte.css\">";
    echo "<div class=\"tete\">
    <img src=\"images/logo.png\" alt=\"logo\" width=\"150\" height=\"150\"></div>";
    echo "<h1>";
    echo "Vous n'êtes pas connectés, faites-le <a href=\"http://localhost/projet/connexion.php\">maintenant!</a>";
    echo "</h1>";
}

function affiche_profil(){
    echo "<!DOCTYPE html><html lang=\"fr\"><head><meta charset=\"UTF-8\"><title>Mon Profil</title><link rel =\"stylesheet\" href =\"monCompte.css\">
</head>
<body>
<div class=\"center\">
<img src=\"http://localhost/projet/photosDeProfile/photos/".$_SESSION['photo']."\" height=\"100\" width=\"100\"/><br><br>
</div>
<table>
    <thead> 
        <tr>
            <td colspan=\"2\">Mon Profil</td>
        </tr>
    </thead> 
<tbody>
    <?php session_start(); ?>
    <tr><td>Nom d'utilisateur</td><td>".$_SESSION['nomduti']."</td></tr>
    <tr><td>Prénom</td><td>".$_SESSION['prenom']."</td></tr>
    <tr><td>Nom</td><td>".$_SESSION['nom']."</td></tr>
    <tr><td>Date de naissance</td><td>".$_SESSION['date']."</td></tr>
    <tr><td>Nombre d'abonnés</td><td>".$_SESSION['abonnes']."</td></tr>
    <tr><td>Nombre de comptes suivis</td><td>".$_SESSION['suivis']."</td></tr>
</tbody>
</table>
    <div class=\"center2\">
    <a href=\"modification.php\"><button type=\"button\" class=\"buttons1\">Modifier mes données</button></a>&nbsp &nbsp &nbsp
    <a href=\"deconnect.php\"><button type=\"button\" class=\"buttons2\">Me déconnecter</button></a>&nbsp &nbsp &nbsp
    <a href=\"http://localhost/projet/mespublications.php\"><button type=\"button\" class=\"buttons1\">Mes questions</button></a><br><br>
    <a href=\"supprimer.php\"><button type=\"button\" class=\"buttons2\">Effacer mon compte</button></a>&nbsp &nbsp &nbsp
    <a href=\"photosDeProfile/index.php\"><button type=\"button\" class=\"buttons2\">Photo de profile</button></a><br><br>
    </div>
</body>
</html>
";}
