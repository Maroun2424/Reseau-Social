<!DOCTYPE html> <!-- Sur cette page, on vérifie si l'utilisateur a déjà une photo de profile. Si c'est le cas on a choisit de ne pas lui donner le choix de la modifier, sinon il a le droit d'en choisir une -->
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Ajouter une photo de profile</title>
        <link rel ="stylesheet" href ="uploadd.css">
        <div class="tete">
            <img src="http://localhost/projet/images/logo.png" alt="logo" width="150" height="150">
        </div>
    </head>
    <body>
        <?php 
        if(!isset($_SESSION)){session_start();}
        if (isset($_SESSION['nomduti'])){
            if (isset($_SESSION['photo'])&&$_SESSION['photo']!='icon.png'){
                echo "<div class=\"center\">";
                echo "Vous avez déjà une photo de profile, ".$_SESSION['nomduti'].":<br><br>";
                echo "<img src=\"http://localhost/projet/photosDeProfile/photos/".$_SESSION['photo']."\" height=\"100\" width=\"100\"/><br><br>";
                    echo "Cliquez <a href=\"http://localhost/projet/moncompte.php\">ici</a> pour retourner à ton profil.";
                    echo "</div>";
            }else{
                if (isset($_SESSION['nomduti'])){
                    echo "<form action=\"upload.php\" method=\"post\" enctype=\"multipart/form-data\">
                    <div class=\"center\">
                    <input type=\"file\" name=\"image[]\" class=\"fields\"/>
                    <button type=\"submit\" class=\"buttons\">Choisir ce fichier</button>
                    </div>
                    </form>";
                }
            }
        }else{
            echo "<h1>Vous n'êtes pas connectés, cliquez <a href=\"http://localhost/projet/bienvenue.php\">ici</a> pour aller à la page d'accueil.</h1>";
        }
        ?>
    </body>
</html>