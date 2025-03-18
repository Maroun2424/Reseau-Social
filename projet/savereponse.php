<!-- Sur cette page, la sauvegarde d'une réponse a lieu-->
<?php include_once('pagedac.php'); if (!isset($_SESSION)){session_start();};?>
<br><br><br>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Sauvegarde de réponse</title>
        <link rel ="stylesheet" href ="savequestion.css">
    </head>
    <body>
        <?php if (isset($_SESSION['nomduti'])){
            if ((empty($_POST['reponse']))){
                echo '<script type="text/javascript">alert("Votre réponse est vide.")</script>';
                include_once('repondrequestion.php');
            }else{
                    $connexion = mysqli_connect ('127.0.0.1','root','','projet');
                    $req='INSERT INTO publication (post_contenu, post_date, post_question, post_de) VALUES (\''.mysqli_real_escape_string($connexion,$_POST['reponse']).'\', now(),\''.$_GET['question_id'].'\',\''.$_SESSION['id'].'\');'; //réponse associée à l'id de la question de base
                    $resultat = mysqli_query ($connexion,$req);
                    if (!$resultat){
                        echo '<script type="text/javascript">alert("Une erreur s\'est produite et votre réponse n\'a pas été enregistrée.")</script>';
                        include_once('repondrequestion.php');
                    }else{
                        echo "<h1>Votre question à été enregistrée avec succès.</h1>";
                        echo "<table>
                            <thead> 
                                <tr>
                                    <td><img align=center src=\"http://localhost/projet/photosDeProfile/photos/".$_SESSION['photo']."\" height=\"35\" width=\"35\"/>&nbsp&nbsp@".$_SESSION['nomduti']."</td>
                                </tr>
                            </thead> 
                        <tbody>
                            <?php session_start(); ?>
                            <tr><td><strong>Réponse:</strong>&nbsp&nbsp ".$_POST['reponse']."</td></tr>
                        </tbody>
                        </table>";
                        echo "<h1>Cliquez <a href=\"http://localhost/projet/actu.php\">ici</a> pour retourner au fil d'actualité.</h1>";
                    }
                }
            }
        ?>
    </body>
</html>