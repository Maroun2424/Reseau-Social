<!DOCTYPE html> <!-- Sur cette page, on s'occupe de la sauvegarde de la photo de profile de l'utilisateur. La fonction is_image vérifie que l'image a une extension correcte. Je me suis inspirée d'un tutoriel pour ajouter des fichiers sur SQL et PHP afin de trouver une façon efficace de procéder -->
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Ajouter une photo de profile</title>
        <link rel ="stylesheet" href ="uploadd.css">
    </head>
    <body>
        <?php
        if(!isset($_SESSION)){session_start();}
        if (isset($_SESSION['nomduti'])){
            if(isset($_FILES['image'])&&isset($_SESSION['nomduti'])){
                $connexion = mysqli_connect ('127.0.0.1','root','','projet');
                $trajectoire = "photos/";
                $aleatoire_temps=time();
                $nom=str_replace(' ','-',strtolower($_FILES['image']['name'][0])); //j'enlève les majuscules
                $type=$_FILES['image']['type'][0];

                if (empty($_FILES['image'])||!(isset($_FILES['image']))){
                    echo '<script type="text/javascript">alert("Vous n\'avez rien insérer")</script>';
                    include_once('index.php');
                }else{
                    if (is_image($type)){
                    $extension = substr($nom, strrpos($nom, '.'));
                    $extension = str_replace('.','',$extension);
                    $nom = preg_replace("/\.[^.\s]{3,4}$/", "", $nom); //j'enlève les espaces et d'autres motifs non souhaités (inspirée du manuel de preg_replace() sur Internet)
                    $nouveaunom = $nom.'-'.$aleatoire_temps.'.'.$extension;
                    $ret[$nouveaunom]= $trajectoire.$nouveaunom;

                    if (!file_exists($trajectoire)){
                        @mkdir($trajectoire, 0777);
                    }               
                    move_uploaded_file($_FILES["image"]["tmp_name"][0],$trajectoire."/".$nouveaunom );
                    $sql = 'UPDATE users SET photo=\''.$nouveaunom.'\' WHERE pseudo = \''.$_SESSION['nomduti'].'\';';
                    
                    if (mysqli_query($connexion, $sql)) {
                        $_SESSION['photo']=$nouveaunom;
                        echo "<div class=\"center\">";
                        echo "Voici votre photo de profile, ".$_SESSION['nomduti'].":<br><br>";
                        echo "<img src=\"http://localhost/projet/photosDeProfile/".$trajectoire.$nouveaunom."\" height=\"100\" width=\"100\"/><br><br>";
                        echo "Clique <a href=\"http://localhost/projet/moncompte.php\">ici</a> pour retourner à ton profil.";
                        echo "</div>";
                    }else {
                        echo "Error: " . $sql . "" . mysqli_error($cn);
                    }
                }else{
                    echo '<script type="text/javascript">alert("Ceci n\'est pas une image.")</script>';
                    include_once('index.php');
                }
            }
        }
    }else{
        echo "<br><h1>Vous n'êtes pas connectés, cliquez <a href=\"http://localhost/projet/bienvenue.php\">ici</a> pour aller à la page d'accueil.</h1>";
    }

    function is_image($type){     
        $extensions_possibles=array('image/jpg','image/jpe','image/jpeg','image/jfif','image/png','image/bmp','image/dib','image/gif');
        if(in_array($type, $extensions_possibles)){
            return true;
        }else{
            return false;
        }
    }?>
    </body>
</html>
