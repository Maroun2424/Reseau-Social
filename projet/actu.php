<?php include_once('pagedac.php'); ?>
<!-- Sur cette page, on créé le fil d'actualité personnalisé de chaque utilisateur en fonction des comptes auxquels il est abonné -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Fil d'actualité</title>
        <link rel ="stylesheet" href ="actuU.css">
    </head>
    <body>
        <?php 
        echo "<br><br>"; 
        if (!isset($_SESSION)){session_start();}
        if (isset($_SESSION['nomduti'])){
            echo "<h1>Fil d'actualité de ".$_SESSION['nomduti']."</h1>";
            $user=$_SESSION['id'];
            $connexion = mysqli_connect ('127.0.0.1','root','','projet');
            $req ='SELECT * FROM abonnement WHERE follower_id = \''.$user.'\';';
            $resultat = mysqli_query ($connexion,$req);
            $suivis=array();
            foreach($resultat as $tab){
                array_push($suivis,$tab['followed_id']);
            }if (empty($suivis)){
                echo "<div class=\"center\"><h2>Vous ne suivez aucun compte pour le moment.</h2></div>";
            }else{
                $recherche='SELECT * FROM question ORDER BY question_date DESC;';
                $resultat2 = mysqli_query ($connexion,$recherche);
                foreach($resultat2 as $tab2){
                    if (in_array($tab2['question_de'],$suivis)){
                    echo "<table>";
                        $recherche3='SELECT * FROM users WHERE id = \''.$tab2['question_de'].'\'';
                        $resultat3 = mysqli_query ($connexion,$recherche3);
                        $tab3=mysqli_fetch_assoc($resultat3);

                        $recherche4='SELECT * FROM publication WHERE post_question = \''.$tab2['question_id'].'\' LIMIT 1';
                        $resultat4 = mysqli_query ($connexion,$recherche4);
                        $tab4=mysqli_fetch_assoc($resultat4);

                        $recherche5='SELECT post_id FROM publication WHERE post_question = \''.$tab2['question_id'].'\'';
                        $resultat5 = mysqli_query ($connexion,$recherche5);
                        $reponses=-1;
                        $resp="";
                        foreach($resultat5 as $tab5){
                            $reponses++;
                        }
                        if ($reponses>1){
                            $resp="réponses";
                        }else{
                            $resp="réponse";
                        }

                        $recherche6='SELECT * FROM themes WHERE theme_id = \''.$tab2['question_categorie'].'\'';
                        $resultat6 = mysqli_query ($connexion,$recherche6);
                        $tab6=mysqli_fetch_assoc($resultat6);

                        echo "<br><table class=\"table2\">
                            <thead class=\"thead\"> 
                                <tr>
                                    <td><img align=center src=\"http://localhost/projet/images/themes/".$tab6['theme_icon']."\" height=\"40\" width=\"40\"/>&nbsp<img align=center src=\"http://localhost/projet/photosDeProfile/photos/".$tab3['photo']."\" height=\"35\" width=\"35\"/>&nbsp&nbsp@".$tab3['pseudo']."</td>
                                </tr>
                            </thead> 
                        <tbody class=\"tbody\">
                            <?php session_start(); ?>
                            <tr><td><strong>Titre:</strong>&nbsp&nbsp ".$tab2['question_sujet']."</td>
                            <tr><td><strong>Question:</strong>&nbsp&nbsp ".$tab4['post_contenu']."</td></tr>
                            <tr><td style=text-align:right>".$tab4['post_date']."</td></tr>
                            <tr><td><a href=\"voirreponses.php?question_id=".$tab2['question_id']."\">".$reponses." ".$resp."</td></tr>";
                            if ($tab3['pseudo']!=$_SESSION['nomduti']){
                                echo "<tr><td><div class=\"center\"><a href=\"repondrequestion.php?question_id=".$tab2['question_id']."\"><button type=\"button\" class=\"buttons\">Répondre</button></a> &nbsp &nbsp";
                            }if ($_SESSION['admin']==1){
                                echo "<a href=\"effacerquestionadmin.php?question_id=".$tab2['question_id']."\"><button type=\"button\" class=\"buttons\">Effacer</button></div></a></td></tr>";
                            }if ($_SESSION['admin']!=1){
                                echo "<a href=\"signaler.php?question_id=".$tab2['question_id']."\"><button type=\"button\" class=\"buttons\">Signaler</button></div></a></td></tr>";
                            }
                            echo "</tbody></table><br>";
                        }
                    }
                }
            }
    ?>
    </body>
</html>
