<!-- Sur cette page, un utilisateur peut voir la liste de toutes ses questions posées -->
<?php include('pagedac.php'); ?> <br><br>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Mes questions</title>
        <link rel ="stylesheet" href ="mespublications.css">
    </head>
    <body>
        <?php if (!isset($_SESSION)){session_start();}
        if (isset($_SESSION['nomduti'])){
            echo "<table class=\"table1\"><tr><td>Questions de ".$_SESSION['nomduti']."</td></tr></table>";
            $connexion = mysqli_connect ('127.0.0.1','root','','projet');
            $req='SELECT * from question WHERE question_de=\''.$_SESSION['id'].'\';'; //je trouve les questions posées par l'utilisateur connecté
            $resultat=mysqli_query ($connexion,$req);
            $tab=mysqli_fetch_assoc($resultat);
            if (mysqli_num_rows($resultat) > 0){ //si au moins une question a été posée par cet utilisateur...
                foreach($resultat as $tab){
                    $recherche2='SELECT * FROM users WHERE id = \''.$_SESSION['id'].'\''; //je trouve l'utilisateur connecté
                    $resultat2 = mysqli_query ($connexion,$recherche2);
                    $tab2=mysqli_fetch_assoc($resultat2);

                    $recherche3='SELECT * FROM publication WHERE post_question = \''.$tab['question_id'].'\'LIMIT 1'; //je cherche le contenu de la question dans le tableau 'publication' et je limite ma recherche à 1 car la première publication reliée à $tab['question_id'] est la question tandis que les autres sont les réponses
                    $resultat3 = mysqli_query ($connexion,$recherche3); 
                    $tab3=mysqli_fetch_assoc($resultat3);

                    $recherche4='SELECT * FROM themes WHERE theme_id = \''.$tab['question_categorie'].'\''; //je cherche le thème de chaque question pour afficher l'icone correspondante à chaque fois (à côté de la photo de profile)
                    $resultat4 = mysqli_query ($connexion,$recherche4);
                    $tab4=mysqli_fetch_assoc($resultat4);

                    $recherche5='SELECT * FROM publication WHERE post_question = \''.$tab['question_id'].'\''; //je fais cette requête afin de compter le nombre de réponses donc je ne me limite pas à 1 comme pour $recherche3
                    $resultat5 = mysqli_query ($connexion,$recherche5);
                    $reponses=-1; //je ne veux pas compter la question donc le compte commence à -1 sachant que la question est stockée avec les réponses dans le tableau 'publication' en SQL
                    $resp="";
                    foreach($resultat5 as $tab5){
                        $reponses++;
                    }
                    if ($reponses>1){
                        $resp="réponses";
                    }else{
                        $resp="réponse";
                    }
                    echo "<br><table class=\"table2\">
                        <thead class=\"thead\"> 
                            <tr>
                                <td><img align=center src=\"http://localhost/projet/images/themes/".$tab4['theme_icon']."\" height=\"30\" width=\"30\"/>&nbsp<img align=center src=\"http://localhost/projet/photosDeProfile/photos/".$tab2['photo']."\" height=\"25\" width=\"25\"/>&nbsp&nbsp@".$tab2['pseudo']."</td>
                            </tr>
                        </thead> 
                    <tbody class=\"tbody\">
                        <?php session_start(); ?>
                        <tr><td><strong>Titre:</strong>&nbsp&nbsp ".$tab['question_sujet']."</td>
                        <tr><td><strong>Question:</strong>&nbsp&nbsp ".$tab3['post_contenu']."</td></tr>
                        <tr><td style=text-align:right>".$tab3['post_date']."</td></tr>
                        <tr><td><a href=\"voirreponses.php?question_id=".$tab['question_id']."\">".$reponses." ".$resp."</td></tr>
                        <tr><td><div class=\"center\"><a href=\"effacerquestion.php?question_id=".$tab['question_id']."\"><button type=\"button\" class=\"buttons\">Effacer cette question</button></div></a></td></tr>
                    </tbody>
                    </table><br>";
                }
            }else{
                echo "<br><h1>Vous avez posé 0 questions, ".$_SESSION['prenom'].".</h1>";
            }
        }?>
    </body>
</html>



