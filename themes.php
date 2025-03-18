<link rel ="stylesheet" href ="themeE.css">
<?php include_once('pagedac.php');
    echo "<br> <br> <br><br>"; 
    if (!isset($_SESSION)){session_start();}
    $theme=$_GET['theme'];
    $connexion = mysqli_connect ('127.0.0.1','root','','projet');
    $req ='SELECT * FROM themes WHERE theme_nom = \''.$theme.'\'';
    $resultat = mysqli_query ($connexion,$req);
    $tab=mysqli_fetch_assoc($resultat);
    echo "<table class=\"table1\"><tr><td>
    <img src=\"http://localhost/projet/images/themes/".$tab['theme_icon']."\" height=\"100\" width=\"100\"/>
    </td></tr><tr><td>".$tab['theme_nom']."</td></tr></table>";
    $recherche='SELECT * FROM question WHERE question_categorie = \''.$tab['theme_id'].'\'';
    $resultat2 = mysqli_query ($connexion,$recherche);
    $tab2=mysqli_fetch_assoc($resultat2);
    if (mysqli_num_rows($resultat2) > 0){
        echo "<table>";
        foreach($resultat2 as $tab2){
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
            echo "<br><table class=\"table2\">
                <thead class=\"thead\"> 
                    <tr>
                        <td><img align=center src=\"http://localhost/projet/images/themes/".$tab['theme_icon']."\" height=\"40\" width=\"40\"/>&nbsp<img align=center src=\"http://localhost/projet/photosDeProfile/photos/".$tab3['photo']."\" height=\"35\" width=\"35\"/>&nbsp&nbsp@".$tab3['pseudo']."</td>
                    </tr>
                </thead> 
            <tbody class=\"tbody\">
                <?php session_start(); ?>
                <tr><td><strong>Titre:</strong>&nbsp&nbsp ".$tab2['question_sujet']."</td>
                <tr><td><strong>Question:</strong>&nbsp&nbsp ".$tab4['post_contenu']."</td></tr>
                <tr><td style=text-align:right>".$tab4['post_date']."</td></tr>
                <tr><td><a href=\"voirreponses.php?question_id=".$tab2['question_id']."\">".$reponses." ".$resp."</td></tr>";
                if ($tab3['pseudo']!=$_SESSION['nomduti']){
                    echo "<tr><td><div class=\"center\"><a href=\"repondrequestion.php?question_id=".$tab2['question_id']."\"><button type=\"button\" class=\"buttons\">Répondre</button></div></a></td></tr>";
                }
            echo "</tbody>
            </table><br>";
        }
    }
?>
