<!-- Sur cette page, un compte admin peut voir les signalements des utilisateurs -->
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
            $connexion = mysqli_connect ('127.0.0.1','root','','projet');

            $recherche1='SELECT * FROM signaler;'; 
            $resultat1 = mysqli_query ($connexion,$recherche1);
            if (mysqli_num_rows($resultat1) > 0){
                echo "<h1>Questions signalées:</h1>";
                foreach ($resultat1 as $tab1){

                $recherche2='SELECT * FROM question WHERE question_id = \''.$tab1['signal_question_id'].'\'';
                $resultat2 = mysqli_query ($connexion,$recherche2);
                $tab2=mysqli_fetch_assoc($resultat2);

                $recherche4='SELECT * FROM publication WHERE post_question = \''.$tab1['signal_question_id'].'\' LIMIT 1';
                $resultat4 = mysqli_query ($connexion,$recherche4); 
                $tab4=mysqli_fetch_assoc($resultat4);

                $recherche5='SELECT * FROM users WHERE id = \''.$tab4['post_de'].'\' LIMIT 1';
                $resultat5 = mysqli_query ($connexion,$recherche5);
                $tab5=mysqli_fetch_assoc($resultat5);

                $recherche6='SELECT * FROM users WHERE id = \''.$tab1['signal_de'].'\' LIMIT 1';
                $resultat6 = mysqli_query ($connexion,$recherche6);
                $tab6=mysqli_fetch_assoc($resultat6);

                echo "<h2>Question signalée:</h2>";
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
                
                echo "<h2>Signalement de ".$tab6['pseudo'].":</h2>";
                echo "<br><table class=\"table2\">
                            <thead class=\"thead\"> 
                                <tr>
                                    <td><img align=center src=\"http://localhost/projet/photosDeProfile/photos/".$tab6['photo']."\" height=\"35\" width=\"35\"/>&nbsp&nbsp@".$tab6['pseudo']."</td>
                                </tr>
                            </thead> 
                        <tbody class=\"tbody\">
                            <?php session_start(); ?>
                            <tr><td><strong>Motif:</strong>&nbsp&nbsp ".$tab1['signal_motif']."</td></tr>
                            <tr><td style=text-align:right>".$tab1['signal_date']."</td></tr>
                        </tbody>
                        </table><br>";
                        echo "<div class=\"center\"><a href=\"effacerquestionsignalee.php?question_id=".$tab2['question_id']."&signal_id=".$tab1['signal_id']."\"><button type=\"button\" class=\"buttons\">Effacer</button></td></tr>";
                        echo "<a href=\"ignorersignal.php?signal_id=".$tab1['signal_id']."\"><button type=\"button\" class=\"buttons\">Ignorer</button></div></a></td></tr></div><br><br>";
                }
            }else{
                echo "<h2>Il n'y a aucune question signalée pour le moment</h2>";
            }
        }?>
    </body>
</html>
