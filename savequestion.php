<?php include_once('pagedac.php'); if (!isset($_SESSION)){session_start();};?>
<br><br><br>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel ="stylesheet" href ="savequestion.css">
</head>
<body>
<?php
if ((empty($_POST['titre']))||(empty($_POST['theme']))||(empty($_POST['question']))){
    echo '<script type="text/javascript">alert("Il y au moins un des champs que vous n\'avez pas remplis.")</script>';
    include_once('question.php');
}else{
    if (!isset($_SESSION)){session_start();}
        $connexion = mysqli_connect ('127.0.0.1','root','','projet');
        $req='INSERT INTO question (question_sujet, question_date, question_categorie, question_de) VALUES (\''.mysqli_real_escape_string($connexion,$_POST['titre']).'\', now(),\''.$_POST['theme'].'\',\''.$_SESSION['id'].'\');';
        $resultat = mysqli_query ($connexion,$req);
        if ($resultat){
            $id = mysqli_insert_id($connexion);
            $req2='INSERT INTO publication (post_contenu, post_date, post_question, post_de) VALUES (\''.mysqli_real_escape_string($connexion,$_POST['question']).'\', now(),\''.$id.'\',\''.$_SESSION['id'].'\');';
            $resultat2 = mysqli_query ($connexion,$req2);
            if (!$req2){
                echo '<script type="text/javascript">alert("Une erreur s\'est produite et votre question n\'a pas été enregistrée.")</script>';
                include_once('question.php');
            }else{
                $req3='SELECT * from themes WHERE theme_id=\''.$_POST['theme'].'\';';
                $resultat3=mysqli_query ($connexion,$req3);
                $tab=mysqli_fetch_assoc($resultat3);
                echo "<h1>Votre question à été enregistrée avec succès.</h1>";
                echo "<table>
                <thead> 
                    <tr>
                        <td><img align=center src=\"http://localhost/projet/images/themes/".$tab['theme_icon']."\" height=\"40\" width=\"40\"/>&nbsp<img align=center src=\"http://localhost/projet/photosDeProfile/photos/".$_SESSION['photo']."\" height=\"35\" width=\"35\"/>&nbsp&nbsp@".$_SESSION['nomduti']."</td>
                    </tr>
                </thead> 
            <tbody>
                <?php session_start(); ?>
                <tr><td><strong>Titre:</strong>&nbsp&nbsp ".$_POST['titre']."</td>
                <tr><td colspan=\"2\"><strong>Question:</strong>&nbsp&nbsp ".$_POST['question']."</td></tr>
            </tbody>
            </table>";
            }
        }else{
            echo '<script type="text/javascript">alert("Une erreur s\'est produite et votre question n\'a pas été enregistrée.")</script>';
            include_once('question.php');
        }
    }
?>