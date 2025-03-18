<link rel ="stylesheet" href ="effacerquestion.css">
<?php include_once('pagedac.php');
    echo "<br> <br><br><br><br>"; ?>
<body>
<?php session_start();
if (isset($_SESSION['nomduti'])){
    if (!isset($_POST['reponses']) &&(!isset($_POST['motdepasse']))&&isset($_GET['question_id'])){
        echo "<form action=\"effacerquestion.php?question_id=".$_GET['question_id']."\" method=\"post\">";
        echo "Êtes-vous surs de vouloir effacer cette question ".$_SESSION['nomduti']."? <br><br>";
        echo "<input type=\"radio\" name=\"reponses\" value=\"oui\"> Oui &nbsp";
        echo "<input type=\"radio\" name=\"reponses\" value=\"non\"> Non <br><br>";
        echo  "<input type=\"submit\" name=\"action\" class=\"buttons\">";
        echo "</form>";
    }else if ((isset($_POST['reponses']))&&($_POST['reponses']=="oui") && (!isset($_POST['motdepasse']))){
        echo "<form action=\"effacerquestion.php?question_id=".$_GET['question_id']."\" method=\"post\">";
        echo "Écrivez votre mot de passe pour confirmer la suppression de la question. <br><br>";
        echo "<input type=\"password\" name=\"motdepasse\"><br><br>";
        echo "<input type=\"submit\" name=\"action\" class=\"buttons\">";
        echo "</form>";
    }else if ((isset($_POST['motdepasse']))){
        if (password_verify($_POST['motdepasse'],$_SESSION['mdp'])){
            supprimer();
            echo "Clique <a href=\"http://localhost/projet/moncompte.php\">ici</a> pour retourner à ta page profile.";
        }else{
            echo "Ce mot de passe ne convient pas, aucune question n'a été supprimée.";
            echo "<br>Clique <a href=\"http://localhost/projet/moncompte.php\">ici</a> pour retourner à ta page profile.";
        }
    }else{
        echo "Aucune question n'a été supprimée.<br>";
        echo "Clique <a href=\"http://localhost/projet/moncompte.php\">ici</a> pour retourner ta page profile.";
    }
}else{
    echo "Vous n'êtes pas connectés.<br>";
    echo "Cliquez <a href=\"http://localhost/projet/bienvenue.php\">ici</a> pour aller à la page d'accueil.";
}
function supprimer(){
    if (isset($_GET['question_id'])){
        $connexion = mysqli_connect ('127.0.0.1','root','','projet');
        $req='DELETE FROM question WHERE question_id = \''.$_GET['question_id'].'\'';
        $resultat = mysqli_query ($connexion,$req);
        echo "Question supprimée. <br>";
    }else{
        echo "Il y a eu un problème.";
    }
}
?>
</body>