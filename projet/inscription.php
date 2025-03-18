<!-- Sur cette page a lieu l'inscription au compte par le biais d'un formulaire POST qui renvoie vers le fichier 'sauvegarde.php' -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Inscription</title>
        <link rel ="stylesheet" href ="inscription.css">
        <div class="tete">
            <img src="images/logo.png" alt="logo" width="150" height="150">
        </div>
    </head>
    <body>
        <form action="sauvegarde.php" method="post">
        <table>
            <thead> 
                <tr>
                    <td colspan="2">Formulaire D'inscription</td>
                </tr>
            </thead> 
            <tbody>
                <tr><td>Nom d'utilisateur</td><td><input type="text" name="nomduti"  class="fields"><br> </td></tr>
                <tr><td>Prénom</td><td><input type="text" name="prenom" class="fields"><br> </td></tr>
                <tr><td>Nom</td><td><input type="text" name="nom" class="fields"><br> </td></tr>
                <tr><td>Date de naissance</td><td><input type="date" name="date" class="fields" ><br> </td></tr>
                <tr><td>Courriel</td><td><input type="email" name="email" class="fields" ><br> </td></tr>
                <tr><td>Mot de passe</td><td><input type="password" name="mdp" class="fields"><br> </td></tr>
            </tbody>
        </table>
        <div class="center">
            <input type=submit value="Envoyer" class="buttons"/>
        </div>
        </form>
        <h3 class="croisons">Croisons nos pensées, pour tous nous cultiver!</h3>
    </body>
</html>