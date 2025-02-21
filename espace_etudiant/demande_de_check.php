<?php
include("data_base.php");
session_start();
if(!isset($_SESSION["email_verified"])){
    header("location:signin_etape1.php");
}
    if(isset($_POST["submit"])){
        $id=$_SESSION["id"];
        $code=$_POST["code"];
        $CheckCode=$db->prepare('SELECT * FROM etudiant WHERE id=:id');
        $CheckCode ->bindparam(":id",$id);
        if($CheckCode -> execute()){
            $rows= $CheckCode-> fetch();
            if (!empty($rows)){
                    if($code == $rows['code_verification']){
                 
                        $query = $db -> prepare('UPDATE etudiant SET verified=1 WHERE id=:id');
                        $query->bindparam(":id",$id);
                        $query->execute();
                        header('location:signin_etape2.php');
                    }
                    else{
                        echo "le code est incorrecte";
                    }

            }
            else{
                echo "there is no such id";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="demande_de_check.css">
    <title>orientation FST Tanger</title>
</head>
<body>
    <div class="container">
        <div class="box">
            <div class="form_container">
                <form action="demande_de_check.php" method="post">
                    <h2 class="demande_check">Nous allons vous envoyer un code par e-mail pour valider votre compte.</h2>
                    <h2 class="demande_code">Entrer le Code:</h2>
                    <input type="text" placeholder="- - - -" name="code" class="code_input" required>
                    <input type="submit" class="submit_input" name="submit" value="envoyer"><br>
                    
                </form>
            </div>
            <label class="NB">Si vous n'avez jamais reçu le code de vérification, vérifiez que votre adresse email est correcte :</label>
                    <a href="signin_etape1.php">S'inscrire</a>
        </div>
    </div>
    
</body>
</html>