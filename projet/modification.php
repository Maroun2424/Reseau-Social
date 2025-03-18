<!-- Sur cette page, un utilisateur peut modifier ces données -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Modifier</title>
        <link rel ="stylesheet" href ="modification.css">
        <div class="tete">
            <img src="images/logo.png" alt="logo" width="150" height="150">
        </div>
    </head>
    <body>
        <?php if(!isset($_SESSION)){session_start();};
            function printing(){
                $v1=$_SESSION['nomduti'];
                $v2=$_SESSION['prenom'];
                $v3=$_SESSION['nom'];
                $v4=$_SESSION['date'];
                $v5=$_SESSION['mdp']; //je n'affiche pas cette valeur car elle est cachée dans tous les cas
                echo "<form action=\"modification.php\" method=\"post\">";
                echo "<table>";
                echo "<thead><tr><td colspan=\"2\">Modifier mes données</td></tr></thead>";
                echo  "<tr><td>Votre pseudo:</td><td><input type=\"text\" name=\"pseudore\" value=\"".$v1."\" class=\"fields\" ><br> </td></tr>";
                echo  "<tr><td>Votre prénom:</td><td><input type=\"text\" name=\"prenomre\" value=\"".$v2."\" class=\"fields\"><br> </td></tr>";
                echo  "<tr><td>Votre nom:</td><td><input type=\"text\" name=\"nomre\" value=\"".$v3."\" class=\"fields\"><br> </td></tr>";
                echo  "<tr><td>Votre date de naissance:</td><td><input type=\"date\" name=\"datere\" value=\"".$v4."\" class=\"fields\"><br> </td></tr>";
                echo  "<tr><td>Votre mot de passe:</td><td><input type=\"password\" name=\"mdpre\" class=\"fields\"><br> </td></tr>";
                echo "</table>";
                echo "<div class=\"center\"><input type=submit value=\"Confirmer les nouvelles données\" class=\"buttons\" class=\"fields\"/></div>";
            }

            function modif(){
                $connexion = mysqli_connect ('127.0.0.1','root','','projet');
                $req='UPDATE users SET pseudo=\''.$_POST['pseudore'].'\', prenom=\''.$_POST['prenomre'].'\', nom=\''.$_POST['nomre'].'\', naissance=\''.$_POST['datere'].'\', password=\''.password_hash($_POST['mdpre'], PASSWORD_DEFAULT).'\' WHERE pseudo=\''.$_SESSION['nomduti'].'\';'; //tout est mis à jour dans SQL
                $resultat = mysqli_query ($connexion,$req);
                if ($resultat){
                    $_SESSION['nomduti']=$_POST['pseudore'];
                    $_SESSION['prenom']=$_POST['prenomre'];
                    $_SESSION['nom']=$_POST['nomre'];
                    $_SESSION['date']=$_POST['datere'];
                    $_SESSION['mdp']=password_hash($_POST['mdpre'], PASSWORD_DEFAULT);
                }
            }

            if ((isset($_SESSION['nomduti'])&&isset($_SESSION['nom'])&&isset($_SESSION['prenom'])&&isset($_SESSION['mdp'])&&isset($_SESSION['date']))&&(!isset($_POST['pseudore'])&&(!isset($_POST['prenomre']))&&(!isset($_POST['nomre']))&&(!isset($_POST['datere']))&&(!isset($_POST['mdpre'])))){
                printing();
            }
            else if((!isset($_SESSION['nomduti'])&&!isset($_SESSION['nom'])&&!isset($_SESSION['prenom'])&&!isset($_SESSION['mdp'])&&!isset($_SESSION['date']))){
                echo "<h1>Vous nêtes pas connectés à un compte.<br>";
                echo "Cliquez <a href=\"http://localhost/projet/inscription.php\">ici</a> pour créer un compte.<br>";
                echo "Cliquez <a href=\"http://localhost/projet/connexion.php\">ici</a> pour te connecter à ton compte.</h1><br>";
            }
            else if ((isset($_SESSION['nomduti'])&&isset($_SESSION['nom'])&&isset($_SESSION['prenom'])&&isset($_SESSION['mdp'])&&isset($_SESSION['date']))&&(empty($_POST['pseudore'])||(empty($_POST['prenomre']))||(empty($_POST['nomre']))||(empty($_POST['datere']))||(empty($_POST['mdpre'])))){
                echo '<script type="text/javascript">alert("Il y a au moins un des champs qui n\'a pas été rempli.")</script>';
                printing();
            }
            else if ((isset($_SESSION['nomduti'])&&isset($_SESSION['nom'])&&isset($_SESSION['prenom'])&&isset($_SESSION['mdp'])&&isset($_SESSION['date']))&&isset($_POST['pseudore'])&&(isset($_POST['prenomre']))&&(isset($_POST['nomre']))&&(isset($_POST['datere']))&&(isset($_POST['mdpre']))){
                modif();
                printing();
                echo "<br>Les modifications ont été faites. Clique <a href=\"http://localhost/projet/welcome.php\">ici</a> pour retourner à la page d'accueil.";
            }?>
    </body>
</html>