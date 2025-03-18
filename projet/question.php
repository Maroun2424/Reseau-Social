<!-- Sur cette page, un utilisateur peut poser une question avec un formulaire POST qui renvoie vers 'savequestion.php'-->
<?php include_once('pagedac.php'); if (!isset($_SESSION)){session_start();};?>
<br><br><br><br>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Question</title>
        <link rel ="stylesheet" href ="question.css">
    </head>
    <body>
        <?php 
        if (isset($_SESSION['nomduti'])){
            echo "<div class=\"center\"> <img src=\"http://localhost/projet/photosDeProfile/photos/".$_SESSION['photo']."\" height=\"80\" width=\"80\"/></div><br>
            <form action=\"savequestion.php\" method=\"post\">
            <table>
                <thead> 
                    <tr>
                        <td colspan=\"2\">Nouvelle question de ".$_SESSION['prenom']."</td>
                    </tr>
                </thead> 
                <tbody>
                    <tr><td>Titre de ta publication</td><td><input type=\"text\" name=\"titre\"  class=\"fields1\"><br></td></tr>
                    <tr><td>Thème</td><td><select name=\"theme\" class=\"fields1\">";
                    $connexion = mysqli_connect ('127.0.0.1','root','','projet');
                    $req ='SELECT * FROM themes;'; //pour afficher la liste des thèmes choisissables
                    $resultat = mysqli_query ($connexion,$req);
                    foreach($resultat as $tab){
                        echo "<option value=\"";
                        echo $tab['theme_id'];
                        echo "\">";
                        echo $tab['theme_nom'];
                        echo "</option>";
                    }
                    echo "</select> <br> </td></tr>
                    <tr><td>Question</td><td><textarea name=\"question\" class=\"fields2\"></textarea> <br> </td></tr>
                </tbody>
            </table>
                <div class=\"center\">
                    <input type=submit value=\"Poser la question\" class=\"buttons\"/>
                </div>
            </form>";
                };?>
    </body>
    <br><br>
</html>