<?php include_once('pagedac.php'); if (!isset($_SESSION)){session_start();};?>
<br><br><br><br>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel ="stylesheet" href ="question.css">
</head>
<body>
<?php
 echo "<div class=\"center\"> <img src=\"http://localhost/projet/photosDeProfile/photos/".$_SESSION['photo']."\" height=\"80\" width=\"80\"/></div>"?><br>
<table>
    <thead> 
        <tr>
            <td colspan="2">Nouvelle question de <?php echo $_SESSION['prenom']?></td>
        </tr>
    </thead> 
<tbody>
    <form action="savequestion.php" method="post">
    <tr><td>Titre de ta publication</td><td><?php echo "<input type=\"text\" name=\"titre\"  class=\"fields1\">";?> <br></td></tr>
    <tr><td>Thème</td><td><?php echo "<select name=\"theme\" class=\"fields1\">";
    $connexion = mysqli_connect ('127.0.0.1','root','','projet');
    $req ='SELECT * FROM themes;';
    $resultat = mysqli_query ($connexion,$req);
    foreach($resultat as $tab){
        echo "<option value=\"";
        echo $tab['theme_id'];
        echo "\">";
        echo $tab['theme_nom'];
        echo "</option>";
    }
    echo "</select>"
    ?> <br> </td></tr>
    <tr><td>Question</td><td><?php echo "<textarea name=\"question\" class=\"fields2\"></textarea>";?> <br> </td></tr>
</tbody>
</table>
    <div class="center">
        <input type=submit value="Poser la question" class="buttons"/>
    </div>
</form>
</body>
<br><br>
</html>