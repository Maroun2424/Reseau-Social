<!-- Sur cette page, la sauvegarde a lieu après l'inscription-->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Sauvegarde de la page d'acceuil</title>
        <link rel ="stylesheet" href ="sauvegarde.css">
    </head>
    <body>
        <?php if(!isset($_SESSION)){session_start();};
            if ((empty($_POST['nomduti']))||(empty($_POST['prenom']))||(empty($_POST['nom']))||(empty($_POST['date']))||(empty($_POST['email']))||(empty($_POST['mdp']))){
                echo '<script type="text/javascript">alert("Il y au moins un des champs que vous n\'avez pas remplis.")</script>';
                include_once('inscription.php');
            }else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ //vérification de l'adresse mail
                echo '<script type="text/javascript">alert("L\'adresse mail est invalide.")</script>';
                include_once('inscription.php');
            }else{
                $connexion = mysqli_connect ('127.0.0.1','root','','projet');
                $pseudo=mysqli_real_escape_string($connexion,$_POST['nomduti']);
                $prenom=mysqli_real_escape_string($connexion,$_POST['prenom']);
                $nom=mysqli_real_escape_string($connexion,$_POST['nom']);
                $date=mysqli_real_escape_string($connexion,$_POST['date']);
                $email=mysqli_real_escape_string($connexion,$_POST['email']);
                $mdp=mysqli_real_escape_string($connexion,$_POST['mdp']);
                $mdphash=password_hash($mdp, PASSWORD_DEFAULT);
                $select_1 = mysqli_query($connexion, "SELECT * FROM users WHERE pseudo = '".$_POST['nomduti']."'");
                $select_2 = mysqli_query($connexion, "SELECT * FROM users WHERE mail = '".$_POST['email']."'");
                if(mysqli_num_rows($select_1)) {
                    echo '<script type="text/javascript">alert("Ce nom d\'utilisateur est déjà pris.")</script>'; //le pseudo doit être unique
                    include_once('inscription.php');
                }else if(mysqli_num_rows($select_2)) {
                    echo '<script type="text/javascript">alert("Un compte à déjà été créé avec cette adresse mail.")</script>'; //un compte par adresse mail
                    include_once('inscription.php');
                }else{
                    $req='INSERT INTO users (prenom, nom, pseudo, mail, naissance, password) VALUES (\''.$prenom.'\',\''.$nom.'\',\''.$pseudo.'\',\''.$email.'\',\''.$date.'\',\''.$mdphash.'\');'; //j'ajoute l'utilisateur à ma base de données
                    $resultat = mysqli_query ($connexion,$req);
                    if ($resultat){
                        echo "<div class=\"tete\"><img src=\"images/logo.png\" alt=\"logo\" width=\"180\" height=\"180\"></div>";
                        echo "<h1>";
                        echo "Inscription réussie!<br>"; 
                        echo "</h1>";
                        echo "<a href=\"http://localhost/projet/connexion.php\"> Me connecter</a>";
                    }
                }
            }?> 
    </body>
</html>