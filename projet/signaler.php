<!-- Sur cette page, l'utilisateur peut signaler une question-->
<link rel ="stylesheet" href ="supprimeR.css">
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Supprimer</title>
    </head>
    <body>
        <?php if(!isset($_SESSION)){session_start();};
        if (isset($_SESSION['nomduti'])){
            if (!isset($_POST['raison']) &&(!isset($_POST['motdepasse']))){ 
                echo "<form action=\"signaler.php?question_id=".$_GET['question_id']."\" method=\"post\">";
                echo "Pourquoi voulez-vous signaler cette question, ".$_SESSION['nomduti']."? <br><br>";
                echo "<input type=\"radio\" name=\"raison\" value=\"Question innapropriée\"> Question innapropriée <br>";
                echo "<input type=\"radio\" name=\"raison\" value=\"Question violente\"> Question violente<br>";
                echo "<input type=\"radio\" name=\"raison\" value=\"Question dont la réponse est évidente\"> Question dont la réponse est évidente <br>";
                echo "<input type=\"radio\" name=\"raison\" value=\"Question qui n'a pas de sens\"> Question qui n'a pas de sens <br><br>";
                echo  "<input type=\"submit\" name=\"action\" class=\"buttons\">";
                echo "</form>";
            }else if ((isset($_POST['raison']))){ 
                $connexion = mysqli_connect ('127.0.0.1','root','','projet');
                $req='INSERT INTO signaler (signal_question_id, signal_motif, signal_date, signal_de) VALUES (\''.$_GET['question_id'].'\',\''.mysqli_real_escape_string($connexion,$_POST['raison']).'\',now(),\''.$_SESSION['id'].'\')';
                $resultat = mysqli_query ($connexion,$req);
                echo "Question signalée. <br>";
                echo "Cliquez <a href=\"http://localhost/projet/actu.php\">ici</a> pour retourner au fil d'actualité.";
            }
        }else{
            echo "<br><h1>Vous n'êtes pas connectés, cliquez <a href=\"http://localhost/projet/bienvenue.php\">ici</a> pour aller à la page d'accueil.</h1>";
        }?>
    </body>
</html>