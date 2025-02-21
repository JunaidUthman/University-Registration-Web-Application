<?php
    include("database.php");
    session_start();
    if (!isset($_SESSION["email"])) {
        header("Location: login_sudo.php");
    }
    if(isset($_GET["id"])){
        $_SESSION["id_chef_modifier"]=$_GET["id"];
    }
    else{
        $id_chef=$_SESSION["id_chef_modifier"];
    }
    
    if(isset($_POST["submit"])){
        $fullname=$_POST["fullname"];
        $email=$_POST["email"];
        $password=$_POST["password"];
        $heshed_password=password_hash($password, PASSWORD_DEFAULT);
        $nom_filiere=$_POST["filiere"];
        ///////////chercher le id avec le nom entré dans le form/////////////////////////////
        $query_id_filiere=$db -> prepare("SELECT id_filiere FROM filiere WHERE nom_filiere=:nom_filiere");
        $query_id_filiere ->bindparam(":nom_filiere",$nom_filiere);
        $query_id_filiere ->execute();
        $f=$query_id_filiere -> fetch();
        $id_filiere=$f["id_filiere"];

        $query_insert=$db->prepare('UPDATE chef_filiere SET fullname=:fullname,
                                                                 email=:email,
                                                                 password=:password,
                                                                 id_filiere_fk=:id_filiere WHERE id_chef=:id_chef');
            $query_insert->bindparam(":fullname",$fullname);
            $query_insert->bindparam(":email",$email);
            $query_insert->bindparam(":password",$heshed_password);
            $query_insert->bindparam(":id_filiere",$id_filiere);
            $query_insert->bindparam(":id_chef",$id_chef);
            $query_insert -> execute();
            header("location:supprimer_chef_filiere.php");
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/ajouter_admin.css">
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
    <a href="affichage_filiere_sudo.php">menue</a>
    <div class="container">
        <div class="box">
            <div class="titre">
                <h1>Bienvenue a FST Tanger</h1>
            </div>
            <div class="form_container">
                <form action="modifier_chef.php" method="post">
                    <div class="info">
                        <div class="email">
                            <label class="text_email">Nom & Prénom</label>
                            <input type="text" name="fullname" placeholder="Nom et Prénom" required class="input_fullname"><br>
                        </div>
                        <div class="email">
                            <label class="text_email">Email</label>
                            <input type="email" name="email" placeholder="Email &#128231;" required class="input_email"><br>
                        </div>
                        <div class="password">
                            <label class="text_password">Mot de Passe</label>
                            <input type="password" name="password" placeholder="mot de passe &#128273;" required class="input_password"><br>
                        </div>
                        <div class="email">
                            <label class="text_email">filière</label>
                            <select name="filiere" required>
                                <option value="" disabled selected></option>
                                <?php
                                    
                                    $query= $db->prepare('SELECT * FROM filiere');
                                    $query ->execute();
                                    $rows=$query->fetchAll();
                                    foreach($rows as $row){
                                        echo '
                                            <option value="'.$row["nom_filiere"].'">'.$row["nom_filiere"].'</option>
                                        ';
                                    }
                                ?>
                            </select>
                            
                        </div>
                        <input type="submit" name="submit" value="Ajouter" class="input_envoyer">
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>