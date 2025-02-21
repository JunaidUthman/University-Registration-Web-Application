<?php
session_start();
    if(isset($_POST["submit"])){
        include("data_base.php");
        $email = $_POST["email"];
        $password=$_POST["password"];
        $query = $db -> prepare('SELECT * FROM etudiant WHERE email=:email');
        $query -> bindparam(":email",$email);
        $query -> execute();
        $row = $query -> fetch();
            if(!empty($row) && password_verify($password,$row["password"])){
                if($row["verified"]==1){
                    echo "the info are correct";
                    $_SESSION["email_verified"]=$email;
                    $_SESSION["id"]=$row["id"];
                    header("location:license_cycle_master.php");
                }
                else{
                    echo "your account is not verified";
                }   
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
    <link rel="stylesheet" href="login_style.css">
    <title>orientation FST Tanger</title>
</head>
<body>

    <div class="title_container">
      <div class="logo_fst">
        <div >
          <img src="images/FST-Tanger-modified.png" alt="" class="fst_img">
        </div>
        
      </div>

      <div class="h1_div">
      <h1 class="h1_style">FST TANGER</h1>
      </div>

      <div class="logo_uni">
        <img src="images/logopuae.png" class="uni_img">
      </div>
      
    </div>
    <div class="container">
        <div class="box">
            <div class="titre">
                <h1>Bienvenue a FST Tanger</h1>
            </div>
            <div class="form_container">
                <form action="login.php" method="post">
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
            <a href="signin_etape1.php" class="lien_signin">aller à la page d'inscription</a>
        </div>
    </div>
    
</body>