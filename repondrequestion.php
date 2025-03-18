<?php include_once('pagedac.php');
    echo "<br> <br> <br><br>"; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel ="stylesheet" href ="question.css">
</head>
<body>
<?php
 if (!isset($_SESSION)){session_start();}
 echo "<div class=\"center\"> <img src=\"http://localhost/projet/photosDeProfile/photos/".$_SESSION['photo']."\" height=\"80\" width=\"80\"/></div>"?><br>
 <?php
    $connexion = mysqli_connect ('127.0.0.1','root','','projet');
    $req ='SELECT * FROM question WHERE question_id='.$_GET['question_id'].';';
    $resultat = mysqli_query ($connexion,$req);
    $tab=mysqli_fetch_assoc($resultat);

    $req2 ='SELECT * FROM users WHERE id='.$tab['question_de'].';';
    $resultat2 = mysqli_query ($connexion,$req2);
    $tab2=mysqli_fetch_assoc($resultat2);

    $req3 ='SELECT * FROM publication WHERE post_question='.$tab['question_id'].' LIMIT 1;';
    $resultat3 = mysqli_query ($connexion,$req3);
    $tab3=mysqli_fetch_assoc($resultat3);?>

<h1>Question de <?php echo $tab2['pseudo']?> : <?php echo $tab3['post_contenu']?></h1>
<table class="tab">
    <thead> 
        <tr>
            <td colspan="2">Réponse de <?php echo $_SESSION['prenom']?> à la question de <?php echo $tab2['pseudo']?></td>
        </tr>
    </thead> 
<tbody> <?php
    echo "<form action=\"savereponse.php?question_id=".$_GET['question_id']."\" method=\"post\">";?>
    <tr><td>Réponse</td><td><?php echo "<textarea name=\"reponse\" class=\"fields3\"></textarea>";?> <br> </td></tr>
</tbody>
</table>
    <div class="center">
        <input type=submit value="Envoyer la réponse" class="buttons"/>
    </div>
</form>
</body>
<br><br>
</html>

