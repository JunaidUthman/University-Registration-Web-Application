<?php
session_start();
$id=$_SESSION["id"];
if(!isset($_SESSION["email_verified"])){
    header("location:login.php");
}
//echo $id;
    if(isset($_POST["submit"])){
        if(!empty($_POST["master_cycle"])){
            include("data_base.php");
            $orientation=$_POST["master_cycle"];

                    if($orientation == "Master"){
                        header("location:master.php");
                    }
                    elseif($orientation=="Cycle d'ingenieur"){
                        header("location:cycle.php");
                    }
                    else{
                        header("location:licence.php");
                    }
        }
        {
            echo "il faut choisir une orientation";
        }
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
    <div>
        <a href="deconexion.php"><button class="deconexion">deconexion</button></a>
    </div>
    <div class="container">
        <div class="box">
            <div class="titre">
                <h1>Dans quel parcours souhaitez-vous continuer ?</h1>
            </div>
            <div class="form_container">
                <form action="license_cycle_master.php" method="post">
                    <div class="info">
                        <input type="radio" name="master_cycle" class="master_button_style" value="Master"><label class="text_master" required>Master</label><br>
                        <input type="radio" name="master_cycle" class="cycle_button_style" value="Cycle d'ingenieur"><label class="text_cycle" required>Cycle d'ingenieur</label><br>
                        <input type="radio" name="master_cycle" class="cycle_button_style" value="licence"><label class="text_cycle" required>Licence</label><br>
                        <input type="submit" name="submit" value=">>>" class="input_envoyer">
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>