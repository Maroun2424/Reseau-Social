<?php include('pagedac.php'); ?>
<link rel ="stylesheet" href ="themeE.css">
<br><br>

<?php
    if (!isset($_SESSION)){session_start();}
    echo "<table class=\"table1\"><tr><td>Questions de ".$_SESSION['nomduti']."</td></tr></table>";
    $connexion = mysqli_connect ('127.0.0.1','root','','projet');
    $req='SELECT * from question WHERE question_de=\''.$_SESSION['id'].'\';';
    $resultat=mysqli_query ($connexion,$req);
    $tab=mysqli_fetch_assoc($resultat);
    if (mysqli_num_rows($resultat) > 0){
        echo "<table>";
        foreach($resultat as $tab){
            $recherche2='SELECT * FROM users WHERE id = \''.$_SESSION['id'].'\'';
            $resultat2 = mysqli_query ($connexion,$recherche2);
            $tab2=mysqli_fetch_assoc($resultat2);

            $recherche3='SELECT * FROM publication WHERE post_question = \''.$tab['question_id'].'\'LIMIT 1';
            $resultat3 = mysqli_query ($connexion,$recherche3);
            $tab3=mysqli_fetch_assoc($resultat3);

            $recherche4='SELECT * FROM themes WHERE theme_id = \''.$tab['question_categorie'].'\'';
            $resultat4 = mysqli_query ($connexion,$recherche4);
            $tab4=mysqli_fetch_assoc($resultat4);
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
                <tr><td><div class=\"center\"><a href=\"effacerquestion.php?question_id=".$tab['question_id']."\"><button type=\"button\" class=\"buttons\">Effacer cette question</button></div></a></td></tr>
            </tbody>
            </table>";
        }
    }else{
        echo "<br><h1>Vous avez posé 0 questions, ".$_SESSION['prenom'].".</h1>";
    }
?>