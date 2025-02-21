<?php
session_start();
if(!isset($_SESSION["email_verified"])){
    header("location:signin_etape1.php");
}
if(isset($_POST["submit"])){
    header("location:login.php");
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="license_cycle_master.css">
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
                <h1 style="margin-left:140px;">&#127881;Félicitations&#127881;</h1>
                <h2 style="margin-left:50px;">Votre compte est totallement crée</h2>
                <h3>cliquez sur "s'authentifier" pour acceder a votre compte :</h3>
            </div>
            <div class="form_container">
                <form action="felicitation.php" method="post">
                    <div class="info">
                        
                        <input style="margin-left:250px; border-radius:10px; width: 100px; height: 40px;" type="submit" name="submit" value="s'authentifier" class="input_envoyer">
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>