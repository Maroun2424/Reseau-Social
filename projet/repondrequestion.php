<!-- Sur cette page, l'utlisateur peut répondre à une question qui est retrouvée grâce à $_GET['question_id']-->
<?php include_once('pagedac.php');
echo "<br> <br> <br><br>"; ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Répondre</title>
        <link rel ="stylesheet" href ="question.css">
    </head>
    <body>
        <?php
        if (!isset($_SESSION)){session_start();}
        if (isset($_SESSION['nomduti'])){
            echo "<div class=\"center\"> <img src=\"http://localhost/projet/photosDeProfile/photos/".$_SESSION['photo']."\" height=\"80\" width=\"80\"/></div><br>";
                $connexion = mysqli_connect ('127.0.0.1','root','','projet');
                $req ='SELECT * FROM question WHERE question_id='.$_GET['question_id'].';'; //je trouve la question (id unique)
                $resultat = mysqli_query ($connexion,$req);
                $tab=mysqli_fetch_assoc($resultat);

                $req2 ='SELECT * FROM users WHERE id='.$tab['question_de'].';';
                $resultat2 = mysqli_query ($connexion,$req2); //je trouve celui qui a posé cette question
                $tab2=mysqli_fetch_assoc($resultat2);

                $req3 ='SELECT * FROM publication WHERE post_question='.$tab['question_id'].' LIMIT 1;';
                $resultat3 = mysqli_query ($connexion,$req3); //je trouve la question pour l'imprimer avant le formulaire de rédaction de la réponse
                $tab3=mysqli_fetch_assoc($resultat3);

            echo "<h1>Question de ". $tab2['pseudo']." : ". $tab3['post_contenu']."</h1>
            <table class=\"tab\">
                <thead> 
                    <tr>
                        <td colspan=\"2\">Réponse de ". $_SESSION['prenom']." à la question de ". $tab2['pseudo']."</td>
                    </tr>
                </thead> 
                <tbody>
                    <form action=\"savereponse.php?question_id=".$_GET['question_id']."\" method=\"post\">
                    <tr><td>Réponse</td><td><textarea name=\"reponse\" class=\"fields3\"></textarea> <br> </td></tr>
                </tbody>
            </table>
                <div class=\"center\">
                    <input type=submit value=\"Envoyer la réponse\" class=\"buttons\"/>
                </div>
            </form>";
        }?>
    </body>
    <br><br>
</html>

