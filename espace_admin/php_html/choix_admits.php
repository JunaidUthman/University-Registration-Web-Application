<?php
    if(isset($_POST["submit"])){
        if(isset($_POST["id_filiere"])){
            $_SESSION["id_filiere"]=$_POST["id_filiere"];
            $_SESSION["nbr_max"]=$_POST["nbr_max"];
            echo $_SESSION["id_filiere"];
            $_SESSION["nbr_max"];
        }
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/choix_admits.css">
    <title>orientation FST Tanger</title>
</head>
<body>

    
    <div class="container">
        <div class="box">
            <div class="titre">
                <h1>Donner le nombre des admits</h1>
            </div>
            <div class="form_container">
                <form action="choix_admits.php" method="post">
                    <div class="info">
                        <div class="email">
                            <label class="text_email">Nombre des Admits :</label><br>
                            <input type="number" name="nbr_max"  required class="input_email"><br>
                        </div>
                        <input type="submit" name="submit" value="Se connecter" class="input_envoyer">
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
