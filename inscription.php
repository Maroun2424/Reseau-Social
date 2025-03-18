<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel ="stylesheet" href ="inscription.css">
</head>
<body>
    <div class="tete">
        <img src="images/logo.png" alt="logo" width="150" height="150">
    </div>
<table>
    <thead> 
        <tr>
            <td colspan="2">Formulaire D'inscription</td>
        </tr>
    </thead> 
<tbody>
    <form action="sauvegarde.php" method="post">
    <tr><td>Nom d'utilisateur</td><td><?php echo "<input type=\"text\" name=\"nomduti\"  class=\"fields\">";?> <br> </td></tr>
    <tr><td>Prénom</td><td><?php echo "<input type=\"text\" name=\"prenom\" class=\"fields\">";?> <br> </td></tr>
    <tr><td>Nom</td><td><?php echo "<input type=\"text\" name=\"nom\" class=\"fields\">";?> <br> </td></tr>
    <tr><td>Date de naissance</td><td><?php echo "<input type=\"date\" name=\"date\" class=\"fields\" >";?> <br> </td></tr>
    <tr><td>Courriel</td><td><?php echo "<input type=\"email\" name=\"email\" class=\"fields\" >";?> <br> </td></tr>
    <tr><td>Mot de passe</td><td><?php echo "<input type=\"password\" name=\"mdp\" class=\"fields\">";?> <br> </td></tr>
</tbody>
</table>
    <div class="center">
        <input type=submit value="Envoyer" class="buttons"/>
    </div>
</form>
    <h3 class="croisons">Croisons nos pensées, pour tous nous cultiver!</h3>
</body>
</html>