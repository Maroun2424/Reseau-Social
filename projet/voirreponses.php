<!-- Sur cette page, on peut voir les réponses à une question grâce à $_GET['question_id']-->
<link rel ="stylesheet" href ="theme.css">
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Voir réponses</title>
    </head>
    <body>
        <?php include_once('pagedac.php');
        echo "<br> <br> <br><br>"; 
        if (!isset($_SESSION)){session_start();}
        if (isset($_SESSION['nomduti'])){
            $question=$_GET['question_id'];
            $connexion = mysqli_connect ('127.0.0.1','root','','projet');

            $recherche2='SELECT * FROM question WHERE question_id = \''.$question.'\''; //je trouve la question
            $resultat2 = mysqli_query ($connexion,$recherche2);
            $tab2=mysqli_fetch_assoc($resultat2);

            $recherche4='SELECT * FROM publication WHERE post_question = \''.$question.'\' LIMIT 1';
            $resultat4 = mysqli_query ($connexion,$recherche4); //je trouve son contenu
            $tab4=mysqli_fetch_assoc($resultat4);

            $recherche5='SELECT * FROM users WHERE id = \''.$tab4['post_de'].'\' LIMIT 1';
            $resultat5 = mysqli_query ($connexion,$recherche5); //je trouve la personne l'ayant rédigée (limit 1 car c'est la première personne à avoir rédigé une publication pour l'id de la question)
            $tab5=mysqli_fetch_assoc($resultat5);

            $req ='SELECT * FROM publication WHERE post_question = \''.$question.'\' AND post_de !='.$tab5['id'].';'; //je trouve les utilisateurs qui ont répondu
            $resultat = mysqli_query ($connexion,$req);
            echo "<h1>Question:</h1>";
            echo "<br><table class=\"table2\">
                        <thead class=\"thead\"> 
                            <tr>
                                <td><img align=center src=\"http://localhost/projet/photosDeProfile/photos/".$tab5['photo']."\" height=\"35\" width=\"35\"/>&nbsp&nbsp@".$tab5['pseudo']."</td>
                            </tr>
                        </thead> 
                    <tbody class=\"tbody\">
                        <?php session_start(); ?>
                        <tr><td><strong>Titre:</strong>&nbsp&nbsp ".$tab2['question_sujet']."</td>
                        <tr><td><strong>Question:</strong>&nbsp&nbsp ".$tab4['post_contenu']."</td></tr>
                        <tr><td style=text-align:right>".$tab2['question_date']."</td></tr>
                    </tbody>
                    </table><br>";
            if (mysqli_num_rows($resultat) > 0){
                echo "<h1>Réponses:</h1>";
                echo "<table>";
                foreach($resultat as $tab){
                    $recherche3='SELECT * FROM users WHERE id = \''.$tab['post_de'].'\''; //je séléctionne chaque utilisateur à son tour
                    $resultat3 = mysqli_query ($connexion,$recherche3);
                    $tab3=mysqli_fetch_assoc($resultat3);

                    echo "<br><table class=\"table2\">
                        <thead class=\"thead\"> 
                            <tr>
                                <td><img align=center src=\"http://localhost/projet/photosDeProfile/photos/".$tab3['photo']."\" height=\"35\" width=\"35\"/>&nbsp&nbsp@".$tab3['pseudo']."</td>
                            </tr>
                        </thead> 
                    <tbody class=\"tbody\">
                        <?php session_start(); ?>
                        <tr><td><strong>Réponse:</strong>&nbsp&nbsp ".$tab['post_contenu']."</td></tr>
                        <tr><td style=text-align:right>".$tab['post_date']."</td></tr>";
                        if ($_SESSION['id']==$tab3['id']){
                            echo "<tr><td><div class =\"center\"><a href=\"effacerreponse.php?post_id=".$tab['post_id']."\"><button type=\"button\" class=\"buttons\">Effacer</button></div></a></div></td></tr>";
                        }
                    echo "</tbody>
                    </table><br>";
                }
            }else{
                echo "<h1>Aucune réponse à cette question n'a été rédigée.</h1>";
            }
        }?>
    </body>
</html>
