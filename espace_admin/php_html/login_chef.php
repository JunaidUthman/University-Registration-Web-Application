<?php
session_start();
    if(isset($_POST["submit"])){
        include("database.php");
        $email = $_POST["email"];
        $password=$_POST["password"];
        $query = $db -> prepare('SELECT * FROM chef_filiere WHERE email=:email');
        $query -> bindparam(":email",$email);
        $query -> execute();
        $row = $query -> fetch();
            if($row && password_verify($password,trim($row["password"]))){
                    echo "mrhba khoya chef";
                    $_SESSION["email"]=$email;
                    $_SESSION["id_chef"]=$row["id_chef"];
                    $_SESSION["id_filiere_fk"]=$row["id_filiere_fk"];
                    header("location:affichage_filiere_admin.php");  
            }
            else{
                echo "the infos are not correct";
            }
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login_sudo.css">
    <title>orientation FST Tanger</title>
</head>
<body>

    <div class="title_container">
      <div class="logo_fst">
        <div >
          <img src="../images/FST-Tanger-modified.png" alt="" class="fst_img">
        </div>
        
      </div>

      <div class="h1_div">
      <h1 class="h1_style">FST TANGER</h1>
      </div>

      <div class="logo_uni">
        <img src="../images/logopuae.png" class="uni_img">
      </div>
      
    </div>
    <a href="index.php">menue principal</a>
    <div class="container">
        <div class="box">
            <div class="titre">
                <h1>Espace Chef de Filière</h1>
            </div>
            <div class="form_container">
                <form action="login_chef.php" method="post">
                    <div class="info">
                        <div class="email">
                            <label class="text_email">Email</label>
                            <input type="email" name="email" placeholder="Email &#128231;" required class="input_email"><br>
                        </div>
                        <div class="password">
                            <label class="text_password">Mot de Passe</label>
                            <input type="password" name="password" placeholder="mot de passe &#128273;" required class="input_password"><br>
                        </div>
                        <input type="submit" name="submit" value="Se connecter" class="input_envoyer">
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>